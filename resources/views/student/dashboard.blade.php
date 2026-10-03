@extends('layouts.student')

@section('title', 'Practice Tests - SelfTyping.com')

@push('styles')
<style>
    /* Card Grid Layout */
    .test-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .lab-card {
        background: var(--bg-surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        transition: all 0.2s;
    }

    .lab-card:hover {
        border-color: var(--primary);
        box-shadow: 0 4px 12px rgba(37,99,235,0.08);
        transform: translateY(-2px);
    }

    .lab-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .lab-time {
        font-size: 0.8rem;
        color: var(--text-muted);
        display: flex;
        align-items: center;
        gap: 4px;
        font-weight: 500;
    }

    .lab-badge {
        background: #e0e7ff;
        color: #3730a3;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .lab-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .lab-meta {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-bottom: 1.5rem;
        flex: 1;
    }

    .lab-buttons {
        display: flex;
        gap: 10px;
    }

    .btn-lab {
        flex: 1;
        padding: 0.5rem;
        border-radius: 8px;
        text-align: center;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-bangla { background: #10b981; color: white; }
    .btn-bangla:hover { background: #059669; }

    .btn-english { background: #3b82f6; color: white; }
    .btn-english:hover { background: #2563eb; }
    
    .btn-outline { background: transparent; border: 1px solid var(--border); color: var(--text-dark); }
    .btn-outline:hover { background: #f3f4f6; }
</style>
@endpush

@section('content')

    <div class="test-cards-grid">
        @php
            $groupedTests = collect($tests)->groupBy('category');
        @endphp

        @foreach($groupedTests as $category => $categoryTests)
            @php
                $firstTest = $categoryTests->first();
                $isBanglaEnglishMode = true; // By default assume it requires Bangla/English split
            @endphp
            <div class="lab-card">
                <div class="lab-header">
                    <span class="lab-time"><i class="ph ph-clock"></i> {{ $firstTest->time_limit_minutes }} Min</span>
                    <span class="lab-badge">{{ $category }}</span>
                </div>
                <h4 class="lab-title">{{ $firstTest->title }}</h4>
                <div class="lab-meta">প্যাসেজ: {{ $categoryTests->count() }} টি | টার্গেট: {{ $firstTest->pass_wpm }} WPM</div>
                
                <div class="lab-buttons">
                    @php
                        $bnTest = $categoryTests->whereIn('language', ['bn_unicode', 'bn_bijoy'])->first();
                        $enTest = $categoryTests->where('language', 'en')->first();
                    @endphp
                    
                    @if($bnTest && $enTest)
                        <!-- Has both languages -->
                        <a href="{{ route('test.show', $bnTest->id) }}" class="btn-lab btn-bangla">Bangla</a>
                        <a href="{{ route('test.show', $enTest->id) }}" class="btn-lab btn-english">English</a>
                    @elseif($bnTest)
                        <!-- Only has Bangla, maybe sheet/screen variants? -->
                        @php
                            $sheetTest = $categoryTests->where('mode', 'sheet')->first();
                            $screenTest = $categoryTests->where('mode', 'screen')->first();
                        @endphp
                        @if($sheetTest && $screenTest)
                            <a href="{{ route('test.show', $sheetTest->id) }}" class="btn-lab btn-bangla">Sheet</a>
                            <a href="{{ route('test.show', $screenTest->id) }}" class="btn-lab btn-english">Screen</a>
                        @else
                            <a href="{{ route('test.show', $bnTest->id) }}" class="btn-lab btn-bangla" style="flex: none; width: 100%;">Start Bangla</a>
                        @endif
                    @elseif($enTest)
                        <a href="{{ route('test.show', $enTest->id) }}" class="btn-lab btn-english" style="flex: none; width: 100%;">Start English</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

@endsection
