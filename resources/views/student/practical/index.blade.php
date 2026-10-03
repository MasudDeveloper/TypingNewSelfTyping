@extends('layouts.student')

@section('title', 'কম্পিউটার ব্যবহারিক পরীক্ষা (Excel / PowerPoint / Word) - SelfTyping.com')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    .practical-container {
        font-family: 'Hind Siliguri', 'Inter', sans-serif;
    }

    .filter-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .tab-btn {
        padding: 0.6rem 1.25rem;
        border-radius: 30px;
        border: 1px solid var(--border);
        background: white;
        font-weight: 600;
        font-size: 0.9rem;
        color: var(--text-dark);
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: 0.2s;
    }

    .tab-btn.active, .tab-btn:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .practical-card {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .card-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .software-tag {
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .tag-excel { background: #dcfce7; color: #15803d; border: 1px solid #86efac; }
    .tag-powerpoint { background: #ffedd5; color: #c2410c; border: 1px solid #fdba74; }
    .tag-word { background: #dbeafe; color: #1d4ed8; border: 1px solid #93c5fd; }
    .tag-access { background: #fae8ff; color: #86198f; border: 1px solid #f0abfc; }

    .problem-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.25rem;
        margin: 1rem 0;
        font-size: 1rem;
        color: #1e293b;
        line-height: 1.6;
    }

    .instructions-box {
        background: #fffbeb;
        border: 1px solid #fef3c7;
        border-left: 4px solid #f59e0b;
        border-radius: 8px;
        padding: 1rem 1.25rem;
        font-size: 0.95rem;
        color: #92400e;
        line-height: 1.6;
        white-space: pre-line;
    }

    /* Formula Cheat Card */
    .cheat-card {
        background: linear-gradient(135deg, #1e3a8a, #0f172a);
        color: white;
        border-radius: 16px;
        padding: 1.5rem 2rem;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .formula-tag {
        background: rgba(255,255,255,0.15);
        padding: 4px 10px;
        border-radius: 6px;
        font-family: monospace;
        font-size: 0.85rem;
    }
</style>
@endpush

@section('content')

<div class="practical-container">
    <div style="margin-bottom:1.5rem;">
        <h2 style="font-size:1.6rem; font-weight:800; color:var(--text-dark);">
            <i class="ph-fill ph-microsoft-excel-logo" style="color:#10b981;"></i> ব্যবহারিক পরীক্ষা অনুশীলন (Practical Exam)
        </h2>
        <p style="color:var(--text-muted); font-size:0.95rem;">
            বাংলাদেশ সরকারি নিয়োগে MS Excel, MS Word ও MS PowerPoint-এর ব্যবহারিক প্রশ্ন ও সমাধান পদ্ধতি
        </p>
    </div>

    <!-- Cheat Sheet Banner -->
    <div class="cheat-card">
        <div>
            <h3 style="font-size:1.15rem; font-weight:700; margin-bottom:0.4rem;">
                <i class="ph-bold ph-lightning"></i> সরকারি পরীক্ষায় সবচেয়ে বেশি আসা Excel ফর্মুলা
            </h3>
            <div style="display:flex; gap:8px; flex-wrap:wrap; margin-top:0.5rem;">
                <span class="formula-tag">=SUM(A1:A10)</span>
                <span class="formula-tag">=AVERAGE(B1:B10)</span>
                <span class="formula-tag">=IF(C2>=80, "A+", "Fail")</span>
                <span class="formula-tag">=VLOOKUP(id, table, col, 0)</span>
                <span class="formula-tag">=RANK(E2, $E$2:$E$20)</span>
            </div>
        </div>
        <div>
            <span style="font-size:0.85rem; background:rgba(255,255,255,0.2); padding:6px 14px; border-radius:20px; font-weight:600;">
                BCC Standard 2026
            </span>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="filter-tabs">
        <button class="tab-btn active" onclick="filterSoftware('all', this)">
            <i class="ph-bold ph-squares-four"></i> সকল বিষয় ({{ $questions->count() }})
        </button>
        <button class="tab-btn" onclick="filterSoftware('excel', this)">
            <i class="ph-bold ph-file-xls"></i> MS Excel
        </button>
        <button class="tab-btn" onclick="filterSoftware('powerpoint', this)">
            <i class="ph-bold ph-presentation"></i> MS PowerPoint
        </button>
        <button class="tab-btn" onclick="filterSoftware('word', this)">
            <i class="ph-bold ph-file-doc"></i> MS Word
        </button>
    </div>

    <!-- Practical Question List -->
    <div id="questionsContainer">
        @forelse($questions as $pq)
            <div class="practical-card practical-item" data-software="{{ strtolower($pq->software) }}">
                <div class="card-head">
                    <h3 style="font-size:1.25rem; font-weight:700; color:var(--text-dark);">
                        {{ $pq->title }}
                    </h3>

                    @php
                        $soft = strtolower($pq->software);
                        $tagClass = 'tag-excel';
                        $icon = 'ph-file-xls';
                        if ($soft === 'powerpoint') { $tagClass = 'tag-powerpoint'; $icon = 'ph-presentation'; }
                        elseif ($soft === 'word') { $tagClass = 'tag-word'; $icon = 'ph-file-doc'; }
                        elseif ($soft === 'access') { $tagClass = 'tag-access'; $icon = 'ph-database'; }
                    @endphp

                    <span class="software-tag {{ $tagClass }}">
                        <i class="ph-bold {{ $icon }}"></i> {{ strtoupper($pq->software) }}
                    </span>
                </div>

                <div class="problem-box">
                    <strong style="color:var(--text-dark); display:block; margin-bottom:4px;"><i class="ph-bold ph-clipboard-text"></i> সমস্যা / টাস্ক বিবরণ:</strong>
                    {{ $pq->problem_statement }}
                </div>

                @if($pq->step_instructions)
                    <div class="instructions-box">
                        <strong style="display:block; margin-bottom:4px;"><i class="ph-bold ph-lightbulb"></i> ধাপে ধাপে সমাধান নির্দেশনা:</strong>
                        {{ $pq->step_instructions }}
                    </div>
                @endif
            </div>
        @empty
            <p style="color:var(--text-muted);">বর্তমানে কোনো ব্যবহারিক প্রশ্ন উপলব্ধ নেই।</p>
        @endforelse
    </div>
</div>

@endsection

@push('scripts')
<script>
    function filterSoftware(type, btn) {
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        document.querySelectorAll('.practical-item').forEach(card => {
            if (type === 'all' || card.getAttribute('data-software') === type) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
@endpush
