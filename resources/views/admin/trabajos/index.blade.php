@extends('layouts.admin')

@section('admin_title', 'Trabajos realizados')

@section('admin_content')

<div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2rem;">
    <div>
        <h1 style="font-size:1.4rem;font-weight:900;color:var(--navy);">Trabajos realizados</h1>
        <p style="font-size:.82rem;color:var(--gray-400);margin-top:.2rem;">Gestiona la galería pública de proyectos</p>
    </div>
    <a href="{{ route('admin.trabajos.create') }}" class="btn btn-primary">+ Añadir trabajo</a>
</div>

<div class="stat-row">
    <div class="stat-card">
        <div class="val">{{ $trabajos->total() }}</div>
        <div class="lbl">Total trabajos</div>
    </div>
    <div class="stat-card">
        <div class="val">{{ \App\Models\Trabajo::where('destacado',true)->count() }}</div>
        <div class="lbl">Destacados</div>
    </div>
    <div class="stat-card">
        <div class="val">{{ \App\Models\Trabajo::whereNotNull('imagen')->count() }}</div>
        <div class="lbl">Con imagen</div>
    </div>
    <div class="stat-card">
        <div class="val">{{ \App\Models\Trabajo::distinct('categoria')->count('categoria') }}</div>
        <div class="lbl">Categorías</div>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h2>Lista de trabajos</h2>
        <span style="font-size:.78rem;color:var(--gray-400);">{{ $trabajos->total() }} registros</span>
    </div>

    @if($trabajos->isEmpty())
    <div style="text-align:center;padding:3.5rem 1rem;color:var(--gray-400);">
        <div style="font-size:3rem;margin-bottom:1rem;">🖼️</div>
        <p style="font-weight:600;margin-bottom:.5rem;">Sin trabajos aún</p>
        <p style="font-size:.82rem;margin-bottom:1.5rem;">Empieza añadiendo tu primer trabajo</p>
        <a href="{{ route('admin.trabajos.create') }}" class="btn btn-primary btn-sm">+ Añadir trabajo</a>
    </div>
    @else
    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th>Fecha</th>
                    <th>Destacado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trabajos as $trabajo)
                <tr>
                    <td>
                        @if($trabajo->imagen)
                            <img src="{{ $trabajo->imagen_url }}" alt="{{ $trabajo->titulo }}" class="table-img">
                        @else
                            <div class="table-img-placeholder">
                                @php $icons=['camiseta'=>'👕','polo'=>'👔','sudadera'=>'🧥','sport'=>'🎽','uniforme'=>'🦺','otro'=>'✨'] @endphp
                                {{ $icons[$trabajo->categoria] ?? '👕' }}
                            </div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight:700;font-size:.88rem;color:var(--navy);">{{ $trabajo->titulo }}</div>
                        @if($trabajo->descripcion)
                        <div style="font-size:.75rem;color:var(--gray-400);margin-top:.2rem;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $trabajo->descripcion }}</div>
                        @endif
                    </td>
                    <td><span class="cat-chip">{{ \App\Models\Trabajo::listaCategorias()[$trabajo->categoria] ?? $trabajo->categoria }}</span></td>
                    <td style="font-size:.82rem;color:var(--gray-600);white-space:nowrap;">{{ $trabajo->fecha_realizacion->format('d/m/Y') }}</td>
                    <td>
                        @if($trabajo->destacado)
                            <span class="destacado-badge destacado-si">⭐ Sí</span>
                        @else
                            <span class="destacado-badge destacado-no">— No</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('admin.trabajos.edit', $trabajo) }}" class="btn btn-secondary btn-sm">✏️ Editar</a>
                            <form method="POST" action="{{ route('admin.trabajos.destroy', $trabajo) }}"
                                  onsubmit="return confirm('¿Eliminar «{{ addslashes($trabajo->titulo) }}»? Esta acción no se puede deshacer.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑️ Borrar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($trabajos->hasPages())
    <div class="pagination-wrap">
        @if($trabajos->onFirstPage())
            <span class="page-btn disabled">←</span>
        @else
            <a href="{{ $trabajos->previousPageUrl() }}" class="page-btn">←</a>
        @endif
        @foreach($trabajos->getUrlRange(1,$trabajos->lastPage()) as $page => $url)
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
    @endif
</div>

@endsection
