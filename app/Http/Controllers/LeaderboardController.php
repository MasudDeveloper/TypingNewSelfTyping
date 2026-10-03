<?php

namespace App\Http\Controllers;

use App\Models\TestResult;
use App\Models\TypingTest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        $timeframe = $request->input('timeframe', 'all');
        $category = $request->input('category', 'all');

        $query = TestResult::with(['user', 'typingTest'])
            ->where('is_passed', true);

        if ($timeframe === 'today') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($timeframe === 'week') {
            $query->where('created_at', '>=', Carbon::now()->subDays(7));
        } elseif ($timeframe === 'month') {
            $query->where('created_at', '>=', Carbon::now()->subDays(30));
        }

        if ($category !== 'all') {
            $query->whereHas('typingTest', function ($q) use ($category) {
                $q->where('category', 'like', "%{$category}%");
            });
        }

        // Get Top Results ordered by Net WPM desc, then Accuracy desc
        $topResults = $query->orderBy('net_wpm', 'desc')
            ->orderBy('accuracy', 'desc')
            ->take(10)
            ->get();

        $categories = TypingTest::select('category')->distinct()->pluck('category');

        return view('student.leaderboard', compact('topResults', 'timeframe', 'category', 'categories'));
    }
}
