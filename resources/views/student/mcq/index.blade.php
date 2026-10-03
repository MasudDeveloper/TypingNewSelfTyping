@extends('layouts.student')

@section('title', 'Online MCQ Exams - SelfTyping.com')

@push('styles')
<style>
    .mcq-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 1.5rem;
    }
    .mcq-card {
        background: var(--bg-surface);
        border: 1.5px solid var(--border);
        border-radius: 16px;
        padding: 1.8rem;
        display: flex;
        flex-direction: column;
        transition: all 0.2s;
    }
    .mcq-card:hover {
        border-color: var(--primary);
        box-shadow: 0 8px 20px rgba(37,99,235,0.08);
        transform: translateY(-2px);
    }
    .mcq-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }
    .exam-pill {
        background: #eff6ff;
        color: var(--primary);
        font-weight: 700;
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 20px;
    }
    .mcq-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }
    .mcq-meta {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .btn-start-mcq {
        background: linear-gradient(135deg, var(--primary), var(--primary-hover));
        color: white;
        text-align: center;
        padding: 0.75rem;
        border-radius: 8px;
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
</style>
@endpush

@section('content')

    <div style="margin-bottom:2rem;">
        <h2 style="font-size:1.5rem; font-weight:800; color:var(--text-dark);">
            <i class="ph-fill ph-exam" style="color:var(--primary);"></i> অনলাইন MCQ মডেল টেস্ট
        </h2>
        <p style="color:var(--text-muted); font-size:0.95rem;">
            বাংলাদেশ কম্পিউটার কাউন্সিল (BCC) ও সরকারি অপারেটর পরীক্ষার জন্য সিলেবাস ভিত্তিক এমসিকিউ পরীক্ষা
        </p>
    </div>

    <div class="mcq-grid">
        @forelse($exams as $exam)
            <div class="mcq-card">
                <div class="mcq-card-header">
                    <span class="exam-pill">{{ $exam->category }}</span>
                    <span style="font-size:0.8rem; color:var(--text-muted); font-weight:600;"><i class="ph ph-clock"></i> {{ $exam->time_limit_minutes }} মিনিট</span>
                </div>

                <h3 class="mcq-title">{{ $exam->title }}</h3>
                
                <div class="mcq-meta">
                    <span><i class="ph ph-question"></i> মোট প্রশ্ন: <strong>{{ $exam->questions_count }} টি</strong></span>
                    <span><i class="ph ph-check-square-offset"></i> মোট নম্বর: <strong>{{ $exam->total_marks }}</strong> (পাস: {{ $exam->pass_marks }})</span>
                    <span><i class="ph ph-warning-octagon" style="color:var(--danger);"></i> নেগেটিভ মার্কিং: <strong>{{ $exam->negative_marking }}</strong></span>
                </div>

                <a href="{{ route('exams.mcq.show', $exam->id) }}" class="btn-start-mcq">
                    <i class="ph-bold ph-play"></i> পরীক্ষা শুরু করুন
                </a>
            </div>
        @empty
            <p style="color:var(--text-muted);">বর্তমানে কোনো এমসিকিউ পরীক্ষা সক্রিয় নেই।</p>
        @endforelse
    </div>

@endsection
