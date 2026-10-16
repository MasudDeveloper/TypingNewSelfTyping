@extends('layouts.superadmin')

@section('title', 'টাইপিং প্রশ্নব্যাংক')
@section('page_title', 'টাইপিং পরীক্ষার প্রশ্নব্যাংক ও প্যাসেজ ম্যানেজমেন্ট')
@section('page_subtitle', 'বিসিসি, সরকারি চাকরি ও একাডেমি পরীক্ষার জন্য টেস্ট তৈরি ও পর্যবেক্ষণ')

@section('top_actions')
    <a href="{{ route('admin.dashboard') }}" class="btn-outline">
        <i class="ph ph-arrow-left"></i> ওভারভিউতে ফিরুন
    </a>
@endsection

@section('styles')
<style>
    .filter-pills {
        display: flex;
        gap: 8px;
        margin-bottom: 1.25rem;
    }
    .pill-btn {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid var(--border);
        color: var(--text-muted);
        padding: 6px 14px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s;
    }
    .pill-btn:hover, .pill-btn.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }
</style>
@endsection

@section('content')

    <!-- Create Test Section -->
    <div class="glass-card" style="border-left: 4px solid var(--primary-light);">
        <div class="glass-card-header">
            <h3><i class="ph-fill ph-plus-circle" style="color:var(--primary-light);"></i> নতুন টাইপিং টেস্ট তৈরি করুন</h3>
            <span class="badge claimed">Live Exam Module</span>
        </div>

        <form action="{{ route('admin.tests.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>টেস্টের শিরোনাম (Test Title)</label>
                    <input type="text" name="title" class="form-control" placeholder="যেমন: বিসিসি সাঁটমুদ্রাক্ষরিক স্পিড টেস্ট - ২০২৬" required>
                </div>
                <div class="form-group">
                    <label>ক্যাটাগরি</label>
                    <input type="text" name="category" class="form-control" placeholder="Govt Job, BCC Special, Basic" value="Govt Job" required>
                </div>
                <div class="form-group">
                    <label>ভাষা ও ফন্ট সিলেবাস</label>
                    <select name="language" class="form-control" required>
                        <option value="bn_unicode">বাংলা ইউনিকোড (Kalpurush / Avro / UniJoy)</option>
                        <option value="bn_bijoy">বাংলা বিজয় বায়ান্ন (SutonnyMJ Classic)</option>
                        <option value="en">ইংরেজি (English Standard QWERTY)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>পরীক্ষার মোড</label>
                    <select name="mode" class="form-control" required>
                        <option value="screen">Screen Mode (অন-স্ক্রিন দেখে টাইপ)</option>
                        <option value="sheet" selected>Sheet Mode (বিসিসি প্রশ্নপত্র দেখে টাইপ)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>সময়সীমা (মিনিট)</label>
                    <input type="number" name="time_limit_minutes" class="form-control" value="5" min="1" max="30" required>
                </div>
                <div class="form-group">
                    <label>পাসিং স্পিড (Net WPM)</label>
                    <input type="number" name="pass_wpm" class="form-control" value="25" min="10" max="100" required>
                </div>
                <div class="form-group full">
                    <label>প্যাসেজ টেক্সট (পরীক্ষার্থী যা দেখে টাইপ করবে)</label>
                    <textarea name="content" class="form-control" rows="5" placeholder="পরীক্ষার মূল অনুচ্ছেদ এখানে লিখুন বা পেস্ট করুন..." required></textarea>
                </div>
                <div class="form-group full" style="display:flex; gap:20px; align-items:center;">
                    <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:0.9rem; color:white;">
                        <input type="checkbox" name="is_premium" value="1" checked>
                        <span>প্রিমিয়াম টেস্ট (প্যাকেজ সাবস্ক্রাইবারদের জন্য)</span>
                    </label>
                    <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:0.9rem; color:white;">
                        <input type="checkbox" name="backspace_allowed" value="1" checked>
                        <span>ব্যাকস্পেস ব্যবহারের অনুমতি দিন (Backspace Allowed)</span>
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-cyber" style="margin-top:1.25rem;">
                <i class="ph-bold ph-floppy-disk"></i> টেস্ট সংরক্ষণ ও পাবলিশ করুন
            </button>
        </form>
    </div>

    <!-- Tests Table -->
    <div class="glass-card">
        <div class="glass-card-header">
            <h3><i class="ph-fill ph-files" style="color:var(--accent);"></i> প্রস্তুতকৃত টেস্টসমূহ (মোট: {{ $totalTests }} টি)</h3>
            <span style="font-size:0.85rem; color:var(--text-muted);">ফিল্টারকৃত ভাষা: <strong style="color:white;">{{ strtoupper($lang) }}</strong></span>
        </div>

        <div class="filter-pills">
            <a href="{{ route('admin.tests.index', ['lang' => 'all']) }}" class="pill-btn {{ $lang === 'all' ? 'active' : '' }}">সকল টেস্ট</a>
            <a href="{{ route('admin.tests.index', ['lang' => 'bn_unicode']) }}" class="pill-btn {{ $lang === 'bn_unicode' ? 'active' : '' }}">বাংলা ইউনিকোড</a>
            <a href="{{ route('admin.tests.index', ['lang' => 'bn_bijoy']) }}" class="pill-btn {{ $lang === 'bn_bijoy' ? 'active' : '' }}">বিজয় বায়ান্ন</a>
            <a href="{{ route('admin.tests.index', ['lang' => 'en']) }}" class="pill-btn {{ $lang === 'en' ? 'active' : '' }}">English</a>
        </div>

        <div class="data-table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>টেস্টের শিরোনাম ও ক্যাটাগরি</th>
                        <th>ভাষা ও ফন্ট</th>
                        <th>মোড</th>
                        <th>সময়</th>
                        <th>টার্গেট WPM</th>
                        <th>অ্যাক্সেস</th>
                        <th style="text-align:right;">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tests as $t)
                        <tr>
                            <td>
                                <strong style="font-size:0.95rem; color:white; display:block;">{{ $t->title }}</strong>
                                <small style="color:var(--text-muted);">{{ $t->category }}</small>
                            </td>
                            <td>
                                <span class="badge {{ $t->language === 'bn_bijoy' ? 'unclaimed' : 'claimed' }}">
                                    {{ $t->language === 'bn_bijoy' ? 'বিজয় বায়ান্ন' : ($t->language === 'bn_unicode' ? 'ইউনিকোড' : 'English') }}
                                </span>
                            </td>
                            <td>
                                <span style="font-size:0.82rem; color:#93c5fd; font-weight:700;">{{ strtoupper($t->mode) }}</span>
                            </td>
                            <td>{{ $t->time_limit_minutes }} মিনিট</td>
                            <td><strong style="color:#38bdf8;">{{ $t->pass_wpm }} WPM</strong></td>
                            <td>
                                @if($t->is_premium)
                                    <span class="badge pending">প্রিমিয়াম</span>
                                @else
                                    <span class="badge claimed">ফ্রি</span>
                                @endif
                            </td>
                            <td style="text-align:right;">
                                <div style="display:flex; justify-content:flex-end; gap:6px;">
                                    <a href="{{ route('test.show', $t->id) }}" target="_blank" class="btn-outline" style="padding:5px 10px; font-size:0.8rem;" title="টেস্ট দিন">
                                        <i class="ph-bold ph-play"></i>
                                    </a>
                                    <form action="{{ route('admin.tests.destroy', $t->id) }}" method="POST" onsubmit="return confirm('টেস্টটি ডিলিট করতে চান?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" style="padding:5px 10px;">
                                            <i class="ph-bold ph-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center; color:var(--text-muted); padding:3rem;">কোনো টেস্ট পাওয়া যায়নি।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:1.5rem;">
            {{ $tests->links() }}
        </div>
    </div>

@endsection
