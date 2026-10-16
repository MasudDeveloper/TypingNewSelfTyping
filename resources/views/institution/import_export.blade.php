@extends('layouts.institution')

@section('title', 'বাল্ক ইমপোর্ট ও এক্সপোর্ট')
@section('page_title', 'বাল্ক ইমপোর্ট ও এক্সপোর্ট')
@section('page_subtitle', 'এক ক্লিকে সম্পূর্ণ ব্যাচের শিক্ষার্থী তৈরি করুন অথবা CSV ডাউনলোড করুন')

@section('top_actions')
    <a href="{{ route('institution.students.index') }}" class="btn-outline">
        <i class="ph ph-arrow-left"></i> শিক্ষার্থী তালিকায় ফিরুন
    </a>
@endsection

@section('styles')
<style>
    .import-export-grid {
        display: grid;
        grid-template-columns: 1.3fr 1fr;
        gap: 1.5rem;
    }
    .guide-box {
        background: rgba(37, 99, 235, 0.08);
        border: 1px dashed rgba(59, 130, 246, 0.35);
        border-radius: 14px;
        padding: 1.25rem;
        margin-bottom: 1.25rem;
    }
    .code-snippet {
        background: #060913;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 0.8rem 1rem;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.85rem;
        color: #38bdf8;
        margin-top: 8px;
        white-space: pre-wrap;
    }
    .dropzone-box {
        border: 2px dashed rgba(255, 255, 255, 0.15);
        border-radius: 14px;
        padding: 1.8rem;
        text-align: center;
        background: rgba(255, 255, 255, 0.02);
        cursor: pointer;
        transition: 0.2s;
    }
    .dropzone-box:hover {
        border-color: var(--primary-light);
        background: rgba(37, 99, 235, 0.05);
    }
    @media (max-width: 1024px) {
        .import-export-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

    <div class="import-export-grid">
        
        <!-- Left: Bulk Import Card -->
        <div class="glass-card">
            <div class="glass-card-header">
                <h3><i class="ph-fill ph-file-arrow-up" style="color:var(--accent);"></i> শিক্ষার্থীদের বাল্ক আপলোড (Bulk Import)</h3>
                <span class="pill-badge">সীমা বাকি: {{ max(0, $institution->student_limit - $totalStudents) }} জন</span>
            </div>

            <div class="guide-box">
                <h4 style="font-size:0.9rem; font-weight:700; color:white; display:flex; align-items:center; gap:6px;">
                    <i class="ph-bold ph-info" style="color:#60a5fa;"></i> ফরম্যাট নির্দেশিকা:
                </h4>
                <p style="font-size:0.83rem; color:var(--text-muted); margin-top:4px;">
                    CSV ফাইল অথবা নিচের টেক্সট বক্সে প্রতি লাইনে কমা দিয়ে তথ্য দিন:
                </p>
                <div class="code-snippet">শিক্ষার্থীর নাম, ইমেইল, পাসওয়ার্ড (ঐচ্ছিক), রোল/আইডি (ঐচ্ছিক)</div>
                <div style="font-size:0.78rem; color:#94a3b8; margin-top:6px;">
                    * উদাহরণ: <code>মো: হাসান, hasan@test.com, 123456, ST-101</code> (পাসওয়ার্ড না দিলে ডিফল্ট <code>123456</code> হবে)
                </div>
            </div>

            <form action="{{ route('institution.students.bulkImport') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group" style="margin-bottom:1.25rem;">
                    <label>কোন ব্যাচে অন্তর্ভুক্ত করতে চান? (Batch Name)</label>
                    <input type="text" name="batch_name" class="form-input" placeholder="যেমন: সকাল ব্যাচ - ২০২৬" required list="batch-suggestions">
                    <datalist id="batch-suggestions">
                        @foreach($batches as $b)
                            <option value="{{ $b }}">
                        @endforeach
                    </datalist>
                </div>

                <div class="form-group" style="margin-bottom:1.25rem;">
                    <label>CSV ফাইল আপলোড করুন (File Upload)</label>
                    <input type="file" name="csv_file" class="form-input" accept=".csv,.txt">
                </div>

                <div class="form-group" style="margin-bottom:1.5rem;">
                    <label>অথবা সরাসরি লাইন বাই লাইন পেস্ট করুন (Direct Copy-Paste)</label>
                    <textarea name="raw_text" class="form-textarea" rows="6" placeholder="হাসান মাহমুদ, hasan@gmail.com, 123456, 101
সাকিল আহমেদ, sakil@gmail.com, 123456, 102
তানভীর হোসাইন, tanvir@gmail.com, 123456, 103"></textarea>
                </div>

                <button type="submit" class="btn-cyber-success" style="width:100%; justify-content:center; padding:0.9rem;">
                    <i class="ph-bold ph-upload-simple"></i> বাল্ক শিক্ষার্থী ইমপোর্ট সম্পন্ন করুন
                </button>
            </form>
        </div>

        <!-- Right: Export Section & Template Download -->
        <div style="display:flex; flex-direction:column; gap:1.5rem;">
            
            <!-- Export Hub -->
            <div class="glass-card">
                <div class="glass-card-header">
                    <h3><i class="ph-fill ph-file-csv" style="color:#38bdf8;"></i> শিক্ষার্থী ডেটা এক্সপোর্ট (CSV)</h3>
                </div>

                <p style="font-size:0.85rem; color:var(--text-muted); margin-bottom:1.2rem;">
                    সম্পূর্ণ কোচিং বা নির্দিষ্ট ব্যাচের সকল শিক্ষার্থীর আইডি, নাম, ইমেল ও রোল নম্বর এক ক্লিকে এক্সেল বা গুগল শিটস ফরম্যাটে নামিয়ে নিন।
                </p>

                <form action="{{ route('institution.students.export') }}" method="GET">
                    <div class="form-group" style="margin-bottom:1.25rem;">
                        <label>ব্যাচ নির্বাচন করুন</label>
                        <select name="batch" class="form-select">
                            <option value="all">সকল ব্যাচের শিক্ষার্থী ({{ $totalStudents }} জন)</option>
                            @foreach($batches as $b)
                                <option value="{{ $b }}">{{ $b }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn-cyber" style="width:100%; justify-content:center;">
                        <i class="ph-bold ph-download-simple"></i> নির্বাচিত ব্যাচ এক্সপোর্ট করুন (.CSV)
                    </button>
                </form>
            </div>

            <!-- Sample CSV Template Box -->
            <div class="glass-card">
                <div class="glass-card-header">
                    <h3><i class="ph-fill ph-file-text" style="color:#fbbf24;"></i> স্যাম্পল ডামি ফরম্যাট</h3>
                </div>
                
                <p style="font-size:0.85rem; color:var(--text-muted); margin-bottom:1rem;">
                    আপনার এক্সেল ফাইল তৈরির সুবিধার জন্য নিচের কলামগুলো সাজিয়ে নিতে পারেন:
                </p>

                <div class="code-snippet" style="font-size:0.8rem;">
Name,Email,Password,Roll
আসিফ ইকবাল,asif@mail.com,123456,B1-01
নুসরাত জাহান,nusrat@mail.com,123456,B1-02
রাকিব হাসান,rakib@mail.com,123456,B1-03
                </div>

                <div style="margin-top:1rem;">
                    <a href="data:text/csv;charset=utf-8,Name,Email,Password,Roll%0AAsif%20Iqbal,asif@example.com,123456,ST-101%0ARakib%20Hasan,rakib@example.com,123456,ST-102" download="sample_students.csv" class="btn-outline" style="width:100%; justify-content:center;">
                        <i class="ph-bold ph-file-arrow-down"></i> স্যাম্পল CSV ফাইল ডাউনলোড
                    </a>
                </div>
            </div>

        </div>

    </div>

@endsection
