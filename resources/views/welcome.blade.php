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
            --bg-base: #090d16;
            --surface: #111827;
            --surface-card: rgba(17, 24, 39, 0.75);
            --surface-card-hover: rgba(24, 33, 53, 0.9);
            --primary: #2563eb;
            --primary-glow: rgba(37, 99, 235, 0.4);
            --primary-light: #60a5fa;
            --primary-dark: #1d4ed8;
            --accent: #10b981;
            --accent-glow: rgba(16, 185, 129, 0.35);
            --accent-hover: #059669;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #ffffff;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --bg-light: #090d16;
            --white: #111827;
            --border: rgba(255, 255, 255, 0.08);
            --border-hover: rgba(59, 130, 246, 0.4);
            --radius-lg: 20px;
            --radius-md: 14px;
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
            background-color: var(--bg-base);
            color: var(--text-main);
            line-height: 1.6;
            overflow-x: hidden;
            position: relative;
        }

        /* Ambient Glowing Background Orbs & Cyber Grid */
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
            filter: blur(120px);
            opacity: 0.35;
            animation: floatOrb 22s infinite alternate ease-in-out;
        }
        .orb-1 { width: 45vw; height: 45vw; background: radial-gradient(circle, #1d4ed8, transparent 70%); top: -10vw; left: -10vw; }
        .orb-2 { width: 40vw; height: 40vw; background: radial-gradient(circle, #059669, transparent 70%); bottom: 10vw; right: -5vw; animation-delay: -10s; }
        .orb-3 { width: 35vw; height: 35vw; background: radial-gradient(circle, #7c3aed, transparent 70%); top: 40%; right: 15%; opacity: 0.22; animation-duration: 28s; }

        @keyframes floatOrb {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(5vw, 6vh) scale(1.1); }
            100% { transform: translate(-3vw, 10vh) scale(0.95); }
        }

        .grid-pattern {
            position: fixed;
            inset: 0;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.025) 1px, transparent 1px);
            background-size: 36px 36px;
            z-index: 0;
            pointer-events: none;
            mask-image: radial-gradient(ellipse at center, black 60%, transparent 90%);
            -webkit-mask-image: radial-gradient(ellipse at center, black 60%, transparent 90%);
        }

        .en-font { font-family: var(--font-en) !important; }

        /* Smooth Scroll */
        html { scroll-behavior: smooth; }

        /* Container */
        .container {
            max-width: 1320px;
            margin: 0 auto;
            padding: 0 1.5rem;
            position: relative;
            z-index: 2;
        }

        /* Top Announcement Bar */
        .top-bar {
            background: linear-gradient(90deg, rgba(30, 58, 138, 0.8), rgba(37, 99, 235, 0.85), rgba(5, 150, 105, 0.8));
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: #ffffff;
            padding: 0.45rem 1rem;
            text-align: center;
            font-size: 0.85rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            position: relative;
            z-index: 110;
        }
        .top-bar .badge {
            background: #f59e0b;
            color: #000;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 700;
            font-size: 0.72rem;
        }

        /* Navbar - Clean, Compact & Non-wrapping */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(9, 13, 22, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            transition: all 0.3s ease;
        }
        .nav-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 72px;
            gap: 1rem;
        }
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #ffffff;
            flex-shrink: 0;
        }
        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), #1e40af);
            color: white;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.45rem;
            box-shadow: 0 0 20px var(--primary-glow);
            border: 1px solid rgba(255,255,255,0.15);
        }
        .brand-text h1 {
            font-size: 1.32rem;
            font-weight: 800;
            line-height: 1.1;
            color: #ffffff;
            letter-spacing: -0.5px;
        }
        .brand-text span {
            font-size: 0.7rem;
            color: var(--primary-light);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
        }

        /* Nav links: compact, clean spacing, no wrapping */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            list-style: none;
            margin: 0;
            padding: 0;
            flex-wrap: nowrap;
        }
        .nav-links li {
            white-space: nowrap;
        }
        .nav-links a {
            text-decoration: none;
            color: #cbd5e1;
            font-weight: 600;
            font-size: 0.92rem;
            padding: 6px 10px;
            border-radius: 8px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
        }
        .nav-links a i {
            font-size: 1.05rem;
            color: var(--primary-light);
            transition: transform 0.2s;
        }
        .nav-links a:hover {
            color: #ffffff;
            background: rgba(37, 99, 235, 0.15);
        }
        .nav-links a:hover i {
            transform: translateY(-1px);
            color: #ffffff;
        }

        /* Nav actions */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            flex-shrink: 0;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 0.55rem 1.15rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.25s ease;
            cursor: pointer;
            border: none;
            white-space: nowrap;
        }
        .btn-outline {
            background: rgba(255, 255, 255, 0.05);
            color: #f8fafc;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        .btn-outline:hover {
            border-color: var(--primary-light);
            color: #ffffff;
            background: rgba(37, 99, 235, 0.2);
            box-shadow: 0 0 15px rgba(37, 99, 235, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            box-shadow: 0 4px 15px var(--primary-glow);
            border: 1px solid rgba(255,255,255,0.15);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.6);
        }
        .btn-accent {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 4px 15px var(--accent-glow);
            border: 1px solid rgba(255,255,255,0.15);
        }
        .btn-accent:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.5);
        }

        /* Hero Section - Cyber Dark Theme */
        .hero {
            position: relative;
            padding: 4.5rem 0 5rem 0;
            overflow: hidden;
            background: transparent;
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
            background: rgba(37, 99, 235, 0.15);
            color: #93c5fd;
            border: 1px solid rgba(59, 130, 246, 0.3);
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 0.88rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            box-shadow: 0 0 20px rgba(37, 99, 235, 0.15);
        }
        .hero-badge i { font-size: 1.1rem; color: #60a5fa; }

        .hero-title {
            font-size: 2.85rem;
            line-height: 1.25;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 1.25rem;
            letter-spacing: -0.5px;
        }
        .hero-title .highlight {
            background: linear-gradient(120deg, #60a5fa, #38bdf8, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 1.12rem;
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
            border-radius: 12px;
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
            border-radius: 10px;
            background: rgba(37, 99, 235, 0.15);
            color: #60a5fa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
            border: 1px solid rgba(59, 130, 246, 0.25);
        }
        .hero-highlight-item .text h4 {
            font-size: 0.95rem;
            font-weight: 700;
            color: #ffffff;
        }
        .hero-highlight-item .text p {
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        /* Hero Modern Interactive SVG Showcase */
        .hero-visual-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-visual-card {
            width: 100%;
            background: linear-gradient(145deg, rgba(17, 24, 39, 0.85), rgba(15, 23, 42, 0.75));
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 24px;
            padding: 2rem 1.8rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6), 0 0 35px rgba(37, 99, 235, 0.2);
            backdrop-filter: blur(20px);
            position: relative;
            z-index: 2;
            overflow: hidden;
        }

        .hero-card-glow {
            position: absolute;
            top: -20%;
            right: -20%;
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, rgba(37, 99, 235, 0.35) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            animation: pulseGlow 6s ease-in-out infinite alternate;
        }

        @keyframes pulseGlow {
            0% { transform: scale(0.9) translate(0, 0); opacity: 0.5; }
            100% { transform: scale(1.15) translate(-20px, 20px); opacity: 0.9; }
        }

        .hero-svg-wrapper {
            position: relative;
            width: 100%;
            max-width: 480px;
            margin: 0 auto;
            filter: drop-shadow(0 15px 25px rgba(0, 0, 0, 0.4));
        }

        .hero-svg-main {
            width: 100%;
            height: auto;
            display: block;
        }

        /* SVG Micro Keyframe Animations */
        @keyframes keyTapA { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(3px); } }
        @keyframes keyTapB { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(3.5px); } }
        @keyframes keyTapC { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(2.5px); } }
        @keyframes floatBadge1 { 0%, 100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(-7px) rotate(1deg); } }
        @keyframes floatBadge2 { 0%, 100% { transform: translateY(0) rotate(0deg); } 50% { transform: translateY(8px) rotate(-1.5deg); } }
        @keyframes cursorBlink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }
        @keyframes speedLineMove { 0% { stroke-dashoffset: 40; } 100% { stroke-dashoffset: 0; } }

        .anim-key-1 { animation: keyTapA 1.6s ease-in-out infinite; transform-origin: center bottom; }
        .anim-key-2 { animation: keyTapB 1.4s ease-in-out infinite 0.25s; transform-origin: center bottom; }
        .anim-key-3 { animation: keyTapC 1.8s ease-in-out infinite 0.5s; transform-origin: center bottom; }
        .anim-key-4 { animation: keyTapA 1.5s ease-in-out infinite 0.7s; transform-origin: center bottom; }
        .anim-cursor { animation: cursorBlink 0.9s infinite; }
        .anim-speed-line { stroke-dasharray: 8 6; animation: speedLineMove 1.5s linear infinite; }
        .anim-float-1 { animation: floatBadge1 4s ease-in-out infinite; }
        .anim-float-2 { animation: floatBadge2 4.5s ease-in-out infinite 0.5s; }

        /* Floating Info Badges */
        .hero-floating-badge {
            position: absolute;
            background: rgba(17, 24, 39, 0.85);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 14px;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.4);
            z-index: 5;
        }
        .hero-floating-badge.badge-speed { top: -12px; right: 0; }
        .hero-floating-badge.badge-bcc { bottom: -15px; left: 0; }
        .hero-floating-badge .badge-icon {
            width: 36px; height: 36px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
        }
        .badge-speed .badge-icon { background: rgba(37, 99, 235, 0.25); color: #60a5fa; }
        .badge-bcc .badge-icon { background: rgba(16, 185, 129, 0.25); color: #34d399; }
        .hero-floating-badge .badge-text .val {
            font-size: 0.95rem; font-weight: 800; color: #ffffff; line-height: 1.1;
        }
        .hero-floating-badge .badge-text .lbl { font-size: 0.72rem; color: #94a3b8; font-weight: 600; }

        /* Interactive Mode Switcher under SVG */
        .hero-visual-footer {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 1.6rem;
            padding-top: 1.2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            position: relative;
            z-index: 2;
        }
        .visual-stat-pill {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            padding: 10px 8px;
            text-align: center;
            transition: all 0.25s ease;
        }
        .visual-stat-pill:hover {
            border-color: #3b82f6;
            background: rgba(37, 99, 235, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 0 15px rgba(37, 99, 235, 0.2);
        }
        .visual-stat-pill .num { font-size: 1.15rem; font-weight: 800; color: #60a5fa; line-height: 1.1; }
        .visual-stat-pill .label { font-size: 0.72rem; color: #94a3b8; font-weight: 600; margin-top: 2px; }

        /* Section Header */
        .section-header {
            text-align: center;
            max-width: 760px;
            margin: 0 auto 3.5rem auto;
            position: relative;
            z-index: 2;
        }
        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(37, 99, 235, 0.15);
            color: #93c5fd;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 5px 16px;
            border-radius: 30px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.85rem;
            border: 1px solid rgba(59, 130, 246, 0.3);
            box-shadow: 0 0 15px rgba(37, 99, 235, 0.15);
        }
        .section-title {
            font-size: 2.35rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.3;
            margin-bottom: 0.8rem;
            letter-spacing: -0.5px;
        }
        .section-subtitle {
            font-size: 1.05rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* Stats Section */
        .stats-section {
            background: rgba(17, 24, 39, 0.6);
            backdrop-filter: blur(16px);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            padding: 3.5rem 0;
            position: relative;
            z-index: 2;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            text-align: center;
        }
        .stat-item h3 {
            font-size: 2.6rem;
            font-weight: 800;
            background: linear-gradient(135deg, #60a5fa, #38bdf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-family: var(--font-en);
            margin-bottom: 0.35rem;
        }
        .stat-item p {
            font-size: 0.98rem;
            font-weight: 600;
            color: #e2e8f0;
        }

        /* Features / Labs Section */
        .labs-section {
            padding: 6rem 0;
            position: relative;
            z-index: 2;
        }
        .labs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.8rem;
        }
        .lab-feature-card {
            background: var(--surface-card);
            backdrop-filter: blur(16px);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2.2rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .lab-feature-card:hover {
            transform: translateY(-6px);
            border-color: var(--primary-light);
            background: var(--surface-card-hover);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.7), 0 0 25px rgba(37, 99, 235, 0.2);
        }
        .lab-icon-wrap {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            background: rgba(37, 99, 235, 0.15);
            color: #60a5fa;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.9rem;
            margin-bottom: 1.3rem;
            border: 1px solid rgba(59, 130, 246, 0.25);
        }
        .lab-feature-card.accent .lab-icon-wrap {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border-color: rgba(16, 185, 129, 0.25);
        }
        .lab-feature-card.warning .lab-icon-wrap {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border-color: rgba(245, 158, 11, 0.25);
        }
        .lab-feature-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #ffffff;
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
            color: #93c5fd;
            background: rgba(37, 99, 235, 0.15);
            border: 1px solid rgba(59, 130, 246, 0.2);
            padding: 5px 12px;
            border-radius: 8px;
            width: fit-content;
        }

        /* BCC Exam Rules Section */
        .bcc-rules-section {
            padding: 6rem 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(16px);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            color: #ffffff;
            position: relative;
            z-index: 2;
        }
        .rules-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 3rem;
        }
        .rule-card {
            background: var(--surface-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2.4rem;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }
        .rule-card:hover {
            transform: translateY(-5px);
            border-color: rgba(59, 130, 246, 0.4);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
        }
        .rule-num {
            font-size: 2.8rem;
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
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Pricing Section */
        .pricing-section {
            padding: 6rem 0;
            position: relative;
            z-index: 2;
        }
        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2.5rem;
        }
        .pricing-card {
            background: var(--surface-card);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 2.6rem 2.2rem;
            display: flex;
            flex-direction: column;
            position: relative;
            transition: all 0.3s ease;
        }
        .pricing-card:hover {
            transform: translateY(-8px);
            border-color: rgba(59, 130, 246, 0.5);
            box-shadow: 0 25px 50px -15px rgba(0, 0, 0, 0.8), 0 0 30px rgba(37, 99, 235, 0.2);
        }
        .pricing-card.featured {
            border: 2px solid var(--primary);
            background: linear-gradient(145deg, rgba(17, 24, 39, 0.95), rgba(30, 41, 59, 0.85));
            box-shadow: 0 0 35px rgba(37, 99, 235, 0.3);
        }
        .featured-ribbon {
            position: absolute;
            top: -12px;
            right: 24px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
        }
        .plan-name {
            font-size: 1.4rem;
            font-weight: 700;
            color: #ffffff;
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
            color: var(--primary-light);
        }
        .plan-price .amount {
            font-size: 2.8rem;
            font-weight: 800;
            color: #ffffff;
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
            color: #e2e8f0;
            margin-bottom: 0.85rem;
        }
        .plan-features li i {
            color: var(--accent);
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        /* Self Publication BD Books Showcase Section */
        .books-section {
            padding: 6rem 0;
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(20px);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            position: relative;
            overflow: hidden;
            z-index: 2;
        }
        .books-slider-wrapper {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding: 1.5rem 0 2.5rem 0;
            mask-image: linear-gradient(to right, transparent, black 6%, black 94%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 6%, black 94%, transparent);
        }

        .books-marquee-track {
            display: flex;
            gap: 2rem;
            width: max-content;
            animation: scrollBooks 32s linear infinite;
        }
        .books-marquee-track:hover {
            animation-play-state: paused;
        }
        @keyframes scrollBooks {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .book-card-item {
            width: 285px;
            background: rgba(17, 24, 39, 0.9);
            backdrop-filter: blur(16px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 12px 32px -10px rgba(0, 0, 0, 0.6);
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            text-decoration: none;
            color: inherit;
            flex-shrink: 0;
        }
        .book-card-item:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 24px 45px -10px rgba(0, 0, 0, 0.8), 0 0 30px rgba(37, 99, 235, 0.25);
            border-color: rgba(59, 130, 246, 0.5);
        }

        .book-cover-wrap {
            position: relative;
            height: 350px;
            border-radius: 12px;
            overflow: hidden;
            background: #0b1329;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.1rem;
            box-shadow: 0 10px 22px rgba(0,0,0,0.45);
            border: 1px solid rgba(255,255,255,0.06);
        }
        .book-cover-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            transition: transform 0.4s ease;
        }
        .book-card-item:hover .book-cover-img {
            transform: scale(1.04);
        }

        .book-discount-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: #ef4444;
            color: #ffffff;
            font-size: 0.72rem;
            font-weight: 800;
            padding: 4px 9px;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.45);
            text-transform: uppercase;
            z-index: 2;
        }
        .book-stock-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #10b981;
            color: #ffffff;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 4px 9px;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.45);
            z-index: 2;
        }
        .book-stock-badge.out-of-stock { background: #64748b; }

        .book-info-title {
            font-size: 1.18rem;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.35;
            margin-bottom: 0.35rem;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .book-info-sub {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-bottom: 0.85rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 2.4rem;
            line-height: 1.5;
        }
        .book-footer-action-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: auto;
            padding-top: 0.75rem;
            border-top: 1px dashed rgba(255, 255, 255, 0.1);
        }
        .book-price-block {
            display: flex;
            align-items: baseline;
            gap: 6px;
        }
        .book-current-price {
            font-size: 1.35rem;
            font-weight: 800;
            color: #38bdf8;
            font-family: var(--font-en);
        }
        .book-orig-price {
            font-size: 0.9rem;
            text-decoration: line-through;
            color: #64748b;
            font-family: var(--font-en);
        }

        .btn-view-book {
            background: #0f274a;
            color: #ffffff;
            padding: 8px 14px;
            border-radius: 9px;
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid rgba(59, 130, 246, 0.35);
            cursor: pointer;
            transition: all 0.25s ease;
            text-decoration: none;
            white-space: nowrap;
        }
        .btn-view-book:hover {
            background: #2563eb;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.45);
        }

        .books-publisher-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(17, 24, 39, 0.85);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: 18px;
            padding: 1.4rem 2.2rem;
            margin-top: 2.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4), 0 0 20px rgba(16, 185, 129, 0.1);
            flex-wrap: wrap;
            gap: 1.2rem;
        }
        .publisher-brand { display: flex; align-items: center; gap: 14px; }
        .publisher-brand .pub-icon {
            width: 48px; height: 48px; border-radius: 12px;
            background: linear-gradient(135deg, #10b981, #059669);
            color: white; display: flex; align-items: center; justify-content: center;
            font-size: 1.6rem; box-shadow: 0 0 20px var(--accent-glow);
        }
        .publisher-brand h4 { font-size: 1.2rem; font-weight: 800; color: #ffffff; }
        .publisher-brand p { font-size: 0.88rem; color: #94a3b8; }

        /* FAQ Section */
        .faq-section {
            padding: 6rem 0;
            position: relative;
            z-index: 2;
        }
        .faq-wrapper { max-width: 840px; margin: 0 auto; }
        .faq-item {
            border: 1px solid var(--border);
            border-radius: 16px;
            margin-bottom: 1.2rem;
            overflow: hidden;
            background: var(--surface-card);
            backdrop-filter: blur(16px);
            transition: all 0.25s ease;
        }
        .faq-header {
            padding: 1.3rem 1.6rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 700;
            font-size: 1.05rem;
            color: #ffffff;
        }
        .faq-header i { font-size: 1.25rem; transition: transform 0.3s; color: var(--primary-light); }
        .faq-body {
            padding: 0 1.6rem 1.4rem 1.6rem;
            color: var(--text-muted);
            font-size: 0.98rem;
            line-height: 1.7;
            display: none;
        }
        .faq-item.active {
            border-color: rgba(59, 130, 246, 0.5);
            background: rgba(24, 33, 53, 0.9);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
        }
        .faq-item.active .faq-header i { transform: rotate(180deg); }
        .faq-item.active .faq-body { display: block; }

        /* CTA Banner */
        .cta-banner {
            padding: 5rem 1.5rem;
            position: relative;
            z-index: 2;
        }
        .cta-container {
            max-width: 1100px;
            margin: 0 auto;
            position: relative;
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.45) 0%, rgba(15, 23, 42, 0.85) 50%, rgba(5, 150, 105, 0.35) 100%);
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 24px;
            padding: 4rem 2.5rem;
            text-align: center;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(16px);
        }
        .cta-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 300px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.25) 0%, transparent 70%);
            pointer-events: none;
        }
        .cta-container h2 {
            font-size: 2.3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #ffffff 30%, #93c5fd 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }
        .cta-container p {
            font-size: 1.12rem;
            color: #94a3b8;
            max-width: 620px;
            margin: 0 auto 2.2rem auto;
            line-height: 1.7;
        }
        .cta-btn-glow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, #2563eb, #10b981);
            color: #ffffff;
            font-size: 1.15rem;
            font-weight: 700;
            padding: 1rem 2.6rem;
            border-radius: 14px;
            text-decoration: none;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.45);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }
        .cta-btn-glow:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 16px 35px rgba(16, 185, 129, 0.5);
            color: #ffffff;
        }

        /* Footer */
        .footer {
            background: linear-gradient(180deg, rgba(8, 12, 22, 0.92) 0%, #04070d 100%);
            color: #94a3b8;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            position: relative;
            z-index: 2;
            padding: 5rem 0 2rem 0;
            backdrop-filter: blur(20px);
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1.3fr;
            gap: 3.5rem;
            margin-bottom: 3.5rem;
        }
        .footer-brand h2 {
            color: white;
            font-size: 1.45rem;
            font-weight: 800;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: -0.5px;
        }
        .footer-brand p {
            font-size: 0.93rem;
            line-height: 1.7;
            margin-bottom: 1.8rem;
            color: #8da2be;
        }
        .footer-socials {
            display: flex;
            gap: 10px;
        }
        .footer-social-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            text-decoration: none;
            transition: all 0.25s ease;
        }
        .footer-social-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
        }
        .footer-col h4 {
            color: #ffffff;
            font-size: 1.08rem;
            font-weight: 700;
            margin-bottom: 1.4rem;
            position: relative;
            display: inline-block;
        }
        .footer-col h4::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -6px;
            width: 26px;
            height: 2px;
            background: var(--primary);
            border-radius: 2px;
        }
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-links li {
            margin-bottom: 0.85rem;
        }
        .footer-links a {
            color: #8da2be;
            text-decoration: none;
            font-size: 0.93rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .footer-links a:hover {
            color: #60a5fa;
            transform: translateX(4px);
        }
        .footer-payment-icons {
            display: flex;
            gap: 8px;
            margin-top: 1rem;
            flex-wrap: wrap;
        }
        .payment-pill {
            background: rgba(30, 41, 59, 0.6);
            color: #cbd5e1;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.08);
            letter-spacing: 0.3px;
        }
        .footer-contact-info {
            font-size: 0.88rem;
            margin-top: 1.2rem;
            color: #94a3b8;
            line-height: 1.8;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 12px 14px;
            border-radius: 10px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            color: #64748b;
        }
        .footer-bottom a {
            color: #60a5fa;
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-bottom a:hover {
            color: #93c5fd;
            text-decoration: underline;
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

    <!-- Ambient Glowing Background Orbs & Cyber Grid Pattern (Like Login/Register) -->
    <div class="ambient-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>
    <div class="grid-pattern"></div>

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
                <li><a href="#books"><i class="ph ph-book-open"></i> বইসমূহ</a></li>
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

            <!-- Modern High-End SVG Typing Showcase -->
            <div class="hero-visual-container">
                <!-- Floating Info Badge: Live Speed -->
                <div class="hero-floating-badge badge-speed anim-float-1">
                    <div class="badge-icon">
                        <i class="ph-fill ph-gauge"></i>
                    </div>
                    <div class="badge-text">
                        <div class="val" id="hero-live-wpm">৪৫+ WPM</div>
                        <div class="lbl">গড় টাইপিং স্পিড</div>
                    </div>
                </div>

                <!-- Floating Info Badge: BCC Certified -->
                <div class="hero-floating-badge badge-bcc anim-float-2">
                    <div class="badge-icon">
                        <i class="ph-fill ph-seal-check"></i>
                    </div>
                    <div class="badge-text">
                        <div class="val">BCC ৫% এরর রুল</div>
                        <div class="lbl">১০০% ভেরিফাইড গ্রেডিং</div>
                    </div>
                </div>

                <div class="hero-visual-card">
                    <div class="hero-card-glow"></div>
                    
                    <div class="hero-svg-wrapper">
                        <!-- High Quality SVG Typing Exam Illustration -->
                        <svg class="hero-svg-main" viewBox="0 0 520 380" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="screenGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#0f172a"/>
                                    <stop offset="100%" stop-color="#1e293b"/>
                                </linearGradient>
                                <linearGradient id="headerGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                    <stop offset="0%" stop-color="#2563eb"/>
                                    <stop offset="100%" stop-color="#3b82f6"/>
                                </linearGradient>
                                <linearGradient id="keyGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                                    <stop offset="0%" stop-color="#ffffff"/>
                                    <stop offset="100%" stop-color="#e2e8f0"/>
                                </linearGradient>
                                <linearGradient id="activeKeyGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                                    <stop offset="0%" stop-color="#3b82f6"/>
                                    <stop offset="100%" stop-color="#1d4ed8"/>
                                </linearGradient>
                                <linearGradient id="deskGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                                    <stop offset="0%" stop-color="#f8fafc"/>
                                    <stop offset="100%" stop-color="#e2e8f0"/>
                                </linearGradient>
                                <filter id="svgGlow" x="-20%" y="-20%" width="140%" height="140%">
                                    <feGaussianBlur stdDeviation="6" result="blur" />
                                    <feComposite in="SourceGraphic" in2="blur" operator="over" />
                                </filter>
                            </defs>

                            <!-- Background Desk Surface Glow -->
                            <ellipse cx="260" cy="335" rx="230" ry="22" fill="#cbd5e1" opacity="0.45"/>

                            <!-- Monitor Stand -->
                            <path d="M 240 230 L 280 230 L 290 275 L 230 275 Z" fill="#94a3b8"/>
                            <ellipse cx="260" cy="275" rx="55" ry="10" fill="#64748b"/>

                            <!-- Monitor Frame -->
                            <rect x="50" y="25" width="420" height="215" rx="14" fill="#0f172a" stroke="#334155" stroke-width="3"/>
                            
                            <!-- Monitor Camera & LED -->
                            <circle cx="260" cy="33" r="3" fill="#334155"/>
                            <circle cx="270" cy="33" r="1.5" fill="#10b981"/>

                            <!-- Monitor Inner Screen Display -->
                            <rect x="58" y="42" width="404" height="190" rx="6" fill="url(#screenGrad)"/>

                            <!-- Browser / Exam App Title Bar Inside Screen -->
                            <rect x="58" y="42" width="404" height="26" fill="#1e293b"/>
                            <!-- Window dots -->
                            <circle cx="72" cy="55" r="4" fill="#ef4444"/>
                            <circle cx="84" cy="55" r="4" fill="#f59e0b"/>
                            <circle cx="96" cy="55" r="4" fill="#10b981"/>
                            
                            <!-- Tab Header -->
                            <rect x="115" y="46" width="160" height="18" rx="4" fill="#0f172a"/>
                            <text x="130" y="59" fill="#93c5fd" font-size="9" font-family="'Hind Siliguri', sans-serif" font-weight="600">BCC Exam Hall: বাংলা টাইপিং</text>

                            <!-- Exam Top Stat Indicators -->
                            <rect x="70" y="76" width="95" height="32" rx="6" fill="#0b1329" stroke="#1e3a8a" stroke-width="1"/>
                            <text x="78" y="90" fill="#94a3b8" font-size="8" font-family="sans-serif">TIMER REMAINING</text>
                            <text x="78" y="103" fill="#38bdf8" font-size="12" font-family="monospace" font-weight="700">04:42 MIN</text>

                            <rect x="175" y="76" width="85" height="32" rx="6" fill="#0b1329" stroke="#1e3a8a" stroke-width="1"/>
                            <text x="183" y="90" fill="#94a3b8" font-size="8" font-family="sans-serif">CURRENT SPEED</text>
                            <text x="183" y="103" fill="#34d399" font-size="12" font-family="monospace" font-weight="700">38.5 WPM</text>

                            <rect x="270" y="76" width="85" height="32" rx="6" fill="#0b1329" stroke="#1e3a8a" stroke-width="1"/>
                            <text x="278" y="90" fill="#94a3b8" font-size="8" font-family="sans-serif">ACCURACY</text>
                            <text x="278" y="103" fill="#fbbf24" font-size="12" font-family="monospace" font-weight="700">99.2 %</text>

                            <rect x="365" y="76" width="82" height="32" rx="6" fill="#0b1329" stroke="#1e3a8a" stroke-width="1"/>
                            <text x="373" y="90" fill="#94a3b8" font-size="8" font-family="sans-serif">BCC STATUS</text>
                            <text x="373" y="103" fill="#4ade80" font-size="11" font-family="sans-serif" font-weight="700">QUALIFIED</text>

                            <!-- Passage Box on Screen -->
                            <rect x="70" y="116" width="377" height="66" rx="8" fill="#131e36" stroke="#1e293b" stroke-width="1"/>
                            
                            <!-- Words inside passage -->
                            <text x="82" y="136" font-size="12" font-family="'Hind Siliguri', sans-serif">
                                <tspan fill="#4ade80">গণপ্রজাতন্ত্রী</tspan>
                                <tspan fill="#4ade80"> বাংলাদেশ</tspan>
                                <tspan fill="#4ade80"> সরকারের</tspan>
                                <tspan fill="#60a5fa" font-weight="700"> কম্পিউটার</tspan>
                                <tspan fill="#94a3b8"> অপারেটর</tspan>
                                <tspan fill="#94a3b8"> ও</tspan>
                            </text>
                            <text x="82" y="156" font-size="12" font-family="'Hind Siliguri', sans-serif">
                                <tspan fill="#94a3b8">ডাটা এন্ট্রি নিয়োগ পরীক্ষায় শুদ্ধভাবে টাইপ করা আবশ্যক।</tspan>
                            </text>
                            <text x="82" y="174" font-size="11" font-family="'Hind Siliguri', sans-serif">
                                <tspan fill="#64748b">ভুল শব্দ: ০ টি | ব্যাকস্পেস লকড: অন | বিসিসি স্ট্যান্ডার্ড</tspan>
                            </text>

                            <!-- Real-time Typing Cursor Active Line -->
                            <rect x="70" y="190" width="377" height="30" rx="6" fill="#0f172a" stroke="#2563eb" stroke-width="1.5"/>
                            <text x="82" y="210" fill="#ffffff" font-size="13" font-family="'Hind Siliguri', sans-serif">কম্পিউটার</text>
                            <!-- Blinking Cursor -->
                            <line x1="142" y1="197" x2="142" y2="213" stroke="#38bdf8" stroke-width="2.5" class="anim-cursor"/>
                            <text x="150" y="209" fill="#475569" font-size="11" font-family="'Hind Siliguri', sans-serif">পরবর্তী শব্দ টাইপ করতে স্পেস চাপুন...</text>

                            <!-- Modern Mechanical Keyboard Base (Iso View) -->
                            <path d="M 80 270 L 440 270 L 465 330 L 55 330 Z" fill="#1e293b" stroke="#334155" stroke-width="2"/>
                            <!-- Keyboard Border Top Highlight -->
                            <path d="M 80 270 L 440 270" stroke="#475569" stroke-width="2"/>

                            <!-- Keyboard Keys Row 1 -->
                            <rect x="95" y="276" width="22" height="12" rx="3" fill="url(#keyGrad)"/>
                            <rect x="122" y="276" width="22" height="12" rx="3" fill="url(#keyGrad)"/>
                            <rect x="149" y="276" width="22" height="12" rx="3" fill="url(#keyGrad)"/>
                            <rect x="176" y="276" width="22" height="12" rx="3" fill="url(#activeKeyGrad)" class="anim-key-1"/>
                            <rect x="203" y="276" width="22" height="12" rx="3" fill="url(#keyGrad)"/>
                            <rect x="230" y="276" width="22" height="12" rx="3" fill="url(#keyGrad)"/>
                            <rect x="257" y="276" width="22" height="12" rx="3" fill="url(#activeKeyGrad)" class="anim-key-2"/>
                            <rect x="284" y="276" width="22" height="12" rx="3" fill="url(#keyGrad)"/>
                            <rect x="311" y="276" width="22" height="12" rx="3" fill="url(#keyGrad)"/>
                            <rect x="338" y="276" width="22" height="12" rx="3" fill="url(#keyGrad)"/>
                            <rect x="365" y="276" width="22" height="12" rx="3" fill="url(#keyGrad)"/>
                            <rect x="392" y="276" width="30" height="12" rx="3" fill="#cbd5e1"/>

                            <!-- Keyboard Keys Row 2 -->
                            <rect x="90" y="293" width="28" height="13" rx="3" fill="#cbd5e1"/>
                            <rect x="123" y="293" width="23" height="13" rx="3" fill="url(#keyGrad)"/>
                            <rect x="151" y="293" width="23" height="13" rx="3" fill="url(#keyGrad)"/>
                            <rect x="179" y="293" width="23" height="13" rx="3" fill="url(#keyGrad)"/>
                            <rect x="207" y="293" width="23" height="13" rx="3" fill="url(#activeKeyGrad)" class="anim-key-3"/>
                            <rect x="235" y="293" width="23" height="13" rx="3" fill="url(#keyGrad)"/>
                            <rect x="263" y="293" width="23" height="13" rx="3" fill="url(#keyGrad)"/>
                            <rect x="291" y="293" width="23" height="13" rx="3" fill="url(#activeKeyGrad)" class="anim-key-4"/>
                            <rect x="319" y="293" width="23" height="13" rx="3" fill="url(#keyGrad)"/>
                            <rect x="347" y="293" width="23" height="13" rx="3" fill="url(#keyGrad)"/>
                            <rect x="375" y="293" width="48" height="13" rx="3" fill="#cbd5e1"/>

                            <!-- Keyboard Spacebar Row -->
                            <rect x="80" y="311" width="38" height="14" rx="3" fill="#94a3b8"/>
                            <rect x="123" y="311" width="28" height="14" rx="3" fill="url(#keyGrad)"/>
                            <!-- Main Spacebar Key with Animation -->
                            <rect x="156" y="311" width="190" height="14" rx="4" fill="url(#activeKeyGrad)" stroke="#60a5fa" stroke-width="1" class="anim-key-2"/>
                            <rect x="351" y="311" width="28" height="14" rx="3" fill="url(#keyGrad)"/>
                            <rect x="384" y="311" width="45" height="14" rx="3" fill="#94a3b8"/>

                            <!-- Optical Gaming/Ergo Mouse on the Right -->
                            <path d="M 460 300 C 460 285 470 280 482 280 C 494 280 504 285 504 300 L 504 320 C 504 330 494 335 482 335 C 470 335 460 330 460 320 Z" fill="#1e293b" stroke="#334155" stroke-width="1.5"/>
                            <line x1="482" y1="280" x2="482" y2="298" stroke="#475569" stroke-width="1.5"/>
                            <!-- Mouse Wheel with blue light -->
                            <rect x="479" y="286" width="6" height="10" rx="3" fill="#38bdf8"/>

                            <!-- Speed Waves / Floating Data Sparkles -->
                            <circle cx="430" cy="55" r="3" fill="#38bdf8" opacity="0.8"/>
                            <circle cx="45" cy="180" r="4" fill="#60a5fa" opacity="0.6"/>
                            <circle cx="485" cy="220" r="3" fill="#34d399" opacity="0.7"/>
                        </svg>
                    </div>

                    <!-- Footer Quick Highlights -->
                    <div class="hero-visual-footer">
                        <div class="visual-stat-pill">
                            <div class="num">বিজয় ও অভ্র</div>
                            <div class="label">উভয় ফন্ট সাপোর্ট</div>
                        </div>
                        <div class="visual-stat-pill">
                            <div class="num">শীট ও স্ক্রিন</div>
                            <div class="label">প্রশ্নপত্র মোড</div>
                        </div>
                        <div class="visual-stat-pill">
                            <div class="num">ইনস্ট্যান্ট রেজাল্ট</div>
                            <div class="label">অফিসিয়াল মার্কশিট</div>
                        </div>
                    </div>
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

    <!-- Self Publication BD Books Showcase Section -->
    <section class="books-section" id="books">
        <div class="container">
            <div class="section-header">
                <span class="section-tag" style="background:#dcfce7; color:#15803d;">
                    <i class="ph-bold ph-book-bookmark"></i> অফিশিয়াল পার্টনার ও প্রকাশনী
                </span>
                <h2 class="section-title">সেলফ পাবলিকেশন (Self Publication BD)</h2>
                <p class="section-subtitle">
                    সরকারি ও বিসিসি নিয়োগ পরীক্ষার সেরা গাইড ও বিগত সালের প্রশ্ন সমাধান বই সরাসরি অফিশিয়াল ওয়েবসাইট থেকে সংগ্রহ করুন।
                </p>
            </div>

            <!-- Auto-Scrolling Books Marquee / Slider -->
            <div class="books-slider-wrapper">
                <div class="books-marquee-track">
                    {{-- Loop through books twice for seamless infinite scroll --}}
                    @for($i = 0; $i < 2; $i++)
                        @forelse($books as $book)
                            <div class="book-card-item">
                                <div class="book-cover-wrap">
                                    @if($book->discount_percent)
                                        <div class="book-discount-badge">{{ $book->discount_percent }}</div>
                                    @endif
                                    <div class="book-stock-badge {{ $book->stock_status !== 'In Stock' ? 'out-of-stock' : '' }}">
                                        {{ $book->stock_status }}
                                    </div>
                                    @if($book->image_url)
                                        <img src="{{ $book->image_url }}" alt="{{ $book->title }}" class="book-cover-img" loading="lazy">
                                    @else
                                        <div style="text-align:center; padding:1.5rem; color:#64748b;">
                                            <i class="ph-fill ph-book-open" style="font-size:3.5rem; color:{{ $book->accent_color }};"></i>
                                            <div style="font-weight:700; margin-top:0.5rem; font-size:0.9rem;">সেলফ পাবলিকেশন</div>
                                        </div>
                                    @endif
                                </div>

                                <h4 class="book-info-title">{{ $book->title }}</h4>
                                <div class="book-info-sub">{{ $book->subtitle ?? 'সেলফ পাবলিকেশন বুক সিরিজ' }}</div>

                                <div class="book-footer-action-row">
                                    <div class="book-price-block">
                                        <span class="book-current-price">৳{{ number_format($book->price, 0) }}</span>
                                        @if($book->original_price)
                                            <span class="book-orig-price">৳{{ number_format($book->original_price, 0) }}</span>
                                        @endif
                                    </div>

                                    <a href="{{ $book->external_url }}" target="_blank" rel="noopener noreferrer" class="btn-view-book">
                                        <i class="ph-bold ph-shopping-cart-simple"></i> Add to Cart
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div style="padding:2rem; text-align:center; color:#64748b;">বই লোড হচ্ছে...</div>
                        @endforelse
                    @endfor
                </div>
            </div>

            <!-- Publisher Info Banner -->
            <div class="books-publisher-banner">
                <div class="publisher-brand">
                    <div class="pub-icon">
                        <i class="ph-fill ph-storefront"></i>
                    </div>
                    <div>
                        <h4>সেলফ পাবলিকেশন • selfpublicationbd.com</h4>
                        <p>মন্ত্রণালয়, বিসিসি ও সরকারি চাকরির সকল ধরণের বই ঘরে বসেই হোম ডেলিভারিতে পান।</p>
                    </div>
                </div>
                <a href="https://selfpublicationbd.com" target="_blank" rel="noopener noreferrer" class="btn btn-accent" style="padding:10px 22px; border-radius:10px;">
                    <i class="ph-bold ph-arrow-square-out"></i> মূল ওয়েবসাইট ভিজিট করুন
                </a>
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
        <div class="cta-container">
            <h2>আজই আপনার টাইপিং প্রস্তুতি এক ধাপ এগিয়ে নিন</h2>
            <p>হাজারো সরকারি চাকরিপ্রার্থীর পছন্দের টাইপিং পোর্টালে যুক্ত হয়ে নিজের গতি ও নির্ভুলতা যাচাই করুন।</p>
            <a href="{{ route('register') }}" class="cta-btn-glow">
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
                        <a href="#" class="footer-social-btn" title="Facebook"><i class="ph ph-facebook-logo"></i></a>
                        <a href="#" class="footer-social-btn" title="YouTube"><i class="ph ph-youtube-logo"></i></a>
                        <a href="#" class="footer-social-btn" title="Telegram"><i class="ph ph-telegram-logo"></i></a>
                        <a href="#" class="footer-social-btn" title="WhatsApp"><i class="ph ph-whatsapp-logo"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h4>গুরুত্বপূর্ণ ল্যাব</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('login') }}"><i class="ph ph-caret-right" style="font-size:0.8rem; color:var(--primary-light);"></i> BCC স্পেশাল ল্যাব</a></li>
                        <li><a href="{{ route('login') }}"><i class="ph ph-caret-right" style="font-size:0.8rem; color:var(--primary-light);"></i> হাইকোর্ট ও জজকোর্ট ল্যাব</a></li>
                        <li><a href="{{ route('login') }}"><i class="ph ph-caret-right" style="font-size:0.8rem; color:var(--primary-light);"></i> বুয়েট ও আইবিএ স্ট্যান্ডার্ড</a></li>
                        <li><a href="{{ route('login') }}"><i class="ph ph-caret-right" style="font-size:0.8rem; color:var(--primary-light);"></i> মন্ত্রণালয় ও অধিদপ্তর প্রস্তুতি</a></li>
                        <li><a href="{{ route('login') }}"><i class="ph ph-caret-right" style="font-size:0.8rem; color:var(--primary-light);"></i> শীট মোড প্র্যাকটিস</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>সহায়িকা ও নীতি</h4>
                    <ul class="footer-links">
                        <li><a href="#bcc-rules"><i class="ph ph-caret-right" style="font-size:0.8rem; color:var(--primary-light);"></i> বিসিসি পরীক্ষার নিয়মাবলী</a></li>
                        <li><a href="#pricing"><i class="ph ph-caret-right" style="font-size:0.8rem; color:var(--primary-light);"></i> প্যাকেজ ও সাবস্ক্রিপশন</a></li>
                        <li><a href="#faq"><i class="ph ph-caret-right" style="font-size:0.8rem; color:var(--primary-light);"></i> সচরাচর জিজ্ঞাসিত প্রশ্ন (FAQ)</a></li>
                        <li><a href="#"><i class="ph ph-caret-right" style="font-size:0.8rem; color:var(--primary-light);"></i> গোপনীয়তা নীতি (Privacy Policy)</a></li>
                        <li><a href="#"><i class="ph ph-caret-right" style="font-size:0.8rem; color:var(--primary-light);"></i> শর্তাবলী (Terms of Service)</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4>পেমেন্ট ও সাপোর্ট</h4>
                    <p style="font-size:0.9rem; margin-bottom:0.8rem; color:#8da2be;">সরাসরি বিকাশ, নগদ ও রকেটে ইনস্ট্যান্ট ওয়ালেট রিচার্জ সুবিধা।</p>
                    <div class="footer-payment-icons">
                        <span class="payment-pill"><i class="ph ph-wallet"></i> bKash</span>
                        <span class="payment-pill"><i class="ph ph-wallet"></i> Nagad</span>
                        <span class="payment-pill"><i class="ph ph-wallet"></i> Rocket</span>
                        <span class="payment-pill"><i class="ph ph-bank"></i> Bank</span>
                    </div>
                    <div class="footer-contact-info">
                        <div><i class="ph ph-phone-call" style="color:var(--primary-light);"></i> হেল্পলাইন: <strong>০১৭০০-০০০০০০</strong></div>
                        <div style="margin-top:4px;"><i class="ph ph-envelope" style="color:var(--primary-light);"></i> সাপোর্ট: <strong>support@selftyping.com</strong></div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div>© {{ date('Y') }} <strong>SelfTyping.com</strong>. সর্বস্বত্ব সংরক্ষিত।</div>
                <div>
                    Developed by <a href="https://mrdeveloper.xyz" target="_blank" rel="noopener noreferrer" style="font-weight:700; color:#38bdf8; text-decoration:none; display:inline-flex; align-items:center; gap:4px;">
                        <span>Mr. MR Developer</span>
                        <i class="ph ph-arrow-square-out" style="font-size:0.9rem;"></i>
                    </a>
                </div>
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

        // Live Demo Typing Logic (if demo elements present)
        const demoPassageBox = document.getElementById('demo-passage');
        const demoInput = document.getElementById('demo-input');
        const demoTimeEl = document.getElementById('demo-time');
        const demoWpmEl = document.getElementById('demo-wpm');
        const demoAccEl = document.getElementById('demo-acc');

        if (demoInput && demoPassageBox) {
            initDemo();
        }

        // Live Simulated Speed Counter on Hero Floating Badge
        const heroLiveWpmEl = document.getElementById('hero-live-wpm');
        if (heroLiveWpmEl) {
            let speedSamples = ['৩৮ WPM', '৪২ WPM', '৪৫ WPM', '৪৮ WPM', '৫২ WPM', '৪৬ WPM'];
            let sIdx = 0;
            setInterval(() => {
                sIdx = (sIdx + 1) % speedSamples.length;
                heroLiveWpmEl.innerText = speedSamples[sIdx];
            }, 3000);
        }
    </script>
</body>
</html>
