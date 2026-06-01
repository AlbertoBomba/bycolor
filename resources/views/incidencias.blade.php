@extends('layouts.site')

@section('title', 'Incidencias | bycolor.es')
@section('description', 'Notifica una incidencia con tu pedido de ropa personalizada en bycolor.es. Te atendemos lo antes posible.')
@section('canonical', 'https://bycolor.es/incidencias')

@push('styles')
<style>
    .inc-grid { display:grid; grid-template-columns:1fr; gap:2.5rem; }
    .inc-card  { background:white; border-radius:var(--radius-lg); padding:2.5rem 2rem; box-shadow:var(--shadow-lg); border:1px solid var(--gray-100); }
    .form-row  { display:grid; gap:1rem; margin-bottom:1rem; }
    .form-row-2 { grid-template-columns:1fr 1fr; }
    .form-row-1 { grid-template-columns:1fr; }
    @media (max-width:640px) { .form-row-2 { grid-template-columns:1fr; } }

    /* Upload zone — la etiqueta <label> es el trigger más fiable en todos los navegadores */
    .upload-zone {
        display: block;
        border: 2px dashed var(--gray-200);
        border-radius: var(--radius-lg);
        padding: 2rem 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: border-color .2s, background .2s;
        background: var(--gray-50);
    }
    .upload-zone:hover, .upload-zone.dragover {
        border-color: var(--coral);
        background: rgba(255,87,51,.04);
    }
    .upload-icon { font-size: 2.5rem; margin-bottom: .5rem; pointer-events: none; }
    .upload-text { font-size: .9rem; font-weight: 700; color: var(--navy); margin-bottom: .2rem; pointer-events: none; }
    .upload-sub  { font-size: .75rem; color: var(--gray-400); pointer-events: none; }

    /* Preview grid */
    .preview-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(90px, 1fr)); gap:.75rem; margin-top:1rem; }
    .preview-item { position:relative; border-radius:10px; overflow:hidden; aspect-ratio:1; background:var(--gray-100); }
    .preview-item img { width:100%; height:100%; object-fit:cover; display:block; }
    .preview-item-spinner { width:100%; height:100%; display:flex; align-items:center; justify-content:center; font-size:1.4rem; }
    .preview-remove {
        position:absolute; top:4px; right:4px;
        background:rgba(0,0,0,.6); color:#fff; border:none; border-radius:50%;
        width:22px; height:22px; font-size:.75rem; cursor:pointer; display:flex; align-items:center; justify-content:center;
        line-height:1;
    }
    .preview-remove:hover { background:rgba(239,68,68,.85); }

    /* Info sidebar */
    .info-list { display:flex; flex-direction:column; gap:1.2rem; }
    .info-item  { display:flex; gap:1rem; align-items:flex-start; }
    .info-icon  { width:44px; height:44px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:1.2rem; flex-shrink:0; }

    @media (min-width:900px) { .inc-grid { grid-template-columns:1fr 1.8fr; } }

    /* Evita que elementos con x-cloak sean visibles antes de que Alpine inicialice */
    [x-cloak] { display: none !important; }
</style>
@endpush

@section('content')

<section class="page-header">
    <div class="container" style="position:relative;z-index:1;">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Inicio</a><span>/</span>
            <span style="color:rgba(255,255,255,.8);">Incidencias</span>
        </div>
        <h1>Notifica una <span style="color:var(--coral);">incidencia</span></h1>
        <p>Cuéntanos el problema y lo solucionamos lo antes posible.</p>
    </div>
</section>

<section class="section" style="background:var(--gray-50);">
    <div class="container">
        <div class="inc-grid">

            {{-- ── Columna izquierda: info ──────────────────────────────── --}}
            <div class="reveal">
                <div class="inc-card">
                    <h2 style="font-size:1.1rem;font-weight:900;color:var(--navy);margin-bottom:1.4rem;">📋 ¿Cómo funciona?</h2>
                    <div class="info-list">
                        <div class="info-item">
                            <div class="info-icon" style="background:rgba(255,87,51,.1);">1️⃣</div>
                            <div>
                                <p style="font-weight:700;color:var(--navy);margin:0 0 .15rem;font-size:.9rem;">Rellena el formulario</p>
                                <p style="color:var(--gray-500);font-size:.82rem;margin:0;">Indica tus datos y describe el problema con tu pedido.</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon" style="background:rgba(0,201,167,.1);">2️⃣</div>
                            <div>
                                <p style="font-weight:700;color:var(--navy);margin:0 0 .15rem;font-size:.9rem;">Adjunta fotos</p>
                                <p style="color:var(--gray-500);font-size:.82rem;margin:0;">Sube imágenes desde tu galería o haz una foto en el momento (máx. 5).</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon" style="background:rgba(59,130,246,.1);">3️⃣</div>
                            <div>
                                <p style="font-weight:700;color:var(--navy);margin:0 0 .15rem;font-size:.9rem;">Te contactamos</p>
                                <p style="color:var(--gray-500);font-size:.82rem;margin:0;">Revisamos tu incidencia y te damos respuesta en menos de 48 h.</p>
                            </div>
                        </div>
                    </div>

                    <hr style="margin:1.5rem 0;border:none;border-top:1px solid var(--gray-100);">

                    <div class="info-item">
                        <div class="info-icon" style="background:rgba(37,211,102,.1);">📱</div>
                        <div>
                            <p style="font-weight:700;color:var(--navy);margin:0 0 .1rem;font-size:.88rem;">¿Urgente?</p>
                            <a href="https://wa.me/34600646123" style="color:var(--coral);font-weight:700;font-size:.88rem;">WhatsApp directo</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Columna derecha: formulario ──────────────────────────── --}}
            <div class="reveal delay-2" x-data="incidenciaForm()">
                <div class="inc-card">
                    <h2 style="font-size:1.1rem;font-weight:900;color:var(--navy);margin-bottom:1.4rem;">📝 Formulario de incidencia</h2>

                    {{-- Mensajes de sesión --}}
                    @if(session('success'))
                    <div id="resultado" class="alert alert-success dark" style="margin-bottom:1.2rem;scroll-margin-top:90px;">
                        ✅ {{ session('success') }}
                    </div>
                    @endif

                    @if($errors->has('general'))
                    <div id="resultado" class="alert alert-error dark" style="margin-bottom:1.2rem;scroll-margin-top:90px;">
                        ⚠️ {{ $errors->first('general') }}
                    </div>
                    @endif

                    @if($errors->any() && !$errors->has('general'))
                    <div id="resultado" class="alert alert-error dark" style="margin-bottom:1.2rem;scroll-margin-top:90px;">
                        ⚠️ Por favor revisa los campos marcados en rojo.
                    </div>
                    @endif

                    <form method="POST" action="{{ route('incidencias.enviar') }}" enctype="multipart/form-data" novalidate
                          @submit="sending = true; _safetyTimer = setTimeout(() => { sending = false; }, 60000);">
                        @csrf

                        {{-- ── Honeypot anti-spam (oculto para humanos, visible para bots) ── --}}
                        <div style="display:none;" aria-hidden="true">
                            <input type="text" name="website" tabindex="-1" autocomplete="off">
                        </div>

                        {{-- Nombre + Apellidos --}}
                        <div class="form-row form-row-2">
                            <div>
                                <label class="form-label dark" for="nombre">Nombre *</label>
                                <input
                                    type="text"
                                    id="nombre"
                                    name="nombre"
                                    class="form-ctrl light @error('nombre') border-red-400 @enderror"
                                    placeholder="Tu nombre"
                                    value="{{ old('nombre') }}"
                                    required
                                    maxlength="100"
                                    autocomplete="given-name"
                                >
                                @error('nombre')
                                <span class="form-error" style="color:#dc2626;font-size:.78rem;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="form-label dark" for="apellidos">Apellidos *</label>
                                <input
                                    type="text"
                                    id="apellidos"
                                    name="apellidos"
                                    class="form-ctrl light @error('apellidos') border-red-400 @enderror"
                                    placeholder="Tus apellidos"
                                    value="{{ old('apellidos') }}"
                                    required
                                    maxlength="150"
                                    autocomplete="family-name"
                                >
                                @error('apellidos')
                                <span class="form-error" style="color:#dc2626;font-size:.78rem;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Teléfono + Email --}}
                        <div class="form-row form-row-2">
                            <div>
                                <label class="form-label dark" for="telefono">Teléfono *</label>
                                <input
                                    type="tel"
                                    id="telefono"
                                    name="telefono"
                                    class="form-ctrl light @error('telefono') border-red-400 @enderror"
                                    placeholder="+34 600 000 000"
                                    value="{{ old('telefono') }}"
                                    required
                                    maxlength="20"
                                    autocomplete="tel"
                                >
                                @error('telefono')
                                <span class="form-error" style="color:#dc2626;font-size:.78rem;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="form-label dark" for="email">Email *</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-ctrl light @error('email') border-red-400 @enderror"
                                    placeholder="tu@email.com"
                                    value="{{ old('email') }}"
                                    required
                                    maxlength="255"
                                    autocomplete="email"
                                >
                                @error('email')
                                <span class="form-error" style="color:#dc2626;font-size:.78rem;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Dónde consiguió la ropa --}}
                        <div class="form-row form-row-1" style="margin-bottom:1rem;">
                            <div>
                                <label class="form-label dark" for="donde_compro">¿Dónde conseguiste la ropa? *</label>
                                <textarea
                                    id="donde_compro"
                                    name="donde_compro"
                                    class="form-ctrl light @error('donde_compro') border-red-400 @enderror"
                                    placeholder="Ej: Tienda online bycolor.es, feria de empresa, regalo de empresa..."
                                    required
                                    maxlength="500"
                                    style="min-height:80px;resize:vertical;"
                                >{{ old('donde_compro') }}</textarea>
                                @error('donde_compro')
                                <span class="form-error" style="color:#dc2626;font-size:.78rem;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Descripción --}}
                        <div class="form-row form-row-1" style="margin-bottom:1rem;">
                            <div>
                                <label class="form-label dark" for="descripcion">Descripción de la incidencia *</label>
                                <textarea
                                    id="descripcion"
                                    name="descripcion"
                                    class="form-ctrl light @error('descripcion') border-red-400 @enderror"
                                    placeholder="Describe el problema con detalle: talla incorrecta, defecto en la impresión, color diferente al pedido..."
                                    required
                                    minlength="10"
                                    maxlength="3000"
                                    style="min-height:130px;resize:vertical;"
                                >{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                <span class="form-error" style="color:#dc2626;font-size:.78rem;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- ── Upload de imágenes ───────────────────────────────────── --}}
                        <div style="margin-bottom:1.5rem;">
                            <p class="form-label dark" style="display:block;margin-bottom:.5rem;">
                                Fotos de la incidencia
                                <span style="font-weight:400;text-transform:none;color:var(--gray-400);font-size:.72rem;">(opcional · máx. 5 imágenes · 8 MB c/u)</span>
                            </p>

                            {{--
                                <label for="imagenes"> es el método más fiable para abrir el selector
                                de archivos en iOS Safari, Android Chrome y escritorio sin JS.
                            --}}
                            <label
                                for="imagenes"
                                class="upload-zone"
                                :class="{'dragover': dragging}"
                                @dragover.prevent="dragging=true"
                                @dragleave.prevent="dragging=false"
                                @drop.prevent="onDrop($event)"
                            >
                                {{-- Input oculto — el <label for> lo activa en todos los navegadores --}}
                                <input
                                    type="file"
                                    id="imagenes"
                                    name="imagenes[]"
                                    x-ref="fileInput"
                                    accept="image/*"
                                    multiple
                                    style="display:none"
                                    @change="onFileChange($event)"
                                >
                                <div class="upload-icon">📷</div>
                                <div class="upload-text">Toca aquí para adjuntar fotos</div>
                                <div class="upload-sub">Elige desde la galería o haz una foto · También puedes arrastrar</div>
                            </label>

                            @error('imagenes')
                            <span class="form-error" style="color:#dc2626;font-size:.78rem;display:block;margin-top:.3rem;">{{ $message }}</span>
                            @enderror
                            @error('imagenes.*')
                            <span class="form-error" style="color:#dc2626;font-size:.78rem;display:block;margin-top:.3rem;">{{ $message }}</span>
                            @enderror

                            {{-- Previsualizaciones --}}
                            {{-- x-show en vez de x-if anidado dentro de x-for (Alpine v3 bug con templates anidados) --}}
                            <div x-show="items.length > 0">
                                <div class="preview-grid">
                                    <template x-for="(item, i) in items" :key="i">
                                        <div class="preview-item">
                                            <img x-show="item.src" :src="item.src || ''" alt="Vista previa">
                                            <div x-show="!item.src" class="preview-item-spinner">⏳</div>
                                            <button type="button" class="preview-remove" @click.prevent="remove(i)" title="Eliminar">✕</button>
                                        </div>
                                    </template>
                                </div>
                                <p style="font-size:.78rem;color:var(--gray-400);margin-top:.5rem;">
                                    <span x-text="items.length"></span> imagen(es) seleccionada(s)
                                </p>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <button
                            type="submit"
                            class="btn-submit"
                            :disabled="sending"
                            style="width:100%;"
                        >
                            <span x-show="!sending">📤 Enviar incidencia</span>
                            <span x-show="sending" x-cloak style="display:flex;align-items:center;gap:.5rem;justify-content:center;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                     style="animation:spinSlow 1s linear infinite;">
                                    <path d="M21 12a9 9 0 1 1-6.219-8.56"/>
                                </svg>
                                Enviando...
                            </span>
                        </button>

                        <p style="font-size:.72rem;color:var(--gray-400);text-align:center;margin-top:.9rem;">
                            * Campos obligatorios. Tus datos se usarán exclusivamente para gestionar esta incidencia.
                        </p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@push('scripts')
<script>
function incidenciaForm() {
    return {
        sending:  false,
        dragging: false,
        _safetyTimer: null,

        init() {
            // Resetear spinner si el navegador restaura la página desde bfcache
            window.addEventListener('pageshow', (e) => {
                if (e.persisted) this.sending = false;
            });
        },
        // Un solo array de objetos {file, src} en lugar de dos arrays paralelos
        items: [],
        MAX_FILES: 5,
        MAX_SIZE:  8 * 1024 * 1024, // 8 MB

        onFileChange(event) {
            const selected = Array.from(event.target.files);
            // Resetear el input ANTES de procesar para que syncFiles
            // sea lo último que escriba en el input
            event.target.value = '';
            this.addFiles(selected);
        },

        onDrop(event) {
            this.dragging = false;
            this.addFiles(Array.from(event.dataTransfer.files));
        },

        addFiles(incoming) {
            for (const file of incoming) {
                if (this.items.length >= this.MAX_FILES) {
                    alert('Solo puedes adjuntar un máximo de ' + this.MAX_FILES + ' imágenes.');
                    break;
                }
                if (!file.type.startsWith('image/')) {
                    alert('"' + file.name + '" no es una imagen válida.');
                    continue;
                }
                if (file.size > this.MAX_SIZE) {
                    alert('"' + file.name + '" supera los 8 MB.');
                    continue;
                }

                // Guardar el índice ANTES del push para referenciarlo en el callback
                const idx = this.items.length;
                this.items.push({ file: file, src: '' });

                // FileReader asíncrono: usar splice() para reemplazar el elemento
                // — splice() es interceptado por Alpine y dispara la reactividad.
                // Modificar item.src directamente NO funciona porque el closure
                // apunta al objeto plano, no al proxy reactivo que Alpine creó.
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.items.splice(idx, 1, { file: file, src: e.target.result });
                };
                reader.readAsDataURL(file);
            }
            this.syncFiles();
        },

        remove(i) {
            this.items.splice(i, 1);
            this.syncFiles();
        },

        syncFiles() {
            // Reconstruye el FileList del input para que el form envíe los archivos
            if (typeof DataTransfer === 'undefined') return;
            const dt = new DataTransfer();
            this.items.forEach(it => dt.items.add(it.file));
            this.$refs.fileInput.files = dt.files;
        },
    };
}

// Scroll al mensaje de resultado si la URL contiene #resultado
document.addEventListener('DOMContentLoaded', function () {
    if (window.location.hash === '#resultado') {
        const el = document.getElementById('resultado');
        if (el) setTimeout(() => el.scrollIntoView({ behavior: 'smooth', block: 'center' }), 200);
    }
});
</script>
@endpush

@endsection
