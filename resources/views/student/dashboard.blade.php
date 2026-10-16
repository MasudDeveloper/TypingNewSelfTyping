@extends('layouts.student')

@section('title', 'Practice Tests - SelfTyping.com')

@push('styles')
<style>
    /* Dashboard Header Section */
    .dashboard-hero {
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.15), rgba(16, 185, 129, 0.08));
        border: 1px solid rgba(59, 130, 246, 0.25);
        border-radius: 20px;
        padding: 1.8rem 2.2rem;
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        backdrop-filter: blur(16px);
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
    }
    .hero-text h2 {
        font-size: 1.5rem;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 0.35rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .hero-text p {
        font-size: 0.92rem;
        color: #94a3b8;
    }
    .hero-quick-stats {
        display: flex;
        gap: 1.5rem;
    }
    .quick-stat-box {
        background: rgba(14, 21, 38, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 10px 18px;
        text-align: center;
    }
    .quick-stat-box .val {
        font-size: 1.35rem;
        font-weight: 800;
        color: #38bdf8;
        font-family: var(--font-en);
    }
    .quick-stat-box .lbl {
        font-size: 0.75rem;
        color: #94a3b8;
    }

    /* Category Filter Pills */
    .filter-strip {
        display: flex;
        gap: 10px;
        margin-bottom: 1.8rem;
        overflow-x: auto;
        padding-bottom: 6px;
    }
    .filter-btn {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        color: #94a3b8;
        padding: 7px 16px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .filter-btn:hover, .filter-btn.active {
        background: var(--primary);
        border-color: var(--primary);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
    }

    /* Card Grid Layout */
    .test-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
        gap: 1.5rem;
    }

    .lab-card {
        background: rgba(14, 21, 38, 0.85);
        backdrop-filter: blur(14px);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 18px;
        padding: 1.6rem;
        display: flex;
        flex-direction: column;
        box-shadow: 0 10px 25px -10px rgba(0, 0, 0, 0.5);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        overflow: hidden;
    }

    .lab-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.6), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .lab-card:hover {
        border-color: rgba(59, 130, 246, 0.5);
        box-shadow: 0 16px 35px -10px rgba(0, 0, 0, 0.8), 0 0 20px rgba(37, 99, 235, 0.2);
        transform: translateY(-4px);
    }

    .lab-card:hover::before {
        opacity: 1;
    }

    .lab-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.1rem;
    }

    .lab-time {
        font-size: 0.8rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 5px;
        font-weight: 600;
        font-family: var(--font-en);
        background: rgba(255, 255, 255, 0.04);
        padding: 3px 8px;
        border-radius: 6px;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .lab-badge {
        background: rgba(37, 99, 235, 0.15);
        color: #93c5fd;
        border: 1px solid rgba(59, 130, 246, 0.25);
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .lab-title {
        font-size: 1.08rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.6rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        min-height: 2.8rem;
    }

    .lab-meta {
        font-size: 0.82rem;
        color: #94a3b8;
        margin-bottom: 1.5rem;
        flex: 1;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .meta-tag {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.06);
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 0.75rem;
        color: #cbd5e1;
    }

    .lab-buttons {
        display: flex;
        gap: 10px;
        margin-top: auto;
    }

    .btn-lab {
        flex: 1;
        padding: 0.6rem 0.8rem;
        border-radius: 10px;
        text-align: center;
        font-weight: 700;
        font-size: 0.86rem;
        text-decoration: none;
        transition: all 0.25s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .btn-bangla {
        background: linear-gradient(135deg, #059669, #10b981);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .btn-bangla:hover {
        background: linear-gradient(135deg, #047857, #059669);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
    }

    .btn-english {
        background: linear-gradient(135deg, #1d4ed8, #2563eb);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .btn-english:hover {
        background: linear-gradient(135deg, #1e40af, #1d4ed8);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
    }

    @media (max-width: 768px) {
        .dashboard-hero { flex-direction: column; gap: 1rem; align-items: flex-start; }
        .hero-quick-stats { width: 100%; justify-content: space-between; }
        .test-cards-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

    <!-- Dashboard Hero Banner -->
    <div class="dashboard-hero">
        <div class="hero-text">
            <h2><i class="ph-fill ph-keyboard" style="color:var(--primary-light);"></i> লাইভ প্র্যাকটিস ল্যাব ড্যাশবোর্ড</h2>
            <p>আপনার পছন্দের পরীক্ষার ক্যাটাগরি ও স্ট্যান্ডার্ড নির্বাচন করে নিয়মিত স্পিড ও নির্ভুলতা অনুশীলন করুন।</p>
        </div>
        <div class="hero-quick-stats">
            <div class="quick-stat-box">
                <div class="val">{{ $tests->count() }}</div>
                <div class="lbl">মোট ল্যাব টেস্ট</div>
            </div>
            <div class="quick-stat-box">
                <div class="val">BCC & Govt</div>
                <div class="lbl">স্ট্যান্ডার্ড ফর্মুলা</div>
            </div>
        </div>
    </div>

    <!-- Test Cards Grid -->
    <div class="test-cards-grid">
        @php
            $groupedTests = collect($tests)->groupBy('category');
        @endphp

        @foreach($groupedTests as $category => $categoryTests)
            @php
                $firstTest = $categoryTests->first();
            @endphp
            <div class="lab-card">
                <div class="lab-header">
                    <span class="lab-time"><i class="ph-bold ph-clock"></i> {{ $firstTest->time_limit_minutes }} Min</span>
                    <span class="lab-badge">{{ $category }}</span>
                </div>
                <h4 class="lab-title">{{ $firstTest->title }}</h4>
                <div class="lab-meta">
                    <span class="meta-tag"><i class="ph-bold ph-files"></i> {{ $categoryTests->count() }} টি প্যাসেজ</span>
                    <span class="meta-tag"><i class="ph-bold ph-target"></i> {{ $firstTest->pass_wpm }} WPM টার্গেট</span>
                </div>
                
                <div class="lab-buttons">
                    @php
                        $bnTest = $categoryTests->whereIn('language', ['bn_unicode', 'bn_bijoy'])->first();
                        $enTest = $categoryTests->where('language', 'en')->first();
                    @endphp
                    
                    @if($bnTest && $enTest)
                        <!-- Has both languages -->
                        <a href="{{ route('test.show', $bnTest->id) }}" class="btn-lab btn-bangla">
                            <i class="ph-bold ph-caret-right"></i> Bangla
                        </a>
                        <a href="{{ route('test.show', $enTest->id) }}" class="btn-lab btn-english">
                            <i class="ph-bold ph-caret-right"></i> English
                        </a>
                    @elseif($bnTest)
                        @php
                            $sheetTest = $categoryTests->where('mode', 'sheet')->first();
                            $screenTest = $categoryTests->where('mode', 'screen')->first();
                        @endphp
                        @if($sheetTest && $screenTest)
                            <a href="{{ route('test.show', $sheetTest->id) }}" class="btn-lab btn-bangla">
                                <i class="ph-bold ph-file-text"></i> Sheet
                            </a>
                            <a href="{{ route('test.show', $screenTest->id) }}" class="btn-lab btn-english">
                                <i class="ph-bold ph-monitor"></i> Screen
                            </a>
                        @else
                            <a href="{{ route('test.show', $bnTest->id) }}" class="btn-lab btn-bangla" style="flex: none; width: 100%;">
                                <i class="ph-bold ph-play"></i> Start Bangla
                            </a>
                        @endif
                    @elseif($enTest)
                        <a href="{{ route('test.show', $enTest->id) }}" class="btn-lab btn-english" style="flex: none; width: 100%;">
                            <i class="ph-bold ph-play"></i> Start English
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

@endsection
