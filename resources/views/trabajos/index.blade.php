@extends('layouts.site')

@section('title', 'Trabajos Realizados | Galería de Camisetas Personalizadas | bycolor.es')
@section('description', 'Galería de trabajos realizados: camisetas personalizadas, polos corporativos, sudaderas y más. Ve los proyectos reales que hemos completado para nuestros clientes.')
@section('canonical', 'https://bycolor.es/trabajos')

@push('styles')
<style>
    /* Grid */
    .works-grid { display:grid; grid-template-columns:1fr; gap:1.5rem; }
    @media (min-width:600px)  { .works-grid { grid-template-columns:repeat(2,1fr); } }
    @media (min-width:900px)  { .works-grid { grid-template-columns:repeat(3,1fr); } }
    @media (min-width:1200px) { .works-grid { grid-template-columns:repeat(4,1fr); } }

    /* Card */
    .work-card { cursor:pointer; border-radius:18px; overflow:hidden; background:white;
        box-shadow:var(--shadow-sm); transition:transform .25s,box-shadow .25s; }
    .work-card:hover { transform:translateY(-6px); box-shadow:var(--shadow-md); }
    .work-card-img { width:100%; aspect-ratio:4/3; object-fit:cover; display:block; }
    .work-card-img-placeholder {
        width:100%; aspect-ratio:4/3; background:linear-gradient(135deg,var(--navy),var(--coral));
        display:flex; align-items:center; justify-content:center; font-size:3rem;
    }
    .work-card-body { padding:1rem 1.2rem 1.2rem; }
    .work-card-cat  { font-size:.68rem; font-weight:800; letter-spacing:.08em; text-transform:uppercase;
        color:var(--coral); margin-bottom:.35rem; }
    .work-card-title { font-size:.97rem; font-weight:800; color:var(--navy); margin-bottom:.35rem;
        white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .work-card-desc { font-size:.78rem; color:var(--gray-400); margin-bottom:.6rem;
        display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
    .work-card-date { font-size:.72rem; color:var(--gray-400); display:flex; align-items:center; gap:.35rem; }
    .work-card-view-btn {
        display:inline-flex; align-items:center; gap:.4rem; margin-top:.8rem;
        font-size:.75rem; font-weight:700; color:var(--coral); text-decoration:none;
        background:rgba(255,87,51,.08); padding:.35rem .85rem; border-radius:50px;
        transition:background .2s;
    }
    .work-card:hover .work-card-view-btn { background:rgba(255,87,51,.16); }

    /* Pagination */
    .pagination-wrap { display:flex; justify-content:center; align-items:center; gap:.5rem; margin-top:3rem; flex-wrap:wrap; }
    .page-btn { width:38px; height:38px; display:flex; align-items:center; justify-content:center;
        border-radius:10px; font-size:.82rem; font-weight:700; border:2px solid var(--gray-200);
        color:var(--gray-600); text-decoration:none; transition:all .2s; }
    .page-btn:hover   { border-color:var(--coral); color:var(--coral); }
    .page-btn.active  { background:var(--coral); border-color:var(--coral); color:white; }
    .page-btn.disabled{ opacity:.4; pointer-events:none; }

    /* Empty state */
    .empty-state { text-align:center; padding:5rem 1rem; }
    .empty-state .icon { font-size:4rem; margin-bottom:1.2rem; }
    .empty-state h3 { font-size:1.5rem; font-weight:800; color:var(--navy); margin-bottom:.6rem; }
    .empty-state p  { font-size:.9rem; color:var(--gray-400); max-width:400px; margin:0 auto 2rem; line-height:1.7; }

    /* ===== MODAL ===== */
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

    /* Gallery panel */
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
    .wmodal-prev { left:.6rem; }
    .wmodal-next { right:.6rem; }
    .wmodal-counter { position:absolute; bottom:.5rem; right:.7rem;
        background:rgba(0,0,0,.55); color:white; font-size:.7rem; font-weight:700;
        padding:.2rem .6rem; border-radius:20px; }

    /* Info panel */
    .wmodal-info { padding:1.8rem; display:flex; flex-direction:column; gap:.9rem; }
    .wmodal-close {
        position:absolute; top:1rem; right:1rem; z-index:10;
        background:rgba(255,255,255,.15); backdrop-filter:blur(4px);
        color:white; border:none; width:36px; height:36px; border-radius:50%;
        font-size:1.1rem; cursor:pointer; display:flex; align-items:center; justify-content:center;
        transition:background .2s;
    }
    @media (min-width:720px) {
        .wmodal-close { background:rgba(0,0,0,.15); top:-.5rem; right:-.5rem;
            position:sticky; float:right; margin:-1.8rem -1.8rem 0 auto; }
    }
    .wmodal-close:hover { background:var(--coral); }
    .wmodal-badge { display:inline-flex; align-items:center; gap:.35rem;
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

{{-- Page header --}}
<section class="page-header">
    <div class="container" style="position:relative;z-index:1;">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Inicio</a>
            <span>/</span>
            <span style="color:rgba(255,255,255,.8);">Trabajos</span>
        </div>
        <h1>Trabajos <span style="color:var(--coral);">realizados</span></h1>
        <p>Proyectos reales completados para nuestros clientes. Calidad y personalización en cada prenda.</p>
    </div>
</section>

<section class="section" style="background:var(--gray-50);">
    <div class="container">

        {{-- Filter tabs --}}
        @if($categorias->isNotEmpty())
        <div style="margin-bottom:2.5rem;" class="reveal">
            <div class="filter-tabs">
                <a href="{{ route('trabajos.index') }}"
                   class="filter-tab {{ $categoria === 'todos' || !$categoria ? 'active' : '' }}">Todos</a>
                @foreach($categorias as $cat)
                <a href="{{ route('trabajos.index', ['categoria' => $cat]) }}"
                   class="filter-tab {{ $categoria === $cat ? 'active' : '' }}">
                    {{ \App\Models\Trabajo::listaCategorias()[$cat] ?? ucfirst($cat) }}
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Grid --}}
        @if($trabajos->isNotEmpty())
        <div class="works-grid">
            @foreach($trabajos as $trabajo)
            @php
                $allImgs = $trabajo->imagenes->map(fn($i) => $i->ruta_url)->values();
                if($allImgs->isEmpty() && $trabajo->imagen) $allImgs = collect([asset('storage/'.$trabajo->imagen)]);
                $icons = ['camiseta'=>'👕','polo'=>'👔','sudadera'=>'🧥','sport'=>'🎽','uniforme'=>'🦺','otro'=>'✨'];
                $catLabel = \App\Models\Trabajo::listaCategorias()[$trabajo->categoria] ?? ucfirst($trabajo->categoria);
            @endphp
            <div class="work-card reveal delay-{{ ($loop->index % 4) + 1 }}"
                 onclick="openModal({{ json_encode([
                     'titulo'     => $trabajo->titulo,
                     'categoria'  => $catLabel,
                     'descripcion'=> $trabajo->descripcion,
                     'fecha'      => $trabajo->fecha_realizacion->locale('es')->isoFormat('D [de] MMMM [de] YYYY'),
                     'imagenes'   => $allImgs,
                     'icono'      => $icons[$trabajo->categoria] ?? '👕',
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
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
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

        {{-- Pagination --}}
        @if($trabajos->hasPages())
        <div class="pagination-wrap">
            @if($trabajos->onFirstPage())
                <span class="page-btn disabled">←</span>
            @else
                <a href="{{ $trabajos->previousPageUrl() }}" class="page-btn">←</a>
            @endif
            @foreach($trabajos->getUrlRange(1, $trabajos->lastPage()) as $page => $url)
                @if($page == $trabajos->currentPage())
                    <span class="page-btn active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                @endif
            @endforeach
            @if($trabajos->hasMorePages())
                <a href="{{ $trabajos->nextPageUrl() }}" class="page-btn">→</a>
            @else
                <span class="page-btn disabled">→</span>
            @endif
        </div>
        @endif

        @else
        <div class="empty-state">
            <div class="icon">🎨</div>
            <h3>Próximamente aquí</h3>
            <p>Estamos preparando nuestra galería de trabajos. ¡Vuelve pronto para ver nuestros proyectos!</p>
            <a href="{{ route('contacto') }}" class="btn btn-primary">Solicitar presupuesto</a>
        </div>
        @endif

    </div>
</section>

{{-- CTA --}}
<div class="cta-band">
    <div class="container">
        <div class="reveal">
            <h2>¿Quieres tu proyecto aquí?</h2>
            <p>Cuéntanos tu idea y lo hacemos realidad.</p>
            <a href="{{ route('contacto') }}"
               style="display:inline-flex;align-items:center;gap:.5rem;background:white;color:var(--coral);font-weight:900;font-size:1rem;text-decoration:none;padding:1rem 2.5rem;border-radius:50px;box-shadow:0 8px 30px rgba(0,0,0,.2);">
                🛒 Pedir presupuesto gratis
            </a>
        </div>
    </div>
</div>

{{-- ===== MODAL ===== --}}
<div class="wmodal-overlay" id="wmodal-overlay" onclick="handleOverlayClick(event)">
    <div class="wmodal" id="wmodal" role="dialog" aria-modal="true">

        {{-- Gallery --}}
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

        {{-- Info --}}
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
        </div>

    </div>
</div>

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

    // Counter
    document.getElementById('wmodal-counter').textContent =
        _imgs.length > 1 ? `${_cur+1} / ${_imgs.length}` : '';

    // Nav buttons
    prev.style.display = _imgs.length > 1 ? '' : 'none';
    next.style.display = _imgs.length > 1 ? '' : 'none';

    // Thumbnails
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
    const img = document.getElementById('wmodal-main-img');
    img.src = _imgs[_cur];
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
</script>
@endpush

@endsection
