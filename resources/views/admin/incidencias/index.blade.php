@extends('layouts.admin')

@section('admin_title', 'Incidencias')

@section('admin_content')

<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2rem;">
    <div>
        <h1 style="font-size:1.4rem;font-weight:900;color:var(--navy);">Incidencias</h1>
        <p style="font-size:.82rem;color:var(--gray-400);margin-top:.2rem;">Gestión de incidencias recibidas desde el formulario web</p>
    </div>
</div>

{{-- Stats --}}
<div class="stat-row" style="margin-bottom:2rem;">
    <div class="stat-card">
        <div class="val">{{ $totales['total'] }}</div>
        <div class="lbl">Total</div>
    </div>
    <div class="stat-card" style="border-left:4px solid #DC2626;">
        <div class="val" style="color:#DC2626;">{{ $totales['nueva'] }}</div>
        <div class="lbl">Nuevas</div>
    </div>
    <div class="stat-card" style="border-left:4px solid #D97706;">
        <div class="val" style="color:#D97706;">{{ $totales['en_proceso'] }}</div>
        <div class="lbl">En proceso</div>
    </div>
    <div class="stat-card" style="border-left:4px solid #166534;">
        <div class="val" style="color:#166534;">{{ $totales['resuelta'] }}</div>
        <div class="lbl">Resueltas</div>
    </div>
</div>

{{-- Filtros --}}
<div class="admin-card" style="margin-bottom:1.5rem;">
    <div class="admin-card-body" style="padding:1rem 1.5rem;">
        <form method="GET" action="{{ route('admin.incidencias.index') }}"
              style="display:flex;gap:.75rem;flex-wrap:wrap;align-items:flex-end;">
            <div style="flex:1;min-width:180px;">
                <label class="form-label" style="display:block;margin-bottom:.3rem;">Buscar</label>
                <input
                    type="text"
                    name="buscar"
                    class="form-ctrl"
                    placeholder="Nombre, email, teléfono..."
                    value="{{ request('buscar') }}"
                    style="height:38px;padding:.4rem .8rem;font-size:.85rem;"
                >
            </div>
            <div style="min-width:150px;">
                <label class="form-label" style="display:block;margin-bottom:.3rem;">Estado</label>
                <select name="estado" class="form-ctrl" style="height:38px;padding:.4rem .8rem;font-size:.85rem;">
                    <option value="">Todos</option>
                    @foreach(\App\Models\Incidencia::estados() as $key => $info)
                    <option value="{{ $key }}" {{ request('estado') === $key ? 'selected' : '' }}>
                        {{ $info['label'] }}
                    </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" style="height:38px;">🔍 Filtrar</button>
            @if(request()->hasAny(['buscar','estado']))
            <a href="{{ route('admin.incidencias.index') }}" class="btn btn-secondary btn-sm" style="height:38px;">✕ Limpiar</a>
            @endif
        </form>
    </div>
</div>

{{-- Tabla --}}
<div class="admin-card">
    <div class="admin-card-header">
        <h2>Listado de incidencias</h2>
        <span style="font-size:.78rem;color:var(--gray-400);">{{ $incidencias->total() }} registro(s)</span>
    </div>

    @if($incidencias->isEmpty())
    <div style="text-align:center;padding:3.5rem 1rem;color:var(--gray-400);">
        <div style="font-size:3rem;margin-bottom:1rem;">📋</div>
        <p style="font-weight:600;margin-bottom:.4rem;">Sin incidencias</p>
        <p style="font-size:.82rem;">No hay incidencias que coincidan con los filtros aplicados.</p>
    </div>
    @else
    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Email / Teléfono</th>
                    <th>Imágenes</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($incidencias as $inc)
                @php $estado = $inc->estadoInfo(); @endphp
                <tr>
                    <td style="font-weight:700;color:var(--gray-400);font-size:.8rem;">#{{ $inc->id }}</td>
                    <td>
                        <div style="font-weight:700;font-size:.88rem;color:var(--navy);">
                            {{ $inc->nombre }} {{ $inc->apellidos }}
                        </div>
                        <div style="font-size:.75rem;color:var(--gray-400);margin-top:.15rem;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                            {{ $inc->donde_compro }}
                        </div>
                    </td>
                    <td style="font-size:.82rem;">
                        <div><a href="mailto:{{ $inc->email }}" style="color:var(--coral);">{{ $inc->email }}</a></div>
                        <div style="color:var(--gray-400);margin-top:.15rem;">{{ $inc->telefono }}</div>
                    </td>
                    <td style="font-size:.82rem;color:var(--gray-600);text-align:center;">
                        @if(!empty($inc->imagenes))
                            <span style="font-weight:700;">📷 {{ count($inc->imagenes) }}</span>
                        @else
                            <span style="color:var(--gray-200);">—</span>
                        @endif
                    </td>
                    <td>
                        <span style="
                            display:inline-block;font-size:.68rem;font-weight:800;text-transform:uppercase;
                            letter-spacing:.07em;padding:.2rem .65rem;border-radius:50px;
                            color:{{ $estado['color'] }};background:{{ $estado['bg'] }};
                        ">{{ $estado['label'] }}</span>
                    </td>
                    <td style="font-size:.8rem;color:var(--gray-600);white-space:nowrap;">
                        {{ $inc->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.incidencias.show', $inc) }}" class="btn btn-secondary btn-sm">👁️ Ver</a>
                            <form method="POST" action="{{ route('admin.incidencias.destroy', $inc) }}"
                                  onsubmit="return confirm('¿Eliminar la incidencia #{{ $inc->id }}? Esta acción no se puede deshacer.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    @if($incidencias->hasPages())
    <div class="pagination-wrap">
        @if($incidencias->onFirstPage())
            <span class="page-btn disabled">←</span>
        @else
            <a href="{{ $incidencias->previousPageUrl() }}" class="page-btn">←</a>
        @endif
        @foreach($incidencias->getUrlRange(1, $incidencias->lastPage()) as $page => $url)
            @if($page == $incidencias->currentPage())
                <span class="page-btn active">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
            @endif
        @endforeach
        @if($incidencias->hasMorePages())
            <a href="{{ $incidencias->nextPageUrl() }}" class="page-btn">→</a>
        @else
            <span class="page-btn disabled">→</span>
        @endif
    </div>
    @endif
    @endif
</div>

@endsection
