@extends('layouts.superadmin')

@section('title', 'কোচিং ও সেলস প্যাকেজ')
@section('page_title', 'কোচিং প্রতিষ্ঠান ও সেলস প্যাকেজ')
@section('page_subtitle', 'নতুন কোচিং সেন্টার অনবোর্ডিং, শিক্ষার্থী আসন ক্যাপাসিটি ও সাবস্ক্রিপশন নবায়ন')

@section('top_actions')
    <a href="{{ route('admin.dashboard') }}" class="btn-outline">
        <i class="ph ph-arrow-left"></i> ওভারভিউতে ফিরুন
    </a>
@endsection

@section('content')

    <!-- Add New Institution Section -->
    <div class="glass-card" style="border-left: 4px solid var(--primary-light);">
        <div class="glass-card-header">
            <h3><i class="ph-fill ph-buildings" style="color:var(--primary-light);"></i> নতুন প্রতিষ্ঠান / কোচিং সেন্টার অনবোর্ডিং</h3>
            <span class="badge claimed">B2B Sales Portal</span>
        </div>

        <form action="{{ route('admin.institutions.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>প্রতিষ্ঠানের পুরো নাম (Institution Name)</label>
                    <input type="text" name="name" class="form-control" placeholder="যেমন: ঢাকা বিসিএস ও আইসিটি টাইপিং একাডেমি" required>
                </div>
                <div class="form-group">
                    <label>প্যাকেজ নাম (Sales Package)</label>
                    <select name="package_name" class="form-control">
                        <option value="স্টার্টার কোচিং (৩০ জন শিক্ষার্থী)">স্টার্টার কোচিং (৩০ জন শিক্ষার্থী)</option>
                        <option value="স্ট্যান্ডার্ড কোচিং (৫০ জন শিক্ষার্থী)" selected>স্ট্যান্ডার্ড কোচিং (৫০ জন শিক্ষার্থী)</option>
                        <option value="প্রো কোচিং প্যাক (১০০ জন শিক্ষার্থী)">প্রো কোচিং প্যাক (১০০ জন শিক্ষার্থী)</option>
                        <option value="আনলিমিটেড কর্পোরেট ল্যাব (৫০০ জন শিক্ষার্থী)">আনলিমিটেড কর্পোরেট ল্যাব (৫০০ জন শিক্ষার্থী)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>শিক্ষার্থী ধারণক্ষমতা (Student Limit)</label>
                    <input type="number" name="student_limit" class="form-control" value="50" required>
                </div>
                <div class="form-group">
                    <label>সাবস্ক্রিপশন মেয়াদ (মাস হিসেবে)</label>
                    <input type="number" name="duration_months" class="form-control" value="6" required>
                </div>
                <div class="form-group">
                    <label>প্রতিষ্ঠান অ্যাডমিনের পুরো নাম</label>
                    <input type="text" name="admin_name" class="form-control" placeholder="যেমন: মো: আরিফুল ইসলাম" required>
                </div>
                <div class="form-group">
                    <label>লগইন ইমেইল ঠিকানা (Admin Email)</label>
                    <input type="email" name="admin_email" class="form-control" placeholder="admin@dhakatyping.com" required>
                </div>
                <div class="form-group full">
                    <label>লগইন পাসওয়ার্ড (Admin Password)</label>
                    <input type="password" name="admin_password" class="form-control" value="123456" required>
                </div>
            </div>

            <button type="submit" class="btn-cyber" style="margin-top:1.25rem;">
                <i class="ph-bold ph-plus-circle"></i> কোচিং সেন্টার ও অ্যাডমিন অ্যাকাউন্ট তৈরি করুন
            </button>
        </form>
    </div>

    <!-- Institutions Table -->
    <div class="glass-card">
        <div class="glass-card-header">
            <h3><i class="ph-fill ph-chalkboard-teacher" style="color:var(--accent);"></i> তালিকাভুক্ত প্রতিষ্ঠানসমূহ (মোট: {{ $totalInstitutions }} টি)</h3>
            <span style="font-size:0.85rem; color:var(--text-muted);">মোট কোচিং শিক্ষার্থী: <strong style="color:white;">{{ $totalCoachingStudents }} জন</strong></span>
        </div>

        <div class="data-table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>প্রতিষ্ঠানের নাম ও স্লাগ</th>
                        <th>প্যাকেজ ও ক্যাপাসিটি</th>
                        <th>নিবন্ধিত শিক্ষার্থী</th>
                        <th>মেয়াদ শেষ হওয়ার তারিখ</th>
                        <th>সাবস্ক্রিপশন স্থিতি</th>
                        <th style="text-align:right;">মেয়াদ নবায়ন ও অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($institutions as $inst)
                        <tr>
                            <td>
                                <strong style="font-size:0.95rem; color:white;">{{ $inst->name }}</strong>
                                <div style="font-size:0.75rem; color:var(--text-muted); font-family:monospace;">{{ $inst->slug }}</div>
                            </td>
                            <td>
                                <span style="color:#38bdf8; font-weight:700;">{{ $inst->package_name }}</span>
                                <div style="font-size:0.75rem; color:var(--text-muted);">ক্যাপাসিটি: {{ $inst->student_limit }} জন</div>
                            </td>
                            <td>
                                <strong style="color:white;">{{ $inst->students_count }}</strong> / {{ $inst->student_limit }} জন
                            </td>
                            <td>
                                @if($inst->subscription_expires_at)
                                    <div style="font-weight:700; color:{{ $inst->isSubscriptionActive() ? '#34d399' : '#f87171' }};">
                                        {{ $inst->subscription_expires_at->format('d M Y') }}
                                    </div>
                                    <div style="font-size:0.75rem; color:var(--text-muted);">
                                        {{ $inst->isSubscriptionActive() ? $inst->subscription_expires_at->diffInDays(now()) . ' দিন বাকি' : 'মেয়াদ শেষ' }}
                                    </div>
                                @else
                                    <span style="color:var(--text-muted);">মেয়াদ নির্ধারণ নেই</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $inst->isSubscriptionActive() ? 'claimed' : 'pending' }}">
                                    {{ $inst->isSubscriptionActive() ? 'ACTIVE' : 'EXPIRED' }}
                                </span>
                            </td>
                            <td style="text-align:right;">
                                <form action="{{ route('admin.institutions.update', $inst->id) }}" method="POST" style="display:inline-flex; gap:6px; align-items:center;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="package_name" value="{{ $inst->package_name }}">
                                    <input type="hidden" name="student_limit" value="{{ $inst->student_limit }}">
                                    <input type="hidden" name="subscription_status" value="1">
                                    
                                    <select name="extend_months" class="form-control" style="width:105px; padding:6px 10px; font-size:0.8rem;">
                                        <option value="1">+১ মাস</option>
                                        <option value="3">+৩ মাস</option>
                                        <option value="6" selected>+৬ মাস</option>
                                        <option value="12">+১২ মাস</option>
                                    </select>
                                    <button type="submit" class="btn-action btn-approve" style="padding:7px 12px;">
                                        <i class="ph-bold ph-arrow-clockwise"></i> রিনিউ
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; color:var(--text-muted); padding:3rem;">কোনো প্রতিষ্ঠান এখনও তৈরি করা হয়নি।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:1.5rem;">
            {{ $institutions->links() }}
        </div>
    </div>

@endsection
