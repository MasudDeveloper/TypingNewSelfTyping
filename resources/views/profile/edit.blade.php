@extends('layouts.student')

@section('title', 'শিক্ষার্থী প্রোফাইল ও টাইপিং পারফরম্যান্স - SelfTyping.com')

@push('styles')
<style>
    .profile-container {
        display: flex;
        flex-direction: column;
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Top Profile Overview Banner */
    .profile-hero-card {
        background: linear-gradient(135deg, rgba(30, 58, 138, 0.45) 0%, rgba(14, 21, 38, 0.95) 100%);
        border: 1px solid rgba(59, 130, 246, 0.25);
        border-radius: 24px;
        padding: 2.2rem;
        box-shadow: 0 15px 35px -10px rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(16px);
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
    }
    .profile-hero-card::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.18) 0%, transparent 70%);
        pointer-events: none;
    }

    .user-info-cluster {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }
    .avatar-large {
        width: 88px;
        height: 88px;
        border-radius: 20px;
        background: linear-gradient(135deg, #2563eb, #10b981);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.4);
        border: 2px solid rgba(255, 255, 255, 0.15);
        flex-shrink: 0;
    }
    .user-text-details h2 {
        font-size: 1.6rem;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 0.35rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .user-text-details .user-email {
        font-size: 0.92rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 6px;
        font-family: var(--font-en);
        margin-bottom: 0.75rem;
    }
    .user-badge-row {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    .status-pill {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .status-pill.active {
        background: rgba(16, 185, 129, 0.15);
        color: #34d399;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }
    .status-pill.inactive {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }
    .status-pill.role {
        background: rgba(59, 130, 246, 0.15);
        color: #93c5fd;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    /* Stats Ribbon */
    .profile-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.2rem;
    }
    .profile-stat-box {
        background: rgba(14, 21, 38, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 18px;
        padding: 1.4rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 10px 25px -10px rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(14px);
    }
    .stat-icon-wrap {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    .stat-icon-wrap.blue { background: rgba(37, 99, 235, 0.15); color: #60a5fa; }
    .stat-icon-wrap.emerald { background: rgba(16, 185, 129, 0.15); color: #34d399; }
    .stat-icon-wrap.amber { background: rgba(245, 158, 11, 0.15); color: #fbbf24; }
    .stat-icon-wrap.purple { background: rgba(139, 92, 246, 0.15); color: #c084fc; }

    .stat-data .val {
        font-size: 1.45rem;
        font-weight: 800;
        color: #ffffff;
        font-family: var(--font-en);
        line-height: 1.1;
    }
    .stat-data .lbl {
        font-size: 0.78rem;
        color: #94a3b8;
        margin-top: 3px;
    }

    /* Forms 2-Column Layout */
    .profile-forms-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    .form-card {
        background: rgba(14, 21, 38, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        padding: 2.2rem;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(14px);
    }
    .form-card-header {
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }
    .form-card-header h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #ffffff;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .form-card-header p {
        font-size: 0.85rem;
        color: #94a3b8;
        margin-top: 4px;
    }

    .input-group {
        margin-bottom: 1.25rem;
    }
    .input-label {
        display: block;
        font-size: 0.88rem;
        font-weight: 600;
        margin-bottom: 6px;
        color: #cbd5e1;
    }
    .cyber-input {
        width: 100%;
        padding: 0.85rem 1rem;
        background: #090e1a;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        color: #ffffff;
        font-size: 0.95rem;
        outline: none;
        transition: all 0.2s;
    }
    .cyber-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.25);
    }

    .btn-cyber-submit {
        background: linear-gradient(135deg, var(--primary), #1d4ed8);
        color: white;
        padding: 0.85rem 1.8rem;
        border-radius: 10px;
        font-size: 0.95rem;
        font-weight: 700;
        border: 1px solid rgba(255, 255, 255, 0.15);
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
    }
    .btn-cyber-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(37, 99, 235, 0.5);
    }

    .status-alert {
        padding: 0.75rem 1rem;
        border-radius: 10px;
        margin-bottom: 1.2rem;
        font-size: 0.88rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .status-alert.success {
        background: rgba(16, 185, 129, 0.15);
        color: #34d399;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    /* Recent Test Activity Table */
    .history-card {
        background: rgba(14, 21, 38, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(14px);
    }
    .history-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
    }
    .history-table th {
        background: rgba(255, 255, 255, 0.02);
        padding: 12px 16px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        color: #94a3b8;
        text-align: left;
        font-weight: 600;
    }
    .history-table td {
        padding: 12px 16px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        color: #cbd5e1;
    }
    .history-table tr:hover td {
        background: rgba(255, 255, 255, 0.02);
    }

    @media (max-width: 992px) {
        .profile-hero-card { flex-direction: column; gap: 1.5rem; align-items: flex-start; }
        .profile-stats-grid { grid-template-columns: repeat(2, 1fr); }
        .profile-forms-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 600px) {
        .profile-stats-grid { grid-template-columns: 1fr; }
        .user-info-cluster { flex-direction: column; align-items: flex-start; }
    }
</style>
@endpush

@section('content')
<div class="profile-container">

    <!-- Top Profile Hero Banner -->
    <div class="profile-hero-card">
        <div class="user-info-cluster">
            <div class="avatar-large">
                <i class="ph-fill ph-user"></i>
            </div>
            <div class="user-text-details">
                <h2>{{ $user->name }}</h2>
                <div class="user-email">
                    <i class="ph-bold ph-envelope-simple"></i> {{ $user->email }}
                </div>
                <div class="user-badge-row">
                    <span class="status-pill role">
                        <i class="ph-bold ph-shield-check"></i> {{ ucfirst($user->role) }}
                    </span>
                    @if($user->subscription_expires_at && $user->subscription_expires_at > now())
                        <span class="status-pill active">
                            <i class="ph-fill ph-check-circle"></i> প্রিমিয়াম অ্যাক্টিভ ({{ $user->subscription_expires_at->diffInDays(now()) }} দিন বাকি)
                        </span>
                    @else
                        <span class="status-pill inactive">
                            <i class="ph-bold ph-warning-circle"></i> ফ্রি মোড
                        </span>
                    @endif
                    <span class="status-pill active" style="background:rgba(56,189,248,0.15); color:#38bdf8; border-color:rgba(56,189,248,0.3);">
                        <i class="ph-fill ph-wallet"></i> ব্যালেন্স: ৳{{ number_format($user->wallet_balance ?? 0, 2) }}
                    </span>
                </div>
            </div>
        </div>

        <div>
            <a href="{{ route('packages.index') }}" class="btn-cyber-submit">
                <i class="ph-bold ph-lightning"></i> প্যাকেজ রিনিউ / ওয়ালেট রিচার্জ
            </a>
        </div>
    </div>

    <!-- Live Performance Stats Ribbon -->
    <div class="profile-stats-grid">
        <div class="profile-stat-box">
            <div class="stat-icon-wrap blue">
                <i class="ph-fill ph-keyboard"></i>
            </div>
            <div class="stat-data">
                <div class="val">{{ $totalTestsTaken }} টি</div>
                <div class="lbl">মোট সম্পন্নকৃত পরীক্ষা</div>
            </div>
        </div>

        <div class="profile-stat-box">
            <div class="stat-icon-wrap emerald">
                <i class="ph-fill ph-gauge"></i>
            </div>
            <div class="stat-data">
                <div class="val">{{ $avgWpm }} WPM</div>
                <div class="lbl">গড় টাইপিং স্পিড (Avg WPM)</div>
            </div>
        </div>

        <div class="profile-stat-box">
            <div class="stat-icon-wrap amber">
                <i class="ph-fill ph-trophy"></i>
            </div>
            <div class="stat-data">
                <div class="val">{{ $maxWpm }} WPM</div>
                <div class="lbl">সর্বোচ্চ গতি (Top Speed)</div>
            </div>
        </div>

        <div class="profile-stat-box">
            <div class="stat-icon-wrap purple">
                <i class="ph-fill ph-target"></i>
            </div>
            <div class="stat-data">
                <div class="val">{{ $avgAccuracy }}%</div>
                <div class="lbl">গড় নির্ভুলতা (Accuracy)</div>
            </div>
        </div>
    </div>

    <!-- Forms 2-Column: Personal Info & Password -->
    <div class="profile-forms-grid">
        
        <!-- Update Profile Information Form -->
        <div class="form-card">
            <div class="form-card-header">
                <h3><i class="ph-fill ph-user-gear" style="color:var(--primary-light);"></i> ব্যক্তিগত তথ্য আপডেট</h3>
                <p>আপনার পুরো নাম এবং যোগাযোগের ইমেইল ঠিকানা পরিবর্তন করুন।</p>
            </div>

            @if (session('status') === 'profile-updated')
                <div class="status-alert success">
                    <i class="ph-bold ph-check-circle"></i> আপনার প্রোফাইল তথ্য সফলভাবে আপডেট হয়েছে!
                </div>
            @endif

            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="input-group">
                    <label class="input-label" for="name">শিক্ষার্থীর পুরো নাম</label>
                    <input id="name" name="name" type="text" class="cyber-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                    @if($errors->get('name'))
                        <div style="color:#f87171; font-size:0.8rem; margin-top:4px;">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <div class="input-group">
                    <label class="input-label" for="email">ইমেইল ঠিকানা</label>
                    <input id="email" name="email" type="email" class="cyber-input" value="{{ old('email', $user->email) }}" required autocomplete="username">
                    @if($errors->get('email'))
                        <div style="color:#f87171; font-size:0.8rem; margin-top:4px;">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn-cyber-submit">
                    <i class="ph-bold ph-floppy-disk"></i> পরিবর্তন সংরক্ষণ করুন
                </button>
            </form>
        </div>

        <!-- Update Password Form -->
        <div class="form-card">
            <div class="form-card-header">
                <h3><i class="ph-fill ph-lock-key" style="color:var(--primary-light);"></i> পাসওয়ার্ড পরিবর্তন</h3>
                <p>আপনার অ্যাকাউন্টটি নিরাপদ রাখতে নিয়মিত শক্তিশালী পাসওয়ার্ড ব্যবহার করুন।</p>
            </div>

            @if (session('status') === 'password-updated')
                <div class="status-alert success">
                    <i class="ph-bold ph-check-circle"></i> পাসওয়ার্ড সফলভাবে পরিবর্তিত হয়েছে!
                </div>
            @endif

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="input-group">
                    <label class="input-label" for="update_password_current_password">বর্তমান পাসওয়ার্ড</label>
                    <input id="update_password_current_password" name="current_password" type="password" class="cyber-input" autocomplete="current-password">
                    @if($errors->updatePassword->get('current_password'))
                        <div style="color:#f87171; font-size:0.8rem; margin-top:4px;">{{ $errors->updatePassword->first('current_password') }}</div>
                    @endif
                </div>

                <div class="input-group">
                    <label class="input-label" for="update_password_password">নতুন পাসওয়ার্ড</label>
                    <input id="update_password_password" name="password" type="password" class="cyber-input" autocomplete="new-password">
                    @if($errors->updatePassword->get('password'))
                        <div style="color:#f87171; font-size:0.8rem; margin-top:4px;">{{ $errors->updatePassword->first('password') }}</div>
                    @endif
                </div>

                <div class="input-group">
                    <label class="input-label" for="update_password_password_confirmation">নতুন পাসওয়ার্ড নিশ্চিত করুন</label>
                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="cyber-input" autocomplete="new-password">
                    @if($errors->updatePassword->get('password_confirmation'))
                        <div style="color:#f87171; font-size:0.8rem; margin-top:4px;">{{ $errors->updatePassword->first('password_confirmation') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn-cyber-submit">
                    <i class="ph-bold ph-shield-check"></i> পাসওয়ার্ড আপডেট করুন
                </button>
            </form>
        </div>
    </div>

    <!-- Recent Test Performance History -->
    <div class="history-card">
        <div class="form-card-header">
            <h3><i class="ph-fill ph-clock-counter-clockwise" style="color:var(--primary-light);"></i> সাম্প্রতিক পরীক্ষার ইতিহাস</h3>
            <p>আপনার শেষ কয়েকটি টাইপিং টেস্টের গতি, নির্ভুলতা ও পাস/ফেল স্ট্যাটাস।</p>
        </div>

        @if($recentResults->count() > 0)
            <table class="history-table">
                <thead>
                    <tr>
                        <th>তারিখ ও সময়</th>
                        <th>টেস্টের নাম</th>
                        <th>ভাষা / ফন্ট</th>
                        <th>নেট স্পিড</th>
                        <th>নির্ভুলতা (Accuracy)</th>
                        <th>ফলাফল</th>
                        <th>অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentResults as $res)
                        <tr>
                            <td>{{ $res->created_at->format('d M Y, h:i A') }}</td>
                            <td><strong>{{ $res->typingTest->title ?? 'কাস্টম টেস্ট' }}</strong></td>
                            <td>
                                <span class="status-pill role" style="font-size:0.75rem;">
                                    {{ strtoupper($res->typingTest->language ?? 'BN') }}
                                </span>
                            </td>
                            <td><strong style="color:#38bdf8; font-family:var(--font-en);">{{ $res->net_wpm }} WPM</strong></td>
                            <td><span style="color:#cbd5e1; font-family:var(--font-en);">{{ $res->accuracy }}%</span></td>
                            <td>
                                @if($res->is_passed)
                                    <span class="status-pill active"><i class="ph-bold ph-check"></i> উত্তীর্ণ (PASSED)</span>
                                @else
                                    <span class="status-pill inactive"><i class="ph-bold ph-x"></i> অকৃতকার্য</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('test.result', $res->id) }}" style="color:var(--primary-light); text-decoration:none; font-weight:700; font-size:0.85rem;">
                                    মার্কশিট <i class="ph ph-arrow-square-out"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="text-align:center; padding:2.5rem; color:#64748b;">
                <i class="ph-fill ph-keyboard" style="font-size:3rem; margin-bottom:0.8rem; color:#334155;"></i>
                <p>এখনও কোনো টেস্ট সম্পন্ন করেননি। ড্যাশবোর্ড থেকে আজই যেকোনো একটি ল্যাব টেস্ট শুরু করুন!</p>
                <a href="{{ route('dashboard') }}" class="btn-cyber-submit" style="margin-top:1rem;">
                    <i class="ph-bold ph-play"></i> টেস্ট শুরু করুন
                </a>
            </div>
        @endif
    </div>

</div>
@endsection
