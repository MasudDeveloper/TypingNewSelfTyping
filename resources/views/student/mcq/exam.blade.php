@extends('layouts.student')

@section('title', $exam->title . ' - Live MCQ Exam')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    .mcq-container {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 1.5rem;
        align-items: start;
        font-family: 'Hind Siliguri', 'Inter', sans-serif;
    }

    /* Left - Question Area */
    .question-box {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }

    .exam-header-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 1.25rem;
        border-bottom: 1px solid var(--border);
        margin-bottom: 1.5rem;
    }

    .q-number-badge {
        background: #eff6ff;
        color: var(--primary);
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.95rem;
    }

    .q-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .options-list {
        display: flex;
        flex-direction: column;
        gap: 0.85rem;
        margin-bottom: 2rem;
    }

    .option-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 1rem 1.25rem;
        border: 2px solid var(--border);
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        user-select: none;
        background: #fafafa;
    }

    .option-card:hover {
        border-color: #93c5fd;
        background: #f0f7ff;
    }

    .option-card.selected {
        border-color: var(--primary);
        background: #eff6ff;
        box-shadow: 0 0 0 1px var(--primary);
    }

    .option-key {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #e2e8f0;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.9rem;
        flex-shrink: 0;
        text-transform: uppercase;
        transition: 0.2s;
    }

    .option-card.selected .option-key {
        background: var(--primary);
        color: white;
    }

    .option-text {
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--text-dark);
        flex: 1;
    }

    .q-nav-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border);
    }

    .btn-nav {
        padding: 0.65rem 1.4rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        border: 1px solid var(--border);
        background: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: 0.2s;
    }

    .btn-nav:hover {
        background: #f3f4f6;
    }

    .btn-primary-nav {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .btn-primary-nav:hover {
        background: var(--primary-hover);
    }

    .btn-flag {
        background: #fffbeb;
        color: #d97706;
        border-color: #fde68a;
    }

    .btn-flag.flagged {
        background: #fef3c7;
        color: #b45309;
        border-color: #f59e0b;
        font-weight: 700;
    }

    /* Right - Timer & Palette */
    .sidebar-panel {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        position: sticky;
        top: 1rem;
    }

    .timer-card {
        background: #1e293b;
        color: white;
        padding: 1.5rem;
        border-radius: 16px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .timer-label {
        font-size: 0.85rem;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .timer-digits {
        font-size: 2.25rem;
        font-weight: 800;
        letter-spacing: 2px;
        font-family: monospace;
        color: #38bdf8;
    }

    .timer-digits.danger {
        color: #ef4444;
        animation: pulse 1s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.6; }
    }

    .palette-card {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 1.5rem;
    }

    .palette-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 8px;
        margin-top: 1rem;
    }

    .palette-btn {
        height: 38px;
        border-radius: 8px;
        border: 1px solid var(--border);
        background: #f8fafc;
        font-weight: 700;
        font-size: 0.85rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
    }

    .palette-btn.active {
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(37,99,235,0.3);
    }

    .palette-btn.answered {
        background: #10b981;
        color: white;
        border-color: #10b981;
    }

    .palette-btn.flagged {
        background: #f59e0b;
        color: white;
        border-color: #f59e0b;
    }

    .btn-submit-exam {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 0.85rem;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(16,185,129,0.25);
        transition: 0.2s;
    }

    .btn-submit-exam:hover {
        opacity: 0.95;
        transform: translateY(-1px);
    }

    .legend-row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        font-size: 0.75rem;
        color: var(--text-muted);
        margin-top: 1rem;
        padding-top: 0.75rem;
        border-top: 1px solid var(--border);
    }
    .legend-item { display: flex; align-items: center; gap: 4px; }
    .legend-dot { width: 10px; height: 10px; border-radius: 50%; }
</style>
@endpush

@section('content')

<form id="mcqExamForm" method="POST" action="{{ route('exams.mcq.submit', $exam->id) }}">
    @csrf

    <div class="mcq-container">
        <!-- Question Panel -->
        <div>
            @foreach($exam->questions as $index => $question)
                <div class="question-box question-item" id="q_box_{{ $index }}" style="{{ $index === 0 ? '' : 'display:none;' }}">
                    <div class="exam-header-bar">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <span class="q-number-badge">প্রশ্ন {{ $index + 1 }} / {{ $exam->questions->count() }}</span>
                            <span style="font-size:0.85rem; color:var(--text-muted);">বিষয়: {{ $exam->category }}</span>
                        </div>
                        <button type="button" class="btn-nav btn-flag" onclick="toggleFlag({{ $index }})" id="flag_btn_{{ $index }}">
                            <i class="ph ph-flag"></i> মার্ক ফর রিভিউ
                        </button>
                    </div>

                    <h2 class="q-title">{{ $question->question }}</h2>

                    <div class="options-list">
                        @foreach(['a' => $question->option_a, 'b' => $question->option_b, 'c' => $question->option_c, 'd' => $question->option_d] as $key => $opt)
                            <label class="option-card" id="opt_card_{{ $index }}_{{ $key }}" onclick="selectOption({{ $index }}, '{{ $key }}')">
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $key }}" style="display:none;" id="radio_{{ $index }}_{{ $key }}">
                                <div class="option-key">{{ $key }}</div>
                                <div class="option-text">{{ $opt }}</div>
                            </label>
                        @endforeach
                    </div>

                    <div class="q-nav-actions">
                        <button type="button" class="btn-nav" onclick="prevQuestion({{ $index }})" {{ $index === 0 ? 'disabled style=opacity:0.5;' : '' }}>
                            <i class="ph ph-arrow-left"></i> পূর্ববর্তী
                        </button>

                        @if($index < $exam->questions->count() - 1)
                            <button type="button" class="btn-nav btn-primary-nav" onclick="nextQuestion({{ $index }})">
                                পরবর্তী <i class="ph ph-arrow-right"></i>
                            </button>
                        @else
                            <button type="button" class="btn-nav btn-primary-nav" onclick="confirmSubmit()">
                                পরীক্ষা সমাপ্ত করুন <i class="ph ph-check-circle"></i>
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Right Timer & Navigation Palette -->
        <div class="sidebar-panel">
            <div class="timer-card">
                <div class="timer-label"><i class="ph-bold ph-hourglass-high"></i> অবশিষ্ট সময়</div>
                <div class="timer-digits" id="timerDisplay">--:--</div>
            </div>

            <div class="palette-card">
                <div style="font-weight: 700; color:var(--text-dark); display:flex; justify-content:space-between; align-items:center;">
                    <span>প্রশ্ন প্যালেট</span>
                    <span style="font-size:0.8rem; color:var(--primary); font-weight:600;" id="answeredCounter">০/{{ $exam->questions->count() }} উত্তর</span>
                </div>

                <div class="palette-grid">
                    @foreach($exam->questions as $index => $q)
                        <button type="button" class="palette-btn {{ $index === 0 ? 'active' : '' }}" id="palette_btn_{{ $index }}" onclick="showQuestion({{ $index }})">
                            {{ $index + 1 }}
                        </button>
                    @endforeach
                </div>

                <div class="legend-row">
                    <div class="legend-item"><div class="legend-dot" style="background:#10b981;"></div> উত্তর দেওয়া</div>
                    <div class="legend-item"><div class="legend-dot" style="background:#f59e0b;"></div> রিভিউ মার্ক</div>
                    <div class="legend-item"><div class="legend-dot" style="background:#e2e8f0;"></div> অনুত্তর</div>
                </div>

                <div style="margin-top: 1.5rem;">
                    <button type="button" class="btn-submit-exam" onclick="confirmSubmit()">
                        <i class="ph-bold ph-paper-plane-right"></i> উত্তরপত্র জমা দিন
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
    const totalQuestions = {{ $exam->questions->count() }};
    let currentIndex = 0;
    let timeRemaining = {{ $exam->time_limit_minutes }} * 60;
    const answeredMap = {};
    const flaggedMap = {};

    // Timer logic
    const timerDisplay = document.getElementById('timerDisplay');
    const timerInterval = setInterval(() => {
        timeRemaining--;

        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        timerDisplay.innerText = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

        if (timeRemaining <= 120) {
            timerDisplay.classList.add('danger');
        }

        if (timeRemaining <= 0) {
            clearInterval(timerInterval);
            alert('সময় সমাপ্ত! আপনার উত্তরপত্র স্বয়ংক্রিয়ভাবে জমা নেওয়া হচ্ছে।');
            document.getElementById('mcqExamForm').submit();
        }
    }, 1000);

    // Initial timer render
    const initialMin = Math.floor(timeRemaining / 60);
    const initialSec = timeRemaining % 60;
    timerDisplay.innerText = `${String(initialMin).padStart(2, '0')}:${String(initialSec).padStart(2, '0')}`;

    function showQuestion(index) {
        document.querySelectorAll('.question-item').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.palette-btn').forEach(el => el.classList.remove('active'));

        const target = document.getElementById(`q_box_${index}`);
        if (target) target.style.display = 'block';

        const pBtn = document.getElementById(`palette_btn_${index}`);
        if (pBtn) pBtn.classList.add('active');

        currentIndex = index;
    }

    function nextQuestion(index) {
        if (index < totalQuestions - 1) {
            showQuestion(index + 1);
        }
    }

    function prevQuestion(index) {
        if (index > 0) {
            showQuestion(index - 1);
        }
    }

    function selectOption(qIndex, key) {
        const radio = document.getElementById(`radio_${qIndex}_${key}`);
        if (radio) {
            radio.checked = true;
            answeredMap[qIndex] = key;
        }

        // Highlight selected card
        ['a', 'b', 'c', 'd'].forEach(k => {
            const card = document.getElementById(`opt_card_${qIndex}_${k}`);
            if (card) card.classList.toggle('selected', k === key);
        });

        updatePalette(qIndex);
        updateCounter();
    }

    function toggleFlag(qIndex) {
        flaggedMap[qIndex] = !flaggedMap[qIndex];
        const flagBtn = document.getElementById(`flag_btn_${qIndex}`);
        if (flagBtn) {
            flagBtn.classList.toggle('flagged', flaggedMap[qIndex]);
            flagBtn.innerHTML = flaggedMap[qIndex] 
                ? '<i class="ph-fill ph-flag"></i> ফ্ল্যাগড (রিভিউ)' 
                : '<i class="ph ph-flag"></i> মার্ক ফর রিভিউ';
        }
        updatePalette(qIndex);
    }

    function updatePalette(qIndex) {
        const pBtn = document.getElementById(`palette_btn_${qIndex}`);
        if (!pBtn) return;

        pBtn.classList.remove('answered', 'flagged');

        if (flaggedMap[qIndex]) {
            pBtn.classList.add('flagged');
        } else if (answeredMap[qIndex]) {
            pBtn.classList.add('answered');
        }
    }

    function updateCounter() {
        const count = Object.keys(answeredMap).length;
        document.getElementById('answeredCounter').innerText = `${count}/${totalQuestions} উত্তর`;
    }

    function confirmSubmit() {
        const answered = Object.keys(answeredMap).length;
        const unanswered = totalQuestions - answered;
        const msg = `আপনি ${totalQuestions} টির মধ্যে ${answered} টি প্রশ্নের উত্তর দিয়েছেন। (${unanswered} টি অনুত্তরিত)\n\nআপনি কি নিশ্চিত যে উত্তরপত্র জমা দিতে চান?`;
        
        if (confirm(msg)) {
            clearInterval(timerInterval);
            document.getElementById('mcqExamForm').submit();
        }
    }
</script>
@endpush
