<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ব্যাচ রেজাল্ট শিট ও মূল্যায়ন রিপোর্ট - {{ $institution->name }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Hind Siliguri', 'Inter', sans-serif; }
        body { background: #f8fafc; color: #0f172a; padding: 2.5rem; }

        .report-header-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 3px double #0f172a;
            padding-bottom: 1.5rem;
            margin-bottom: 2rem;
        }
        .header-logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 8px;
        }
        .header-logo-placeholder {
            width: 75px;
            height: 75px;
            background: #2563eb;
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
        }
        .header-center-info {
            text-align: center;
            flex: 1;
            padding: 0 1.5rem;
        }
        .header-center-info h1 {
            font-size: 2.1rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
        }
        .header-center-info .tagline {
            font-size: 0.95rem;
            color: #2563eb;
            font-weight: 700;
            margin-top: 2px;
        }
        .header-center-info .address {
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 4px;
        }

        .report-meta-box {
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 10px 18px;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.92rem;
            font-weight: 600;
        }

        .report-table { width: 100%; border-collapse: collapse; margin-bottom: 2rem; background: white; font-size: 0.92rem; }
        .report-table th, .report-table td { border: 1px solid #94a3b8; padding: 10px 12px; text-align: left; }
        .report-table th { background: #0f172a; color: white; font-weight: 700; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
        
        .badge-pass { background: #d1fae5; color: #065f46; padding: 3px 8px; border-radius: 4px; font-weight: 800; font-size: 0.8rem; }
        .badge-fail { background: #fee2e2; color: #991b1b; padding: 3px 8px; border-radius: 4px; font-weight: 800; font-size: 0.8rem; }

        .btn-print { background: #2563eb; color: white; border: none; padding: 0.75rem 1.8rem; border-radius: 8px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; font-size: 1rem; }
        
        .signature-area {
            margin-top: 4rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding: 0 2rem;
        }
        .sig-block {
            text-align: center;
            width: 220px;
        }
        .sig-img {
            max-height: 50px;
            margin-bottom: 6px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .sig-line {
            border-top: 1.5px solid #0f172a;
            padding-top: 6px;
            font-size: 0.88rem;
            font-weight: 700;
        }

        @media print {
            .no-print { display: none !important; }
            body { padding: 0.5cm; background: white; }
            .report-table th { background: #000 !important; color: #fff !important; -webkit-print-color-adjust: exact; }
            .report-meta-box { background: #eee !important; -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body>

    <div class="no-print" style="margin-bottom:1.8rem; display:flex; justify-content:space-between; align-items:center;">
        <a href="{{ route('institution.dashboard') }}" style="text-decoration:none; color:#2563eb; font-weight:700; display:inline-flex; align-items:center; gap:6px;">
            <i class="ph ph-arrow-left"></i> ড্যাশবোর্ডে ফিরে যান
        </a>

        <div style="display:flex; gap:10px; align-items:center;">
            <!-- Filter by Batch on Report -->
            <form method="GET" action="{{ route('institution.report') }}" style="display:flex; align-items:center; gap:6px;">
                <label style="font-size:0.88rem; font-weight:600;">ব্যাচ ফিল্টার:</label>
                <select name="batch" onchange="this.form.submit()" style="padding:6px 12px; border-radius:6px; border:1px solid #cbd5e1; font-weight:600;">
                    <option value="all" {{ ($batch ?? 'all') === 'all' ? 'selected' : '' }}>সকল ব্যাচ</option>
                    @foreach($batches as $b)
                        <option value="{{ $b }}" {{ ($batch ?? '') === $b ? 'selected' : '' }}>{{ $b }}</option>
                    @endforeach
                </select>
            </form>
            <button class="btn-print" onclick="window.print()"><i class="ph-bold ph-printer"></i> প্রিন্ট / PDF এক্সপোর্ট</button>
        </div>
    </div>

    <!-- Official Header with Custom Coaching Logo & Branding -->
    <div class="report-header-wrap">
        <div>
            @if($institution->logo_path)
                <img src="{{ $institution->logo_path }}" alt="Logo" class="header-logo">
            @else
                <div class="header-logo-placeholder">
                    <i class="ph-fill ph-buildings"></i>
                </div>
            @endif
        </div>
        <div class="header-center-info">
            <h1>{{ $institution->name }}</h1>
            @if($institution->tagline)
                <div class="tagline">{{ $institution->tagline }}</div>
            @endif
            <div class="address">
                {{ $institution->address ?? 'কম্পিউটার টাইপিং ও দক্ষতা উন্নয়ন প্রশিক্ষণ কেন্দ্র' }}
                @if($institution->phone) • ফোন: {{ $institution->phone }} @endif
                @if($institution->email) • ইমেইল: {{ $institution->email }} @endif
            </div>
            <h3 style="font-size:1.15rem; color:#0f172a; margin-top:10px; font-weight:800;">
                সরকারি ও বিসিসি স্ট্যান্ডার্ড টাইপিং পরীক্ষা - ব্যাচ মূল্যায়ন ফলাফল শিট
            </h3>
        </div>
        <div style="width:80px; text-align:right;">
            <div style="font-size:0.75rem; color:#64748b; font-weight:700;">SelfTyping Verified</div>
            <i class="ph-fill ph-seal-check" style="font-size:2.2rem; color:#10b981;"></i>
        </div>
    </div>

    <!-- Report Meta Information Bar -->
    <div class="report-meta-box">
        <div>
            ব্যাচ: <strong style="color:#2563eb;">{{ ($batch ?? 'all') === 'all' ? 'সকল ব্যাচ' : $batch }}</strong>
        </div>
        <div>
            মোট পরীক্ষার্থী ফলাফল: <strong>{{ $results->count() }}</strong> জন
        </div>
        <div>
            পাসের হার: <strong>{{ $results->count() > 0 ? round(($results->where('is_passed', true)->count() / $results->count()) * 100) : 0 }}%</strong>
        </div>
        <div>
            তারিখ: {{ date('d F Y, h:i A') }}
        </div>
    </div>

    <!-- Results Table -->
    <table class="report-table">
        <thead>
            <tr>
                <th style="width:40px; text-align:center;">ক্রমিক</th>
                <th style="width:90px;">রোল নং</th>
                <th>শিক্ষার্থীর নাম</th>
                <th>ব্যাচ</th>
                <th>পরীক্ষার নাম</th>
                <th style="text-align:center;">Gross WPM</th>
                <th style="text-align:center;">Net WPM</th>
                <th style="text-align:center;">অ্যাকুরেসি</th>
                <th style="text-align:center;">ভুলের হার</th>
                <th style="text-align:center;">ফলাফল</th>
                <th style="width:90px;">তারিখ</th>
            </tr>
        </thead>
        <tbody>
            @forelse($results as $res)
                <tr>
                    <td style="text-align:center; font-weight:700;">{{ $loop->iteration }}</td>
                    <td style="font-family:monospace; font-weight:700;">{{ $res->user->student_roll ?? 'ST-'.($res->user->id ?? '0') }}</td>
                    <td><strong>{{ $res->user->name ?? 'Student' }}</strong></td>
                    <td><span style="font-weight:600; color:#2563eb;">{{ $res->user->batch_name ?? 'সাধারণ' }}</span></td>
                    <td>{{ $res->typingTest->title ?? '' }}</td>
                    <td style="font-family:monospace; font-weight:700; text-align:center;">{{ $res->gross_wpm }}</td>
                    <td style="font-family:monospace; font-weight:900; color:#2563eb; font-size:1.05rem; text-align:center;">{{ $res->net_wpm }}</td>
                    <td style="color:#059669; font-weight:800; text-align:center;">{{ $res->accuracy }}%</td>
                    <td style="color:{{ $res->error_percentage > 5.0 ? '#dc2626' : '#64748b' }}; text-align:center; font-weight:700;">{{ $res->error_percentage }}%</td>
                    <td style="text-align:center;">
                        <span class="{{ $res->is_passed ? 'badge-pass' : 'badge-fail' }}">
                            {{ $res->is_passed ? 'উত্তীর্ণ (PASS)' : 'অনুত্তীর্ণ (FAIL)' }}
                        </span>
                    </td>
                    <td style="font-size:0.85rem; color:#64748b;">{{ $res->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" style="text-align:center; padding:2.5rem; color:#64748b;">এখনও কোনো পরীক্ষার ফলাফল জমা হয়নি।</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Signature Block with Uploaded Director Signature -->
    <div class="signature-area">
        <div class="sig-block">
            <div style="height:50px;"></div>
            <div class="sig-line">পরীক্ষা নিয়ন্ত্রক / ইনস্ট্রাক্টরের স্বাক্ষর</div>
        </div>

        <div class="sig-block">
            @if($institution->signature_path)
                <img src="{{ $institution->signature_path }}" alt="Director Signature" class="sig-img">
            @else
                <div style="height:50px;"></div>
            @endif
            <div class="sig-line">পরিচালকের স্বাক্ষর ও সীলমোহর</div>
        </div>
    </div>

</body>
</html>
