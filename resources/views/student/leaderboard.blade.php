@extends('layouts.student')

@section('title', 'Winner Best Top 10 - SelfTyping.com')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    .leaderboard-container {
        font-family: 'Hind Siliguri', 'Inter', sans-serif;
    }

    /* Podium Layout */
    .podium-section {
        display: flex;
        justify-content: center;
        align-items: flex-end;
        gap: 1.5rem;
        margin: 2.5rem 0 3rem 0;
        padding: 0 1rem;
    }

    .podium-card {
        background: var(--bg-surface);
        border: 2px solid var(--border);
        border-radius: 20px;
        padding: 1.75rem 1.25rem;
        text-align: center;
        width: 240px;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        transition: transform 0.2s;
    }

    .podium-card:hover { transform: translateY(-4px); }

    .podium-1 {
        order: 2;
        border-color: #f59e0b;
        background: linear-gradient(180deg, #fffbeb 0%, #ffffff 100%);
        box-shadow: 0 15px 35px rgba(245, 158, 11, 0.15);
        padding-top: 2.5rem;
        padding-bottom: 2.5rem;
    }

    .podium-2 {
        order: 1;
        border-color: #94a3b8;
        background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
        box-shadow: 0 10px 25px rgba(148, 163, 184, 0.12);
    }

    .podium-3 {
        order: 3;
        border-color: #d97706;
        background: linear-gradient(180deg, #fef3c7 0%, #ffffff 100%);
        box-shadow: 0 10px 25px rgba(217, 119, 6, 0.1);
    }

    .avatar-wrapper {
        position: relative;
        margin-bottom: 1rem;
    }

    .avatar-circle {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.5rem;
        color: var(--primary);
        border: 3px solid white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .rank-badge {
        position: absolute;
        bottom: -6px;
        right: -6px;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        color: white;
        font-weight: 800;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid white;
    }

    .rank-1-badge { background: #f59e0b; }
    .rank-2-badge { background: #94a3b8; }
    .rank-3-badge { background: #b45309; }

    .podium-name {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.25rem;
    }

    .podium-speed {
        font-size: 2rem;
        font-weight: 900;
        color: var(--primary);
        line-height: 1;
        margin: 0.5rem 0;
    }

    .podium-wpm-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
    }

    /* Filters Bar */
    .filter-bar {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .time-pills {
        display: flex;
        gap: 6px;
    }

    .time-pill {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        color: var(--text-muted);
        background: #f1f5f9;
        transition: 0.2s;
    }

    .time-pill.active, .time-pill:hover {
        background: var(--primary);
        color: white;
    }

    /* Table Styling */
    .leaderboard-table-card {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .styled-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .styled-table th {
        background: #f8fafc;
        padding: 1rem 1.25rem;
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        border-bottom: 1px solid var(--border);
    }

    .styled-table td {
        padding: 1.1rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.95rem;
        color: var(--text-dark);
    }

    .styled-table tr:last-child td { border-bottom: none; }
    .styled-table tr:hover { background: #fbfcfe; }

    @media (max-width: 768px) {
        .podium-section { flex-direction: column; align-items: center; }
        .podium-card { width: 100%; max-width: 320px; }
        .podium-1 { order: 1; }
        .podium-2 { order: 2; }
        .podium-3 { order: 3; }
    }
</style>
@endpush

@section('content')

<div class="leaderboard-container">
    <div style="text-align:center; margin-bottom:2rem;">
        <h1 style="font-size:2rem; font-weight:900; color:var(--text-dark);">
            <i class="ph-fill ph-trophy" style="color:#f59e0b;"></i> Winner Best Top 10 Leaderboard
        </h1>
        <p style="color:var(--text-muted); font-size:1rem; margin-top:0.35rem;">
            SelfTyping প্ল্যাটফর্মে সর্বোচ্চ গতি ও শতভাগ নির্ভুলতার সাথে শীর্ষ টাইপিং মাস্টারদের তালিকা
        </p>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">
        <div class="time-pills">
            <a href="{{ route('leaderboard.index', ['timeframe' => 'today', 'category' => $category]) }}" class="time-pill {{ $timeframe === 'today' ? 'active' : '' }}">আজকের সেরা</a>
            <a href="{{ route('leaderboard.index', ['timeframe' => 'week', 'category' => $category]) }}" class="time-pill {{ $timeframe === 'week' ? 'active' : '' }}">এই সপ্তাহ</a>
            <a href="{{ route('leaderboard.index', ['timeframe' => 'month', 'category' => $category]) }}" class="time-pill {{ $timeframe === 'month' ? 'active' : '' }}">এই মাস</a>
            <a href="{{ route('leaderboard.index', ['timeframe' => 'all', 'category' => $category]) }}" class="time-pill {{ $timeframe === 'all' ? 'active' : '' }}">সর্বকালের সেরা</a>
        </div>

        <form method="GET" action="{{ route('leaderboard.index') }}" style="display:flex; align-items:center; gap:8px;">
            <input type="hidden" name="timeframe" value="{{ $timeframe }}">
            <label style="font-size:0.85rem; font-weight:600; color:var(--text-muted);">ক্যাটাগরি:</label>
            <select name="category" onchange="this.form.submit()" style="padding:6px 12px; border-radius:8px; border:1px solid var(--border); font-size:0.9rem; background:white; font-weight:600;">
                <option value="all" {{ $category === 'all' ? 'selected' : '' }}>সকল ক্যাটাগরি</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ $category === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Top 3 Podium -->
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
                    <div style="font-size:0.8rem; color:var(--text-muted);">{{ $topResults[1]->typingTest->title ?? 'BCC Test' }}</div>
                    <div class="podium-speed">{{ $topResults[1]->net_wpm }}</div>
                    <div class="podium-wpm-label">Net WPM • {{ number_format($topResults[1]->accuracy, 1) }}% নির্ভুল</div>
                </div>
            @endif

            <!-- Rank 1 (Champion) -->
            @if(isset($topResults[0]))
                <div class="podium-card podium-1">
                    <div style="position:absolute; top:-18px; background:#f59e0b; color:white; padding:4px 14px; border-radius:20px; font-weight:800; font-size:0.8rem; box-shadow:0 4px 10px rgba(245,158,11,0.3);">
                        👑 CHAMPION
                    </div>
                    <div class="avatar-wrapper">
                        <div class="avatar-circle" style="border-color:#f59e0b; width:82px; height:82px; font-size:1.75rem;">
                            {{ strtoupper(substr($topResults[0]->user->name ?? 'U', 0, 2)) }}
                        </div>
                        <div class="rank-badge rank-1-badge" style="width:32px; height:32px;">১</div>
                    </div>
                    <div class="podium-name" style="font-size:1.3rem;">{{ $topResults[0]->user->name ?? 'পরীক্ষার্থী' }}</div>
                    <div style="font-size:0.85rem; color:var(--text-muted);">{{ $topResults[0]->typingTest->title ?? 'BCC Test' }}</div>
                    <div class="podium-speed" style="font-size:2.4rem; color:#d97706;">{{ $topResults[0]->net_wpm }}</div>
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
                    <div style="font-size:0.8rem; color:var(--text-muted);">{{ $topResults[2]->typingTest->title ?? 'BCC Test' }}</div>
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
                        <td style="text-align:center; font-weight:800; font-size:1.1rem;">
                            @if($idx === 0) 🥇
                            @elseif($idx === 1) 🥈
                            @elseif($idx === 2) 🥉
                            @else #{{ $idx + 1 }}
                            @endif
                        </td>
                        <td>
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="width:34px; height:34px; border-radius:50%; background:#eff6ff; color:var(--primary); display:flex; align-items:center; justify-content:center; font-weight:700; font-size:0.85rem;">
                                    {{ strtoupper(substr($res->user->name ?? 'U', 0, 2)) }}
                                </div>
                                <div>
                                    <div style="font-weight:700;">{{ $res->user->name ?? 'শিক্ষার্থী' }}</div>
                                    <div style="font-size:0.75rem; color:var(--text-muted);">ID: #{{ $res->user->id ?? 0 }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="font-weight:600;">{{ $res->typingTest->title ?? 'BCC Typing Test' }}</div>
                            <div style="font-size:0.8rem; color:var(--text-muted);">{{ $res->typingTest->category ?? 'Government' }}</div>
                        </td>
                        <td style="font-weight:600;">{{ $res->gross_wpm }}</td>
                        <td style="color:#dc2626; font-weight:600;">{{ $res->errors }} টি</td>
                        <td>
                            <span style="background:#eff6ff; color:var(--primary); padding:4px 10px; border-radius:6px; font-weight:800; font-size:1.05rem;">
                                {{ $res->net_wpm }} WPM
                            </span>
                        </td>
                        <td>
                            <span style="font-weight:700; color:{{ $res->accuracy >= 95 ? '#16a34a' : '#d97706' }};">
                                {{ number_format($res->accuracy, 1) }}%
                            </span>
                        </td>
                        <td style="color:var(--text-muted); font-size:0.85rem;">
                            {{ $res->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center; padding:3rem; color:var(--text-muted);">
                            কোনো লিডারবোর্ড রেকর্ড পাওয়া যায়নি।
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
