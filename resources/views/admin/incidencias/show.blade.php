@extends('layouts.admin')

@section('admin_title', 'Incidencia #' . $incidencia->id)

@section('admin_content')

@php $estado = $incidencia->estadoInfo(); @endphp

{{-- Header --}}
<div style="display:flex;align-items:flex-start;justify-content:space-between;flex-wrap:wrap;gap:1rem;margin-bottom:2rem;">
    <div>
        <div style="margin-bottom:.5rem;">
            <a href="{{ route('admin.incidencias.index') }}"
               style="font-size:.8rem;color:var(--gray-400);font-weight:600;text-decoration:none;">
                ← Volver al listado
            </a>
        </div>
        <h1 style="font-size:1.4rem;font-weight:900;color:var(--navy);">
            Incidencia #{{ $incidencia->id }}
        </h1>
        <p style="font-size:.82rem;color:var(--gray-400);margin-top:.2rem;">
            Recibida el {{ $incidencia->created_at->format('d/m/Y \a \l\a\s H:i') }}
        </p>
    </div>
    <div style="display:flex;gap:.6rem;align-items:center;flex-wrap:wrap;">
        <span style="
            font-size:.75rem;font-weight:800;text-transform:uppercase;letter-spacing:.07em;
            padding:.3rem .85rem;border-radius:50px;
            color:{{ $estado['color'] }};background:{{ $estado['bg'] }};
            border:1px solid {{ $estado['color'] }}33;
        ">{{ $estado['label'] }}</span>
        <form method="POST" action="{{ route('admin.incidencias.destroy', $incidencia) }}"
              onsubmit="return confirm('¿Eliminar esta incidencia? Esta acción no se puede deshacer.')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">🗑️ Eliminar</button>
        </form>
    </div>
</div>

<div id="inc-layout" style="display:grid;grid-template-columns:1fr;gap:1.5rem;">

    {{-- Columna principal --}}
    <div style="display:flex;flex-direction:column;gap:1.5rem;">

        {{-- Datos del cliente --}}
        <div class="admin-card">
            <div class="admin-card-header">
                <h2>👤 Datos del cliente</h2>
            </div>
            <div class="admin-card-body">
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1.2rem;">
                    <div>
                        <div class="form-label" style="margin-bottom:.25rem;">Nombre</div>
                        <div style="font-weight:700;color:var(--navy);">{{ $incidencia->nombre }} {{ $incidencia->apellidos }}</div>
                    </div>
                    <div>
                        <div class="form-label" style="margin-bottom:.25rem;">Teléfono</div>
                        <div><a href="tel:{{ $incidencia->telefono }}" style="font-weight:700;color:var(--coral);">{{ $incidencia->telefono }}</a></div>
                    </div>
                    <div>
                        <div class="form-label" style="margin-bottom:.25rem;">Email</div>
                        <div><a href="mailto:{{ $incidencia->email }}" style="font-weight:700;color:var(--coral);">{{ $incidencia->email }}</a></div>
                    </div>
                    <div>
                        <div class="form-label" style="margin-bottom:.25rem;">IP</div>
                        <div style="font-size:.82rem;color:var(--gray-400);">{{ $incidencia->ip ?? '—' }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detalle incidencia --}}
        <div class="admin-card">
            <div class="admin-card-header">
                <h2>📋 Detalle de la incidencia</h2>
            </div>
            <div class="admin-card-body" style="display:flex;flex-direction:column;gap:1.2rem;">
                <div>
                    <div class="form-label" style="margin-bottom:.35rem;">¿Dónde consiguió la ropa?</div>
                    <div style="padding:.85rem 1rem;background:var(--gray-50);border-radius:10px;border-left:3px solid var(--coral);font-size:.9rem;color:var(--gray-700);">
                        {{ $incidencia->donde_compro }}
                    </div>
                </div>
                <div>
                    <div class="form-label" style="margin-bottom:.35rem;">Descripción</div>
                    <div style="padding:.85rem 1rem;background:var(--gray-50);border-radius:10px;border-left:3px solid var(--navy);font-size:.9rem;color:var(--gray-700);white-space:pre-line;line-height:1.7;">
                        {{ $incidencia->descripcion }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Imágenes --}}
        @if(!empty($incidencia->imagenes))
        <div class="admin-card">
            <div class="admin-card-header">
                <h2>📷 Imágenes adjuntas</h2>
                <span style="font-size:.78rem;color:var(--gray-400);">{{ count($incidencia->imagenes) }} imagen(es)</span>
            </div>
            <div class="admin-card-body">
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:1rem;">
                    @foreach($incidencia->imagenes as $ruta)
                    <a href="{{ Storage::disk('public')->url($ruta) }}" target="_blank" rel="noopener"
                       style="display:block;border-radius:12px;overflow:hidden;border:2px solid var(--gray-100);transition:all .2s;"
                       onmouseover="this.style.borderColor='var(--coral)'"
                       onmouseout="this.style.borderColor='var(--gray-100)'"
                    >
                        <img
                            src="{{ Storage::disk('public')->url($ruta) }}"
                            alt="Imagen incidencia"
                            style="width:100%;aspect-ratio:1;object-fit:cover;display:block;"
                            loading="lazy"
                        >
                        <div style="padding:.4rem .6rem;font-size:.68rem;color:var(--gray-400);text-align:center;background:var(--gray-50);">
                            🔍 Ver tamaño completo
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

    </div>

    {{-- Sidebar: cambiar estado --}}
    <div>
        <div class="admin-card" style="position:sticky;top:80px;">
            <div class="admin-card-header">
                <h2>🔄 Cambiar estado</h2>
            </div>
            <div class="admin-card-body">
                <form method="POST" action="{{ route('admin.incidencias.estado', $incidencia) }}">
                    @csrf @method('PATCH')
                    <div style="display:flex;flex-direction:column;gap:.6rem;margin-bottom:1rem;">
                        @foreach(\App\Models\Incidencia::estados() as $key => $info)
                        <label style="
                            display:flex;align-items:center;gap:.75rem;padding:.8rem 1rem;
                            border-radius:10px;cursor:pointer;border:2px solid;
                            border-color:{{ $incidencia->estado === $key ? $info['color'] : 'var(--gray-200)' }};
                            background:{{ $incidencia->estado === $key ? $info['bg'] : 'transparent' }};
                            transition:all .2s;
                        ">
                            <input type="radio" name="estado" value="{{ $key }}"
                                   {{ $incidencia->estado === $key ? 'checked' : '' }}
                                   style="accent-color:{{ $info['color'] }};width:16px;height:16px;">
                            <span style="font-weight:700;font-size:.88rem;color:{{ $info['color'] }};">
                                {{ $info['label'] }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;">
                        💾 Guardar estado
                    </button>
                </form>

                <hr class="form-divider">

                {{-- Responder por email --}}
                <div style="margin-top:.5rem;">
                    <p class="form-label" style="margin-bottom:.6rem;">Responder al cliente</p>
                    <a href="mailto:{{ $incidencia->email }}?subject=Re: Incidencia %23{{ $incidencia->id }} — bycolor.es&body=Hola {{ urlencode($incidencia->nombre) }},%0A%0AGracias por contactarnos.%0A%0AHemos revisado tu incidencia y..."
                       class="btn btn-outline" style="width:100%;justify-content:center;">
                        ✉️ Responder por email
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    @media (min-width: 900px) {
        #inc-layout { grid-template-columns: 1fr 280px !important; }
    }
</style>

@endsection
