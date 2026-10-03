<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperAdmin Control Center - SelfTyping.com</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        :root {
            --bg: #0b0f19;
            --surface: #131b2e;
            --surface-hover: #1e293b;
            --primary: #2563eb;
            --primary-light: #60a5fa;
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

        /* Left Sidebar */
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
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--primary), #1d4ed8);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; color: white;
        }
        .brand-text h2 { font-size: 1.15rem; font-weight: 800; color: white; line-height: 1.1; }
        .brand-text span { font-size: 0.72rem; color: #f59e0b; font-weight: 700; text-transform: uppercase; }

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
            background: rgba(37, 99, 235, 0.1);
            color: white;
            border-left-color: var(--primary);
        }

        /* Main Content Wrapper */
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

        /* Stats Strip */
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
            background: rgba(37, 99, 235, 0.15);
            color: var(--primary-light);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem;
            flex-shrink: 0;
        }
        .stat-icon.green { background: rgba(16, 185, 129, 0.15); color: #34d399; }
        .stat-icon.amber { background: rgba(245, 158, 11, 0.15); color: #fde047; }
        .stat-icon.purple { background: rgba(139, 92, 246, 0.15); color: #c084fc; }

        .stat-details h4 { font-size: 0.82rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; }
        .stat-details .val { font-size: 1.8rem; font-weight: 800; color: white; font-family: monospace; }

        /* Section Container Card */
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

        /* Android SMS Gateway Config Strip */
        .gateway-banner {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.15), rgba(16, 185, 129, 0.1));
            border: 1.5px solid rgba(37, 99, 235, 0.3);
            border-radius: 16px;
            padding: 1.5rem 2rem;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 2rem;
            align-items: center;
        }
        .config-box {
            background: #090e1a;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 6px;
            font-family: monospace;
            font-size: 0.88rem;
            color: #38bdf8;
        }
        .btn-copy {
            background: rgba(56, 189, 248, 0.15);
            color: #38bdf8;
            border: 1px solid rgba(56, 189, 248, 0.3);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            cursor: pointer;
        }

        /* Tables */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }
        .data-table th {
            background: #090e1a;
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            color: var(--text-muted);
            text-align: left;
            font-weight: 600;
        }
        .data-table td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            color: var(--text-main);
        }
        .badge {
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        .badge.claimed { background: rgba(16, 185, 129, 0.2); color: #34d399; }
        .badge.unclaimed { background: rgba(245, 158, 11, 0.2); color: #fde047; }
        .badge.pending { background: rgba(239, 68, 68, 0.2); color: #f87171; }

        .btn-action {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 700;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s;
        }
        .btn-approve { background: #10b981; color: white; }
        .btn-approve:hover { background: #059669; }
        .btn-reject { background: #ef4444; color: white; }
        .btn-reject:hover { background: #dc2626; }
        .btn-delete { background: rgba(239, 68, 68, 0.2); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.4); }

        /* Form Inputs */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.2rem;
        }
        .form-group { margin-bottom: 1rem; }
        .form-group.full { grid-column: span 2; }
        .form-group label { display: block; font-size: 0.88rem; font-weight: 600; margin-bottom: 6px; color: #cbd5e1; }
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 0.8rem 1rem;
            background: #090e1a;
            border: 1.5px solid var(--border);
            border-radius: 8px;
            color: white;
            font-size: 0.95rem;
            outline: none;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: var(--primary);
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #1d4ed8);
            color: white;
            border: none;
            padding: 0.8rem 1.8rem;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .alert-box {
            padding: 1rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .alert-success { background: rgba(16, 185, 129, 0.15); border: 1px solid #10b981; color: #34d399; }
        .alert-error { background: rgba(239, 68, 68, 0.15); border: 1px solid #ef4444; color: #f87171; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="ph-fill ph-shield-star"></i>
            </div>
            <div class="brand-text">
                <h2>SelfTyping</h2>
                <span>SuperAdmin Control</span>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li><a href="#gateway" class="sidebar-link active"><i class="ph ph-cpu"></i> SMS Gateway & Webhook</a></li>
            <li><a href="#recharges" class="sidebar-link"><i class="ph ph-wallet"></i> রিচার্জ অ্যাপ্রুভাল প্যানেল</a></li>
            <li><a href="#tests" class="sidebar-link"><i class="ph ph-keyboard"></i> প্রশ্ন ও প্যাসেজ ম্যানেজমেন্ট</a></li>
            <li><a href="{{ route('dashboard') }}" class="sidebar-link"><i class="ph ph-browser"></i> স্টুডেন্ট ড্যাশবোর্ড</a></li>
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

    <!-- Main Content -->
    <div class="main-wrapper">
        
        <header class="top-navbar">
            <h2 style="font-size:1.2rem; font-weight:700;">SuperAdmin Command Center</h2>
            <div style="display:flex; align-items:center; gap:12px;">
                <span style="font-size:0.85rem; color:#34d399; background:rgba(16,185,129,0.1); padding:4px 12px; border-radius:20px; border:1px solid rgba(16,185,129,0.3);">
                    ● System Live
                </span>
                <span style="font-weight:600; color:white;">{{ auth()->user()->name }}</span>
            </div>
        </header>

        <div class="content-scroll">
            
            @if(session('success'))
                <div class="alert-box alert-success">
                    <i class="ph-fill ph-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-box alert-error">
                    <i class="ph-fill ph-warning-circle"></i> {{ session('error') }}
                </div>
            @endif

            <!-- Stats Strip -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon"><i class="ph-fill ph-users"></i></div>
                    <div class="stat-details">
                        <h4>মোট শিক্ষার্থী</h4>
                        <div class="val">{{ $totalStudents }}</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon green"><i class="ph-fill ph-wallet"></i></div>
                    <div class="stat-details">
                        <h4>মোট রিচার্জ আয়</h4>
                        <div class="val">{{ $totalRechargeSum }} ৳</div>
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
                        <h4>পরীক্ষা সম্পন্ন</h4>
                        <div class="val">{{ $totalResultsCount }}</div>
                    </div>
                </div>
            </div>

            <!-- Android SMS Gateway Live Config Banner -->
            <div class="gateway-banner" id="gateway">
                <div>
                    <h3 style="font-size:1.35rem; font-weight:800; color:white; margin-bottom:6px;">
                        <i class="ph-fill ph-robot" style="color:#38bdf8;"></i> Android SMS Gateway Integration
                    </h3>
                    <p style="color:#cbd5e1; font-size:0.92rem; line-height:1.5;">
                        অ্যান্ড্রয়েড অ্যাপ (SelfTyping Payment Gateway) এর সাথে রিয়েল-টাইমে বিকাশ, নগদ, রকেট ও উপায় এর এসএমএস সিঙ্ক করার জন্য নিচের ক্রেডেনশিয়াল ব্যবহার করুন:
                    </p>
                </div>

                <div>
                    <div style="margin-bottom:8px;">
                        <span style="font-size:0.75rem; color:#94a3b8; font-weight:700; text-transform:uppercase;">Server Webhook URL:</span>
                        <div class="config-box">
                            <span id="txt-webhook">{{ $gatewayWebhookUrl }}</span>
                            <button class="btn-copy" onclick="copyText('txt-webhook')">কপি</button>
                        </div>
                    </div>

                    <div>
                        <span style="font-size:0.75rem; color:#94a3b8; font-weight:700; text-transform:uppercase;">API Secret Key (X-API-KEY):</span>
                        <div class="config-box">
                            <span id="txt-key">{{ $gatewayApiKey }}</span>
                            <button class="btn-copy" onclick="copyText('txt-key')">কপি</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Recharge Requests Panel -->
            <div class="section-box" id="recharges">
                <div class="section-box-header">
                    <h3><i class="ph-fill ph-clock-countdown" style="color:var(--warning);"></i> পেন্ডিং রিচার্জ রিকোয়েস্ট ({{ $pendingRecharges->count() }})</h3>
                </div>

                @if($pendingRecharges->count() > 0)
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>সময়</th>
                                <th>শিক্ষার্থী</th>
                                <th>বিবরণ ও TrxID</th>
                                <th>পরিমাণ</th>
                                <th>অ্যাকশন</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingRecharges as $rec)
                                <tr>
                                    <td>{{ $rec->created_at->format('d M, h:i A') }}</td>
                                    <td>
                                        <strong>{{ $rec->user->name ?? 'N/A' }}</strong><br>
                                        <small style="color:var(--text-muted);">{{ $rec->user->email ?? '' }}</small>
                                    </td>
                                    <td><code style="background:#090e1a; padding:4px 8px; border-radius:4px; color:#38bdf8;">{{ $rec->description }}</code></td>
                                    <td style="font-weight:800; font-family:monospace; color:#34d399; font-size:1.1rem;">{{ $rec->amount }} ৳</td>
                                    <td>
                                        <div style="display:flex; gap:8px;">
                                            <form action="{{ route('admin.recharge.approve', $rec->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn-action btn-approve"><i class="ph-bold ph-check"></i> অনুমোদন করুন</button>
                                            </form>
                                            <form action="{{ route('admin.recharge.reject', $rec->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn-action btn-reject" onclick="return confirm('বাতিল করতে চান?')"><i class="ph-bold ph-x"></i> বাতিল</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p style="color:var(--text-muted); font-size:0.95rem; text-align:center; padding:2rem;">কোনো পেন্ডিং রিচার্জ রিকোয়েস্ট নেই। সবগুলো স্বয়ংক্রিয়ভাবে প্রসেস হয়েছে।</p>
                @endif
            </div>

            <!-- Received SMS Payments Stream (Android App Feed) -->
            <div class="section-box">
                <div class="section-box-header">
                    <h3><i class="ph-fill ph-chats-circle" style="color:var(--accent);"></i> অ্যান্ড্রয়েড অ্যাপ থেকে প্রাপ্ত লাইভ SMS পেমেন্ট লগ</h3>
                </div>

                @if($recentSmsPayments->count() > 0)
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>তারিখ ও সময়</th>
                                <th>মেথড</th>
                                <th>TrxID</th>
                                <th>পরিমাণ</th>
                                <th>প্রেরক নম্বর</th>
                                <th>ক্লেম স্ট্যাটাস</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentSmsPayments as $sms)
                                <tr>
                                    <td>{{ $sms->created_at->format('d M Y, h:i:s A') }}</td>
                                    <td><strong style="color:#38bdf8; text-transform:uppercase;">{{ $sms->method }}</strong></td>
                                    <td><code style="background:#090e1a; padding:3px 8px; border-radius:4px; font-weight:700;">{{ $sms->trx_id }}</code></td>
                                    <td style="font-weight:700; color:#34d399; font-family:monospace;">{{ $sms->amount }} ৳</td>
                                    <td>{{ $sms->sender_number ?? 'N/A' }}</td>
                                    <td>
                                        @if($sms->is_used)
                                            <span class="badge claimed">ক্লেম সম্পন্ন (User #{{ $sms->used_by_user_id }})</span>
                                        @else
                                            <span class="badge unclaimed">আনক্লেমড (ম্যাচিং পেন্ডিং)</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p style="color:var(--text-muted); font-size:0.95rem; text-align:center; padding:2rem;">অ্যান্ড্রয়েড অ্যাপ থেকে এখনো কোনো এসএমএস রেকর্ড আসেনি। অ্যাপে সার্ভার কানেক্ট করে টেস্ট এসএমএস পাঠান।</p>
                @endif
            </div>

            <!-- Typing Tests & Passage Creation Section -->
            <div class="section-box" id="tests">
                <div class="section-box-header">
                    <h3><i class="ph-fill ph-plus-circle" style="color:var(--primary);"></i> নতুন সরকারি/বিসিসি টাইপিং টেস্ট তৈরি করুন</h3>
                </div>

                <form action="{{ route('admin.tests.store') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>টেস্টের নাম (Title)</label>
                            <input type="text" name="title" class="form-input" placeholder="যেমন: BCC Data Entry Operator Test - 01" required>
                        </div>

                        <div class="form-group">
                            <label>ক্যাটাগরি / ল্যাব</label>
                            <select name="category" class="form-select" required>
                                <option value="BCC Lab">BCC Lab (বাংলাদেশ কম্পিউটার কাউন্সিল)</option>
                                <option value="High Court Lab">High Court & Supreme Court Lab</option>
                                <option value="BUET Lab">BUET & IBA Recruitment Lab</option>
                                <option value="Ministry & Directorate">মন্ত্রণালয় ও অধিদপ্তর</option>
                                <option value="Sheet Mode">Sheet Mode (প্রশ্নপত্র দেখে টাইপ)</option>
                                <option value="Bank Recruitment">সরকারি ব্যাংক রিক্রুটমেন্ট</option>
                                <option value="Bijoy Classic">বিজয় ক্লাসিক স্পেশাল</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>ভাষা ও ফন্ট (Language)</label>
                            <select name="language" class="form-select" required>
                                <option value="bn_unicode">বাংলা ইউনিকোড (Kalpurush / Avro)</option>
                                <option value="bn_bijoy">বাংলা বিজয় বায়ান্ন (SutonnyMJ)</option>
                                <option value="en">ইংরেজি (English Standard)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>পরীক্ষার মোড (Mode)</label>
                            <select name="mode" class="form-select" required>
                                <option value="screen">Screen Mode (অন-স্ক্রিন দেখে টাইপ)</option>
                                <option value="sheet">Sheet Mode (হার্ডকপি দেখে টাইপ + অটো-ডিফ)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>সময়সীমা (মিনিট)</label>
                            <input type="number" name="time_limit_minutes" class="form-input" value="5" min="1" max="30" required>
                        </div>

                        <div class="form-group">
                            <label>পাসিং স্পিড (WPM)</label>
                            <input type="number" name="pass_wpm" class="form-input" value="25" min="10" max="100" required>
                        </div>

                        <div class="form-group full">
                            <label>প্যাসেজ টেক্সট (Content)</label>
                            <textarea name="content" class="form-textarea" rows="5" placeholder="পরীক্ষার মূল অনুচ্ছেদ বা প্রশ্নপত্রের লেখাটি এখানে পেস্ট করুন..." required></textarea>
                        </div>

                        <div class="form-group" style="display:flex; align-items:center; gap:8px;">
                            <input type="checkbox" name="backspace_allowed" id="backspace_allowed" value="1" checked style="width:18px; height:18px; accent-color:var(--primary);">
                            <label for="backspace_allowed" style="margin:0; cursor:pointer;">ব্যাকস্পেস সক্রিয় থাকবে (Allow Backspace)</label>
                        </div>

                        <div class="form-group" style="display:flex; align-items:center; gap:8px;">
                            <input type="checkbox" name="is_premium" id="is_premium" value="1" checked style="width:18px; height:18px; accent-color:var(--primary);">
                            <label for="is_premium" style="margin:0; cursor:pointer;">প্রিমিয়াম টেস্ট (সাবস্ক্রিপশন প্রয়োজন)</label>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary" style="margin-top:1rem;">
                        <i class="ph-bold ph-floppy-disk"></i> টেস্ট সংরক্ষণ করুন
                    </button>
                </form>
            </div>

            <!-- Existing Tests List -->
            <div class="section-box">
                <div class="section-box-header">
                    <h3><i class="ph-fill ph-list-dashes"></i> বিদ্যমান টাইপিং টেস্টসমূহ ({{ $tests->count() }})</h3>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>শিরোনাম</th>
                            <th>ল্যাব</th>
                            <th>ভাষা</th>
                            <th>মোড</th>
                            <th>সময়</th>
                            <th>টার্গেট</th>
                            <th>অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tests as $test)
                            <tr>
                                <td><strong>{{ $test->title }}</strong></td>
                                <td><span style="color:#38bdf8;">{{ $test->category }}</span></td>
                                <td>{{ strtoupper($test->language) }}</td>
                                <td>{{ strtoupper($test->mode) }}</td>
                                <td>{{ $test->time_limit_minutes }} min</td>
                                <td>{{ $test->pass_wpm }} WPM</td>
                                <td>
                                    <form action="{{ route('admin.tests.destroy', $test->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" onclick="return confirm('মুছে ফেলতে চান?')">
                                            <i class="ph-bold ph-trash"></i> মুছুন
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>

    <script>
        function copyText(elementId) {
            const text = document.getElementById(elementId).innerText.trim();
            navigator.clipboard.writeText(text).then(() => {
                alert('কপি করা হয়েছে: ' + text);
            });
        }
    </script>
</body>
</html>
