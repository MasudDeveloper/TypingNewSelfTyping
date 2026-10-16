@extends('layouts.student')

@section('title', 'Winner Best Top 10 Leaderboard - SelfTyping.com')

@push('styles')
<style>
    .leaderboard-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    /* Minimalist Modern Header Banner */
    .leaderboard-header {
        background: linear-gradient(135deg, rgba(30, 58, 138, 0.35) 0%, rgba(14, 21, 38, 0.9) 100%);
        border: 1px solid rgba(59, 130, 246, 0.25);
        border-radius: 20px;
        padding: 2.2rem 2.5rem;
        backdrop-filter: blur(16px);
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
    }
    .leaderboard-header::after {
        content: '';
        position: absolute;
        top: -40%;
        right: -5%;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, transparent 70%);
        pointer-events: none;
    }
    .header-text h1 {
        font-size: 1.7rem;
        font-weight: 800;
        color: #ffffff;
        display: flex;
        align-items: center;
        gap: 12px;
        letter-spacing: -0.5px;
    }
    .header-text p {
        color: #94a3b8;
        font-size: 0.95rem;
        margin-top: 6px;
    }
    .trophy-badge {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        background: linear-gradient(135deg, #f59e0b, #d97706);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        box-shadow: 0 8px 20px rgba(245, 158, 11, 0.35);
        flex-shrink: 0;
    }

    /* Minimalist Filter Navigation */
    .filter-bar {
        background: rgba(14, 21, 38, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        padding: 0.85rem 1.4rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        backdrop-filter: blur(14px);
    }

    .time-pills {
        display: flex;
        gap: 8px;
        background: rgba(255, 255, 255, 0.03);
        padding: 4px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    .time-pill {
        padding: 6px 16px;
        border-radius: 9px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        color: #94a3b8;
        transition: all 0.2s ease;
    }
    .time-pill:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.06);
    }
    .time-pill.active {
        background: var(--primary);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
    }

    .category-filter-box {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .category-filter-box label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #94a3b8;
    }
    .cyber-select {
        padding: 7px 14px;
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 0.88rem;
        background: #090e1a;
        color: #ffffff;
        font-weight: 600;
        outline: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    .cyber-select:focus {
        border-color: var(--primary);
    }

    /* Podium Layout (Top 3) */
    .podium-section {
        display: flex;
        justify-content: center;
        align-items: flex-end;
        gap: 1.5rem;
        margin: 1rem 0;
        padding: 0 1rem;
    }

    .podium-card {
        background: rgba(14, 21, 38, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        padding: 2rem 1.5rem;
        text-align: center;
        width: 250px;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        backdrop-filter: blur(14px);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.6);
    }
    .podium-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 35px -10px rgba(0, 0, 0, 0.8);
    }

    .podium-1 {
        order: 2;
        border-color: rgba(245, 158, 11, 0.5);
        background: linear-gradient(180deg, rgba(245, 158, 11, 0.12) 0%, rgba(14, 21, 38, 0.95) 100%);
        box-shadow: 0 15px 40px -10px rgba(245, 158, 11, 0.25);
        padding-top: 2.8rem;
        padding-bottom: 2.5rem;
    }
    .podium-2 {
        order: 1;
        border-color: rgba(148, 163, 184, 0.3);
        background: linear-gradient(180deg, rgba(148, 163, 184, 0.08) 0%, rgba(14, 21, 38, 0.9) 100%);
    }
    .podium-3 {
        order: 3;
        border-color: rgba(217, 119, 6, 0.3);
        background: linear-gradient(180deg, rgba(217, 119, 6, 0.08) 0%, rgba(14, 21, 38, 0.9) 100%);
    }

    .avatar-wrapper {
        position: relative;
        margin-bottom: 1.1rem;
    }
    .avatar-circle {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1e293b, #0f172a);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.5rem;
        color: #ffffff;
        border: 3px solid rgba(255, 255, 255, 0.15);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.4);
    }
    .podium-1 .avatar-circle {
        width: 84px;
        height: 84px;
        border-color: #f59e0b;
        font-size: 1.8rem;
        box-shadow: 0 0 20px rgba(245, 158, 11, 0.4);
    }

    .rank-badge {
        position: absolute;
        bottom: -4px;
        right: -4px;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        color: white;
        font-weight: 800;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #0e1526;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.5);
    }
    .rank-1-badge { background: #f59e0b; width: 32px; height: 32px; font-size: 0.95rem; }
    .rank-2-badge { background: #94a3b8; }
    .rank-3-badge { background: #d97706; }

    .podium-champion-pill {
        position: absolute;
        top: -14px;
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        padding: 4px 14px;
        border-radius: 20px;
        font-weight: 800;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
    }

    .podium-name {
        font-size: 1.15rem;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 0.25rem;
    }
    .podium-sub {
        font-size: 0.8rem;
        color: #94a3b8;
    }
    .podium-speed {
        font-size: 2.2rem;
        font-weight: 900;
        color: #38bdf8;
        font-family: var(--font-en);
        line-height: 1;
        margin: 0.75rem 0 0.35rem 0;
    }
    .podium-1 .podium-speed {
        color: #fbbf24;
        font-size: 2.6rem;
    }
    .podium-wpm-label {
        font-size: 0.78rem;
        font-weight: 700;
        color: #cbd5e1;
    }

    /* Minimalist Dark Table Card */
    .leaderboard-table-card {
        background: rgba(14, 21, 38, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        overflow: hidden;
        backdrop-filter: blur(14px);
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
    }
    .styled-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }
    .styled-table th {
        background: rgba(255, 255, 255, 0.02);
        padding: 1rem 1.4rem;
        font-size: 0.8rem;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }
    .styled-table td {
        padding: 1.15rem 1.4rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        font-size: 0.92rem;
        color: #cbd5e1;
    }
    .styled-table tr:hover td {
        background: rgba(255, 255, 255, 0.02);
    }
    .styled-table tr:last-child td {
        border-bottom: none;
    }

    .user-col {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .user-mini-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(37, 99, 235, 0.15);
        color: #60a5fa;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.85rem;
        border: 1px solid rgba(59, 130, 246, 0.25);
    }

    .speed-badge {
        background: rgba(56, 189, 248, 0.12);
        color: #38bdf8;
        padding: 5px 12px;
        border-radius: 8px;
        font-weight: 800;
        font-size: 0.95rem;
        font-family: var(--font-en);
        border: 1px solid rgba(56, 189, 248, 0.25);
        display: inline-block;
    }

    .accuracy-tag {
        font-weight: 700;
        font-family: var(--font-en);
    }
    .accuracy-tag.high { color: #34d399; }
    .accuracy-tag.mid { color: #fde047; }
    .accuracy-tag.low { color: #f87171; }

    /* Empty State */
    .empty-state-box {
        text-align: center;
        padding: 4rem 2rem;
        color: #94a3b8;
    }
    .empty-state-icon {
        width: 72px;
        height: 72px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        color: #64748b;
        margin: 0 auto 1.2rem auto;
    }

    @media (max-width: 900px) {
        .podium-section { flex-direction: column; align-items: center; }
        .podium-card { width: 100%; max-width: 320px; }
        .podium-1 { order: 1; }
        .podium-2 { order: 2; }
        .podium-3 { order: 3; }
        .leaderboard-header { flex-direction: column; gap: 1rem; align-items: flex-start; }
    }
</style>
@endpush

@section('content')
<div class="leaderboard-container">

    <!-- Top Header Banner -->
    <div class="leaderboard-header">
        <div class="header-text">
            <h1><i class="ph-fill ph-trophy" style="color:#f59e0b;"></i> Winner Best Top 10 Leaderboard</h1>
            <p>SelfTyping প্ল্যাটফর্মে সর্বোচ্চ গতি ও শতভাগ নির্ভুলতার সাথে শীর্ষ টাইপিং মাস্টারদের তালিকা।</p>
        </div>
        <div class="trophy-badge">
            <i class="ph-bold ph-medal"></i>
        </div>
    </div>

    <!-- Filter & Categories Navigation Bar -->
    <div class="filter-bar">
        <div class="time-pills">
            <a href="{{ route('leaderboard.index', ['timeframe' => 'today', 'category' => $category]) }}" class="time-pill {{ $timeframe === 'today' ? 'active' : '' }}">আজকের সেরা</a>
            <a href="{{ route('leaderboard.index', ['timeframe' => 'week', 'category' => $category]) }}" class="time-pill {{ $timeframe === 'week' ? 'active' : '' }}">এই সপ্তাহ</a>
            <a href="{{ route('leaderboard.index', ['timeframe' => 'month', 'category' => $category]) }}" class="time-pill {{ $timeframe === 'month' ? 'active' : '' }}">এই মাস</a>
            <a href="{{ route('leaderboard.index', ['timeframe' => 'all', 'category' => $category]) }}" class="time-pill {{ $timeframe === 'all' ? 'active' : '' }}">সর্বকালের সেরা</a>
        </div>

        <form method="GET" action="{{ route('leaderboard.index') }}" class="category-filter-box">
            <input type="hidden" name="timeframe" value="{{ $timeframe }}">
            <label><i class="ph-bold ph-funnel"></i> ক্যাটাগরি:</label>
            <select name="category" onchange="this.form.submit()" class="cyber-select">
                <option value="all" {{ $category === 'all' ? 'selected' : '' }}>সকল ক্যাটাগরি</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ $category === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Top 3 Podium (If Results Exist) -->
    @if($topResults->count() > 0)
        <div class="podium-section">
            <!-- Rank 2 -->
            @if(isset($topResults[1]))
                <div class="podium-card podium-2">
                    <div class="avatar-wrapper">
                        <div class="avatar-circle">{{ strtoupper(substr($topResults[1]->user->name ?? 'U', 0, 2)) }}</div>
                        <div class="rank-badge rank-2-badge">২</div>
                    </div>
                    <div class="podium-name">{{ $topResults[1]->user->name ?? 'পরীক্ষার্থী' }}</div>
                    <div class="podium-sub">{{ $topResults[1]->typingTest->title ?? 'BCC Test' }}</div>
                    <div class="podium-speed">{{ $topResults[1]->net_wpm }}</div>
                    <div class="podium-wpm-label">Net WPM • {{ number_format($topResults[1]->accuracy, 1) }}% নির্ভুল</div>
                </div>
            @endif

            <!-- Rank 1 (Champion) -->
            @if(isset($topResults[0]))
                <div class="podium-card podium-1">
                    <div class="podium-champion-pill">
                        👑 CHAMPION
                    </div>
                    <div class="avatar-wrapper">
                        <div class="avatar-circle">
                            {{ strtoupper(substr($topResults[0]->user->name ?? 'U', 0, 2)) }}
                        </div>
                        <div class="rank-badge rank-1-badge">১</div>
                    </div>
                    <div class="podium-name">{{ $topResults[0]->user->name ?? 'পরীক্ষার্থী' }}</div>
                    <div class="podium-sub">{{ $topResults[0]->typingTest->title ?? 'BCC Test' }}</div>
                    <div class="podium-speed">{{ $topResults[0]->net_wpm }}</div>
                    <div class="podium-wpm-label">Net WPM • {{ number_format($topResults[0]->accuracy, 1) }}% নির্ভুল</div>
                </div>
            @endif

            <!-- Rank 3 -->
            @if(isset($topResults[2]))
                <div class="podium-card podium-3">
                    <div class="avatar-wrapper">
                        <div class="avatar-circle">{{ strtoupper(substr($topResults[2]->user->name ?? 'U', 0, 2)) }}</div>
                        <div class="rank-badge rank-3-badge">৩</div>
                    </div>
                    <div class="podium-name">{{ $topResults[2]->user->name ?? 'পরীক্ষার্থী' }}</div>
                    <div class="podium-sub">{{ $topResults[2]->typingTest->title ?? 'BCC Test' }}</div>
                    <div class="podium-speed">{{ $topResults[2]->net_wpm }}</div>
                    <div class="podium-wpm-label">Net WPM • {{ number_format($topResults[2]->accuracy, 1) }}% নির্ভুল</div>
                </div>
            @endif
        </div>
    @endif

    <!-- Leaderboard Full Table (Top 10) -->
    <div class="leaderboard-table-card">
        <table class="styled-table">
            <thead>
                <tr>
                    <th style="width:80px; text-align:center;">র‌্যাঙ্ক</th>
                    <th>পরীক্ষার্থী</th>
                    <th>পরীক্ষার নাম ও ক্যাটাগরি</th>
                    <th>Gross WPM</th>
                    <th>ভুল (Errors)</th>
                    <th>Net WPM</th>
                    <th>নির্ভুলতা</th>
                    <th>তারিখ</th>
                </tr>
            </thead>
            <tbody>
                @forelse($topResults as $idx => $res)
                    <tr>
                        <td style="text-align:center; font-weight:800; font-size:1.15rem;">
                            @if($idx === 0) 🥇
                            @elseif($idx === 1) 🥈
                            @elseif($idx === 2) 🥉
                            @else #{{ $idx + 1 }}
                            @endif
                        </td>
                        <td>
                            <div class="user-col">
                                <div class="user-mini-avatar">
                                    {{ strtoupper(substr($res->user->name ?? 'U', 0, 2)) }}
                                </div>
                                <div>
                                    <div style="font-weight:700; color:#ffffff;">{{ $res->user->name ?? 'শিক্ষার্থী' }}</div>
                                    <div style="font-size:0.75rem; color:#64748b; font-family:var(--font-en);">ID: #{{ $res->user->id ?? 0 }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight:600; color:#ffffff;">{{ $res->typingTest->title ?? 'BCC Typing Test' }}</div>
                            <div style="font-size:0.78rem; color:#94a3b8;">{{ $res->typingTest->category ?? 'Government' }}</div>
                        </td>
                        <td style="font-weight:600; font-family:var(--font-en); color:#cbd5e1;">{{ $res->gross_wpm }}</td>
                        <td style="color:#f87171; font-weight:600; font-family:var(--font-en);">{{ $res->errors }} টি</td>
                        <td>
                            <span class="speed-badge">
                                {{ $res->net_wpm }} WPM
                            </span>
                        </td>
                        <td>
                            <span class="accuracy-tag {{ $res->accuracy >= 95 ? 'high' : ($res->accuracy >= 85 ? 'mid' : 'low') }}">
                                {{ number_format($res->accuracy, 1) }}%
                            </span>
                        </td>
                        <td style="color:#64748b; font-size:0.85rem; font-family:var(--font-en);">
                            {{ $res->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state-box">
                                <div class="empty-state-icon">
                                    <i class="ph-bold ph-trophy"></i>
                                </div>
                                <h3 style="font-size:1.15rem; font-weight:700; color:#ffffff; margin-bottom:0.4rem;">কোনো রেকর্ড পাওয়া যায়নি</h3>
                                <p style="font-size:0.9rem; color:#94a3b8; max-width:400px; margin:0 auto 1.5rem auto;">
                                    এই ফিল্টারে এখনও কোনো টাইপিং টেস্টের রেকর্ড নেই। ড্যাশবোর্ড থেকে প্রথম টেস্ট সম্পন্ন করে লিডারবোর্ডের শীর্ষে নিজের নাম যুক্ত করুন!
                                </p>
                                <a href="{{ route('dashboard') }}" class="time-pill active" style="padding:10px 22px; font-size:0.9rem; display:inline-flex; align-items:center; gap:6px;">
                                    <i class="ph-bold ph-play"></i> টেস্টে অংশগ্রহণ করুন
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
