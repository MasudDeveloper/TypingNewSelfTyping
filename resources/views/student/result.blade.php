<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>পরীক্ষার মূল্যায়নপত্র ও মার্কশিট - {{ $result->typingTest->title }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <!-- Bengali Local Fonts -->
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
            --bg-body: #f1f5f9;
            --bg-surface: #ffffff;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Hind Siliguri', 'Inter', sans-serif; }

        body {
            background: var(--bg-body);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            height: 64px;
            padding: 0 2rem;
            background: var(--bg-surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h2 { font-size: 1.15rem; font-weight: 700; color: var(--text-dark); }
        .back-btn {
            color: var(--text-muted);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: 1px solid var(--border);
            transition: 0.2s;
        }
        .back-btn:hover { background: #f8fafc; color: var(--text-dark); }

        .container {
            max-width: 920px;
            margin: 2.5rem auto;
            width: 100%;
            padding: 0 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        /* Official Marksheet Card */
        .marksheet-card {
            background: var(--bg-surface);
            border: 2px solid var(--border);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
        }
        .marksheet-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: {{ $result->is_passed ? 'linear-gradient(90deg, #10b981, #059669)' : 'linear-gradient(90deg, #ef4444, #dc2626)' }};
        }

        .marksheet-header {
            text-align: center;
            border-bottom: 2px dashed var(--border);
            padding-bottom: 2rem;
            margin-bottom: 2rem;
            position: relative;
        }
        .gov-logo-badge {
            width: 60px;
            height: 60px;
            background: #eff6ff;
            color: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1rem auto;
            border: 2px solid #bfdbfe;
        }
        .marksheet-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.5px;
        }
        .marksheet-subtitle {
            font-size: 0.95rem;
            color: var(--text-muted);
            margin-top: 4px;
        }

        /* Candidate & Exam Metadata Grid */
        .meta-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.2rem 1.5rem;
            margin-bottom: 2.5rem;
            font-size: 0.95rem;
        }
        .meta-item { display: flex; gap: 8px; }
        .meta-label { color: var(--text-muted); font-weight: 600; min-width: 130px; }
        .meta-val { color: var(--text-dark); font-weight: 700; }

        /* Status & Speed Banner */
        .status-banner {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 2rem;
            align-items: center;
            background: {{ $result->is_passed ? '#ecfdf5' : '#fef2f2' }};
            border: 1.5px solid {{ $result->is_passed ? '#a7f3d0' : '#fecaca' }};
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2.5rem;
        }
        .status-col {
            text-align: center;
            border-right: 1px dashed {{ $result->is_passed ? '#a7f3d0' : '#fecaca' }};
            padding-right: 1.5rem;
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 18px;
            border-radius: 30px;
            font-size: 1.1rem;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 0.6rem;
            background: {{ $result->is_passed ? '#10b981' : '#ef4444' }};
            color: white;
        }
        .status-reason {
            font-size: 0.88rem;
            color: {{ $result->is_passed ? '#065f46' : '#991b1b' }};
            font-weight: 600;
            line-height: 1.4;
        }

        .net-wpm-col {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .speed-circle {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: white;
            border: 6px solid {{ $result->is_passed ? '#10b981' : '#ef4444' }};
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(0,0,0,0.06);
        }
        .speed-circle .val {
            font-size: 2.4rem;
            font-weight: 800;
            font-family: 'JetBrains Mono', monospace;
            color: {{ $result->is_passed ? '#10b981' : '#ef4444' }};
            line-height: 1;
        }
        .speed-circle .lbl {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-top: 2px;
        }
        .speed-info h4 { font-size: 1.2rem; font-weight: 700; color: var(--text-dark); margin-bottom: 4px; }
        .speed-info p { font-size: 0.88rem; color: var(--text-muted); line-height: 1.5; }

        /* Full Performance Matrix Table */
        .matrix-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .matrix-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 2.5rem;
        }
        .matrix-box {
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.2rem 1rem;
            text-align: center;
        }
        .matrix-box .val {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--text-dark);
            font-family: 'JetBrains Mono', monospace;
            line-height: 1.2;
            margin-bottom: 4px;
        }
        .matrix-box .lbl {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 600;
        }
        .matrix-box.success .val { color: var(--success); }
        .matrix-box.danger .val { color: var(--danger); }
        .matrix-box.warning .val { color: var(--warning); }

        /* Visual Diff Container for Sheet Mode */
        .diff-container {
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.8rem;
            margin-bottom: 2.5rem;
        }
        .diff-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.2rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid var(--border);
        }
        .diff-legend {
            display: flex;
            gap: 12px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .legend-item { display: flex; align-items: center; gap: 4px; }
        .legend-color { width: 12px; height: 12px; border-radius: 3px; }

        .diff-body {
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1.5rem;
            line-height: 2.2;
            font-size: 1.25rem;
        }
        .token-correct { color: #059669; font-weight: 500; }
        .token-wrong { color: #dc2626; background: #fee2e2; padding: 2px 6px; border-radius: 4px; text-decoration: line-through; font-weight: 600; }
        .token-omitted { color: #d97706; background: #fef3c7; padding: 2px 6px; border-radius: 4px; font-weight: 600; font-size: 0.9em; }
        .token-extra { color: #7c3aed; background: #ede9fe; padding: 2px 6px; border-radius: 4px; font-weight: 600; }

        /* Actions Footer */
        .actions-bar {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        .btn {
            padding: 0.85rem 1.8rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            border: none;
        }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-outline { background: white; color: var(--text-dark); border: 1.5px solid var(--border); }
        .btn-outline:hover { background: #f8fafc; border-color: var(--text-dark); }
        .btn-print { background: #0f172a; color: white; }
        .btn-print:hover { background: #1e293b; }

        /* Print Specific Styling */
        @media print {
            body { background: white; }
            .header, .actions-bar, .back-btn { display: none !important; }
            .container { max-width: 100%; margin: 0; padding: 0; }
            .marksheet-card { border: none; box-shadow: none; padding: 0; }
        }
    </style>
</head>
<body>

    <header class="header">
        <div style="display:flex; align-items:center; gap:1rem;">
            <a href="{{ route('dashboard') }}" class="back-btn"><i class="ph ph-arrow-left"></i></a>
            <h2>মূল্যায়ন ফলাফল ও সার্টিফিকেট</h2>
        </div>
        <button onclick="window.print()" class="btn btn-print" style="padding:0.5rem 1.2rem; font-size:0.88rem;">
            <i class="ph-bold ph-printer"></i> প্রিন্ট / PDF
        </button>
    </header>

    <div class="container">
        
        <div class="marksheet-card">
            
            <div class="marksheet-header">
                <div class="gov-logo-badge">
                    <i class="ph-fill ph-seal-check"></i>
                </div>
                <h1 class="marksheet-title">সরকারি ও বিসিসি টাইপিং মূল্যায়ন মার্কশিট</h1>
                <p class="marksheet-subtitle">Government & BCC Standard Typing Assessment Report</p>
            </div>

            <!-- Candidate Details -->
            <div class="meta-grid">
                <div class="meta-item">
                    <span class="meta-label">পরীক্ষার্থীর নাম:</span>
                    <span class="meta-val">{{ $result->user->name ?? 'Student' }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">পরীক্ষার নাম:</span>
                    <span class="meta-val">{{ $result->typingTest->title }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">ক্যাটাগরি / ল্যাব:</span>
                    <span class="meta-val">{{ $result->typingTest->category }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">ভাষা ও মোড:</span>
                    <span class="meta-val">{{ strtoupper($result->typingTest->language) }} ({{ strtoupper($result->typingTest->mode) }} মোড)</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">পরীক্ষার তারিখ:</span>
                    <span class="meta-val">{{ $result->created_at->format('d M Y, h:i A') }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">পাসিং মানদণ্ড:</span>
                    <span class="meta-val">{{ $result->typingTest->pass_wpm }} WPM (সর্বোচ্চ ৫% ভুল)</span>
                </div>
            </div>

            <!-- Pass / Fail & Net Speed Banner -->
            <div class="status-banner">
                <div class="status-col">
                    @if($result->is_passed)
                        <div class="status-badge">
                            <i class="ph-fill ph-check-circle"></i> উত্তীর্ণ (PASSED)
                        </div>
                        <p class="status-reason">অভিনন্দন! গতি ও নির্ভুলতা উভয়ই সরকারি ও বিসিসি মানদণ্ড অনুযায়ী উত্তীর্ণ হয়েছে।</p>
                    @else
                        <div class="status-badge">
                            <i class="ph-fill ph-x-circle"></i> অকৃতকার্য (FAILED)
                        </div>
                        <p class="status-reason">
                            @if($result->error_percentage > 5.0)
                                ভুলের পরিমাণ সরকারি নির্ধারিত ৫% এর বেশি ({{ $result->error_percentage }}%) হয়েছে।
                            @else
                                নেট স্পিড নির্ধারিত পাসিং স্পিডের ({{ $result->typingTest->pass_wpm }} WPM) চেয়ে কম হয়েছে।
                            @endif
                        </p>
                    @endif
                </div>

                <div class="net-wpm-col">
                    <div class="speed-circle">
                        <div class="val">{{ $result->net_wpm }}</div>
                        <div class="lbl">Net WPM</div>
                    </div>
                    <div class="speed-info">
                        <h4>অফিসিয়াল নেট স্পিড</h4>
                        <p>ভুল পেনাল্টি কর্তন করার পর প্রকৃত গতি: <strong>{{ $result->net_wpm }} WPM</strong></p>
                    </div>
                </div>
            </div>

            <!-- Performance Matrix -->
            <h3 class="matrix-title"><i class="ph-fill ph-chart-bar" style="color:var(--primary);"></i> বিস্তারিত পারফরম্যান্স ম্যাট্রিক্স</h3>
            
            <div class="matrix-grid">
                <div class="matrix-box">
                    <div class="val">{{ $result->gross_wpm }}</div>
                    <div class="lbl">Gross WPM</div>
                </div>
                <div class="matrix-box success">
                    <div class="val">{{ $result->accuracy }}%</div>
                    <div class="lbl">অ্যাকুরেসি (Accuracy)</div>
                </div>
                <div class="matrix-box {{ $result->error_percentage > 5.0 ? 'danger' : 'warning' }}">
                    <div class="val">{{ $result->error_percentage }}%</div>
                    <div class="lbl">ভুলের হার (Max 5%)</div>
                </div>
                <div class="matrix-box danger">
                    <div class="val">{{ $result->total_errors }}</div>
                    <div class="lbl">মোট ভুল শব্দ</div>
                </div>
                <div class="matrix-box">
                    <div class="val">{{ $result->total_words }}</div>
                    <div class="lbl">মোট টাইপকৃত শব্দ</div>
                </div>
                <div class="matrix-box success">
                    <div class="val">{{ $result->correct_words }}</div>
                    <div class="lbl">সঠিক শব্দ</div>
                </div>
                <div class="matrix-box">
                    <div class="val">{{ $result->total_keystrokes }}</div>
                    <div class="lbl">মোট কি-স্ট্রোক</div>
                </div>
                <div class="matrix-box">
                    <div class="val">{{ floor($result->time_taken_seconds / 60) }}m {{ $result->time_taken_seconds % 60 }}s</div>
                    <div class="lbl">ব্যয়িত সময়</div>
                </div>
            </div>

            <!-- Sheet Mode Visual Diff Analysis (If available) -->
            @if(!empty($result->evaluation_details))
                <div class="diff-container">
                    <div class="diff-header">
                        <h4 style="font-size:1.05rem; font-weight:700; color:var(--text-dark);">
                            <i class="ph-fill ph-magnifying-glass"></i> প্যাসেজ ভিত্তিক ভুল বিশ্লেষণ (Diff Analysis)
                        </h4>
                        <div class="diff-legend">
                            <div class="legend-item"><span class="legend-color" style="background:#10b981;"></span> সঠিক</div>
                            <div class="legend-item"><span class="legend-color" style="background:#ef4444;"></span> ভুল/বানান ভুল</div>
                            <div class="legend-item"><span class="legend-color" style="background:#f59e0b;"></span> বাদ পড়া শব্দ</div>
                            <div class="legend-item"><span class="legend-color" style="background:#8b5cf6;"></span> অতিরিক্ত শব্দ</div>
                        </div>
                    </div>

                    <div class="diff-body lang-{{ $result->typingTest->language }}">
                        @foreach($result->evaluation_details as $token)
                            @if($token['type'] === 'correct')
                                <span class="token-correct">{{ $token['word'] }} </span>
                            @elseif($token['type'] === 'wrong')
                                <span class="token-wrong" title="Expected: {{ $token['expected'] ?? '' }}">{{ $token['word'] }} </span>
                            @elseif($token['type'] === 'omitted')
                                <span class="token-omitted" title="Missed word">[{{ $token['word'] }}] </span>
                            @elseif($token['type'] === 'extra')
                                <span class="token-extra" title="Extra word typed">{{ $token['word'] }} </span>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Bottom Actions -->
            <div class="actions-bar">
                <a href="{{ route('test.show', $result->typing_test_id) }}" class="btn btn-outline">
                    <i class="ph-bold ph-arrow-counter-clockwise"></i> পুনরায় পরীক্ষা দিন
                </a>
                <button onclick="window.print()" class="btn btn-print">
                    <i class="ph-bold ph-printer"></i> মার্কশিট প্রিন্ট / ডাউনলোড
                </button>
                <a href="{{ route('dashboard') }}" class="btn btn-primary">
                    <i class="ph-bold ph-squares-four"></i> ড্যাশবোর্ডে ফিরুন
                </a>
            </div>

        </div>

    </div>

</body>
</html>
