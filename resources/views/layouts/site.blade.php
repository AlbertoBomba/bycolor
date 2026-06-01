<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Camisetas Personalizadas | bycolor.es')</title>
    <meta name="description" content="@yield('description', 'Camisetas personalizadas de calidad en Toledo. Tu logo, tu diseño, tu estilo. Desde 1 unidad. Serigrafía, bordado y DTG.')">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    @hasSection('canonical')<link rel="canonical" href="@yield('canonical')">@endif

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/16_16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/32_32.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon/32_32.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>window.contactRoute = '{{ route("contacto.enviar") }}';</script>

    <style>
        /* =========================================
           VARIABLES
        ========================================= */
        :root {
            --coral:    #FF5733;
            --coral-dk: #E04020;
            --navy:     #1A1A2E;
            --navy-lt:  #16213E;
            --gold:     #FFC107;
            --mint:     #00C9A7;
            --white:    #FFFFFF;
            --gray-50:  #F9FAFB;
            --gray-100: #F3F4F6;
            --gray-200: #E5E7EB;
            --gray-400: #9CA3AF;
            --gray-600: #4B5563;
            --gray-700: #374151;
            --gray-900: #111827;
            --radius-sm: 10px;
            --radius:    16px;
            --radius-lg: 24px;
            --shadow-sm: 0 2px 12px rgba(0,0,0,0.06);
            --shadow:    0 4px 25px rgba(0,0,0,0.09);
            --shadow-lg: 0 10px 50px rgba(0,0,0,0.14);
            --shadow-coral: 0 8px 30px rgba(255,87,51,0.35);
        }

        /* =========================================
           RESET / BASE
        ========================================= */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html  { scroll-behavior: smooth; font-size: 16px; }
        body  { font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; background: var(--white); color: var(--gray-700); overflow-x: hidden; padding-top: calc(var(--banner-h, 0px) + 66px); }
        a     { text-decoration: none; color: inherit; }
        img   { max-width: 100%; height: auto; display: block; }
        ul    { list-style: none; }

        ::-webkit-scrollbar       { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--navy); }
        ::-webkit-scrollbar-thumb { background: var(--coral); border-radius: 3px; }

        /* =========================================
           ANIMATIONS
        ========================================= */
        @keyframes fadeUp   { from{opacity:0;transform:translateY(28px)} to{opacity:1;transform:translateY(0)} }
        @keyframes float    { 0%,100%{transform:translateY(0) rotate(0deg)} 50%{transform:translateY(-14px) rotate(2deg)} }
        @keyframes pulse-ring { 0%{box-shadow:0 0 0 0 rgba(255,87,51,.5)} 70%{box-shadow:0 0 0 14px rgba(255,87,51,0)} 100%{box-shadow:0 0 0 0 rgba(255,87,51,0)} }
        @keyframes marquee  { from{transform:translateX(0)} to{transform:translateX(-50%)} }
        @keyframes spinSlow { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }
        @keyframes shimmer  { 0%{opacity:.6} 50%{opacity:1} 100%{opacity:.6} }

        .anim-float   { animation: float    4s ease-in-out infinite; }
        .anim-spin    { animation: spinSlow 22s linear infinite; }
        .anim-marquee { animation: marquee  30s linear infinite; }
        .anim-pulse   { animation: pulse-ring 2.5s infinite; }

        /* =========================================
           REVEAL ON SCROLL
        ========================================= */
        .reveal        { opacity:0; transform:translateY(26px);  transition: opacity .65s ease, transform .65s ease; }
        .reveal-left   { opacity:0; transform:translateX(-26px); transition: opacity .65s ease, transform .65s ease; }
        .reveal-right  { opacity:0; transform:translateX(26px);  transition: opacity .65s ease, transform .65s ease; }
        .reveal.visible, .reveal-left.visible, .reveal-right.visible { opacity:1; transform:translate(0); }
        .delay-1 { transition-delay:.1s; }
        .delay-2 { transition-delay:.2s; }
        .delay-3 { transition-delay:.3s; }
        .delay-4 { transition-delay:.4s; }

        /* =========================================
           LAYOUT UTILITIES
        ========================================= */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1.25rem; }
        .section    { padding: 5rem 0; }
        .section-sm { padding: 3.5rem 0; }
        .section-lg { padding: 7rem 0; }

        /* =========================================
           TYPOGRAPHY UTILITIES
        ========================================= */
        .section-eyebrow {
            display: inline-block;
            font-size: .72rem; font-weight: 800;
            letter-spacing: .18em; text-transform: uppercase;
            color: var(--coral); margin-bottom: .7rem;
        }
        .section-eyebrow.gold  { color: var(--gold); }
        .section-eyebrow.mint  { color: var(--mint); }
        .section-title {
            font-size: clamp(1.8rem, 4.5vw, 3rem);
            font-weight: 900; line-height: 1.12; color: var(--navy);
        }
        .section-title .hl {
            color: var(--coral); position: relative;
        }
        .section-title .hl::after {
            content:''; position:absolute; bottom:2px; left:0; width:100%; height:3px;
            background: linear-gradient(90deg, var(--coral), var(--gold)); border-radius:2px;
        }
        .section-subtitle { font-size:.95rem; color:var(--gray-400); line-height:1.7; max-width:520px; margin-top:.7rem; }

        /* =========================================
           BUTTONS
        ========================================= */
        .btn {
            display: inline-flex; align-items: center; gap: .45rem;
            font-weight: 800; font-size: .9rem; letter-spacing:.04em;
            padding: .8rem 2rem; border-radius: 50px; border: 2px solid transparent;
            cursor: pointer; transition: all .3s ease; text-decoration: none;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--coral), #FF8C42);
            color: white; box-shadow: var(--shadow-coral);
        }
        .btn-primary:hover { transform:translateY(-3px); box-shadow:0 14px 40px rgba(255,87,51,.5); }
        .btn-secondary {
            background: transparent; color: white;
            border-color: rgba(255,255,255,.3);
        }
        .btn-secondary:hover { background:rgba(255,255,255,.08); border-color:rgba(255,255,255,.6); transform:translateY(-3px); }
        .btn-outline {
            background: transparent; color: var(--coral); border-color: var(--coral);
        }
        .btn-outline:hover { background: var(--coral); color: white; transform:translateY(-2px); }
        .btn-navy {
            background: var(--navy); color: white;
        }
        .btn-navy:hover { background: var(--navy-lt); transform:translateY(-2px); box-shadow: var(--shadow); }
        .btn-sm { padding: .55rem 1.3rem; font-size: .78rem; }
        .btn-lg { padding: 1.1rem 2.8rem; font-size: 1rem; }

        /* =========================================
           PAGE HEADER (interior pages)
        ========================================= */
        .page-header {
            background: linear-gradient(135deg, var(--navy) 0%, #0F3460 100%);
            padding: 6rem 0 4rem;
            position: relative; overflow: hidden;
        }
        .page-header::before {
            content:''; position:absolute; top:-80px; right:-80px;
            width:280px; height:280px;
            background:radial-gradient(circle, rgba(255,87,51,.15), transparent 70%);
            border-radius:50%;
        }
        .page-header::after {
            content:''; position:absolute; bottom:-60px; left:-60px;
            width:200px; height:200px;
            background:radial-gradient(circle, rgba(255,193,7,.1), transparent 70%);
            border-radius:50%;
        }
        .page-header h1 { font-size: clamp(2rem,5vw,3.5rem); font-weight:900; color:white; line-height:1.1; }
        .page-header p  { font-size:1rem; color:rgba(255,255,255,.65); margin-top:.8rem; max-width:520px; line-height:1.7; }

        /* Breadcrumb */
        .breadcrumb { display:flex; align-items:center; gap:.4rem; margin-bottom:1.5rem; }
        .breadcrumb a { font-size:.78rem; font-weight:600; color:rgba(255,255,255,.5); letter-spacing:.05em; text-transform:uppercase; transition:color .2s; }
        .breadcrumb a:hover { color:white; }
        .breadcrumb span { font-size:.78rem; color:rgba(255,255,255,.3); }

        /* =========================================
           CARD BASE
        ========================================= */
        .card {
            background: var(--white); border-radius: var(--radius-lg);
            box-shadow: var(--shadow); border: 2px solid transparent;
            overflow: hidden; transition: all .35s ease;
        }
        .card:hover {
            transform: translateY(-7px); box-shadow: var(--shadow-lg);
            border-color: rgba(255,87,51,.2);
        }

        /* =========================================
           BADGE / CHIP
        ========================================= */
        .badge {
            display:inline-flex; align-items:center; gap:.3rem;
            font-size:.7rem; font-weight:800; letter-spacing:.1em; text-transform:uppercase;
            padding:.3rem .85rem; border-radius:50px;
        }
        .badge-coral  { background:rgba(255,87,51,.12); color:var(--coral); border:1px solid rgba(255,87,51,.25); }
        .badge-gold   { background:rgba(255,193,7,.15); color:#B8860B; border:1px solid rgba(255,193,7,.3); }
        .badge-navy   { background:var(--navy); color:white; }
        .badge-mint   { background:rgba(0,201,167,.12); color:var(--mint); border:1px solid rgba(0,201,167,.25); }
        .badge-white  { background:rgba(255,255,255,.15); color:white; border:1px solid rgba(255,255,255,.2); }

        /* =========================================
           FILTER TABS
        ========================================= */
        .filter-tabs { display:flex; flex-wrap:wrap; gap:.5rem; }
        .filter-tab {
            font-size:.78rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase;
            padding:.45rem 1.1rem; border-radius:50px; border:2px solid var(--gray-200);
            background:transparent; color:var(--gray-600); cursor:pointer;
            transition:all .25s ease;
        }
        .filter-tab:hover { border-color:var(--coral); color:var(--coral); }
        .filter-tab.active { background:var(--coral); border-color:var(--coral); color:white; box-shadow:var(--shadow-coral); }

        /* =========================================
           STAT PILL
        ========================================= */
        .stat-pill {
            background:rgba(255,255,255,.07); border:1px solid rgba(255,255,255,.12);
            backdrop-filter:blur(8px); border-radius:var(--radius); padding:1rem 1.4rem; text-align:center;
        }
        .stat-pill .num { font-size:1.6rem; font-weight:900; color:white; line-height:1; }
        .stat-pill .lbl { font-size:.7rem; color:var(--gray-400); margin-top:.2rem; letter-spacing:.07em; text-transform:uppercase; }

        /* =========================================
           WORK CARD
        ========================================= */
        .work-card { background:white; border-radius:var(--radius-lg); overflow:hidden; box-shadow:var(--shadow); transition:all .35s ease; }
        .work-card:hover { transform:translateY(-7px); box-shadow:var(--shadow-lg); }
        .work-card-img { width:100%; height:220px; object-fit:cover; display:block; background:var(--gray-100); }
        .work-card-img-placeholder {
            width:100%; height:220px; display:flex; align-items:center; justify-content:center;
            background:linear-gradient(135deg,var(--gray-100),var(--gray-200)); font-size:3.5rem;
        }
        .work-card-body { padding:1.3rem 1.4rem; }
        .work-card-cat  { font-size:.68rem; font-weight:800; letter-spacing:.12em; text-transform:uppercase; color:var(--coral); margin-bottom:.35rem; }
        .work-card-title { font-size:.98rem; font-weight:800; color:var(--navy); margin-bottom:.4rem; line-height:1.3; }
        .work-card-desc  { font-size:.82rem; color:var(--gray-400); line-height:1.55; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
        .work-card-date  { font-size:.72rem; color:var(--gray-400); margin-top:.7rem; display:flex; align-items:center; gap:.3rem; }

        /* =========================================
           PRODUCT CARD
        ========================================= */
        .product-card { background:white; border-radius:var(--radius-lg); overflow:hidden; box-shadow:var(--shadow); transition:all .35s ease; border:2px solid transparent; }
        .product-card:hover { transform:translateY(-8px); box-shadow:var(--shadow-lg); border-color:rgba(255,87,51,.2); }
        .product-thumb { height:210px; display:flex; align-items:center; justify-content:center; font-size:5.5rem; position:relative; overflow:hidden; }
        .product-tag { position:absolute; top:12px; right:12px; }
        .product-body { padding:1.4rem; }
        .product-name { font-size:1rem; font-weight:800; color:var(--navy); margin-bottom:.3rem; }
        .product-desc { font-size:.82rem; color:var(--gray-400); line-height:1.55; margin-bottom:1rem; }
        .product-price { font-size:1.3rem; font-weight:900; color:var(--coral); }
        .product-price small { font-size:.72rem; font-weight:500; color:var(--gray-400); }

        /* =========================================
           TESTIMONIAL CARD
        ========================================= */
        .testi-card { background:white; border-radius:var(--radius-lg); padding:2rem; box-shadow:var(--shadow); border:1px solid var(--gray-100); transition:all .35s ease; height:100%; }
        .testi-card:hover { transform:translateY(-5px); box-shadow:var(--shadow-lg); }
        .testi-stars  { color:var(--gold); font-size:1rem; letter-spacing:.1em; }
        .testi-text   { font-size:.9rem; color:var(--gray-700); line-height:1.75; margin:1rem 0; font-style:italic; }
        .testi-author { font-weight:800; color:var(--navy); font-size:.88rem; }
        .testi-role   { font-size:.75rem; color:var(--gray-400); }
        .testi-avatar { width:42px; height:42px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:1.2rem; flex-shrink:0; }

        /* =========================================
           MARQUEE STRIP
        ========================================= */
        .marquee-strip { background:linear-gradient(135deg,var(--coral),#FF8C42); padding:.8rem 0; overflow:hidden; white-space:nowrap; }
        .marquee-inner { display:inline-flex; gap:2.5rem; font-weight:800; font-size:.85rem; letter-spacing:.15em; text-transform:uppercase; color:white; }

        /* =========================================
           FORMS (CONTACT)
        ========================================= */
        .form-group { display:flex; flex-direction:column; gap:.4rem; }
        .form-label { font-size:.72rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:rgba(255,255,255,.55); }
        .form-label.dark { color:var(--gray-600); }
        .form-ctrl {
            padding:.8rem 1.1rem; background:rgba(255,255,255,.07); border:2px solid rgba(255,255,255,.12);
            border-radius:var(--radius-sm); color:white; font-size:.9rem; font-weight:500;
            transition:all .25s ease; width:100%;
        }
        .form-ctrl.light { background:var(--gray-50); border-color:var(--gray-200); color:var(--gray-900); }
        .form-ctrl::placeholder { color:rgba(255,255,255,.3); }
        .form-ctrl.light::placeholder { color:var(--gray-400); }
        .form-ctrl:focus { outline:none; border-color:var(--coral); box-shadow:0 0 0 3px rgba(255,87,51,.18); background:rgba(255,255,255,.1); }
        .form-ctrl.light:focus { background:white; }
        textarea.form-ctrl { min-height:120px; resize:vertical; }
        select.form-ctrl option { background:var(--navy); color:white; }
        select.form-ctrl.light option { background:white; color:var(--gray-900); }
        .form-error { font-size:.75rem; color:#FCA5A5; margin-top:.2rem; }
        .form-error.dark { color:#DC2626; }
        .btn-submit {
            width:100%; background:linear-gradient(135deg,var(--coral),#FF8C42); color:white;
            font-weight:800; font-size:.9rem; letter-spacing:.06em; text-transform:uppercase;
            padding:1rem; border-radius:50px; border:none; cursor:pointer;
            transition:all .3s ease; box-shadow:var(--shadow-coral);
        }
        .btn-submit:hover:not(:disabled) { transform:translateY(-2px); box-shadow:0 14px 35px rgba(255,87,51,.55); }
        .btn-submit:disabled { opacity:.5; cursor:not-allowed; }

        /* Alert boxes */
        .alert { padding:.9rem 1.2rem; border-radius:var(--radius-sm); font-size:.88rem; font-weight:600; border:1px solid; margin-bottom:1.2rem; }
        .alert-success { background:rgba(0,201,167,.12); border-color:rgba(0,201,167,.4); color:var(--mint); }
        .alert-error   { background:rgba(239,68,68,.1); border-color:rgba(239,68,68,.35); color:#EF4444; }
        .alert-success.dark { background:#DCFCE7; border-color:#86EFAC; color:#166534; }
        .alert-error.dark   { background:#FEE2E2; border-color:#FCA5A5; color:#991B1B; }

        /* =========================================
           CTA BAND
        ========================================= */
        .cta-band { background:linear-gradient(135deg, var(--coral), #FF8C42, var(--gold)); padding:5rem 0; position:relative; overflow:hidden; text-align:center; }
        .cta-band::before { content:''; position:absolute; top:-70px; right:-70px; width:260px; height:260px; background:rgba(255,255,255,.08); border-radius:50%; }
        .cta-band h2 { font-size:clamp(1.8rem,4vw,3rem); font-weight:900; color:white; margin-bottom:.8rem; }
        .cta-band p  { color:rgba(255,255,255,.85); font-size:1rem; margin-bottom:2rem; }

        /* =========================================
           NAVBAR
        ========================================= */
        .site-nav {
            position:fixed; top:var(--banner-h,0px); width:100%; z-index:200;
            background:rgba(255,255,255,.97); backdrop-filter:blur(14px);
            border-bottom:1px solid rgba(0,0,0,.08);
            transition:all .3s ease;
        }
        .site-nav.scrolled { border-bottom-color:var(--coral); box-shadow:0 2px 20px rgba(0,0,0,.08); }
        .site-nav .inner {
            display:flex; align-items:center; justify-content:space-between;
            height:66px; max-width:1200px; margin:0 auto; padding:0 1.25rem;
        }
        .nav-logo img { height:58px; width:auto; transition:transform .3s; }
        .nav-logo img:hover { transform:scale(1.04); }
        .nav-links { display:none; align-items:center; gap:1.8rem; }
        .nav-link {
            font-size:.82rem; font-weight:700; letter-spacing:.08em; text-transform:uppercase;
            color:var(--navy); position:relative; padding:.3rem 0; transition:color .2s;
        }
        .nav-link::after { content:''; position:absolute; bottom:-2px; left:0; width:0; height:2px; background:var(--coral); transition:width .3s; }
        .nav-link:hover, .nav-link.active { color:var(--coral); }
        .nav-link:hover::after, .nav-link.active::after { width:100%; }
        .nav-cta {
            background:linear-gradient(135deg,var(--coral),#FF8C42); color:white;
            font-size:.8rem; font-weight:800; letter-spacing:.08em; text-transform:uppercase;
            padding:.55rem 1.4rem; border-radius:50px; transition:all .3s; animation:pulse-ring 2.5s infinite;
        }
        .nav-cta:hover { transform:scale(1.06); box-shadow:var(--shadow-coral); }
        .nav-toggle {
            display:flex; flex-direction:column; justify-content:center; gap:5px;
            width:40px; height:40px; background:rgba(255,87,51,.15);
            border:1px solid rgba(255,87,51,.3); border-radius:9px; cursor:pointer;
            padding:8px; transition:all .25s;
        }
        .nav-toggle span { display:block; height:2px; background:var(--navy); border-radius:2px; transition:all .3s; }
        .nav-toggle.open span:nth-child(1) { transform:translateY(7px) rotate(45deg); }
        .nav-toggle.open span:nth-child(2) { opacity:0; }
        .nav-toggle.open span:nth-child(3) { transform:translateY(-7px) rotate(-45deg); }

        /* Mobile nav */
        .mobile-nav { max-height:0; overflow:hidden; transition:max-height .4s ease; border-top:1px solid rgba(0,0,0,.07); background:white; }
        .mobile-nav.open { max-height:400px; }
        .mobile-nav-inner { padding:.8rem 1.25rem 1.2rem; display:flex; flex-direction:column; gap:.2rem; max-width:1200px; margin:0 auto; }
        .mobile-nav-link {
            font-size:.9rem; font-weight:700; letter-spacing:.06em; text-transform:uppercase;
            color:var(--navy); padding:.7rem .5rem;
            border-bottom:1px solid rgba(0,0,0,.06); transition:color .2s;
        }
        .mobile-nav-link:hover, .mobile-nav-link.active { color:var(--coral); }
        .mobile-nav-link:last-of-type { border-bottom:none; }

        /* =========================================
           WHATSAPP FLOAT
        ========================================= */
        .wa-float {
            position:fixed; bottom:1.8rem; right:1.8rem; z-index:999;
            width:56px; height:56px; background:#25D366; color:white; border-radius:50%;
            display:flex; align-items:center; justify-content:center;
            box-shadow:0 6px 25px rgba(37,211,102,.55); transition:all .3s; animation:pulse-ring 2.5s infinite;
        }
        .wa-float:hover { transform:scale(1.12); }

        /* =========================================
           FOOTER
        ========================================= */
        .site-footer { background:var(--gray-900); padding:3.5rem 0 1.5rem; }
        .footer-grid { display:grid; grid-template-columns:1fr; gap:2.5rem; margin-bottom:2.5rem; }
        .footer-brand-logo img { height:38px; width:auto; margin-bottom:1rem; }
        .footer-desc { font-size:.85rem; color:var(--gray-600); line-height:1.7; max-width:280px; }
        .footer-social { display:flex; gap:.6rem; margin-top:1.2rem; }
        .footer-social a {
            width:36px; height:36px; background:rgba(255,87,51,.12);
            border:1px solid rgba(255,87,51,.25); border-radius:9px;
            display:flex; align-items:center; justify-content:center;
            color:var(--gray-600); font-size:1rem; transition:all .2s;
        }
        .footer-social a:hover { background:var(--coral); border-color:var(--coral); color:white; }
        .footer-col-title { font-size:.75rem; font-weight:800; letter-spacing:.15em; text-transform:uppercase; color:var(--coral); margin-bottom:1rem; }
        .footer-links { display:flex; flex-direction:column; gap:.5rem; }
        .footer-links a { font-size:.85rem; color:var(--gray-600); transition:color .2s; }
        .footer-links a:hover { color:white; }
        .footer-contact-item { margin-bottom:.6rem; }
        .footer-contact-item .lbl { font-size:.68rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--gray-600); }
        .footer-contact-item .val { font-size:.85rem; color:var(--gray-400); margin-top:.1rem; }
        .footer-bottom { border-top:1px solid #1F2937; padding-top:1.5rem; display:flex; flex-direction:column; align-items:center; gap:.8rem; text-align:center; }
        .footer-copy  { font-size:.78rem; color:var(--gray-600); }
        .footer-legal { display:flex; flex-wrap:wrap; justify-content:center; gap:1rem; }
        .footer-legal a { font-size:.75rem; color:var(--gray-600); transition:color .2s; }
        .footer-legal a:hover { color:white; }

        /* =========================================
           RESPONSIVE - SHARED
        ========================================= */
        @media (min-width: 640px) {
            .footer-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (min-width: 900px) {
            .nav-links  { display:flex; }
            .nav-toggle { display:none; }
            .footer-grid { grid-template-columns: 2fr 1fr 1fr; }
            .footer-bottom { flex-direction:row; justify-content:space-between; text-align:left; }
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Banner construcción -->
    <div id="construction-banner" style="background:linear-gradient(90deg,#FF5733,#FF8C42);color:white;text-align:center;padding:.65rem 1rem;font-size:.82rem;font-weight:700;line-height:1.5;position:fixed;top:0;left:0;right:0;z-index:1000;">
        🚧 <strong>Web en construcción</strong> · Gracias por tu paciencia.
        <span style="opacity:.85;font-weight:500;"> ¿Necesitas algo?</span>
        <a href="https://wa.me/34600646123?text=Hola%20bycolor,%20os%20escribo%20desde%20la%20web"
           target="_blank" rel="noopener"
           style="display:inline-flex;align-items:center;gap:.3rem;background:rgba(255,255,255,.2);border:1px solid rgba(255,255,255,.4);color:white;text-decoration:none;padding:.2rem .75rem;border-radius:50px;margin-left:.6rem;font-weight:800;transition:background .2s;"
           onmouseover="this.style.background='rgba(255,255,255,.35)'" onmouseout="this.style.background='rgba(255,255,255,.2)'">
            💬 Escríbenos por WhatsApp
        </a>
    </div>

    <!-- WhatsApp -->
    <a href="https://wa.me/34600646123?text=Hola%20bycolor,%20quiero%20información%20sobre%20camisetas%20personalizadas"
       class="wa-float" target="_blank" rel="noopener noreferrer" title="WhatsApp bycolor">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.531 3.485"/>
        </svg>
    </a>

    <!-- Navbar -->
    <nav class="site-nav" id="siteNav">
        <div class="inner">
            <a href="{{ route('home') }}" class="nav-logo">
                <img src="{{ asset('images/casos-exito/logo_bycolor.png') }}" alt="bycolor.es – Camisetas Personalizadas">
            </a>
            <div class="nav-links">
                <a href="{{ route('home') }}"          class="nav-link {{ request()->routeIs('home')        ? 'active' : '' }}">Inicio</a>
                <a href="{{ route('productos') }}"     class="nav-link {{ request()->routeIs('productos')   ? 'active' : '' }}">Productos</a>
                <a href="{{ route('trabajos.index') }}" class="nav-link {{ request()->routeIs('trabajos.*') ? 'active' : '' }}">Trabajos</a>
                <a href="{{ route('contacto') }}"       class="nav-link {{ request()->routeIs('contacto')   ? 'active' : '' }}">Contacto</a>
                <a href="{{ route('contacto') }}" class="nav-cta">Pedir ahora</a>
            </div>
            <button class="nav-toggle" id="navToggle" onclick="toggleNav()" aria-label="Menú">
                <span></span><span></span><span></span>
            </button>
        </div>
        <div class="mobile-nav" id="mobileNav">
            <div class="mobile-nav-inner">
                <a href="{{ route('home') }}"           class="mobile-nav-link {{ request()->routeIs('home')        ? 'active' : '' }}" onclick="toggleNav()">Inicio</a>
                <a href="{{ route('productos') }}"      class="mobile-nav-link {{ request()->routeIs('productos')   ? 'active' : '' }}" onclick="toggleNav()">Productos</a>
                <a href="{{ route('trabajos.index') }}" class="mobile-nav-link {{ request()->routeIs('trabajos.*') ? 'active' : '' }}" onclick="toggleNav()">Trabajos</a>
                <a href="{{ route('contacto') }}"       class="mobile-nav-link {{ request()->routeIs('contacto')   ? 'active' : '' }}" onclick="toggleNav()">Contacto</a>
                <a href="{{ route('contacto') }}" onclick="toggleNav()"
                   style="display:block;background:linear-gradient(135deg,#FF5733,#FF8C42);color:white;font-weight:800;font-size:.85rem;text-decoration:none;padding:.8rem 1.2rem;border-radius:50px;text-align:center;margin-top:.6rem;letter-spacing:.05em;">
                    🛒 Pedir ahora
                </a>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <main style="padding-top:66px;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-brand-logo">
                        <img src="{{ asset('images/casos-exito/logo_bycolor.png') }}" alt="bycolor.es">
                    </div>
                    <p class="footer-desc">Camisetas personalizadas de calidad en Toledo. Tu diseño, tu estilo, tu marca.</p>
                    <div class="footer-social">
                        <a href="https://wa.me/34600646123" target="_blank" rel="noopener noreferrer" title="WhatsApp">💬</a>
                        <a href="mailto:att@bycolor.es" title="Email">✉️</a>
                    </div>
                </div>
                <div>
                    <div class="footer-col-title">Navegación</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Inicio</a></li>
                        <li><a href="{{ route('productos') }}">Productos</a></li>
                        <li><a href="{{ route('trabajos.index') }}">Trabajos realizados</a></li>
                        <li><a href="{{ route('contacto') }}">Contacto</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-col-title">Contacto</div>
                    <div class="footer-contact-item"><div class="lbl">Email</div><div class="val">att@bycolor.es</div></div>
                    <div class="footer-contact-item"><div class="lbl">WhatsApp</div><div class="val">+34 600 646 123</div></div>
                    <div class="footer-contact-item"><div class="lbl">Ubicación</div><div class="val">Toledo, España</div></div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-copy">© {{ date('Y') }} bycolor.es · Todos los derechos reservados</div>
                <div class="footer-legal">
                    <a href="{{ route('terminos') }}">Términos y condiciones</a>
                    <a href="{{ route('privacidad') }}">Privacidad</a>
                    <a href="{{ route('cookies') }}">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-15CW1FGNLK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date()); gtag('config', 'G-15CW1FGNLK');
    </script>

    <script>
        /* ── Banner height ── */
        (function() {
            const banner = document.getElementById('construction-banner');
            if (!banner) return;
            function setBannerH() {
                document.documentElement.style.setProperty('--banner-h', banner.offsetHeight + 'px');
            }
            setBannerH();
            window.addEventListener('resize', setBannerH);
        })();

        /* ── Navbar scroll ── */
        window.addEventListener('scroll', () => {
            document.getElementById('siteNav').classList.toggle('scrolled', window.scrollY > 50);
        });

        /* ── Mobile nav toggle ── */
        function toggleNav() {
            const nav = document.getElementById('mobileNav');
            const btn = document.getElementById('navToggle');
            nav.classList.toggle('open');
            btn.classList.toggle('open');
        }

        /* ── Scroll reveal ── */
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) { e.target.classList.add('visible'); revealObserver.unobserve(e.target); }
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => revealObserver.observe(el));

        /* ── Alpine.js contact form ── */
        function contactForm() {
            return {
                formData: { nombre:'', email:'', telefono:'', paquete:'', mensaje:'' },
                errors: {}, loading: false, message: '', messageType: '',
                init() {},
                async submitForm() {
                    this.errors = {}; this.message = ''; this.loading = true;
                    const form = document.getElementById('contactoForm');
                    const data = new FormData(form);
                    try {
                        const res = await fetch(window.contactRoute, {
                            method:'POST', body:data,
                            headers:{ 'X-Requested-With':'XMLHttpRequest' }
                        });
                        const json = await res.json();
                        if (res.ok && json.success) {
                            this.message = json.message || '¡Mensaje enviado! Te contactamos en menos de 24h.';
                            this.messageType = 'success';
                            this.formData = { nombre:'', email:'', telefono:'', paquete:'', mensaje:'' };
                            form.reset();
                        } else if (json.errors) {
                            this.errors = json.errors;
                            this.message = 'Revisa los campos marcados.';
                            this.messageType = 'error';
                        } else {
                            this.message = json.message || 'Error al enviar. Inténtalo de nuevo.';
                            this.messageType = 'error';
                        }
                    } catch {
                        this.message = 'Error de conexión.'; this.messageType = 'error';
                    } finally { this.loading = false; }
                }
            };
        }
    </script>

    @stack('scripts')
</body>
</html>
