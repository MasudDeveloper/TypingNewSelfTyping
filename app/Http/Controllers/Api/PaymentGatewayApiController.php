<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReceivedSmsPayment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentGatewayApiController extends Controller
{
    private function getGatewaySecret(): string
    {
        return env('SMS_GATEWAY_API_KEY', 'selftyping_gateway_secret_2026');
    }

    /**
     * Webhook called by the Android SMS Gateway App
     */
    public function receiveSmsWebhook(Request $request)
    {
        // Validate API Key
        $apiKey = $request->header('X-API-KEY') ?? $request->input('api_key');
        if ($apiKey !== $this->getGatewaySecret()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized: Invalid API Key',
            ], 401);
        }

        $request->validate([
            'trx_id' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'method' => 'nullable|string',
            'sender_number' => 'nullable|string',
            'raw_sms' => 'nullable|string',
        ]);

        $trxId = strtoupper(trim($request->trx_id));
        $amount = (float) $request->amount;
        $method = strtolower(trim($request->method ?? 'bkash'));
        $senderNumber = $request->sender_number;
        $rawSms = $request->raw_sms;

        // Check if transaction already exists
        $existing = ReceivedSmsPayment::where('trx_id', $trxId)->first();
        if ($existing) {
            return response()->json([
                'success' => true,
                'message' => 'Transaction already recorded',
                'data' => $existing,
            ]);
        }

        // Create new received SMS record
        $smsRecord = ReceivedSmsPayment::create([
            'method' => $method,
            'trx_id' => $trxId,
            'amount' => $amount,
            'sender_number' => $senderNumber,
            'raw_sms' => $rawSms,
            'is_used' => false,
        ]);

        // Auto-match with any pending user recharge transactions in the DB
        $pendingTransaction = Transaction::where('status', 'pending')
            ->where('type', 'recharge')
            ->where('amount', $amount)
            ->where('description', 'like', "%{$trxId}%")
            ->first();

        if ($pendingTransaction) {
            $user = User::find($pendingTransaction->user_id);
            if ($user) {
                // Complete user transaction
                $pendingTransaction->status = 'completed';
                $pendingTransaction->save();

                // Credit wallet
                $user->wallet_balance += $amount;
                $user->save();

                // Mark SMS as claimed
                $smsRecord->is_used = true;
                $smsRecord->used_by_user_id = $user->id;
                $smsRecord->used_at = now();
                $smsRecord->save();

                Log::info("Auto-recharged User #{$user->id} with Amount {$amount} Tk via TrxID {$trxId}");
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'SMS payment received and processed successfully',
            'auto_matched' => !empty($pendingTransaction),
            'data' => $smsRecord,
        ]);
    }

    /**
     * Instant Verification endpoint called by the student checkout / recharge form
     */
    public function verifyInstantPayment(Request $request)
    {
        $request->validate([
            'method' => 'required|string',
            'amount' => 'required|numeric|min:10',
            'trx_id' => 'required|string',
        ]);

        $user = auth()->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
        }

        $trxId = strtoupper(trim($request->trx_id));
        $amount = (float) $request->amount;
        $method = strtolower(trim($request->method));

        // Check if we received matching SMS from Android Gateway
        $matchingSms = ReceivedSmsPayment::where('trx_id', $trxId)
            ->where('is_used', false)
            ->first();

        if ($matchingSms) {
            // Verify amount
            if ((float)$matchingSms->amount != $amount) {
                return response()->json([
                    'success' => false,
                    'message' => "টাকার পরিমাণ মেলেনি। প্রাপ্ত এসএমএস এর পরিমাণ: {$matchingSms->amount} ৳",
                ], 422);
            }

            // Mark SMS as used
            $matchingSms->is_used = true;
            $matchingSms->used_by_user_id = $user->id;
            $matchingSms->used_at = now();
            $matchingSms->save();

            // Credit wallet
            $user->wallet_balance += $amount;
            $user->save();

            // Record transaction
            Transaction::create([
                'user_id' => $user->id,
                'type' => 'recharge',
                'amount' => $amount,
                'description' => "Auto-verified via " . strtoupper($method) . " (TrxID: {$trxId})",
                'status' => 'completed',
            ]);

            return response()->json([
                'success' => true,
                'instant_approved' => true,
                'new_balance' => $user->wallet_balance,
                'message' => "অভিনন্দন! আপনার {$amount} ৳ রিচার্জ তাৎক্ষণিকভাবে ভেরিফাই হয়েছে ও ওয়ালেটে যুক্ত হয়েছে।",
            ]);
        }

        // SMS not found yet -> Create pending transaction for admin / future webhook match
        Transaction::create([
            'user_id' => $user->id,
            'type' => 'recharge',
            'amount' => $amount,
            'description' => "Recharge via " . strtoupper($method) . " (TrxID: {$trxId})",
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'instant_approved' => false,
            'new_balance' => $user->wallet_balance,
            'message' => 'রিচার্জ রিকোয়েস্ট জমা হয়েছে। এসএমএস আসার সাথে সাথেই স্বয়ংক্রিয়ভাবে ব্যালেন্স যোগ হবে।',
        ]);
    }

    /**
     * Get Gateway status & statistics
     */
    public function getGatewayStatus(Request $request)
    {
        $apiKey = $request->header('X-API-KEY') ?? $request->input('api_key');
        if ($apiKey !== $this->getGatewaySecret() && (!auth()->check() || auth()->user()->role !== 'superadmin')) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $totalReceived = ReceivedSmsPayment::count();
        $totalUsed = ReceivedSmsPayment::where('is_used', true)->count();
        $totalPending = ReceivedSmsPayment::where('is_used', false)->count();
        $recentPayments = ReceivedSmsPayment::latest()->take(10)->get();

        return response()->json([
            'success' => true,
            'server_time' => now()->toDateTimeString(),
            'total_received' => $totalReceived,
            'total_used' => $totalUsed,
            'total_pending' => $totalPending,
            'recent_payments' => $recentPayments,
        ]);
    }
}
