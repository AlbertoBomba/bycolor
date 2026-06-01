@extends('layouts.site')

@section('title', 'Productos · Camisetas, Polos y Sudaderas Personalizadas | bycolor.es')
@section('description', 'Catálogo completo de prendas personalizables: camisetas básicas, polos corporativos, sudaderas y ropa técnica deportiva. Serigrafía, bordado y DTG desde 1 unidad.')
@section('canonical', 'https://bycolor.es/productos')

@push('styles')
<style>
    .cat-tabs { display:flex; flex-wrap:wrap; gap:.6rem; margin-bottom:3rem; }
    .products-full-grid { display:grid; grid-template-columns:1fr; gap:1.8rem; }
    .product-card-lg { background:white; border-radius:var(--radius-lg); overflow:hidden; box-shadow:var(--shadow); border:2px solid transparent; transition:all .35s ease; }
    .product-card-lg:hover { transform:translateY(-7px); box-shadow:var(--shadow-lg); border-color:rgba(255,87,51,.2); }
    .product-card-lg-thumb { height:240px; display:flex; align-items:center; justify-content:center; font-size:6rem; position:relative; overflow:hidden; }
    .product-card-lg-body  { padding:1.6rem; }
    .product-card-lg-name  { font-size:1.15rem; font-weight:800; color:var(--navy); margin-bottom:.5rem; }
    .product-card-lg-desc  { font-size:.88rem; color:var(--gray-600); line-height:1.65; margin-bottom:1rem; }
    .product-card-lg-feats { display:flex; flex-wrap:wrap; gap:.4rem; margin-bottom:1rem; }
    .feat-chip { font-size:.7rem; font-weight:700; padding:.25rem .7rem; background:var(--gray-100); color:var(--gray-600); border-radius:50px; }
    .product-card-lg-footer { display:flex; align-items:center; justify-content:space-between; }
    .product-card-lg { position:relative; }
    .card-link { position:absolute; inset:0; z-index:1; border-radius:var(--radius-lg); }
    .product-card-lg .img-gallery,
    .product-card-lg .product-colors-lg,
    .product-card-lg .product-card-lg-footer { position:relative; z-index:2; }
    .product-colors-lg { display:flex; flex-wrap:wrap; gap:.35rem; margin-bottom:1rem; align-items:center; }
    .color-swatch-lg { width:22px; height:22px; border-radius:50%; border:2px solid rgba(0,0,0,.12); flex-shrink:0; cursor:pointer; transition:transform .2s; }
    .color-swatch-lg:hover { transform:scale(1.25); }
    .img-gallery { display:flex; gap:.4rem; margin-top:.5rem; }
    .img-gallery-thumb { width:40px; height:40px; border-radius:5px; object-fit:cover; cursor:pointer; border:2px solid transparent; opacity:.7; transition:all .2s; }
    .img-gallery-thumb.active, .img-gallery-thumb:hover { border-color:var(--coral); opacity:1; }

    /* Techniques */
    .tech-grid { display:grid; grid-template-columns:1fr; gap:1.2rem; }
    .tech-card {
        display:flex; align-items:flex-start; gap:1.1rem;
        background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.1);
        border-radius:var(--radius); padding:1.5rem;
    }
    .tech-card-icon { font-size:2rem; flex-shrink:0; }
    .tech-card h4 { font-size:.95rem; font-weight:800; color:white; margin-bottom:.3rem; }
    .tech-card p  { font-size:.82rem; color:rgba(255,255,255,.55); line-height:1.6; margin:0; }
    .tech-card .from { font-size:.72rem; font-weight:800; color:var(--gold); letter-spacing:.08em; text-transform:uppercase; margin-top:.5rem; }

    @media (min-width:600px)  { .products-full-grid { grid-template-columns:repeat(2,1fr); } .tech-grid { grid-template-columns:repeat(2,1fr); } }
    @media (min-width:900px)  { .products-full-grid { grid-template-columns:repeat(3,1fr); } }
    @media (min-width:1100px) { .products-full-grid { grid-template-columns:repeat(4,1fr); } .tech-grid { grid-template-columns:repeat(4,1fr); } }
</style>
@endpush

@section('content')

<section class="page-header">
    <div class="container" style="position:relative;z-index:1;">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Inicio</a><span>/</span>
            <span style="color:rgba(255,255,255,.8);">Productos</span>
        </div>
        <h1>Nuestros <span style="color:var(--coral);">productos</span></h1>
        <p>Prendas de calidad premium listas para personalizar con tu diseño, logo o texto.</p>
    </div>
</section>

{{-- Products --}}
<section class="section" style="background:var(--gray-50);">
    <div class="container">
        @if($productos->isNotEmpty())
        @php
            $cats = $productos->pluck('categoria')->unique()->filter()->sort()->values();
            $multiples = $cats->count() > 1;
        @endphp
        @if($multiples)
        <div class="cat-tabs reveal">
            <button class="btn btn-primary btn-sm cat-btn active" data-cat="all">Todos</button>
            @foreach($cats as $cat)
            <button class="btn btn-outline btn-sm cat-btn" data-cat="{{ $cat }}">{{ \App\Models\Producto::CATEGORIAS[$cat] ?? $cat }}</button>
            @endforeach
        </div>
        @endif

        <div class="products-full-grid" id="products-grid">
            @foreach($productos as $p)
            <div class="product-card-lg prod-item reveal delay-{{ ($loop->index % 4) + 1 }}" data-cat="{{ $p->categoria }}">
                <a href="{{ route('producto.show', $p) }}" class="card-link" aria-label="Ver {{ $p->nombre }}"></a>
                <div class="product-card-lg-thumb" id="thumb-{{ $p->id }}"
                     style="{{ ($p->imagenes && count($p->imagenes) > 0) ? '' : 'background:linear-gradient(135deg,'.$p->color_inicio.','.$p->color_fin.');' }}">
                    @if($p->imagenes && count($p->imagenes) > 0)
                        <img src="{{ $p->url_imagen }}" alt="{{ $p->nombre }}" id="main-img-{{ $p->id }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
                    @else
                        <span>{{ $p->emoji }}</span>
                    @endif
                    @if($p->badge)
                    <span class="product-tag badge {{ $p->badge_tipo }}" style="position:absolute;top:12px;right:12px;">{{ $p->badge }}</span>
                    @endif
                </div>
                <div class="product-card-lg-body">
                    <div class="product-card-lg-name">{{ $p->nombre }}</div>
                    @if($p->imagenes && count($p->imagenes) > 1)
                    <div class="img-gallery">
                        @foreach($p->url_imagenes as $idx => $url)
                        <img src="{{ $url }}" alt="" class="img-gallery-thumb {{ $idx === 0 ? 'active' : '' }}"
                             onclick="setMainImg('main-img-{{ $p->id }}', this, '{{ $url }}')">
                        @endforeach
                    </div>
                    @endif
                    @if($p->colores && count($p->colores) > 0)
                    <div class="product-colors-lg">
                        @foreach(array_slice($p->colores, 0, 12) as $c)
                        <span class="color-swatch-lg" style="background:{{ $c['hex'] }};" title="{{ $c['nombre'] }}"
                              @if(!empty($c['imagen'])) onclick="setCardColorImg('main-img-{{ $p->id }}', '{{ asset('storage/'.$c['imagen']) }}')" @endif></span>
                        @endforeach
                        @if(count($p->colores) > 12)<span style="font-size:.72rem;color:var(--gray-400);">+{{ count($p->colores) - 12 }} colores</span>@endif
                    </div>
                    @endif
                    @if($p->descripcion)
                    <div class="product-card-lg-desc">{{ Str::limit($p->descripcion, 110) }}</div>
                    @endif
                    @if($p->caracteristicas && count(array_filter($p->caracteristicas)) > 0)
                    <div class="product-card-lg-feats">
                        @foreach(array_filter($p->caracteristicas) as $feat)
                        <span class="feat-chip">{{ $feat }}</span>
                        @endforeach
                    </div>
                    @endif
                    <div class="product-card-lg-footer">
                        @if($p->precio_desde)
                        <div class="product-price" style="font-size:1rem;font-weight:900;color:var(--coral);">{{ $p->precio_desde }}</div>
                        @else
                        <div></div>
                        @endif
                        <a href="{{ route('contacto') }}" class="btn btn-primary btn-sm">Pedir ahora</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div style="text-align:center;padding:4rem 0;">
            <p style="font-size:1.1rem;color:var(--gray-400);">Próximamente disponible. <a href="{{ route('contacto') }}" style="color:var(--coral);font-weight:700;">Consúltanos →</a></p>
        </div>
        @endif

        <div class="reveal" style="text-align:center;margin-top:2.5rem;">
            <p style="font-size:.9rem;color:var(--gray-400);">¿No encuentras lo que buscas?
                <a href="{{ route('contacto') }}" style="color:var(--coral);font-weight:700;">Cuéntanos tu idea →</a>
            </p>
        </div>
    </div>
</section>

<script>
function setMainImg(mainImgId, thumbEl, url) {
    var mainImg = document.getElementById(mainImgId);
    if (mainImg) mainImg.src = url;
    var gallery = thumbEl.closest('.img-gallery');
    if (gallery) {
        gallery.querySelectorAll('.img-gallery-thumb').forEach(function (t) { t.classList.remove('active'); });
    }
    thumbEl.classList.add('active');
}
function setCardColorImg(mainImgId, url) {
    var mainImg = document.getElementById(mainImgId);
    if (mainImg) mainImg.src = url;
}
</script>

<script>
(function () {
    var btns  = document.querySelectorAll('.cat-btn');
    var items = document.querySelectorAll('.prod-item');
    btns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var cat = btn.dataset.cat;
            btns.forEach(function (b) {
                b.classList.remove('active', 'btn-primary');
                b.classList.add('btn-outline');
            });
            btn.classList.add('active', 'btn-primary');
            btn.classList.remove('btn-outline');
            items.forEach(function (item) {
                item.style.display = (cat === 'all' || item.dataset.cat === cat) ? '' : 'none';
            });
        });
    });
}());
</script>

{{-- Techniques --}}
<section class="section" style="background:linear-gradient(135deg,var(--navy),#0F3460);">
    <div class="container">
        <div class="reveal" style="text-align:center;margin-bottom:3rem;">
            <span class="section-eyebrow gold">Técnicas de impresión</span>
            <h2 class="section-title" style="color:white;">¿Cómo <span style="color:var(--coral);">personalizamos</span>?</h2>
            <p style="color:rgba(255,255,255,.55);margin-top:.7rem;font-size:.95rem;max-width:520px;margin-left:auto;margin-right:auto;">Elegimos la técnica óptima según tu diseño, cantidad y tipo de prenda</p>
        </div>
        <div class="tech-grid">
            @foreach([
                ['icon'=>'🖨️','title'=>'DTG Digital','desc'=>'Impresión directa sobre tela. Sin límite de colores. Ideal para diseños complejos y pedidos pequeños.','from'=>'Desde 1 unidad'],
                ['icon'=>'🎨','title'=>'Serigrafía','desc'=>'Técnica clásica de alta durabilidad. Colores muy vibrantes y resistencia excepcional al lavado.','from'=>'Desde 10 unidades'],
                ['icon'=>'🧵','title'=>'Bordado','desc'=>'Acabado premium y profesional. Relieve táctil y durabilidad máxima. Perfecto para logos corporativos.','from'=>'Desde 5 unidades'],
                ['icon'=>'🌈','title'=>'Sublimación','desc'=>'Impresión full-color en tejidos sintéticos. Colores integrados en la fibra. No se despega ni cuartea.','from'=>'Desde 1 unidad'],
            ] as $tech)
            <div class="tech-card reveal delay-{{ $loop->iteration }}">
                <div class="tech-card-icon">{{ $tech['icon'] }}</div>
                <div>
                    <h4>{{ $tech['title'] }}</h4>
                    <p>{{ $tech['desc'] }}</p>
                    <div class="from">{{ $tech['from'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="cta-band">
    <div class="container">
        <div class="reveal">
            <h2>¿Cuántas unidades necesitas?</h2>
            <p>Cuéntanos tu pedido y te damos precio en menos de 24h.</p>
            <a href="{{ route('contacto') }}"
               style="display:inline-flex;align-items:center;gap:.5rem;background:white;color:var(--coral);font-weight:900;font-size:1rem;text-decoration:none;padding:1rem 2.5rem;border-radius:50px;box-shadow:0 8px 30px rgba(0,0,0,.2);">
                🛒 Solicitar presupuesto gratis
            </a>
        </div>
    </div>
</div>

@endsection
