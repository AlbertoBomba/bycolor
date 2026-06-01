@extends('layouts.admin')

@section('admin_title', 'Productos')

@section('admin_content')

<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2rem;">
    <div>
        <h1 style="font-size:1.4rem;font-weight:900;color:var(--navy);">🛍️ Catálogo de productos</h1>
        <p style="font-size:.82rem;color:var(--gray-400);margin-top:.2rem;">
            Gestiona los productos que aparecen en la página de productos y en la portada (si están marcados como destacados).
        </p>
    </div>
    <a href="{{ route('admin.productos.create') }}" class="btn btn-primary btn-sm">+ Añadir producto</a>
</div>

@if(session('success'))
<div style="background:#dcfce7;color:#166534;border:1px solid #bbf7d0;border-radius:10px;padding:.8rem 1.2rem;margin-bottom:1.5rem;font-weight:700;font-size:.88rem;">
    ✅ {{ session('success') }}
</div>
@endif

{{-- Stats --}}
<div class="stat-row" style="margin-bottom:2rem;">
    <div class="stat-card">
        <div class="val">{{ $productos->count() }}</div>
        <div class="lbl">Total</div>
    </div>
    <div class="stat-card" style="border-left:4px solid var(--coral);">
        <div class="val" style="color:var(--coral);">{{ $productos->where('activo', true)->count() }}</div>
        <div class="lbl">Activos</div>
    </div>
    <div class="stat-card" style="border-left:4px solid var(--gold);">
        <div class="val" style="color:var(--gold);">{{ $productos->where('destacado', true)->count() }}</div>
        <div class="lbl">En portada</div>
    </div>
</div>

@if($productos->isEmpty())
<div style="text-align:center;padding:4rem 2rem;color:var(--gray-400);background:white;border-radius:var(--radius-lg);border:2px dashed var(--gray-200);">
    <div style="font-size:3rem;margin-bottom:.8rem;">🛍️</div>
    <div style="font-weight:700;font-size:1rem;margin-bottom:.4rem;">No hay productos todavía</div>
    <div style="font-size:.85rem;margin-bottom:1.5rem;">Añade el primero para que aparezca en la web.</div>
    <a href="{{ route('admin.productos.create') }}" class="btn btn-primary btn-sm">+ Añadir primer producto</a>
</div>

@else
<div class="admin-card">
    <div class="admin-card-body" style="padding:0;">
        <table style="width:100%;border-collapse:collapse;font-size:.85rem;">
            <thead>
                <tr style="border-bottom:2px solid var(--gray-100);">
                    <th style="padding:.85rem 1.2rem;text-align:left;font-weight:800;color:var(--navy);">Producto</th>
                    <th style="padding:.85rem 1.2rem;text-align:left;font-weight:800;color:var(--navy);">Categoría</th>
                    <th style="padding:.85rem 1.2rem;text-align:left;font-weight:800;color:var(--navy);">Precio</th>
                    <th style="padding:.85rem 1.2rem;text-align:center;font-weight:800;color:var(--navy);">Portada</th>
                    <th style="padding:.85rem 1.2rem;text-align:center;font-weight:800;color:var(--navy);">Estado</th>
                    <th style="padding:.85rem 1.2rem;text-align:center;font-weight:800;color:var(--navy);">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $p)
                <tr style="border-bottom:1px solid var(--gray-100);{{ $loop->even ? 'background:var(--gray-50);' : '' }}">
                    {{-- Producto --}}
                    <td style="padding:.85rem 1.2rem;">
                        <div style="display:flex;align-items:center;gap:.75rem;">
                            {{-- Mini thumb --}}
                            <div style="width:44px;height:44px;border-radius:8px;overflow:hidden;flex-shrink:0;background:linear-gradient(135deg,{{ $p->color_gradiente }});display:flex;align-items:center;justify-content:center;font-size:1.3rem;">
                                @if($p->imagenes && count($p->imagenes) > 0)
                                <img src="{{ $p->url_imagen }}" alt="" style="width:100%;height:100%;object-fit:cover;">
                                @else
                                {{ $p->emoji ?: '📦' }}
                                @endif
                            </div>
                            <div>
                                <div style="font-weight:800;color:var(--navy);">{{ $p->nombre }}</div>
                                @if($p->badge)
                                <span class="badge {{ $p->badge_tipo }}" style="font-size:.65rem;padding:.15rem .55rem;">{{ $p->badge }}</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    {{-- Categoría --}}
                    <td style="padding:.85rem 1.2rem;">
                        <span style="font-size:.78rem;font-weight:700;color:var(--gray-500);">{{ $p->nombre_categoria }}</span>
                    </td>
                    {{-- Precio --}}
                    <td style="padding:.85rem 1.2rem;">
                        <span style="font-size:.85rem;font-weight:700;color:var(--coral);">{{ $p->precio_desde ?: '—' }}</span>
                    </td>
                    {{-- Destacado --}}
                    <td style="padding:.85rem 1.2rem;text-align:center;">
                        <form method="POST" action="{{ route('admin.productos.toggleDestacado', $p) }}">
                            @csrf @method('PATCH')
                            <button type="submit" title="{{ $p->destacado ? 'Quitar de portada' : 'Mostrar en portada' }}"
                                    style="background:{{ $p->destacado ? '#FEF3C7' : 'var(--gray-100)' }};color:{{ $p->destacado ? '#92400E' : 'var(--gray-400)' }};border:none;width:30px;height:30px;border-radius:6px;cursor:pointer;font-size:.9rem;">
                                ⭐
                            </button>
                        </form>
                    </td>
                    {{-- Estado --}}
                    <td style="padding:.85rem 1.2rem;text-align:center;">
                        <form method="POST" action="{{ route('admin.productos.toggleActivo', $p) }}">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    style="background:{{ $p->activo ? '#D1FAE5' : '#F3F4F6' }};color:{{ $p->activo ? '#065F46' : '#6B7280' }};border:none;padding:.3rem .75rem;border-radius:50px;cursor:pointer;font-size:.75rem;font-weight:700;">
                                {{ $p->activo ? '✅ Activo' : '⏸ Inactivo' }}
                            </button>
                        </form>
                    </td>
                    {{-- Acciones --}}
                    <td style="padding:.85rem 1.2rem;text-align:center;">
                        <div style="display:flex;gap:.5rem;justify-content:center;">
                            <a href="{{ route('admin.productos.edit', $p) }}" class="btn btn-secondary btn-sm">✏️ Editar</a>
                            <form method="POST" action="{{ route('admin.productos.destroy', $p) }}"
                                  onsubmit="return confirm('¿Eliminar «{{ addslashes($p->nombre) }}»?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="background:#FEE2E2;color:#991B1B;border:none;padding:.3rem .75rem;border-radius:8px;cursor:pointer;font-size:.8rem;font-weight:700;">
                                    🗑
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection
