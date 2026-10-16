@extends('layouts.institution')

@section('title', 'ব্যাচ ও শিডিউল ওভারভিউ')
@section('page_title', 'ব্যাচ ও শিডিউল ওভারভিউ')
@section('page_subtitle', 'প্রতিটি ব্যাচের শিক্ষার্থী সংখ্যা, পারফরম্যান্স মেট্রিক্স ও রিপোর্ট জেনারেশন')

@section('top_actions')
    <a href="{{ route('institution.students.index') }}" class="btn-outline">
        <i class="ph-bold ph-user-plus"></i> শিক্ষার্থী অ্যাড করুন
    </a>
    <a href="{{ route('institution.report') }}" target="_blank" class="btn-cyber">
        <i class="ph-bold ph-printer"></i> সম্পূর্ণ রেজাল্ট শিট
    </a>
@endsection

@section('styles')
<style>
    .batches-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
    }
    .batch-card {
        background: var(--surface-glass);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 1.8rem;
        backdrop-filter: blur(16px);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 10px 25px -10px rgba(0, 0, 0, 0.5);
        transition: transform 0.2s, border-color 0.2s;
    }
    .batch-card:hover {
        transform: translateY(-4px);
        border-color: rgba(59, 130, 246, 0.4);
    }
    .batch-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.25rem;
    }
    .batch-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: rgba(37, 99, 235, 0.15);
        color: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    .batch-metric-box {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        padding: 12px;
        margin: 1.25rem 0;
    }
    .batch-metric-item {
        text-align: center;
    }
    .batch-metric-item small {
        font-size: 0.72rem;
        color: var(--text-muted);
        text-transform: uppercase;
        font-weight: 700;
        display: block;
    }
    .batch-metric-item strong {
        font-size: 1.25rem;
        font-weight: 800;
        color: white;
        font-family: 'JetBrains Mono', monospace;
    }
</style>
@endsection

@section('content')

    <!-- Batch Summary -->
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h2 style="font-size:1.3rem; font-weight:800; color:white;">মোট সক্রিয় ব্যাচ ({{ count($batchStats) }} টি)</h2>
            <p style="font-size:0.85rem; color:var(--text-muted);">যেকোনো ব্যাচের রিপোর্ট প্রিন্ট করতে কার্ডের ভেতরে বাটনে চাপুন।</p>
        </div>
        <a href="{{ route('institution.students.importPage') }}" class="btn-cyber-success">
            <i class="ph-bold ph-folder-simple-plus"></i> নতুন ব্যাচে বাল্ক ইমপোর্ট
        </a>
    </div>

    <!-- Batch Cards Grid -->
    <div class="batches-grid">
        @forelse($batchStats as $bs)
            <div class="batch-card">
                <div>
                    <div class="batch-header">
                        <div class="batch-icon">
                            <i class="ph-fill ph-chalkboard"></i>
                        </div>
                        <span class="pill-badge">
                            {{ $bs['students_count'] }} জন শিক্ষার্থী
                        </span>
                    </div>

                    <h3 style="font-size:1.2rem; font-weight:800; color:white; margin-bottom:4px;">
                        {{ $bs['name'] }}
                    </h3>
                    <div style="font-size:0.8rem; color:var(--text-muted);">
                        সর্বশেষ অন্তর্ভুক্ত: <strong style="color:#cbd5e1;">{{ $bs['latest_student'] }}</strong>
                    </div>

                    <!-- Metrics -->
                    <div class="batch-metric-box">
                        <div class="batch-metric-item">
                            <small>গড় গতি (WPM)</small>
                            <strong style="color:#38bdf8;">{{ $bs['avg_speed'] }}</strong>
                        </div>
                        <div class="batch-metric-item">
                            <small>বিসিসি পাস রেট</small>
                            <strong style="color:#34d399;">{{ $bs['pass_rate'] }}%</strong>
                        </div>
                    </div>
                </div>

                <div style="display:flex; gap:8px; margin-top:0.5rem;">
                    <a href="{{ route('institution.students.index', ['batch' => $bs['name']]) }}" class="btn-outline" style="flex:1; justify-content:center; font-size:0.82rem; padding:0.6rem;">
                        <i class="ph ph-users"></i> শিক্ষার্থী তালিকা
                    </a>
                    <a href="{{ route('institution.report', ['batch' => $bs['name']]) }}" target="_blank" class="btn-cyber" style="flex:1; justify-content:center; font-size:0.82rem; padding:0.6rem;">
                        <i class="ph ph-printer"></i> রেজাল্ট শীট
                    </a>
                </div>
            </div>
        @empty
            <div class="glass-card" style="grid-column: 1 / -1; text-align:center; padding:3rem;">
                <i class="ph ph-users-three" style="font-size:3rem; color:var(--text-muted); opacity:0.5; margin-bottom:12px; display:block;"></i>
                <h3 style="color:white; font-size:1.2rem; font-weight:700;">এখনও কোনো ব্যাচ তৈরি করা হয়নি</h3>
                <p style="color:var(--text-muted); font-size:0.9rem; margin-top:4px;">
                    শিক্ষার্থী যুক্ত করার সময় ব্যাচের নাম দিলে এখানে স্বয়ংক্রিয়ভাবে ব্যাচ তৈরি হয়ে যাবে।
                </p>
                <a href="{{ route('institution.students.index') }}" class="btn-cyber" style="margin-top:1.5rem;">
                    <i class="ph-bold ph-plus"></i> প্রথম ব্যাচে শিক্ষার্থী যুক্ত করুন
                </a>
            </div>
        @endforelse
    </div>

@endsection
