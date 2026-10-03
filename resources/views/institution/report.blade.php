<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ব্যাচ রেজাল্ট শিট ও মূল্যায়ন রিপোর্ট - {{ $institution->name }}</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Hind Siliguri', 'Inter', sans-serif; }
        body { background: #f8fafc; color: #0f172a; padding: 2rem; }
        .report-header { text-align: center; margin-bottom: 2rem; border-bottom: 2px solid #0f172a; padding-bottom: 1.5rem; }
        .report-header h1 { font-size: 1.8rem; font-weight: 800; }
        .report-header h3 { font-size: 1.2rem; color: #2563eb; margin: 4px 0; }
        .report-header p { font-size: 0.9rem; color: #64748b; }

        .report-table { width: 100%; border-collapse: collapse; margin-bottom: 2rem; background: white; font-size: 0.92rem; }
        .report-table th, .report-table td { border: 1px solid #cbd5e1; padding: 10px 14px; text-align: left; }
        .report-table th { background: #0f172a; color: white; font-weight: 700; text-transform: uppercase; font-size: 0.82rem; }
        
        .badge-pass { background: #d1fae5; color: #065f46; padding: 3px 8px; border-radius: 4px; font-weight: 700; }
        .badge-fail { background: #fee2e2; color: #991b1b; padding: 3px 8px; border-radius: 4px; font-weight: 700; }

        .btn-print { background: #2563eb; color: white; border: none; padding: 0.75rem 1.8rem; border-radius: 8px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; font-size: 1rem; }
        
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; background: white; }
            .report-table { border: 1px solid black; }
            .report-table th, .report-table td { border: 1px solid black; }
        }
    </style>
</head>
<body>

    <div class="no-print" style="margin-bottom:1.5rem; display:flex; justify-content:space-between; align-items:center;">
        <a href="{{ route('institution.dashboard') }}" style="text-decoration:none; color:#2563eb; font-weight:600;"><i class="ph ph-arrow-left"></i> ড্যাশবোর্ডে ফিরে যান</a>
        <button class="btn-print" onclick="window.print()"><i class="ph-bold ph-printer"></i> প্রিন্ট / PDF এক্সপোর্ট</button>
    </div>

    <div class="report-header">
        <h1>{{ $institution->name }}</h1>
        <h3>সরকারি ও বিসিসি টাইপিং পরীক্ষা - ব্যাচ মূল্যায়ন ফলাফল</h3>
        <p>রিপোর্ট তৈরির তারিখ: {{ date('d F Y, h:i A') }} • সর্বমোট পরীক্ষার্থী ফলাফল: {{ $results->count() }} টি</p>
    </div>

    <table class="report-table">
        <thead>
            <tr>
                <th>ক্রমিক</th>
                <th>শিক্ষার্থীর নাম</th>
                <th>ইমেইল</th>
                <th>পরীক্ষার নাম</th>
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
                    <td>{{ $loop->iteration }}</td>
                    <td><strong>{{ $res->user->name ?? 'Student' }}</strong></td>
                    <td style="color:#64748b;">{{ $res->user->email ?? '' }}</td>
                    <td>{{ $res->typingTest->title ?? '' }}</td>
                    <td style="font-family:monospace; font-weight:700;">{{ $res->gross_wpm }}</td>
                    <td style="font-family:monospace; font-weight:800; color:#2563eb; font-size:1.05rem;">{{ $res->net_wpm }}</td>
                    <td style="color:#059669; font-weight:700;">{{ $res->accuracy }}%</td>
                    <td style="color:{{ $res->error_percentage > 5.0 ? '#dc2626' : '#64748b' }};">{{ $res->error_percentage }}%</td>
                    <td>
                        <span class="{{ $res->is_passed ? 'badge-pass' : 'badge-fail' }}">
                            {{ $res->is_passed ? 'উত্তীর্ণ (PASS)' : 'অনুত্তীর্ণ (FAIL)' }}
                        </span>
                    </td>
                    <td>{{ $res->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align:center; padding:2rem; color:#64748b;">এখনও কোনো পরীক্ষার ফলাফল জমা হয়নি।</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:3rem; display:flex; justify-content:space-between; padding-top:2rem;">
        <div style="text-align:center; border-top:1px solid black; width:200px; padding-top:4px; font-size:0.85rem;">ইনস্ট্রাক্টরের স্বাক্ষর</div>
        <div style="text-align:center; border-top:1px solid black; width:200px; padding-top:4px; font-size:0.85rem;">পরিচালকের স্বাক্ষর ও সীল</div>
    </div>

</body>
</html>
