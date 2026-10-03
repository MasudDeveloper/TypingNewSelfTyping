<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>লগইন - SelfTyping.com | সরকারি ও বিসিসি এক্সাম পোর্টাল</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <style>
        :root {
            --bg-base: #090d16;
            --surface: #111827;
            --surface-card: rgba(17, 24, 39, 0.75);
            --primary: #2563eb;
            --primary-glow: rgba(37, 99, 235, 0.4);
            --primary-light: #60a5fa;
            --accent: #10b981;
            --accent-glow: rgba(16, 185, 129, 0.35);
            --warning: #f59e0b;
            --danger: #ef4444;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border: rgba(255, 255, 255, 0.08);
            --border-hover: rgba(59, 130, 246, 0.4);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Hind Siliguri', 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-base);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
            padding: 1.5rem;
        }

        /* Ambient Glowing Background Animation */
        .ambient-bg {
            position: fixed;
            inset: 0;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;
        }
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.45;
            animation: floatOrb 22s infinite alternate ease-in-out;
        }
        .orb-1 { width: 45vw; height: 45vw; background: radial-gradient(circle, #1d4ed8, transparent 70%); top: -15vw; left: -10vw; }
        .orb-2 { width: 40vw; height: 40vw; background: radial-gradient(circle, #059669, transparent 70%); bottom: -15vw; right: -5vw; animation-delay: -11s; }
        .orb-3 { width: 30vw; height: 30vw; background: radial-gradient(circle, #7c3aed, transparent 70%); top: 30%; right: 20%; opacity: 0.25; animation-duration: 28s; }

        @keyframes floatOrb {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(6vw, 8vh) scale(1.15); }
            100% { transform: translate(-4vw, 12vh) scale(0.95); }
        }

        .grid-pattern {
            position: fixed;
            inset: 0;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 36px 36px;
            z-index: 0;
            mask-image: radial-gradient(ellipse at center, black 50%, transparent 85%);
            -webkit-mask-image: radial-gradient(ellipse at center, black 50%, transparent 85%);
        }

        /* Main Split Auth Container */
        .auth-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 1050px;
            background: var(--surface-card);
            backdrop-filter: blur(28px);
            -webkit-backdrop-filter: blur(28px);
            border: 1px solid var(--border);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6), 0 0 40px rgba(37, 99, 235, 0.12);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1.15fr 1fr;
        }

        /* Left Side: Brand & Feature Showcase */
        .auth-showcase {
            background: linear-gradient(145deg, rgba(15, 23, 42, 0.9), rgba(30, 41, 59, 0.7));
            border-right: 1px solid var(--border);
            padding: 3.5rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }
        .showcase-header {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: white;
            margin-bottom: 2rem;
        }
        .brand-icon {
            width: 46px;
            height: 46px;
            background: linear-gradient(135deg, var(--primary), #1d4ed8);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            box-shadow: 0 0 20px var(--primary-glow);
        }
        .brand-text h2 {
            font-size: 1.45rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            line-height: 1.1;
        }
        .brand-text span {
            font-size: 0.75rem;
            color: var(--primary-light);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .showcase-content h3 {
            font-size: 1.75rem;
            font-weight: 800;
            color: white;
            line-height: 1.35;
            margin-bottom: 1rem;
        }
        .showcase-content h3 .highlight {
            background: linear-gradient(120deg, #60a5fa, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .showcase-content p {
            color: var(--text-muted);
            font-size: 0.98rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .feature-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 0.92rem;
            color: #cbd5e1;
        }
        .feature-item .icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: rgba(37, 99, 235, 0.2);
            color: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
            border: 1px solid rgba(37, 99, 235, 0.3);
        }

        /* Floating Trust Badge */
        .showcase-footer-badge {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.25);
            border-radius: 12px;
            padding: 1rem 1.2rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .badge-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--accent);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }
        .badge-text h5 { font-size: 0.9rem; font-weight: 700; color: white; }
        .badge-text p { font-size: 0.78rem; color: #a7f3d0; margin: 0; }

        /* Right Side: Login Form */
        .auth-form-wrapper {
            padding: 3.5rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-heading {
            margin-bottom: 2rem;
        }
        .form-heading h2 {
            font-size: 1.65rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.3rem;
        }
        .form-heading p {
            color: var(--text-muted);
            font-size: 0.92rem;
        }

        .form-group {
            margin-bottom: 1.35rem;
        }
        .form-group label {
            display: block;
            font-size: 0.88rem;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 0.5rem;
        }
        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }
        .input-wrapper i.lead-icon {
            position: absolute;
            left: 1.1rem;
            color: var(--text-muted);
            font-size: 1.2rem;
            transition: color 0.2s;
        }
        .input-wrapper input {
            width: 100%;
            padding: 0.9rem 1rem 0.9rem 3rem;
            background: rgba(3, 7, 18, 0.6);
            border: 1.5px solid var(--border);
            border-radius: 12px;
            color: white;
            font-size: 0.95rem;
            transition: all 0.25s ease;
            outline: none;
        }
        .input-wrapper input:focus {
            border-color: var(--primary);
            background: rgba(3, 7, 18, 0.85);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.2);
        }
        .input-wrapper input:focus ~ i.lead-icon {
            color: var(--primary-light);
        }

        .password-toggle {
            position: absolute;
            right: 1.1rem;
            background: transparent;
            border: none;
            color: var(--text-muted);
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.2s;
        }
        .password-toggle:hover { color: white; }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.8rem;
            font-size: 0.88rem;
        }
        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            cursor: pointer;
        }
        .remember-me input {
            accent-color: var(--primary);
            width: 16px;
            height: 16px;
            cursor: pointer;
        }
        .forgot-pass {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }
        .forgot-pass:hover { text-decoration: underline; color: #93c5fd; }

        .btn-auth-submit {
            width: 100%;
            padding: 0.95rem;
            background: linear-gradient(135deg, var(--primary), #1d4ed8);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.05rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 15px var(--primary-glow);
        }
        .btn-auth-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px var(--primary-glow);
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
        }

        .auth-switch {
            text-align: center;
            margin-top: 1.8rem;
            font-size: 0.92rem;
            color: var(--text-muted);
        }
        .auth-switch a {
            color: var(--primary-light);
            text-decoration: none;
            font-weight: 700;
            margin-left: 4px;
        }
        .auth-switch a:hover { text-decoration: underline; }

        .back-home-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.85rem;
            margin-top: 1.2rem;
            align-self: center;
            transition: color 0.2s;
        }
        .back-home-link:hover { color: white; }

        .error-alert {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.2rem;
            font-size: 0.88rem;
            color: #fca5a5;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .auth-container { grid-template-columns: 1fr; }
            .auth-showcase { display: none; }
            .auth-form-wrapper { padding: 2.5rem 1.8rem; }
        }
    </style>
</head>
<body>

    <div class="ambient-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="grid-pattern"></div>
    </div>

    <div class="auth-container">
        
        <!-- Left Side Feature Showcase -->
        <div class="auth-showcase">
            <div>
                <a href="{{ url('/') }}" class="showcase-header">
                    <div class="brand-icon">
                        <i class="ph-fill ph-keyboard"></i>
                    </div>
                    <div class="brand-text">
                        <h2>SelfTyping<span style="color:var(--primary-light);">.com</span></h2>
                        <span>Govt. & BCC Exam Portal</span>
                    </div>
                </a>

                <div class="showcase-content">
                    <h3>
                        সরকারি টাইপিং পরীক্ষায় <br>
                        <span class="highlight">১ম বারেই ১০০% সাফল্য</span>
                    </h3>
                    <p>
                        বাংলাদেশ কম্পিউটার কাউন্সিল (BCC), মন্ত্রণালয় ও সুপ্রিম কোর্টের হুবহু নিয়ম ও আসল প্রশ্নপত্রে টাইপিং অনুশীলন করুন।
                    </p>

                    <ul class="feature-list">
                        <li class="feature-item">
                            <div class="icon"><i class="ph-bold ph-shield-check"></i></div>
                            <span>সরকারি ৫% ভুলের নিয়ম ও অফিসিয়াল নেট স্পিড (Net WPM) ক্যালকুলেশন</span>
                        </li>
                        <li class="feature-item">
                            <div class="icon"><i class="ph-bold ph-newspaper"></i></div>
                            <span>শীট মোড (Sheet Mode) - হার্ডকপি প্রশ্নপত্র দেখে টাইপিং ও অটো-ডিফ বিশ্লেষণ</span>
                        </li>
                        <li class="feature-item">
                            <div class="icon"><i class="ph-bold ph-keyboard"></i></div>
                            <span>বিজয় বায়ান্ন (SutonnyMJ) ও অভ্র ইউনিকোড (Kalpurush) ফুল সাপোর্ট</span>
                        </li>
                        <li class="feature-item">
                            <div class="icon"><i class="ph-bold ph-certificate"></i></div>
                            <span>বিসিসি ফরম্যাটে তাৎক্ষণিক প্রিন্টযোগ্য মার্কশিট ও সার্টিফিকেট</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Trust Badge -->
            <div class="showcase-footer-badge">
                <div class="badge-icon">
                    <i class="ph-fill ph-seal-check"></i>
                </div>
                <div class="badge-text">
                    <h5>৯৮.৪% সফলতার হার</h5>
                    <p>বিসিসি ও সরকারি চাকরিপ্রার্থীদের শীর্ষ পছন্দের টাইপিং পোর্টাল</p>
                </div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="auth-form-wrapper">
            
            <div class="form-heading">
                <h2>স্বাগতম! লগইন করুন</h2>
                <p>আপনার অ্যাকাউন্টে প্রবেশ করে প্র্যাকটিস ও এক্সাম শুরু করুন</p>
            </div>

            @if ($errors->any())
                <div class="error-alert">
                    <i class="ph-fill ph-warning-circle"></i> ইমেইল অথবা পাসওয়ার্ড সঠিক নয়। পুনরায় চেষ্টা করুন।
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email / Username -->
                <div class="form-group">
                    <label for="email">ইমেইল ঠিকানা</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="yourname@gmail.com" autocomplete="username">
                        <i class="ph-bold ph-envelope lead-icon"></i>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">পাসওয়ার্ড</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" required placeholder="••••••••" autocomplete="current-password">
                        <i class="ph-bold ph-lock-key lead-icon"></i>
                        <button type="button" class="password-toggle" onclick="togglePassword('password', this)" title="পাসওয়ার্ড দেখুন">
                            <i class="ph ph-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Options -->
                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" id="remember">
                        <span>মনে রাখুন</span>
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-pass">পাসওয়ার্ড ভুলে গেছেন?</a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-auth-submit">
                    <span>লগইন করুন</span>
                    <i class="ph-bold ph-arrow-right"></i>
                </button>

                <!-- Switch to Register -->
                <div class="auth-switch">
                    কোনো অ্যাকাউন্ট নেই? 
                    <a href="{{ route('register') }}">ফ্রি রেজিস্ট্রেশন করুন</a>
                </div>

                <a href="{{ url('/') }}" class="back-home-link">
                    <i class="ph ph-arrow-left"></i> মূল ওয়েবসাইটে ফিরে যান
                </a>
            </form>

        </div>

    </div>

    <script>
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'ph ph-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'ph ph-eye';
            }
        }
    </script>
</body>
</html>
