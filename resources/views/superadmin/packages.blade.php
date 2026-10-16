@extends('layouts.superadmin')

@section('title', 'স্টুডেন্ট প্যাকেজ প্ল্যান')
@section('page_title', 'স্টুডেন্ট প্যাকেজ ও সাবস্ক্রিপশন প্ল্যান')
@section('page_subtitle', 'শিক্ষার্থীদের জন্য বিভিন্ন মেয়াদের প্যাকেজের মূল্য, টেস্ট লিমিট ও সুবিধা নির্ধারণ')

@section('top_actions')
    <a href="{{ route('admin.dashboard') }}" class="btn-outline">
        <i class="ph ph-arrow-left"></i> ওভারভিউতে ফিরুন
    </a>
@endsection

@section('styles')
<style>
    .packages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }
    .package-card {
        background: var(--surface-glass);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 2rem;
        backdrop-filter: blur(16px);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }
    .package-card.popular {
        border-color: rgba(37, 99, 235, 0.5);
        box-shadow: 0 0 25px rgba(37, 99, 235, 0.2);
    }
    .popular-ribbon {
        position: absolute;
        top: 14px;
        right: 14px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: white;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 0.72rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .price-wrap {
        margin: 1.5rem 0;
    }
    .price-val {
        font-size: 2.4rem;
        font-weight: 800;
        color: white;
        font-family: 'JetBrains Mono', monospace;
    }
    .feature-list {
        list-style: none;
        margin-bottom: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .feature-list li {
        font-size: 0.88rem;
        color: #cbd5e1;
        display: flex;
        align-items: center;
        gap: 8px;
    }
</style>
@endsection

@section('content')

    <div class="packages-grid">
        @forelse($packages as $pkg)
            <div class="package-card {{ $pkg->is_popular ? 'popular' : '' }}">
                <div>
                    @if($pkg->is_popular)
                        <div class="popular-ribbon">জনপ্রিয় প্ল্যান</div>
                    @endif
                    <h3 style="font-size:1.3rem; font-weight:800; color:white;">{{ $pkg->name }}</h3>
                    <p style="font-size:0.83rem; color:var(--text-muted); margin-top:4px;">{{ $pkg->description }}</p>

                    <div class="price-wrap">
                        <span class="price-val">৳{{ number_format($pkg->price, 0) }}</span>
                        <span style="font-size:0.85rem; color:var(--text-muted);">/ {{ $pkg->duration_days }} দিন</span>
                    </div>

                    <ul class="feature-list">
                        <li><i class="ph-bold ph-check" style="color:#10b981;"></i> প্রিমিয়াম টেস্ট অ্যাক্সেস: {{ $pkg->tests_limit ?? 'আনলিমিটেড' }} টি</li>
                        <li><i class="ph-bold ph-check" style="color:#10b981;"></i> বাংলা ইউনিকোড ও বিজয় বায়ান্ন</li>
                        <li><i class="ph-bold ph-check" style="color:#10b981;"></i> সরকারি ৫% ভুল মার্কিং ও সার্টিফিকেট</li>
                        <li><i class="ph-bold ph-check" style="color:#10b981;"></i> লিডারবোর্ড র‍্যাঙ্কিং এন্ট্রি</li>
                    </ul>
                </div>

                <div>
                    <span class="badge {{ $pkg->is_active ? 'claimed' : 'pending' }}">
                        {{ $pkg->is_active ? 'প্ল্যান সক্রিয়' : 'নিষ্ক্রিয়' }}
                    </span>
                </div>
            </div>
        @empty
            <div class="glass-card" style="grid-column:1 / -1; text-align:center; padding:3rem;">
                <p style="color:var(--text-muted);">কোনো প্যাকেজ পাওয়া যায়নি।</p>
            </div>
        @endforelse
    </div>

@endsection
