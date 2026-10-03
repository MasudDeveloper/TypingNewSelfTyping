@extends('layouts.student')

@section('title', 'MCQ পরীক্ষার ফলাফল - SelfTyping.com')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    .result-sheet-container {
        max-width: 960px;
        margin: 0 auto;
        font-family: 'Hind Siliguri', 'Inter', sans-serif;
    }

    /* Score Header Card */
    .score-summary-card {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .status-ribbon {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 18px;
        border-radius: 30px;
        font-weight: 700;
        font-size: 0.95rem;
        margin-bottom: 1.25rem;
    }

    .status-ribbon.passed {
        background: #ecfdf5;
        color: #059669;
        border: 1.5px solid #a7f3d0;
    }

    .status-ribbon.failed {
        background: #fef2f2;
        color: #dc2626;
        border: 1.5px solid #fecaca;
    }

    .stats-matrix {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px dashed var(--border);
    }

    .stat-box {
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
    }

    .stat-label {
        font-size: 0.8rem;
        color: var(--text-muted);
        font-weight: 600;
        margin-bottom: 4px;
    }

    .stat-val {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--text-dark);
    }

    /* Question Review List */
    .review-card {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 1.5rem;
        margin-bottom: 1.25rem;
        transition: 0.2s;
    }

    .review-card.correct { border-left: 5px solid #10b981; }
    .review-card.wrong { border-left: 5px solid #ef4444; }
    .review-card.unanswered { border-left: 5px solid #94a3b8; }

    .review-options {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin: 1rem 0;
    }

    @media (max-width: 640px) {
        .review-options { grid-template-columns: 1fr; }
    }

    .rev-opt {
        padding: 0.65rem 1rem;
        border-radius: 8px;
        border: 1px solid var(--border);
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
        background: #fafafa;
    }

    .rev-opt.is-correct-answer {
        background: #ecfdf5;
        border-color: #10b981;
        color: #065f46;
        font-weight: 600;
    }

    .rev-opt.is-user-wrong {
        background: #fef2f2;
        border-color: #ef4444;
        color: #991b1b;
        font-weight: 600;
    }

    .explanation-box {
        background: #f0f9ff;
        border: 1px solid #bae6fd;
        border-radius: 8px;
        padding: 0.85rem 1rem;
        font-size: 0.9rem;
        color: #0369a1;
        margin-top: 0.75rem;
        display: flex;
        gap: 8px;
        align-items: flex-start;
    }

    .action-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    @media print {
        .header, .sidebar, .action-row, .btn-print { display: none !important; }
        body { background: white !important; }
        .score-summary-card, .review-card { box-shadow: none !important; border: 1px solid #ccc !important; }
    }
</style>
@endpush

@section('content')

<div class="result-sheet-container">
    <div class="action-row">
        <a href="{{ route('exams.mcq.index') }}" style="color:var(--text-muted); text-decoration:none; display:flex; align-items:center; gap:6px; font-weight:600;">
            <i class="ph ph-arrow-left"></i> সকল পরীক্ষার তালিকায় ফিরুন
        </a>

        <div style="display:flex; gap:10px;">
            <button onclick="window.print()" class="btn-print" style="padding:0.6rem 1.2rem; background:white; border:1px solid var(--border); border-radius:8px; font-weight:600; cursor:pointer; display:flex; align-items:center; gap:6px;">
                <i class="ph ph-printer"></i> প্রিন্ট রেজাল্ট শিট
            </button>
            <a href="{{ route('exams.mcq.show', $exam->id) }}" style="padding:0.6rem 1.2rem; background:var(--primary); color:white; text-decoration:none; border-radius:8px; font-weight:600; display:flex; align-items:center; gap:6px;">
                <i class="ph ph-arrows-clockwise"></i> পুনরায় পরীক্ষা দিন
            </a>
        </div>
    </div>

    <!-- Summary Score Card -->
    <div class="score-summary-card">
        <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:1rem;">
            <div>
                @if($isPassed)
                    <div class="status-ribbon passed">
                        <i class="ph-fill ph-check-circle" style="font-size:1.2rem;"></i> অভিনন্দন! আপনি উত্তীর্ণ হয়েছেন (PASSED)
                    </div>
                @else
                    <div class="status-ribbon failed">
                        <i class="ph-fill ph-x-circle" style="font-size:1.2rem;"></i> দুঃখিত! আপনি উত্তীর্ণ হতে পারেননি (FAILED)
                    </div>
                @endif
                <h1 style="font-size:1.6rem; font-weight:800; color:var(--text-dark); margin-bottom:0.25rem;">
                    {{ $exam->title }}
                </h1>
                <p style="color:var(--text-muted); font-size:0.9rem;">
                    বিভাগ / ক্যাটাগরি: {{ $exam->category }} • মূল্যায়নের তারিখ: {{ now()->format('d M Y, h:i A') }}
                </p>
            </div>

            <div style="text-align:right;">
                <div style="font-size:0.85rem; color:var(--text-muted); font-weight:600;">প্রাপ্ত মোট নম্বর</div>
                <div style="font-size:2.8rem; font-weight:900; color:{{ $isPassed ? 'var(--success)' : '#ef4444' }}; line-height:1;">
                    {{ number_format($obtainedMarks, 2) }}
                    <span style="font-size:1.1rem; color:var(--text-muted); font-weight:600;">/ {{ $exam->total_marks }}</span>
                </div>
            </div>
        </div>

        <!-- Metric Grid -->
        <div class="stats-matrix">
            <div class="stat-box">
                <div class="stat-label">মোট প্রশ্ন</div>
                <div class="stat-val">{{ $totalQuestions }}</div>
            </div>
            <div class="stat-box" style="border-color:#bbf7d0;">
                <div class="stat-label" style="color:#16a34a;">সঠিক উত্তর</div>
                <div class="stat-val" style="color:#16a34a;">{{ $correctCount }}</div>
            </div>
            <div class="stat-box" style="border-color:#fecaca;">
                <div class="stat-label" style="color:#dc2626;">ভুল উত্তর</div>
                <div class="stat-val" style="color:#dc2626;">{{ $wrongCount }}</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">উত্তরহীন</div>
                <div class="stat-val" style="color:var(--text-muted);">{{ $unansweredCount }}</div>
            </div>
            <div class="stat-box">
                <div class="stat-label">পাস মার্ক</div>
                <div class="stat-val">{{ $exam->pass_marks }}</div>
            </div>
        </div>
    </div>

    <!-- Question by Question Review -->
    <h3 style="font-size:1.25rem; font-weight:800; color:var(--text-dark); margin-bottom:1.25rem; display:flex; align-items:center; gap:8px;">
        <i class="ph-bold ph-list-checks" style="color:var(--primary);"></i> বিস্তারিত প্রশ্ন ও উত্তরপত্র পর্যালোচনা
    </h3>

    @foreach($evaluatedQuestions as $idx => $item)
        @php
            $q = $item['question'];
            $selected = $item['selected'];
            $status = $item['status'];
        @endphp
        <div class="review-card {{ $status }}">
            <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:0.75rem;">
                <div style="font-weight:700; font-size:1.05rem; color:var(--text-dark);">
                    <span style="color:var(--text-muted); margin-right:4px;">{{ $idx + 1 }}.</span> {{ $q->question }}
                </div>
                <div>
                    @if($status === 'correct')
                        <span style="background:#ecfdf5; color:#059669; font-weight:700; font-size:0.75rem; padding:4px 8px; border-radius:6px; display:inline-flex; align-items:center; gap:4px;">
                            <i class="ph-bold ph-check"></i> সঠিক (+1.0)
                        </span>
                    @elseif($status === 'wrong')
                        <span style="background:#fef2f2; color:#dc2626; font-weight:700; font-size:0.75rem; padding:4px 8px; border-radius:6px; display:inline-flex; align-items:center; gap:4px;">
                            <i class="ph-bold ph-x"></i> ভুল (-{{ $exam->negative_marking }})
                        </span>
                    @else
                        <span style="background:#f1f5f9; color:#64748b; font-weight:700; font-size:0.75rem; padding:4px 8px; border-radius:6px;">
                            উত্তর দেননি (০.০)
                        </span>
                    @endif
                </div>
            </div>

            <div class="review-options">
                @foreach(['a' => $q->option_a, 'b' => $q->option_b, 'c' => $q->option_c, 'd' => $q->option_d] as $k => $val)
                    @php
                        $isCorrectChoice = ($k === $q->correct_option);
                        $isUserChoice = ($k === $selected);
                        $optClass = '';
                        if ($isCorrectChoice) $optClass = 'is-correct-answer';
                        elseif ($isUserChoice && !$isCorrectChoice) $optClass = 'is-user-wrong';
                    @endphp
                    <div class="rev-opt {{ $optClass }}">
                        <strong style="text-transform:uppercase;">{{ $k }})</strong> {{ $val }}
                        @if($isCorrectChoice)
                            <i class="ph-fill ph-check-circle" style="color:#10b981; margin-left:auto;"></i>
                        @elseif($isUserChoice)
                            <i class="ph-fill ph-x-circle" style="color:#ef4444; margin-left:auto;"></i>
                        @endif
                    </div>
                @endforeach
            </div>

            @if($q->explanation)
                <div class="explanation-box">
                    <i class="ph-fill ph-info" style="font-size:1.1rem; flex-shrink:0; margin-top:2px;"></i>
                    <div>
                        <strong>ব্যাখ্যা:</strong> {{ $q->explanation }}
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>

@endsection
