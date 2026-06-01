@extends('layouts.site')

@section('title', 'Camisetas Personalizadas en Toledo | bycolor.es')
@section('description', 'Camisetas personalizadas de calidad en Toledo. Tu logo, diseño o texto en prendas premium. Serigrafía, bordado y DTG. Desde 1 unidad. Presupuesto gratis en 24h.')
@section('canonical', 'https://bycolor.es')

@push('styles')
<style>
    /* ── HERO ── */
    .hero { min-height:calc(100vh - 66px); background:linear-gradient(135deg,var(--navy) 0%,#0F3460 55%,#1A1A2E 100%); position:relative; overflow:hidden; display:flex; align-items:center; }
    .hero-bg-c1 { position:absolute; top:-180px; right:-180px; width:550px; height:550px; background:radial-gradient(circle,rgba(255,87,51,.13),transparent 70%); border-radius:50%; pointer-events:none; }
    .hero-bg-c2 { position:absolute; bottom:-100px; left:-100px; width:400px; height:400px; background:radial-gradient(circle,rgba(0,201,167,.08),transparent 70%); border-radius:50%; pointer-events:none; }
    .hero-ring  { position:absolute; width:280px; height:280px; border:1px solid rgba(255,193,7,.1); border-radius:50%; top:18%; left:8%; pointer-events:none; }
    .hero-grid  { display:grid; grid-template-columns:1fr; gap:3rem; align-items:center; padding:4rem 0; }
    .hero-title { font-size:clamp(2.4rem,7vw,5rem); font-weight:900; color:white; line-height:1.07; margin-bottom:1.1rem; }
    .hero-title .accent { background:linear-gradient(135deg,var(--coral),var(--gold)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
    .hero-sub   { font-size:clamp(.95rem,2vw,1.2rem); color:rgba(255,255,255,.6); line-height:1.75; max-width:520px; margin-bottom:2rem; }
    .hero-btns  { display:flex; flex-wrap:wrap; gap:.9rem; margin-bottom:2.5rem; }
    .hero-stats { display:grid; grid-template-columns:repeat(3,1fr); gap:.75rem; }

    /* T-shirt SVG visual */
    .hero-visual { display:none; position:relative; justify-content:center; align-items:center; }
    .tshirt-wrap { width:100%; max-width:420px; filter:drop-shadow(0 28px 55px rgba(0,0,0,.55)); }
    .float-tag {
        position:absolute; background:rgba(26,26,46,.92); backdrop-filter:blur(10px);
        border-radius:12px; padding:.6rem 1rem; white-space:nowrap;
        border:1px solid rgba(255,255,255,.1);
    }
    .float-tag .t { font-size:.68rem; font-weight:800; letter-spacing:.1em; text-transform:uppercase; }
    .float-tag .s { font-size:.68rem; color:var(--gray-400); margin-top:.1rem; }

    /* ── HERO CAROUSEL ── */
    .hero-carousel { position:relative; height:calc(100vh - 66px); min-height:480px; overflow:hidden; background:var(--navy); }
    .hslide { position:absolute; inset:0; opacity:0; transition:opacity .9s ease; z-index:0; }
    .hslide.active { opacity:1; z-index:1; }
    .hslide-media-img { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; display:block; }
    .hslide-media-vid { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; display:block; }
    .hslide-overlay { position:absolute; inset:0; background:linear-gradient(135deg,rgba(10,10,30,.72) 0%,rgba(10,10,30,.38) 100%); z-index:1; }
    .hslide-content { position:absolute; inset:0; display:flex; align-items:center; z-index:2; }
    .hslide-title { font-size:clamp(2.4rem,7vw,5rem); font-weight:900; color:white; line-height:1.07; margin-bottom:1.1rem; }
    .hslide-sub   { font-size:clamp(.95rem,2vw,1.2rem); color:rgba(255,255,255,.65); line-height:1.75; max-width:620px; margin-bottom:2.2rem; }
    /* arrows */
    .hc-arrow { position:absolute; top:50%; transform:translateY(-50%); z-index:10; background:rgba(255,255,255,.18); backdrop-filter:blur(4px); color:white; border:none; width:50px; height:50px; border-radius:50%; font-size:1.8rem; line-height:1; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:background .2s; }
    .hc-arrow:hover { background:var(--coral); }
    .hc-prev { left:1.5rem; } .hc-next { right:1.5rem; }
    /* dots */
    .hc-dots { position:absolute; bottom:1.5rem; left:50%; transform:translateX(-50%); z-index:10; display:flex; gap:.5rem; }
    .hc-dot { width:10px; height:10px; border-radius:50%; background:rgba(255,255,255,.4); border:none; cursor:pointer; transition:all .25s; padding:0; }
    .hc-dot.active { background:white; transform:scale(1.3); }
    @media (max-width:480px) {
        .hero-carousel { min-height:400px; }
        .hc-arrow { width:38px; height:38px; font-size:1.3rem; }
        .hc-prev { left:.6rem; } .hc-next { right:.6rem; }
    }

    /* ── FEATURES STRIP ── */
    .features-strip { background:var(--gray-50); padding:2.5rem 0; border-top:1px solid var(--gray-100); border-bottom:1px solid var(--gray-100); }
    .feat-item { display:flex; align-items:center; gap:.75rem; }
    .feat-icon { font-size:1.5rem; flex-shrink:0; }
    .feat-text strong { display:block; font-size:.88rem; font-weight:800; color:var(--navy); }
    .feat-text span   { font-size:.78rem; color:var(--gray-400); }
    .feat-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:1.5rem; }

    /* ── HOW IT WORKS ── */
    .steps-grid { display:grid; grid-template-columns:1fr; gap:1.5rem; }
    .step-card {
        background:white; border-radius:var(--radius-lg); padding:2.2rem 2rem; text-align:center;
        box-shadow:var(--shadow); border:2px solid transparent; position:relative; overflow:hidden;
        transition:all .35s ease;
    }
    .step-card::before { content:''; position:absolute; top:0; left:0; right:0; height:4px; background:linear-gradient(90deg,var(--coral),var(--gold)); transform:scaleX(0); transition:transform .35s; }
    .step-card:hover { border-color:rgba(255,87,51,.18); transform:translateY(-6px); box-shadow:0 20px 50px rgba(255,87,51,.1); }
    .step-card:hover::before { transform:scaleX(1); }
    .step-num { width:56px; height:56px; background:linear-gradient(135deg,var(--coral),#FF8C42); border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:1.4rem; font-weight:900; color:white; margin:0 auto 1rem; box-shadow:var(--shadow-coral); }
    .step-icon { font-size:2.6rem; margin-bottom:.8rem; }
    .step-title { font-size:1.05rem; font-weight:800; color:var(--navy); margin-bottom:.5rem; }
    .step-desc  { font-size:.85rem; color:var(--gray-400); line-height:1.65; }

    /* ── TRABAJOS SECTION ── */
    .trabajos-grid-home { display:grid; grid-template-columns:1fr; gap:1.5rem; }

    /* ── PRODUCTS ── */
    .products-home-grid { display:grid; grid-template-columns:1fr; gap:1.5rem; }
    .product-thumb { height:180px; display:flex; align-items:center; justify-content:center; font-size:5rem; position:relative; overflow:hidden; }
    .product-thumb img { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; }
    .product-tag { position:absolute; top:10px; right:10px; }
    .product-body { padding:1.2rem; }
    .product-name { font-size:1rem; font-weight:800; color:var(--navy); margin-bottom:.4rem; }
    .product-desc { font-size:.82rem; color:var(--gray-400); line-height:1.6; margin-bottom:1rem; }
    .product-price { font-size:1rem; font-weight:900; color:var(--coral); }
    .product-colors { display:flex; flex-wrap:wrap; gap:.3rem; margin-bottom:.7rem; }
    .color-swatch { width:18px; height:18px; border-radius:50%; border:2px solid rgba(0,0,0,.12); display:inline-block; flex-shrink:0; }

    /* ── TESTIMONIALS ── */
    .testi-grid { display:grid; grid-template-columns:1fr; gap:1.5rem; }

    /* ── RESPONSIVE ── */

    /* XS: < 480px */
    @media (max-width:479px) {
        .section { padding:2.5rem 0; }
        .hero-grid { padding:1.8rem 0 2.2rem; gap:1.5rem; }
        .hero-title { font-size:clamp(1.75rem,8.5vw,2.4rem); }
        .hero-sub   { font-size:.88rem; }
        .hero-btns  { flex-direction:column; align-items:stretch; }
        .hero-btns .btn { width:100%; justify-content:center; text-align:center; }
        .hero-stats { gap:.4rem; }
        .stat-pill  { padding:.6rem .4rem; }
        .stat-pill .num { font-size:1.1rem; }
        .stat-pill .lbl { font-size:.56rem; }
        .feat-grid  { gap:1rem; }
        .step-card  { padding:1.4rem 1rem; }
        .cta-band   { padding:2.5rem 0; }
        .cta-band h2 { font-size:1.5rem; }
        .testi-card { padding:1.2rem; }
        .product-thumb { height:160px; font-size:4rem; }
        /* Modal – bottom sheet */
        .wmodal-overlay { padding:.5rem .5rem 0; align-items:flex-end; }
        .wmodal { border-radius:20px 20px 0 0; max-height:92vh; }
        .wmodal-info { padding:1.2rem; gap:.7rem; }
        .wmodal-title { font-size:1.1rem; }
        .wmodal-cta a { width:100%; justify-content:center; }
    }

    /* SM: 480px – 639px */
    @media (min-width:480px) and (max-width:639px) {
        .section { padding:3rem 0; }
        .hero-grid { padding:2.2rem 0 3rem; }
        .hero-btns { flex-direction:column; align-items:stretch; }
        .hero-btns .btn { width:100%; justify-content:center; }
        .cta-band { padding:3rem 0; }
        .wmodal-overlay { padding:.5rem .5rem 0; align-items:flex-end; }
        .wmodal { border-radius:20px 20px 0 0; }
        .wmodal-info { padding:1.4rem; }
        .wmodal-cta a { width:100%; justify-content:center; }
    }

    /* MD: >= 640px */
    @media (min-width:640px) {
        .feat-grid { grid-template-columns:repeat(4,1fr); }
        .steps-grid { grid-template-columns:repeat(3,1fr); }
        .trabajos-grid-home { grid-template-columns:repeat(2,1fr); }
        .products-home-grid { grid-template-columns:repeat(2,1fr); }
        .testi-grid { grid-template-columns:repeat(2,1fr); }
    }

    /* LG: >= 900px */
    @media (min-width:900px) {
        .hero-grid { grid-template-columns:1fr 1fr; }
        .hero-visual { display:flex; }
        .trabajos-grid-home { grid-template-columns:repeat(3,1fr); }
        .products-home-grid { grid-template-columns:repeat(4,1fr); }
        .testi-grid { grid-template-columns:repeat(3,1fr); }
    }

    /* ── CTA BUTTON ── */
    .btn-cta-main {
        display:inline-flex; align-items:center; justify-content:center; gap:.5rem;
        background:white; color:var(--coral); font-weight:900; font-size:1rem;
        text-decoration:none; padding:1rem 2.5rem; border-radius:50px;
        box-shadow:0 8px 30px rgba(0,0,0,.2); transition:all .3s ease;
    }
    .btn-cta-main:hover { color:var(--coral); transform:translateY(-3px); box-shadow:0 14px 40px rgba(0,0,0,.3); }
    @media (max-width:639px) {
        .btn-cta-main { width:100%; max-width:360px; }
    }

    /* ── TRABAJOS CLICKABLES ── */
    .trabajos-grid-home .work-card { cursor:pointer; }
    .work-card-view-btn {
        display:inline-flex; align-items:center; gap:.4rem; margin-top:.8rem;
        font-size:.75rem; font-weight:700; color:var(--coral);
        background:rgba(255,87,51,.08); padding:.35rem .85rem; border-radius:50px;
        transition:background .2s;
    }
    .trabajos-grid-home .work-card:hover .work-card-view-btn { background:rgba(255,87,51,.16); }

    /* ── OPINION FORM ── */
    .opinion-form-wrap { max-width:680px; margin-left:auto; margin-right:auto; }
    .opinion-form-card {
        background:var(--gray-50); border:1.5px solid var(--gray-200);
        border-radius:18px; padding:1.8rem 2rem;
    }
    .opinion-form-header { display:flex; align-items:flex-start; gap:1rem; margin-bottom:1.4rem; }
    .opinion-form-icon { font-size:2rem; line-height:1; }
    .opinion-form-title { font-size:1.05rem; font-weight:800; color:var(--navy); }
    .opinion-form-sub   { font-size:.82rem; color:var(--gray-400); margin-top:.15rem; }
    .opinion-success {
        background:#dcfce7; color:#166534; border:1px solid #bbf7d0;
        border-radius:10px; padding:.9rem 1.2rem; font-weight:700; font-size:.88rem;
    }
    .opinion-stars-row { display:flex; align-items:center; gap:.8rem; margin-bottom:1rem; }
    .opinion-stars-label { font-size:.82rem; font-weight:700; color:var(--navy); white-space:nowrap; }
    /* Reverse star picker */
    .star-picker { display:flex; flex-direction:row-reverse; gap:.1rem; }
    .star-picker input { display:none; }
    .star-picker label {
        font-size:1.6rem; cursor:pointer; color:#d1d5db;
        transition:color .15s, transform .15s;
    }
    .star-picker label:hover,
    .star-picker label:hover ~ label,
    .star-picker input:checked ~ label { color:var(--gold); }
    .star-picker label:hover { transform:scale(1.15); }
    .opinion-fields { display:grid; grid-template-columns:1fr 1fr; gap:.75rem; margin-bottom:.75rem; }
    @media (max-width:500px) { .opinion-fields { grid-template-columns:1fr; } }
    .opinion-input, .opinion-textarea {
        width:100%; padding:.65rem .9rem; border:1.5px solid var(--gray-200);
        border-radius:10px; font-size:.88rem; color:var(--navy);
        background:white; transition:border-color .2s;
        font-family:inherit;
    }
    .opinion-input:focus, .opinion-textarea:focus {
        outline:none; border-color:var(--coral);
    }
    .opinion-textarea { resize:vertical; min-height:90px; margin-bottom:.75rem; display:block; }
    .opinion-error { font-size:.78rem; color:#dc2626; margin-bottom:.5rem; }
    .opinion-submit {
        background:var(--coral); color:white; font-weight:800; font-size:.9rem;
        border:none; border-radius:50px; padding:.75rem 2rem; cursor:pointer;
        transition:opacity .2s, transform .2s;
    }
    .opinion-submit:hover { opacity:.88; transform:translateY(-1px); }
    /* Modal opinion form */
    .wmodal-opinion { border-top:1px solid var(--gray-200); padding-top:.9rem; margin-top:.5rem; }
    .wmodal-opinion-title { font-size:.82rem; font-weight:800; color:var(--navy); margin-bottom:.7rem; display:flex; align-items:center; gap:.4rem; }
    .wmodal-opinion .star-picker label { font-size:1.3rem; }
    .wmodal-opinion .opinion-input { font-size:.82rem; padding:.55rem .8rem; }
    .wmodal-opinion .opinion-textarea { font-size:.82rem; min-height:70px; }
    .wmodal-opinion .opinion-submit { font-size:.82rem; padding:.6rem 1.5rem; }
    .wmodal-opinion-success {
        background:#dcfce7; color:#166534; border:1px solid #bbf7d0;
        border-radius:8px; padding:.65rem .9rem; font-size:.82rem; font-weight:700;
    }

    /* ── MODAL TRABAJOS ── */
    .wmodal-overlay {
        position:fixed; inset:0; z-index:9000;
        background:rgba(10,10,30,.75); backdrop-filter:blur(4px);
        display:flex; align-items:center; justify-content:center; padding:1rem;
        opacity:0; pointer-events:none; transition:opacity .25s;
    }
    .wmodal-overlay.open { opacity:1; pointer-events:auto; }
    .wmodal {
        background:white; border-radius:22px; overflow:hidden;
        max-width:900px; width:100%; max-height:90vh; overflow-y:auto;
        transform:translateY(24px) scale(.97); transition:transform .28s;
        display:grid;
    }
    .wmodal-overlay.open .wmodal { transform:none; }
    @media (min-width:720px) { .wmodal { grid-template-columns:1fr 1fr; } }
    .wmodal-gallery { position:relative; background:var(--navy); }
    .wmodal-main-img { width:100%; aspect-ratio:4/3; object-fit:cover; display:block; }
    .wmodal-main-placeholder {
        width:100%; aspect-ratio:4/3; background:linear-gradient(135deg,var(--navy),var(--coral));
        display:flex; align-items:center; justify-content:center; font-size:4rem;
    }
    .wmodal-thumbs { display:flex; gap:.4rem; padding:.5rem; flex-wrap:wrap; background:rgba(0,0,0,.3); }
    .wmodal-thumb { width:52px; height:52px; object-fit:cover; border-radius:8px; cursor:pointer;
        opacity:.65; transition:opacity .2s,outline .2s; outline:2px solid transparent; }
    .wmodal-thumb.active, .wmodal-thumb:hover { opacity:1; outline-color:var(--coral); }
    .wmodal-nav { position:absolute; top:50%; transform:translateY(-50%);
        background:rgba(0,0,0,.5); color:white; border:none; width:36px; height:36px;
        border-radius:50%; font-size:1.1rem; cursor:pointer; display:flex;
        align-items:center; justify-content:center; transition:background .2s; }
    .wmodal-nav:hover { background:var(--coral); }
    .wmodal-prev { left:.6rem; } .wmodal-next { right:.6rem; }
    .wmodal-counter { position:absolute; bottom:.5rem; right:.7rem;
        background:rgba(0,0,0,.55); color:white; font-size:.7rem; font-weight:700;
        padding:.2rem .6rem; border-radius:20px; }
    .wmodal-info { padding:1.8rem; display:flex; flex-direction:column; gap:.9rem; }
    .wmodal-close {
        position:absolute; top:1rem; right:1rem; z-index:10;
        background:rgba(255,255,255,.15); backdrop-filter:blur(4px);
        color:white; border:none; width:36px; height:36px; border-radius:50%;
        font-size:1.1rem; cursor:pointer; display:flex; align-items:center; justify-content:center;
        transition:background .2s;
    }
    .wmodal-close:hover { background:var(--coral); }
    .wmodal-badge { display:inline-flex; align-items:center;
        background:rgba(255,87,51,.1); color:var(--coral); font-size:.72rem; font-weight:800;
        letter-spacing:.07em; text-transform:uppercase; padding:.3rem .85rem; border-radius:50px; }
    .wmodal-title { font-size:1.4rem; font-weight:900; color:var(--navy); line-height:1.3; }
    .wmodal-desc  { font-size:.88rem; color:var(--gray-500); line-height:1.7; }
    .wmodal-meta  { font-size:.78rem; color:var(--gray-400); display:flex; align-items:center; gap:.4rem; }
    .wmodal-cta   { margin-top:auto; padding-top:.5rem; }
    .wmodal-cta a { display:inline-flex; align-items:center; gap:.5rem; background:var(--coral);
        color:white; font-weight:800; font-size:.88rem; text-decoration:none;
        padding:.7rem 1.8rem; border-radius:50px; transition:opacity .2s; }
    .wmodal-cta a:hover { opacity:.88; }
</style>
@endpush

@section('content')

{{-- ══════════════════════════════════════════
     HERO
══════════════════════════════════════════ --}}
@if(isset($heroSlides) && $heroSlides->isNotEmpty())
{{-- ── HERO CAROUSEL (desde administrador) ── --}}
<section class="hero-carousel" id="hero-carousel">

    @foreach($heroSlides as $slide)
    <div class="hslide{{ $loop->first ? ' active' : '' }}">

        @if($slide->tipo_media === 'video')
        <video class="hslide-media-vid" autoplay muted loop playsinline preload="auto">
            <source src="{{ asset('storage/'.$slide->ruta_media) }}" type="video/mp4">
        </video>
        @else
        <img class="hslide-media-img"
             src="{{ asset('storage/'.$slide->ruta_media) }}"
             alt="{{ $slide->titulo ?? '' }}"
             {{ $loop->first ? '' : 'loading="lazy"' }}>
        @endif

        <div class="hslide-overlay"></div>

        @if($slide->titulo || $slide->subtitulo || ($slide->texto_boton && $slide->url_boton))
        <div class="hslide-content">
            <div class="container">
                @if($slide->titulo)
                <h1 class="hslide-title" style="animation:fadeUp .7s ease forwards;">
                    {!! nl2br(e($slide->titulo)) !!}
                </h1>
                @endif
                @if($slide->subtitulo)
                <p class="hslide-sub">{{ $slide->subtitulo }}</p>
                @endif
                @if($slide->texto_boton && $slide->url_boton)
                <a href="{{ $slide->url_boton }}" class="btn btn-primary btn-lg">
                    {{ $slide->texto_boton }}
                </a>
                @endif
            </div>
        </div>
        @endif

    </div>
    @endforeach

    @if($heroSlides->count() > 1)
    <button class="hc-arrow hc-prev" onclick="hcPrev()" aria-label="Slide anterior">&#8249;</button>
    <button class="hc-arrow hc-next" onclick="hcNext()" aria-label="Slide siguiente">&#8250;</button>
    <div class="hc-dots">
        @foreach($heroSlides as $slide)
        <button class="hc-dot{{ $loop->first ? ' active' : '' }}"
                onclick="hcGo({{ $loop->index }})"
                aria-label="Slide {{ $loop->iteration }}"></button>
        @endforeach
    </div>
    @endif

</section>

@else
{{-- ── HERO ESTÁTICO (fallback cuando no hay slides) ── --}}
<section class="hero">
    <div class="hero-bg-c1"></div>
    <div class="hero-bg-c2"></div>
    <div class="hero-ring anim-spin"></div>

    <div class="container" style="width:100%;">
        <div class="hero-grid">

            {{-- Text --}}
            <div style="animation:fadeUp .7s ease forwards;">
                <span class="badge badge-gold" style="margin-bottom:1.2rem;">
                    ⭐ Calidad premium · Desde 1 unidad
                </span>
                <h1 class="hero-title">
                    Camisetas que<br><span class="accent">te definen.</span>
                </h1>
                <p class="hero-sub">
                    Diseño personalizado con tu logo, texto o imagen. Serigrafía, bordado y DTG de alta calidad. 
                    Perfectas para empresas, eventos, equipos y regalos únicos.
                </p>
                <div class="hero-btns">
                    <a href="{{ route('contacto') }}" class="btn btn-primary btn-lg">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Pedir mi diseño gratis
                    </a>
                    <a href="{{ route('trabajos.index') }}" class="btn btn-secondary btn-lg">Ver trabajos →</a>
                </div>
                <div class="hero-stats">
                    <div class="stat-pill"><div class="num" style="background:linear-gradient(135deg,var(--coral),var(--gold));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">+500</div><div class="lbl">Pedidos</div></div>
                    <div class="stat-pill"><div class="num" style="color:var(--gold);">24h</div><div class="lbl">Respuesta</div></div>
                    <div class="stat-pill"><div class="num" style="color:var(--mint);">100%</div><div class="lbl">Satisfacción</div></div>
                </div>
            </div>

            {{-- T-shirt visual --}}
            <div class="hero-visual anim-float">
                <svg class="tshirt-wrap" viewBox="0 0 480 480" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="sg" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#FF5733"/>
                            <stop offset="100%" stop-color="#FF8C42"/>
                        </linearGradient>
                        <filter id="sf"><feDropShadow dx="0" dy="20" stdDeviation="22" flood-color="#000" flood-opacity=".45"/></filter>
                        <radialGradient id="glow" cx="50%" cy="100%" r="60%"><stop offset="0%" stop-color="#FF5733" stop-opacity=".35"/><stop offset="100%" stop-color="transparent"/></radialGradient>
                    </defs>
                    <ellipse cx="240" cy="390" rx="175" ry="35" fill="url(#glow)"/>
                    <g filter="url(#sf)">
                        <path d="M80 108 L28 182 L92 212 L118 162 Z" fill="url(#sg)"/>
                        <path d="M400 108 L452 182 L388 212 L362 162 Z" fill="url(#sg)"/>
                        <path d="M118 88 L80 108 L118 162 L108 385 L372 385 L362 162 L400 108 L362 88 Q332 68 300 78 Q270 132 240 132 Q210 132 180 78 Q148 68 118 88 Z" fill="url(#sg)"/>
                    </g>
                    <path d="M202 93 Q240 148 278 93" fill="none" stroke="rgba(255,255,255,.25)" stroke-width="2"/>
                    <rect x="168" y="188" width="144" height="144" rx="14" fill="rgba(255,255,255,.1)" stroke="rgba(255,255,255,.3)" stroke-width="1.5" stroke-dasharray="7,5"/>
                    <text x="240" y="262" text-anchor="middle" font-size="50" fill="rgba(255,255,255,.9)">★</text>
                    <text x="240" y="303" text-anchor="middle" font-size="13" font-weight="700" fill="rgba(255,255,255,.65)" font-family="system-ui" letter-spacing="3">TU LOGO</text>
                    <circle cx="152" cy="155" r="4" fill="rgba(255,255,255,.4)"/>
                    <circle cx="328" cy="155" r="4" fill="rgba(255,255,255,.4)"/>
                </svg>
                <div class="float-tag" style="top:5%;right:-2%;border-color:rgba(255,87,51,.3);">
                    <div class="t" style="color:var(--coral);">Calidad</div>
                    <div class="s">100% algodón</div>
                </div>
                <div class="float-tag" style="bottom:12%;left:-4%;border-color:rgba(255,193,7,.3);">
                    <div class="t" style="color:var(--gold);">Precio</div>
                    <div class="s">Desde 12€/ud</div>
                </div>
            </div>

        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════
     MARQUEE
══════════════════════════════════════════ --}}
<div class="marquee-strip" aria-hidden="true">
    <div class="anim-marquee">
        <span class="marquee-inner">
            <span>👕 Camisetas personalizadas</span><span>⚡ Entrega rápida</span>
            <span>🎨 Tu diseño, tu estilo</span><span>✅ Desde 1 unidad</span>
            <span>🏆 Calidad premium</span><span>🖨️  DTF y sublimación deportiva</span>
            {{-- <span>📦 Envío a toda España</span><span>💼 Empresas y eventos</span> --}}
            <span>👕 Camisetas personalizadas</span><span>⚡ Entrega rápida</span>
            <span>🎨 Tu diseño, tu estilo</span><span>✅ Desde 1 unidad</span>
            <span>🏆 Calidad premium</span><span>🖨️  DTF y sublimación deportiva</span>
            {{-- <span>📦 Envío a toda España</span><span>💼 Empresas y eventos</span> --}}
        </span>
    </div>
</div>

{{-- ══════════════════════════════════════════
     FEATURES STRIP
══════════════════════════════════════════ --}}
<div class="features-strip">
    <div class="container">
        <div class="feat-grid">
            <div class="feat-item reveal delay-1">
                <div class="feat-icon">🎨</div>
                <div class="feat-text"><strong>Diseño gratis</strong><span>Te ayudamos sin coste</span></div>
            </div>
            <div class="feat-item reveal delay-2">
                <div class="feat-icon">📦</div>
                <div class="feat-text"><strong>Envío España</strong><span>Rápido y seguro</span></div>
            </div>
            <div class="feat-item reveal delay-3">
                <div class="feat-icon">✅</div>
                <div class="feat-text"><strong>Desde 1 unidad</strong><span>Sin mínimos</span></div>
            </div>
            <div class="feat-item reveal delay-4">
                <div class="feat-icon">⭐</div>
                <div class="feat-text"><strong>100% Satisfacción</strong><span>Garantizado</span></div>
            </div>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════
     CÓMO FUNCIONA
══════════════════════════════════════════ --}}
<section class="section" style="background:var(--gray-50);">
    <div class="container">
        <div class="reveal" style="text-align:center;margin-bottom:clamp(2rem,5vw,3.5rem);">
            <h2 class="section-title">¿Cómo funciona?</h2>
            <p class="section-subtitle" style="margin:0 auto;margin-top:.7rem;">En 3 pasos tienes tus camisetas personalizadas listas para lucir</p>
        </div>
        <div class="steps-grid">
            <div class="step-card reveal delay-1">
                <div class="step-icon">🎨</div>
                <div class="step-num">1</div>
                <div class="step-title">Diseña o envíanos tu idea</div>
                <p class="step-desc">Compártenos tu logo, texto o imagen. Si no tienes diseño, nuestro equipo creativo lo crea sin coste adicional.</p>
            </div>
            <div class="step-card reveal delay-2">
                <div class="step-icon">✅</div>
                <div class="step-num">2</div>
                <div class="step-title">Confirmamos y producimos</div>
                <p class="step-desc">Te enviamos una prueba digital para aprobación. Tras tu visto bueno, producimos con materiales de primera calidad.</p>
            </div>
            <div class="step-card reveal delay-3">
                <div class="step-icon">🚀</div>
                <div class="step-num">3</div>
                <div class="step-title">Recibe tu pedido</div>
                <p class="step-desc">Enviamos a toda España. También puedes recoger en Toledo. Packaging cuidado para que lleguen perfectas.</p>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     TRABAJOS RECIENTES (dinámico)
══════════════════════════════════════════ --}}
@if(isset($trabajosDestacados) && $trabajosDestacados->isNotEmpty())
<section class="section" style="background:white;">
    <div class="container">
        <div class="reveal" style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:clamp(1.8rem,5vw,3rem);">
            <div>
                <span class="section-eyebrow">Portfolio</span>
                <h2 class="section-title">Trabajos <span class="hl">destacados</span></h2>
            </div>
            <a href="{{ route('trabajos.index') }}" class="btn btn-outline btn-sm">Ver todos →</a>
        </div>
        <div class="trabajos-grid-home">
            @foreach($trabajosDestacados as $trabajo)
            @php
                $allImgs  = $trabajo->imagenes->map(fn($i) => $i->ruta_url)->values();
                if($allImgs->isEmpty() && $trabajo->imagen) $allImgs = collect([asset('storage/'.$trabajo->imagen)]);
                $icons    = ['camiseta'=>'👕','polo'=>'👔','sudadera'=>'🧥','sport'=>'🎽','uniforme'=>'🦺','otro'=>'✨'];
                $catLabel = \App\Models\Trabajo::listaCategorias()[$trabajo->categoria] ?? ucfirst($trabajo->categoria);
            @endphp
            <div class="work-card reveal delay-{{ $loop->iteration }}"
                 onclick="openModal({{ json_encode([
                     'trabajo_id'  => $trabajo->id,
                     'titulo'      => $trabajo->titulo,
                     'categoria'   => $catLabel,
                     'descripcion' => $trabajo->descripcion,
                     'fecha'       => $trabajo->fecha_realizacion->locale('es')->isoFormat('D [de] MMMM [de] YYYY'),
                     'imagenes'    => $allImgs,
                     'icono'       => $icons[$trabajo->categoria] ?? '👕',
                 ]) }})">
                @if($allImgs->isNotEmpty())
                    <img src="{{ $allImgs->first() }}" alt="{{ $trabajo->titulo }}"
                         class="work-card-img" loading="lazy"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                    <div class="work-card-img-placeholder" style="display:none;">{{ $icons[$trabajo->categoria] ?? '👕' }}</div>
                @else
                    <div class="work-card-img-placeholder">{{ $icons[$trabajo->categoria] ?? '👕' }}</div>
                @endif
                <div class="work-card-body">
                    <div class="work-card-cat">{{ $catLabel }}</div>
                    <div class="work-card-title">{{ $trabajo->titulo }}</div>
                    @if($trabajo->descripcion)
                    <div class="work-card-desc">{{ $trabajo->descripcion }}</div>
                    @endif
                    <div class="work-card-date">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                        {{ $trabajo->fecha_realizacion->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
                    </div>
                    <span class="work-card-view-btn">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                        Ver detalle
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== MODAL TRABAJOS ===== --}}
<div class="wmodal-overlay" id="wmodal-overlay" onclick="handleOverlayClick(event)">
    <div class="wmodal" id="wmodal" role="dialog" aria-modal="true">
        <div class="wmodal-gallery" id="wmodal-gallery">
            <button class="wmodal-close" onclick="closeModal()" aria-label="Cerrar">✕</button>
            <div id="wmodal-main-wrap">
                <img id="wmodal-main-img" src="" alt="" class="wmodal-main-img" style="display:none;">
                <div id="wmodal-main-placeholder" class="wmodal-main-placeholder" style="display:none;"></div>
            </div>
            <button class="wmodal-nav wmodal-prev" id="wmodal-prev" onclick="navImg(-1)">‹</button>
            <button class="wmodal-nav wmodal-next" id="wmodal-next" onclick="navImg(1)">›</button>
            <div class="wmodal-counter" id="wmodal-counter"></div>
            <div class="wmodal-thumbs" id="wmodal-thumbs"></div>
        </div>
        <div class="wmodal-info" id="wmodal-info">
            <div class="wmodal-badge" id="wmodal-badge"></div>
            <div class="wmodal-title" id="wmodal-title"></div>
            <div class="wmodal-desc"  id="wmodal-desc"></div>
            <div class="wmodal-meta"  id="wmodal-meta">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                <span id="wmodal-date"></span>
            </div>
            <div class="wmodal-cta">
                <a href="{{ route('contacto') }}">🛒 Quiero algo así</a>
            </div>
            {{-- Formulario de opinión del trabajo --}}
            <div class="wmodal-opinion">
                <div class="wmodal-opinion-title">⭐ Deja tu valoración de este trabajo</div>
                <div id="wmodal-opinion-success" class="wmodal-opinion-success" style="display:none;">
                    ✅ ¡Gracias! Tu opinión será revisada y publicada pronto.
                </div>
                <form id="wmodal-opinion-form" style="display:flex;flex-direction:column;gap:.6rem;">
                    @csrf
                    <input type="hidden" name="trabajo_id" id="wmodal-opinion-trabajo-id">
                    <div class="opinion-stars-row">
                        <span class="opinion-stars-label">Valoración:</span>
                        <div class="star-picker" id="star-picker-modal">
                            @for($s = 5; $s >= 1; $s--)
                            <input type="radio" name="valoracion" id="star-m{{ $s }}" value="{{ $s }}" {{ $s === 5 ? 'checked' : '' }}>
                            <label for="star-m{{ $s }}" title="{{ $s }} estrellas">★</label>
                            @endfor
                        </div>
                    </div>
                    <input type="text" name="nombre" placeholder="Tu nombre *" maxlength="100" required class="opinion-input wmodal-opinion">
                    <input type="email" name="email" placeholder="Email (opcional)" maxlength="150" class="opinion-input wmodal-opinion">
                    <textarea name="texto" placeholder="¿Cómo fue tu experiencia? *" rows="2" required minlength="10" maxlength="1000" class="opinion-textarea wmodal-opinion"></textarea>
                    <div id="wmodal-opinion-error" class="opinion-error" style="display:none;"></div>
                    <button type="submit" class="opinion-submit">Enviar valoración →</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endif

{{-- ══════════════════════════════════════════
     PRODUCTOS DESTACADOS
══════════════════════════════════════════ --}}
@if($productosDestacados->isNotEmpty())
<section class="section" style="background:var(--gray-50);">
    <div class="container">
        <div class="reveal" style="text-align:center;margin-bottom:clamp(2rem,5vw,3.5rem);">
            <span class="section-eyebrow">Catálogo</span>
            <h2 class="section-title">Nuestros <span class="hl">productos</span></h2>
            <p class="section-subtitle" style="margin:0 auto;margin-top:.7rem;">Prendas de calidad para cada ocasión y necesidad</p>
        </div>
        <div class="products-home-grid">
            @foreach($productosDestacados as $p)
            <div class="product-card reveal delay-{{ ($loop->index % 4) + 1 }}">
                <div class="product-thumb"
                     style="{{ ($p->imagenes && count($p->imagenes) > 0) ? '' : 'background:linear-gradient(135deg,'.$p->color_inicio.','.$p->color_fin.');' }}">
                    @if($p->imagenes && count($p->imagenes) > 0)
                        <img src="{{ $p->url_imagen }}" alt="{{ $p->nombre }}">
                        @if($p->badge)
                        <span class="product-tag badge {{ $p->badge_tipo }}">{{ $p->badge }}</span>
                        @endif
                    @else
                        <span>{{ $p->emoji }}</span>
                        @if($p->badge)
                        <span class="product-tag badge {{ $p->badge_tipo }}">{{ $p->badge }}</span>
                        @endif
                    @endif
                </div>
                <div class="product-body">
                    <div class="product-name">{{ $p->nombre }}</div>
                    @if($p->colores && count($p->colores) > 0)
                    <div class="product-colors">
                        @foreach(array_slice($p->colores, 0, 10) as $c)
                        <span class="color-swatch" style="background:{{ $c['hex'] }};" title="{{ $c['nombre'] }}"></span>
                        @endforeach
                        @if(count($p->colores) > 10)<span style="font-size:.65rem;color:var(--gray-400);">+{{ count($p->colores) - 10 }}</span>@endif
                    </div>
                    @endif
                    @if($p->descripcion)
                    <div class="product-desc">{{ Str::limit($p->descripcion, 80) }}</div>
                    @endif
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        @if($p->precio_desde)
                        <div class="product-price">{{ $p->precio_desde }}</div>
                        @else
                        <div></div>
                        @endif
                        <a href="{{ route('contacto') }}" class="btn btn-primary btn-sm">Pedir</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="reveal" style="text-align:center;margin-top:2.5rem;">
            <a href="{{ route('productos') }}" class="btn btn-outline">Ver catálogo completo →</a>
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════
     TESTIMONIOS
══════════════════════════════════════════ --}}
<section class="section" style="background:white;">
    <div class="container">
        <div class="reveal" style="text-align:center;margin-bottom:clamp(2rem,5vw,3.5rem);">
            <span class="section-eyebrow">Opiniones</span>
            <h2 class="section-title">Clientes <span class="hl">satisfechos</span></h2>
        </div>

        {{-- Opiniones de la base de datos (aprobadas) --}}
        @php
            $avatarColors = ['#FF5733,#FF8C42','#00C9A7,#0F9D8A','#A855F7,#7C3AED','#1A1A2E,#0F3460','#FF5733,#A855F7','#00C9A7,#1A1A2E'];
        @endphp

        @if(isset($opiniones) && $opiniones->isNotEmpty())
        <div class="testi-grid">
            @foreach($opiniones as $op)
            @php $colIdx = ($loop->index % count($avatarColors)); @endphp
            <div class="testi-card reveal delay-{{ $loop->iteration }}">
                <div class="testi-stars">{{ str_repeat('★', $op->valoracion) }}{{ str_repeat('☆', 5 - $op->valoracion) }}</div>
                <p class="testi-text">"{{ $op->texto }}"</p>
                <div style="display:flex;align-items:center;gap:.75rem;">
                    <div class="testi-avatar" style="background:linear-gradient(135deg,{{ $avatarColors[$colIdx] }});">{{ mb_strtoupper(mb_substr($op->nombre, 0, 1)) }}</div>
                    <div>
                        <div class="testi-author">{{ $op->nombre }}</div>
                        @if($op->trabajo)
                        <div class="testi-role">{{ $op->trabajo->titulo }}</div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Formulario para dejar opinión --}}
        <div class="opinion-form-wrap reveal" style="margin-top:3rem;">
            <div class="opinion-form-card">
                <div class="opinion-form-header">
                    <span class="opinion-form-icon">⭐</span>
                    <div>
                        <div class="opinion-form-title">¿Ya has sido cliente?</div>
                        <div class="opinion-form-sub">Cuéntanos tu experiencia. Leemos cada opinión.</div>
                    </div>
                </div>
                @if(session('opinion_ok'))
                <div class="opinion-success">✅ ¡Gracias por tu opinión! La revisaremos y la publicaremos pronto.</div>
                @else
                <form method="POST" action="{{ route('opiniones.store') }}" id="opinion-home-form">
                    @csrf
                    <div class="opinion-stars-row">
                        <span class="opinion-stars-label">Valoración:</span>
                        <div class="star-picker" id="star-picker-home">
                            @for($s = 5; $s >= 1; $s--)
                            <input type="radio" name="valoracion" id="star-h{{ $s }}" value="{{ $s }}" {{ $s === 5 ? 'checked' : '' }}>
                            <label for="star-h{{ $s }}" title="{{ $s }} estrellas">★</label>
                            @endfor
                        </div>
                    </div>
                    <div class="opinion-fields">
                        <input type="text" name="nombre" placeholder="Tu nombre *" maxlength="100" required
                               value="{{ old('nombre') }}" class="opinion-input">
                        <input type="email" name="email" placeholder="Email (opcional)" maxlength="150"
                               value="{{ old('email') }}" class="opinion-input">
                    </div>
                    <textarea name="texto" placeholder="Cuéntanos tu experiencia... *" rows="3" required
                              minlength="10" maxlength="1000" class="opinion-textarea">{{ old('texto') }}</textarea>
                    @error('texto')<div class="opinion-error">{{ $message }}</div>@enderror
                    @error('nombre')<div class="opinion-error">{{ $message }}</div>@enderror
                    <button type="submit" class="opinion-submit">Enviar opinión →</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════
     CTA FINAL
══════════════════════════════════════════ --}}
<div class="cta-band">
    <div class="container">
        <div class="reveal">
            <h2>¿Listo para crear tu camiseta perfecta?</h2>
            <p>Presupuesto gratuito en menos de 24 horas. Sin compromiso.</p>
            <a href="{{ route('contacto') }}" class="btn-cta-main">
                🛒 Solicitar presupuesto gratis
            </a>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let _imgs = [], _cur = 0;

function openModal(data) {
    _imgs = data.imagenes || [];
    _cur  = 0;
    document.getElementById('wmodal-badge').textContent = data.categoria;
    document.getElementById('wmodal-title').textContent = data.titulo;
    document.getElementById('wmodal-desc').textContent  = data.descripcion || '';
    document.getElementById('wmodal-date').textContent  = data.fecha;
    document.getElementById('wmodal-desc').style.display = data.descripcion ? '' : 'none';
    // Bind trabajo_id to opinion form
    document.getElementById('wmodal-opinion-trabajo-id').value = data.trabajo_id || '';
    // Reset opinion form
    const form = document.getElementById('wmodal-opinion-form');
    form.reset();
    form.style.display = '';
    document.getElementById('wmodal-opinion-success').style.display = 'none';
    document.getElementById('wmodal-opinion-error').style.display   = 'none';
    // Reset stars to 5
    const s5 = document.getElementById('star-m5');
    if (s5) s5.checked = true;
    renderGallery(data.icono);
    document.getElementById('wmodal-overlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function renderGallery(icono) {
    const img  = document.getElementById('wmodal-main-img');
    const ph   = document.getElementById('wmodal-main-placeholder');
    const prev = document.getElementById('wmodal-prev');
    const next = document.getElementById('wmodal-next');
    if (_imgs.length > 0) {
        img.src = _imgs[_cur];
        img.style.display = '';
        ph.style.display  = 'none';
    } else {
        ph.innerHTML = icono || '👕';
        ph.style.display = '';
        img.style.display = 'none';
    }
    document.getElementById('wmodal-counter').textContent =
        _imgs.length > 1 ? `${_cur+1} / ${_imgs.length}` : '';
    prev.style.display = _imgs.length > 1 ? '' : 'none';
    next.style.display = _imgs.length > 1 ? '' : 'none';
    const thumbsEl = document.getElementById('wmodal-thumbs');
    thumbsEl.innerHTML = '';
    if (_imgs.length > 1) {
        _imgs.forEach((src, i) => {
            const t = document.createElement('img');
            t.src       = src;
            t.className = 'wmodal-thumb' + (i === _cur ? ' active' : '');
            t.onclick   = () => goImg(i);
            thumbsEl.appendChild(t);
        });
    }
}

function goImg(i) {
    _cur = (i + _imgs.length) % _imgs.length;
    document.getElementById('wmodal-main-img').src = _imgs[_cur];
    document.getElementById('wmodal-counter').textContent = `${_cur+1} / ${_imgs.length}`;
    document.querySelectorAll('.wmodal-thumb').forEach((t,j) => t.classList.toggle('active', j===_cur));
}

function navImg(dir) { goImg(_cur + dir); }

function closeModal() {
    document.getElementById('wmodal-overlay').classList.remove('open');
    document.body.style.overflow = '';
}

function handleOverlayClick(e) {
    if (e.target === document.getElementById('wmodal-overlay')) closeModal();
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

// Modal opinion form submit (AJAX)
document.getElementById('wmodal-opinion-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const errEl = document.getElementById('wmodal-opinion-error');
    const btn   = this.querySelector('button[type=submit]');
    btn.disabled = true;
    btn.textContent = 'Enviando...';
    errEl.style.display = 'none';
    try {
        const fd = new FormData(this);
        const res = await fetch('{{ route('opiniones.store') }}', {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            body: fd
        });
        if (res.ok) {
            this.style.display = 'none';
            document.getElementById('wmodal-opinion-success').style.display = '';
        } else {
            const json = await res.json().catch(() => ({}));
            const msg  = json.message || 'Error al enviar. Inténtalo de nuevo.';
            errEl.textContent    = msg;
            errEl.style.display  = '';
            btn.disabled         = false;
            btn.textContent      = 'Enviar valoración →';
        }
    } catch {
        errEl.textContent   = 'Error de conexión. Inténtalo de nuevo.';
        errEl.style.display = '';
        btn.disabled        = false;
        btn.textContent     = 'Enviar valoración →';
    }
});

/* ── HERO CAROUSEL JS ── */
(function () {
    var carousel = document.getElementById('hero-carousel');
    if (!carousel) return;
    var slides = carousel.querySelectorAll('.hslide');
    var dots   = carousel.querySelectorAll('.hc-dot');
    if (slides.length <= 1) return;

    var cur = 0, timer = null;

    function go(i) {
        slides[cur].classList.remove('active');
        if (dots[cur]) dots[cur].classList.remove('active');
        cur = ((i % slides.length) + slides.length) % slides.length;
        slides[cur].classList.add('active');
        if (dots[cur]) dots[cur].classList.add('active');
        clearInterval(timer);
        timer = setInterval(function () { go(cur + 1); }, 6000);
    }

    window.hcGo   = go;
    window.hcNext = function () { go(cur + 1); };
    window.hcPrev = function () { go(cur - 1); };

    /* Touch swipe */
    var tx = 0;
    carousel.addEventListener('touchstart', function (e) { tx = e.touches[0].clientX; }, { passive: true });
    carousel.addEventListener('touchend', function (e) {
        var dx = e.changedTouches[0].clientX - tx;
        if (Math.abs(dx) > 50) { dx < 0 ? go(cur + 1) : go(cur - 1); }
    }, { passive: true });

    /* Pause on hover */
    carousel.addEventListener('mouseenter', function () { clearInterval(timer); });
    carousel.addEventListener('mouseleave', function () {
        timer = setInterval(function () { go(cur + 1); }, 6000);
    });

    timer = setInterval(function () { go(cur + 1); }, 6000);
}());
</script>
@endpush
