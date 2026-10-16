@extends('layouts.superadmin')

@section('title', 'বই ও প্রকাশনা')
@section('page_title', 'বই ও স্টাডি মেটেরিয়াল ম্যানেজমেন্ট')
@section('page_subtitle', 'টাইপিং টিউটোরিয়াল বই, কুরিয়ার অর্ডার ও ডিরেক্ট সেলস ক্যাটালগ পরিচালনা')

@section('top_actions')
    <a href="{{ route('admin.dashboard') }}" class="btn-outline">
        <i class="ph ph-arrow-left"></i> ওভারভিউতে ফিরুন
    </a>
@endsection

@section('styles')
<style>
    .book-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }
    .book-card {
        background: var(--surface-glass);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.2s, border-color 0.2s;
    }
    .book-card:hover {
        transform: translateY(-4px);
        border-color: rgba(99, 102, 241, 0.4);
    }
    .book-cover {
        height: 200px;
        background: #0f172a;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }
    .book-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .book-badge-stock {
        position: absolute;
        top: 10px;
        right: 10px;
    }
    .book-body {
        padding: 1.25rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .book-title {
        font-weight: 700;
        font-size: 1.05rem;
        color: #fff;
        margin-bottom: 0.35rem;
    }
    .book-sub {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 1rem;
        line-height: 1.4;
    }
    .book-pricing {
        margin-top: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 1rem;
        border-top: 1px solid var(--border);
    }
    .price-tag {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--success);
    }
    .original-price {
        font-size: 0.85rem;
        color: var(--text-muted);
        text-decoration: line-through;
        margin-left: 6px;
    }
</style>
@endsection

@section('content')

    <!-- Add Book Form Card -->
    <div class="glass-card" style="border-left: 4px solid var(--info);">
        <div class="glass-card-header">
            <h3><i class="ph-fill ph-book-open" style="color:var(--info);"></i> নতুন বই বা স্টাডি গাইড যুক্ত করুন</h3>
            <span class="badge claimed">Store Publication</span>
        </div>

        <form action="{{ route('admin.books.store') }}" method="POST">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>বইয়ের নাম (Title)</label>
                    <input type="text" name="title" class="form-control" placeholder="যেমন: বিসিসি সাঁটমুদ্রাক্ষরিক ও কম্পিউটার টাইপিং মাস্টার" required>
                </div>
                <div class="form-group">
                    <label>সাবটাইটেল বা সংক্ষিপ্ত বিবরণ</label>
                    <input type="text" name="subtitle" class="form-control" placeholder="যেমন: সরকারি চাকরির জন্য পূর্ণাঙ্গ টাইপিং গাইড ও প্রশ্নব্যাংক">
                </div>
                <div class="form-group">
                    <label>বিক্রয় মূল্য (Price in ৳)</label>
                    <input type="number" step="0.01" name="price" class="form-control" placeholder="যেমন: 280" required>
                </div>
                <div class="form-group">
                    <label>আসল মূল্য / গায়ের রেট (Original Price ৳)</label>
                    <input type="number" step="0.01" name="original_price" class="form-control" placeholder="যেমন: 350">
                </div>
                <div class="form-group">
                    <label>ডিসকাউন্ট পার্সেন্ট (%)</label>
                    <input type="number" name="discount_percent" class="form-control" placeholder="যেমন: 20">
                </div>
                <div class="form-group">
                    <label>স্টক স্ট্যাটাস</label>
                    <select name="stock_status" class="form-control">
                        <option value="In Stock">In Stock (স্টকে আছে)</option>
                        <option value="Limited Stock">Limited Stock (সীমিত)</option>
                        <option value="Out of Stock">Out of Stock (স্টক শেষ)</option>
                        <option value="Pre Order">Pre Order (অগ্রিম বুকিং)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>অর্ডার লিংক (Rokomari / Google Form / Messenger Link)</label>
                    <input type="url" name="external_url" class="form-control" placeholder="https://rokomari.com/book/... অথবা ফেসবুক লিংক" required>
                </div>
                <div class="form-group">
                    <label>বইয়ের কভার ইমেজ URL (Image Link)</label>
                    <input type="url" name="image_url" class="form-control" placeholder="https://domain.com/images/book-cover.jpg">
                </div>
                <div class="form-group">
                    <label>অ্যাকসেন্ট কালার (HEX)</label>
                    <input type="text" name="accent_color" class="form-control" value="#6366f1" placeholder="#6366f1">
                </div>
                <div class="form-group">
                    <label>ডিসপ্লে ক্রম (Sort Order)</label>
                    <input type="number" name="sort_order" class="form-control" value="0">
                </div>
            </div>

            <div style="margin-top: 1rem; display: flex; align-items: center; justify-content: space-between;">
                <label style="display: flex; align-items: center; gap: 8px; font-size: 0.9rem; color: var(--text-main); cursor: pointer;">
                    <input type="checkbox" name="is_active" value="1" checked style="width: 18px; height: 18px; accent-color: var(--primary);">
                    হোমপেজ ও বুকশপে দৃশ্যমান রাখুন (Active & Published)
                </label>

                <button type="submit" class="btn-primary">
                    <i class="ph-bold ph-plus"></i> বইটি ক্যাটালগে যুক্ত করুন
                </button>
            </div>
        </form>
    </div>

    <!-- Books Listing Section -->
    <div class="glass-card">
        <div class="glass-card-header">
            <h3><i class="ph ph-books"></i> ক্যাটালগে থাকা বইসমূহ ({{ $books->total() }})</h3>
        </div>

        @if($books->count() > 0)
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>কভার</th>
                            <th>বইয়ের নাম ও বিবরণ</th>
                            <th>মূল্য ও ডিসকাউন্ট</th>
                            <th>স্টক স্ট্যাটাস</th>
                            <th>অর্ডার লিংক</th>
                            <th>স্ট্যাটাস</th>
                            <th style="text-align: right;">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td style="width: 70px;">
                                    @if($book->image_url)
                                        <img src="{{ $book->image_url }}" alt="{{ $book->title }}" style="width: 50px; height: 65px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border);">
                                    @else
                                        <div style="width: 50px; height: 65px; background: rgba(255,255,255,0.05); border-radius: 6px; display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
                                            <i class="ph ph-book" style="font-size: 1.5rem;"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-weight: 700; color: #fff;">{{ $book->title }}</div>
                                    @if($book->subtitle)
                                        <div style="font-size: 0.8rem; color: var(--text-muted); max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            {{ $book->subtitle }}
                                        </div>
                                    @endif
                                    <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 2px;">ক্রম: {{ $book->sort_order }}</div>
                                </td>
                                <td>
                                    <span style="font-weight: 700; color: var(--success); font-size: 1.05rem;">৳{{ number_format($book->price, 2) }}</span>
                                    @if($book->original_price)
                                        <span style="font-size: 0.8rem; color: var(--text-muted); text-decoration: line-through; margin-left: 4px;">৳{{ number_format($book->original_price, 2) }}</span>
                                    @endif
                                    @if($book->discount_percent)
                                        <div style="font-size: 0.75rem; color: var(--warning); font-weight: 600;">{{ $book->discount_percent }}% OFF</div>
                                    @endif
                                </td>
                                <td>
                                    @if($book->stock_status === 'In Stock')
                                        <span class="badge claimed"><i class="ph ph-check"></i> {{ $book->stock_status }}</span>
                                    @elseif($book->stock_status === 'Limited Stock')
                                        <span class="badge" style="background: rgba(245, 158, 11, 0.15); color: #f59e0b;"><i class="ph ph-warning"></i> {{ $book->stock_status }}</span>
                                    @else
                                        <span class="badge pending">{{ $book->stock_status }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($book->external_url)
                                        <a href="{{ $book->external_url }}" target="_blank" class="btn-outline" style="padding: 4px 10px; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 4px;">
                                            <i class="ph ph-arrow-square-out"></i> অর্ডার লিঙ্ক
                                        </a>
                                    @else
                                        <span style="color: var(--text-muted); font-size: 0.8rem;">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($book->is_active)
                                        <span class="badge claimed">সক্রিয়</span>
                                    @else
                                        <span class="badge pending">নিষ্ক্রিয়</span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে বইটি মুছে ফেলতে চান?');" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-outline" style="color: #ef4444; border-color: rgba(239, 68, 68, 0.3); padding: 5px 10px;" title="বইটি মুছুন">
                                            <i class="ph ph-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 1.5rem;">
                {{ $books->links() }}
            </div>
        @else
            <div style="text-align: center; padding: 3rem 1rem; color: var(--text-muted);">
                <i class="ph ph-book-open" style="font-size: 3rem; opacity: 0.3; margin-bottom: 0.75rem; display: block;"></i>
                <p>ক্যাটালগে বর্তমানে কোনো বই যুক্ত করা নেই। ওপরের ফর্মটি পূরণ করে প্রথম বইটি যুক্ত করুন।</p>
            </div>
        @endif
    </div>

@endsection
