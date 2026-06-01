@extends('layouts.admin')

@section('admin_title', 'Opiniones')

@section('admin_content')

<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2rem;">
    <div>
        <h1 style="font-size:1.4rem;font-weight:900;color:var(--navy);">Opiniones de clientes</h1>
        <p style="font-size:.82rem;color:var(--gray-400);margin-top:.2rem;">Gestiona las valoraciones enviadas desde la web. Apruébalas para que aparezcan en la página de inicio.</p>
    </div>
</div>

@if(session('success'))
<div style="background:#dcfce7;color:#166534;border:1px solid #bbf7d0;border-radius:10px;padding:.8rem 1.2rem;margin-bottom:1.5rem;font-weight:700;font-size:.88rem;">
    ✅ {{ session('success') }}
</div>
@endif

{{-- Stats --}}
<div class="stat-row" style="margin-bottom:2rem;">
    <div class="stat-card">
        <div class="val">{{ $opiniones->total() }}</div>
        <div class="lbl">Total</div>
    </div>
    <div class="stat-card" style="border-left:4px solid #D97706;">
        <div class="val" style="color:#D97706;">{{ $opiniones->where('aprobada', false)->count() }}</div>
        <div class="lbl">Pendientes</div>
    </div>
    <div class="stat-card" style="border-left:4px solid #166534;">
        <div class="val" style="color:#166534;">{{ $opiniones->where('aprobada', true)->count() }}</div>
        <div class="lbl">Publicadas</div>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-body" style="padding:0;">
        @if($opiniones->isEmpty())
        <div style="text-align:center;padding:3rem;color:var(--gray-400);">
            <div style="font-size:2.5rem;margin-bottom:.7rem;">💬</div>
            <div style="font-weight:700;">No hay opiniones todavía</div>
            <div style="font-size:.82rem;margin-top:.3rem;">Aparecerán aquí cuando los clientes envíen su valoración.</div>
        </div>
        @else
        <table style="width:100%;border-collapse:collapse;font-size:.85rem;">
            <thead>
                <tr style="border-bottom:2px solid var(--gray-100);">
                    <th style="padding:.85rem 1.2rem;text-align:left;font-weight:800;color:var(--navy);">Cliente</th>
                    <th style="padding:.85rem 1.2rem;text-align:left;font-weight:800;color:var(--navy);">Valoración</th>
                    <th style="padding:.85rem 1.2rem;text-align:left;font-weight:800;color:var(--navy);">Opinión</th>
                    <th style="padding:.85rem 1.2rem;text-align:left;font-weight:800;color:var(--navy);">Trabajo</th>
                    <th style="padding:.85rem 1.2rem;text-align:left;font-weight:800;color:var(--navy);">Fecha</th>
                    <th style="padding:.85rem 1.2rem;text-align:center;font-weight:800;color:var(--navy);">Estado</th>
                    <th style="padding:.85rem 1.2rem;text-align:center;font-weight:800;color:var(--navy);">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($opiniones as $op)
                <tr style="border-bottom:1px solid var(--gray-100);{{ $loop->even ? 'background:var(--gray-50);' : '' }}">
                    <td style="padding:.85rem 1.2rem;">
                        <div style="font-weight:700;color:var(--navy);">{{ $op->nombre }}</div>
                        @if($op->email)
                        <div style="font-size:.76rem;color:var(--gray-400);">{{ $op->email }}</div>
                        @endif
                    </td>
                    <td style="padding:.85rem 1.2rem;">
                        <span style="color:#F59E0B;font-size:1rem;letter-spacing:.05em;">
                            {{ str_repeat('★', $op->valoracion) }}{{ str_repeat('☆', 5 - $op->valoracion) }}
                        </span>
                    </td>
                    <td style="padding:.85rem 1.2rem;max-width:280px;">
                        <div style="color:var(--gray-600);line-height:1.5;overflow:hidden;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;">
                            {{ $op->texto }}
                        </div>
                    </td>
                    <td style="padding:.85rem 1.2rem;">
                        @if($op->trabajo)
                        <span style="font-size:.8rem;color:var(--coral);font-weight:700;">{{ $op->trabajo->titulo }}</span>
                        @else
                        <span style="color:var(--gray-300);font-size:.8rem;">—</span>
                        @endif
                    </td>
                    <td style="padding:.85rem 1.2rem;white-space:nowrap;color:var(--gray-400);font-size:.78rem;">
                        {{ $op->created_at->format('d/m/Y') }}
                    </td>
                    <td style="padding:.85rem 1.2rem;text-align:center;">
                        @if($op->aprobada)
                        <span style="background:#dcfce7;color:#166534;font-size:.72rem;font-weight:800;padding:.25rem .7rem;border-radius:50px;">Publicada</span>
                        @else
                        <span style="background:#fef3c7;color:#92400e;font-size:.72rem;font-weight:800;padding:.25rem .7rem;border-radius:50px;">Pendiente</span>
                        @endif
                    </td>
                    <td style="padding:.85rem 1.2rem;text-align:center;">
                        <div style="display:flex;gap:.4rem;justify-content:center;flex-wrap:wrap;">
                            @if(!$op->aprobada)
                            <form method="POST" action="{{ route('admin.opiniones.aprobar', $op) }}">
                                @csrf @method('PATCH')
                                <button type="submit" title="Aprobar"
                                    style="background:#dcfce7;color:#166534;border:none;border-radius:8px;padding:.35rem .7rem;cursor:pointer;font-size:.78rem;font-weight:700;">
                                    ✅ Publicar
                                </button>
                            </form>
                            @else
                            <form method="POST" action="{{ route('admin.opiniones.rechazar', $op) }}">
                                @csrf @method('PATCH')
                                <button type="submit" title="Ocultar"
                                    style="background:#fef3c7;color:#92400e;border:none;border-radius:8px;padding:.35rem .7rem;cursor:pointer;font-size:.78rem;font-weight:700;">
                                    🙈 Ocultar
                                </button>
                            </form>
                            @endif
                            <form method="POST" action="{{ route('admin.opiniones.destroy', $op) }}"
                                  onsubmit="return confirm('¿Eliminar esta opinión?')">
                                @csrf @method('DELETE')
                                <button type="submit" title="Eliminar"
                                    style="background:#fee2e2;color:#dc2626;border:none;border-radius:8px;padding:.35rem .7rem;cursor:pointer;font-size:.78rem;font-weight:700;">
                                    🗑
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($opiniones->hasPages())
        <div style="padding:1.2rem 1.5rem;">
            {{ $opiniones->links() }}
        </div>
        @endif
        @endif
    </div>
</div>

@endsection
