@extends('layouts.admin')

@section('admin_title', 'Editar trabajo')

@section('admin_content')

<div style="display:flex;align-items:center;gap:1rem;margin-bottom:2rem;">
    <a href="{{ route('admin.trabajos.index') }}" class="btn btn-secondary btn-sm">← Volver</a>
    <div>
        <h1 style="font-size:1.3rem;font-weight:900;color:var(--navy);">Editar trabajo</h1>
        <p style="font-size:.8rem;color:var(--gray-400);margin-top:.1rem;">Modifica los datos del proyecto</p>
    </div>
</div>

<form id="update-form" method="POST" action="{{ route('admin.trabajos.update', $trabajo) }}" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div style="display:grid;grid-template-columns:1fr;gap:1.5rem;">
        {{-- Main card --}}
        <div class="admin-card">
            <div class="admin-card-header"><h2>📝 Información del trabajo</h2></div>
            <div class="admin-card-body">
                <div class="form-grid-2">
                    <div class="form-group" style="grid-column:1/-1;">
                        <label class="form-label" for="titulo">Título *</label>
                        <input type="text" id="titulo" name="titulo" class="form-ctrl"
                               placeholder="Ej: Camisetas equipo CF Benquerencia 2024"
                               value="{{ old('titulo', $trabajo->titulo) }}" required>
                        @error('titulo')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="categoria">Categoría *</label>
                        <select id="categoria" name="categoria" class="form-ctrl">
                            @foreach(\App\Models\Trabajo::listaCategorias() as $val => $label)
                            <option value="{{ $val }}" {{ old('categoria', $trabajo->categoria) === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('categoria')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="fecha_realizacion">Fecha de realización *</label>
                        <input type="date" id="fecha_realizacion" name="fecha_realizacion" class="form-ctrl"
                               value="{{ old('fecha_realizacion', $trabajo->fecha_realizacion->format('Y-m-d')) }}" required>
                        @error('fecha_realizacion')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group" style="grid-column:1/-1;">
                        <label class="form-label" for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="form-ctrl"
                                  placeholder="Breve descripción del proyecto (opcional)...">{{ old('descripcion', $trabajo->descripcion) }}</textarea>
                        @error('descripcion')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <hr class="form-divider">

                <label class="toggle-wrap">
                    <input type="checkbox" name="destacado" value="1"
                           {{ old('destacado', $trabajo->destacado) ? 'checked' : '' }}>
                    <span class="toggle-label">⭐ Marcar como trabajo destacado (aparece en la portada)</span>
                </label>
            </div>
        </div>

        {{-- Image card --}}
        <div class="admin-card">
            <div class="admin-card-header">
                <h2>🖼️ Imágenes del trabajo</h2>
                <span style="font-size:.78rem;color:var(--gray-400);">{{ $trabajo->imagenes->count() }} imagen(es)</span>
            </div>
            <div class="admin-card-body">

                {{-- Existing images --}}
                @if($trabajo->imagenes->isNotEmpty())
                <div style="margin-bottom:1.5rem;">
                    <div class="form-label" style="margin-bottom:.8rem;">Imágenes actuales</div>
                    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:.8rem;">
                        @foreach($trabajo->imagenes as $img)
                        <div style="position:relative;border-radius:12px;overflow:hidden;aspect-ratio:1;background:var(--gray-100);box-shadow:var(--shadow-sm);">
                            <img src="{{ $img->ruta_url }}" alt="Imagen {{ $loop->iteration }}"
                                 style="width:100%;height:100%;object-fit:cover;">
                            <div style="position:absolute;bottom:0;left:0;right:0;padding:.3rem .5rem;background:rgba(0,0,0,.5);display:flex;align-items:center;justify-content:space-between;">
                                <span style="font-size:.65rem;color:rgba(255,255,255,.8);">Foto {{ $loop->iteration }}</span>
                                <button type="button"
                                    onclick="eliminarImagen(this,'{{ route('admin.trabajos.imagenes.destroy', [$trabajo, $img]) }}','{{ csrf_token() }}')"
                                    style="background:rgba(239,68,68,.9);color:white;border:none;border-radius:50%;width:20px;height:20px;cursor:pointer;font-size:.7rem;font-weight:700;display:flex;align-items:center;justify-content:center;">✕</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Upload more --}}
                @error('imagenes')<div class="form-error" style="margin-bottom:.8rem;">{{ $message }}</div>@enderror
                @error('imagenes.*')<div class="form-error" style="margin-bottom:.8rem;">{{ $message }}</div>@enderror

                <div id="drop-zone"
                     style="border:2px dashed var(--gray-200);border-radius:14px;padding:2rem 1.5rem;text-align:center;cursor:pointer;transition:all .25s;background:var(--gray-50);"
                     onclick="document.getElementById('imagenes-input').click()"
                     ondragover="dzOver(event)" ondragleave="dzLeave(event)" ondrop="dzDrop(event)">
                    <div style="font-size:1.8rem;margin-bottom:.4rem;">➕</div>
                    <p style="font-weight:700;font-size:.85rem;color:var(--navy);">Añadir más imágenes</p>
                    <p style="font-size:.73rem;color:var(--gray-400);margin-top:.2rem;">JPG, PNG, WebP, GIF · Máx. 5MB · Hasta 20 fotos</p>
                    <input type="file" id="imagenes-input" name="imagenes[]"
                           accept="image/jpeg,image/png,image/webp,image/gif"
                           multiple style="display:none;" onchange="addPreviews(this.files)">
                </div>

                <div id="preview-grid"
                     style="display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:.8rem;margin-top:1rem;"></div>
            </div>
        </div>

    </div>
</form>

        {{-- Submit --}}
        <div style="display:flex;gap:.8rem;justify-content:space-between;align-items:center;flex-wrap:wrap;margin-top:1.5rem;">
            <form method="POST" action="{{ route('admin.trabajos.destroy', $trabajo) }}"
                  onsubmit="return confirm('¿Eliminar «{{ addslashes($trabajo->titulo) }}»? Esta acción no se puede deshacer.')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">🗑️ Eliminar trabajo</button>
            </form>
            <div style="display:flex;gap:.8rem;">
                <a href="{{ route('admin.trabajos.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" form="update-form" class="btn btn-primary">💾 Guardar cambios</button>
            </div>
        </div>

<script>
    const dt = new DataTransfer();

    function renderPreviews() {
        const grid = document.getElementById('preview-grid');
        grid.innerHTML = '';
        Array.from(dt.files).forEach((file, i) => {
            const reader = new FileReader();
            reader.onload = e => {
                const wrap = document.createElement('div');
                wrap.style.cssText = 'position:relative;border-radius:10px;overflow:hidden;aspect-ratio:1;background:var(--gray-100);';
                wrap.innerHTML = `
                    <img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;">
                    <button type="button" onclick="removeFile(${i})"
                        style="position:absolute;top:4px;right:4px;width:22px;height:22px;background:rgba(239,68,68,.9);color:white;border:none;border-radius:50%;cursor:pointer;font-size:.8rem;display:flex;align-items:center;justify-content:center;font-weight:700;">✕</button>`;
                grid.appendChild(wrap);
            };
            reader.readAsDataURL(file);
        });
        document.getElementById('imagenes-input').files = dt.files;
    }

    function addPreviews(files) {
        Array.from(files).forEach(f => dt.items.add(f));
        renderPreviews();
    }

    function removeFile(index) {
        dt.items.remove(index);
        renderPreviews();
    }

    function eliminarImagen(btn, url, token) {
        if (!confirm('\u00bfEliminar esta imagen?')) return;
        fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: '_method=DELETE&_token=' + encodeURIComponent(token)
        }).then(r => {
            if (r.ok || r.redirected) btn.closest('[style*="aspect-ratio"]').remove();
        }).catch(() => alert('Error al eliminar la imagen.'));
    }

    function dzOver(e)  { e.preventDefault(); document.getElementById('drop-zone').style.borderColor='var(--coral)'; }
    function dzLeave(e) { document.getElementById('drop-zone').style.borderColor='var(--gray-200)'; }
    function dzDrop(e)  { e.preventDefault(); dzLeave(e); addPreviews(e.dataTransfer.files); }
</script>

@endsection
