<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>কোচিং ও ইনস্টিটিউট পোর্টাল - {{ $institution->name }} | SelfTyping.com</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        :root {
            --bg: #090d16;
            --surface: #111827;
            --surface-hover: #1f2937;
            --primary: #8b5cf6;
            --primary-light: #c084fc;
            --accent: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border: #243049;
            --sidebar-width: 260px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Hind Siliguri', 'Inter', sans-serif; }

        body {
            background: var(--bg);
            color: var(--text-main);
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }
        .sidebar-brand {
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid var(--border);
        }
        .brand-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--primary), #6d28d9);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; color: white;
        }
        .brand-text h2 { font-size: 1.15rem; font-weight: 800; color: white; line-height: 1.1; }
        .brand-text span { font-size: 0.72rem; color: var(--primary-light); font-weight: 700; text-transform: uppercase; }

        .sidebar-menu { list-style: none; padding: 1.2rem 0; flex: 1; overflow-y: auto; }
        .sidebar-link {
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
            transition: all 0.2s;
            border-left: 4px solid transparent;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background: rgba(139, 92, 246, 0.1);
            color: white;
            border-left-color: var(--primary);
        }

        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .top-navbar {
            height: 68px;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
        }

        .content-scroll {
            flex: 1;
            overflow-y: auto;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        /* Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }
        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }
        .stat-icon {
            width: 52px; height: 52px;
            border-radius: 12px;
            background: rgba(139, 92, 246, 0.15);
            color: var(--primary-light);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem;
            flex-shrink: 0;
        }
        .stat-icon.green { background: rgba(16, 185, 129, 0.15); color: #34d399; }
        .stat-icon.blue { background: rgba(37, 99, 235, 0.15); color: #60a5fa; }
        .stat-icon.amber { background: rgba(245, 158, 11, 0.15); color: #fde047; }

        .stat-details h4 { font-size: 0.82rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; }
        .stat-details .val { font-size: 1.8rem; font-weight: 800; color: white; font-family: monospace; }

        /* Section Box */
        .section-box {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.8rem;
        }
        .section-box-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }
        .section-box-header h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .data-table { width: 100%; border-collapse: collapse; font-size: 0.9rem; }
        .data-table th { background: #090e1a; padding: 12px 16px; border-bottom: 1px solid var(--border); color: var(--text-muted); text-align: left; }
        .data-table td { padding: 12px 16px; border-bottom: 1px solid var(--border); color: var(--text-main); }

        .badge-pass { background: rgba(16, 185, 129, 0.2); color: #34d399; padding: 3px 8px; border-radius: 4px; font-weight: 700; }
        .badge-fail { background: rgba(239, 68, 68, 0.2); color: #f87171; padding: 3px 8px; border-radius: 4px; font-weight: 700; }

        /* Forms */
        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.2rem; }
        .form-group { margin-bottom: 1rem; }
        .form-group.full { grid-column: span 2; }
        .form-group label { display: block; font-size: 0.88rem; font-weight: 600; margin-bottom: 6px; color: #cbd5e1; }
        .form-input, .form-select, .form-textarea {
            width: 100%; padding: 0.8rem 1rem; background: #090e1a; border: 1.5px solid var(--border); border-radius: 8px; color: white; font-size: 0.95rem; outline: none;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus { border-color: var(--primary); }

        .btn-purple {
            background: linear-gradient(135deg, var(--primary), #6d28d9);
            color: white; border: none; padding: 0.8rem 1.8rem; border-radius: 8px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-outline {
            background: transparent; color: white; border: 1.5px solid var(--border); padding: 0.6rem 1.2rem; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; font-size: 0.88rem;
        }
        .btn-outline:hover { background: #1f2937; }

        .alert-box { padding: 1rem 1.5rem; border-radius: 10px; font-weight: 600; font-size: 0.95rem; display: flex; align-items: center; gap: 8px; }
        .alert-success { background: rgba(16, 185, 129, 0.15); border: 1px solid #10b981; color: #34d399; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="ph-fill ph-chalkboard-teacher"></i>
            </div>
            <div class="brand-text">
                <h2>{{ $institution->name }}</h2>
                <span>Coaching Lab Portal</span>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li><a href="#overview" class="sidebar-link active"><i class="ph ph-squares-four"></i> ড্যাশবোর্ড ওভারভিউ</a></li>
            <li><a href="#students" class="sidebar-link"><i class="ph ph-student"></i> শিক্ষার্থী ব্যাচ ম্যানেজমেন্ট</a></li>
            <li><a href="#tests" class="sidebar-link"><i class="ph ph-keyboard"></i> ইনস্টিটিউট কাস্টম টেস্ট</a></li>
            <li><a href="{{ route('institution.report') }}" target="_blank" class="sidebar-link"><i class="ph ph-file-pdf"></i> ব্যাচ রেজাল্ট শিট প্রিন্ট</a></li>
            <li><a href="{{ route('dashboard') }}" class="sidebar-link"><i class="ph ph-arrow-u-up-left"></i> স্টুডেন্ট ভিউ</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}" style="margin-top:2rem; padding:0 1.5rem;">
                    @csrf
                    <button style="background:transparent; border:none; color:var(--text-muted); cursor:pointer; font-weight:600; display:flex; align-items:center; gap:8px;">
                        <i class="ph ph-sign-out"></i> লগআউট
                    </button>
                </form>
            </li>
        </ul>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <header class="top-navbar">
            <h2 style="font-size:1.2rem; font-weight:700;">{{ $institution->name }} - কন্ট্রোল প্যানেল</h2>
            <div style="display:flex; align-items:center; gap:12px;">
                <a href="{{ route('institution.report') }}" target="_blank" class="btn-outline">
                    <i class="ph-bold ph-printer"></i> ব্যাচ রিপোর্ট প্রিন্ট / PDF
                </a>
            </div>
        </header>

        <div class="content-scroll">
            
            @if(session('success'))
                <div class="alert-box alert-success">
                    <i class="ph-fill ph-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <!-- Stats Grid -->
            <div class="stats-grid" id="overview">
                <div class="stat-card">
                    <div class="stat-icon"><i class="ph-fill ph-users-three"></i></div>
                    <div class="stat-details">
                        <h4>ব্যাচের মোট শিক্ষার্থী</h4>
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
                        <h4>ইনস্টিটিউট টেস্ট</h4>
                        <div class="val">{{ $totalTests }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon amber"><i class="ph-fill ph-seal-check"></i></div>
                    <div class="stat-details">
                        <h4>বিসিসি পাসের হার</h4>
                        <div class="val">{{ $passRate }}%</div>
                    </div>
                </div>
            </div>

            <!-- Add Student & Enrolled Batch Table -->
            <div class="section-box" id="students">
                <div class="section-box-header">
                    <h3><i class="ph-fill ph-user-plus" style="color:var(--primary-light);"></i> ব্যাচে নতুন শিক্ষার্থী যুক্ত করুন</h3>
                </div>

                <form action="{{ route('institution.students.store') }}" method="POST" style="margin-bottom:2rem;">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>শিক্ষার্থীর নাম</label>
                            <input type="text" name="name" class="form-input" placeholder="আব্দুর রহিম" required>
                        </div>
                        <div class="form-group">
                            <label>ইমেইল ঠিকানা (লগইনের জন্য)</label>
                            <input type="email" name="email" class="form-input" placeholder="student@example.com" required>
                        </div>
                        <div class="form-group">
                            <label>ডিফল্ট পাসওয়ার্ড</label>
                            <input type="password" name="password" class="form-input" value="12345678" required>
                        </div>
                        <div class="form-group" style="display:flex; align-items:flex-end;">
                            <button type="submit" class="btn-purple" style="width:100%; height:48px;">
                                <i class="ph-bold ph-plus"></i> শিক্ষার্থী অন্তর্ভুক্ত করুন
                            </button>
                        </div>
                    </div>
                </form>

                <h4 style="color:white; font-size:1.05rem; margin-bottom:1rem;">নিবন্ধিত ব্যাচ শিক্ষার্থী তালিকা ({{ $students->count() }})</h4>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>নাম</th>
                            <th>ইমেইল</th>
                            <th>অন্তর্ভুক্তির তারিখ</th>
                            <th>সাবস্ক্রিপশন মেয়াদ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $st)
                            <tr>
                                <td><strong>{{ $st->name }}</strong></td>
                                <td>{{ $st->email }}</td>
                                <td>{{ $st->created_at->format('d M Y') }}</td>
                                <td><span style="color:#34d399; font-weight:700;">৬ মাস ব্যাচ এক্সেস সক্রিয়</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center; color:var(--text-muted);">এখনও কোনো শিক্ষার্থী যুক্ত করা হয়নি।</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Create Custom Typing Test Section -->
            <div class="section-box" id="tests">
                <div class="section-box-header">
                    <h3><i class="ph-fill ph-plus-circle" style="color:var(--primary-light);"></i> ইনস্টিটিউট স্পেশাল টাইপিং টেস্ট তৈরি করুন</h3>
                </div>

                <form action="{{ route('institution.tests.store') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>টেস্টের নাম</label>
                            <input type="text" name="title" class="form-input" placeholder="যেমন: Weekly Speed Test - Batch A" required>
                        </div>
                        <div class="form-group">
                            <label>ক্যাটাগরি</label>
                            <input type="text" name="category" class="form-input" value="Coaching Special" required>
                        </div>
                        <div class="form-group">
                            <label>ভাষা ও ফন্ট</label>
                            <select name="language" class="form-select" required>
                                <option value="bn_unicode">বাংলা ইউনিকোড (Kalpurush)</option>
                                <option value="bn_bijoy">বাংলা বিজয় বায়ান্ন (SutonnyMJ)</option>
                                <option value="en">ইংরেজি (English Standard)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>পরীক্ষার মোড</label>
                            <select name="mode" class="form-select" required>
                                <option value="screen">Screen Mode (অন-স্ক্রিন)</option>
                                <option value="sheet">Sheet Mode (প্রশ্নপত্র দেখে টাইপ)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>সময়সীমা (মিনিট)</label>
                            <input type="number" name="time_limit_minutes" class="form-input" value="5" min="1" max="30" required>
                        </div>
                        <div class="form-group">
                            <label>টার্গেট পাসিং স্পিড (WPM)</label>
                            <input type="number" name="pass_wpm" class="form-input" value="25" min="10" max="100" required>
                        </div>
                        <div class="form-group full">
                            <label>প্যাসেজ টেক্সট</label>
                            <textarea name="content" class="form-textarea" rows="4" placeholder="পরীক্ষার মূল টেক্সট এখানে দিন..." required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn-purple" style="margin-top:0.5rem;">
                        <i class="ph-bold ph-floppy-disk"></i> ইনস্টিটিউট টেস্ট সংরক্ষণ করুন
                    </button>
                </form>
            </div>

            <!-- Recent Results Table -->
            <div class="section-box">
                <div class="section-box-header">
                    <h3><i class="ph-fill ph-chart-line-up" style="color:var(--accent);"></i> শিক্ষার্থীদের সাম্প্রতিক পরীক্ষার ফলাফল</h3>
                    <a href="{{ route('institution.report') }}" target="_blank" class="btn-outline">সব দেখুন ও প্রিন্ট করুন</a>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>শিক্ষার্থী</th>
                            <th>পরীক্ষা</th>
                            <th>Gross WPM</th>
                            <th>Net WPM</th>
                            <th>অ্যাকুরেসি</th>
                            <th>ভুলের হার</th>
                            <th>ফলাফল</th>
                            <th>তারিখ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($results as $res)
                            <tr>
                                <td><strong>{{ $res->user->name ?? 'Student' }}</strong></td>
                                <td>{{ $res->typingTest->title ?? '' }}</td>
                                <td style="font-family:monospace; font-weight:700;">{{ $res->gross_wpm }}</td>
                                <td style="font-family:monospace; font-weight:800; color:#38bdf8; font-size:1.05rem;">{{ $res->net_wpm }} WPM</td>
                                <td style="color:#34d399; font-weight:700;">{{ $res->accuracy }}%</td>
                                <td>{{ $res->error_percentage }}%</td>
                                <td><span class="{{ $res->is_passed ? 'badge-pass' : 'badge-fail' }}">{{ $res->is_passed ? 'PASS' : 'FAIL' }}</span></td>
                                <td>{{ $res->created_at->format('d M, h:i A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align:center; color:var(--text-muted);">এখনও কোনো ফলাফল নেই।</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>
