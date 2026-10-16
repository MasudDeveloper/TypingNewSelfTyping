@extends('layouts.student')

@section('title', 'সাবস্ক্রিপশন ও ওয়ালেট রিচার্জ - SelfTyping.com')

@push('styles')
<style>
    .packages-container {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    /* Top Wallet & Recharge Section */
    .recharge-grid {
        display: grid;
        grid-template-columns: 1.15fr 0.85fr;
        gap: 1.8rem;
    }

    .panel-card {
        background: rgba(14, 21, 38, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        padding: 2.2rem;
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(14px);
    }
    .panel-card h3 {
        font-size: 1.3rem;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .panel-subtitle {
        font-size: 0.9rem;
        color: #94a3b8;
        margin-bottom: 1.5rem;
    }

    /* Method Selector Pills */
    .method-selector {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
        margin-bottom: 1.5rem;
    }
    .method-pill {
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 12px 8px;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s ease;
        background: rgba(255, 255, 255, 0.03);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
    }
    .method-pill:hover { border-color: var(--primary); background: rgba(37, 99, 235, 0.1); }
    .method-pill.active {
        border-color: var(--primary);
        background: rgba(37, 99, 235, 0.18);
        box-shadow: 0 0 15px rgba(37, 99, 235, 0.3);
    }
    .method-pill strong { font-size: 0.95rem; color: #ffffff; }
    .method-pill span { font-size: 0.72rem; color: #94a3b8; }

    .payment-instruction-box {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.06);
        border-radius: 12px;
        padding: 1.2rem;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
        color: #cbd5e1;
    }
    .number-display {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #090e1a;
        border: 1px solid rgba(59, 130, 246, 0.3);
        border-radius: 8px;
        padding: 8px 14px;
        margin: 8px 0;
        font-weight: 700;
        font-size: 1.15rem;
        color: #38bdf8;
        font-family: monospace;
    }
    .btn-copy {
        background: rgba(56, 189, 248, 0.15);
        color: #38bdf8;
        border: 1px solid rgba(56, 189, 248, 0.3);
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-copy:hover {
        background: #38bdf8;
        color: #090e1a;
    }

    .form-group { margin-bottom: 1.2rem; }
    .form-group label { display: block; font-size: 0.88rem; font-weight: 600; margin-bottom: 6px; color: #cbd5e1; }
    .form-control {
        width: 100%;
        padding: 0.85rem 1rem;
        background: #090e1a;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        color: #ffffff;
        font-size: 0.95rem;
        outline: none;
        transition: 0.2s;
    }
    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37,99,235,0.25);
    }

    .btn-recharge {
        width: 100%;
        padding: 0.9rem;
        background: linear-gradient(135deg, var(--primary), #1d4ed8);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 10px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
    }
    .btn-recharge:hover { transform: translateY(-2px); box-shadow: 0 8px 22px rgba(37,99,235,0.5); }

    /* Current Subscription & Balance Card */
    .wallet-status-card {
        background: linear-gradient(135deg, rgba(30, 58, 138, 0.6), rgba(15, 23, 42, 0.9));
        border: 1px solid rgba(59, 130, 246, 0.3);
        color: white;
        border-radius: 20px;
        padding: 2.2rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        backdrop-filter: blur(14px);
        box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
    }
    .wallet-header { display: flex; justify-content: space-between; align-items: flex-start; }
    .wallet-header .label { font-size: 0.85rem; color: #93c5fd; font-weight: 600; text-transform: uppercase; }
    .wallet-balance-val { font-size: 3rem; font-weight: 800; font-family: monospace; line-height: 1; margin: 10px 0; color: #38bdf8; }
    
    .subscription-expiry-box {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 12px;
        padding: 1rem;
        margin-top: 1rem;
    }

    /* Packages Cards Grid */
    .packages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
    }
    .package-card {
        background: rgba(14, 21, 38, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        padding: 2rem;
        display: flex;
        flex-direction: column;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        backdrop-filter: blur(14px);
    }
    .package-card:hover {
        border-color: rgba(59, 130, 246, 0.5);
        box-shadow: 0 16px 35px -10px rgba(0, 0, 0, 0.8), 0 0 25px rgba(37, 99, 235, 0.2);
        transform: translateY(-4px);
    }
    .package-card.featured {
        border-color: rgba(59, 130, 246, 0.6);
        background: linear-gradient(180deg, rgba(30, 58, 138, 0.25) 0%, rgba(14, 21, 38, 0.9) 100%);
    }
    .package-card.featured {
        border-color: var(--primary);
        box-shadow: 0 10px 25px -5px rgba(37,99,235,0.15);
    }
    .popular-tag {
        position: absolute;
        top: -10px;
        right: 20px;
        background: var(--primary);
        color: white;
        padding: 2px 10px;
        border-radius: 12px;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
    }
    .package-card h4 { font-size: 1.3rem; font-weight: 700; color: var(--text-dark); margin-bottom: 4px; }
    .package-price {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--primary);
        margin: 1rem 0;
        display: flex;
        align-items: baseline;
        gap: 4px;
        font-family: monospace;
    }
    .package-price span { font-size: 0.95rem; color: var(--text-muted); font-family: inherit; font-weight: 500; }
    
    .package-features { list-style: none; margin-bottom: 1.8rem; flex: 1; }
    .package-features li { display: flex; align-items: center; gap: 8px; font-size: 0.92rem; color: var(--text-muted); margin-bottom: 10px; }
    .package-features li i { color: var(--success); font-size: 1.1rem; }

    .btn-buy {
        width: 100%;
        padding: 0.85rem;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        border: none;
        font-size: 0.95rem;
        transition: 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
    .btn-buy.active-btn { background: var(--primary); color: white; }
    .btn-buy.active-btn:hover { background: var(--primary-hover); }

    /* Transactions Table */
    .table-container {
        overflow-x: auto;
    }
    .trx-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 0.9rem;
    }
    .trx-table th {
        background: #f8fafc;
        padding: 12px 16px;
        border-bottom: 1px solid var(--border);
        color: var(--text-muted);
        font-weight: 600;
    }
    .trx-table td {
        padding: 14px 16px;
        border-bottom: 1px solid var(--border);
        color: var(--text-dark);
    }
    .badge-status {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
    }
    .badge-status.completed { background: #d1fae5; color: #065f46; }
    .badge-status.pending { background: #fef3c7; color: #92400e; }
    .badge-status.failed { background: #fee2e2; color: #991b1b; }
</style>
@endpush

@section('content')

    <div class="packages-container">
        
        @if(session('success'))
            <div style="padding: 1.2rem; background: #ecfdf5; color: #065f46; border: 1.5px solid #a7f3d0; border-radius: 12px; font-weight: 600; display:flex; align-items:center; gap:8px;">
                <i class="ph-fill ph-check-circle" style="font-size:1.4rem;"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="padding: 1.2rem; background: #fef2f2; color: #991b1b; border: 1.5px solid #fecaca; border-radius: 12px; font-weight: 600; display:flex; align-items:center; gap:8px;">
                <i class="ph-fill ph-warning-circle" style="font-size:1.4rem;"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Recharge & Wallet Section -->
        <div class="recharge-grid">
            
            <!-- Recharge Form Panel -->
            <div class="panel-card">
                <h3><i class="ph-fill ph-wallet" style="color:var(--primary);"></i> ওয়ালেট রিচার্জ (Instant Gateway)</h3>
                <p class="panel-subtitle">বিকাশ, নগদ বা রকেটে টাকা পাঠিয়ে TrxID দিলে স্বয়ংক্রিয়ভাবে ব্যালেন্স যোগ হবে।</p>

                <!-- Method Selector -->
                <div class="method-selector">
                    <div class="method-pill active" onclick="selectMethod('bkash', '01700-000000', this)">
                        <strong>bKash</strong>
                        <span>Personal</span>
                    </div>
                    <div class="method-pill" onclick="selectMethod('nagad', '01700-000000', this)">
                        <strong>Nagad</strong>
                        <span>Personal</span>
                    </div>
                    <div class="method-pill" onclick="selectMethod('rocket', '01700-000000-8', this)">
                        <strong>Rocket</strong>
                        <span>Personal</span>
                    </div>
                    <div class="method-pill" onclick="selectMethod('upay', '01700-000000', this)">
                        <strong>Upay</strong>
                        <span>Personal</span>
                    </div>
                </div>

                <!-- Payment Instruction Box -->
                <div class="payment-instruction-box">
                    <div>১. আপনার <strong id="selected-method-name">bKash</strong> অ্যাপ বা ডায়াল থেকে <strong>Send Money</strong> করুন:</div>
                    <div class="number-display">
                        <span id="merchant-phone">01700-000000</span>
                        <button type="button" class="btn-copy" onclick="copyNumber()">কপি করুন</button>
                    </div>
                    <div style="font-size:0.8rem; color:var(--text-muted);">২. টাকা পাঠানোর পর পাওয়া ফিরতি এসএমএস এর <strong>TrxID</strong> নিচে দিয়ে রিচার্জ বাটনে ক্লিক করুন।</div>
                </div>

                <!-- Recharge Submission Form -->
                <form action="{{ route('wallet.recharge') }}" method="POST">
                    @csrf
                    <input type="hidden" name="method" id="input-method" value="bKash">

                    <div class="form-group">
                        <label>টাকার পরিমাণ (BDT)</label>
                        <input type="number" name="amount" class="form-control" placeholder="যেমন: 200, 500" required min="10">
                    </div>

                    <div class="form-group">
                        <label>ট্রানজেকশন আইডি (TrxID)</label>
                        <input type="text" name="transaction_id" class="form-control" placeholder="যেমন: 9K28X9LA" required style="font-family:monospace; text-transform:uppercase;">
                    </div>

                    <button type="submit" class="btn-recharge">
                        <i class="ph-bold ph-lightning"></i> ইনস্ট্যান্ট রিচার্জ ভেরিফাই করুন
                    </button>
                </form>
            </div>

            <!-- Current Wallet Status Card -->
            <div class="wallet-status-card">
                <div>
                    <div class="wallet-header">
                        <div>
                            <div class="label">বর্তমান ওয়ালেট ব্যালেন্স</div>
                            <div class="wallet-balance-val">{{ auth()->user()->wallet_balance ?? 0 }} ৳</div>
                        </div>
                        <i class="ph-fill ph-coins" style="font-size:3rem; color:#93c5fd;"></i>
                    </div>

                    <p style="color:#dbeafe; font-size:0.92rem; line-height:1.5;">
                        যেকোনো সাবস্ক্রিপশন প্যাকেজ কেনার জন্য এই ওয়ালেট ব্যালেন্স ব্যবহার করা যাবে।
                    </p>
                </div>

                <div class="subscription-expiry-box">
                    <div style="font-size:0.8rem; color:#bfdbfe; text-transform:uppercase; font-weight:700;">সাবস্ক্রিপশন স্ট্যাটাস</div>
                    @if(auth()->user()->subscription_expires_at && auth()->user()->subscription_expires_at > now())
                        <div style="font-size:1.15rem; font-weight:800; color:#34d399; margin:4px 0;">
                            সক্রিয় (Active)
                        </div>
                        <div style="font-size:0.85rem; color:#e0e7ff;">
                            মেয়াদ শেষ: {{ auth()->user()->subscription_expires_at->format('d M Y') }} ({{ auth()->user()->subscription_expires_at->diffInDays(now()) }} দিন বাকি)
                        </div>
                    @else
                        <div style="font-size:1.15rem; font-weight:800; color:#f87171; margin:4px 0;">
                            নিষ্ক্রিয় (No Active Package)
                        </div>
                        <div style="font-size:0.85rem; color:#e0e7ff;">
                            ল্যাবগুলো আনলক করতে নিচের যেকোনো প্যাকেজ বাছাই করুন।
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- Packages Selection Grid -->
        <h3 style="font-size:1.3rem; font-weight:700; color:var(--text-dark); margin-top:1rem;">
            <i class="ph-fill ph-crown" style="color:#f59e0b;"></i> সাবস্ক্রিপশন প্যাকেজসমূহ
        </h3>

        <div class="packages-grid">
            @foreach($packages as $package)
                <div class="package-card {{ $loop->iteration == 2 ? 'featured' : '' }}">
                    @if($loop->iteration == 2)
                        <span class="popular-tag">সেরা অফার</span>
                    @endif

                    <h4>{{ $package->name }}</h4>
                    <p style="color:var(--text-muted); font-size:0.88rem;">বিসিসি ও সরকারি নিয়োগ পরীক্ষার জন্য</p>
                    
                    <div class="package-price">
                        ৳{{ $package->price }}
                        <span>/ {{ $package->duration_days }} দিন</span>
                    </div>

                    <ul class="package-features">
                        <li><i class="ph-bold ph-check"></i> ৫০+ সরকারি ও বিসিসি ল্যাব আনলক</li>
                        <li><i class="ph-bold ph-check"></i> বাংলা (বিজয় ও ইউনিকোড) ও ইংরেজি</li>
                        <li><i class="ph-bold ph-check"></i> শীট মোড ও স্ক্রিন মোড প্র্যাকটিস</li>
                        <li><i class="ph-bold ph-check"></i> সরকারি ফরম্যাটে মার্কশিট প্রিন্ট</li>
                        <li><i class="ph-bold ph-check"></i> আনলিমিটেড পরীক্ষা ও রেজাল্ট হিস্ট্রি</li>
                    </ul>

                    <form action="{{ route('packages.purchase', $package->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-buy active-btn" onclick="return confirm('আপনি কি নিশ্চিত যে {{ $package->name }} প্যাকেজটি কিনতে চান?')">
                            <i class="ph-bold ph-shopping-cart-simple"></i> প্যাকেজটি সক্রিয় করুন
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Recent Transactions History -->
        @if(isset($userTransactions) && $userTransactions->count() > 0)
            <div class="panel-card" style="margin-top:1.5rem;">
                <h3><i class="ph-fill ph-receipt"></i> সাম্প্রতিক ট্রানজেকশন হিস্ট্রি</h3>
                
                <div class="table-container" style="margin-top:1rem;">
                    <table class="trx-table">
                        <thead>
                            <tr>
                                <th>তারিখ</th>
                                <th>বিবরণ</th>
                                <th>পরিমাণ</th>
                                <th>ধরন</th>
                                <th>স্ট্যাটাস</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userTransactions as $trx)
                                <tr>
                                    <td>{{ $trx->created_at->format('d M Y, h:i A') }}</td>
                                    <td>{{ $trx->description }}</td>
                                    <td style="font-weight:700; font-family:monospace;">{{ $trx->amount }} ৳</td>
                                    <td>{{ strtoupper($trx->type) }}</td>
                                    <td>
                                        <span class="badge-status {{ $trx->status }}">
                                            {{ $trx->status === 'completed' ? 'সফল' : ($trx->status === 'pending' ? 'যাচাই চলছে' : 'বাতিল') }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>

    <script>
        const merchantNumbers = {
            bkash: '01700-000000',
            nagad: '01700-000000',
            rocket: '01700-000000-8',
            upay: '01700-000000'
        };

        function selectMethod(method, num, el) {
            document.querySelectorAll('.method-pill').forEach(p => p.classList.remove('active'));
            el.classList.add('active');

            document.getElementById('input-method').value = method;
            document.getElementById('selected-method-name').innerText = method.toUpperCase();
            document.getElementById('merchant-phone').innerText = merchantNumbers[method] || num;
        }

        function copyNumber() {
            const num = document.getElementById('merchant-phone').innerText.trim();
            navigator.clipboard.writeText(num).then(() => {
                alert('নম্বর কপি করা হয়েছে: ' + num);
            });
        }
    </script>

@endsection
