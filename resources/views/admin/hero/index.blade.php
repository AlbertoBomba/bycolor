@extends('layouts.admin')

@section('admin_title', 'Hero · Carrusel')

@section('admin_content')

<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2rem;">
    <div>
        <h1 style="font-size:1.4rem;font-weight:900;color:var(--navy);">🖼️ Hero · Carrusel de portada</h1>
        <p style="font-size:.82rem;color:var(--gray-400);margin-top:.2rem;">
            Gestiona los slides del carrusel que aparecen en la cabecera de la página de inicio.
        </p>
    </div>
    <a href="{{ route('admin.hero.create') }}" class="btn btn-primary btn-sm">+ Añadir slide</a>
</div>

@if(session('success'))
<div style="background:#dcfce7;color:#166534;border:1px solid #bbf7d0;border-radius:10px;padding:.8rem 1.2rem;margin-bottom:1.5rem;font-weight:700;font-size:.88rem;">
    ✅ {{ session('success') }}
</div>
@endif

@if($slides->isEmpty())
<div style="text-align:center;padding:4rem 2rem;color:var(--gray-400);background:white;border-radius:var(--radius-lg);border:2px dashed var(--gray-200);">
    <div style="font-size:3rem;margin-bottom:.8rem;">🖼️</div>
    <div style="font-weight:700;font-size:1rem;margin-bottom:.4rem;">No hay slides todavía</div>
    <div style="font-size:.85rem;margin-bottom:1.5rem;">
        Añade el primero para activar el carrusel en la portada. Mientras no haya slides, se muestra el hero por defecto.
    </div>
    <a href="{{ route('admin.hero.create') }}" class="btn btn-primary btn-sm">+ Añadir primer slide</a>
</div>

@else
<div style="display:grid;gap:1rem;">
    @foreach($slides as $slide)
    <div class="admin-card" style="border-left:4px solid {{ $slide->activo ? 'var(--mint)' : 'var(--gray-200)' }};">
        <div class="admin-card-body" style="display:flex;align-items:center;gap:1.2rem;flex-wrap:wrap;padding:1rem 1.2rem;">

            {{-- Thumbnail --}}
            <div style="width:120px;height:68px;border-radius:8px;overflow:hidden;flex-shrink:0;background:var(--gray-100);">
                @if($slide->tipo_media === 'video')
                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#1a1a2e;color:white;font-size:1.8rem;">▶</div>
                @else
                <img src="{{ asset('storage/'.$slide->ruta_media) }}" alt=""
                     style="width:100%;height:100%;object-fit:cover;">
                @endif
            </div>

            {{-- Info --}}
            <div style="flex:1;min-width:0;">
                <div style="font-weight:800;color:var(--navy);font-size:.95rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                    {{ $slide->titulo ?: '(Sin título)' }}
                </div>
                @if($slide->subtitulo)
                <div style="font-size:.78rem;color:var(--gray-400);margin-top:.1rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                    {{ $slide->subtitulo }}
                </div>
                @endif
                <div style="display:flex;gap:.5rem;margin-top:.4rem;flex-wrap:wrap;">
                    <span style="font-size:.7rem;padding:.2rem .6rem;background:{{ $slide->tipo_media === 'video' ? '#EDE9FE' : '#DBEAFE' }};color:{{ $slide->tipo_media === 'video' ? '#6D28D9' : '#1D4ED8' }};border-radius:50px;font-weight:700;">
                        {{ $slide->tipo_media === 'video' ? '🎬 Vídeo' : '🖼️ Imagen' }}
                    </span>
                    <span style="font-size:.7rem;padding:.2rem .6rem;background:{{ $slide->activo ? '#D1FAE5' : '#F3F4F6' }};color:{{ $slide->activo ? '#065F46' : '#6B7280' }};border-radius:50px;font-weight:700;">
                        {{ $slide->activo ? '✅ Activo' : '⏸ Inactivo' }}
                    </span>
                </div>
            </div>

            {{-- Order controls --}}
            <div style="display:flex;flex-direction:column;gap:.3rem;flex-shrink:0;">
                @if(!$loop->first)
                <form method="POST" action="{{ route('admin.hero.subir', $slide) }}">
                    @csrf @method('PATCH')
                    <button type="submit" title="Mover arriba"
                            style="background:var(--gray-100);border:none;width:28px;height:28px;border-radius:6px;cursor:pointer;font-size:.8rem;line-height:1;">▲</button>
                </form>
                @endif
                @if(!$loop->last)
                <form method="POST" action="{{ route('admin.hero.bajar', $slide) }}">
                    @csrf @method('PATCH')
                    <button type="submit" title="Mover abajo"
                            style="background:var(--gray-100);border:none;width:28px;height:28px;border-radius:6px;cursor:pointer;font-size:.8rem;line-height:1;">▼</button>
                </form>
                @endif
            </div>

            {{-- Actions --}}
            <div style="display:flex;gap:.5rem;flex-shrink:0;flex-wrap:wrap;">
                <form method="POST" action="{{ route('admin.hero.toggle', $slide) }}">
                    @csrf @method('PATCH')
                    <button type="submit"
                            style="background:{{ $slide->activo ? '#FEF3C7' : '#D1FAE5' }};color:{{ $slide->activo ? '#92400E' : '#065F46' }};border:none;padding:.35rem .85rem;border-radius:8px;cursor:pointer;font-size:.8rem;font-weight:700;">
                        {{ $slide->activo ? '⏸ Ocultar' : '✅ Activar' }}
                    </button>
                </form>
                <a href="{{ route('admin.hero.edit', $slide) }}" class="btn btn-secondary btn-sm">✏️ Editar</a>
                <form method="POST" action="{{ route('admin.hero.destroy', $slide) }}"
                      onsubmit="return confirm('¿Eliminar este slide? El archivo también se borrará y no se puede deshacer.')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            style="background:#FEE2E2;color:#991B1B;border:none;padding:.35rem .85rem;border-radius:8px;cursor:pointer;font-size:.8rem;font-weight:700;">
                        🗑 Eliminar
                    </button>
                </form>
            </div>

        </div>
    </div>
    @endforeach
</div>
@endif

@endsection
