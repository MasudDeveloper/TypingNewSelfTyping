@extends('layouts.superadmin')

@section('title', 'অ্যান্ড্রয়েড এসএমএস গেটওয়ে ও রিচার্জ')
@section('page_title', 'অ্যান্ড্রয়েড এসএমএস গেটওয়ে ও ওয়ালেট রিচার্জ')
@section('page_subtitle', 'অটো বিকাশ/নগদ এসএমএস ট্র্যাকিং ও ম্যানুয়াল রিচার্জ অনুমোদন পোর্টাল')

@section('top_actions')
    <a href="{{ route('admin.dashboard') }}" class="btn-outline">
        <i class="ph ph-arrow-left"></i> ওভারভিউতে ফিরুন
    </a>
@endsection

@section('styles')
<style>
    .gateway-banner {
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.16), rgba(16, 185, 129, 0.1));
        border: 1px solid rgba(59, 130, 246, 0.3);
        border-radius: 20px;
        padding: 1.8rem 2.2rem;
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 2rem;
        align-items: center;
    }
    .config-box {
        background: #090e1a;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 10px 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 6px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.88rem;
        color: #38bdf8;
    }
    .btn-copy {
        background: rgba(56, 189, 248, 0.15);
        color: #38bdf8;
        border: 1px solid rgba(56, 189, 248, 0.3);
        padding: 5px 12px;
        border-radius: 8px;
        font-size: 0.78rem;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s;
    }
    .btn-copy:hover {
        background: #38bdf8;
        color: #0b0f19;
    }
    @media (max-width: 1024px) {
        .gateway-banner { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')

    <!-- Android SMS Gateway Live Config Banner -->
    <div class="gateway-banner">
        <div>
            <h3 style="font-size:1.35rem; font-weight:800; color:white; margin-bottom:6px; display:flex; align-items:center; gap:8px;">
                <i class="ph-fill ph-robot" style="color:#38bdf8;"></i> Android SMS Gateway Integration
            </h3>
            <p style="font-size:0.88rem; color:var(--text-muted); line-height:1.5;">
                আপনার ফোনে <strong>SMS to URL Forwarder</strong> অ্যাপে নিচের Webhook URL ও API Key সেট করুন। বিকাশ ও নগদ থেকে কোনো রিচার্জ এসএমএস আসলে সিস্টেম স্বয়ংক্রিয়ভাবে ইউজারের ওয়ালেটে ব্যালেন্স রিচার্জ করে দেবে।
            </p>
        </div>
        <div>
            <div style="margin-bottom:12px;">
                <label style="font-size:0.75rem; text-transform:uppercase; color:var(--text-muted); font-weight:700;">Webhook Target URL</label>
                <div class="config-box">
                    <span id="webhook-url">{{ $gatewayWebhookUrl }}</span>
                    <button class="btn-copy" onclick="copyText('webhook-url')"><i class="ph-bold ph-copy"></i> কপি</button>
                </div>
            </div>
            <div>
                <label style="font-size:0.75rem; text-transform:uppercase; color:var(--text-muted); font-weight:700;">Gateway Secret Header API Key</label>
                <div class="config-box">
                    <span id="api-key">{{ $gatewayApiKey }}</span>
                    <button class="btn-copy" onclick="copyText('api-key')"><i class="ph-bold ph-copy"></i> কপি</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Manual Recharge Requests -->
    <div class="glass-card">
        <div class="glass-card-header">
            <h3>
                <i class="ph-fill ph-hand-coins" style="color:#fbbf24;"></i> পেন্ডিং ওয়ালেট রিচার্জ রিকোয়েস্ট ({{ $pendingRecharges->total() }})
            </h3>
            <span style="font-size:0.85rem; color:var(--text-muted);">মোট সম্পন্ন রিচার্জ: <strong style="color:#34d399;">{{ number_format($totalCompletedRecharges, 0) }} ৳</strong></span>
        </div>

        <div class="data-table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ইউজার</th>
                        <th>পেমেন্ট মেথড</th>
                        <th>পরিমাণ</th>
                        <th>TrxID</th>
                        <th>প্রেরক মোবাইল</th>
                        <th>তারিখ ও সময়</th>
                        <th style="text-align:right;">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingRecharges as $pr)
                        <tr>
                            <td>
                                <strong>{{ $pr->user->name ?? 'User' }}</strong>
                                <div style="font-size:0.75rem; color:var(--text-muted); font-family:monospace;">{{ $pr->user->email ?? '' }}</div>
                            </td>
                            <td><span class="badge unclaimed">{{ strtoupper($pr->payment_method) }}</span></td>
                            <td><strong style="color:#34d399; font-size:1.1rem; font-family:'JetBrains Mono', monospace;">{{ $pr->amount }} ৳</strong></td>
                            <td><code style="color:#38bdf8; font-weight:700;">{{ $pr->transaction_id }}</code></td>
                            <td>{{ $pr->sender_number }}</td>
                            <td style="color:var(--text-muted); font-size:0.85rem;">{{ $pr->created_at->format('d M, h:i A') }}</td>
                            <td style="text-align:right;">
                                <form action="{{ route('admin.recharge.approve', $pr->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-action btn-approve"><i class="ph-bold ph-check"></i> অনুমোদন</button>
                                </form>
                                <form action="{{ route('admin.recharge.reject', $pr->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-action btn-reject"><i class="ph-bold ph-x"></i> বাতিল</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center; color:var(--text-muted); padding:2.5rem;">কোনো পেন্ডিং রিচার্জ রিকোয়েস্ট নেই।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:1.25rem;">
            {{ $pendingRecharges->links() }}
        </div>
    </div>

    <!-- Live Received SMS Logs -->
    <div class="glass-card">
        <div class="glass-card-header">
            <h3><i class="ph-fill ph-chat-centered-text" style="color:var(--primary-light);"></i> অ্যান্ড্রয়েড ফরোয়ার্ডার থেকে প্রাপ্ত লাইভ এসএমএস লগ</h3>
            <span class="badge claimed">Real-time Stream</span>
        </div>

        <div class="data-table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>প্রেরক / সিম</th>
                        <th>টাকা</th>
                        <th>TrxID</th>
                        <th>অটো-ম্যাচিং স্ট্যাটাস</th>
                        <th>মূল এসএমএস টেক্সট</th>
                        <th>প্রাপ্তির সময়</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentSmsPayments as $sms)
                        <tr>
                            <td><strong style="color:white;">{{ $sms->sender }}</strong></td>
                            <td><strong style="color:#34d399; font-family:'JetBrains Mono', monospace;">{{ $sms->amount }} ৳</strong></td>
                            <td><code style="color:#38bdf8;">{{ $sms->trx_id }}</code></td>
                            <td>
                                <span class="badge {{ $sms->status === 'matched' ? 'claimed' : 'unclaimed' }}">
                                    {{ strtoupper($sms->status) }}
                                </span>
                            </td>
                            <td style="max-width:340px; font-size:0.8rem; color:var(--text-muted); overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                {{ $sms->raw_sms }}
                            </td>
                            <td style="color:var(--text-muted); font-size:0.85rem;">{{ $sms->created_at->format('d M, h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; color:var(--text-muted); padding:2.5rem;">এখনও কোনো এসএমএস গ্রহণ করা হয়নি।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="margin-top:1.25rem;">
            {{ $recentSmsPayments->links() }}
        </div>
    </div>

@endsection

@section('scripts')
<script>
    function copyText(elementId) {
        const text = document.getElementById(elementId).innerText.trim();
        navigator.clipboard.writeText(text).then(() => {
            alert('ক্লিপবোর্ডে কপি করা হয়েছে: ' + text);
        });
    }
</script>
@endsection
