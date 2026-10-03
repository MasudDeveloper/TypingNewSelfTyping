<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\ReceivedSmsPayment;
use App\Models\TestResult;
use App\Models\Transaction;
use App\Models\TypingTest;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    private function checkSuperAdmin()
    {
        if (auth()->user()->role !== 'superadmin') {
            abort(403, 'Unauthorized');
        }
    }

    public function index()
    {
        $this->checkSuperAdmin();

        $totalStudents = User::where('role', 'student')->count();
        $totalTests = TypingTest::count();
        $totalRechargeSum = Transaction::where('type', 'recharge')->where('status', 'completed')->sum('amount');
        $totalResultsCount = TestResult::count();

        $pendingRecharges = Transaction::with('user')
            ->where('status', 'pending')
            ->where('type', 'recharge')
            ->latest()
            ->get();

        $recentSmsPayments = ReceivedSmsPayment::latest()->take(20)->get();
        $tests = TypingTest::latest()->get();
        $packages = Package::all();

        $gatewayApiKey = env('SMS_GATEWAY_API_KEY', 'selftyping_gateway_secret_2026');
        $gatewayWebhookUrl = url('/api/v1/sms/webhook');

        return view('superadmin.dashboard', compact(
            'totalStudents',
            'totalTests',
            'totalRechargeSum',
            'totalResultsCount',
            'pendingRecharges',
            'recentSmsPayments',
            'tests',
            'packages',
            'gatewayApiKey',
            'gatewayWebhookUrl'
        ));
    }

    public function approveRecharge(Transaction $transaction)
    {
        $this->checkSuperAdmin();

        if ($transaction->status !== 'completed') {
            $transaction->status = 'completed';
            $transaction->save();

            $user = User::find($transaction->user_id);
            if ($user) {
                $user->wallet_balance += $transaction->amount;
                $user->save();
            }
        }

        return back()->with('success', "টাকা {$transaction->amount} ৳ সফলভাবে অনুমোদন ও ইউজারের ওয়ালেটে যোগ করা হয়েছে।");
    }

    public function rejectRecharge(Transaction $transaction)
    {
        $this->checkSuperAdmin();

        $transaction->status = 'failed';
        $transaction->save();

        return back()->with('error', 'রিচার্জ রিকোয়েস্টটি বাতিল করা হয়েছে।');
    }

    public function storeTest(Request $request)
    {
        $this->checkSuperAdmin();

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'language' => 'required|in:en,bn_unicode,bn_bijoy',
            'mode' => 'required|in:screen,sheet',
            'time_limit_minutes' => 'required|integer|min:1|max:30',
            'pass_wpm' => 'required|integer|min:10|max:100',
            'content' => 'required|string',
            'is_premium' => 'nullable|boolean',
        ]);

        TypingTest::create([
            'title' => $request->title,
            'category' => $request->category,
            'language' => $request->language,
            'mode' => $request->mode,
            'time_limit_minutes' => $request->time_limit_minutes,
            'pass_wpm' => $request->pass_wpm,
            'content' => $request->content,
            'is_premium' => $request->has('is_premium'),
            'backspace_allowed' => $request->has('backspace_allowed') ? true : false,
        ]);

        return back()->with('success', 'নতুন টাইপিং টেস্ট সফলভাবে তৈরি করা হয়েছে!');
    }

    public function destroyTest(TypingTest $test)
    {
        $this->checkSuperAdmin();
        $test->delete();
        return back()->with('success', 'টেস্টটি মুছে ফেলা হয়েছে।');
    }
}
