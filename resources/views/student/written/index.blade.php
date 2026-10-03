@extends('layouts.student')

@section('title', 'লিখিত প্রশ্নব্যাংক - SelfTyping.com')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    .written-container {
        font-family: 'Hind Siliguri', 'Inter', sans-serif;
    }

    .written-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
        gap: 1.5rem;
    }

    .written-card {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 1.8rem;
        display: flex;
        flex-direction: column;
        transition: all 0.2s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .written-card:hover {
        border-color: var(--primary);
        box-shadow: 0 10px 25px rgba(37,99,235,0.08);
        transform: translateY(-2px);
    }

    .written-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .badge-category {
        background: #f0fdf4;
        color: #15803d;
        border: 1px solid #bbf7d0;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
    }

    .written-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .written-meta {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 1.25rem;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .question-preview-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 1rem;
        font-size: 0.9rem;
        color: #334155;
        white-space: pre-line;
        margin-bottom: 1.5rem;
        flex: 1;
        max-height: 160px;
        overflow-y: auto;
    }

    .btn-view-paper {
        background: var(--primary);
        color: white;
        padding: 0.65rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-view-paper:hover {
        background: var(--primary-hover);
    }

    /* Modal Styling */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0,0,0,0.6);
        z-index: 999;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }

    .modal-paper {
        background: white;
        width: 100%;
        max-width: 750px;
        max-height: 85vh;
        overflow-y: auto;
        border-radius: 16px;
        padding: 2.5rem;
        position: relative;
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }

    .modal-close {
        position: absolute;
        top: 1.25rem;
        right: 1.25rem;
        background: #f1f5f9;
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        font-size: 1.2rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush

@section('content')

<div class="written-container">
    <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:2rem; flex-wrap:wrap; gap:1rem;">
        <div>
            <h2 style="font-size:1.6rem; font-weight:800; color:var(--text-dark);">
                <i class="ph-fill ph-file-text" style="color:var(--primary);"></i> বিগত সালের লিখিত পরীক্ষার প্রশ্নপত্র
            </h2>
            <p style="color:var(--text-muted); font-size:0.95rem;">
                বিভিন্ন মন্ত্রণালয়, অধিদপ্তর, বাংলাদেশ সুপ্রিম কোর্ট ও অন্যান্য সরকারি নিয়োগের লিখিত প্রশ্নব্যাংক
            </p>
        </div>
        <div>
            <span style="background:#eff6ff; color:var(--primary); padding:8px 16px; border-radius:20px; font-weight:700; font-size:0.85rem; border:1px solid #bfdbfe;">
                মোট প্রশ্নপত্র: {{ $questions->count() }} টি
            </span>
        </div>
    </div>

    <div class="written-grid">
        @forelse($questions as $q)
            <div class="written-card">
                <div class="written-card-header">
                    <span class="badge-category">{{ $q->category }}</span>
                    <span style="font-size:0.8rem; font-weight:700; color:var(--text-muted);"><i class="ph ph-calendar-blank"></i> {{ $q->exam_year ?? 'বিগত সাল' }}</span>
                </div>

                <h3 class="written-title">{{ $q->title }}</h3>

                <div class="written-meta">
                    <span><i class="ph ph-buildings"></i> প্রতিষ্ঠান: <strong>{{ $q->organization ?? 'সরকারি অধিদপ্তর' }}</strong></span>
                </div>

                <div class="question-preview-box">
                    {{ Str::limit($q->question_content, 180) }}
                </div>

                <div style="display:flex; gap:10px;">
                    <button class="btn-view-paper" style="flex:1;" onclick="openQuestionModal('{{ $q->id }}')">
                        <i class="ph-bold ph-eye"></i> সম্পূর্ণ প্রশ্নপত্র দেখুন
                    </button>
                    @if($q->pdf_url)
                        <a href="{{ $q->pdf_url }}" target="_blank" class="btn-view-paper" style="background:#f1f5f9; color:var(--text-dark); border:1px solid var(--border);">
                            <i class="ph-bold ph-download-simple"></i> PDF
                        </a>
                    @endif
                </div>

                <!-- Modal Content for this question -->
                <div id="modal_{{ $q->id }}" class="modal-overlay">
                    <div class="modal-paper">
                        <button class="modal-close" onclick="closeQuestionModal('{{ $q->id }}')">✕</button>
                        
                        <div style="text-align:center; padding-bottom:1.5rem; border-bottom:2px solid #e2e8f0; margin-bottom:1.5rem;">
                            <span class="badge-category">{{ $q->category }}</span>
                            <h2 style="font-size:1.4rem; font-weight:800; color:var(--text-dark); margin:0.5rem 0;">{{ $q->title }}</h2>
                            <p style="font-size:0.85rem; color:var(--text-muted);">
                                প্রতিষ্ঠান: {{ $q->organization }} | পরীক্ষার সন: {{ $q->exam_year }}
                            </p>
                        </div>

                        <div style="font-size:1.05rem; line-height:1.8; color:#1e293b; white-space: pre-line;">
                            {!! nl2br(e($q->question_content)) !!}
                        </div>

                        <div style="margin-top:2rem; padding-top:1.5rem; border-top:1px solid #e2e8f0; display:flex; justify-content:flex-end; gap:10px;">
                            <button onclick="window.print()" class="btn-view-paper" style="background:#334155;">
                                <i class="ph-bold ph-printer"></i> প্রিন্ট করুন
                            </button>
                            <button onclick="closeQuestionModal('{{ $q->id }}')" class="btn-view-paper" style="background:#f1f5f9; color:#334155; border:1px solid #cbd5e1;">
                                বন্ধ করুন
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p style="color:var(--text-muted);">কোনো লিখিত প্রশ্নপত্র পাওয়া যায়নি।</p>
        @endforelse
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openQuestionModal(id) {
        const modal = document.getElementById(`modal_${id}`);
        if (modal) {
            modal.style.display = 'flex';
        }
    }

    function closeQuestionModal(id) {
        const modal = document.getElementById(`modal_${id}`);
        if (modal) {
            modal.style.display = 'none';
        }
    }

    window.onclick = function(event) {
        if (event.target.classList.contains('modal-overlay')) {
            event.target.style.display = 'none';
        }
    }
</script>
@endpush
