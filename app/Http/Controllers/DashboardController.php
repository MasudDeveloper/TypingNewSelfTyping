<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'superadmin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'institution_admin') {
            return redirect()->route('institution.dashboard');
        } else {
            $tests = \App\Models\TypingTest::all();
            return view('student.dashboard', compact('tests'));
        }
    }
}
