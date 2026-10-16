<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SelfTyping.com Portal')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/bangla-fonts.css">
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    @stack('styles')
    
    <style>
        :root {
            --bg-base: #070a12;
            --bg-surface: #0e1526;
            --bg-surface-elevated: #152038;
            --bg-surface-hover: #1c2b4a;
            
            --primary: #2563eb;
            --primary-light: #60a5fa;
            --primary-hover: #1d4ed8;
            --accent: #10b981;
            --accent-hover: #059669;
            --warning: #f59e0b;
            --danger: #ef4444;
            
            --text-main: #f8fafc;
            --text-dark: #f8fafc;
            --text-muted: #94a3b8;
            --text-dim: #64748b;
            
            --border: rgba(255, 255, 255, 0.08);
            --border-hover: rgba(59, 130, 246, 0.4);
            
            --sidebar-width: 270px;
            --font-bn: 'Hind Siliguri', sans-serif;
            --font-en: 'Inter', sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background: var(--bg-base);
            color: var(--text-main);
            font-family: var(--font-bn);
            display: flex;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }

        /* Ambient Glowing Background Orbs */
        .ambient-bg {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }
        .ambient-bg .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.22;
        }
        .orb-1 { width: 500px; height: 500px; background: #2563eb; top: -150px; left: 10%; }
        .orb-2 { width: 450px; height: 450px; background: #059669; bottom: -100px; right: 5%; }
        .orb-3 { width: 350px; height: 350px; background: #7c3aed; top: 40%; left: 45%; }

        /* Left Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: #090e1c;
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: relative;
            z-index: 10;
        }

        .sidebar-brand {
            padding: 1.25rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid var(--border);
            background: rgba(14, 21, 38, 0.6);
        }
        .sidebar-brand .brand-logo-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.35rem;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
        }
        .sidebar-brand .brand-title {
            font-family: var(--font-en);
            font-size: 1.25rem;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.5px;
        }
        .sidebar-brand .brand-title span {
            color: var(--primary-light);
        }

        .sidebar-menu {
            list-style: none;
            padding: 1rem 0;
            flex: 1;
            overflow-y: auto;
        }
        .sidebar-menu::-webkit-scrollbar { width: 5px; }
        .sidebar-menu::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 4px; }

        .menu-heading {
            padding: 0.75rem 1.5rem 0.35rem 1.5rem;
            font-family: var(--font-en);
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #64748b;
            font-weight: 700;
        }

        .sidebar-item {
            padding: 0.7rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.92rem;
            font-weight: 600;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
            margin: 2px 0;
        }
        .sidebar-item i {
            font-size: 1.25rem;
            color: #64748b;
            transition: color 0.2s;
        }

        .sidebar-item:hover {
            background: rgba(37, 99, 235, 0.1);
            color: #ffffff;
            border-left-color: var(--primary-light);
        }
        .sidebar-item:hover i {
            color: var(--primary-light);
        }

        .sidebar-item.active {
            background: linear-gradient(90deg, rgba(37, 99, 235, 0.2), rgba(37, 99, 235, 0.05));
            color: #ffffff;
            border-left-color: var(--primary);
            font-weight: 700;
        }
        .sidebar-item.active i {
            color: var(--primary-light);
        }

        /* Main Content Wrapper */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
            z-index: 5;
        }

        /* Top Header */
        .header {
            height: 70px;
            background: rgba(14, 21, 38, 0.85);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
            flex-shrink: 0;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .user-greeting {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            color: #ffffff;
        }

        .sub-status {
            background: rgba(239, 68, 68, 0.12);
            color: #f87171;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            border: 1px solid rgba(239, 68, 68, 0.25);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .sub-status.active-sub {
            background: rgba(16, 185, 129, 0.12);
            color: #34d399;
            border-color: rgba(16, 185, 129, 0.3);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }

        .header-icon-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--border);
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .header-icon-btn:hover {
            color: white;
            border-color: var(--primary);
            background: rgba(37, 99, 235, 0.15);
        }

        .wallet-badge {
            background: rgba(16, 185, 129, 0.1);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.25);
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.2s;
        }
        .wallet-badge:hover {
            background: rgba(16, 185, 129, 0.2);
            transform: translateY(-1px);
        }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #ffffff;
            font-weight: 600;
            font-size: 0.92rem;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--border);
            padding: 6px 12px;
            border-radius: 10px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }
        .profile-btn:hover {
            border-color: var(--primary);
            background: rgba(37, 99, 235, 0.1);
        }

        .signout-btn {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #f87171;
            padding: 6px 12px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .signout-btn:hover {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
        }

        /* Content Body Area */
        .content-body {
            flex: 1;
            overflow-y: auto;
            padding: 2rem;
        }
        .content-body::-webkit-scrollbar { width: 6px; }
        .content-body::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.12); border-radius: 4px; }
    </style>
</head>
<body>

    <!-- Ambient Glowing Background Orbs -->
    <div class="ambient-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-logo-icon">
                <i class="ph-fill ph-keyboard"></i>
            </div>
            <div class="brand-title">
                SelfTyping<span>.com</span>
            </div>
        </div>
        
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}" class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="ph ph-squares-four"></i> ড্যাশবোর্ড (Dashboard)</a></li>
            
            <div class="menu-heading">Written Exams</div>
            <li><a href="{{ route('exams.written.index') }}" class="sidebar-item {{ request()->routeIs('exams.written.*') ? 'active' : '' }}"><i class="ph ph-file-text"></i> লিখিত প্রশ্নপত্র ল্যাব</a></li>
            
            <div class="menu-heading">Online MCQ</div>
            <li><a href="{{ route('exams.mcq.index') }}" class="sidebar-item {{ request()->routeIs('exams.mcq.*') ? 'active' : '' }}"><i class="ph ph-exam"></i> অনলাইন MCQ পরীক্ষা</a></li>
            
            <div class="menu-heading">Typing & Skills</div>
            <li><a href="{{ route('exams.practical.index') }}" class="sidebar-item {{ request()->routeIs('exams.practical.*') ? 'active' : '' }}"><i class="ph ph-microsoft-excel-logo"></i> এক্সেল ও পাওয়ারপয়েন্ট</a></li>
            <li><a href="{{ route('dashboard') }}#recentResults" class="sidebar-item"><i class="ph ph-chart-bar"></i> টাইপিং ফলাফল</a></li>
            <li><a href="{{ route('dashboard') }}" class="sidebar-item"><i class="ph ph-speedometer"></i> লাইভ টাইপিং ল্যাব</a></li>
            
            <div class="menu-heading">Others & Rewards</div>
            <li><a href="{{ route('packages.index') }}" class="sidebar-item {{ request()->routeIs('packages.*') ? 'active' : '' }}"><i class="ph ph-crown"></i> প্যাকেজ ও ওয়ালেট রিচার্জ</a></li>
            <li><a href="{{ route('leaderboard.index') }}" class="sidebar-item {{ request()->routeIs('leaderboard.*') ? 'active' : '' }}"><i class="ph ph-trophy"></i> সেরা ১০ জন টাইপিস্ট</a></li>
        </ul>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <div class="user-greeting">
                    <i class="ph-bold ph-hand-waving" style="color:#f59e0b;"></i>
                    <span>স্বাগতম, <strong>{{ auth()->user()->name }}</strong></span>
                </div>
                
                @if(auth()->user()->institution_id && auth()->user()->institution)
                    @if(auth()->user()->institution->isSubscriptionActive())
                        <div class="sub-status active-sub">
                            <i class="ph-fill ph-buildings"></i> {{ auth()->user()->institution->name }} • ব্যাচ: {{ auth()->user()->batch_name ?? 'সাধারণ' }}
                        </div>
                    @else
                        <div class="sub-status">
                            <i class="ph-bold ph-warning-circle"></i> প্রতিষ্ঠানের সাবস্ক্রিপশন শেষ
                        </div>
                    @endif
                @elseif(auth()->user()->subscription_expires_at && auth()->user()->subscription_expires_at > now())
                    <div class="sub-status active-sub">
                        <i class="ph-fill ph-check-circle"></i> প্রিমিয়াম অ্যাক্টিভ • মেয়াদ: {{ auth()->user()->subscription_expires_at->diffInDays(now()) }} দিন বাকি
                    </div>
                @else
                    <div class="sub-status">
                        <i class="ph-bold ph-warning-circle"></i> ফ্রি মোড (কোনো প্যাকেজ নেই)
                    </div>
                @endif
            </div>
            
            <div class="header-right">
                <a href="{{ route('packages.index') }}" class="wallet-badge" title="ওয়ালেট ব্যালেন্স">
                    <i class="ph-fill ph-wallet"></i> {{ number_format(auth()->user()->wallet_balance ?? 0, 2) }} ৳
                </a>
                
                <a href="{{ route('profile.edit') }}" class="profile-btn">
                    <i class="ph-fill ph-user-circle" style="font-size: 1.35rem; color: var(--primary-light);"></i>
                    <span>প্রোফাইল</span>
                </a>
                
                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="signout-btn">
                        <i class="ph-bold ph-sign-out"></i> লগআউট
                    </button>
                </form>
            </div>
        </header>

        <!-- Dynamic Content -->
        <main class="content-body">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
