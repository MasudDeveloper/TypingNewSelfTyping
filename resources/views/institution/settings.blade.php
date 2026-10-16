@extends('layouts.institution')

@section('title', 'কোচিং লোগো ও ব্র্যান্ডিং')
@section('page_title', 'কোচিং লোগো ও ব্র্যান্ডিং সেটিংস')
@section('page_subtitle', 'রিপোর্ট শিট ও পোর্টালে আপনার কোচিংয়ের নাম, লোগো ও পরিচালকের স্বাক্ষর কনফিগার করুন')

@section('top_actions')
    <a href="{{ route('institution.report') }}" target="_blank" class="btn-outline">
        <i class="ph-bold ph-eye"></i> বর্তমান রেজাল্ট শিট প্রিভিউ
    </a>
@endsection

@section('styles')
<style>
    .settings-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
    }
    .preview-card {
        background: #ffffff;
        color: #0f172a;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .preview-head {
        text-align: center;
        border-bottom: 2px dashed #cbd5e1;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }
    .preview-logo-img {
        max-height: 55px;
        max-width: 140px;
        object-fit: contain;
        margin-bottom: 8px;
    }
    @media (max-width: 1024px) {
        .settings-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

    <div class="settings-grid">
        
        <!-- Left: Form -->
        <div class="glass-card">
            <div class="glass-card-header">
                <h3><i class="ph-fill ph-paint-brush" style="color:var(--primary-light);"></i> ব্র্যান্ডিং ও যোগাযোগ তথ্য</h3>
            </div>

            <form action="{{ route('institution.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label>কোচিং সেন্টারের পুরো নাম</label>
                        <input type="text" name="name" class="form-input" value="{{ $institution->name }}" required>
                    </div>
                    <div class="form-group">
                        <label>ট্যাগলাইন বা স্লোগান</label>
                        <input type="text" name="tagline" class="form-input" value="{{ $institution->tagline }}" placeholder="যেমন: সরকারি চাকরির টাইপিংয়ের বিশ্বস্ত ঠিকানা">
                    </div>
                    <div class="form-group">
                        <label>যোগাযোগের ফোন নম্বর</label>
                        <input type="text" name="phone" class="form-input" value="{{ $institution->phone }}" placeholder="০১৭১১-xxxxxx">
                    </div>
                    <div class="form-group">
                        <label>অফিসিয়াল ইমেইল</label>
                        <input type="email" name="email" class="form-input" value="{{ $institution->email }}" placeholder="info@coaching.com">
                    </div>
                    <div class="form-group full">
                        <label>প্রতিষ্ঠানের ঠিকানা (রিপোর্টের হেডার হিসেবে প্রিন্ট হবে)</label>
                        <input type="text" name="address" class="form-input" value="{{ $institution->address }}" placeholder="যেমন: মিরপুর ১০, ঢাকা - ১২১৬">
                    </div>
                    
                    <div class="form-group">
                        <label>প্রতিষ্ঠানের লোগো (PNG, JPG, WebP)</label>
                        <input type="file" name="logo" class="form-input" accept="image/*">
                        <small style="color:var(--text-muted); font-size:0.75rem; display:block; margin-top:4px;">
                            ট্রান্সপারেন্ট ব্যাকগ্রাউন্ডের লোগো হলে সবচেয়ে সুন্দর দেখাবে
                        </small>
                    </div>

                    <div class="form-group">
                        <label>পরিচালকের অফিসিয়াল স্বাক্ষর / সিল (Signature / Seal)</label>
                        <input type="file" name="signature" class="form-input" accept="image/*">
                        <small style="color:var(--text-muted); font-size:0.75rem; display:block; margin-top:4px;">
                            রেজাল্ট শিটের নিচে স্বয়ংক্রিয়ভাবে প্রিন্ট হবে
                        </small>
                    </div>
                </div>

                <button type="submit" class="btn-cyber" style="margin-top:1.5rem; padding:0.9rem 2rem;">
                    <i class="ph-bold ph-floppy-disk"></i> ব্র্যান্ডিং পরিবর্তন সংরক্ষণ করুন
                </button>
            </form>
        </div>

        <!-- Right: Real-time Visual Sheet Preview -->
        <div>
            <div class="glass-card" style="margin-bottom:1.5rem;">
                <div class="glass-card-header">
                    <h3><i class="ph-fill ph-certificate" style="color:#fbbf24;"></i> রিপোর্ট হেডারের প্রিভিউ</h3>
                </div>

                <div class="preview-card">
                    <div class="preview-head">
                        @if($institution->logo_path)
                            <img src="{{ $institution->logo_path }}" alt="Logo" class="preview-logo-img">
                        @else
                            <div style="font-size:2.2rem; color:#2563eb; margin-bottom:4px;">
                                <i class="ph-bold ph-chalkboard-teacher"></i>
                            </div>
                        @endif
                        <h4 style="font-size:1.15rem; font-weight:800; color:#0f172a; line-height:1.2;">
                            {{ $institution->name }}
                        </h4>
                        <div style="font-size:0.75rem; color:#2563eb; font-weight:700;">
                            {{ $institution->tagline ?? 'Official Typing Performance Certificate' }}
                        </div>
                        <div style="font-size:0.72rem; color:#64748b; margin-top:2px;">
                            {{ $institution->address ?? 'Coaching Center Address, Bangladesh' }} • Ph: {{ $institution->phone ?? '01XXXXXXXXX' }}
                        </div>
                    </div>

                    <div style="font-size:0.75rem; color:#64748b; text-align:center; padding:10px 0; border:1px solid #e2e8f0; border-radius:8px; margin-bottom:1rem; background:#f8fafc;">
                        [ রেজাল্ট টেবিল ডেটা স্বয়ংক্রিয়ভাবে এখানে বসবে ]
                    </div>

                    <div style="display:flex; justify-content:flex-end; text-align:center; margin-top:1.5rem;">
                        <div>
                            @if($institution->signature_path)
                                <img src="{{ $institution->signature_path }}" alt="Sig" style="max-height:40px; margin-bottom:2px; display:block; margin-left:auto; margin-right:auto;">
                            @else
                                <div style="height:35px; border-bottom:1px dashed #94a3b8; width:120px; margin-bottom:4px;"></div>
                            @endif
                            <div style="border-top:1.5px solid #0f172a; padding-top:3px; font-size:0.75rem; font-weight:700;">
                                পরিচালক / অনুমোদিত স্বাক্ষর
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card">
                <h4 style="font-size:0.95rem; font-weight:700; color:white; margin-bottom:6px;">
                    <i class="ph-bold ph-shield-check" style="color:#34d399;"></i> কেন নিজস্ব ব্র্যান্ডিং জরুরি?
                </h4>
                <p style="font-size:0.83rem; color:var(--text-muted); line-height:1.5;">
                    শিক্ষার্থীদের হাতে যখন আপনার প্রতিষ্ঠানের নাম, লোগো ও স্বাক্ষরিত টেস্ট রিপোর্ট বা সার্টিফিকেট পৌঁছাবে, তখন তাদের কাছে আপনার কোচিং সেন্টারের বিশ্বাসযোগ্যতা ও গ্রহণযোগ্যতা বহুগুণ বৃদ্ধি পাবে।
                </p>
            </div>
        </div>

    </div>

@endsection
