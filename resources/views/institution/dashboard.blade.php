@extends('layouts.institution')

@section('title', 'ড্যাশবোর্ড ওভারভিউ')
@section('page_title', 'ড্যাশবোর্ড ওভারভিউ')
@section('page_subtitle', 'কোচিংয়ের সার্বিক পরিসংখ্যান ও শিক্ষার্থী পারফরম্যান্স ট্র্যাকিং')

@section('top_actions')
    <a href="{{ route('institution.students.importPage') }}" class="btn-outline">
        <i class="ph-bold ph-upload-simple"></i> বাল্ক ইমপোর্ট
    </a>
    <a href="{{ route('institution.report') }}" target="_blank" class="btn-cyber">
        <i class="ph-bold ph-printer"></i> রেজাল্ট শিট প্রিন্ট
    </a>
@endsection

@section('styles')
<style>
    /* Plan Banner */
    .plan-status-strip {
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.16), rgba(16, 185, 129, 0.1));
        border: 1px solid rgba(59, 130, 246, 0.3);
        border-radius: 20px;
        padding: 1.6rem 2.2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        backdrop-filter: blur(14px);
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.4);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
    }
    .stat-card {
        background: var(--surface-glass);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 1.6rem;
        display: flex;
        align-items: center;
        gap: 1.25rem;
        backdrop-filter: blur(14px);
        box-shadow: 0 10px 25px -10px rgba(0, 0, 0, 0.5);
        transition: transform 0.2s;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        border-color: rgba(255, 255, 255, 0.15);
    }
    .stat-icon {
        width: 54px; height: 54px;
        border-radius: 16px;
        background: rgba(37, 99, 235, 0.15);
        color: var(--primary-light);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.7rem;
        flex-shrink: 0;
    }
    .stat-icon.green { background: rgba(16, 185, 129, 0.15); color: #34d399; }
    .stat-icon.blue { background: rgba(56, 189, 248, 0.15); color: #38bdf8; }
    .stat-icon.amber { background: rgba(245, 158, 11, 0.15); color: #fde047; }

    .stat-details h4 { font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; }
    .stat-details .val { font-size: 2rem; font-weight: 800; color: white; font-family: 'JetBrains Mono', monospace; line-height: 1.1; margin-top: 4px; }

    /* Split Grid */
    .overview-split {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
    }

    .top-rank-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 14px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.05);
        margin-bottom: 10px;
    }
    .top-rank-badge {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.9rem;
    }
    .rank-1 { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
    .rank-2 { background: linear-gradient(135deg, #94a3b8, #64748b); color: white; }
    .rank-3 { background: linear-gradient(135deg, #b45309, #78350f); color: white; }
    .rank-other { background: rgba(255, 255, 255, 0.08); color: var(--text-muted); }

    @media (max-width: 1200px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .overview-split { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

    <!-- Subscription & Package Banner -->
    <div class="plan-status-strip">
        <div>
            <div style="font-size:0.8rem; color:var(--text-muted); text-transform:uppercase; font-weight:800; letter-spacing:1px;">বর্তমান সক্রিয় প্যাকেজ</div>
            <h3 style="font-size:1.4rem; font-weight:800; color:#ffffff; margin:4px 0;">
                {{ $institution->package_name }}
            </h3>
            <div style="font-size:0.88rem; color:#94a3b8; display:flex; align-items:center; gap:8px;">
                <span>শিক্ষার্থী ধারণক্ষমতা:</span>
                <strong style="color:white;">{{ $totalStudents }} / {{ $institution->student_limit }} জন</strong>
                <span style="color:rgba(255,255,255,0.2);">•</span>
                <span>মোট ব্যাচ: <strong style="color:#38bdf8;">{{ count($batches) }} টি</strong></span>
            </div>
        </div>
        <div style="text-align:right;">
            @if($institution->subscription_expires_at)
                <div style="font-size:0.8rem; color:var(--text-muted); text-transform:uppercase; font-weight:800; letter-spacing:1px;">সাবস্ক্রিপশন মেয়াদ</div>
                <div style="font-size:1.25rem; font-weight:800; color:{{ $institution->isSubscriptionActive() ? '#34d399' : '#f87171' }};">
                    {{ $institution->subscription_expires_at->format('d M Y') }}
                </div>
                <div style="font-size:0.82rem; color:var(--text-muted); margin-top:2px;">
                    @if($institution->isSubscriptionActive())
                        <span class="pill-badge green" style="padding:2px 8px; font-size:0.75rem;">
                            <i class="ph-bold ph-clock"></i> {{ $institution->subscription_expires_at->diffInDays(now()) }} দিন বাকি
                        </span>
                    @else
                        <span class="pill-badge red" style="padding:2px 8px; font-size:0.75rem;">
                            <i class="ph-bold ph-warning"></i> মেয়াদ শেষ
                        </span>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- 4 Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="ph-fill ph-users-three"></i></div>
            <div class="stat-details">
                <h4>মোট নিবন্ধিত শিক্ষার্থী</h4>
                <div class="val">{{ $totalStudents }}</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green"><i class="ph-fill ph-speedometer"></i></div>
            <div class="stat-details">
                <h4>গড় নেট স্পিড (WPM)</h4>
                <div class="val">{{ $avgSpeed }}</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon blue"><i class="ph-fill ph-files"></i></div>
            <div class="stat-details">
                <h4>কাস্টম টেস্ট সংখ্যা</h4>
                <div class="val">{{ $totalTests }}</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon amber"><i class="ph-fill ph-seal-check"></i></div>
            <div class="stat-details">
                <h4>বিসিসি পরীক্ষার পাস রেট</h4>
                <div class="val">{{ $passRate }}%</div>
            </div>
        </div>
    </div>

    <!-- Split Section: Recent Activity + Top Speedsters -->
    <div class="overview-split">
        
        <!-- Left: Recent Results -->
        <div class="glass-card">
            <div class="glass-card-header">
                <h3><i class="ph-fill ph-clock-counter-clockwise" style="color:var(--primary-light);"></i> সাম্প্রতিক পরীক্ষার ফলাফল</h3>
                <a href="{{ route('institution.report') }}" target="_blank" class="btn-outline" style="padding:0.45rem 0.9rem; font-size:0.82rem;">
                    <i class="ph-bold ph-arrow-up-right"></i> পূর্ণাঙ্গ রিপোর্ট
                </a>
            </div>

            <div class="data-table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>শিক্ষার্থী</th>
                            <th>ব্যাচ</th>
                            <th>পরীক্ষা</th>
                            <th>নেট WPM</th>
                            <th>অ্যাকুরেসি</th>
                            <th>ফলাফল</th>
                            <th>সময়</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($results as $res)
                            <tr>
                                <td><strong>{{ $res->user->name ?? 'Student' }}</strong></td>
                                <td><span class="pill-badge">{{ $res->user->batch_name ?? 'সাধারণ' }}</span></td>
                                <td>{{ Str::limit($res->typingTest->title ?? 'Test', 25) }}</td>
                                <td style="font-family:'JetBrains Mono', monospace; font-weight:800; color:#38bdf8;">{{ $res->net_wpm }} WPM</td>
                                <td style="color:#34d399; font-weight:700;">{{ $res->accuracy }}%</td>
                                <td>
                                    <span class="{{ $res->is_passed ? 'badge-pass' : 'badge-fail' }}">
                                        {{ $res->is_passed ? 'PASS' : 'FAIL' }}
                                    </span>
                                </td>
                                <td style="color:var(--text-muted); font-size:0.82rem;">{{ $res->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align:center; color:var(--text-muted); padding:2rem;">এখনও কোনো পরীক্ষার ফলাফল সাবমিট হয়নি।</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right: Top 5 Performers & Quick Navigation -->
        <div style="display:flex; flex-direction:column; gap:1.5rem;">
            
            <div class="glass-card">
                <div class="glass-card-header">
                    <h3><i class="ph-fill ph-trophy" style="color:#fbbf24;"></i> শীর্ষ গতিময় শিক্ষার্থী</h3>
                </div>

                <div>
                    @forelse($topPerformers as $idx => $tp)
                        <div class="top-rank-item">
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div class="top-rank-badge {{ $idx === 0 ? 'rank-1' : ($idx === 1 ? 'rank-2' : ($idx === 2 ? 'rank-3' : 'rank-other')) }}">
                                    #{{ $idx + 1 }}
                                </div>
                                <div>
                                    <h4 style="font-size:0.92rem; font-weight:700; color:white;">{{ $tp->user->name ?? 'Student' }}</h4>
                                    <span style="font-size:0.75rem; color:var(--text-muted);">{{ $tp->user->batch_name ?? 'সাধারণ ব্যাচ' }}</span>
                                </div>
                            </div>
                            <div style="text-align:right;">
                                <div style="font-size:1.15rem; font-weight:800; color:#38bdf8; font-family:'JetBrains Mono', monospace;">
                                    {{ $tp->net_wpm }} <small style="font-size:0.7rem;">WPM</small>
                                </div>
                                <span style="font-size:0.75rem; color:#34d399; font-weight:700;">{{ $tp->accuracy }}% Acc</span>
                            </div>
                        </div>
                    @empty
                        <div style="text-align:center; color:var(--text-muted); padding:1.5rem 0;">এখনও ডেটা প্রস্তুত হয়নি।</div>
                    @endforelse
                </div>
            </div>

            <!-- Quick Action Hub -->
            <div class="glass-card" style="background:linear-gradient(135deg, rgba(14,21,38,0.9), rgba(30,41,59,0.7));">
                <h4 style="font-size:0.95rem; font-weight:700; color:white; margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                    <i class="ph-bold ph-lightning" style="color:#f59e0b;"></i> দ্রুত অ্যাকশন
                </h4>
                <div style="display:flex; flex-direction:column; gap:8px;">
                    <a href="{{ route('institution.students.index') }}" class="btn-outline" style="justify-content:space-between; width:100%;">
                        <span><i class="ph ph-user-plus"></i> শিক্ষার্থী যোগ ও ব্যবস্থাপনা</span>
                        <i class="ph ph-caret-right"></i>
                    </a>
                    <a href="{{ route('institution.batches.index') }}" class="btn-outline" style="justify-content:space-between; width:100%;">
                        <span><i class="ph ph-users-three"></i> ব্যাচ পরিসংখ্যান দেখুন</span>
                        <i class="ph ph-caret-right"></i>
                    </a>
                    <a href="{{ route('institution.tests.index') }}" class="btn-outline" style="justify-content:space-between; width:100%;">
                        <span><i class="ph ph-plus-circle"></i> নতুন কাস্টম টেস্ট তৈরি</span>
                        <i class="ph ph-caret-right"></i>
                    </a>
                    <a href="{{ route('institution.settings') }}" class="btn-outline" style="justify-content:space-between; width:100%;">
                        <span><i class="ph ph-paint-brush"></i> কোচিং লোগো ও সিল পরিবর্তন</span>
                        <i class="ph ph-caret-right"></i>
                    </a>
                </div>
            </div>

        </div>

    </div>

@endsection
