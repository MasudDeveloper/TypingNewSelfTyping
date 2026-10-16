<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $test->title }} - বিসিসি ও সরকারি এক্সাম পোর্টাল</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <!-- Bengali Local & CDN Fonts -->
    <link rel="stylesheet" href="/css/bangla-fonts.css">

    <style>
        @font-face {
            font-family: 'SutonnyMJ';
            src: url('/fonts/SutonnyMJ.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        @font-face {
            font-family: 'Kalpurush';
            src: url('/fonts/Kalpurush.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --bg-body: #0f172a;
            --bg-surface: #1e293b;
            --bg-card: #0b1329;
            --border: #334155;
            --text-light: #f8fafc;
            --text-muted: #94a3b8;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            
            --correct-bg: rgba(16, 185, 129, 0.15);
            --correct-text: #34d399;
            --incorrect-bg: rgba(239, 68, 68, 0.2);
            --incorrect-text: #f87171;
            --active-bg: rgba(37, 99, 235, 0.3);
            --active-text: #93c5fd;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Hind Siliguri', 'Inter', sans-serif; }

        body {
            background: var(--bg-body);
            color: var(--text-light);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            user-select: none;
            overflow-x: hidden;
        }

        /* Top Exam Header */
        .exam-header {
            height: 68px;
            padding: 0 2rem;
            background: var(--bg-surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }
        .exit-btn {
            color: var(--text-muted);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: var(--bg-card);
            transition: all 0.2s;
            font-size: 1.2rem;
        }
        .exit-btn:hover { background: #334155; color: white; }

        .exam-info h2 {
            font-size: 1.15rem;
            font-weight: 700;
            color: white;
            line-height: 1.2;
        }
        .exam-info .exam-badge {
            font-size: 0.75rem;
            color: #60a5fa;
            font-weight: 600;
            text-transform: uppercase;
        }

        .header-badges {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .mode-pill {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 1px solid var(--border);
        }
        .mode-pill.screen { background: rgba(37, 99, 235, 0.2); color: #93c5fd; border-color: rgba(37, 99, 235, 0.4); }
        .mode-pill.sheet { background: rgba(245, 158, 11, 0.2); color: #fde047; border-color: rgba(245, 158, 11, 0.4); }

        .proctor-status {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: #34d399;
            background: rgba(16, 185, 129, 0.1);
            padding: 5px 12px;
            border-radius: 20px;
            border: 1px solid rgba(16, 185, 129, 0.3);
            font-weight: 600;
        }
        .pulse-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(0.9); opacity: 0.7; }
            50% { transform: scale(1.3); opacity: 1; }
            100% { transform: scale(0.9); opacity: 0.7; }
        }

        /* Keyboard Input Mode Switcher */
        .input-mode-switcher {
            display: flex;
            align-items: center;
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 10px;
            padding: 3px;
            gap: 4px;
        }
        .input-mode-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .input-mode-btn.active {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.4);
        }
        .input-mode-btn:hover:not(.active) {
            color: white;
            background: rgba(255, 255, 255, 0.05);
        }
        .font-sutonny {
            font-family: 'SutonnyMJ', sans-serif !important;
        }
        .font-kalpurush {
            font-family: 'Kalpurush', sans-serif !important;
        }

        /* Container */
        .exam-container {
            max-width: 1100px;
            margin: 1.5rem auto;
            width: 100%;
            padding: 0 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Stats Bar */
        .stats-bar {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .stat-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1rem 1.2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }
        .stat-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }
        .stat-val {
            font-size: 2.1rem;
            font-weight: 800;
            color: var(--text-light);
            font-family: 'JetBrains Mono', 'Inter', monospace;
            line-height: 1.1;
        }
        .stat-val.timer { color: #60a5fa; }
        .stat-val.timer.warning { color: #f87171; animation: blink 1s infinite; }
        @keyframes blink { 50% { opacity: 0.6; } }

        /* Fonts for Bengali & English */
        .lang-bn_unicode, .lang-bn_unicode .word,
        .lang-bn_bijoy, .lang-bn_bijoy .word { 
            font-family: 'Kalpurush', 'Hind Siliguri', 'Nikosh', sans-serif !important; 
            font-size: 1.55rem; 
            line-height: 1.9; 
        }
        .single-line-input, .sheet-textarea {
            font-family: 'Kalpurush', 'Hind Siliguri', sans-serif !important;
            font-size: 1.45rem;
        }
        .single-line-input.font-sutonny,
        .sheet-textarea.font-sutonny,
        textarea.font-sutonny,
        input.font-sutonny {
            font-family: 'SutonnyMJ', sans-serif !important;
            font-size: 1.6rem !important;
            letter-spacing: 0.5px;
        }
        .single-line-input.font-kalpurush,
        .sheet-textarea.font-kalpurush {
            font-family: 'Kalpurush', 'Hind Siliguri', sans-serif !important;
            font-size: 1.45rem !important;
        }
        .lang-en, .lang-en *, .lang-en .word, .lang-en input, .lang-en textarea { 
            font-family: 'Inter', monospace !important; 
            font-size: 1.25rem; 
            line-height: 1.8; 
        }

        /* Main Workspace Wrapper */
        .workspace-wrapper {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            flex: 1;
            min-height: 480px;
            position: relative;
        }

        /* Screen Mode Elements */
        .screen-passage-area {
            flex: 1;
            padding: 2rem;
            border-bottom: 2px solid var(--border);
            background: #090e1a;
            overflow-y: auto;
            max-height: 240px;
            line-height: 2;
        }
        .word {
            display: inline-block;
            padding: 2px 6px;
            margin: 2px;
            border-radius: 4px;
            transition: all 0.1s ease;
        }
        .word.active {
            background: var(--active-bg);
            color: var(--active-text);
            box-shadow: 0 0 0 2px var(--primary);
            font-weight: 600;
        }
        .word.correct {
            background: var(--correct-bg);
            color: var(--correct-text);
        }
        .word.incorrect {
            background: var(--incorrect-bg);
            color: var(--incorrect-text);
            text-decoration: underline;
        }

        .screen-input-area {
            padding: 1.5rem 2rem;
            background: var(--bg-surface);
            position: relative;
        }
        .single-line-input {
            width: 100%;
            padding: 1.2rem 1.5rem;
            background: #0b1329;
            border: 2px solid var(--border);
            border-radius: 10px;
            color: white;
            font-size: 1.35rem;
            outline: none;
            transition: all 0.2s;
        }
        .single-line-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.25);
        }
        .single-line-input.error {
            border-color: var(--danger);
            background: rgba(239, 68, 68, 0.1);
        }

        /* Sheet Mode Elements (বিসিসি প্রশ্নপত্র দেখে টাইপ) */
        .sheet-mode-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            flex: 1;
            height: 100%;
        }
        .sheet-question-pane {
            background: #090e1a;
            border-right: 2px solid var(--border);
            padding: 1.8rem;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        .sheet-header-tag {
            font-size: 0.8rem;
            font-weight: 700;
            color: #f59e0b;
            text-transform: uppercase;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .sheet-content-text {
            color: #e2e8f0;
            line-height: 2;
            flex: 1;
            white-space: pre-wrap;
        }

        .sheet-typing-pane {
            background: var(--bg-surface);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
        }
        .sheet-textarea {
            width: 100%;
            flex: 1;
            background: #0b1329;
            border: 2px solid var(--border);
            border-radius: 10px;
            color: white;
            padding: 1.5rem;
            font-size: 1.35rem;
            line-height: 1.9;
            resize: none;
            outline: none;
            transition: border-color 0.2s;
        }
        .sheet-textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.2);
        }

        /* Start Overlay */
        .fullscreen-overlay {
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, 0.96);
            backdrop-filter: blur(8px);
            z-index: 40;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2rem;
            transition: opacity 0.3s;
        }
        .fullscreen-overlay.hidden {
            opacity: 0;
            pointer-events: none;
        }
        .overlay-box {
            max-width: 580px;
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }
        .overlay-box h3 {
            font-size: 1.6rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.8rem;
        }
        .overlay-box p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.8rem;
        }
        .overlay-rules {
            background: #0b1329;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1rem 1.2rem;
            text-align: left;
            margin-bottom: 1.8rem;
            font-size: 0.88rem;
            color: #cbd5e1;
        }
        .overlay-rules li {
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .overlay-rules li i { color: #f59e0b; }

        .btn-start-exam {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            padding: 1rem 2.8rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1.15rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }
        .btn-start-exam:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.5);
        }

        /* Anti-Cheat Warning Modal */
        .warning-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(6px);
            z-index: 100;
            display: none;
            align-items: center;
            justify-content: center;
        }
        .warning-card {
            background: #1e293b;
            border: 2px solid var(--danger);
            border-radius: 16px;
            padding: 2.2rem;
            max-width: 480px;
            text-align: center;
            color: white;
            box-shadow: 0 0 30px rgba(239, 68, 68, 0.4);
        }
        .warning-card i {
            font-size: 3.5rem;
            color: var(--danger);
            margin-bottom: 1rem;
        }
        .warning-card h3 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 0.6rem;
        }
        .warning-card p {
            color: #cbd5e1;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }
        .btn-warning-ack {
            background: var(--danger);
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
        }

        /* Bottom Submit Bar */
        .bottom-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.2rem;
        }
        .btn-submit-exam {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            padding: 0.85rem 2rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        .btn-submit-exam:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(16, 185, 129, 0.4);
        }

        /* Fullscreen Viewport adjustments */
        :fullscreen .exam-header { padding: 0 3rem; }
        :fullscreen .exam-container { max-width: 100%; padding: 1rem 3rem; }
    </style>
</head>
<body oncontextmenu="return false;">

    <!-- Top Header -->
    <header class="exam-header">
        <div class="header-left">
            <a href="{{ route('dashboard') }}" class="exit-btn" title="ড্যাশবোর্ডে ফিরে যান">
                <i class="ph ph-arrow-left"></i>
            </a>
            <div class="exam-info">
                <h2>{{ $test->title }}</h2>
                <span class="exam-badge">{{ $test->category }} • টার্গেট স্পিড: {{ $test->pass_wpm }} WPM</span>
            </div>
        </div>

        <div class="header-badges">
            @if(in_array($test->language, ['bn_unicode', 'bn_bijoy']))
                <!-- User Keyboard Choice Switcher -->
                <div class="input-mode-switcher" id="header-input-switcher" title="আপনার কিবোর্ডের টাইপিং মেথড বেছে নিন">
                    <button type="button" class="input-mode-btn active" id="btn-mode-unicode" onclick="switchKeyboardMode('unicode')">
                        <i class="ph-bold ph-keyboard"></i> ইউনিকোড (Ctrl+Alt+V)
                    </button>
                    <button type="button" class="input-mode-btn" id="btn-mode-bijoy" onclick="switchKeyboardMode('bijoy')">
                        <i class="ph-bold ph-font"></i> বিজয় ক্লাসিক (Ctrl+Alt+B)
                    </button>
                </div>
            @endif

            <span class="mode-pill {{ $test->mode }}">{{ strtoupper($test->mode) }} মোড</span>
            <div class="proctor-status">
                <span class="pulse-dot"></span>
                <span>বিসিসি প্রক্টরিং সক্রিয়</span>
            </div>
        </div>
    </header>

    <div class="exam-container">
        
        <!-- Live Real-time Stats Strip -->
        <div class="stats-bar">
            <div class="stat-card">
                <div class="stat-label">সময় বাকি</div>
                <div class="stat-val timer" id="time-display">{{ $test->time_limit_minutes }}:00</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Gross WPM (5-Key)</div>
                <div class="stat-val" id="gross-wpm-display">0</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Net WPM (বিসিসি)</div>
                <div class="stat-val" style="color:#38bdf8;" id="net-wpm-display">0</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">অ্যাকুরেসি (Accuracy)</div>
                <div class="stat-val" style="color:var(--success);" id="acc-display">100%</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">ভুলের হার (Max 5%)</div>
                <div class="stat-val" style="color:var(--danger);" id="error-rate-display">0%</div>
            </div>
        </div>

        <!-- Main Workspace Body -->
        <div class="workspace-wrapper" id="workspace">

            <!-- Fullscreen Start Modal -->
            <div class="fullscreen-overlay" id="start-overlay">
                <div class="overlay-box">
                    <i class="ph-fill ph-shield-check" style="font-size:3rem; color:var(--primary); margin-bottom:0.5rem; display:block;"></i>
                    <h3>বিসিসি ও সরকারি পরীক্ষা শুরু করুন</h3>
                    <p>এটি একটি সরকারি ও বিসিসি স্ট্যান্ডার্ড মূল্যায়ন পরীক্ষা। পরীক্ষায় শতভাগ নির্ভুলতার সাথে টাইপ করুন।</p>
                    
                    @if(in_array($test->language, ['bn_unicode', 'bn_bijoy']))
                        <div style="background:rgba(37,99,235,0.12); border:1px solid rgba(59,130,246,0.3); border-radius:12px; padding:12px; margin:1rem 0; text-align:left;">
                            <label style="font-size:0.85rem; font-weight:700; color:#93c5fd; display:block; margin-bottom:6px;">
                                <i class="ph-bold ph-keyboard"></i> আপনার টাইপিং কিবোর্ড লেআউট নির্বাচন করুন:
                            </label>
                            <div style="display:flex; gap:10px;">
                                <label style="display:flex; align-items:center; gap:6px; cursor:pointer; font-size:0.9rem; color:white;">
                                    <input type="radio" name="modal_kb_mode" value="unicode" checked onchange="switchKeyboardMode('unicode')">
                                    <span>ইউনিকোড (Avro / UniJoy - Ctrl+Alt+V)</span>
                                </label>
                                <label style="display:flex; align-items:center; gap:6px; cursor:pointer; font-size:0.9rem; color:white;">
                                    <input type="radio" name="modal_kb_mode" value="bijoy" onchange="switchKeyboardMode('bijoy')">
                                    <span>বিজয় ক্লাসিক (SutonnyMJ - Ctrl+Alt+B)</span>
                                </label>
                            </div>
                        </div>
                    @endif

                    <ul class="overlay-rules">
                        <li><i class="ph-bold ph-check"></i> মোট সময়: <strong>{{ $test->time_limit_minutes }} মিনিট</strong> | পাসিং স্পিড: <strong>{{ $test->pass_wpm }} WPM</strong></li>
                        <li><i class="ph-bold ph-warning"></i> সরকারি নিয়মে সর্বোচ্চ <strong>৫% ভুল</strong> ক্ষমার যোগ্য।</li>
                        <li><i class="ph-bold ph-lock-key"></i> ট্যাব বা উইন্ডো পরিবর্তন করলে সতর্কবার্তা ও পরীক্ষা বাতিল হতে পারে।</li>
                        <li><i class="ph-bold ph-prohibit"></i> কপি, পেস্ট ও রাইট ক্লিক সম্পূর্ণ নিষিদ্ধ।</li>
                    </ul>

                    <button class="btn-start-exam" id="btn-start-exam">
                        <i class="ph-bold ph-arrows-out"></i> ফুলস্ক্রিনে পরীক্ষা শুরু করুন
                    </button>
                </div>
            </div>

            @if($test->mode === 'sheet')
                <!-- Sheet Mode (বিসিসি প্রশ্নপত্র দেখে টাইপ) -->
                <div class="sheet-mode-wrapper">
                    <div class="sheet-question-pane">
                        <div class="sheet-header-tag">
                            <i class="ph-fill ph-file-text"></i> প্রশ্নপত্র প্যাসেজ (দেখে টাইপ করুন)
                        </div>
                        <div class="sheet-content-text lang-{{ $test->language }}" id="sheet-question-text">{!! nl2br(e($test->content)) !!}</div>
                    </div>

                    <div class="sheet-typing-pane">
                        <textarea id="sheet-input" class="sheet-textarea font-kalpurush" placeholder="এখানে দেখে দেখে সম্পূর্ণ প্যাসেজটি নির্ভুলভাবে টাইপ করুন..." autocomplete="off" spellcheck="false" oncopy="return false" oncut="return false" onpaste="return false"></textarea>
                    </div>
                </div>
            @else
                <!-- Screen Mode (অন-স্ক্রিন শব্দ বাই শব্দ হাইলাইটার) -->
                <div class="screen-passage-area lang-{{ $test->language }}" id="screen-passage-area" oncopy="return false" oncut="return false" onpaste="return false">
                    <!-- Words rendered via JS -->
                </div>
                <div class="screen-input-area">
                    <input type="text" id="screen-input" class="single-line-input font-kalpurush" placeholder="টাইপ করা শুরু করুন..." autocomplete="off" spellcheck="false" oncopy="return false" oncut="return false" onpaste="return false">
                </div>
            @endif

        </div>

        <!-- Bottom Action Bar -->
        <div class="bottom-actions">
            <span style="font-size:0.85rem; color:var(--text-muted);" id="exam-status-hint">
                <i class="ph ph-info"></i> পরীক্ষা শুরু হলে টাইপ করুন। নির্দিষ্ট সময় শেষ হলে স্বয়ংক্রিয়ভাবে খাতা জমা হয়ে যাবে।
            </span>
            <button class="btn-submit-exam" id="btn-submit-exam" style="display:none;">
                <i class="ph-bold ph-paper-plane-tilt"></i> পরীক্ষা সম্পন্ন করুন (Submit)
            </button>
        </div>

    </div>

    <!-- Anti-Cheat Warning Modal -->
    <div class="warning-modal" id="warning-modal">
        <div class="warning-card">
            <i class="ph-fill ph-warning-octagon"></i>
            <h3>সতর্কবার্তা! (Proctoring Violation)</h3>
            <p id="warning-msg">পরীক্ষা চলাকালীন ট্যাব পরিবর্তন বা উইন্ডো মিনিমাইজ করা সম্পূর্ণ নিষিদ্ধ!</p>
            <button class="btn-warning-ack" id="btn-warning-ack">আমি বুঝতে পেরেছি, ফেরত যাচ্ছি</button>
        </div>
    </div>

    <!-- Synchronous Bijoy Converter Script -->
    <script src="/js/bijoy-converter-global.js"></script>

    <script>
        const testMode = "{{ $test->mode }}";
        const rawContent = {!! json_encode($test->content) !!};
        const timeLimitSeconds = {{ $test->time_limit_minutes }} * 60;
        const submitUrl = "{{ route('test.submit', $test->id) }}";
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        const backspaceAllowed = {{ $test->backspace_allowed ? 'true' : 'false' }};

        // DOM elements
        const startOverlay = document.getElementById('start-overlay');
        const btnStartExam = document.getElementById('btn-start-exam');
        const btnSubmitExam = document.getElementById('btn-submit-exam');
        const timeDisplay = document.getElementById('time-display');
        const grossWpmDisplay = document.getElementById('gross-wpm-display');
        const accDisplay = document.getElementById('acc-display');
        const errorDisplay = document.getElementById('error-display');
        const warningModal = document.getElementById('warning-modal');
        const warningMsg = document.getElementById('warning-msg');
        const btnWarningAck = document.getElementById('btn-warning-ack');

        // Inputs
        const screenPassageArea = document.getElementById('screen-passage-area');
        const screenInput = document.getElementById('screen-input');
        const sheetInput = document.getElementById('sheet-input');

        // Engine State
        let isStarted = false;
        let isFinished = false;
        let timeRemaining = timeLimitSeconds;
        let examTimer = null;
        let totalKeystrokes = 0;
        let backspaceCount = 0;
        let tabSwitchWarnings = 0;

        // Screen mode variables
        let wordsArray = [];
        let wordElements = [];
        let currentWordIndex = 0;
        let correctWords = 0;
        let wrongWords = 0;
        let totalCorrectCharacters = 0;
        let typedWordsHistory = [];
        let screenTokensHistory = [];

        // Current Selected Keyboard Mode ('unicode' or 'bijoy')
        let activeKeyboardMode = "{{ $test->language === 'bn_bijoy' ? 'bijoy' : 'unicode' }}";

        function switchKeyboardMode(mode) {
            activeKeyboardMode = mode;

            // Update Header Switcher Buttons
            const btnUni = document.getElementById('btn-mode-unicode');
            const btnBijoy = document.getElementById('btn-mode-bijoy');
            if (btnUni && btnBijoy) {
                if (mode === 'unicode') {
                    btnUni.classList.add('active');
                    btnBijoy.classList.remove('active');
                } else {
                    btnBijoy.classList.add('active');
                    btnUni.classList.remove('active');
                }
            }

            // Sync Modal Radio
            const radios = document.getElementsByName('modal_kb_mode');
            radios.forEach(r => {
                if (r.value === mode) r.checked = true;
            });

            // Adjust input font family according to mode
            if (screenInput) {
                if (mode === 'bijoy') {
                    screenInput.classList.remove('font-kalpurush');
                    screenInput.classList.add('font-sutonny');
                    screenInput.style.fontFamily = "'SutonnyMJ', sans-serif";
                    screenInput.placeholder = "বিজয় বায়ান্ন দিয়ে টাইপ করুন (Ctrl+Alt+B)...";
                } else {
                    screenInput.classList.remove('font-sutonny');
                    screenInput.classList.add('font-kalpurush');
                    screenInput.style.fontFamily = "'Kalpurush', 'Hind Siliguri', sans-serif";
                    screenInput.placeholder = "ইউনিকোড / অভ্র দিয়ে টাইপ করুন (Ctrl+Alt+V)...";
                }
            }

            if (sheetInput) {
                if (mode === 'bijoy') {
                    sheetInput.classList.remove('font-kalpurush');
                    sheetInput.classList.add('font-sutonny');
                    sheetInput.style.fontFamily = "'SutonnyMJ', sans-serif";
                    sheetInput.placeholder = "বিজয় বায়ান্ন দিয়ে দেখে দেখে সম্পূর্ণ প্যাসেজ টাইপ করুন (Ctrl+Alt+B)...";
                } else {
                    sheetInput.classList.remove('font-sutonny');
                    sheetInput.classList.add('font-kalpurush');
                    sheetInput.style.fontFamily = "'Kalpurush', 'Hind Siliguri', sans-serif";
                    sheetInput.placeholder = "ইউনিকোড / অভ্র দিয়ে দেখে দেখে সম্পূর্ণ প্যাসেজ টাইপ করুন (Ctrl+Alt+V)...";
                }
            }
        }

        // Initialize Test
        function initEngine() {
            if (testMode === 'screen' && screenPassageArea) {
                wordsArray = rawContent.trim().split(/\s+/);
                screenPassageArea.innerHTML = '';
                wordsArray.forEach((word, idx) => {
                    const span = document.createElement('span');
                    span.innerText = word;
                    span.className = 'word' + (idx === 0 ? ' active' : '');
                    screenPassageArea.appendChild(span);
                    screenPassageArea.appendChild(document.createTextNode(' '));
                    wordElements.push(span);
                });
            }
            switchKeyboardMode(activeKeyboardMode);
        }

        // Start Test
        function startExam() {
            if (isStarted) return;
            isStarted = true;

            // Show submit button once exam starts
            if (btnSubmitExam) btnSubmitExam.style.display = 'inline-flex';

            // Request Fullscreen
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen().catch(err => console.log(err));
            }

            startOverlay.classList.add('hidden');

            if (testMode === 'screen' && screenInput) {
                screenInput.focus();
            } else if (testMode === 'sheet' && sheetInput) {
                sheetInput.focus();
            }

            examTimer = setInterval(() => {
                timeRemaining--;
                updateTimerDisplay();
                updateLiveStats();

                if (timeRemaining <= 0) {
                    finishExam();
                }
            }, 1000);
        }

        function updateTimerDisplay() {
            const minutes = Math.floor(timeRemaining / 60);
            const seconds = timeRemaining % 60;
            timeDisplay.innerText = `${minutes}:${seconds.toString().padStart(2, '0')}`;

            if (timeRemaining <= 60) {
                timeDisplay.classList.add('warning');
            }
        }

        const netWpmDisplay = document.getElementById('net-wpm-display');
        const errorRateDisplay = document.getElementById('error-rate-display');

        function updateLiveStats() {
            const timeElapsed = (timeLimitSeconds - timeRemaining) / 60;
            if (timeElapsed <= 0) return;

            if (testMode === 'screen') {
                // Official 5 Keystroke Rule for Gross WPM
                const grossWpm = totalKeystrokes > 0 
                    ? Math.round((totalKeystrokes / 5) / timeElapsed) 
                    : Math.round((correctWords + wrongWords) / timeElapsed);
                grossWpmDisplay.innerText = grossWpm;

                // BCC Net WPM Formula: Gross WPM - (Errors / TimeElapsed)
                const errorPenalty = Math.round(wrongWords / timeElapsed);
                const netWpm = Math.max(0, grossWpm - errorPenalty);
                if (netWpmDisplay) netWpmDisplay.innerText = netWpm;

                const totalAttempted = correctWords + wrongWords;
                const acc = totalAttempted === 0 ? 100 : Math.round((correctWords / totalAttempted) * 100);
                accDisplay.innerText = acc + '%';

                const errorRate = totalAttempted === 0 ? 0 : ((wrongWords / totalAttempted) * 100).toFixed(1);
                if (errorRateDisplay) {
                    errorRateDisplay.innerText = errorRate + '%';
                    if (parseFloat(errorRate) > 5.0) {
                        errorRateDisplay.style.color = '#ef4444';
                    } else {
                        errorRateDisplay.style.color = '#34d399';
                    }
                }
            } else if (testMode === 'sheet' && sheetInput) {
                const text = sheetInput.value.trim();
                const charCount = text.length;
                const grossWpm = Math.round((charCount / 5) / timeElapsed);
                grossWpmDisplay.innerText = grossWpm > 0 ? grossWpm : 0;
                if (netWpmDisplay) netWpmDisplay.innerText = grossWpm > 0 ? grossWpm : 0;
            }
        }

        function finishExam() {
            if (isFinished) return;
            isFinished = true;
            clearInterval(examTimer);

            if (screenInput) screenInput.disabled = true;
            if (sheetInput) sheetInput.disabled = true;

            btnSubmitExam.innerText = 'মূল্যায়ন করা হচ্ছে...';
            btnSubmitExam.disabled = true;

            submitExamData();
        }

        function submitExamData() {
            const timeTaken = timeLimitSeconds - timeRemaining;
            let payload = {
                time_taken_seconds: timeTaken > 0 ? timeTaken : 1,
                total_keystrokes: totalKeystrokes,
                backspace_count: backspaceCount,
                tab_switch_warnings: tabSwitchWarnings,
                typed_text: testMode === 'sheet' ? (sheetInput ? sheetInput.value : '') : ''
            };

            if (testMode === 'screen') {
                payload.correct_words = correctWords;
                payload.wrong_words = wrongWords;
                payload.total_errors = wrongWords;
                payload.total_words = correctWords + wrongWords;
                payload.typed_text = typedWordsHistory.join(' ');
                payload.evaluation_details = JSON.stringify(screenTokensHistory);
            }

            fetch(submitUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success && data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    alert(data.message || 'ফলাফল সংরক্ষণ করতে সমস্যা হয়েছে।');
                    btnSubmitExam.innerText = 'পুনরায় চেষ্টা করুন';
                    btnSubmitExam.disabled = false;
                }
            })
            .catch(err => {
                console.error(err);
                alert('সার্ভারে ফলাফল পাঠাতে সমস্যা হয়েছে। ইন্টারনেট সংযোগ চেক করুন।');
                btnSubmitExam.innerText = 'পুনরায় চেষ্টা করুন';
                btnSubmitExam.disabled = false;
            });
        }

        function normalizeBangla(str) {
            if (!str) return '';
            try {
                if (str.normalize) str = str.normalize('NFC');
            } catch(e) {}
            
            // Normalize decomposed Bengali characters
            str = str.replace(/\u09AF\u09BC/g, 'য়');
            str = str.replace(/\u09A1\u09BC/g, 'ড়');
            str = str.replace(/\u09A2\u09BC/g, 'ঢ়');
            str = str.replace(/\u0985\u09BE/g, 'আ');
            str = str.replace(/\u09C7\u09BE/g, 'ো');
            str = str.replace(/\u09C7\u09D7/g, 'ৌ');
            str = str.replace(/\u09A4\u09CD\u200D/g, 'ৎ');
            str = str.replace(/\|/g, '।');
            str = str.replace(/[\u200B-\u200D\uFEFF\u00AD]/g, '');

            // Strip trailing/leading punctuation so word matches whether danda is typed or omitted
            str = str.replace(/[।,.:;?!"'‘’“”()]/g, '');

            // Unify spelling variants of compound conjuncts
            str = str.replace(/ত্ব/g, 'ত্ত');
            str = str.replace(/্ত্ত/g, 'ত্ত');
            str = str.replace(/স্বায়/g, 'স্বায়');

            return str.trim();
        }

        function matchesWord(typed, target) {
            if (!typed || !target) return false;
            
            const nTyped = normalizeBangla(typed);
            const nTarget = normalizeBangla(target);

            // 1. Direct Unicode / Avro match
            if (typed === target || nTyped === nTarget) {
                return true;
            }

            // 2. Bijoy Classic match (convert typed Bijoy to Unicode)
            if (window.convertBijoyToUnicode) {
                try {
                    const convertedTyped = window.convertBijoyToUnicode(typed);
                    const nConverted = normalizeBangla(convertedTyped);
                    if (convertedTyped === target || nConverted === nTarget || nConverted === target || convertedTyped === nTarget) {
                        return true;
                    }
                    const convertedTarget = window.convertBijoyToUnicode(target);
                    const nConvertedTarget = normalizeBangla(convertedTarget);
                    if (typed === convertedTarget || nTyped === nConvertedTarget || typed === nConvertedTarget) {
                        return true;
                    }
                    if (nConverted === nConvertedTarget || convertedTyped === convertedTarget) {
                        return true;
                    }
                } catch(e) {}
            }

            return false;
        }

        function matchesPrefix(typed, target) {
            if (!typed) return true;

            const nTyped = normalizeBangla(typed);
            const nTarget = normalizeBangla(target);

            if (target.startsWith(typed) || nTarget.startsWith(nTyped)) return true;

            if (window.convertBijoyToUnicode) {
                try {
                    const convertedTyped = window.convertBijoyToUnicode(typed);
                    const nConverted = normalizeBangla(convertedTyped);
                    if (target.startsWith(convertedTyped) || nTarget.startsWith(nConverted)) {
                        return true;
                    }
                } catch(e) {}
            }

            return false;
        }

        // Screen Mode Typing Listener
        if (screenInput) {
            screenInput.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace') {
                    backspaceCount++;
                    if (!backspaceAllowed) {
                        e.preventDefault();
                        return;
                    }
                }
                totalKeystrokes++;
            });

            screenInput.addEventListener('input', (e) => {
                if (isFinished) return;
                if (!isStarted) startExam();

                let typedValue = screenInput.value;
                const targetWord = wordsArray[currentWordIndex];

                if (typedValue.endsWith(' ')) {
                    const typedWord = typedValue.trim();
                    const isCorrect = matchesWord(typedWord, targetWord);

                    let finalSavedWord = typedWord;
                    if (activeKeyboardMode === 'bijoy' && window.convertBijoyToUnicode) {
                        try {
                            const converted = window.convertBijoyToUnicode(typedWord);
                            if (converted && converted.trim()) finalSavedWord = converted;
                        } catch(e) {}
                    }
                    typedWordsHistory.push(finalSavedWord);

                    if (isCorrect) {
                        wordElements[currentWordIndex].className = 'word correct';
                        correctWords++;
                        totalCorrectCharacters += targetWord.length + 1;
                        screenTokensHistory.push({ type: 'correct', word: finalSavedWord });
                    } else {
                        wordElements[currentWordIndex].className = 'word incorrect';
                        wrongWords++;
                        screenTokensHistory.push({ type: 'wrong', word: finalSavedWord, expected: targetWord });
                    }

                    screenInput.value = '';
                    screenInput.classList.remove('error');
                    currentWordIndex++;

                    if (currentWordIndex < wordsArray.length) {
                        const nextEl = wordElements[currentWordIndex];
                        nextEl.className = 'word active';

                        // Auto-scroll
                        if (nextEl.offsetTop > screenPassageArea.scrollTop + 140) {
                            screenPassageArea.scrollTo({ top: nextEl.offsetTop - 60, behavior: 'smooth' });
                        }
                    } else {
                        finishExam();
                    }
                } else {
                    const isPrefix = matchesPrefix(typedValue, targetWord);

                    if (!isPrefix && typedValue.length > 0) {
                        screenInput.classList.add('error');
                    } else {
                        screenInput.classList.remove('error');
                    }
                }

                updateLiveStats();
            });
        }

        // Sheet Mode Typing Listener
        if (sheetInput) {
            sheetInput.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace') {
                    backspaceCount++;
                    if (!backspaceAllowed) {
                        e.preventDefault();
                        return;
                    }
                }
                totalKeystrokes++;
            });

            sheetInput.addEventListener('input', () => {
                if (!isStarted) startExam();
                updateLiveStats();
            });
        }

        // Anti-Cheat & Proctoring Engine (Tab-switch Detection)
        document.addEventListener('visibilitychange', () => {
            if (isStarted && !isFinished && document.hidden) {
                tabSwitchWarnings++;
                if (tabSwitchWarnings >= 3) {
                    warningMsg.innerText = "আপনি ৩ বার পরীক্ষার উইন্ডো ত্যাগ করেছেন! বিসিসি নিয়মানুযায়ী পরীক্ষা স্বয়ংক্রিয়ভাবে জমা দেওয়া হচ্ছে।";
                    warningModal.style.display = 'flex';
                    setTimeout(() => { finishExam(); }, 2000);
                } else {
                    warningMsg.innerText = `সতর্কবার্তা (${tabSwitchWarnings}/৩): পরীক্ষা চলাকালীন উইন্ডো ত্যাগ নিষিদ্ধ! ৩ বার হলে পরীক্ষা বাতিল হবে।`;
                    warningModal.style.display = 'flex';
                }
            }
        });

        btnWarningAck.addEventListener('click', () => {
            warningModal.style.display = 'none';
            if (testMode === 'screen' && screenInput) screenInput.focus();
            if (testMode === 'sheet' && sheetInput) sheetInput.focus();
        });

        // Event Listeners
        btnStartExam.addEventListener('click', startExam);
        btnSubmitExam.addEventListener('click', () => {
            if (confirm('আপনি কি নিশ্চিত যে পরীক্ষাটি এখনই সাবমিট করতে চান?')) {
                finishExam();
            }
        });

        // Disable standard keyboard devtools / shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.key === 'F12' || (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J')) || (e.ctrlKey && e.key === 'u')) {
                e.preventDefault();
                return false;
            }
        });

        // Initialize on load
        initEngine();
    </script>
</body>
</html>
