@extends('layouts.superadmin')

@section('title', 'সুপার অ্যাডমিন ড্যাশবোর্ড')
@section('page_title', 'সুপার অ্যাডমিন এক্সিকিউটিভ ড্যাশবোর্ড')
@section('page_subtitle', 'প্ল্যাটফর্মের আয়, শিক্ষার্থী, কোচিং সেন্টার ও সার্ভার অপারেশন হাব')

@section('top_actions')
    <a href="{{ route('admin.institutions.index') }}" class="btn-cyber">
        <i class="ph-bold ph-plus-circle"></i> নতুন কোচিং অনবোর্ডিং
    </a>
    <a href="{{ route('admin.gateway.index') }}" class="btn-outline">
        <i class="ph-bold ph-robot"></i> এসএমএস গেটওয়ে
    </a>
@endsection

@section('styles')
<style>
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
        width: 56px; height: 56px;
        border-radius: 16px;
        background: rgba(37, 99, 235, 0.15);
        color: var(--primary-light);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.7rem;
        flex-shrink: 0;
    }
    .stat-icon.green { background: rgba(16, 185, 129, 0.15); color: #34d399; }
    .stat-icon.amber { background: rgba(245, 158, 11, 0.15); color: #fde047; }
    .stat-icon.purple { background: rgba(139, 92, 246, 0.15); color: #c084fc; }

    .stat-details h4 { font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; }
    .stat-details .val { font-size: 2rem; font-weight: 800; color: white; font-family: 'JetBrains Mono', monospace; line-height: 1.1; margin-top: 4px; }

    .split-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 1.5rem;
    }
    @media (max-width: 1200px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .split-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

    <!-- 4 Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="ph-fill ph-users"></i></div>
            <div class="stat-details">
                <h4>মোট নিবন্ধিত শিক্ষার্থী</h4>
                <div class="val">{{ $totalStudents }}</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green"><i class="ph-fill ph-wallet"></i></div>
            <div class="stat-details">
                <h4>মোট সম্পন্ন রিচার্জ</h4>
                <div class="val">{{ number_format($totalRechargeSum, 0) }} ৳</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon amber"><i class="ph-fill ph-files"></i></div>
            <div class="stat-details">
                <h4>মোট পরীক্ষার প্যাসেজ</h4>
                <div class="val">{{ $totalTests }}</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon purple"><i class="ph-fill ph-chart-bar"></i></div>
            <div class="stat-details">
                <h4>মোট সম্পন্ন পরীক্ষা</h4>
                <div class="val">{{ $totalResultsCount }}</div>
            </div>
        </div>
    </div>

    <!-- Quick Pending Recharge Alert (If any) -->
    @if($pendingRecharges->count() > 0)
        <div class="glass-card" style="border-left: 4px solid #f59e0b; background:rgba(245, 158, 11, 0.05);">
            <div class="glass-card-header">
                <h3 style="color:#fbbf24;">
                    <i class="ph-fill ph-warning-octagon"></i> পেন্ডিং রিচার্জ অনুমোদন অপেক্ষা করছে ({{ $pendingRecharges->count() }} টি)
                </h3>
                <a href="{{ route('admin.gateway.index') }}" class="btn-outline" style="font-size:0.82rem; padding:0.45rem 0.9rem;">
                    সবগুলো দেখুন <i class="ph ph-arrow-right"></i>
                </a>
            </div>

            <div class="data-table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ইউজার</th>
                            <th>মেথড</th>
                            <th>টাকা</th>
                            <th>TrxID</th>
                            <th>মোবাইল নম্বর</th>
                            <th style="text-align:right;">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingRecharges as $pr)
                            <tr>
                                <td><strong>{{ $pr->user->name ?? 'User' }}</strong></td>
                                <td><span class="badge unclaimed">{{ strtoupper($pr->payment_method) }}</span></td>
                                <td><strong style="color:#34d399;">{{ $pr->amount }} ৳</strong></td>
                                <td style="font-family:'JetBrains Mono', monospace; font-weight:700; color:#38bdf8;">{{ $pr->transaction_id }}</td>
                                <td>{{ $pr->sender_number }}</td>
                                <td style="text-align:right;">
                                    <form action="{{ route('admin.recharge.approve', $pr->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-action btn-approve"><i class="ph-bold ph-check"></i> অনুমোদন</button>
                                    </form>
                                    <form action="{{ route('admin.recharge.reject', $pr->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn-action btn-reject"><i class="ph-bold ph-x"></i> বাতিল</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Split: Recent Institutions & Recent Tests -->
    <div class="split-grid">
        
        <!-- Left: Recent Coaching Centers -->
        <div class="glass-card">
            <div class="glass-card-header">
                <h3><i class="ph-fill ph-buildings" style="color:var(--primary-light);"></i> সাম্প্রতিক যুক্ত কোচিং প্রতিষ্ঠান</h3>
                <a href="{{ route('admin.institutions.index') }}" class="btn-outline" style="font-size:0.82rem; padding:0.45rem 0.9rem;">
                    সম্পূর্ণ তালিকা <i class="ph ph-arrow-right"></i>
                </a>
            </div>

            <div class="data-table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>প্রতিষ্ঠানের নাম</th>
                            <th>প্যাকেজ</th>
                            <th>শিক্ষার্থী</th>
                            <th>মেয়াদ স্থিতি</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentInstitutions as $inst)
                            <tr>
                                <td>
                                    <strong style="color:white;">{{ $inst->name }}</strong>
                                </td>
                                <td><span style="color:#38bdf8; font-weight:700; font-size:0.8rem;">{{ $inst->package_name }}</span></td>
                                <td>{{ $inst->students_count }} / {{ $inst->student_limit }} জন</td>
                                <td>
                                    <span class="badge {{ $inst->isSubscriptionActive() ? 'claimed' : 'pending' }}">
                                        {{ $inst->isSubscriptionActive() ? 'ACTIVE' : 'EXPIRED' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center; color:var(--text-muted); padding:2rem;">কোনো কোচিং প্রতিষ্ঠান নেই।</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right: Android SMS Live Feed & Gateway Status -->
        <div class="glass-card">
            <div class="glass-card-header">
                <h3><i class="ph-fill ph-broadcast" style="color:#34d399;"></i> লাইভ এসএমএস গেটওয়ে ফিড</h3>
                <a href="{{ route('admin.gateway.index') }}" class="btn-outline" style="font-size:0.82rem; padding:0.45rem 0.9rem;">
                    কনফিগ ও লগ <i class="ph ph-arrow-right"></i>
                </a>
            </div>

            <div class="data-table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>সিম / প্রেরক</th>
                            <th>টাকা</th>
                            <th>TrxID</th>
                            <th>স্ট্যাটাস</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentSmsPayments as $sms)
                            <tr>
                                <td><strong style="font-size:0.85rem;">{{ $sms->sender }}</strong></td>
                                <td><strong style="color:#34d399;">{{ $sms->amount }} ৳</strong></td>
                                <td style="font-family:'JetBrains Mono', monospace; font-size:0.8rem; color:#38bdf8;">{{ $sms->trx_id }}</td>
                                <td>
                                    <span class="badge {{ $sms->status === 'matched' ? 'claimed' : 'unclaimed' }}">
                                        {{ strtoupper($sms->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center; color:var(--text-muted); padding:2rem;">কোনো এসএমএস লগ নেই।</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
