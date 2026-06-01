@extends('layouts.site')

@section('title', $producto->nombre . ' — Personalización textil · bycolor.es')
@section('description', Str::limit($producto->descripcion ?? ($producto->nombre . ' personalizado. Serigrafía, bordado y DTG desde 1 unidad.'), 160))
@section('canonical', 'https://bycolor.es/productos/' . $producto->id)

@push('styles')
<style>
    /* ── PDP grid ── */
    .pdp-grid { display:grid; grid-template-columns:1fr; gap:3rem; }
    @media (min-width:860px) { .pdp-grid { grid-template-columns:1fr 1fr; align-items:start; } }

    /* ── Image gallery ── */
    .pdp-main-wrap {
        border-radius:var(--radius-lg);
        overflow:hidden;
        position:relative;
        background:var(--gray-50);
        box-shadow:var(--shadow);
    }
    .pdp-main-img { width:100%; aspect-ratio:1/1; object-fit:cover; display:block; transition:opacity .3s; }
    .pdp-main-placeholder { aspect-ratio:1/1; display:flex; align-items:center; justify-content:center; font-size:clamp(6rem,15vw,10rem); }
    .pdp-thumbs { display:flex; gap:.5rem; margin-top:.75rem; flex-wrap:wrap; }
    .pdp-thumb {
        width:70px; height:70px; border-radius:8px; object-fit:cover;
        cursor:pointer; border:2px solid var(--gray-200); opacity:.7;
        transition:all .2s;
    }
    .pdp-thumb.active, .pdp-thumb:hover { border-color:var(--coral); opacity:1; }

    /* ── Info panel ── */
    .pdp-category { font-size:.72rem; font-weight:900; letter-spacing:.12em; text-transform:uppercase; color:var(--coral); margin-bottom:.4rem; }
    .pdp-name { font-size:clamp(1.55rem,3.5vw,2.2rem); font-weight:900; color:var(--navy); line-height:1.2; margin-bottom:.5rem; }
    .pdp-price { font-size:1.9rem; font-weight:900; color:var(--coral); margin:.8rem 0 1rem; }
    .pdp-price small { font-size:.85rem; font-weight:400; color:var(--gray-400); }
    .pdp-desc { font-size:.95rem; color:var(--gray-600); line-height:1.8; margin:1rem 0 1.4rem; }
    .pdp-feats { display:flex; flex-wrap:wrap; gap:.45rem; margin-bottom:1.4rem; }
    .pdp-feat-chip {
        font-size:.75rem; font-weight:700; padding:.3rem .85rem;
        background:var(--gray-100); color:var(--navy);
        border-radius:50px; white-space:nowrap;
    }

    /* ── Color swatches ── */
    .pdp-colors { display:flex; flex-wrap:wrap; gap:.5rem; margin-top:.5rem; align-items:center; }
    .pdp-swatch {
        width:34px; height:34px; border-radius:50%; flex-shrink:0; cursor:pointer;
        border:3px solid transparent; outline:2px solid rgba(0,0,0,.1);
        transition:transform .2s, border-color .15s;
    }
    .pdp-swatch:hover { transform:scale(1.18); }
    .pdp-swatch.selected { border-color:var(--coral); outline-color:var(--coral); transform:scale(1.1); }

    /* ── Related products ── */
    .related-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:1.2rem; }
    @media (min-width:640px) { .related-grid { grid-template-columns:repeat(4,1fr); } }
    .related-card {
        background:white; border-radius:var(--radius); overflow:hidden;
        box-shadow:var(--shadow); transition:transform .3s;
        text-decoration:none; display:block; position:relative;
        border:2px solid transparent;
    }
    .related-card:hover { transform:translateY(-5px); border-color:rgba(255,87,51,.2); }
    .related-card-thumb { height:130px; display:flex; align-items:center; justify-content:center; font-size:3.5rem; position:relative; overflow:hidden; }
    .related-card-body { padding:1rem; }
    .related-card-name { font-size:.85rem; font-weight:800; color:var(--navy); }
    .related-card-price { font-size:.82rem; color:var(--coral); font-weight:700; margin-top:.2rem; }
</style>
@endpush

@section('content')

{{-- Page header --}}
<section class="page-header">
    <div class="container" style="position:relative;z-index:1;">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Inicio</a><span>/</span>
            <a href="{{ route('productos') }}">Productos</a><span>/</span>
            <span style="color:rgba(255,255,255,.8);">{{ $producto->nombre }}</span>
        </div>
        <h1>{{ $producto->nombre }}</h1>
        @if($producto->descripcion)
        <p>{{ Str::limit($producto->descripcion, 120) }}</p>
        @endif
    </div>
</section>

{{-- Product detail --}}
<section class="section">
    <div class="container">
        <div class="pdp-grid">

            {{-- ── LEFT: Image gallery ── --}}
            <div>
                <div class="pdp-main-wrap">
                    @if($producto->imagenes && count($producto->imagenes) > 0)
                        <img src="{{ $producto->url_imagen }}"
                             alt="{{ $producto->nombre }}"
                             id="pdp-main-img"
                             class="pdp-main-img">
                    @else
                        <div class="pdp-main-placeholder"
                             style="background:linear-gradient(135deg,{{ $producto->color_inicio ?: '#FF5733' }},{{ $producto->color_fin ?: '#FF8C42' }});">
                            {{ $producto->emoji ?: '📦' }}
                        </div>
                    @endif
                    @if($producto->badge)
                    <span class="badge {{ $producto->badge_tipo }}"
                          style="position:absolute;top:16px;left:16px;font-size:.8rem;padding:.4rem .9rem;">
                        {{ $producto->badge }}
                    </span>
                    @endif
                </div>

                @if($producto->imagenes && count($producto->imagenes) > 1)
                <div class="pdp-thumbs">
                    @foreach($producto->url_imagenes as $idx => $url)
                    <img src="{{ $url }}" alt="Imagen {{ $idx + 1 }}"
                         class="pdp-thumb {{ $idx === 0 ? 'active' : '' }}"
                         onclick="pdpSetImg(this, '{{ $url }}')">
                    @endforeach
                </div>
                @endif
            </div>

            {{-- ── RIGHT: Product info ── --}}
            <div>
                <div class="pdp-category">{{ $producto->nombre_categoria }}</div>
                <h2 class="pdp-name">{{ $producto->nombre }}</h2>

                @if($producto->precio_desde)
                <div class="pdp-price">
                    {{ $producto->precio_desde }} <small>/ unidad</small>
                </div>
                @endif

                @if($producto->descripcion)
                <p class="pdp-desc">{{ $producto->descripcion }}</p>
                @endif

                {{-- Color swatches --}}
                @if($producto->colores && count($producto->colores) > 0)
                <div style="margin-bottom:1.5rem;">
                    <div style="font-size:.75rem;font-weight:900;color:var(--navy);text-transform:uppercase;letter-spacing:.1em;margin-bottom:.5rem;">
                        Colores disponibles
                        <span id="selected-color-name" style="text-transform:none;letter-spacing:0;font-weight:700;color:var(--coral);margin-left:.4rem;"></span>
                    </div>
                    <div class="pdp-colors">
                        @foreach($producto->colores as $idx => $c)
                        <span class="pdp-swatch {{ $idx === 0 ? 'selected' : '' }}"
                              style="background:{{ $c['hex'] }};"
                              title="{{ $c['nombre'] }}"
                              data-imagen="{{ isset($c['imagen']) && $c['imagen'] ? asset('storage/'.$c['imagen']) : '' }}"
                              onclick="pdpSelectColor(this, '{{ addslashes($c['nombre']) }}')">  
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Characteristics --}}
                @if($producto->caracteristicas && count(array_filter($producto->caracteristicas)) > 0)
                <div class="pdp-feats">
                    @foreach(array_filter($producto->caracteristicas) as $feat)
                    <span class="pdp-feat-chip">✓ {{ $feat }}</span>
                    @endforeach
                </div>
                @endif

                {{-- CTAs --}}
                <div style="display:flex;flex-wrap:wrap;gap:.75rem;margin-top:1.8rem;">
                    <a href="{{ route('contacto') }}" class="btn btn-primary"
                       style="flex:1;min-width:180px;justify-content:center;font-size:1rem;">
                        🛒 Solicitar presupuesto
                    </a>
                    <a href="{{ route('productos') }}" class="btn btn-outline"
                       style="justify-content:center;">
                        ← Catálogo
                    </a>
                </div>
                <p style="font-size:.75rem;color:var(--gray-400);margin-top:.9rem;line-height:1.7;">
                    ✅ Respuesta en &lt;24h &nbsp;·&nbsp; Sin pedido mínimo* &nbsp;·&nbsp; Envío a toda España
                </p>
            </div>

        </div>
    </div>
</section>

{{-- Related products --}}
@if($relacionados->isNotEmpty())
<section class="section" style="background:var(--gray-50);padding-top:2.5rem;padding-bottom:3rem;">
    <div class="container">
        <div class="reveal" style="margin-bottom:2rem;">
            <span class="section-eyebrow">También te puede interesar</span>
            <h2 class="section-title" style="font-size:1.45rem;">
                Más de <span class="hl">{{ $producto->nombre_categoria }}</span>
            </h2>
        </div>
        <div class="related-grid">
            @foreach($relacionados as $r)
            <a href="{{ route('producto.show', $r) }}" class="related-card reveal delay-{{ $loop->iteration }}">
                <div class="related-card-thumb"
                     style="{{ ($r->imagenes && count($r->imagenes) > 0) ? '' : 'background:linear-gradient(135deg,'.$r->color_inicio.','.$r->color_fin.');' }}">
                    @if($r->imagenes && count($r->imagenes) > 0)
                    <img src="{{ $r->url_imagen }}" alt="{{ $r->nombre }}"
                         style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
                    @else
                    <span>{{ $r->emoji ?: '📦' }}</span>
                    @endif
                </div>
                <div class="related-card-body">
                    <div class="related-card-name">{{ $r->nombre }}</div>
                    @if($r->precio_desde)
                    <div class="related-card-price">{{ $r->precio_desde }}</div>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<div class="cta-band">
    <div class="container">
        <div class="reveal">
            <h2>¿Tienes dudas sobre este producto?</h2>
            <p>Cuéntanos tu pedido y te damos precio en menos de 24h.</p>
            <a href="{{ route('contacto') }}"
               style="display:inline-flex;align-items:center;gap:.5rem;background:white;color:var(--coral);font-weight:900;font-size:1rem;text-decoration:none;padding:1rem 2.5rem;border-radius:50px;box-shadow:0 8px 30px rgba(0,0,0,.2);">
                🛒 Solicitar presupuesto gratis
            </a>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function pdpSetImg(thumbEl, url) {
    var main = document.getElementById('pdp-main-img');
    if (main) {
        main.style.opacity = '.5';
        main.src = url;
        main.onload = function () { main.style.opacity = '1'; };
    }
    document.querySelectorAll('.pdp-thumb').forEach(function (t) { t.classList.remove('active'); });
    thumbEl.classList.add('active');
}

function pdpSelectColor(swatchEl, name) {
    document.querySelectorAll('.pdp-swatch').forEach(function (s) { s.classList.remove('selected'); });
    swatchEl.classList.add('selected');
    var lbl = document.getElementById('selected-color-name');
    if (lbl) lbl.textContent = name ? '\u2014 ' + name : '';
    var imgUrl = swatchEl.dataset.imagen;
    if (imgUrl) {
        var main = document.getElementById('pdp-main-img');
        if (main) {
            main.style.opacity = '.5';
            main.src = imgUrl;
            main.onload = function () { main.style.opacity = '1'; };
        }
        document.querySelectorAll('.pdp-thumb').forEach(function (t) { t.classList.remove('active'); });
    }
}

// Show first color name on load
(function () {
    var first = document.querySelector('.pdp-swatch.selected');
    if (first && first.title) {
        var lbl = document.getElementById('selected-color-name');
        if (lbl) lbl.textContent = '— ' + first.title;
    }
}());
</script>
@endpush
