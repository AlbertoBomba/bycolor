@extends('layouts.admin')

@section('admin_title', 'Añadir trabajo')

@section('admin_content')

<div style="display:flex;align-items:center;gap:1rem;margin-bottom:2rem;">
    <a href="{{ route('admin.trabajos.index') }}" class="btn btn-secondary btn-sm">← Volver</a>
    <div>
        <h1 style="font-size:1.3rem;font-weight:900;color:var(--navy);">Añadir trabajo</h1>
        <p style="font-size:.8rem;color:var(--gray-400);margin-top:.1rem;">Sube un nuevo proyecto a la galería</p>
    </div>
</div>

<form method="POST" action="{{ route('admin.trabajos.store') }}" enctype="multipart/form-data">
    @csrf

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
                               value="{{ old('titulo') }}" required>
                        @error('titulo')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="categoria">Categoría *</label>
                        <select id="categoria" name="categoria" class="form-ctrl">
                            @foreach(\App\Models\Trabajo::listaCategorias() as $val => $label)
                            <option value="{{ $val }}" {{ old('categoria','camiseta') === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('categoria')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="fecha_realizacion">Fecha de realización *</label>
                        <input type="date" id="fecha_realizacion" name="fecha_realizacion" class="form-ctrl"
                               value="{{ old('fecha_realizacion', now()->format('Y-m-d')) }}" required>
                        @error('fecha_realizacion')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group" style="grid-column:1/-1;">
                        <label class="form-label" for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="form-ctrl"
                                  placeholder="Breve descripción del proyecto (opcional)...">{{ old('descripcion') }}</textarea>
                        @error('descripcion')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <hr class="form-divider">

                <label class="toggle-wrap">
                    <input type="checkbox" name="destacado" value="1" {{ old('destacado') ? 'checked' : '' }}>
                    <span class="toggle-label">⭐ Marcar como trabajo destacado (aparece en la portada)</span>
                </label>
            </div>
        </div>

        {{-- Images card --}}
        <div class="admin-card">
            <div class="admin-card-header"><h2>🖼️ Imágenes del trabajo</h2></div>
            <div class="admin-card-body">
                @error('imagenes')<div class="form-error" style="margin-bottom:.8rem;">{{ $message }}</div>@enderror
                @error('imagenes.*')<div class="form-error" style="margin-bottom:.8rem;">{{ $message }}</div>@enderror

                {{-- Drop zone --}}
                <div id="drop-zone"
                     style="border:2px dashed var(--gray-200);border-radius:14px;padding:2.5rem 1.5rem;text-align:center;cursor:pointer;transition:all .25s;background:var(--gray-50);"
                     onclick="document.getElementById('imagenes-input').click()"
                     ondragover="dzOver(event)" ondragleave="dzLeave(event)" ondrop="dzDrop(event)">
                    <div style="font-size:2.2rem;margin-bottom:.6rem;">📂</div>
                    <p style="font-weight:700;font-size:.9rem;color:var(--navy);">Haz clic o arrastra imágenes aquí</p>
                    <p style="font-size:.75rem;color:var(--gray-400);margin-top:.3rem;">JPG, PNG, WebP, GIF · Máx. 5MB por imagen · Hasta 20 fotos</p>
                    <input type="file" id="imagenes-input" name="imagenes[]"
                           accept="image/jpeg,image/png,image/webp,image/gif"
                           multiple style="display:none;" onchange="addPreviews(this.files)">
                </div>

                {{-- Preview grid --}}
                <div id="preview-grid"
                     style="display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:.8rem;margin-top:1.2rem;"></div>
            </div>
        </div>

        {{-- Submit --}}
        <div style="display:flex;gap:.8rem;justify-content:flex-end;flex-wrap:wrap;">
            <a href="{{ route('admin.trabajos.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">💾 Guardar trabajo</button>
        </div>
    </div>
</form>

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
                        style="position:absolute;top:4px;right:4px;width:22px;height:22px;background:rgba(239,68,68,.9);color:white;border:none;border-radius:50%;cursor:pointer;font-size:.8rem;display:flex;align-items:center;justify-content:center;font-weight:700;">✕</button>
                    <div style="position:absolute;bottom:0;left:0;right:0;background:rgba(0,0,0,.55);color:white;font-size:.6rem;padding:.2rem .4rem;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">${file.name}</div>`;
                grid.appendChild(wrap);
            };
            reader.readAsDataURL(file);
        });
        // Sync input
        const input = document.getElementById('imagenes-input');
        input.files = dt.files;
    }

    function addPreviews(files) {
        Array.from(files).forEach(f => dt.items.add(f));
        renderPreviews();
    }

    function removeFile(index) {
        dt.items.remove(index);
        renderPreviews();
    }

    function dzOver(e)  { e.preventDefault(); document.getElementById('drop-zone').style.borderColor='var(--coral)'; }
    function dzLeave(e) { document.getElementById('drop-zone').style.borderColor='var(--gray-200)'; }
    function dzDrop(e)  { e.preventDefault(); dzLeave(e); addPreviews(e.dataTransfer.files); }
</script>

@endsection
