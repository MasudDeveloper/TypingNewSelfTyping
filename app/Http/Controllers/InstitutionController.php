<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use App\Models\TestResult;
use App\Models\TypingTest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InstitutionController extends Controller
{
    private function getInstitution()
    {
        $user = auth()->user();
        if ($user->role !== 'institution_admin' && $user->role !== 'superadmin') {
            abort(403, 'Unauthorized access to Institution Portal');
        }

        $institution = $user->institution_id ? Institution::find($user->institution_id) : Institution::first();
        if (!$institution) {
            $institution = Institution::create([
                'name' => 'Default Coaching Center',
                'slug' => 'default-coaching',
                'subscription_status' => true,
            ]);
            $user->institution_id = $institution->id;
            $user->save();
        }

        return $institution;
    }

    public function index()
    {
        $institution = $this->getInstitution();

        $students = $institution->students()->latest()->get();
        $tests = $institution->tests()->latest()->get();

        $studentIds = $students->pluck('id');
        $results = TestResult::with(['user', 'typingTest'])
            ->whereIn('user_id', $studentIds)
            ->latest()
            ->take(15)
            ->get();

        $totalStudents = $students->count();
        $totalTests = $tests->count();
        $avgSpeed = $results->count() > 0 ? round($results->avg('net_wpm')) : 0;
        $passRate = $results->count() > 0 ? round(($results->where('is_passed', true)->count() / $results->count()) * 100) : 0;

        return view('institution.dashboard', compact(
            'institution',
            'students',
            'tests',
            'results',
            'totalStudents',
            'totalTests',
            'avgSpeed',
            'passRate'
        ));
    }

    public function storeStudent(Request $request)
    {
        $institution = $this->getInstitution();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
            'institution_id' => $institution->id,
            'subscription_expires_at' => now()->addMonths(6), // grant coaching batch access
        ]);

        return back()->with('success', 'শিক্ষার্থী সফলভাবে ব্যাচে অন্তর্ভুক্ত করা হয়েছে!');
    }

    public function storeTest(Request $request)
    {
        $institution = $this->getInstitution();

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'language' => 'required|in:en,bn_unicode,bn_bijoy',
            'mode' => 'required|in:screen,sheet',
            'time_limit_minutes' => 'required|integer|min:1|max:30',
            'pass_wpm' => 'required|integer|min:10|max:100',
            'content' => 'required|string',
        ]);

        TypingTest::create([
            'title' => $request->title,
            'category' => $request->category . ' (' . $institution->name . ')',
            'language' => $request->language,
            'mode' => $request->mode,
            'time_limit_minutes' => $request->time_limit_minutes,
            'pass_wpm' => $request->pass_wpm,
            'content' => $request->content,
            'institution_id' => $institution->id,
            'is_premium' => false,
            'backspace_allowed' => true,
        ]);

        return back()->with('success', 'ইনস্টিটিউট পরীক্ষার প্যাসেজ সফলভাবে তৈরি হয়েছে!');
    }

    public function batchReport()
    {
        $institution = $this->getInstitution();
        $studentIds = $institution->students()->pluck('id');
        $results = TestResult::with(['user', 'typingTest'])
            ->whereIn('user_id', $studentIds)
            ->latest()
            ->get();

        return view('institution.report', compact('institution', 'results'));
    }
}
