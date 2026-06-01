<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camisetas Personalizadas | bycolor.es - Diseña tu estilo</title>
    <meta name="description" content="Camisetas personalizadas de calidad en Toledo. Diseña tu camiseta única con tu logo, texto o imagen. Pedidos desde 1 unidad. Envío rápido. ¡Pide tu presupuesto gratis!">
    <meta name="keywords" content="camisetas personalizadas Toledo, camisetas con logo, serigrafía Toledo, impresión camisetas, ropa personalizada Toledo, camisetas empresa Toledo">
    <meta name="author" content="bycolor.es">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://bycolor.es/camisetas-personalizadas">

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/16_16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/32_32.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon/32_32.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        window.contactRoute = '{{ route("contacto.enviar") }}';
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-15CW1FGNLK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-15CW1FGNLK');
    </script>

    <style>
        /* ============================================
           VARIABLES & BASE
        ============================================ */
        :root {
            --coral:    #FF5733;
            --coral-dk: #E04020;
            --navy:     #1A1A2E;
            --navy-lt:  #16213E;
            --gold:     #FFC107;
            --gold-lt:  #FFD54F;
            --mint:     #00C9A7;
            --lavender: #A855F7;
            --white:    #FFFFFF;
            --gray-50:  #F9FAFB;
            --gray-100: #F3F4F6;
            --gray-700: #374151;
            --gray-900: #111827;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--white);
            overflow-x: hidden;
            color: var(--gray-700);
        }

        /* ============================================
           SCROLLBAR
        ============================================ */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--navy); }
        ::-webkit-scrollbar-thumb { background: var(--coral); border-radius: 3px; }

        /* ============================================
           ANIMATIONS
        ============================================ */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50%       { transform: translateY(-15px) rotate(3deg); }
        }
        @keyframes float2 {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50%       { transform: translateY(-10px) rotate(-2deg); }
        }
        @keyframes shimmer {
            0%   { background-position: -200% center; }
            100% { background-position:  200% center; }
        }
        @keyframes pulse-ring {
            0%   { box-shadow: 0 0 0 0 rgba(255,87,51,0.5); }
            70%  { box-shadow: 0 0 0 15px rgba(255,87,51,0); }
            100% { box-shadow: 0 0 0 0 rgba(255,87,51,0); }
        }
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-40px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        @keyframes bounceIn {
            0%   { transform: scale(0.7); opacity: 0; }
            60%  { transform: scale(1.05); opacity: 1; }
            100% { transform: scale(1); }
        }
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }
        @keyframes marquee {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }

        .animate-fade-up    { animation: fadeUp 0.7s ease forwards; }
        .animate-float      { animation: float  4s ease-in-out infinite; }
        .animate-float2     { animation: float2 5s ease-in-out infinite; }
        .animate-spin-slow  { animation: spin-slow 20s linear infinite; }
        .animate-bounce-in  { animation: bounceIn 0.6s ease forwards; }
        .animate-marquee    { animation: marquee 28s linear infinite; }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }

        /* ============================================
           NAVBAR
        ============================================ */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
            background: rgba(26,26,46,0.97);
            backdrop-filter: blur(12px);
            border-bottom: 2px solid rgba(255,87,51,0.3);
            transition: all 0.3s ease;
        }
        .navbar.scrolled {
            background: rgba(26,26,46,1);
            border-bottom-color: var(--coral);
        }
        .nav-logo img {
            height: 44px;
            width: auto;
            transition: transform 0.3s ease;
        }
        .nav-logo img:hover { transform: scale(1.05); }

        .nav-link {
            color: #D1D5DB;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            text-decoration: none;
            padding: 0.4rem 0;
            position: relative;
            transition: color 0.2s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--coral);
            transition: width 0.3s ease;
        }
        .nav-link:hover { color: var(--white); }
        .nav-link:hover::after { width: 100%; }

        .nav-cta {
            background: linear-gradient(135deg, var(--coral), #FF8C42);
            color: white;
            font-weight: 800;
            font-size: 0.85rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            text-decoration: none;
            padding: 0.6rem 1.4rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            animation: pulse-ring 2.5s infinite;
        }
        .nav-cta:hover {
            transform: scale(1.07);
            box-shadow: 0 8px 25px rgba(255,87,51,0.5);
        }

        /* ============================================
           HERO
        ============================================ */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--navy) 0%, #0F3460 50%, #1A1A2E 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding-top: 72px;
        }
        .hero-bg-circle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(255,193,7,0.15);
            border: 1px solid rgba(255,193,7,0.4);
            color: var(--gold);
            font-weight: 700;
            font-size: 0.78rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.4rem 1rem;
            border-radius: 50px;
            margin-bottom: 1.2rem;
        }
        .hero-title {
            font-size: clamp(2.4rem, 7vw, 5.5rem);
            font-weight: 900;
            line-height: 1.05;
            color: var(--white);
            margin-bottom: 1.2rem;
        }
        .hero-title .accent {
            background: linear-gradient(135deg, var(--coral), var(--gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-subtitle {
            font-size: clamp(1rem, 2.5vw, 1.35rem);
            color: #9CA3AF;
            line-height: 1.7;
            max-width: 540px;
            margin-bottom: 2.2rem;
        }
        .hero-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, var(--coral), #FF8C42);
            color: white;
            font-weight: 800;
            font-size: 1rem;
            letter-spacing: 0.05em;
            text-decoration: none;
            padding: 0.9rem 2.2rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 30px rgba(255,87,51,0.4);
        }
        .hero-btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 40px rgba(255,87,51,0.55);
        }
        .hero-btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: transparent;
            color: white;
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            padding: 0.9rem 2.2rem;
            border-radius: 50px;
            border: 2px solid rgba(255,255,255,0.25);
            transition: all 0.3s ease;
        }
        .hero-btn-secondary:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(255,255,255,0.5);
            transform: translateY(-3px);
        }

        /* Tshirt mockup */
        .tshirt-mockup {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .tshirt-svg {
            width: 100%;
            max-width: 440px;
            filter: drop-shadow(0 30px 60px rgba(0,0,0,0.5));
        }

        /* Stats bar */
        .stat-pill {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            backdrop-filter: blur(8px);
            border-radius: 16px;
            padding: 1rem 1.5rem;
            text-align: center;
        }
        .stat-pill .stat-num {
            font-size: 1.7rem;
            font-weight: 900;
            color: var(--white);
            line-height: 1;
        }
        .stat-pill .stat-label {
            font-size: 0.75rem;
            color: #9CA3AF;
            margin-top: 0.2rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        /* ============================================
           MARQUEE STRIP
        ============================================ */
        .marquee-strip {
            background: linear-gradient(135deg, var(--coral), #FF8C42);
            padding: 0.85rem 0;
            overflow: hidden;
            white-space: nowrap;
        }
        .marquee-inner {
            display: inline-flex;
            gap: 2.5rem;
            font-weight: 800;
            font-size: 0.9rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: white;
        }

        /* ============================================
           SECTION SHARED
        ============================================ */
        .section-label {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 800;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--coral);
            margin-bottom: 0.8rem;
        }
        .section-title {
            font-size: clamp(1.9rem, 5vw, 3.2rem);
            font-weight: 900;
            color: var(--navy);
            line-height: 1.15;
        }
        .section-title .highlight {
            position: relative;
            color: var(--coral);
        }
        .section-title .highlight::after {
            content: '';
            position: absolute;
            bottom: 2px;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--coral), var(--gold));
            border-radius: 2px;
        }

        /* ============================================
           HOW IT WORKS
        ============================================ */
        .step-card {
            background: var(--white);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            text-align: center;
            box-shadow: 0 4px 30px rgba(0,0,0,0.07);
            border: 2px solid transparent;
            transition: all 0.35s ease;
            position: relative;
            overflow: hidden;
        }
        .step-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--coral), var(--gold));
            transform: scaleX(0);
            transition: transform 0.35s ease;
        }
        .step-card:hover {
            border-color: rgba(255,87,51,0.2);
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(255,87,51,0.12);
        }
        .step-card:hover::before { transform: scaleX(1); }
        .step-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px; height: 60px;
            background: linear-gradient(135deg, var(--coral), #FF8C42);
            border-radius: 50%;
            font-size: 1.5rem;
            font-weight: 900;
            color: white;
            margin: 0 auto 1.2rem;
            box-shadow: 0 8px 20px rgba(255,87,51,0.35);
        }
        .step-icon {
            font-size: 2.8rem;
            margin-bottom: 1rem;
        }
        .step-title {
            font-size: 1.15rem;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 0.6rem;
        }
        .step-desc {
            font-size: 0.9rem;
            color: #6B7280;
            line-height: 1.6;
        }
        .step-connector {
            display: none;
        }

        /* ============================================
           PRODUCT CARDS
        ============================================ */
        .product-card {
            background: var(--white);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 4px 25px rgba(0,0,0,0.08);
            transition: all 0.35s ease;
            border: 2px solid transparent;
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 60px rgba(0,0,0,0.14);
            border-color: rgba(255,87,51,0.25);
        }
        .product-thumb {
            height: 240px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 6rem;
            position: relative;
            overflow: hidden;
        }
        .product-badge {
            position: absolute;
            top: 12px; right: 12px;
            background: linear-gradient(135deg, var(--coral), #FF8C42);
            color: white;
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.3rem 0.75rem;
            border-radius: 50px;
        }
        .product-body { padding: 1.5rem; }
        .product-name {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 0.3rem;
        }
        .product-desc {
            font-size: 0.82rem;
            color: #9CA3AF;
            margin-bottom: 1rem;
        }
        .product-price {
            font-size: 1.4rem;
            font-weight: 900;
            color: var(--coral);
        }
        .product-price small {
            font-size: 0.75rem;
            font-weight: 500;
            color: #9CA3AF;
        }

        /* ============================================
           CUSTOMIZATION / FEATURES
        ============================================ */
        .feature-row {
            display: grid;
            gap: 1.5rem;
        }
        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1.2rem 1.5rem;
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            border-left: 4px solid var(--coral);
            transition: all 0.3s ease;
        }
        .feature-item:hover {
            transform: translateX(6px);
            box-shadow: 0 8px 30px rgba(255,87,51,0.1);
        }
        .feature-icon {
            font-size: 1.6rem;
            flex-shrink: 0;
            margin-top: 0.1rem;
        }
        .feature-text h4 {
            font-weight: 800;
            color: var(--navy);
            font-size: 0.95rem;
            margin-bottom: 0.2rem;
        }
        .feature-text p {
            font-size: 0.82rem;
            color: #6B7280;
            line-height: 1.5;
            margin: 0;
        }

        /* Dark customization panel */
        .custom-panel {
            background: linear-gradient(135deg, var(--navy) 0%, #0F3460 100%);
            border-radius: 28px;
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
        }
        .custom-panel::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 200px; height: 200px;
            background: rgba(255,87,51,0.12);
            border-radius: 50%;
        }
        .custom-panel::after {
            content: '';
            position: absolute;
            bottom: -40px; left: -40px;
            width: 140px; height: 140px;
            background: rgba(255,193,7,0.08);
            border-radius: 50%;
        }

        /* Color swatches */
        .swatch-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.8rem;
        }
        .swatch {
            width: 32px; height: 32px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid rgba(255,255,255,0.2);
            transition: all 0.2s ease;
            position: relative;
        }
        .swatch:hover, .swatch.active {
            transform: scale(1.2);
            border-color: white;
        }
        .swatch.active::after {
            content: '✓';
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 900;
            color: white;
        }

        /* ============================================
           TESTIMONIALS
        ============================================ */
        .testimonial-card {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 25px rgba(0,0,0,0.07);
            border: 1px solid #F3F4F6;
            transition: all 0.35s ease;
            height: 100%;
        }
        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        }
        .stars { color: var(--gold); font-size: 1.1rem; letter-spacing: 0.1em; }
        .testimonial-text {
            font-size: 0.95rem;
            color: #374151;
            line-height: 1.7;
            margin: 1rem 0;
            font-style: italic;
        }
        .testimonial-author { font-weight: 800; color: var(--navy); font-size: 0.9rem; }
        .testimonial-role { font-size: 0.78rem; color: #9CA3AF; }
        .testimonial-avatar {
            width: 44px; height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        /* ============================================
           PRICING
        ============================================ */
        .price-card {
            background: var(--white);
            border-radius: 24px;
            padding: 2.5rem 2rem;
            box-shadow: 0 4px 30px rgba(0,0,0,0.08);
            border: 2px solid #F3F4F6;
            transition: all 0.35s ease;
            position: relative;
        }
        .price-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 60px rgba(0,0,0,0.13);
        }
        .price-card.featured {
            background: linear-gradient(135deg, var(--navy), #0F3460);
            border-color: var(--coral);
            color: white;
            transform: scale(1.03);
        }
        .price-card.featured:hover {
            transform: scale(1.03) translateY(-6px);
        }
        .price-card .price-badge {
            position: absolute;
            top: -14px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, var(--coral), #FF8C42);
            color: white;
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.35rem 1.2rem;
            border-radius: 50px;
            white-space: nowrap;
        }
        .price-name {
            font-size: 1.1rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 0.8rem;
        }
        .price-amount {
            font-size: 2.8rem;
            font-weight: 900;
            line-height: 1;
        }
        .price-unit { font-size: 0.85rem; font-weight: 500; color: #9CA3AF; }
        .price-card.featured .price-unit { color: #9CA3AF; }
        .price-feature {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.88rem;
            padding: 0.4rem 0;
        }
        .price-feature .check {
            width: 20px; height: 20px;
            background: rgba(0, 201, 167, 0.15);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--mint);
            font-size: 0.65rem;
            font-weight: 900;
            flex-shrink: 0;
        }
        .price-card.featured .price-feature { color: #D1D5DB; }
        .price-card.featured .price-feature .check {
            background: rgba(0,201,167,0.25);
        }

        /* ============================================
           CTA BAND
        ============================================ */
        .cta-band {
            background: linear-gradient(135deg, var(--coral) 0%, #FF8C42 50%, var(--gold) 100%);
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }
        .cta-band::before {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 300px; height: 300px;
            background: rgba(255,255,255,0.08);
            border-radius: 50%;
        }

        /* ============================================
           CONTACT FORM
        ============================================ */
        .contact-section {
            background: linear-gradient(135deg, var(--navy) 0%, #0F3460 100%);
        }
        .contact-input, .contact-select, .contact-textarea {
            width: 100%;
            padding: 0.8rem 1.1rem;
            background: rgba(255,255,255,0.07);
            border: 2px solid rgba(255,255,255,0.12);
            border-radius: 12px;
            color: white;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.25s ease;
            appearance: none;
            -webkit-appearance: none;
        }
        .contact-input::placeholder,
        .contact-textarea::placeholder { color: rgba(255,255,255,0.35); }
        .contact-input:focus,
        .contact-select:focus,
        .contact-textarea:focus {
            outline: none;
            border-color: var(--coral);
            background: rgba(255,255,255,0.1);
            box-shadow: 0 0 0 3px rgba(255,87,51,0.2);
        }
        .contact-select option { background: var(--navy); color: white; }
        .contact-textarea { min-height: 130px; resize: vertical; }
        .contact-label {
            display: block;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.6);
            margin-bottom: 0.45rem;
        }
        .contact-submit {
            width: 100%;
            background: linear-gradient(135deg, var(--coral), #FF8C42);
            color: white;
            font-weight: 800;
            font-size: 1rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 1rem;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(255,87,51,0.4);
        }
        .contact-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 14px 35px rgba(255,87,51,0.55);
        }
        .contact-submit:disabled { opacity: 0.55; cursor: not-allowed; }

        /* ============================================
           WHATSAPP FLOAT
        ============================================ */
        .whatsapp-float {
            position: fixed;
            bottom: 1.8rem;
            right: 1.8rem;
            z-index: 999;
            background: #25D366;
            color: white;
            width: 58px; height: 58px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 6px 25px rgba(37,211,102,0.55);
            transition: all 0.3s ease;
            animation: pulse-ring 2.5s infinite;
        }
        .whatsapp-float:hover {
            transform: scale(1.12);
            box-shadow: 0 10px 35px rgba(37,211,102,0.7);
        }

        /* ============================================
           MOBILE MENU
        ============================================ */
        #mobileMenu {
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.4s ease, padding 0.3s ease;
        }
        #mobileMenu.open {
            max-height: 400px;
        }

        /* ============================================
           FOOTER
        ============================================ */
        .footer {
            background: var(--gray-900);
            color: #9CA3AF;
        }
        .footer-logo img { height: 40px; width: auto; }

        /* ============================================
           UTILS
        ============================================ */
        .gradient-text {
            background: linear-gradient(135deg, var(--coral), var(--gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .bg-dots {
            background-image: radial-gradient(circle, rgba(255,87,51,0.15) 1px, transparent 1px);
            background-size: 28px 28px;
        }

        /* ============================================
           INTERSECTION OBSERVER ANIMATIONS
        ============================================ */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .reveal-left {
            opacity: 0;
            transform: translateX(-28px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }
        .reveal-left.visible {
            opacity: 1;
            transform: translateX(0);
        }
        .reveal-right {
            opacity: 0;
            transform: translateX(28px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }
        .reveal-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        /* ============================================
           RESPONSIVE
        ============================================ */
        @media (min-width: 768px) {
            .step-connector { display: flex; align-items: center; justify-content: center; }
        }
    </style>
</head>
<body>

    <!-- ======================================================
         WHATSAPP FLOAT
    ====================================================== -->
    <a href="https://wa.me/34600646123?text=Hola%20bycolor,%20quiero%20información%20sobre%20camisetas%20personalizadas"
       class="whatsapp-float" target="_blank" rel="noopener noreferrer" title="Contactar por WhatsApp">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.531 3.485"/>
        </svg>
    </a>

    <!-- ======================================================
         NAVBAR
    ====================================================== -->
    <nav class="navbar" id="navbar">
        <div style="max-width:1200px; margin:0 auto; padding:0 1.25rem;">
            <div style="display:flex; justify-content:space-between; align-items:center; height:68px;">

                <!-- Logo -->
                <a href="#" class="nav-logo" style="text-decoration:none; display:flex; align-items:center;">
                    <img src="{{ asset('images/casos-exito/logo_bycolor.png') }}" alt="bycolor.es - Camisetas Personalizadas" />
                </a>

                <!-- Desktop nav -->
                <div style="display:none; gap:2rem; align-items:center;" class="desktop-nav">
                    <a href="#como-funciona" class="nav-link">Cómo funciona</a>
                    <a href="#productos" class="nav-link">Productos</a>
                    <a href="#personalizacion" class="nav-link">Personalización</a>
                    <a href="#precios" class="nav-link">Precios</a>
                    <a href="#pedido" class="nav-cta">Pedir Ahora</a>
                </div>

                <!-- Mobile button -->
                <button onclick="toggleMenu()" id="menuBtn"
                    style="background:rgba(255,87,51,0.15); border:1px solid rgba(255,87,51,0.4); border-radius:10px; padding:0.5rem; color:white; cursor:pointer; display:flex; align-items:center; justify-content:center;"
                    aria-label="Abrir menú">
                    <svg id="iconMenu" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="iconClose" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="display:none;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile menu -->
            <div id="mobileMenu" style="border-top:1px solid rgba(255,255,255,0.08);">
                <div style="padding:1rem 0; display:flex; flex-direction:column; gap:0.25rem;">
                    <a href="#como-funciona" class="nav-link" onclick="toggleMenu()" style="padding:0.7rem 0.5rem; font-size:0.95rem;">Cómo funciona</a>
                    <a href="#productos" class="nav-link" onclick="toggleMenu()" style="padding:0.7rem 0.5rem; font-size:0.95rem;">Productos</a>
                    <a href="#personalizacion" class="nav-link" onclick="toggleMenu()" style="padding:0.7rem 0.5rem; font-size:0.95rem;">Personalización</a>
                    <a href="#precios" class="nav-link" onclick="toggleMenu()" style="padding:0.7rem 0.5rem; font-size:0.95rem;">Precios</a>
                    <a href="#pedido" onclick="toggleMenu()"
                       style="display:block; background:linear-gradient(135deg,#FF5733,#FF8C42); color:white; font-weight:800; text-decoration:none; padding:0.8rem 1.2rem; border-radius:50px; text-align:center; margin-top:0.5rem; font-size:0.9rem; letter-spacing:0.05em;">
                        🛒 Pedir Ahora
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ======================================================
         HERO
    ====================================================== -->
    <section class="hero" id="inicio">
        <!-- Background circles -->
        <div class="hero-bg-circle" style="width:600px;height:600px;background:radial-gradient(circle,rgba(255,87,51,0.1),transparent 70%);top:-200px;right:-200px;"></div>
        <div class="hero-bg-circle" style="width:400px;height:400px;background:radial-gradient(circle,rgba(0,201,167,0.08),transparent 70%);bottom:-100px;left:-100px;"></div>
        <div class="hero-bg-circle animate-spin-slow" style="width:300px;height:300px;border:1px solid rgba(255,193,7,0.1);top:20%;left:10%;pointer-events:none;"></div>

        <div style="max-width:1200px;margin:0 auto;padding:3rem 1.25rem;width:100%;">
            <div style="display:grid;grid-template-columns:1fr;gap:3rem;align-items:center;">

                <!-- Left content -->
                <div class="animate-fade-up">
                    <div class="hero-badge">
                        <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        Calidad premium · Entrega rápida
                    </div>

                    <h1 class="hero-title">
                        Tu diseño,<br>
                        <span class="accent">tu camiseta.</span><br>
                        <span style="font-size:0.65em;color:#9CA3AF;font-weight:700;">100% personalizada.</span>
                    </h1>

                    <p class="hero-subtitle">
                        Creamos camisetas personalizadas con tu logo, texto o imagen. 
                        Perfectas para empresas, eventos, equipos y regalos únicos.
                        Desde 1 unidad, calidad garantizada.
                    </p>

                    <div style="display:flex;flex-wrap:wrap;gap:1rem;margin-bottom:3rem;">
                        <a href="#pedido" class="hero-btn-primary">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                            Pedir mi diseño
                        </a>
                        <a href="#como-funciona" class="hero-btn-secondary">
                            Cómo funciona
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                    </div>

                    <!-- Stats -->
                    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:0.75rem;">
                        <div class="stat-pill">
                            <div class="stat-num gradient-text">+500</div>
                            <div class="stat-label">Pedidos</div>
                        </div>
                        <div class="stat-pill">
                            <div class="stat-num" style="color:var(--gold);">24h</div>
                            <div class="stat-label">Respuesta</div>
                        </div>
                        <div class="stat-pill">
                            <div class="stat-num" style="color:var(--mint);">100%</div>
                            <div class="stat-label">Satisfacción</div>
                        </div>
                    </div>
                </div>

                <!-- Right: T-shirt visual -->
                <div class="tshirt-mockup animate-float delay-200" style="display:none;" id="heroImage">
                    <svg class="tshirt-svg" viewBox="0 0 480 480" xmlns="http://www.w3.org/2000/svg">
                        <!-- Glow -->
                        <defs>
                            <radialGradient id="glow" cx="50%" cy="50%" r="50%">
                                <stop offset="0%" stop-color="#FF5733" stop-opacity="0.3"/>
                                <stop offset="100%" stop-color="transparent"/>
                            </radialGradient>
                            <filter id="shadow">
                                <feDropShadow dx="0" dy="20" stdDeviation="25" flood-color="#000" flood-opacity="0.4"/>
                            </filter>
                            <linearGradient id="shirtGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#FF5733"/>
                                <stop offset="100%" stop-color="#FF8C42"/>
                            </linearGradient>
                        </defs>
                        <ellipse cx="240" cy="350" rx="180" ry="40" fill="url(#glow)" opacity="0.6"/>

                        <!-- T-shirt body -->
                        <g filter="url(#shadow)">
                            <!-- Left sleeve -->
                            <path d="M80 110 L30 180 L90 210 L120 160 Z" fill="url(#shirtGrad)" stroke="rgba(0,0,0,0.1)" stroke-width="1"/>
                            <!-- Right sleeve -->
                            <path d="M400 110 L450 180 L390 210 L360 160 Z" fill="url(#shirtGrad)" stroke="rgba(0,0,0,0.1)" stroke-width="1"/>
                            <!-- Body -->
                            <path d="M120 90 L80 110 L120 160 L110 380 L370 380 L360 160 L400 110 L360 90 Q330 70 300 80 Q270 130 240 130 Q210 130 180 80 Q150 70 120 90 Z" fill="url(#shirtGrad)" stroke="rgba(0,0,0,0.08)" stroke-width="1.5"/>
                        </g>

                        <!-- Design area on shirt -->
                        <g opacity="0.95">
                            <!-- Collar highlight -->
                            <path d="M200 95 Q240 145 280 95" fill="none" stroke="rgba(255,255,255,0.3)" stroke-width="2"/>

                            <!-- Center logo/design area -->
                            <rect x="170" y="185" width="140" height="140" rx="12" fill="rgba(255,255,255,0.12)" stroke="rgba(255,255,255,0.25)" stroke-width="1.5" stroke-dasharray="6,4"/>

                            <!-- Star icon inside -->
                            <text x="240" y="255" text-anchor="middle" font-size="52" fill="rgba(255,255,255,0.9)">★</text>
                            <text x="240" y="295" text-anchor="middle" font-size="14" font-weight="700" fill="rgba(255,255,255,0.7)" font-family="system-ui" letter-spacing="3">TU LOGO</text>
                        </g>

                        <!-- Decorative dots -->
                        <circle cx="155" cy="155" r="4" fill="rgba(255,255,255,0.4)"/>
                        <circle cx="325" cy="155" r="4" fill="rgba(255,255,255,0.4)"/>
                        <circle cx="145" cy="200" r="3" fill="rgba(255,255,255,0.25)"/>
                    </svg>

                    <!-- Floating tags -->
                    <div class="animate-bounce-in delay-400" style="position:absolute;top:5%;right:-5%;background:rgba(26,26,46,0.9);backdrop-filter:blur(12px);border:1px solid rgba(255,87,51,0.4);border-radius:14px;padding:0.6rem 1rem;white-space:nowrap;">
                        <div style="font-size:0.7rem;font-weight:800;color:var(--coral);letter-spacing:0.1em;">CALIDAD</div>
                        <div style="font-size:0.7rem;color:#9CA3AF;">100% Algodón</div>
                    </div>
                    <div class="animate-bounce-in delay-300" style="position:absolute;bottom:15%;left:-5%;background:rgba(26,26,46,0.9);backdrop-filter:blur(12px);border:1px solid rgba(255,193,7,0.4);border-radius:14px;padding:0.6rem 1rem;white-space:nowrap;">
                        <div style="font-size:0.7rem;font-weight:800;color:var(--gold);letter-spacing:0.1em;">PRECIO</div>
                        <div style="font-size:0.7rem;color:#9CA3AF;">Desde 12€/ud</div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ======================================================
         MARQUEE STRIP
    ====================================================== -->
    <div class="marquee-strip" aria-hidden="true">
        <div class="animate-marquee">
            <span class="marquee-inner">
                <span>👕 Camisetas personalizadas</span>
                <span>⚡ Entrega rápida</span>
                <span>🎨 Tu diseño, tu estilo</span>
                <span>✅ Desde 1 unidad</span>
                <span>🏆 Calidad premium</span>
                <span>🖨️ Impresión de alta definición</span>
                <span>📦 Envío a toda España</span>
                <span>💼 Para empresas y eventos</span>
                <span>👕 Camisetas personalizadas</span>
                <span>⚡ Entrega rápida</span>
                <span>🎨 Tu diseño, tu estilo</span>
                <span>✅ Desde 1 unidad</span>
                <span>🏆 Calidad premium</span>
                <span>🖨️ Impresión de alta definición</span>
                <span>📦 Envío a toda España</span>
                <span>💼 Para empresas y eventos</span>
            </span>
        </div>
    </div>

    <!-- ======================================================
         CÓMO FUNCIONA
    ====================================================== -->
    <section id="como-funciona" style="padding:5rem 0; background:var(--gray-50);">
        <div style="max-width:1200px;margin:0 auto;padding:0 1.25rem;">
            <div class="reveal" style="text-align:center;margin-bottom:3.5rem;">
                <span class="section-label">Proceso simple</span>
                <h2 class="section-title">¿Cómo funciona?</h2>
                <p style="color:#6B7280;margin-top:0.8rem;max-width:500px;margin-left:auto;margin-right:auto;font-size:0.95rem;line-height:1.7;">
                    En solo 3 pasos tienes tus camisetas personalizadas listas para lucir
                </p>
            </div>

            <div style="display:grid;grid-template-columns:1fr;gap:1.5rem;" class="steps-grid">
                <div class="step-card reveal delay-100">
                    <div class="step-icon">🎨</div>
                    <div class="step-number">1</div>
                    <div class="step-title">Diseña o envíanos tu idea</div>
                    <p class="step-desc">Compártenos tu logo, texto o imagen. Si no tienes diseño, nuestro equipo creativo te ayuda a crearlo sin coste adicional.</p>
                </div>
                <div class="step-card reveal delay-200">
                    <div class="step-icon">✅</div>
                    <div class="step-number">2</div>
                    <div class="step-title">Confirmamos y producimos</div>
                    <p class="step-desc">Te enviamos una prueba digital para aprobación. Tras tu visto bueno, producimos tus camisetas con materiales de primera calidad.</p>
                </div>
                <div class="step-card reveal delay-300">
                    <div class="step-icon">🚀</div>
                    <div class="step-number">3</div>
                    <div class="step-title">Recibe tu pedido</div>
                    <p class="step-desc">Enviamos a toda España. También puedes recoger en Toledo. Packaging cuidado para que lleguen perfectas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ======================================================
         PRODUCTOS
    ====================================================== -->
    <section id="productos" style="padding:5rem 0; background:white;">
        <div style="max-width:1200px;margin:0 auto;padding:0 1.25rem;">
            <div class="reveal" style="text-align:center;margin-bottom:3.5rem;">
                <span class="section-label">Catálogo</span>
                <h2 class="section-title">Nuestros <span class="highlight">productos</span></h2>
                <p style="color:#6B7280;margin-top:0.8rem;max-width:520px;margin-left:auto;margin-right:auto;font-size:0.95rem;line-height:1.7;">
                    Amplia selección de prendas personalizables para cada ocasión
                </p>
            </div>

            <div style="display:grid;grid-template-columns:1fr;gap:1.5rem;" class="products-grid">

                <div class="product-card reveal delay-100">
                    <div class="product-thumb" style="background:linear-gradient(135deg,#FF5733,#FF8C42);">
                        <span>👕</span>
                        <span class="product-badge">Más vendida</span>
                    </div>
                    <div class="product-body">
                        <div class="product-name">Camiseta Básica Premium</div>
                        <div class="product-desc">100% algodón peinado 180g. Cuello redondo. Disponible en 20 colores.</div>
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <div class="product-price">Desde 12€ <small>/ unidad</small></div>
                            <a href="#pedido" style="background:linear-gradient(135deg,#FF5733,#FF8C42);color:white;font-weight:700;font-size:0.78rem;text-decoration:none;padding:0.45rem 1rem;border-radius:50px;transition:all 0.2s;">Pedir</a>
                        </div>
                    </div>
                </div>

                <div class="product-card reveal delay-200">
                    <div class="product-thumb" style="background:linear-gradient(135deg,#0F3460,#1A1A2E);">
                        <span>👔</span>
                        <span class="product-badge">Empresas</span>
                    </div>
                    <div class="product-body">
                        <div class="product-name">Polo Corporativo</div>
                        <div class="product-desc">Piqué 220g. Bordado o impresión. Ideal para uniformes de empresa.</div>
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <div class="product-price">Desde 18€ <small>/ unidad</small></div>
                            <a href="#pedido" style="background:linear-gradient(135deg,#0F3460,#1A1A2E);color:white;font-weight:700;font-size:0.78rem;text-decoration:none;padding:0.45rem 1rem;border-radius:50px;transition:all 0.2s;">Pedir</a>
                        </div>
                    </div>
                </div>

                <div class="product-card reveal delay-300">
                    <div class="product-thumb" style="background:linear-gradient(135deg,#00C9A7,#0F9D8A);">
                        <span>🧥</span>
                        <span class="product-badge">Nuevo</span>
                    </div>
                    <div class="product-body">
                        <div class="product-name">Sudadera con Capucha</div>
                        <div class="product-desc">Algodón fleece 320g. Impresión full-color o serigrafía. 12 colores.</div>
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <div class="product-price">Desde 28€ <small>/ unidad</small></div>
                            <a href="#pedido" style="background:linear-gradient(135deg,#00C9A7,#0F9D8A);color:white;font-weight:700;font-size:0.78rem;text-decoration:none;padding:0.45rem 1rem;border-radius:50px;transition:all 0.2s;">Pedir</a>
                        </div>
                    </div>
                </div>

                <div class="product-card reveal delay-400">
                    <div class="product-thumb" style="background:linear-gradient(135deg,#A855F7,#7C3AED);">
                        <span>🎽</span>
                    </div>
                    <div class="product-body">
                        <div class="product-name">Camiseta Técnica Sport</div>
                        <div class="product-desc">Tejido transpirable 140g. Sublimación full-color. Ideal para equipos deportivos.</div>
                        <div style="display:flex;justify-content:space-between;align-items:center;">
                            <div class="product-price">Desde 14€ <small>/ unidad</small></div>
                            <a href="#pedido" style="background:linear-gradient(135deg,#A855F7,#7C3AED);color:white;font-weight:700;font-size:0.78rem;text-decoration:none;padding:0.45rem 1rem;border-radius:50px;transition:all 0.2s;">Pedir</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="reveal" style="text-align:center;margin-top:2.5rem;">
                <p style="color:#6B7280;font-size:0.9rem;">¿Buscas algo diferente? <a href="#pedido" style="color:var(--coral);font-weight:700;text-decoration:none;">Cuéntanos tu idea →</a></p>
            </div>
        </div>
    </section>

    <!-- ======================================================
         PERSONALIZACIÓN
    ====================================================== -->
    <section id="personalizacion" style="padding:5rem 0; background:var(--gray-50);">
        <div style="max-width:1200px;margin:0 auto;padding:0 1.25rem;">
            <div class="reveal" style="text-align:center;margin-bottom:3.5rem;">
                <span class="section-label">Sin límites</span>
                <h2 class="section-title">Personalización <span class="highlight">total</span></h2>
                <p style="color:#6B7280;margin-top:0.8rem;max-width:500px;margin-left:auto;margin-right:auto;font-size:0.95rem;line-height:1.7;">
                    Cada detalle a tu medida. Desde la talla hasta la técnica de impresión.
                </p>
            </div>

            <div style="display:grid;grid-template-columns:1fr;gap:2.5rem;align-items:start;">

                <!-- Features list -->
                <div class="reveal-left">
                    <div class="feature-row">
                        <div class="feature-item">
                            <div class="feature-icon">🎨</div>
                            <div class="feature-text">
                                <h4>Impresión full-color</h4>
                                <p>Reproducimos tu diseño con todos sus colores y degradados con máxima fidelidad. Sin límite de colores.</p>
                            </div>
                        </div>
                        <div class="feature-item" style="border-left-color:#00C9A7;">
                            <div class="feature-icon">🖨️</div>
                            <div class="feature-text">
                                <h4>Serigrafía profesional</h4>
                                <p>Técnica clásica de alta durabilidad. Ideal para pedidos de volumen. Colores vibrantes y larga vida.</p>
                            </div>
                        </div>
                        <div class="feature-item" style="border-left-color:#A855F7;">
                            <div class="feature-icon">🧵</div>
                            <div class="feature-text">
                                <h4>Bordado de alta calidad</h4>
                                <p>Para un acabado premium y profesional. Perfecto para logos corporativos y ropa de empresa.</p>
                            </div>
                        </div>
                        <div class="feature-item" style="border-left-color:#FFC107;">
                            <div class="feature-icon">📐</div>
                            <div class="feature-text">
                                <h4>Tallas XS a 5XL</h4>
                                <p>Disponemos de todas las tallas para que nadie se quede sin su camiseta personalizada.</p>
                            </div>
                        </div>
                        <div class="feature-item" style="border-left-color:#0F3460;">
                            <div class="feature-icon">🌍</div>
                            <div class="feature-text">
                                <h4>Prendas ecológicas</h4>
                                <p>Opción de algodón orgánico certificado GOTS. Moda sostenible sin renunciar a la calidad.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dark panel -->
                <div class="custom-panel reveal-right">
                    <h3 style="font-size:1.4rem;font-weight:900;color:white;margin-bottom:0.5rem;position:relative;z-index:1;">Elige tus colores</h3>
                    <p style="font-size:0.85rem;color:#9CA3AF;margin-bottom:1.5rem;position:relative;z-index:1;">Más de 20 colores disponibles en casi todos nuestros modelos</p>

                    <div style="position:relative;z-index:1;">
                        <div style="font-size:0.75rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(255,255,255,0.5);margin-bottom:0.5rem;">Colores más populares</div>
                        <div class="swatch-grid">
                            <div class="swatch active" style="background:#1A1A2E;" title="Navy"></div>
                            <div class="swatch" style="background:#FF5733;" title="Coral"></div>
                            <div class="swatch" style="background:#FFFFFF;border-color:rgba(255,255,255,0.4);" title="Blanco"></div>
                            <div class="swatch" style="background:#374151;" title="Gris oscuro"></div>
                            <div class="swatch" style="background:#00C9A7;" title="Menta"></div>
                            <div class="swatch" style="background:#FFC107;" title="Amarillo"></div>
                            <div class="swatch" style="background:#A855F7;" title="Lavanda"></div>
                            <div class="swatch" style="background:#EF4444;" title="Rojo"></div>
                            <div class="swatch" style="background:#3B82F6;" title="Azul"></div>
                            <div class="swatch" style="background:#10B981;" title="Verde"></div>
                            <div class="swatch" style="background:#F97316;" title="Naranja"></div>
                            <div class="swatch" style="background:#EC4899;" title="Rosa"></div>
                        </div>
                    </div>

                    <div style="margin-top:2rem;position:relative;z-index:1;">
                        <div style="font-size:0.75rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:rgba(255,255,255,0.5);margin-bottom:0.8rem;">Técnicas disponibles</div>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.6rem;">
                            <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:0.8rem;text-align:center;">
                                <div style="font-size:1.3rem;margin-bottom:0.3rem;">🖨️</div>
                                <div style="font-size:0.72rem;font-weight:700;color:white;">DTG Digital</div>
                                <div style="font-size:0.65rem;color:#9CA3AF;">Desde 1 ud</div>
                            </div>
                            <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:0.8rem;text-align:center;">
                                <div style="font-size:1.3rem;margin-bottom:0.3rem;">🎨</div>
                                <div style="font-size:0.72rem;font-weight:700;color:white;">Serigrafía</div>
                                <div style="font-size:0.65rem;color:#9CA3AF;">Desde 10 uds</div>
                            </div>
                            <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:0.8rem;text-align:center;">
                                <div style="font-size:1.3rem;margin-bottom:0.3rem;">🧵</div>
                                <div style="font-size:0.72rem;font-weight:700;color:white;">Bordado</div>
                                <div style="font-size:0.65rem;color:#9CA3AF;">Desde 5 uds</div>
                            </div>
                            <div style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:0.8rem;text-align:center;">
                                <div style="font-size:1.3rem;margin-bottom:0.3rem;">🌈</div>
                                <div style="font-size:0.72rem;font-weight:700;color:white;">Sublimación</div>
                                <div style="font-size:0.65rem;color:#9CA3AF;">Full color</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ======================================================
         TESTIMONIOS
    ====================================================== -->
    <section style="padding:5rem 0; background:white;">
        <div style="max-width:1200px;margin:0 auto;padding:0 1.25rem;">
            <div class="reveal" style="text-align:center;margin-bottom:3.5rem;">
                <span class="section-label">Lo que dicen de nosotros</span>
                <h2 class="section-title">Clientes <span class="highlight">felices</span></h2>
            </div>

            <div style="display:grid;grid-template-columns:1fr;gap:1.5rem;" class="testimonials-grid">

                <div class="testimonial-card reveal delay-100">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">"Pedimos 50 camisetas para nuestro equipo de empresa y el resultado fue espectacular. El diseño quedó exactamente como lo queríamos. ¡Repetiremos!"</p>
                    <div style="display:flex;align-items:center;gap:0.75rem;">
                        <div class="testimonial-avatar" style="background:linear-gradient(135deg,#FF5733,#FF8C42);">😊</div>
                        <div>
                            <div class="testimonial-author">Carlos M.</div>
                            <div class="testimonial-role">Director comercial · Empresa de construcción</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card reveal delay-200">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">"Necesitaba camisetas para una carrera solidaria y me ayudaron a crear el diseño desde cero. Precio muy competitivo y entrega antes del plazo. 100% recomendados."</p>
                    <div style="display:flex;align-items:center;gap:0.75rem;">
                        <div class="testimonial-avatar" style="background:linear-gradient(135deg,#00C9A7,#0F9D8A);">👩</div>
                        <div>
                            <div class="testimonial-author">Laura G.</div>
                            <div class="testimonial-role">Organizadora de eventos · Toledo</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card reveal delay-300">
                    <div class="stars">★★★★★</div>
                    <p class="testimonial-text">"Llevo 3 años pidiendo las camisetas del club de fútbol aquí. Calidad constante, precio justo y siempre atentos a cada detalle. No cambiaría de proveedor."</p>
                    <div style="display:flex;align-items:center;gap:0.75rem;">
                        <div class="testimonial-avatar" style="background:linear-gradient(135deg,#A855F7,#7C3AED);">⚽</div>
                        <div>
                            <div class="testimonial-author">Miguel Á.</div>
                            <div class="testimonial-role">Presidente · Club deportivo local</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ======================================================
         CTA BAND
    ====================================================== -->
    <div class="cta-band">
        <div style="max-width:900px;margin:0 auto;padding:0 1.25rem;text-align:center;position:relative;z-index:1;">
            <div class="reveal">
                <h2 style="font-size:clamp(1.8rem,5vw,3rem);font-weight:900;color:white;margin-bottom:1rem;line-height:1.15;">
                    ¿Listo para crear tu<br>camiseta perfecta?
                </h2>
                <p style="color:rgba(255,255,255,0.85);font-size:1.05rem;margin-bottom:2rem;">Presupuesto gratis en menos de 24 horas. Sin compromiso.</p>
                <a href="#pedido"
                   style="display:inline-flex;align-items:center;gap:0.5rem;background:white;color:var(--coral);font-weight:900;font-size:1rem;letter-spacing:0.05em;text-decoration:none;padding:1rem 2.5rem;border-radius:50px;box-shadow:0 8px 30px rgba(0,0,0,0.2);transition:all 0.3s ease;">
                    🛒 Solicitar presupuesto gratis
                </a>
            </div>
        </div>
    </div>

    <!-- ======================================================
         PRECIOS
    ====================================================== -->
    <section id="precios" style="padding:5rem 0; background:var(--gray-50);">
        <div style="max-width:1200px;margin:0 auto;padding:0 1.25rem;">
            <div class="reveal" style="text-align:center;margin-bottom:3.5rem;">
                <span class="section-label">Transparencia total</span>
                <h2 class="section-title">Precios <span class="highlight">claros</span></h2>
                <p style="color:#6B7280;margin-top:0.8rem;max-width:500px;margin-left:auto;margin-right:auto;font-size:0.95rem;line-height:1.7;">
                    Sin sorpresas. Cuanto más pides, más ahorras.
                </p>
            </div>

            <div style="display:grid;grid-template-columns:1fr;gap:1.5rem;" class="prices-grid">

                <div class="price-card reveal delay-100">
                    <div class="price-name" style="color:var(--navy);">Básico</div>
                    <div style="margin-bottom:1.2rem;">
                        <span class="price-amount" style="color:var(--coral);">12€</span>
                        <span class="price-unit"> / ud · desde 1 ud</span>
                    </div>
                    <div style="border-top:1px solid #F3F4F6;padding-top:1.2rem;margin-bottom:1.5rem;">
                        <div class="price-feature"><span class="check">✓</span> Camiseta básica 180g</div>
                        <div class="price-feature"><span class="check">✓</span> 1 diseño, 1 zona</div>
                        <div class="price-feature"><span class="check">✓</span> Impresión DTG digital</div>
                        <div class="price-feature"><span class="check">✓</span> 20 colores disponibles</div>
                        <div class="price-feature"><span class="check">✓</span> Prueba digital gratis</div>
                    </div>
                    <a href="#pedido" style="display:block;background:var(--gray-100);color:var(--navy);font-weight:800;font-size:0.9rem;text-decoration:none;padding:0.85rem;border-radius:50px;text-align:center;transition:all 0.25s ease;">Pedir ahora</a>
                </div>

                <div class="price-card featured reveal delay-200">
                    <div class="price-badge">⭐ Más popular</div>
                    <div class="price-name" style="color:var(--gold);">Estándar</div>
                    <div style="margin-bottom:1.2rem;">
                        <span class="price-amount" style="color:white;">9€</span>
                        <span class="price-unit"> / ud · desde 10 uds</span>
                    </div>
                    <div style="border-top:1px solid rgba(255,255,255,0.1);padding-top:1.2rem;margin-bottom:1.5rem;">
                        <div class="price-feature"><span class="check">✓</span> Camiseta calidad media-alta</div>
                        <div class="price-feature"><span class="check">✓</span> 1 diseño, 2 zonas</div>
                        <div class="price-feature"><span class="check">✓</span> Serigrafía o DTG</div>
                        <div class="price-feature"><span class="check">✓</span> Tallas XS a 5XL</div>
                        <div class="price-feature"><span class="check">✓</span> Bolsa de envío incluida</div>
                        <div class="price-feature"><span class="check">✓</span> Diseño asistido gratis</div>
                    </div>
                    <a href="#pedido" style="display:block;background:linear-gradient(135deg,var(--coral),#FF8C42);color:white;font-weight:800;font-size:0.9rem;text-decoration:none;padding:0.85rem;border-radius:50px;text-align:center;box-shadow:0 6px 20px rgba(255,87,51,0.45);transition:all 0.25s ease;">Pedir ahora</a>
                </div>

                <div class="price-card reveal delay-300">
                    <div class="price-name" style="color:var(--navy);">Volumen</div>
                    <div style="margin-bottom:1.2rem;">
                        <span class="price-amount" style="color:var(--coral);">6€</span>
                        <span class="price-unit"> / ud · desde 50 uds</span>
                    </div>
                    <div style="border-top:1px solid #F3F4F6;padding-top:1.2rem;margin-bottom:1.5rem;">
                        <div class="price-feature"><span class="check">✓</span> Prenda premium a elegir</div>
                        <div class="price-feature"><span class="check">✓</span> Diseño complejo, multi-zona</div>
                        <div class="price-feature"><span class="check">✓</span> Todas las técnicas</div>
                        <div class="price-feature"><span class="check">✓</span> Etiquetas personalizadas</div>
                        <div class="price-feature"><span class="check">✓</span> Packaging personalizado</div>
                        <div class="price-feature"><span class="check">✓</span> Gestor de cuenta dedicado</div>
                    </div>
                    <a href="#pedido" style="display:block;background:var(--gray-100);color:var(--navy);font-weight:800;font-size:0.9rem;text-decoration:none;padding:0.85rem;border-radius:50px;text-align:center;transition:all 0.25s ease;">Solicitar oferta</a>
                </div>

            </div>

            <div class="reveal" style="margin-top:2rem;background:linear-gradient(135deg,rgba(255,193,7,0.1),rgba(255,87,51,0.1));border:1px solid rgba(255,193,7,0.3);border-radius:16px;padding:1.5rem;text-align:center;">
                <p style="font-weight:800;color:var(--navy);font-size:0.95rem;margin:0;">
                    🎁 <span style="color:var(--coral);">Diseño gratuito</span> para todos los pedidos · 
                    📦 <span style="color:var(--coral);">Envío gratuito</span> en pedidos +50 uds · 
                    ♻️ Opción <span style="color:var(--coral);">algodón orgánico</span> disponible
                </p>
            </div>
        </div>
    </section>

    <!-- ======================================================
         FORMULARIO DE PEDIDO
    ====================================================== -->
    <section id="pedido" class="contact-section" style="padding:5rem 0;">
        <div style="max-width:1100px;margin:0 auto;padding:0 1.25rem;">
            <div class="reveal" style="text-align:center;margin-bottom:3.5rem;">
                <span style="font-size:0.75rem;font-weight:800;letter-spacing:0.2em;text-transform:uppercase;color:var(--gold);">Empieza hoy</span>
                <h2 style="font-size:clamp(1.9rem,5vw,3rem);font-weight:900;color:white;line-height:1.15;margin-top:0.5rem;">Solicita tu presupuesto <span style="color:var(--coral);">gratis</span></h2>
                <p style="color:#9CA3AF;margin-top:0.8rem;font-size:0.95rem;line-height:1.7;">Te respondemos en menos de 24 horas con tu propuesta personalizada.</p>
            </div>

            <div style="display:grid;grid-template-columns:1fr;gap:2.5rem;align-items:start;">

                <!-- Info column -->
                <div class="reveal-left" style="display:flex;flex-direction:column;gap:1.2rem;">
                    <div style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:20px;padding:1.8rem;">
                        <h3 style="font-size:1.1rem;font-weight:800;color:white;margin-bottom:1.2rem;">📞 Contacto directo</h3>
                        <div style="display:flex;flex-direction:column;gap:0.8rem;">
                            <div>
                                <div style="font-size:0.75rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--gold);">Email</div>
                                <div style="color:#D1D5DB;font-size:0.95rem;margin-top:0.2rem;">att@bycolor.es</div>
                            </div>
                            <div>
                                <div style="font-size:0.75rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--gold);">WhatsApp</div>
                                <div style="color:#D1D5DB;font-size:0.95rem;margin-top:0.2rem;">+34 600 646 123</div>
                            </div>
                            <div>
                                <div style="font-size:0.75rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:var(--gold);">Respuesta</div>
                                <div style="color:#D1D5DB;font-size:0.95rem;margin-top:0.2rem;">En menos de 24 horas</div>
                            </div>
                        </div>
                    </div>

                    <div style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:20px;padding:1.8rem;">
                        <h3 style="font-size:1.1rem;font-weight:800;color:white;margin-bottom:1.2rem;">✅ Lo que incluye el presupuesto</h3>
                        <div style="display:flex;flex-direction:column;gap:0.6rem;">
                            <div style="display:flex;align-items:center;gap:0.6rem;font-size:0.88rem;color:#9CA3AF;">
                                <span style="color:var(--mint);">✓</span> Propuesta de precios detallada
                            </div>
                            <div style="display:flex;align-items:center;gap:0.6rem;font-size:0.88rem;color:#9CA3AF;">
                                <span style="color:var(--mint);">✓</span> Mockup digital de tu diseño
                            </div>
                            <div style="display:flex;align-items:center;gap:0.6rem;font-size:0.88rem;color:#9CA3AF;">
                                <span style="color:var(--mint);">✓</span> Asesoramiento en técnica ideal
                            </div>
                            <div style="display:flex;align-items:center;gap:0.6rem;font-size:0.88rem;color:#9CA3AF;">
                                <span style="color:var(--mint);">✓</span> Plazos de entrega estimados
                            </div>
                            <div style="display:flex;align-items:center;gap:0.6rem;font-size:0.88rem;color:#9CA3AF;">
                                <span style="color:var(--mint);">✓</span> Sin compromiso de compra
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="reveal-right"
                     x-data="contactForm()" x-init="init()"
                     style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:24px;padding:2.5rem;">

                    <div x-show="message && message.length > 0"
                         :class="messageType === 'success' ? 'border-green-400 bg-green-900/30 text-green-300' : 'border-red-400 bg-red-900/30 text-red-300'"
                         class="border rounded-xl px-4 py-3 mb-5 text-sm font-medium"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         style="display:none;">
                        <span x-text="message"></span>
                    </div>

                    @if(session('success'))
                        <div style="background:rgba(0,201,167,0.15);border:1px solid rgba(0,201,167,0.4);color:#6EE7B7;padding:0.8rem 1rem;border-radius:12px;margin-bottom:1.5rem;font-size:0.9rem;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form id="contactoForm" @submit.prevent="submitForm" class="space-y-4">
                        @csrf

                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                            <div>
                                <label class="contact-label">Nombre *</label>
                                <input type="text" name="nombre" required class="contact-input" placeholder="Tu nombre" x-model="formData.nombre">
                                <p x-show="errors.nombre" x-text="errors.nombre" style="color:#FCA5A5;font-size:0.75rem;margin-top:0.3rem;"></p>
                            </div>
                            <div>
                                <label class="contact-label">Teléfono</label>
                                <input type="tel" name="telefono" class="contact-input" placeholder="+34 600 000 000" x-model="formData.telefono">
                            </div>
                        </div>

                        <div>
                            <label class="contact-label">Email *</label>
                            <input type="email" name="email" required class="contact-input" placeholder="tu@email.com" x-model="formData.email">
                            <p x-show="errors.email" x-text="errors.email" style="color:#FCA5A5;font-size:0.75rem;margin-top:0.3rem;"></p>
                        </div>

                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                            <div>
                                <label class="contact-label">Tipo de prenda</label>
                                <select name="paquete" class="contact-select" x-model="formData.paquete">
                                    <option value="">Selecciona</option>
                                    <option value="camiseta-basica">Camiseta básica</option>
                                    <option value="polo">Polo corporativo</option>
                                    <option value="sudadera">Sudadera</option>
                                    <option value="camiseta-sport">Camiseta sport</option>
                                    <option value="personalizado">Otro / No sé aún</option>
                                </select>
                            </div>
                            <div>
                                <label class="contact-label">Cantidad aprox.</label>
                                <select name="cantidad" class="contact-select">
                                    <option value="">Selecciona</option>
                                    <option value="1-9">1 – 9 uds</option>
                                    <option value="10-49">10 – 49 uds</option>
                                    <option value="50-99">50 – 99 uds</option>
                                    <option value="100+">100+ uds</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="contact-label">Cuéntanos tu proyecto *</label>
                            <textarea name="mensaje" required class="contact-textarea"
                                placeholder="Describe tu pedido: colores, zona de impresión, ocasión, fecha límite de entrega, ¿tienes diseño propio?..."
                                x-model="formData.mensaje"></textarea>
                            <p x-show="errors.mensaje" x-text="errors.mensaje" style="color:#FCA5A5;font-size:0.75rem;margin-top:0.3rem;"></p>
                        </div>

                        <button type="submit" class="contact-submit" :disabled="loading">
                            <span x-show="!loading">🎨 Solicitar presupuesto gratis</span>
                            <span x-show="loading" style="display:none;display:flex;align-items:center;justify-content:center;gap:0.5rem;">
                                <svg class="animate-spin" width="18" height="18" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                Enviando...
                            </span>
                        </button>

                        <p style="font-size:0.75rem;color:rgba(255,255,255,0.3);text-align:center;margin-top:0.5rem;">
                            Al enviar aceptas nuestra <a href="/politica-privacidad" style="color:var(--coral);text-decoration:none;">política de privacidad</a>
                        </p>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <!-- ======================================================
         FOOTER
    ====================================================== -->
    <footer class="footer" style="padding:3.5rem 0 1.5rem;">
        <div style="max-width:1200px;margin:0 auto;padding:0 1.25rem;">
            <div style="display:grid;grid-template-columns:1fr;gap:2.5rem;margin-bottom:2.5rem;" class="footer-grid">

                <!-- Brand -->
                <div>
                    <a href="#" class="footer-logo" style="display:inline-block;margin-bottom:1rem;">
                        <img src="{{ asset('images/casos-exito/logo_bycolor.png') }}" alt="bycolor.es">
                    </a>
                    <p style="color:#6B7280;font-size:0.88rem;line-height:1.7;max-width:300px;">
                        Camisetas personalizadas de calidad en Toledo. Diseña tu estilo con nosotros.
                    </p>
                    <div style="display:flex;gap:0.75rem;margin-top:1.2rem;">
                        <a href="https://wa.me/34600646123" target="_blank" rel="noopener noreferrer"
                           style="width:38px;height:38px;background:rgba(255,87,51,0.15);border:1px solid rgba(255,87,51,0.3);border-radius:10px;display:flex;align-items:center;justify-content:center;color:#9CA3AF;text-decoration:none;font-size:1.1rem;transition:all 0.2s;">💬</a>
                        <a href="mailto:att@bycolor.es"
                           style="width:38px;height:38px;background:rgba(255,87,51,0.15);border:1px solid rgba(255,87,51,0.3);border-radius:10px;display:flex;align-items:center;justify-content:center;color:#9CA3AF;text-decoration:none;font-size:1.1rem;transition:all 0.2s;">✉️</a>
                    </div>
                </div>

                <!-- Nav -->
                <div>
                    <h4 style="font-size:0.8rem;font-weight:800;letter-spacing:0.15em;text-transform:uppercase;color:var(--coral);margin-bottom:1rem;">Navegación</h4>
                    <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:0.5rem;">
                        <li><a href="#como-funciona" style="color:#6B7280;text-decoration:none;font-size:0.88rem;transition:color 0.2s;">Cómo funciona</a></li>
                        <li><a href="#productos" style="color:#6B7280;text-decoration:none;font-size:0.88rem;transition:color 0.2s;">Productos</a></li>
                        <li><a href="#personalizacion" style="color:#6B7280;text-decoration:none;font-size:0.88rem;transition:color 0.2s;">Personalización</a></li>
                        <li><a href="#precios" style="color:#6B7280;text-decoration:none;font-size:0.88rem;transition:color 0.2s;">Precios</a></li>
                        <li><a href="#pedido" style="color:#6B7280;text-decoration:none;font-size:0.88rem;transition:color 0.2s;">Solicitar presupuesto</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 style="font-size:0.8rem;font-weight:800;letter-spacing:0.15em;text-transform:uppercase;color:var(--coral);margin-bottom:1rem;">Contacto</h4>
                    <div style="display:flex;flex-direction:column;gap:0.6rem;">
                        <div>
                            <div style="font-size:0.72rem;font-weight:700;color:#4B5563;letter-spacing:0.08em;text-transform:uppercase;">Email</div>
                            <div style="color:#9CA3AF;font-size:0.88rem;margin-top:0.1rem;">att@bycolor.es</div>
                        </div>
                        <div>
                            <div style="font-size:0.72rem;font-weight:700;color:#4B5563;letter-spacing:0.08em;text-transform:uppercase;">WhatsApp</div>
                            <div style="color:#9CA3AF;font-size:0.88rem;margin-top:0.1rem;">+34 600 646 123</div>
                        </div>
                        <div>
                            <div style="font-size:0.72rem;font-weight:700;color:#4B5563;letter-spacing:0.08em;text-transform:uppercase;">Ubicación</div>
                            <div style="color:#9CA3AF;font-size:0.88rem;margin-top:0.1rem;">Toledo, España</div>
                        </div>
                    </div>
                </div>

            </div>

            <div style="border-top:1px solid #1F2937;padding-top:1.5rem;display:flex;flex-direction:column;align-items:center;gap:1rem;text-align:center;">
                <div style="color:#4B5563;font-size:0.8rem;">© 2026 bycolor.es · Todos los derechos reservados</div>
                <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:1rem;">
                    <a href="/terminos-condiciones" style="color:#4B5563;text-decoration:none;font-size:0.78rem;transition:color 0.2s;">Términos y condiciones</a>
                    <a href="/politica-privacidad" style="color:#4B5563;text-decoration:none;font-size:0.78rem;transition:color 0.2s;">Política de privacidad</a>
                    <a href="/cookies" style="color:#4B5563;text-decoration:none;font-size:0.78rem;transition:color 0.2s;">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ======================================================
         SCRIPTS
    ====================================================== -->
    <script>
        /* ── Responsive helpers ── */
        function applyResponsive() {
            const w = window.innerWidth;
            const desktopNav = document.querySelector('.desktop-nav');
            const menuBtn    = document.getElementById('menuBtn');
            const heroImage  = document.getElementById('heroImage');
            const stepsGrid  = document.querySelector('.steps-grid');
            const prodsGrid  = document.querySelector('.products-grid');
            const testimGrid = document.querySelector('.testimonials-grid');
            const pricesGrid = document.querySelector('.prices-grid');
            const footerGrid = document.querySelector('.footer-grid');

            if (w >= 768) {
                if (desktopNav) desktopNav.style.display = 'flex';
                if (menuBtn)    menuBtn.style.display = 'none';
                if (heroImage)  heroImage.style.display = 'flex';
            } else {
                if (desktopNav) desktopNav.style.display = 'none';
                if (menuBtn)    menuBtn.style.display = 'flex';
                if (heroImage)  heroImage.style.display = 'none';
            }

            /* Hero grid */
            const heroGrid = document.querySelector('.hero .hero > div > div') ||
                             document.querySelector('.hero [style*="grid-template-columns"]');
            const heroInner = document.querySelector('.hero > div > div');
            if (heroInner) {
                heroInner.style.gridTemplateColumns = w >= 900 ? '1fr 1fr' : '1fr';
            }

            if (stepsGrid)  stepsGrid.style.gridTemplateColumns  = w >= 900 ? 'repeat(3,1fr)' : w >= 550 ? 'repeat(2,1fr)' : '1fr';
            if (prodsGrid)  prodsGrid.style.gridTemplateColumns  = w >= 900 ? 'repeat(4,1fr)' : w >= 550 ? 'repeat(2,1fr)' : '1fr';
            if (testimGrid) testimGrid.style.gridTemplateColumns = w >= 900 ? 'repeat(3,1fr)' : '1fr';
            if (pricesGrid) pricesGrid.style.gridTemplateColumns = w >= 900 ? 'repeat(3,1fr)' : '1fr';
            if (footerGrid) footerGrid.style.gridTemplateColumns = w >= 900 ? 'repeat(3,1fr)' : w >= 550 ? 'repeat(2,1fr)' : '1fr';

            /* Personalizacion section two-col */
            const customGrid = document.querySelector('#personalizacion > div > div:last-child');
            if (customGrid) {
                customGrid.style.gridTemplateColumns = w >= 900 ? '1fr 1fr' : '1fr';
            }

            /* Contact section two-col */
            const contactGrid = document.querySelector('#pedido > div > div:last-child');
            if (contactGrid) {
                contactGrid.style.gridTemplateColumns = w >= 900 ? '1fr 1.6fr' : '1fr';
            }
        }

        window.addEventListener('resize', applyResponsive);
        applyResponsive();

        /* ── Mobile menu toggle ── */
        function toggleMenu() {
            const menu    = document.getElementById('mobileMenu');
            const iconM   = document.getElementById('iconMenu');
            const iconC   = document.getElementById('iconClose');
            const isOpen  = menu.classList.contains('open');
            menu.classList.toggle('open');
            if (iconM) iconM.style.display = isOpen ? 'block' : 'none';
            if (iconC) iconC.style.display = isOpen ? 'none'  : 'block';
        }

        /* ── Navbar scroll effect ── */
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (navbar) navbar.classList.toggle('scrolled', window.scrollY > 50);
        });

        /* ── Intersection Observer for reveal animations ── */
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => observer.observe(el));

        /* ── Color swatch interaction ── */
        document.querySelectorAll('.swatch').forEach(swatch => {
            swatch.addEventListener('click', () => {
                document.querySelectorAll('.swatch').forEach(s => s.classList.remove('active'));
                swatch.classList.add('active');
            });
        });

        /* ── Alpine.js contact form component ── */
        function contactForm() {
            return {
                formData: { nombre: '', email: '', telefono: '', paquete: '', mensaje: '' },
                errors: {},
                loading: false,
                message: '',
                messageType: '',
                init() {},
                async submitForm() {
                    this.errors  = {};
                    this.message = '';
                    this.loading = true;

                    const form = document.getElementById('contactoForm');
                    const data = new FormData(form);

                    try {
                        const response = await fetch(window.contactRoute, {
                            method: 'POST',
                            body: data,
                            headers: { 'X-Requested-With': 'XMLHttpRequest' }
                        });
                        const result = await response.json();

                        if (response.ok && result.success) {
                            this.message     = result.message || '¡Mensaje enviado! Te contactamos en menos de 24h.';
                            this.messageType = 'success';
                            this.formData    = { nombre: '', email: '', telefono: '', paquete: '', mensaje: '' };
                            form.reset();
                        } else if (result.errors) {
                            this.errors      = result.errors;
                            this.message     = 'Por favor, revisa los campos marcados.';
                            this.messageType = 'error';
                        } else {
                            this.message     = result.message || 'Ha ocurrido un error. Inténtalo de nuevo.';
                            this.messageType = 'error';
                        }
                    } catch {
                        this.message     = 'Error de conexión. Por favor, inténtalo de nuevo.';
                        this.messageType = 'error';
                    } finally {
                        this.loading = false;
                    }
                }
            };
        }
    </script>

</body>
</html>
