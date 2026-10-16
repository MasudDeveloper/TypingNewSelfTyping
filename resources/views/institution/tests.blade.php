@extends('layouts.institution')

@section('title', 'কাস্টম টেস্ট ও প্রশ্ন')
@section('page_title', 'কাস্টম টেস্ট ও প্রশ্ন')
@section('page_subtitle', 'কোচিংয়ের নিজস্ব সিলেবাস ও সরকারি চাকরি প্যাটার্নে টাইপিং টেস্ট তৈরি করুন')

@section('top_actions')
    <a href="{{ route('institution.report') }}" target="_blank" class="btn-cyber">
        <i class="ph-bold ph-printer"></i> রেজাল্ট শিট প্রিন্ট
    </a>
@endsection

@section('styles')
<style>
    .tests-split {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 1.5rem;
    }
    @media (max-width: 1100px) {
        .tests-split { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

    <div class="tests-split">
        
        <!-- Left: Create Test Form -->
        <div class="glass-card">
            <div class="glass-card-header">
                <h3><i class="ph-fill ph-plus-circle" style="color:var(--primary-light);"></i> নতুন কাস্টম টেস্ট তৈরি করুন</h3>
                <span class="pill-badge green">লাইভ প্র্যাকটিস</span>
            </div>

            <form action="{{ route('institution.tests.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label>টেস্টের নাম / শিরোনাম</label>
                        <input type="text" name="title" class="form-input" placeholder="যেমন: Weekly Speed Test - Batch 101" required>
                    </div>
                    <div class="form-group">
                        <label>ক্যাটাগরি</label>
                        <input type="text" name="category" class="form-input" value="Coaching Special" required>
                    </div>
                    <div class="form-group">
                        <label>ভাষা ও ফন্ট</label>
                        <select name="language" class="form-select" required>
                            <option value="bn_unicode">বাংলা ইউনিকোড (Kalpurush)</option>
                            <option value="bn_bijoy">বাংলা বিজয় বায়ান্ন (SutonnyMJ)</option>
                            <option value="en">ইংরেজি (English Standard)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>পরীক্ষার মোড</label>
                        <select name="mode" class="form-select" required>
                            <option value="screen">Screen Mode (অন-স্ক্রিন দেখে টাইপ)</option>
                            <option value="sheet">Sheet Mode (প্রশ্নপত্র দেখে টাইপ)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>সময়সীমা (মিনিট)</label>
                        <input type="number" name="time_limit_minutes" class="form-input" value="5" min="1" max="30" required>
                    </div>
                    <div class="form-group">
                        <label>টার্গেট পাসিং স্পিড (WPM)</label>
                        <input type="number" name="pass_wpm" class="form-input" value="25" min="10" max="100" required>
                    </div>
                    <div class="form-group full">
                        <label>প্যাসেজ টেক্সট (যেটি শিক্ষার্থীরা টাইপ করবে)</label>
                        <textarea name="content" class="form-textarea" rows="6" placeholder="পরীক্ষার মূল অনুচ্ছেদ এখানে পেস্ট করুন..." required></textarea>
                    </div>
                </div>

                <button type="submit" class="btn-cyber" style="margin-top:1rem; width:100%; justify-content:center; padding:0.9rem;">
                    <i class="ph-bold ph-floppy-disk"></i> টেস্ট সংরক্ষণ ও লাইভ পাবলিশ করুন
                </button>
            </form>
        </div>

        <!-- Right: Existing Tests List -->
        <div class="glass-card">
            <div class="glass-card-header">
                <h3><i class="ph-fill ph-files" style="color:var(--accent);"></i> প্রস্তুতকৃত টেস্টসমূহ ({{ $tests->total() }})</h3>
            </div>

            <div class="data-table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>টেস্টের নাম</th>
                            <th>ভাষা ও মোড</th>
                            <th>সময়</th>
                            <th>পাসিং WPM</th>
                            <th style="text-align:right;">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tests as $t)
                            <tr>
                                <td>
                                    <strong style="color:white; display:block;">{{ $t->title }}</strong>
                                    <small style="color:var(--text-muted);">{{ $t->category }}</small>
                                </td>
                                <td>
                                    <span class="pill-badge" style="font-size:0.75rem;">
                                        {{ $t->language === 'bn_bijoy' ? 'বিজয় বায়ান্ন' : ($t->language === 'bn_unicode' ? 'বাংলা ইউনিকোড' : 'English') }}
                                    </span>
                                    <span style="font-size:0.75rem; color:var(--text-muted); display:block; margin-top:2px;">
                                        {{ $t->mode === 'screen' ? 'Screen' : 'Sheet' }}
                                    </span>
                                </td>
                                <td>{{ $t->time_limit_minutes }} মি.</td>
                                <td><strong style="color:#38bdf8;">{{ $t->pass_wpm }} WPM</strong></td>
                                <td style="text-align:right;">
                                    <div style="display:flex; justify-content:flex-end; gap:6px;">
                                        <a href="{{ route('test.show', $t->id) }}" target="_blank" class="btn-outline" style="padding:0.35rem 0.6rem; font-size:0.78rem;" title="টেস্ট দিয়ে দেখুন">
                                            <i class="ph-bold ph-play"></i>
                                        </a>
                                        <form action="{{ route('institution.tests.destroy', $t->id) }}" method="POST" onsubmit="return confirm('এই টেস্টটি কি ডিলিট করতে চান?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-outline" style="padding:0.35rem 0.6rem; font-size:0.78rem; color:#f87171; border-color:rgba(239, 68, 68, 0.2);" title="ডিলিট">
                                                <i class="ph-bold ph-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center; color:var(--text-muted); padding:2rem;">এখনও কোনো কাস্টম টেস্ট তৈরি করা হয়নি।</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top:1rem;">
                {{ $tests->links() }}
            </div>
        </div>

    </div>

@endsection
