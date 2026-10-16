@extends('layouts.institution')

@section('title', 'শিক্ষার্থী ব্যবস্থাপনা')
@section('page_title', 'শিক্ষার্থী ব্যবস্থাপনা')
@section('page_subtitle', 'ব্যাচ অনুযায়ী শিক্ষার্থী তালিকা, রোল নম্বর ও নতুন শিক্ষার্থী নিবন্ধন')

@section('top_actions')
    <a href="{{ route('institution.students.importPage') }}" class="btn-outline">
        <i class="ph-bold ph-upload-simple"></i> বাল্ক আপলোড
    </a>
    <a href="{{ route('institution.students.export', ['batch' => $selectedBatch]) }}" class="btn-cyber">
        <i class="ph-bold ph-download-simple"></i> CSV এক্সপোর্ট ({{ $students->total() }})
    </a>
@endsection

@section('styles')
<style>
    .filter-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
    }
    .batch-chips {
        display: flex;
        align-items: center;
        gap: 8px;
        overflow-x: auto;
        padding-bottom: 4px;
    }
    .batch-chip {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid var(--border);
        color: #94a3b8;
        padding: 6px 14px;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: 0.2s;
    }
    .batch-chip:hover, .batch-chip.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .search-box {
        position: relative;
        min-width: 260px;
    }
    .search-box input {
        width: 100%;
        padding: 0.65rem 1rem 0.65rem 2.4rem;
        background: #090e1a;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        color: white;
        font-size: 0.9rem;
        outline: none;
    }
    .search-box input:focus {
        border-color: var(--primary);
    }
    .search-box i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    .pagination-wrap {
        margin-top: 1.5rem;
        display: flex;
        justify-content: flex-end;
    }
</style>
@endsection

@section('content')

    <!-- Add Single Student Form Accordion / Box -->
    <div class="glass-card" style="border-left: 4px solid var(--primary-light);">
        <div class="glass-card-header">
            <h3><i class="ph-fill ph-user-plus" style="color:var(--primary-light);"></i> নতুন শিক্ষার্থী যুক্ত করুন</h3>
            <span class="pill-badge">
                সীমা: {{ $totalStudents }} / {{ $institution->student_limit }} জন
            </span>
        </div>

        <form action="{{ route('institution.students.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>শিক্ষার্থীর পুরো নাম</label>
                    <input type="text" name="name" class="form-input" placeholder="আব্দুর রহিম" required>
                </div>
                <div class="form-group">
                    <label>ইমেইল ঠিকানা (লগইনের ইউজারনেম হিসেবে কাজ করবে)</label>
                    <input type="email" name="email" class="form-input" placeholder="student@example.com" required>
                </div>
                <div class="form-group">
                    <label>ব্যাচের নাম (Batch Name)</label>
                    <input type="text" name="batch_name" class="form-input" placeholder="যেমন: সকাল ব্যাচ - ১০১" list="batch-suggestions">
                    <datalist id="batch-suggestions">
                        @foreach($batches as $b)
                            <option value="{{ $b }}">
                        @endforeach
                    </datalist>
                </div>
                <div class="form-group">
                    <label>রোল নম্বর / স্টুডেন্ট আইডি (Student Roll)</label>
                    <input type="text" name="student_roll" class="form-input" placeholder="যেমন: ST-2026-01">
                </div>
                <div class="form-group">
                    <label>লগইন পাসওয়ার্ড</label>
                    <input type="password" name="password" class="form-input" value="123456" required>
                </div>
                <div class="form-group" style="display:flex; align-items:flex-end;">
                    <button type="submit" class="btn-cyber" style="width:100%; height:48px;">
                        <i class="ph-bold ph-plus-circle"></i> ব্যাচে শিক্ষার্থী যুক্ত করুন
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Students Table Section -->
    <div class="glass-card">
        <div class="glass-card-header">
            <h3><i class="ph-fill ph-student" style="color:var(--accent);"></i> নিবন্ধিত শিক্ষার্থী তালিকা (মোট: {{ $students->total() }} জন)</h3>
            <span style="font-size:0.85rem; color:var(--text-muted);">ফিল্টারকৃত ব্যাচ: <strong style="color:white;">{{ $selectedBatch === 'all' ? 'সকল ব্যাচ' : $selectedBatch }}</strong></span>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="filter-bar">
            <!-- Batch Chips -->
            <div class="batch-chips">
                <a href="{{ route('institution.students.index', ['batch' => 'all', 'search' => $search]) }}" class="batch-chip {{ $selectedBatch === 'all' ? 'active' : '' }}">
                    সকল ব্যাচ
                </a>
                @foreach($batches as $b)
                    <a href="{{ route('institution.students.index', ['batch' => $b, 'search' => $search]) }}" class="batch-chip {{ $selectedBatch === $b ? 'active' : '' }}">
                        {{ $b }}
                    </a>
                @endforeach
            </div>

            <!-- Search Form -->
            <form action="{{ route('institution.students.index') }}" method="GET" class="search-box">
                <input type="hidden" name="batch" value="{{ $selectedBatch }}">
                <i class="ph ph-magnifying-glass"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="নাম, ইমেইল বা রোল দিয়ে খুঁজুন...">
            </form>
        </div>

        <div class="data-table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>রোল / আইডি</th>
                        <th>শিক্ষার্থীর নাম</th>
                        <th>ইমেইল ঠিকানা</th>
                        <th>ব্যাচের নাম</th>
                        <th>অন্তর্ভুক্তির তারিখ</th>
                        <th>অ্যাক্সেস স্ট্যাটাস</th>
                        <th style="text-align:right;">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $st)
                        <tr>
                            <td>
                                <span class="pill-badge">{{ $st->student_roll ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <strong style="font-size:0.95rem; color:white;">{{ $st->name }}</strong>
                            </td>
                            <td style="color:#94a3b8; font-family:'JetBrains Mono', monospace; font-size:0.85rem;">
                                {{ $st->email }}
                            </td>
                            <td>
                                <span style="color:#38bdf8; font-weight:700;">{{ $st->batch_name ?? 'সাধারণ ব্যাচ' }}</span>
                            </td>
                            <td style="color:var(--text-muted); font-size:0.85rem;">
                                {{ $st->created_at->format('d M Y') }}
                            </td>
                            <td>
                                @if($institution->isSubscriptionActive())
                                    <span class="pill-badge green">সক্রিয়</span>
                                @else
                                    <span class="pill-badge red">মেয়াদোত্তীর্ণ</span>
                                @endif
                            </td>
                            <td style="text-align:right;">
                                <form action="{{ route('institution.students.destroy', $st->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিতভাবে এই শিক্ষার্থীকে বাদ দিতে চান?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-outline" style="padding:0.4rem 0.8rem; font-size:0.8rem; color:#f87171; border-color:rgba(239, 68, 68, 0.2);">
                                        <i class="ph-bold ph-trash"></i> মুছুন
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center; color:var(--text-muted); padding:3rem;">
                                <i class="ph ph-folder-open" style="font-size:2.5rem; display:block; margin-bottom:8px; opacity:0.5;"></i>
                                কোনো শিক্ষার্থী পাওয়া যায়নি।
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap">
            {{ $students->links() }}
        </div>
    </div>

@endsection
