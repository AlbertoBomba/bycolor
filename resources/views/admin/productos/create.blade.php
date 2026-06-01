@extends('layouts.admin')

@section('admin_title', 'Añadir producto')

@section('admin_content')

<div style="display:flex;align-items:center;gap:1rem;margin-bottom:2rem;">
    <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary btn-sm">← Volver</a>
    <div>
        <h1 style="font-size:1.3rem;font-weight:900;color:var(--navy);">Añadir producto</h1>
        <p style="font-size:.8rem;color:var(--gray-400);margin-top:.1rem;">Nuevo artículo del catálogo</p>
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

<form method="POST" action="{{ route('admin.productos.store') }}" enctype="multipart/form-data">
    @csrf

    <div style="display:grid;gap:1.5rem;">

        {{-- Información básica --}}
        <div class="admin-card">
            <div class="admin-card-header"><h2>📝 Información básica</h2></div>
            <div class="admin-card-body">
                <div class="form-group">
                    <label class="form-label" for="nombre">Nombre del producto *</label>
                    <input type="text" id="nombre" name="nombre" class="form-ctrl"
                           placeholder="Ej: Camiseta Básica Premium"
                           value="{{ old('nombre') }}" required maxlength="200">
                    @error('nombre')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="form-ctrl" rows="3"
                              placeholder="Descripción del producto, materiales, usos...">{{ old('descripcion') }}</textarea>
                    @error('descripcion')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label class="form-label" for="categoria">Categoría *</label>
                        <select id="categoria" name="categoria" class="form-ctrl" required>
                            @foreach(\App\Models\Producto::CATEGORIAS as $val => $label)
                            <option value="{{ $val }}" {{ old('categoria') === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('categoria')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="precio_desde">Precio desde</label>
                        <input type="text" id="precio_desde" name="precio_desde" class="form-ctrl"
                               placeholder="Ej: Desde 12€"
                               value="{{ old('precio_desde') }}" maxlength="50">
                        @error('precio_desde')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Imágenes del producto --}}
        <div class="admin-card">
            <div class="admin-card-header"><h2>🖼️ Imágenes del producto</h2></div>
            <div class="admin-card-body">
                <div class="form-group">
                    <label class="form-label">Imágenes (jpg, png, webp — máx 5 MB cada una)</label>
                    <input type="file" name="imagenes_nuevas[]" id="imgs-input" class="form-ctrl"
                           accept=".jpg,.jpeg,.png,.webp" multiple>
                    <div style="font-size:.72rem;color:var(--gray-400);margin-top:.25rem;">Puedes seleccionar varias imágenes a la vez. La primera será la imagen principal.</div>
                    @error('imagenes_nuevas.*')<div class="form-error">{{ $message }}</div>@enderror
                </div>
                <div id="imgs-preview" style="display:flex;flex-wrap:wrap;gap:.75rem;margin-top:.5rem;"></div>
            </div>
        </div>

        {{-- Colores disponibles --}}
        <div class="admin-card">
            <div class="admin-card-header"><h2>🎨 Colores disponibles</h2></div>
            <div class="admin-card-body">
                <p style="font-size:.8rem;color:var(--gray-400);margin-bottom:1rem;">
                    Añade los colores en los que está disponible la prenda. Los usuarios verán una muestra junto al producto.
                </p>
                <div id="colores-list" style="display:flex;flex-direction:column;gap:.6rem;"></div>
                <button type="button" id="btn-add-color" class="btn btn-secondary btn-sm" style="margin-top:.8rem;">+ Añadir color</button>
            </div>
        </div>

        {{-- Aspecto visual (tarjeta sin foto) --}}
        <div class="admin-card">
            <div class="admin-card-header"><h2>✨ Aspecto de la tarjeta (sin foto)</h2></div>
            <div class="admin-card-body">
                <div class="form-group" style="max-width:120px;">
                    <label class="form-label" for="emoji">Emoji / icono</label>
                    <input type="text" id="emoji" name="emoji" class="form-ctrl"
                           placeholder="👕" value="{{ old('emoji') }}" maxlength="10"
                           style="font-size:1.5rem;text-align:center;">
                </div>
                <div class="form-grid-2" style="margin-top:.8rem;">
                    <div class="form-group">
                        <label class="form-label">Color fondo (inicio)</label>
                        <div style="display:flex;align-items:center;gap:.6rem;">
                            <input type="color" id="color_inicio" name="color_inicio"
                                   value="{{ old('color_inicio', '#FF5733') }}"
                                   style="width:44px;height:36px;border:1px solid var(--gray-200);border-radius:6px;cursor:pointer;padding:2px;">
                            <input type="text" id="color_inicio_text" value="{{ old('color_inicio', '#FF5733') }}"
                                   class="form-ctrl" style="font-family:monospace;flex:1;" maxlength="20" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Color fondo (fin)</label>
                        <div style="display:flex;align-items:center;gap:.6rem;">
                            <input type="color" id="color_fin" name="color_fin"
                                   value="{{ old('color_fin', '#FF8C42') }}"
                                   style="width:44px;height:36px;border:1px solid var(--gray-200);border-radius:6px;cursor:pointer;padding:2px;">
                            <input type="text" id="color_fin_text" value="{{ old('color_fin', '#FF8C42') }}"
                                   class="form-ctrl" style="font-family:monospace;flex:1;" maxlength="20" readonly>
                        </div>
                    </div>
                </div>
                <div id="gradient-preview" style="height:48px;border-radius:10px;margin-top:.5rem;transition:background .3s;background:linear-gradient(135deg,{{ old('color_inicio','#FF5733') }},{{ old('color_fin','#FF8C42') }});"></div>
                <div class="form-grid-2" style="margin-top:1rem;">
                    <div class="form-group">
                        <label class="form-label" for="badge">Badge / etiqueta</label>
                        <input type="text" id="badge" name="badge" class="form-ctrl"
                               placeholder="Ej: Más vendida" value="{{ old('badge') }}" maxlength="100">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="badge_tipo">Color del badge</label>
                        <select id="badge_tipo" name="badge_tipo" class="form-ctrl">
                            @foreach(\App\Models\Producto::BADGE_TIPOS as $val => $label)
                            <option value="{{ $val }}" {{ old('badge_tipo', 'badge-coral') === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Características --}}
        <div class="admin-card">
            <div class="admin-card-header"><h2>✅ Características del producto</h2></div>
            <div class="admin-card-body">
                <p style="font-size:.8rem;color:var(--gray-400);margin-bottom:1rem;">Hasta 6 características cortas (material, tallas, técnica...). Deja vacías las que no necesites.</p>
                <div class="form-grid-2">
                    @for($i = 0; $i < 6; $i++)
                    <div class="form-group" style="margin-bottom:.5rem;">
                        <input type="text" name="caracteristicas[]" class="form-ctrl"
                               placeholder="Ej: 180g algodón"
                               value="{{ old('caracteristicas.'.$i) }}" maxlength="100">
                    </div>
                    @endfor
                </div>
            </div>
        </div>

        {{-- Opciones --}}
        <div class="admin-card">
            <div class="admin-card-header"><h2>⚙️ Opciones</h2></div>
            <div class="admin-card-body" style="display:flex;flex-direction:column;gap:.8rem;">
                <label style="display:flex;align-items:center;gap:.6rem;cursor:pointer;">
                    <input type="checkbox" name="activo" value="1" {{ old('activo', '1') ? 'checked' : '' }}>
                    <span style="font-weight:700;font-size:.9rem;">Producto activo (visible en catálogo)</span>
                </label>
                <label style="display:flex;align-items:center;gap:.6rem;cursor:pointer;">
                    <input type="checkbox" name="destacado" value="1" {{ old('destacado') ? 'checked' : '' }}>
                    <span style="font-weight:700;font-size:.9rem;">⭐ Mostrar en portada (productos destacados)</span>
                </label>
                <div class="form-group" style="max-width:200px;margin-top:.3rem;">
                    <label class="form-label" for="orden">Orden de aparición</label>
                    <input type="number" id="orden" name="orden" class="form-ctrl"
                           value="{{ old('orden', 0) }}" min="0">
                </div>
            </div>
        </div>

        <div style="display:flex;gap:1rem;justify-content:flex-end;">
            <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">✅ Guardar producto</button>
        </div>

    </div>
</form>

<script>
(function () {
    /* ── Gradient color pickers ── */
    ['color_inicio', 'color_fin'].forEach(function (id) {
        var picker = document.getElementById(id);
        var text   = document.getElementById(id + '_text');
        picker.addEventListener('input', function () {
            text.value = picker.value;
            var ci = document.getElementById('color_inicio').value;
            var cf = document.getElementById('color_fin').value;
            document.getElementById('gradient-preview').style.background =
                'linear-gradient(135deg,' + ci + ',' + cf + ')';
        });
    });

    /* ── Multiple image preview ── */
    document.getElementById('imgs-input').addEventListener('change', function () {
        var wrap = document.getElementById('imgs-preview');
        wrap.innerHTML = '';
        Array.from(this.files).forEach(function (file, idx) {
            var div = document.createElement('div');
            div.style.cssText = 'position:relative;width:90px;height:90px;border-radius:8px;overflow:hidden;border:2px solid ' + (idx === 0 ? 'var(--coral)' : 'var(--gray-200)') + ';';
            var img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.style.cssText = 'width:100%;height:100%;object-fit:cover;';
            if (idx === 0) {
                var lbl = document.createElement('div');
                lbl.textContent = 'Principal';
                lbl.style.cssText = 'position:absolute;bottom:0;left:0;right:0;background:var(--coral);color:white;font-size:.55rem;font-weight:800;text-align:center;padding:.15rem;';
                div.appendChild(lbl);
            }
            div.appendChild(img);
            wrap.appendChild(div);
        });
    });

    /* ── Dynamic product color rows ── */
    var colorList = document.getElementById('colores-list');
    var colorIdx  = 0;

    function buildColorRow(hex, nombre) {
        hex    = hex    || '#FFFFFF';
        nombre = nombre || '';
        var i  = colorIdx++;
        var row = document.createElement('div');
        row.dataset.colorRow = i;
        row.style.cssText = 'display:flex;align-items:center;gap:.6rem;flex-wrap:wrap;';

        var pickerEl = document.createElement('input');
        pickerEl.type  = 'color';
        pickerEl.name  = 'color_hex[' + i + ']';
        pickerEl.value = hex;
        pickerEl.style.cssText = 'width:44px;height:36px;border:1px solid var(--gray-200);border-radius:6px;cursor:pointer;padding:2px;flex-shrink:0;';

        var hexText = document.createElement('input');
        hexText.type     = 'text';
        hexText.value    = hex;
        hexText.readOnly = true;
        hexText.style.cssText = 'font-family:monospace;width:80px;padding:.4rem .5rem;border:1px solid var(--gray-200);border-radius:6px;font-size:.78rem;flex-shrink:0;';

        pickerEl.addEventListener('input', function () { hexText.value = pickerEl.value; });

        var nameEl = document.createElement('input');
        nameEl.type        = 'text';
        nameEl.name        = 'color_nombre[' + i + ']';
        nameEl.value       = nombre;
        nameEl.placeholder = 'Nombre del color (ej: Rojo)';
        nameEl.maxLength   = 60;
        nameEl.style.cssText = 'flex:1;min-width:120px;padding:.4rem .7rem;border:1px solid var(--gray-200);border-radius:6px;font-size:.85rem;';

        /* Image upload button */
        var fileLabel = document.createElement('label');
        fileLabel.title     = 'Imagen para este color (opcional)';
        fileLabel.style.cssText = 'display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;background:var(--gray-100);border:1px solid var(--gray-200);border-radius:6px;cursor:pointer;font-size:1rem;flex-shrink:0;transition:background .2s;';
        fileLabel.textContent = '📷';

        var fileInput = document.createElement('input');
        fileInput.type   = 'file';
        fileInput.name   = 'color_imagen[' + i + ']';
        fileInput.accept = '.jpg,.jpeg,.png,.webp';
        fileInput.style.display = 'none';

        var prevImg = document.createElement('img');
        prevImg.alt = '';
        prevImg.style.cssText = 'width:36px;height:36px;border-radius:6px;object-fit:cover;border:2px solid var(--coral);display:none;flex-shrink:0;';

        fileInput.addEventListener('change', function () {
            if (fileInput.files && fileInput.files[0]) {
                prevImg.src = URL.createObjectURL(fileInput.files[0]);
                prevImg.style.display = 'block';
                fileLabel.style.background = '#d1fae5';
            }
        });
        fileLabel.appendChild(fileInput);

        var del = document.createElement('button');
        del.type        = 'button';
        del.textContent = '✕';
        del.style.cssText = 'background:#FEE2E2;color:#991B1B;border:none;border-radius:6px;padding:.35rem .65rem;cursor:pointer;font-size:.8rem;font-weight:700;flex-shrink:0;';
        del.addEventListener('click', function () { row.remove(); });

        row.appendChild(pickerEl);
        row.appendChild(hexText);
        row.appendChild(nameEl);
        row.appendChild(fileLabel);
        row.appendChild(prevImg);
        row.appendChild(del);
        colorList.appendChild(row);
    }

    document.getElementById('btn-add-color').addEventListener('click', function () { buildColorRow(); });

    /* Restore on validation error */
    @if(old('color_hex'))
    @foreach(old('color_hex', []) as $i => $hex)
    buildColorRow('{{ $hex }}', '{{ old('color_nombre.'.$i, '') }}');
    @endforeach
    @endif

}());
</script>

@endsection
