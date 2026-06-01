<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de tu incidencia — bycolor.es</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background: #f4f4f4; margin: 0; padding: 20px; }
        .wrap { max-width: 620px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,.1); }
        .header { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); color: #fff; padding: 28px 30px; text-align: center; }
        .header .icon { font-size: 2.4rem; margin-bottom: 8px; }
        .header h1 { margin: 0 0 4px; font-size: 1.3rem; }
        .header p  { margin: 0; opacity: .7; font-size: .85rem; }
        .body  { padding: 28px 30px; }
        .greeting { font-size: .95rem; color: #444; margin-bottom: 1.2rem; }
        .inc-ref { font-size: .8rem; font-weight: 700; color: #888; margin-bottom: 1.2rem; }

        /* Estado badge */
        .estado-wrap { text-align: center; margin: 1.6rem 0; }
        .arrow { font-size: 1.4rem; color: #ccc; margin: .5rem 0; }
        .badge {
            display: inline-block;
            font-size: .82rem; font-weight: 800; text-transform: uppercase;
            letter-spacing: .07em; padding: .4rem 1.1rem;
            border-radius: 50px; border: 2px solid;
        }
        .badge-nueva      { color: #DC2626; background: #FEF2F2; border-color: #DC262633; }
        .badge-en_proceso { color: #D97706; background: #FFFBEB; border-color: #D9770633; }
        .badge-resuelta   { color: #166534; background: #F0FDF4; border-color: #16653433; }
        .badge-old        { opacity: .45; }

        .mensaje-estado { padding: 16px 20px; border-radius: 10px; margin: 1.2rem 0; font-size: .9rem; }
        .msg-nueva      { background: #FEF2F2; border-left: 4px solid #DC2626; color: #7f1d1d; }
        .msg-en_proceso { background: #FFFBEB; border-left: 4px solid #D97706; color: #78350f; }
        .msg-resuelta   { background: #F0FDF4; border-left: 4px solid #166534; color: #14532d; }

        .field { margin-bottom: 12px; padding: 11px 14px; background: #f8f9fa; border-left: 3px solid #ff5733; border-radius: 6px; }
        .field .label { font-size: .68rem; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: #aaa; margin-bottom: 3px; }
        .field .value { font-size: .88rem; color: #1a1a2e; }
        .section-title { font-size: .75rem; font-weight: 800; text-transform: uppercase; letter-spacing: .1em; color: #aaa; border-bottom: 1px solid #eee; padding-bottom: 5px; margin: 20px 0 10px; }

        .cta { text-align: center; margin: 1.6rem 0 .4rem; }
        .cta a { display: inline-block; background: #ff5733; color: #fff; text-decoration: none; font-weight: 700; font-size: .88rem; padding: 11px 26px; border-radius: 8px; }
        .footer { background: #f8f9fa; padding: 14px 30px; text-align: center; font-size: .73rem; color: #aaa; border-top: 1px solid #eee; }
        .footer a { color: #ff5733; text-decoration: none; }
    </style>
</head>
<body>
<div class="wrap">

    <div class="header">
        @php
            $nuevoEstado = $incidencia->estado;
            $icons = ['nueva' => '🔴', 'en_proceso' => '🟡', 'resuelta' => '✅'];
        @endphp
        <div class="icon">{{ $icons[$nuevoEstado] ?? '🔔' }}</div>
        <h1>Tu incidencia ha sido actualizada</h1>
        <p>bycolor.es · Incidencia #{{ $incidencia->id }}</p>
    </div>

    <div class="body">

        <p class="greeting">
            Hola <strong>{{ $incidencia->nombre }}</strong>,
        </p>
        <p style="font-size:.9rem;color:#555;margin-bottom:1.2rem;">
            Te informamos de que el estado de tu incidencia ha cambiado.
        </p>

        {{-- Cambio de estado visual --}}
        <div class="estado-wrap">
            @php
                $estados = \App\Models\Incidencia::estados();
                $labelAnterior = $estados[$estadoAnterior]['label'] ?? $estadoAnterior;
                $labelNuevo    = $estados[$nuevoEstado]['label']    ?? $nuevoEstado;
            @endphp
            <div>
                <span class="badge badge-{{ $estadoAnterior }} badge-old">{{ $labelAnterior }}</span>
            </div>
            <div class="arrow">↓</div>
            <div>
                <span class="badge badge-{{ $nuevoEstado }}">{{ $labelNuevo }}</span>
            </div>
        </div>

        {{-- Mensaje según nuevo estado --}}
        @if($nuevoEstado === 'en_proceso')
        <div class="mensaje-estado msg-en_proceso">
            <strong>🔧 En proceso</strong><br>
            Hemos revisado tu incidencia y ya estamos trabajando en ella.
            Nos pondremos en contacto contigo en cuanto tengamos una resolución.
        </div>
        @elseif($nuevoEstado === 'resuelta')
        <div class="mensaje-estado msg-resuelta">
            <strong>✅ Resuelta</strong><br>
            Tu incidencia ha sido resuelta. Si tienes alguna duda adicional o el problema
            persiste, no dudes en contactarnos de nuevo.
        </div>
        @elseif($nuevoEstado === 'nueva')
        <div class="mensaje-estado msg-nueva">
            <strong>🔴 Nueva</strong><br>
            Tu incidencia ha sido marcada como nueva de nuevo. Nuestro equipo la revisará pronto.
        </div>
        @endif

        {{-- Resumen de la incidencia --}}
        <div class="section-title">Tu incidencia</div>

        <div class="field">
            <div class="label">Referencia</div>
            <div class="value">#{{ $incidencia->id }} · {{ $incidencia->created_at->format('d/m/Y') }}</div>
        </div>

        <div class="field">
            <div class="label">Descripción</div>
            <div class="value" style="white-space:pre-line;">{{ Str::limit($incidencia->descripcion, 200) }}</div>
        </div>

        <div class="cta">
            <a href="https://wa.me/34600646123">¿Tienes alguna duda? Escríbenos por WhatsApp</a>
        </div>

    </div>

    <div class="footer">
        Este correo es una notificación automática generada por <a href="https://bycolor.es">bycolor.es</a>.<br>
        No respondas a este mensaje directamente.
    </div>

</div>
</body>
</html>
