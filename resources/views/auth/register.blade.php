<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ফ্রি রেজিস্ট্রেশন - SelfTyping.com | সরকারি ও বিসিসি এক্সাম পোর্টাল</title>
    
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
            padding: 2rem 1.5rem;
        }

        /* Ambient Glowing Background */
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
            max-width: 1080px;
            background: var(--surface-card);
            backdrop-filter: blur(28px);
            -webkit-backdrop-filter: blur(28px);
            border: 1px solid var(--border);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6), 0 0 40px rgba(16, 185, 129, 0.12);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1.15fr 1.05fr;
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
            background: linear-gradient(135deg, var(--accent), #059669);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            box-shadow: 0 0 20px var(--accent-glow);
        }
        .brand-text h2 {
            font-size: 1.45rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            line-height: 1.1;
        }
        .brand-text span {
            font-size: 0.75rem;
            color: var(--accent);
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
            background: linear-gradient(120deg, #34d399, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .showcase-content p {
            color: var(--text-muted);
            font-size: 0.98rem;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .benefit-cards {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .benefit-box {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1rem;
        }
        .benefit-box i {
            font-size: 1.4rem;
            color: var(--accent);
            margin-bottom: 0.4rem;
            display: block;
        }
        .benefit-box h5 {
            font-size: 0.95rem;
            font-weight: 700;
            color: white;
            margin-bottom: 2px;
        }
        .benefit-box p {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin: 0;
            line-height: 1.4;
        }

        /* Testimonial / Quote Banner */
        .showcase-quote {
            background: rgba(37, 99, 235, 0.1);
            border: 1px solid rgba(37, 99, 235, 0.25);
            border-radius: 12px;
            padding: 1.1rem 1.3rem;
            font-size: 0.88rem;
            color: #cbd5e1;
            font-style: italic;
            line-height: 1.5;
        }
        .quote-author {
            margin-top: 6px;
            font-style: normal;
            font-weight: 700;
            color: #93c5fd;
            font-size: 0.82rem;
        }

        /* Right Side: Register Form */
        .auth-form-wrapper {
            padding: 3.5rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-heading {
            margin-bottom: 1.8rem;
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
            margin-bottom: 1.2rem;
        }
        .form-group label {
            display: block;
            font-size: 0.88rem;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 0.45rem;
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
            padding: 0.85rem 1rem 0.85rem 3rem;
            background: rgba(3, 7, 18, 0.6);
            border: 1.5px solid var(--border);
            border-radius: 12px;
            color: white;
            font-size: 0.95rem;
            transition: all 0.25s ease;
            outline: none;
        }
        .input-wrapper input:focus {
            border-color: var(--accent);
            background: rgba(3, 7, 18, 0.85);
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2);
        }
        .input-wrapper input:focus ~ i.lead-icon {
            color: var(--accent);
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

        .btn-auth-submit {
            width: 100%;
            padding: 0.95rem;
            background: linear-gradient(135deg, var(--accent), #059669);
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
            box-shadow: 0 4px 15px var(--accent-glow);
            margin-top: 0.5rem;
        }
        .btn-auth-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px var(--accent-glow);
            background: linear-gradient(135deg, #059669, #047857);
        }

        .auth-switch {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.92rem;
            color: var(--text-muted);
        }
        .auth-switch a {
            color: var(--accent);
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
        .error-alert ul { margin-left: 1.2rem; }

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
                        <h2>SelfTyping<span style="color:var(--accent);">.com</span></h2>
                        <span>Govt. & BCC Exam Portal</span>
                    </div>
                </a>

                <div class="showcase-content">
                    <h3>
                        আপনার টাইপিং ক্যারিয়ারের <br>
                        <span class="highlight">সেরা প্রস্তুতি শুরু করুন</span>
                    </h3>
                    <p>
                        ফ্রি অ্যাকাউন্ট খুলে আজই বিসিসি ল্যাব, হাইকোর্ট ও বিভিন্ন মন্ত্রণালয়ের পরীক্ষার প্রশ্নপত্রে টাইপিং অনুশীলন করুন।
                    </p>

                    <div class="benefit-cards">
                        <div class="benefit-box">
                            <i class="ph-fill ph-buildings"></i>
                            <h5>৫০+ এক্সাম ল্যাব</h5>
                            <p>বিসিসি ও মন্ত্রণালয়ের বিগত আসল প্রশ্নপত্র</p>
                        </div>
                        <div class="benefit-box">
                            <i class="ph-fill ph-speedometer"></i>
                            <h5>লাইভ WPM ট্র্যাকার</h5>
                            <p>নেট স্পিড ও অ্যাকুরেসি গ্রাফ বিশ্লেষণ</p>
                        </div>
                        <div class="benefit-box">
                            <i class="ph-fill ph-keyboard"></i>
                            <h5>বিজয় ও ইউনিকোড</h5>
                            <p>বাংলা ও ইংরেজি উভয় ভাষায় দক্ষতা</p>
                        </div>
                        <div class="benefit-box">
                            <i class="ph-fill ph-certificate"></i>
                            <h5>অফিসিয়াল মার্কশিট</h5>
                            <p>প্রিন্ট ও PDF ডাউনলোড সুবিধা</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial Quote -->
            <div class="showcase-quote">
                "SelfTyping.com এর শীট মোড ও ৫% ভুলের বিসিসি নিয়মে প্র্যাকটিস করেই আমি বাংলাদেশ কম্পিউটার কাউন্সিলের ডাটা এন্ট্রি অপারেটর পরীক্ষায় উত্তীর্ণ হয়েছি।"
                <div class="quote-author">— আব্দুল্লাহ আল নোমান (নির্বাচিত প্রার্থী)</div>
            </div>
        </div>

        <!-- Right Side: Register Form -->
        <div class="auth-form-wrapper">
            
            <div class="form-heading">
                <h2>নতুন অ্যাকাউন্ট তৈরি করুন</h2>
                <p>কয়েক সেকেন্ডে ফ্রি রেজিস্ট্রেশন সম্পন্ন করুন</p>
            </div>

            @if ($errors->any())
                <div class="error-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Full Name -->
                <div class="form-group">
                    <label for="name">পূর্ণ নাম</label>
                    <div class="input-wrapper">
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus placeholder="আব্দুর রহমান / Abidur Rahman" autocomplete="name">
                        <i class="ph-bold ph-user lead-icon"></i>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">ইমেইল ঠিকানা</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="name@gmail.com" autocomplete="username">
                        <i class="ph-bold ph-envelope lead-icon"></i>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">পাসওয়ার্ড (কমপক্ষে ৮ অক্ষর)</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" required placeholder="••••••••" autocomplete="new-password">
                        <i class="ph-bold ph-lock-key lead-icon"></i>
                        <button type="button" class="password-toggle" onclick="togglePassword('password', this)" title="পাসওয়ার্ড দেখুন">
                            <i class="ph ph-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation">পাসওয়ার্ড নিশ্চিত করুন</label>
                    <div class="input-wrapper">
                        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••" autocomplete="new-password">
                        <i class="ph-bold ph-check-circle lead-icon"></i>
                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)" title="পাসওয়ার্ড দেখুন">
                            <i class="ph ph-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-auth-submit">
                    <i class="ph-bold ph-user-plus"></i>
                    <span>রেজিস্ট্রেশন সম্পন্ন করুন</span>
                </button>

                <!-- Switch to Login -->
                <div class="auth-switch">
                    ইতিমধ্যে একটি অ্যাকাউন্ট আছে? 
                    <a href="{{ route('login') }}">লগইন করুন</a>
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
