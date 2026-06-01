@extends('layouts.site')

@section('title', 'Contacto · Presupuesto de Camisetas Personalizadas | bycolor.es')
@section('description', 'Pide presupuesto gratuito para camisetas personalizadas en Toledo. Te respondemos en menos de 24 horas. Sin compromiso.')
@section('canonical', 'https://bycolor.es/contacto')

@push('styles')
<style>
    .contact-grid { display:grid; grid-template-columns:1fr; gap:2.5rem; }
    .contact-card { background:white; border-radius:var(--radius-lg); padding:2.5rem 2rem; box-shadow:var(--shadow-lg); border:1px solid var(--gray-100); }
    .contact-info { display:flex; flex-direction:column; gap:1.4rem; }
    .info-item { display:flex; gap:1.1rem; align-items:flex-start; }
    .info-icon { width:48px; height:48px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:1.3rem; flex-shrink:0; }
    .info-item h4 { font-size:.82rem; font-weight:800; text-transform:uppercase; letter-spacing:.1em; color:var(--gray-400); margin-bottom:.2rem; }
    .info-item p  { font-size:.9rem; font-weight:700; color:var(--navy); line-height:1.5; }
    .info-item a  { color:var(--coral); font-weight:700; text-decoration:none; font-size:.9rem; }
    .info-item a:hover { text-decoration:underline; }
    .wa-banner {
        background:linear-gradient(135deg,#25D366,#128C7E); border-radius:var(--radius-lg);
        padding:1.6rem 1.8rem; display:flex; align-items:center; gap:1.1rem; color:white; text-decoration:none;
        transition:all .25s; box-shadow:0 6px 22px rgba(37,211,102,.3);
    }
    .wa-banner:hover { transform:translateY(-3px); box-shadow:0 12px 35px rgba(37,211,102,.45); }
    .wa-banner .icon { font-size:2rem; flex-shrink:0; }
    .wa-banner h4 { font-size:.95rem; font-weight:900; margin-bottom:.1rem; }
    .wa-banner p  { font-size:.78rem; opacity:.85; }
    @media (min-width:900px) { .contact-grid { grid-template-columns:1fr 1.65fr; } }

    /* ── Overrides: form inside white card ── */
    .contact-card .form-label { color:var(--gray-600); }
    .contact-card .form-ctrl  { background:var(--gray-50); border-color:var(--gray-200); color:var(--gray-900); }
    .contact-card .form-ctrl::placeholder { color:var(--gray-400); }
    .contact-card .form-ctrl:focus { background:white; }
    .contact-card select.form-ctrl option { background:white; color:var(--gray-900); }
    .contact-card .form-error { color:#DC2626; }
</style>
@endpush

@section('content')

<section class="page-header">
    <div class="container" style="position:relative;z-index:1;">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Inicio</a><span>/</span>
            <span style="color:rgba(255,255,255,.8);">Contacto</span>
        </div>
        <h1>Pide tu <span style="color:var(--coral);">presupuesto</span></h1>
        <p>Sin compromiso. Respuesta garantizada en menos de 24 horas.</p>
    </div>
</section>

<section class="section" style="background:var(--gray-50);">
    <div class="container">
        <div class="contact-grid">

            <div class="reveal">
                <div class="contact-card" style="margin-bottom:1.4rem;">
                    <h2 style="font-size:1.15rem;font-weight:900;color:var(--navy);margin-bottom:1.6rem;">📍 Información de contacto</h2>
                    <div class="contact-info">
                        <div class="info-item">
                            <div class="info-icon" style="background:rgba(255,87,51,.1);">📧</div>
                            <div><h4>Email</h4><a href="mailto:att@bycolor.es">att@bycolor.es</a></div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon" style="background:rgba(37,211,102,.1);">📱</div>
                            <div><h4>WhatsApp / Teléfono</h4><a href="https://wa.me/34600646123">+34 600 646 123</a></div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon" style="background:rgba(255,193,7,.1);">📍</div>
                            <div><h4>Ubicación</h4><p>Toledo, España</p></div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon" style="background:rgba(26,26,46,.08);">🕐</div>
                            <div><h4>Horario</h4><p>Lun – Vie: 9:00 – 18:00<br>Sáb: 10:00 – 14:00</p></div>
                        </div>
                    </div>
                </div>
                <a href="https://wa.me/34600646123?text=Hola!%20Me%20gustar%C3%ADa%20pedir%20informaci%C3%B3n%20sobre%20camisetas%20personalizadas."
                   class="wa-banner" target="_blank" rel="noopener">
                    <div class="icon">💬</div>
                    <div><h4>WhatsApp directo</h4><p>Respuesta inmediata · Sin esperas</p></div>
                </a>
            </div>

            <div class="reveal delay-2" x-data="contactForm()">
                <div class="contact-card">
                    <h2 style="font-size:1.15rem;font-weight:900;color:var(--navy);margin-bottom:1.6rem;">✉️ Formulario de contacto</h2>
                    <div x-show="message && messageType === 'success'" x-transition class="alert alert-success" role="alert">
                        ✅ <span x-text="message"></span>
                    </div>
                    <div x-show="message && messageType === 'error'" x-transition class="alert alert-error" role="alert">
                        ❌ <span x-text="message"></span>
                    </div>
                    @if(session('success'))
                    <div class="alert alert-success">✅ {{ session('success') }}</div>
                    @endif
                    <form id="contactoForm" @submit.prevent="submitForm()" method="POST" action="{{ route('contacto.enviar') }}">
                        @csrf
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
                            <div>
                                <label class="form-label" for="nombre">Nombre *</label>
                                <input type="text" id="nombre" name="nombre" x-model="formData.nombre" class="form-ctrl" placeholder="Tu nombre" required>
                                <span class="form-error" x-show="errors.nombre" x-text="errors.nombre ? errors.nombre[0] : ''"></span>
                            </div>
                            <div>
                                <label class="form-label" for="email">Email *</label>
                                <input type="email" id="email" name="email" x-model="formData.email" class="form-ctrl" placeholder="tu@email.com" required>
                                <span class="form-error" x-show="errors.email" x-text="errors.email ? errors.email[0] : ''"></span>
                            </div>
                        </div>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1rem;">
                            <div>
                                <label class="form-label" for="telefono">Teléfono</label>
                                <input type="tel" id="telefono" name="telefono" x-model="formData.telefono" class="form-ctrl" placeholder="+34 600 000 000">
                            </div>
                            <div>
                                <label class="form-label" for="paquete">¿Qué necesitas?</label>
                                <select id="paquete" name="paquete" x-model="formData.paquete" class="form-ctrl">
                                    <option value="">Selecciona...</option>
                                    <option value="camisetas">Camisetas personalizadas</option>
                                    <option value="polos">Polos / uniforme</option>
                                    <option value="sudaderas">Sudaderas</option>
                                    <option value="sport">Ropa deportiva</option>
                                    <option value="evento">Evento especial</option>
                                    <option value="otro">Otro producto</option>
                                </select>
                            </div>
                        </div>
                        <div style="margin-bottom:1.5rem;">
                            <label class="form-label" for="mensaje">Mensaje *</label>
                            <textarea id="mensaje" name="mensaje" x-model="formData.mensaje" class="form-ctrl" placeholder="Cuéntanos: ¿qué quieres, cuántas unidades, para cuándo...?" required></textarea>
                            <span class="form-error" x-show="errors.mensaje" x-text="errors.mensaje ? errors.mensaje[0] : ''"></span>
                        </div>
                        <button type="submit" class="btn-submit" :disabled="loading">
                            <span x-show="!loading">🚀 Enviar mensaje</span>
                            <span x-show="loading" style="display:flex;align-items:center;gap:.5rem;justify-content:center;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="animation:spinSlow 1s linear infinite;"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>
                                Enviando...
                            </span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection