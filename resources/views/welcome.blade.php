<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SelfTyping.com - বাংলাদেশ কম্পিউটার কাউন্সিল (BCC) ও সরকারি চাকরির টাইপিং এক্সাম পোর্টাল</title>
    
    <!-- Meta SEO -->
    <meta name="description" content="SelfTyping.com - বাংলাদেশ কম্পিউটার কাউন্সিল (BCC), মন্ত্রণালয়, সুপ্রিম কোর্ট ও সরকারি নিয়োগ পরীক্ষার জন্য দেশের সেরা অনলাইন টাইপিং এক্সাম ও প্র্যাকটিস প্ল্যাটফর্ম। বিজয় বায়ান্ন ও ইউনিকোড সাপোর্ট, ৫% ভুলের বিসিসি নিয়ম ও অফিশিয়াল মার্কশিট।">
    <meta name="keywords" content="SelfTyping, BCC typing test, Bangladesh Computer Council typing exam, Bijoy typing test, Bangla typing practice, Govt typing exam preparation">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <!-- Bengali Local Fonts -->
    <link rel="stylesheet" href="/css/bangla-fonts.css">

    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #60a5fa;
            --accent: #10b981;
            --accent-hover: #059669;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #0f172a;
            --dark-surface: #1e293b;
            --dark-card: #0b1329;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --bg-light: #f8fafc;
            --white: #ffffff;
            --border: #e2e8f0;
            --border-dark: #334155;
            --radius-lg: 16px;
            --radius-md: 12px;
            --radius-sm: 8px;
            --font-bn: 'Hind Siliguri', 'Kalpurush', sans-serif;
            --font-en: 'Inter', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: var(--font-bn);
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-main);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .en-font { font-family: var(--font-en) !important; }

        /* Smooth Scroll */
        html { scroll-behavior: smooth; }

        /* Container */
        .container {
            max-width: 1240px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* Top Announcement Bar */
        .top-bar {
            background: linear-gradient(90deg, #1e3a8a, #2563eb);
            color: #ffffff;
            padding: 0.5rem 1rem;
            text-align: center;
            font-size: 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .top-bar .badge {
            background: #f59e0b;
            color: #000;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 0.75rem;
        }

        /* Navbar */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            transition: all 0.3s ease;
        }
        .nav-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 76px;
        }
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--dark);
        }
        .brand-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--primary), #1e40af);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        }
        .brand-text h1 {
            font-size: 1.45rem;
            font-weight: 800;
            line-height: 1.1;
            color: #0f172a;
            letter-spacing: -0.5px;
        }
        .brand-text span {
            font-size: 0.75rem;
            color: var(--primary);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 2rem;
            list-style: none;
        }
        .nav-links a {
            text-decoration: none;
            color: var(--text-main);
            font-weight: 600;
            font-size: 1rem;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0.65rem 1.4rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.25s ease;
            cursor: pointer;
            border: none;
        }
        .btn-outline {
            background: transparent;
            color: var(--dark);
            border: 1.5px solid var(--border);
        }
        .btn-outline:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: #eff6ff;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.4);
        }
        .btn-accent {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }
        .btn-accent:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(16, 185, 129, 0.4);
        }

        /* Hero Section */
        .hero {
            position: relative;
            padding: 4.5rem 0 5rem 0;
            background: radial-gradient(circle at 50% 10%, rgba(37, 99, 235, 0.08) 0%, rgba(248, 250, 252, 0) 70%);
            overflow: hidden;
        }
        .hero-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 3.5rem;
            align-items: center;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #eff6ff;
            color: var(--primary-dark);
            border: 1px solid #bfdbfe;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 0.88rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        .hero-badge i { font-size: 1.1rem; color: var(--primary); }

        .hero-title {
            font-size: 2.85rem;
            line-height: 1.25;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 1.25rem;
            letter-spacing: -0.5px;
        }
        .hero-title .highlight {
            background: linear-gradient(120deg, #1e40af, #2563eb, #0284c7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 1.15rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .hero-cta-group {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
        }
        .hero-cta-group .btn {
            padding: 0.85rem 1.8rem;
            font-size: 1.05rem;
            border-radius: 10px;
        }

        .hero-highlights {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            border-top: 1px solid var(--border);
            padding-top: 1.5rem;
        }
        .hero-highlight-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .hero-highlight-item .icon {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            background: #e0e7ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }
        .hero-highlight-item .text h4 {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--dark);
        }
        .hero-highlight-item .text p {
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        /* Live Interactive Typing Demo Box */
        .live-demo-card {
            background: var(--white);
            border: 1px solid #cbd5e1;
            border-radius: 20px;
            padding: 1.8rem;
            box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.12);
            position: relative;
        }
        .demo-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.2rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid var(--border);
        }
        .demo-tag {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 700;
            color: var(--primary);
            font-size: 0.88rem;
        }
        .demo-lang-selector {
            display: flex;
            gap: 6px;
        }
        .demo-lang-btn {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            border: 1px solid var(--border);
            background: #f1f5f9;
            cursor: pointer;
            transition: all 0.2s;
        }
        .demo-lang-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .demo-stats-strip {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 1.2rem;
        }
        .demo-stat-pill {
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 8px 12px;
            text-align: center;
        }
        .demo-stat-pill .val {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--dark);
            font-family: var(--font-en);
            line-height: 1;
        }
        .demo-stat-pill .lbl {
            font-size: 0.72rem;
            color: var(--text-muted);
            text-transform: uppercase;
            font-weight: 600;
            margin-top: 2px;
        }

        .demo-passage-box {
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 1rem 1.2rem;
            font-size: 1.15rem;
            line-height: 1.7;
            margin-bottom: 1rem;
            min-height: 80px;
            user-select: none;
            color: #334155;
        }
        .demo-passage-box .word {
            display: inline-block;
            padding: 1px 4px;
            border-radius: 4px;
        }
        .demo-passage-box .word.current {
            background: #dbeafe;
            color: #1e40af;
            font-weight: 600;
            box-shadow: 0 0 0 2px var(--primary);
        }
        .demo-passage-box .word.correct {
            color: #059669;
            background: #d1fae5;
        }
        .demo-passage-box .word.wrong {
            color: #dc2626;
            background: #fee2e2;
            text-decoration: underline;
        }

        .demo-input {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 1.1rem;
            outline: none;
            transition: all 0.2s;
        }
        .demo-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }
        .demo-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        /* Section Header */
        .section-header {
            text-align: center;
            max-width: 720px;
            margin: 0 auto 3.5rem auto;
        }
        .section-tag {
            display: inline-block;
            background: #eff6ff;
            color: var(--primary);
            font-weight: 700;
            font-size: 0.85rem;
            padding: 4px 14px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.8rem;
            border: 1px solid #bfdbfe;
        }
        .section-title {
            font-size: 2.25rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.3;
            margin-bottom: 0.8rem;
        }
        .section-subtitle {
            font-size: 1.05rem;
            color: var(--text-muted);
        }

        /* Stats Section */
        .stats-section {
            background: var(--white);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            padding: 3rem 0;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            text-align: center;
        }
        .stat-item h3 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary);
            font-family: var(--font-en);
            margin-bottom: 0.25rem;
        }
        .stat-item p {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-main);
        }

        /* Features / Labs Section */
        .labs-section {
            padding: 5rem 0;
        }
        .labs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.8rem;
        }
        .lab-feature-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .lab-feature-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary);
            box-shadow: 0 15px 30px -10px rgba(37, 99, 235, 0.12);
        }
        .lab-icon-wrap {
            width: 54px;
            height: 54px;
            border-radius: 12px;
            background: #eff6ff;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 1.3rem;
        }
        .lab-feature-card.accent .lab-icon-wrap {
            background: #ecfdf5;
            color: var(--accent);
        }
        .lab-feature-card.warning .lab-icon-wrap {
            background: #fffbeb;
            color: var(--warning);
        }
        .lab-feature-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.6rem;
        }
        .lab-feature-card p {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 1.2rem;
            flex: 1;
        }
        .lab-feature-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary);
            background: #f1f5f9;
            padding: 4px 10px;
            border-radius: 6px;
            width: fit-content;
        }

        /* BCC Exam Rules Section */
        .bcc-rules-section {
            padding: 5rem 0;
            background: #0f172a;
            color: #ffffff;
            position: relative;
        }
        .bcc-rules-section .section-tag {
            background: rgba(37, 99, 235, 0.2);
            color: #93c5fd;
            border-color: rgba(37, 99, 235, 0.4);
        }
        .bcc-rules-section .section-title {
            color: #ffffff;
        }
        .bcc-rules-section .section-subtitle {
            color: #94a3b8;
        }
        .rules-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 3rem;
        }
        .rule-card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 16px;
            padding: 2.2rem;
            display: flex;
            flex-direction: column;
        }
        .rule-num {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-light);
            font-family: var(--font-en);
            line-height: 1;
            margin-bottom: 1rem;
        }
        .rule-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.75rem;
        }
        .rule-card p {
            color: #94a3b8;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Pricing Section */
        .pricing-section {
            padding: 5rem 0;
            background: var(--bg-light);
        }
        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        .pricing-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            display: flex;
            flex-direction: column;
            position: relative;
            transition: all 0.3s ease;
        }
        .pricing-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -15px rgba(0,0,0,0.1);
        }
        .pricing-card.featured {
            border: 2px solid var(--primary);
            box-shadow: 0 15px 35px -10px rgba(37, 99, 235, 0.2);
        }
        .featured-ribbon {
            position: absolute;
            top: -12px;
            right: 24px;
            background: var(--primary);
            color: white;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        .plan-name {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }
        .plan-price {
            display: flex;
            align-items: baseline;
            gap: 4px;
            margin: 1.2rem 0 1.5rem 0;
        }
        .plan-price .currency {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--primary);
        }
        .plan-price .amount {
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--dark);
            font-family: var(--font-en);
            line-height: 1;
        }
        .plan-price .period {
            font-size: 0.95rem;
            color: var(--text-muted);
        }
        .plan-features {
            list-style: none;
            margin-bottom: 2rem;
            flex: 1;
        }
        .plan-features li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95rem;
            color: var(--text-main);
            margin-bottom: 0.85rem;
        }
        .plan-features li i {
            color: var(--accent);
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        /* FAQ Section */
        .faq-section {
            padding: 5rem 0;
            background: var(--white);
        }
        .faq-wrapper {
            max-width: 800px;
            margin: 0 auto;
        }
        .faq-item {
            border: 1px solid var(--border);
            border-radius: 12px;
            margin-bottom: 1rem;
            overflow: hidden;
            background: #f8fafc;
            transition: all 0.2s;
        }
        .faq-header {
            padding: 1.2rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--dark);
        }
        .faq-header i {
            font-size: 1.25rem;
            transition: transform 0.3s;
            color: var(--primary);
        }
        .faq-body {
            padding: 0 1.5rem 1.2rem 1.5rem;
            color: var(--text-muted);
            font-size: 0.98rem;
            line-height: 1.7;
            display: none;
        }
        .faq-item.active {
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 4px 12px rgba(37,99,235,0.05);
        }
        .faq-item.active .faq-header i {
            transform: rotate(180deg);
        }
        .faq-item.active .faq-body {
            display: block;
        }

        /* CTA Banner */
        .cta-banner {
            padding: 4.5rem 0;
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: white;
            text-align: center;
            position: relative;
        }
        .cta-banner h2 {
            font-size: 2.3rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }
        .cta-banner p {
            font-size: 1.15rem;
            color: #bfdbfe;
            max-width: 600px;
            margin: 0 auto 2rem auto;
        }

        /* Footer */
        .footer {
            background: #0b1329;
            color: #94a3b8;
            padding: 4.5rem 0 2rem 0;
            border-top: 1px solid #1e293b;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
            gap: 3rem;
            margin-bottom: 3.5rem;
        }
        .footer-brand h2 {
            color: white;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .footer-brand p {
            font-size: 0.92rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            color: #94a3b8;
        }
        .footer-socials {
            display: flex;
            gap: 12px;
        }
        .footer-social-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: #1e293b;
            color: #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .footer-social-btn:hover {
            background: var(--primary);
            color: white;
        }
        .footer-col h4 {
            color: white;
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
        }
        .footer-links {
            list-style: none;
        }
        .footer-links li {
            margin-bottom: 0.75rem;
        }
        .footer-links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.92rem;
            transition: color 0.2s;
        }
        .footer-links a:hover {
            color: #60a5fa;
        }
        .footer-payment-icons {
            display: flex;
            gap: 8px;
            margin-top: 1rem;
            flex-wrap: wrap;
        }
        .payment-pill {
            background: #1e293b;
            color: #e2e8f0;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 600;
        }

        .footer-bottom {
            border-top: 1px solid #1e293b;
            padding-top: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.88rem;
            color: #64748b;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero-grid { grid-template-columns: 1fr; }
            .rules-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            .hero-title { font-size: 2.3rem; }
        }
        @media (max-width: 768px) {
            .nav-links { display: none; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .hero-highlights { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; gap: 1rem; text-align: center; }
        }
    </style>
</head>
<body>

    <!-- Top Announcement Bar -->
    <div class="top-bar">
        <span class="badge">নতুন আপডেট</span>
        <span>SelfTyping.com এ বাংলাদেশ কম্পিউটার কাউন্সিল (BCC) ও সরকারি নিয়োগ পরীক্ষার ২০২৬ স্ট্যান্ডার্ড প্যাসেজ যুক্ত করা হয়েছে!</span>
    </div>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="container nav-wrapper">
            <a href="{{ url('/') }}" class="brand-logo">
                <div class="brand-icon">
                    <i class="ph-fill ph-keyboard"></i>
                </div>
                <div class="brand-text">
                    <h1>SelfTyping<span style="display:inline; color:var(--primary);">.com</span></h1>
                    <span>Govt. & BCC Exam Portal</span>
                </div>
            </a>

            <ul class="nav-links">
                <li><a href="#features"><i class="ph ph-sparkle"></i> ফিচারসমূহ</a></li>
                <li><a href="#labs"><i class="ph ph-buildings"></i> এক্সাম ল্যাব</a></li>
                <li><a href="#bcc-rules"><i class="ph ph-scales"></i> বিসিসি নিয়ম</a></li>
                <li><a href="#pricing"><i class="ph ph-crown"></i> সাবস্ক্রিপশন</a></li>
                <li><a href="#faq"><i class="ph ph-question"></i> সচরাচর প্রশ্ন</a></li>
            </ul>

            <div class="nav-actions">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">
                            <i class="ph ph-squares-four"></i> ড্যাশবোর্ড
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline">
                            <i class="ph ph-sign-in"></i> লগইন
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                <i class="ph ph-user-plus"></i> ফ্রি রেজিস্ট্রেশন
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-grid">
            <div class="hero-content">
                <div class="hero-badge">
                    <i class="ph-fill ph-shield-check"></i> শতভাগ বিসিসি ও সরকারি পরীক্ষার স্ট্যান্ডার্ড
                </div>
                
                <h1 class="hero-title">
                    সরকারি ও বিসিসি টাইপিং পরীক্ষায় <br>
                    <span class="highlight">১ম বারেই সফল হওয়ার</span> সম্পূর্ণ প্রস্তুতি
                </h1>
                
                <p class="hero-desc">
                    SelfTyping.com এ বিজয় বায়ান্ন (SutonnyMJ) ও ইউনিকোড বাংলা সহ ইংরেজি টাইপিংয়ে ১০০% গতি ও নির্ভুলতা অর্জন করুন। অফিশিয়াল ৫% ভুলের বিসিসি নিয়মে হার্ডকপি শীট ও স্ক্রিন মোডে আনলিমিটেড প্র্যাকটিস করুন।
                </p>

                <div class="hero-cta-group">
                    <a href="{{ route('register') }}" class="btn btn-accent">
                        <i class="ph-bold ph-play"></i> ফ্রি ট্রায়াল শুরু করুন
                    </a>
                    <a href="#pricing" class="btn btn-outline">
                        <i class="ph ph-crown"></i> প্যাকেজসমূহ দেখুন
                    </a>
                </div>

                <div class="hero-highlights">
                    <div class="hero-highlight-item">
                        <div class="icon"><i class="ph-bold ph-keyboard"></i></div>
                        <div class="text">
                            <h4>বিজয় ও ইউনিকোড</h4>
                            <p>সুতন্বীএমজে ও কালপুরুষ ফন্ট</p>
                        </div>
                    </div>
                    <div class="hero-highlight-item">
                        <div class="icon"><i class="ph-bold ph-file-text"></i></div>
                        <div class="text">
                            <h4>শীট ও স্ক্রিন মোড</h4>
                            <p>আসল প্রশ্নপত্র দেখে টাইপিং</p>
                        </div>
                    </div>
                    <div class="hero-highlight-item">
                        <div class="icon"><i class="ph-bold ph-certificate"></i></div>
                        <div class="text">
                            <h4>বিসিসি মার্কশিট</h4>
                            <p>সরকারি গ্রেডিং ক্যালকুলেশন</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interactive Live Typing Preview Box -->
            <div class="live-demo-card">
                <div class="demo-card-header">
                    <div class="demo-tag">
                        <i class="ph-fill ph-circle-wavy-check" style="color:var(--accent);"></i>
                        লাইভ টাইপিং ট্রায়াল
                    </div>
                    <div class="demo-lang-selector">
                        <button class="demo-lang-btn active" id="btn-demo-bn" onclick="switchDemoLang('bn')">বাংলা</button>
                        <button class="demo-lang-btn" id="btn-demo-en" onclick="switchDemoLang('en')">English</button>
                    </div>
                </div>

                <div class="demo-stats-strip">
                    <div class="demo-stat-pill">
                        <div class="val" id="demo-time">00:30</div>
                        <div class="lbl">সময় বাকি</div>
                    </div>
                    <div class="demo-stat-pill">
                        <div class="val" id="demo-wpm">0</div>
                        <div class="lbl">WPM স্পিড</div>
                    </div>
                    <div class="demo-stat-pill">
                        <div class="val" style="color:var(--accent);" id="demo-acc">100%</div>
                        <div class="lbl">অ্যাকুরেসি</div>
                    </div>
                </div>

                <div class="demo-passage-box" id="demo-passage">
                    <!-- Dynamic Words injected by JS -->
                </div>

                <input type="text" id="demo-input" class="demo-input" placeholder="এখানে টাইপ করা শুরু করুন..." autocomplete="off" spellcheck="false">

                <div class="demo-card-footer">
                    <span><i class="ph ph-info"></i> স্পেস বাটন চাপলে পরবর্তী শব্দ আসবে</span>
                    <button onclick="resetDemo()" style="background:transparent; border:none; color:var(--primary); font-weight:600; cursor:pointer; font-size:0.82rem;">
                        <i class="ph ph-arrow-counter-clockwise"></i> রিস্টার্ট
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container stats-grid">
            <div class="stat-item">
                <h3>{{ $totalStudents > 50 ? $totalStudents : '২,৫০০+' }}</h3>
                <p>নিবন্ধিত শিক্ষার্থী ও পরীক্ষার্থী</p>
            </div>
            <div class="stat-item">
                <h3>{{ $totalTests > 10 ? $totalTests : '৫০+' }}</h3>
                <p>সরকারি ও বিসিসি এক্সাম ল্যাব টেস্ট</p>
            </div>
            <div class="stat-item">
                <h3>৯৮.৪%</h3>
                <p>বিসিসি পরীক্ষায় পাসের হার</p>
            </div>
            <div class="stat-item">
                <h3>১০০%</h3>
                <p>অফিসিয়াল বিসিসি ফর্মুলা ও মার্কশিট</p>
            </div>
        </div>
    </section>

    <!-- Features & Exam Labs -->
    <section class="labs-section" id="labs">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">পরীক্ষার ল্যাব ক্যাটাগরি</span>
                <h2 class="section-title">যেসব পরীক্ষার পূর্ণাঙ্গ প্রস্তুতি রয়েছে</h2>
                <p class="section-subtitle">সকল মন্ত্রণালয়, অধিদপ্তর, সুপ্রিম কোর্ট ও স্বায়ত্তশাসিত প্রতিষ্ঠানের বিগত প্রশ্ন এবং এক্সাম প্যাটার্ন অনুযায়ী সাজানো।</p>
            </div>

            <div class="labs-grid">
                <!-- BCC Lab -->
                <div class="lab-feature-card">
                    <div class="lab-icon-wrap">
                        <i class="ph-fill ph-buildings"></i>
                    </div>
                    <h3>BCC Lab (বাংলাদেশ কম্পিউটার কাউন্সিল)</h3>
                    <p>বিসিসি কম্পিউটার অপারেটর ও ডাটা এন্ট্রি পরীক্ষার শতভাগ হুবহু প্রশ্নপত্র, টাইমার এবং বিসিসি স্ট্যান্ডার্ড গ্রেডিং সিস্টেম।</p>
                    <span class="lab-feature-badge"><i class="ph ph-check"></i> ৫ মিনিট ও ১০ মিনিট স্পিড টেস্ট</span>
                </div>

                <!-- High Court Lab -->
                <div class="lab-feature-card accent">
                    <div class="lab-icon-wrap">
                        <i class="ph-fill ph-scales"></i>
                    </div>
                    <h3>High Court & Supreme Court Lab</h3>
                    <p>বাংলাদেশ সুপ্রিম কোর্ট ও জেলা জজ আদালতের সাঁট-মুদ্রাক্ষরিক এবং টাইপিস্ট নিয়োগ পরীক্ষার জন্য বিশেষ ল্যাব।</p>
                    <span class="lab-feature-badge"><i class="ph ph-check"></i> লিগ্যাল টার্মিনোলজি ও দ্রুত টাইপ</span>
                </div>

                <!-- BUET Lab -->
                <div class="lab-feature-card warning">
                    <div class="lab-icon-wrap">
                        <i class="ph-fill ph-student"></i>
                    </div>
                    <h3>BUET & IBA Recruitment Lab</h3>
                    <p>বুয়েট বা আইবিএ কর্তৃক পরিচালিত বিভিন্ন সরকারি ব্যাংক ও প্রতিষ্ঠানের টাইপিং টেস্টের নিখুঁত প্রস্তুতি।</p>
                    <span class="lab-feature-badge"><i class="ph ph-check"></i> ইউনিকোড ও ইংরেজি মিশ্র টেস্ট</span>
                </div>

                <!-- Sheet Mode -->
                <div class="lab-feature-card">
                    <div class="lab-icon-wrap">
                        <i class="ph-fill ph-newspaper"></i>
                    </div>
                    <h3>Sheet Mode (প্রশ্নপত্র দেখে টাইপিং)</h3>
                    <p>স্ক্রিনে টেক্সট না দেখে প্রিন্টেড হার্ডকপি প্রশ্ন দেখে সম্পূর্ণ প্যাসেজ টাইপ করার আসল পরীক্ষার অনুভূতি।</p>
                    <span class="lab-feature-badge"><i class="ph ph-check"></i> অটো-ডিফ চেকিং ও ভুল ডিটেকশন</span>
                </div>

                <!-- Ministry & Directorate -->
                <div class="lab-feature-card accent">
                    <div class="lab-icon-wrap">
                        <i class="ph-fill ph-briefcase"></i>
                    </div>
                    <h3>Ministry & Directorate Lab</h3>
                    <p>জনপ্রশাসন মন্ত্রণালয়, রাজস্ব বোর্ড, নির্বাচন কমিশন সহ সকল সরকারি অধিদপ্তরের অফিস সহকারী কাম কম্পিউটার মুদ্রাক্ষরিক প্রশ্নব্যাংক।</p>
                    <span class="lab-feature-badge"><i class="ph ph-check"></i> নিয়মিত নতুন প্যাসেজ আপডেট</span>
                </div>

                <!-- Bijoy Classic & Advanced -->
                <div class="lab-feature-card warning">
                    <div class="lab-icon-wrap">
                        <i class="ph-fill ph-keyboard"></i>
                    </div>
                    <h3>Bijoy Classic & Avro Unicode</h3>
                    <p>বিজয় কিবোর্ডের সুতন্বীএমজে ফন্ট এবং অভ্র ইউনিকোড উভয় মাধ্যমেই যুক্তবর্ণের সঠিকতার সাথে টাইপ করার পূর্ণ সাপোর্ট।</p>
                    <span class="lab-feature-badge"><i class="ph ph-check"></i> রিয়েল-টাইম কনভার্টার প্রযুক্তি</span>
                </div>
            </div>
        </div>
    </section>

    <!-- BCC Exam Rules & Standards -->
    <section class="bcc-rules-section" id="bcc-rules">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">সরকারি নিয়মাবলী</span>
                <h2 class="section-title">বিসিসি ও সরকারি পরীক্ষার স্ট্যান্ডার্ড ক্যালকুলেশন</h2>
                <p class="section-subtitle">আমাদের মূল্যায়ন ইঞ্জিন বাংলাদেশ সরকারি নিয়োগ ও বিসিসি স্ট্যান্ডার্ড নীতি সম্পূর্ণ অনুসরণ করে।</p>
            </div>

            <div class="rules-grid">
                <div class="rule-card">
                    <div class="rule-num">০১</div>
                    <h3>পাসিং স্পিড ক্রাইটেরিয়া (WPM)</h3>
                    <p>সরকারি নিয়ম অনুযায়ী ইংরেজিতে সর্বনিম্ন <strong>২৮-৩০ WPM</strong> এবং বাংলায় সর্বনিম্ন <strong>২০-২৫ WPM</strong> নেট স্পিড অর্জন করতে হয়।</p>
                </div>

                <div class="rule-card">
                    <div class="rule-num">০২</div>
                    <h3>৫% ভুলের কঠোর নিয়ম (Max 5% Error)</h3>
                    <p>মোট টাইপ করা শব্দের মধ্যে ভুলের হার ৫% এর বেশি হলে স্পিড যতই থাকুক না কেন স্বয়ংক্রিয়ভাবে অকৃতকার্য (FAIL) হিসেবে গণ্য হবে।</p>
                </div>

                <div class="rule-card">
                    <div class="rule-num">০৩</div>
                    <h3>নেট স্পিড ক্যালকুলেশন (Net Speed)</h3>
                    <p>গ্রস স্পিড থেকে মোট ভুলের আনুপাতিক পেনাল্টি কর্তন করে আসল 'Net WPM' নির্ণয় করা হয় এবং অফিসিয়াল মার্কশিটে প্রদর্শিত হয়।</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing / Subscription Section -->
    <section class="pricing-section" id="pricing">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">সাবস্ক্রিপশন প্ল্যান</span>
                <h2 class="section-title">আপনার প্রস্তুতির জন্য উপযুক্ত প্যাকেজ</h2>
                <p class="section-subtitle">বিকাশ ও নগদের মাধ্যমে সহজ রিচার্জ ও তাৎক্ষণিক সকল ল্যাবের প্রিমিয়াম এক্সেস পান।</p>
            </div>

            <div class="pricing-grid">
                @if(isset($packages) && $packages->count() > 0)
                    @foreach($packages as $package)
                        <div class="pricing-card {{ $loop->iteration == 2 ? 'featured' : '' }}">
                            @if($loop->iteration == 2)
                                <div class="featured-ribbon">সবচেয়ে জনপ্রিয়</div>
                            @endif
                            <h3 class="plan-name">{{ $package->name }}</h3>
                            <p style="color:var(--text-muted); font-size:0.9rem;">সরকারি ও বিসিসি পরীক্ষার সম্পূর্ণ প্রস্তুতি</p>
                            
                            <div class="plan-price">
                                <span class="currency">৳</span>
                                <span class="amount">{{ $package->price }}</span>
                                <span class="period">/ {{ $package->duration_days }} দিন</span>
                            </div>

                            <ul class="plan-features">
                                <li><i class="ph-bold ph-check"></i> সকল ল্যাব ও এক্সাম টেস্ট আনলক</li>
                                <li><i class="ph-bold ph-check"></i> বাংলা (বিজয় ও ইউনিকোড) ও ইংরেজি</li>
                                <li><i class="ph-bold ph-check"></i> শীট মোড ও স্ক্রিন মোড প্র্যাকটিস</li>
                                <li><i class="ph-bold ph-check"></i> আনলিমিটেড টেস্ট ও অফিশিয়াল রেজাল্ট</li>
                                <li><i class="ph-bold ph-check"></i> বিসিসি ফরম্যাটে মার্কশিট ডাউনলোড</li>
                                <li><i class="ph-bold ph-check"></i> ২৪/৭ হেল্পলাইন ও সাপোর্ট</li>
                            </ul>

                            <a href="{{ route('register') }}" class="btn {{ $loop->iteration == 2 ? 'btn-primary' : 'btn-outline' }}" style="width:100%; border-radius:10px;">
                                প্যাকেজটি শুরু করুন
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="pricing-card">
                        <h3 class="plan-name">১ মাস প্রিমিয়াম</h3>
                        <p style="color:var(--text-muted); font-size:0.9rem;">স্বল্পমেয়াদী পরীক্ষার প্রস্তুতি</p>
                        <div class="plan-price">
                            <span class="currency">৳</span>
                            <span class="amount">২০০</span>
                            <span class="period">/ ৩০ দিন</span>
                        </div>
                        <ul class="plan-features">
                            <li><i class="ph-bold ph-check"></i> সকল ল্যাব ও এক্সাম টেস্ট আনলক</li>
                            <li><i class="ph-bold ph-check"></i> বিজয় ও ইউনিকোড ফুল সাপোর্ট</li>
                            <li><i class="ph-bold ph-check"></i> আনলিমিটেড টেস্ট প্র্যাকটিস</li>
                            <li><i class="ph-bold ph-check"></i> বিসিসি মার্কশিট প্রিন্ট সুবিধা</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-outline" style="width:100%;">শুরু করুন</a>
                    </div>
                    <div class="pricing-card featured">
                        <div class="featured-ribbon">সবচেয়ে জনপ্রিয়</div>
                        <h3 class="plan-name">৩ মাস মাস্টার প্ল্যান</h3>
                        <p style="color:var(--text-muted); font-size:0.9rem;">নিখুঁত ও দীর্ঘমেয়াদী প্রস্তুতি</p>
                        <div class="plan-price">
                            <span class="currency">৳</span>
                            <span class="amount">৫০০</span>
                            <span class="period">/ ৯০ দিন</span>
                        </div>
                        <ul class="plan-features">
                            <li><i class="ph-bold ph-check"></i> সকল ল্যাব ও স্পেশাল কোয়েশ্চেন ব্যাংক</li>
                            <li><i class="ph-bold ph-check"></i> শীট মোড ও হার্ডকপি কোয়েশ্চেন পেপার</li>
                            <li><i class="ph-bold ph-check"></i> ফুল অ্যানালাইসিস ও লিডারবোর্ড ট্র্যাকিং</li>
                            <li><i class="ph-bold ph-check"></i> অগ্রাধিকার ভিত্তিতে সাপোর্ট</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-primary" style="width:100%;">শুরু করুন</a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section" id="faq">
        <div class="container faq-wrapper">
            <div class="section-header">
                <span class="section-tag">সচরাচর প্রশ্নাবলী</span>
                <h2 class="section-title">সাধারণ কিছু জিজ্ঞাসা ও উত্তর</h2>
                <p class="section-subtitle">SelfTyping.com প্ল্যাটফর্ম ও সরকারি পরীক্ষার নিয়ম সম্পর্কিত প্রশ্নের উত্তর</p>
            </div>

            <div class="faq-list">
                <div class="faq-item active">
                    <div class="faq-header" onclick="toggleFaq(this)">
                        <span>১. বিসিসি টাইপিং পরীক্ষায় ভুলের হিসাব কীভাবে করা হয়?</span>
                        <i class="ph-bold ph-caret-down"></i>
                    </div>
                    <div class="faq-body">
                        বাংলাদেশ কম্পিউটার কাউন্সিল (BCC) ও সরকারি নিয়োগ পরীক্ষায় সাধারণত সর্বোচ্চ ৫% ভুল ছাড় দেওয়া হয়। ৫% এর বেশি ভুল হলে পরীক্ষার্থী সরাসরি ফেল বলে গণ্য হবে। আমাদের ওয়েবসাইটে প্রতিটি পরীক্ষার পর এই সঠিক ফর্মুলায় রেজাল্ট তৈরি হয়।
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header" onclick="toggleFaq(this)">
                        <span>২. আমি কি বিজয় বায়ান্ন এবং অভ্র উভয় কিবোর্ডেই প্র্যাকটিস করতে পারব?</span>
                        <i class="ph-bold ph-caret-down"></i>
                    </div>
                    <div class="faq-body">
                        হ্যাঁ, SelfTyping.com প্ল্যাটফর্মে বিজয় বায়ান্ন (SutonnyMJ ফন্ট) এবং ইউনিকোড (Kalpurush ফন্ট) উভয়ের জন্যই আলাদা এবং মিশ্র ল্যাব রয়েছে। আপনি আপনার কিবোর্ডে যেভাবে অভ্যস্ত সেভাবেই পরীক্ষা দিতে পারবেন।
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header" onclick="toggleFaq(this)">
                        <span>৩. শীট মোড (Sheet Mode) কী এবং কীভাবে কাজ করে?</span>
                        <i class="ph-bold ph-caret-down"></i>
                    </div>
                    <div class="faq-body">
                        বিসিসি ফিজিক্যাল ল্যাবে পরীক্ষার্থীদের একটি প্রিন্ট করা কাগজের প্রশ্ন দিয়ে স্ক্রিনে ফাঁকা জায়গায় টাইপ করতে বলা হয়। শীট মোডে আপনি প্রিন্ট করা প্রশ্ন বা পিডিএফ দেখে টাইপ করতে পারবেন এবং সাবমিটের পর আমাদের ইঞ্জিন স্বয়ংক্রিয়ভাবে আসল লেখার সাথে মিলিয়ে নিখুঁত ভুল চিহ্নিত করবে।
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header" onclick="toggleFaq(this)">
                        <span>৪. সাবস্ক্রিপশন ফি বা ওয়ালেট রিচার্জ কীভাবে করব?</span>
                        <i class="ph-bold ph-caret-down"></i>
                    </div>
                    <div class="faq-body">
                        ড্যাশবোর্ডের ওয়ালেট সেকশনে গিয়ে বিকাশ বা নগদ নম্বরে সেন্ড মানি করে ট্রানজেকশন আইডি (TrxID) সাবমিট করলেই আপনার একাউন্টে ওয়ালেট ব্যালেন্স যোগ হবে। সেই ব্যালেন্স দিয়ে যেকোনো মেয়াদের প্যাকেজ অ্যাক্টিভ করতে পারবেন।
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-header" onclick="toggleFaq(this)">
                        <span>৫. কোনো কোচিং সেন্টার বা ইনস্টিটিউট কি ব্যাচভিত্তিক শিক্ষার্থীদের জন্য ব্যবহার করতে পারবে?</span>
                        <i class="ph-bold ph-caret-down"></i>
                    </div>
                    <div class="faq-body">
                        অবশ্যই! আমাদের 'Institution Admin' প্যানেলের মাধ্যমে কোচিং সেন্টারগুলো নিজস্ব শিক্ষার্থীদের রেজিস্ট্রেশন করিয়ে আলাদা কাস্টম টেস্ট ও ব্যাচভিত্তিক রেজাল্ট শিট ডাউনলোড করতে পারবে।
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Banner -->
    <section class="cta-banner">
        <div class="container">
            <h2>আজই আপনার টাইপিং প্রস্তুতি এক ধাপ এগিয়ে নিন</h2>
            <p>হাজারো সরকারি চাকরিপ্রার্থীর পছন্দের টাইপিং পোর্টালে যুক্ত হয়ে নিজের গতি ও নির্ভুলতা যাচাই করুন।</p>
            <a href="{{ route('register') }}" class="btn btn-accent" style="font-size:1.1rem; padding:0.9rem 2.2rem; border-radius:10px;">
                <i class="ph-bold ph-rocket-launch"></i> ফ্রিতে অ্যাকাউন্ট তৈরি করুন
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <h2><i class="ph-fill ph-keyboard" style="color:var(--primary-light);"></i> SelfTyping<span style="color:var(--primary-light);">.com</span></h2>
                    <p>বাংলাদেশ কম্পিউটার কাউন্সিল (BCC), মন্ত্রণালয়, সুপ্রিম কোর্ট ও সরকারি নিয়োগ পরীক্ষার জন্য দেশের সবচেয়ে আধুনিক অনলাইন টাইপিং এক্সাম ও প্র্যাকটিস প্ল্যাটফর্ম।</p>
                    <div class="footer-socials">
                        <a href="#" class="footer-social-btn"><i class="ph ph-facebook-logo"></i></a>
                        <a href="#" class="footer-social-btn"><i class="ph ph-youtube-logo"></i></a>
                        <a href="#" class="footer-social-btn"><i class="ph ph-telegram-logo"></i></a>
                        <a href="#" class="footer-social-btn"><i class="ph ph-whatsapp-logo"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>গুরুত্বপূর্ণ ল্যাব</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('login') }}">BCC স্পেশাল ল্যাব</a></li>
                        <li><a href="{{ route('login') }}">হাইকোর্ট ও জজকোর্ট ল্যাব</a></li>
                        <li><a href="{{ route('login') }}">বুয়েট ও আইবিএ স্ট্যান্ডার্ড</a></li>
                        <li><a href="{{ route('login') }}">মন্ত্রণালয় ও অধিদপ্তর প্রস্তুতি</a></li>
                        <li><a href="{{ route('login') }}">শীট মোড প্র্যাকটিস</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>সহায়িকা ও নীতি</h4>
                    <ul class="footer-links">
                        <li><a href="#bcc-rules">বিসিসি পরীক্ষার নিয়মাবলী</a></li>
                        <li><a href="#pricing">প্যাকেজ ও সাবস্ক্রিপশন</a></li>
                        <li><a href="#faq">সচরাচর জিজ্ঞাসিত প্রশ্ন (FAQ)</a></li>
                        <li><a href="#">গোপনীয়তা নীতি (Privacy Policy)</a></li>
                        <li><a href="#">শর্তাবলী (Terms of Service)</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>পেমেন্ট ও সাপোর্ট</h4>
                    <p style="font-size:0.9rem; margin-bottom:0.8rem; color:#94a3b8;">সরাসরি বিকাশ, নগদ ও রকেটে ওয়ালেট রিচার্জ সুবিধা।</p>
                    <div class="footer-payment-icons">
                        <span class="payment-pill">bKash Personal</span>
                        <span class="payment-pill">Nagad Personal</span>
                        <span class="payment-pill">Rocket</span>
                        <span class="payment-pill">Bank Transfer</span>
                    </div>
                    <p style="font-size:0.85rem; margin-top:1rem; color:#cbd5e1;">
                        <i class="ph ph-phone-call"></i> হেল্পলাইন: ০১৭০০-০০০০০০<br>
                        <i class="ph ph-envelope"></i> সাপোর্ট: support@selftyping.com
                    </p>
                </div>
            </div>

            <div class="footer-bottom">
                <div>© {{ date('Y') }} SelfTyping.com. সর্বস্বত্ব সংরক্ষিত।</div>
                <div>Designed & Engineered for Bangladesh Govt Recruitment Typing Aspirants.</div>
            </div>
        </div>
    </footer>

    <!-- Interactive Live Demo Script & FAQ Accordion JS -->
    <script>
        // FAQ Accordion
        function toggleFaq(el) {
            const item = el.parentElement;
            const isActive = item.classList.contains('active');
            
            document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('active'));
            if (!isActive) {
                item.classList.add('active');
            }
        }

        // Live Demo Typing Logic
        const samplePassages = {
            bn: "বাংলাদেশ কম্পিউটার কাউন্সিল একটি স্বায়ত্তশাসিত সরকারি প্রতিষ্ঠান। এটি জাতীয় পর্যায়ে তথ্যপ্রযুক্তির অবকাঠামো উন্নয়ন ও দক্ষ জনশক্তি তৈরিতে কাজ করে। টাইপিংয়ে গতি ও নির্ভুলতা উভয়ই অত্যন্ত প্রয়োজনীয়।",
            en: "Bangladesh Computer Council is an autonomous government body. Typing accuracy and speed are critical for government computer operator recruitment examinations. Regular practice ensures success."
        };

        let currentDemoLang = 'bn';
        let demoWords = [];
        let demoCurrentIdx = 0;
        let demoTimeRemaining = 30;
        let demoTimer = null;
        let demoStarted = false;
        let demoCorrectEntries = 0;
        let demoErrors = 0;

        const demoPassageBox = document.getElementById('demo-passage');
        const demoInput = document.getElementById('demo-input');
        const demoTimeEl = document.getElementById('demo-time');
        const demoWpmEl = document.getElementById('demo-wpm');
        const demoAccEl = document.getElementById('demo-acc');

        function switchDemoLang(lang) {
            currentDemoLang = lang;
            document.getElementById('btn-demo-bn').classList.toggle('active', lang === 'bn');
            document.getElementById('btn-demo-en').classList.toggle('active', lang === 'en');
            resetDemo();
        }

        function initDemo() {
            demoPassageBox.innerHTML = '';
            demoWords = samplePassages[currentDemoLang].trim().split(/\s+/);
            demoCurrentIdx = 0;
            demoCorrectEntries = 0;
            demoErrors = 0;
            demoStarted = false;
            demoTimeRemaining = 30;
            clearInterval(demoTimer);

            demoTimeEl.innerText = '00:30';
            demoWpmEl.innerText = '0';
            demoAccEl.innerText = '100%';
            demoInput.value = '';
            demoInput.disabled = false;

            demoWords.forEach((word, idx) => {
                const span = document.createElement('span');
                span.innerText = word;
                span.className = 'word' + (idx === 0 ? ' current' : '');
                demoPassageBox.appendChild(span);
                demoPassageBox.appendChild(document.createTextNode(' '));
            });
        }

        function resetDemo() {
            clearInterval(demoTimer);
            initDemo();
        }

        function startDemoTimer() {
            demoStarted = true;
            demoTimer = setInterval(() => {
                demoTimeRemaining--;
                const sec = demoTimeRemaining < 10 ? '0' + demoTimeRemaining : demoTimeRemaining;
                demoTimeEl.innerText = '00:' + sec;
                updateDemoStats();

                if (demoTimeRemaining <= 0) {
                    clearInterval(demoTimer);
                    demoInput.disabled = true;
                    demoInput.placeholder = "ট্রায়াল সমাপ্ত! পুরো টেস্ট দিতে রেজিস্ট্রেশন করুন।";
                }
            }, 1000);
        }

        function updateDemoStats() {
            const timeElapsed = (30 - demoTimeRemaining) / 60;
            if (timeElapsed <= 0) return;

            const wpm = Math.round((demoCorrectEntries / 5) / timeElapsed);
            demoWpmEl.innerText = wpm > 0 ? wpm : 0;

            const total = demoCorrectEntries + demoErrors;
            const acc = total === 0 ? 100 : Math.round((demoCorrectEntries / total) * 100);
            demoAccEl.innerText = (acc > 0 ? acc : 0) + '%';
        }

        demoInput.addEventListener('input', (e) => {
            if (!demoStarted) startDemoTimer();

            const typed = demoInput.value;
            const target = demoWords[demoCurrentIdx];
            const spans = demoPassageBox.querySelectorAll('.word');

            if (typed.endsWith(' ')) {
                const cleanTyped = typed.trim();
                const isCorrect = (cleanTyped === target);

                if (isCorrect) {
                    spans[demoCurrentIdx].className = 'word correct';
                    demoCorrectEntries += target.length + 1;
                } else {
                    spans[demoCurrentIdx].className = 'word wrong';
                    demoErrors += 1;
                }

                demoCurrentIdx++;
                demoInput.value = '';

                if (demoCurrentIdx < demoWords.length) {
                    spans[demoCurrentIdx].className = 'word current';
                } else {
                    clearInterval(demoTimer);
                    demoInput.disabled = true;
                    demoInput.placeholder = "চমৎকার! আপনি সফলভাবে ট্রায়াল সম্পন্ন করেছেন।";
                }
            }

            updateDemoStats();
        });

        // Initialize on page load
        initDemo();
    </script>
</body>
</html>
