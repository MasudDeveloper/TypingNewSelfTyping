<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SelfTyping.com Portal')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/bangla-fonts.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    @stack('styles')
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-body: #f3f4f6;
            --bg-surface: #ffffff;
            --text-dark: #111827;
            --text-muted: #6b7280;
            --border: #e5e7eb;
            --success: #10b981;
            
            /* Sidebar */
            --sidebar-bg: #1e3a8a;
            --sidebar-text: #93c5fd;
            --sidebar-active: #2563eb;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: var(--bg-body); color: var(--text-dark); display: flex; height: 100vh; overflow: hidden; }

        /* Left Sidebar */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            color: white;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            flex-shrink: 0;
        }

        .sidebar-brand {
            padding: 1.5rem;
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(0,0,0,0.1);
        }

        .sidebar-menu {
            list-style: none;
            padding: 1rem 0;
            flex: 1;
        }

        .sidebar-item {
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--sidebar-text);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: 0.2s;
            border-left: 4px solid transparent;
        }

        .sidebar-item:hover, .sidebar-item.active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: white;
        }

        .sidebar-item i { font-size: 1.25rem; }

        .menu-heading {
            padding: 0.5rem 1.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #60a5fa;
            margin-top: 1rem;
            font-weight: 600;
        }

        /* Top Header */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .header {
            height: 64px;
            background: var(--bg-surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
            flex-shrink: 0;
        }

        .header-left { display: flex; align-items: center; gap: 1rem; }
        
        .sub-status {
            background: #eff6ff; color: var(--primary);
            padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;
            border: 1px solid #bfdbfe;
        }
        .sub-status.active-sub { background: #d1fae5; color: #065f46; border-color: #a7f3d0; }

        .header-right { display: flex; align-items: center; gap: 1.5rem; }

        .wallet-badge {
            background: #f8fafc; color: var(--text-dark); border: 1px solid var(--border);
            padding: 6px 12px; border-radius: 20px; font-weight: 600; font-size: 0.85rem;
            display: flex; align-items: center; gap: 6px;
        }

        .profile-btn {
            display: flex; align-items: center; gap: 8px; color: var(--text-dark); font-weight: 500; font-size: 0.9rem; cursor: pointer;
        }

        /* Content Area */
        .content-body {
            flex: 1;
            overflow-y: auto;
            padding: 2rem;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <i class="ph-fill ph-keyboard"></i> SelfTyping<span style="color:#60a5fa;">.com</span>
        </div>
        
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}" class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="ph ph-squares-four"></i> Dashboard</a></li>
            
            <div class="menu-heading">Written Exams</div>
            <li><a href="{{ route('exams.written.index') }}" class="sidebar-item {{ request()->routeIs('exams.written.*') ? 'active' : '' }}"><i class="ph ph-file-text"></i> Written Question Paper</a></li>
            
            <div class="menu-heading">Online MCQ</div>
            <li><a href="{{ route('exams.mcq.index') }}" class="sidebar-item {{ request()->routeIs('exams.mcq.*') ? 'active' : '' }}"><i class="ph ph-exam"></i> Online MCQ Exam</a></li>
            
            <div class="menu-heading">Typing & Skills</div>
            <li><a href="{{ route('exams.practical.index') }}" class="sidebar-item {{ request()->routeIs('exams.practical.*') ? 'active' : '' }}"><i class="ph ph-microsoft-excel-logo"></i> Excel | PowerPoint</a></li>
            <li><a href="{{ route('dashboard') }}#recentResults" class="sidebar-item"><i class="ph ph-chart-bar"></i> Typing Result</a></li>
            <li><a href="{{ route('dashboard') }}" class="sidebar-item"><i class="ph ph-speedometer"></i> Live Typing Lab</a></li>
            
            <div class="menu-heading">Others & Rewards</div>
            <li><a href="{{ route('packages.index') }}" class="sidebar-item {{ request()->routeIs('packages.*') ? 'active' : '' }}"><i class="ph ph-crown"></i> Packages & Wallet</a></li>
            <li><a href="{{ route('leaderboard.index') }}" class="sidebar-item {{ request()->routeIs('leaderboard.*') ? 'active' : '' }}"><i class="ph ph-trophy"></i> Winner Best Top 10</a></li>
        </ul>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <div style="font-weight: 600; color: var(--text-dark);">Set your profile picture</div>
                
                @if(auth()->user()->subscription_expires_at && auth()->user()->subscription_expires_at > now())
                    <div class="sub-status active-sub">
                        ACTIVE | মেয়াদ: {{ auth()->user()->subscription_expires_at->format('d M Y') }} • {{ auth()->user()->subscription_expires_at->diffInDays(now()) }} দিন বাকি
                    </div>
                @else
                    <div class="sub-status">
                        INACTIVE | No Package
                    </div>
                @endif
            </div>
            
            <div class="header-right">
                <i class="ph ph-bell" style="font-size: 1.25rem; color: var(--text-muted); cursor: pointer;"></i>
                
                <div class="wallet-badge">
                    <i class="ph-fill ph-wallet" style="color:var(--success);"></i> {{ auth()->user()->wallet_balance ?? 0 }} ৳
                </div>
                
                <div class="profile-btn">
                    <i class="ph-fill ph-user-circle" style="font-size: 1.5rem; color: var(--primary);"></i>
                    Profile <i class="ph ph-caret-down"></i>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" style="margin-left: 1rem;">
                    @csrf
                    <button style="background:transparent; border:none; color:var(--text-muted); font-weight:500; cursor:pointer;">Sign Out</button>
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
