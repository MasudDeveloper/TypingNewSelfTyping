<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'কোচিং পোর্টাল') - {{ $institution->name }} | SelfTyping.com</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        :root {
            --bg: #070b14;
            --surface: #0e1526;
            --surface-hover: #152038;
            --surface-glass: rgba(14, 21, 38, 0.75);
            --primary: #2563eb;
            --primary-light: #60a5fa;
            --accent: #10b981;
            --accent-light: #34d399;
            --warning: #f59e0b;
            --danger: #ef4444;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border: rgba(255, 255, 255, 0.08);
            --sidebar-width: 280px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Hind Siliguri', 'Inter', sans-serif; }

        body {
            background: var(--bg);
            color: var(--text-main);
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Ambient Orbs Background */
        .ambient-bg {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(130px);
            opacity: 0.16;
            transition: all 1s ease;
        }
        .orb-1 { width: 550px; height: 550px; background: #2563eb; top: -120px; left: 10%; }
        .orb-2 { width: 500px; height: 500px; background: #10b981; bottom: -80px; right: 8%; }
        .orb-3 { width: 380px; height: 380px; background: #6366f1; top: 40%; right: 25%; opacity: 0.1; }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: #090e1c;
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: relative;
            z-index: 20;
        }
        .sidebar-brand {
            padding: 1.4rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid var(--border);
            background: rgba(14, 21, 38, 0.7);
        }
        .brand-logo-img {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            object-fit: cover;
            border: 1.5px solid rgba(255, 255, 255, 0.15);
            background: #0b1329;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.3);
        }
        .brand-icon-fallback {
            width: 46px;
            height: 46px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            color: white;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.4);
            flex-shrink: 0;
        }
        .brand-text {
            overflow: hidden;
        }
        .brand-text h2 {
            font-size: 1.05rem;
            font-weight: 800;
            color: white;
            line-height: 1.25;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .brand-text span {
            font-size: 0.72rem;
            color: #38bdf8;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-menu {
            list-style: none;
            padding: 1.2rem 0;
            flex: 1;
            overflow-y: auto;
        }
        .sidebar-section-title {
            padding: 0.5rem 1.6rem;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 800;
            color: #475569;
        }
        .sidebar-link {
            padding: 0.8rem 1.6rem;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.93rem;
            font-weight: 600;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border-left: 3px solid transparent;
            margin: 2px 0;
        }
        .sidebar-link i {
            font-size: 1.25rem;
            transition: 0.2s;
        }
        .sidebar-link:hover {
            background: rgba(37, 99, 235, 0.08);
            color: white;
            border-left-color: rgba(37, 99, 235, 0.4);
        }
        .sidebar-link.active {
            background: linear-gradient(90deg, rgba(37, 99, 235, 0.18), transparent);
            color: white;
            border-left-color: var(--primary-light);
        }
        .sidebar-link.active i {
            color: var(--primary-light);
            transform: scale(1.1);
        }

        /* Sidebar Footer */
        .sidebar-footer {
            padding: 1.2rem 1.5rem;
            border-top: 1px solid var(--border);
            background: rgba(14, 21, 38, 0.4);
        }
        .subscription-badge {
            background: rgba(16, 185, 129, 0.12);
            border: 1px solid rgba(16, 185, 129, 0.25);
            padding: 8px 12px;
            border-radius: 10px;
            font-size: 0.78rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        /* Main Container */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
            z-index: 10;
        }

        .top-navbar {
            height: 72px;
            background: rgba(14, 21, 38, 0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }
        .page-title-box h1 {
            font-size: 1.25rem;
            font-weight: 800;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .page-title-box p {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .content-scroll {
            flex: 1;
            overflow-y: auto;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        /* Reusable UI Components */
        .glass-card {
            background: var(--surface-glass);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 1.8rem;
            backdrop-filter: blur(16px);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
        }
        .glass-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }
        .glass-card-header h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Buttons */
        .btn-cyber {
            background: linear-gradient(135deg, var(--primary), #1d4ed8);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 0.75rem 1.6rem;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.92rem;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-cyber:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.5);
        }

        .btn-cyber-success {
            background: linear-gradient(135deg, #059669, #10b981);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 0.75rem 1.6rem;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.92rem;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35);
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-cyber-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.5);
        }

        .btn-outline {
            background: rgba(255, 255, 255, 0.04);
            color: white;
            border: 1px solid var(--border);
            padding: 0.65rem 1.3rem;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.88rem;
            transition: 0.2s;
            cursor: pointer;
        }
        .btn-outline:hover {
            background: rgba(37, 99, 235, 0.15);
            border-color: var(--primary);
            color: #60a5fa;
        }

        /* Form Controls */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }
        .form-group {
            margin-bottom: 0.5rem;
        }
        .form-group.full {
            grid-column: span 2;
        }
        .form-group label {
            display: block;
            font-size: 0.88rem;
            font-weight: 600;
            margin-bottom: 6px;
            color: #cbd5e1;
        }
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 0.85rem 1.1rem;
            background: #090e1a;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: white;
            font-size: 0.95rem;
            outline: none;
            transition: 0.2s;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.25);
            background: #0d1424;
        }

        /* Tables */
        .data-table-wrap {
            overflow-x: auto;
            border-radius: 14px;
            border: 1px solid var(--border);
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }
        .data-table th {
            background: rgba(255, 255, 255, 0.03);
            padding: 14px 18px;
            border-bottom: 1px solid var(--border);
            color: var(--text-muted);
            text-align: left;
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .data-table td {
            padding: 13px 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
            color: var(--text-main);
        }
        .data-table tr:hover td {
            background: rgba(255, 255, 255, 0.02);
        }

        /* Badges */
        .pill-badge {
            background: rgba(56, 189, 248, 0.12);
            color: #38bdf8;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 700;
            border: 1px solid rgba(56, 189, 248, 0.25);
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .pill-badge.green {
            background: rgba(16, 185, 129, 0.12);
            color: #34d399;
            border-color: rgba(16, 185, 129, 0.25);
        }
        .pill-badge.amber {
            background: rgba(245, 158, 11, 0.12);
            color: #fbbf24;
            border-color: rgba(245, 158, 11, 0.25);
        }
        .pill-badge.red {
            background: rgba(239, 68, 68, 0.12);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.25);
        }

        .badge-pass { background: rgba(16, 185, 129, 0.2); color: #34d399; padding: 4px 10px; border-radius: 6px; font-weight: 800; font-size: 0.78rem; }
        .badge-fail { background: rgba(239, 68, 68, 0.2); color: #f87171; padding: 4px 10px; border-radius: 6px; font-weight: 800; font-size: 0.78rem; }

        /* Alerts */
        .alert-box {
            padding: 1rem 1.4rem;
            border-radius: 14px;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: fadeIn 0.3s ease;
        }
        .alert-success { background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.4); color: #34d399; }
        .alert-danger { background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.4); color: #f87171; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 1024px) {
            .form-grid { grid-template-columns: 1fr; }
            .form-group.full { grid-column: span 1; }
        }
    </style>
    @yield('styles')
</head>
<body>

    <div class="ambient-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <!-- Sidebar Navigation -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            @if($institution->logo_path)
                <img src="{{ $institution->logo_path }}" alt="Logo" class="brand-logo-img">
            @else
                <div class="brand-icon-fallback">
                    <i class="ph-fill ph-chalkboard-teacher"></i>
                </div>
            @endif
            <div class="brand-text">
                <h2>{{ $institution->name }}</h2>
                <span>{{ $institution->tagline ?? 'Coaching Lab Portal' }}</span>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li class="sidebar-section-title">মূল মেন্যু</li>
            <li>
                <a href="{{ route('institution.dashboard') }}" class="sidebar-link {{ request()->routeIs('institution.dashboard') ? 'active' : '' }}">
                    <i class="ph ph-squares-four"></i> ড্যাশবোর্ড ওভারভিউ
                </a>
            </li>
            <li>
                <a href="{{ route('institution.students.index') }}" class="sidebar-link {{ request()->routeIs('institution.students.index') ? 'active' : '' }}">
                    <i class="ph ph-student"></i> শিক্ষার্থী ব্যবস্থাপনা
                </a>
            </li>
            <li>
                <a href="{{ route('institution.students.importPage') }}" class="sidebar-link {{ request()->routeIs('institution.students.importPage') ? 'active' : '' }}">
                    <i class="ph ph-file-arrow-up"></i> বাল্ক ইমপোর্ট ও এক্সপোর্ট
                </a>
            </li>
            <li>
                <a href="{{ route('institution.batches.index') }}" class="sidebar-link {{ request()->routeIs('institution.batches.index') ? 'active' : '' }}">
                    <i class="ph ph-users-three"></i> ব্যাচ ও শিডিউল
                </a>
            </li>

            <li class="sidebar-section-title" style="margin-top:0.8rem;">পরীক্ষা ও রিপোর্ট</li>
            <li>
                <a href="{{ route('institution.tests.index') }}" class="sidebar-link {{ request()->routeIs('institution.tests.index') ? 'active' : '' }}">
                    <i class="ph ph-keyboard"></i> কাস্টম টেস্ট ও প্রশ্ন
                </a>
            </li>
            <li>
                <a href="{{ route('institution.report') }}" target="_blank" class="sidebar-link">
                    <i class="ph ph-printer"></i> ব্যাচ রেজাল্ট শিট প্রিন্ট
                </a>
            </li>

            <li class="sidebar-section-title" style="margin-top:0.8rem;">কনফিগারেশন</li>
            <li>
                <a href="{{ route('institution.settings') }}" class="sidebar-link {{ request()->routeIs('institution.settings') ? 'active' : '' }}">
                    <i class="ph ph-paint-brush"></i> কোচিং লোগো ও ব্র্যান্ডিং
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" class="sidebar-link">
                    <i class="ph ph-arrow-u-up-left"></i> স্টুডেন্ট ভিউতে যান
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="subscription-badge">
                <span style="color:var(--text-muted); font-size:0.75rem;">প্যাকেজ স্থিতি:</span>
                @if($institution->isSubscriptionActive())
                    <span style="color:#34d399; font-weight:800;">সক্রিয়</span>
                @else
                    <span style="color:#f87171; font-weight:800;">মেয়াদোত্তীর্ণ</span>
                @endif
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button style="background:transparent; border:none; color:var(--text-muted); cursor:pointer; font-weight:600; font-size:0.88rem; display:flex; align-items:center; gap:8px; width:100%; transition:0.2s;" onmouseover="this.style.color='#f87171'" onmouseout="this.style.color='var(--text-muted)'">
                    <i class="ph ph-sign-out"></i> লগআউট করুন
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Workspace -->
    <div class="main-wrapper">
        <header class="top-navbar">
            <div class="page-title-box">
                <h1>@yield('page_title', 'ড্যাশবোর্ড')</h1>
                <p>@yield('page_subtitle', 'কোচিং ও একাডেমি ম্যানেজমেন্ট হাব')</p>
            </div>
            <div style="display:flex; align-items:center; gap:12px;">
                @yield('top_actions')
            </div>
        </header>

        <main class="content-scroll">
            @if(session('success'))
                <div class="alert-box alert-success">
                    <i class="ph-fill ph-check-circle" style="font-size:1.3rem;"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert-box alert-danger">
                    <i class="ph-fill ph-warning-circle" style="font-size:1.3rem;"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>
</html>
