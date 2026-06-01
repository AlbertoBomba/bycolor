@extends('layouts.admin')

@section('admin_title', 'Añadir slide')

@section('admin_content')

<div style="display:flex;align-items:center;gap:1rem;margin-bottom:2rem;">
    <a href="{{ route('admin.hero.index') }}" class="btn btn-secondary btn-sm">← Volver</a>
    <div>
        <h1 style="font-size:1.3rem;font-weight:900;color:var(--navy);">Añadir slide al carrusel</h1>
        <p style="font-size:.8rem;color:var(--gray-400);margin-top:.1rem;">Sube una imagen o vídeo para la portada de la web</p>
    </div>
</div>

@if($errors->any())
<div style="background:#FEE2E2;color:#991B1B;border:1px solid #FECACA;border-radius:10px;padding:.8rem 1.2rem;margin-bottom:1.5rem;font-size:.88rem;">
    <strong>Corrige los siguientes errores:</strong>
    <ul style="margin:.3rem 0 0 1.2rem;">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('admin.hero.store') }}" enctype="multipart/form-data">
    @csrf

    <div style="display:grid;gap:1.5rem;">

        {{-- Archivo --}}
        <div class="admin-card">
            <div class="admin-card-header"><h2>📁 Archivo de fondo</h2></div>
            <div class="admin-card-body">

                <div class="form-group">
                    <label class="form-label">Tipo de media *</label>
                    <select name="tipo_media" class="form-ctrl" id="tipo-media-sel">
                        <option value="imagen" {{ old('tipo_media', 'imagen') === 'imagen' ? 'selected' : '' }}>🖼️ Imagen (jpg, png, webp)</option>
                        <option value="video"  {{ old('tipo_media') === 'video'  ? 'selected' : '' }}>🎬 Vídeo (mp4, webm — máx 50 MB)</option>
                    </select>
                    @error('tipo_media')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="archivo">Archivo *</label>
                    <input type="file" name="archivo" id="archivo-input" class="form-ctrl"
                           accept=".jpg,.jpeg,.png,.webp" required>
                    <div style="font-size:.75rem;color:var(--gray-400);margin-top:.3rem;" id="archivo-hint">
                        Imágenes: jpg, png, webp. Tamaño recomendado: 1920×1080 px. Máximo 20 MB.
                    </div>
                    @error('archivo')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div id="img-preview-wrap" style="display:none;margin-top:.5rem;">
                    <img id="img-preview" src="" alt="Vista previa"
                         style="max-height:200px;border-radius:10px;border:1px solid var(--gray-200);">
                </div>

            </div>
        </div>

        {{-- Texto superpuesto --}}
        <div class="admin-card">
            <div class="admin-card-header"><h2>📝 Texto superpuesto <span style="font-weight:400;font-size:.8rem;">(opcional)</span></h2></div>
            <div class="admin-card-body">

                <div class="form-group">
                    <label class="form-label" for="titulo">Título</label>
                    <input type="text" id="titulo" name="titulo" class="form-ctrl"
                           placeholder="Ej: Camisetas que te definen."
                           value="{{ old('titulo') }}" maxlength="200">
                    @error('titulo')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="subtitulo">Subtítulo</label>
                    <textarea id="subtitulo" name="subtitulo" class="form-ctrl" rows="2"
                              placeholder="Breve descripción o claim...">{{ old('subtitulo') }}</textarea>
                    @error('subtitulo')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label" for="texto_boton">Texto del botón CTA</label>
                        <input type="text" id="texto_boton" name="texto_boton" class="form-ctrl"
                               placeholder="Ej: Pedir presupuesto"
                               value="{{ old('texto_boton') }}" maxlength="100">
                        @error('texto_boton')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="url_boton">URL del botón CTA</label>
                        <input type="url" id="url_boton" name="url_boton" class="form-ctrl"
                               placeholder="https://bycolor.es/contacto"
                               value="{{ old('url_boton') }}">
                        @error('url_boton')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>

            </div>
        </div>

        {{-- Opciones --}}
        <div class="admin-card">
            <div class="admin-card-header"><h2>⚙️ Opciones</h2></div>
            <div class="admin-card-body">
                <label style="display:flex;align-items:center;gap:.6rem;cursor:pointer;">
                    <input type="checkbox" name="activo" value="1"
                           {{ old('activo', '1') ? 'checked' : '' }}>
                    <span style="font-weight:700;font-size:.9rem;">Slide activo (visible en la web)</span>
                </label>
            </div>
        </div>

        <div style="display:flex;gap:1rem;justify-content:flex-end;">
            <a href="{{ route('admin.hero.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">✅ Guardar slide</button>
        </div>

    </div>
</form>

<script>
(function () {
    const selTipo = document.getElementById('tipo-media-sel');
    const input   = document.getElementById('archivo-input');
    const hint    = document.getElementById('archivo-hint');
    const prevWrap = document.getElementById('img-preview-wrap');
    const imgPrev  = document.getElementById('img-preview');

    selTipo.addEventListener('change', function () {
        if (selTipo.value === 'video') {
            input.accept = '.mp4,.webm';
            hint.textContent = 'Vídeos: mp4, webm. Máximo 20 MB. Se reproducirá automáticamente y sin sonido.';
        } else {
            input.accept = '.jpg,.jpeg,.png,.webp';
            hint.textContent = 'Imágenes: jpg, png, webp. Tamaño recomendado: 1920×1080 px. Máximo 20 MB.';
        }
        prevWrap.style.display = 'none';
        input.value = '';
    });

    input.addEventListener('change', function () {
        if (selTipo.value === 'imagen' && input.files[0]) {
            imgPrev.src = URL.createObjectURL(input.files[0]);
            prevWrap.style.display = 'block';
        } else {
            prevWrap.style.display = 'none';
        }
    });
}());
</script>

@endsection
