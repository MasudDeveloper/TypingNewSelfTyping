<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Institution;
use App\Models\Package;
use App\Models\ReceivedSmsPayment;
use App\Models\TestResult;
use App\Models\Transaction;
use App\Models\TypingTest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperAdminController extends Controller
{
    private function checkSuperAdmin()
    {
        if (auth()->user()->role !== 'superadmin') {
            abort(403, 'Unauthorized access to SuperAdmin Panel');
        }
    }

    /**
     * 1. Overview Executive Dashboard
     */
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
            ->take(8)
            ->get();

        $recentSmsPayments = ReceivedSmsPayment::latest()->take(8)->get();
        $recentInstitutions = Institution::withCount('students')->latest()->take(5)->get();
        $recentTests = TypingTest::latest()->take(6)->get();

        $gatewayApiKey = env('SMS_GATEWAY_API_KEY', 'selftyping_gateway_secret_2026');
        $gatewayWebhookUrl = url('/api/v1/sms/webhook');

        return view('superadmin.dashboard', compact(
            'totalStudents',
            'totalTests',
            'totalRechargeSum',
            'totalResultsCount',
            'pendingRecharges',
            'recentSmsPayments',
            'recentInstitutions',
            'recentTests',
            'gatewayApiKey',
            'gatewayWebhookUrl'
        ));
    }

    /**
     * 2. Dedicated Android Gateway & Wallet Recharge Management Page
     */
    public function gatewayIndex()
    {
        $this->checkSuperAdmin();

        $pendingRecharges = Transaction::with('user')
            ->where('status', 'pending')
            ->where('type', 'recharge')
            ->latest()
            ->paginate(15);

        $recentSmsPayments = ReceivedSmsPayment::latest()->paginate(25);
        $totalCompletedRecharges = Transaction::where('type', 'recharge')->where('status', 'completed')->sum('amount');

        $gatewayApiKey = env('SMS_GATEWAY_API_KEY', 'selftyping_gateway_secret_2026');
        $gatewayWebhookUrl = url('/api/v1/sms/webhook');

        return view('superadmin.gateway', compact(
            'pendingRecharges',
            'recentSmsPayments',
            'totalCompletedRecharges',
            'gatewayApiKey',
            'gatewayWebhookUrl'
        ));
    }

    /**
     * 3. Dedicated Institutions & Coaching Sales Packages Page
     */
    public function institutionsIndex()
    {
        $this->checkSuperAdmin();

        $institutions = Institution::withCount('students')->latest()->paginate(15);
        $totalInstitutions = Institution::count();
        $totalCoachingStudents = User::whereNotNull('institution_id')->count();

        return view('superadmin.institutions', compact(
            'institutions',
            'totalInstitutions',
            'totalCoachingStudents'
        ));
    }

    /**
     * 4. Dedicated Typing Tests & Question Bank Page
     */
    public function testsIndex(Request $request)
    {
        $this->checkSuperAdmin();

        $lang = $request->get('lang', 'all');
        $query = TypingTest::latest();

        if ($lang !== 'all' && !empty($lang)) {
            $query->where('language', $lang);
        }

        $tests = $query->paginate(15)->withQueryString();
        $totalTests = TypingTest::count();

        return view('superadmin.tests', compact('tests', 'totalTests', 'lang'));
    }

    /**
     * 5. Dedicated Packages Management Page
     */
    public function packagesIndex()
    {
        $this->checkSuperAdmin();
        $packages = Package::all();

        return view('superadmin.packages', compact('packages'));
    }

    /**
     * 6. Dedicated Books & Publication Management Page
     */
    public function booksIndex()
    {
        $this->checkSuperAdmin();
        $books = Book::orderBy('sort_order', 'asc')->paginate(15);

        return view('superadmin.books', compact('books'));
    }

    /**
     * Actions: Approve Recharge
     */
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

    /**
     * Actions: Reject Recharge
     */
    public function rejectRecharge(Transaction $transaction)
    {
        $this->checkSuperAdmin();

        $transaction->status = 'failed';
        $transaction->save();

        return back()->with('error', 'রিচার্জ রিকোয়েস্টটি বাতিল করা হয়েছে।');
    }

    /**
     * Actions: Store Test
     */
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

    /**
     * Actions: Destroy Test
     */
    public function destroyTest(TypingTest $test)
    {
        $this->checkSuperAdmin();
        $test->delete();
        return back()->with('success', 'টেস্টটি মুছে ফেলা হয়েছে।');
    }

    /**
     * Actions: Store Book
     */
    public function storeBook(Request $request)
    {
        $this->checkSuperAdmin();

        $request->validate([
            'title' => 'required|string|max:255',
            'external_url' => 'required|url',
            'price' => 'required|numeric',
        ]);

        Book::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image_url' => $request->image_url,
            'price' => $request->price,
            'original_price' => $request->original_price,
            'discount_percent' => $request->discount_percent,
            'stock_status' => $request->stock_status ?? 'In Stock',
            'external_url' => $request->external_url,
            'accent_color' => $request->accent_color ?? '#2563eb',
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return back()->with('success', 'নতুন বই সফলভাবে যুক্ত করা হয়েছে!');
    }

    /**
     * Actions: Destroy Book
     */
    public function destroyBook(Book $book)
    {
        $this->checkSuperAdmin();
        $book->delete();
        return back()->with('success', 'বইটি সফলভাবে মুছে ফেলা হয়েছে।');
    }

    /**
     * Actions: Store Institution
     */
    public function storeInstitution(Request $request)
    {
        $this->checkSuperAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'package_name' => 'required|string',
            'student_limit' => 'required|integer|min:1',
            'duration_months' => 'required|integer|min:1',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users,email',
            'admin_password' => 'required|string|min:6',
        ]);

        $institution = Institution::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . rand(100, 999),
            'package_name' => $request->package_name,
            'student_limit' => $request->student_limit,
            'subscription_status' => true,
            'subscription_expires_at' => now()->addMonths((int)$request->duration_months),
        ]);

        // Create the institution admin account
        User::create([
            'name' => $request->admin_name,
            'email' => $request->admin_email,
            'password' => Hash::make($request->admin_password),
            'role' => 'institution_admin',
            'institution_id' => $institution->id,
            'subscription_expires_at' => $institution->subscription_expires_at,
        ]);

        return back()->with('success', "নতুন প্রতিষ্ঠান '{$institution->name}' ও অ্যাডমিন অ্যাকাউন্ট সফলভাবে তৈরি হয়েছে!");
    }

    /**
     * Actions: Update Institution Subscription
     */
    public function updateInstitutionSubscription(Request $request, Institution $institution)
    {
        $this->checkSuperAdmin();

        $request->validate([
            'package_name' => 'required|string',
            'student_limit' => 'required|integer|min:1',
            'extend_months' => 'required|integer|min:1',
            'subscription_status' => 'required|boolean',
        ]);

        $newExpiry = $institution->subscription_expires_at && $institution->subscription_expires_at > now()
            ? $institution->subscription_expires_at->addMonths((int)$request->extend_months)
            : now()->addMonths((int)$request->extend_months);

        $institution->update([
            'package_name' => $request->package_name,
            'student_limit' => $request->student_limit,
            'subscription_status' => $request->subscription_status,
            'subscription_expires_at' => $newExpiry,
        ]);

        // Sync expiration with all students of this institution
        $institution->students()->update([
            'subscription_expires_at' => $newExpiry,
        ]);

        return back()->with('success', "'{$institution->name}'-এর প্যাকেজ ও মেয়াদ সফলভাবে আপডেট করা হয়েছে!");
    }
}
