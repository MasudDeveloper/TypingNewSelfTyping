<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $testResults = \App\Models\TestResult::where('user_id', $user->id)->with('typingTest')->latest()->get();
        
        $totalTestsTaken = $testResults->count();
        $avgWpm = $totalTestsTaken > 0 ? round($testResults->avg('net_wpm'), 1) : 0;
        $maxWpm = $totalTestsTaken > 0 ? round($testResults->max('net_wpm'), 1) : 0;
        $avgAccuracy = $totalTestsTaken > 0 ? round($testResults->avg('accuracy'), 1) : 0;
        $passedTests = $testResults->where('is_passed', true)->count();
        
        $recentResults = $testResults->take(5);

        return view('profile.edit', compact(
            'user',
            'totalTestsTaken',
            'avgWpm',
            'maxWpm',
            'avgAccuracy',
            'passedTests',
            'recentResults'
        ));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
