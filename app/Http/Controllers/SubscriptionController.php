<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\ReceivedSmsPayment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function index()
    {
        $packages = Package::where('is_active', true)->get();
        $userTransactions = Transaction::where('user_id', auth()->id())->latest()->take(10)->get();
        return view('student.packages', compact('packages', 'userTransactions'));
    }

    public function recharge(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10',
            'transaction_id' => 'required|string',
            'method' => 'required|string', // bKash, Nagad, Rocket, Upay
        ]);

        $user = auth()->user();
        $trxId = strtoupper(trim($request->transaction_id));
        $amount = (float) $request->amount;
        $method = strtoupper(trim($request->method));

        // Check if matching SMS already received from Android Gateway
        $matchingSms = ReceivedSmsPayment::where('trx_id', $trxId)
            ->where('is_used', false)
            ->first();

        if ($matchingSms) {
            // Verify Amount
            if ((float)$matchingSms->amount != $amount) {
                return back()->with('error', "টাকার পরিমাণ মেলেনি। এসএমএস এ প্রাপ্ত পরিমাণ ছিল: {$matchingSms->amount} ৳");
            }

            // Claim SMS
            $matchingSms->is_used = true;
            $matchingSms->used_by_user_id = $user->id;
            $matchingSms->used_at = now();
            $matchingSms->save();

            // Credit balance
            $user->wallet_balance += $amount;
            $user->save();

            // Create completed transaction
            Transaction::create([
                'user_id' => $user->id,
                'type' => 'recharge',
                'amount' => $amount,
                'description' => "Auto-verified via {$method} (TrxID: {$trxId})",
                'status' => 'completed',
            ]);

            return back()->with('success', "অভিনন্দন! আপনার {$amount} ৳ রিচার্জ তাৎক্ষণিকভাবে ভেরিফাই হয়েছে ও ওয়ালেটে যুক্ত হয়েছে।");
        }

        // Check if TrxID was already used
        $usedSms = ReceivedSmsPayment::where('trx_id', $trxId)->where('is_used', true)->first();
        if ($usedSms) {
            return back()->with('error', 'এই Transaction ID টি ইতিপূর্বে ব্যবহার করা হয়েছে!');
        }

        // If SMS not yet received from Android, record as pending
        Transaction::create([
            'user_id' => $user->id,
            'type' => 'recharge',
            'amount' => $amount,
            'description' => "Recharge via {$method} (TrxID: {$trxId})",
            'status' => 'pending',
        ]);

        return back()->with('success', 'রিচার্জ রিকোয়েস্ট জমা হয়েছে। গেটওয়ে থেকে এসএমএস সিঙ্ক হওয়ার সাথে সাথে আপনার ব্যালেন্স স্বয়ংক্রিয়ভাবে যোগ হবে।');
    }

    public function purchase(Package $package)
    {
        $user = auth()->user();

        if ($user->wallet_balance < $package->price) {
            return back()->with('error', 'আপনার ওয়ালেটে পর্যাপ্ত ব্যালেন্স নেই। অনুগ্রহ করে প্রথমে রিচার্জ করুন।');
        }

        // Deduct balance
        $user->wallet_balance -= $package->price;
        
        // Extend subscription
        $currentExpiry = $user->subscription_expires_at && $user->subscription_expires_at > now() 
                            ? $user->subscription_expires_at 
                            : now();
                            
        $user->subscription_expires_at = $currentExpiry->addDays($package->duration_days);
        $user->save();

        // Record transaction
        Transaction::create([
            'user_id' => $user->id,
            'type' => 'purchase',
            'amount' => $package->price,
            'description' => "Purchased package: {$package->name}",
            'status' => 'completed'
        ]);

        return back()->with('success', "সফলভাবে {$package->name} প্যাকেজটি কেনা হয়েছে! আপনার সাবস্ক্রিপশন মেয়াদ বৃদ্ধি করা হয়েছে।");
    }
}
