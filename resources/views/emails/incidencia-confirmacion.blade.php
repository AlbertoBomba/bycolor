<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hemos recibido tu incidencia — bycolor.es</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background: #f4f4f4; margin: 0; padding: 20px; }
        .wrap { max-width: 620px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,.1); }
        .header { background: linear-gradient(135deg, #ff5733 0%, #e04020 100%); color: #fff; padding: 32px 30px; text-align: center; }
        .header .icon { font-size: 2.8rem; margin-bottom: 8px; }
        .header h1 { margin: 0 0 4px; font-size: 1.4rem; }
        .header p  { margin: 0; opacity: .85; font-size: .88rem; }
        .body  { padding: 28px 30px; }
        .greeting { font-size: 1rem; color: #1a1a2e; margin-bottom: 1rem; }
        .info-box { background: #fff8f6; border: 1px solid #ffd5cc; border-radius: 10px; padding: 16px 20px; margin-bottom: 1.4rem; }
        .info-box .id { font-size: 1.5rem; font-weight: 900; color: #ff5733; }
        .info-box .date { font-size: .82rem; color: #888; margin-top: 2px; }
        .field { margin-bottom: 14px; padding: 12px 14px; background: #f8f9fa; border-left: 4px solid #ff5733; border-radius: 6px; }
        .field .label { font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: #aaa; margin-bottom: 4px; }
        .field .value { font-size: .92rem; color: #1a1a2e; word-break: break-word; }
        .section-title { font-size: .78rem; font-weight: 800; text-transform: uppercase; letter-spacing: .1em; color: #aaa; border-bottom: 1px solid #eee; padding-bottom: 6px; margin: 22px 0 12px; }
        .notice { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px; padding: 14px 18px; margin: 1.4rem 0; font-size: .88rem; color: #166534; }
        .notice strong { display: block; margin-bottom: 4px; }
        .cta { text-align: center; margin: 1.6rem 0 .4rem; }
        .cta a { display: inline-block; background: #ff5733; color: #fff; text-decoration: none; font-weight: 700; font-size: .9rem; padding: 12px 28px; border-radius: 8px; }
        .footer { background: #f8f9fa; padding: 16px 30px; text-align: center; font-size: .75rem; color: #aaa; border-top: 1px solid #eee; }
        .footer a { color: #ff5733; text-decoration: none; }
    </style>
</head>
<body>
<div class="wrap">

    <div class="header">
        <div class="icon">✅</div>
        <h1>¡Hemos recibido tu incidencia!</h1>
        <p>bycolor.es — Camisetas personalizadas</p>
    </div>

    <div class="body">

        <p class="greeting">
            Hola <strong>{{ $incidencia->nombre }}</strong>,
        </p>
        <p style="font-size:.92rem;color:#444;margin-bottom:1.4rem;">
            Gracias por contactarnos. Hemos registrado tu incidencia correctamente y nos pondremos
            en contacto contigo a la mayor brevedad posible.
        </p>

        <div class="info-box">
            <div class="id">Incidencia #{{ $incidencia->id }}</div>
            <div class="date">Recibida el {{ $incidencia->created_at->format('d/m/Y \a \l\a\s H:i') }}</div>
        </div>

        <div class="section-title">Resumen de tu incidencia</div>

        <div class="field">
            <div class="label">Nombre</div>
            <div class="value">{{ $incidencia->nombre }} {{ $incidencia->apellidos }}</div>
        </div>

        <div class="field">
            <div class="label">Teléfono de contacto</div>
            <div class="value">{{ $incidencia->telefono }}</div>
        </div>

        <div class="field">
            <div class="label">¿Dónde conseguiste la ropa?</div>
            <div class="value">{{ $incidencia->donde_compro }}</div>
        </div>

        <div class="field">
            <div class="label">Descripción del problema</div>
            <div class="value" style="white-space:pre-line;">{{ $incidencia->descripcion }}</div>
        </div>

        @if(!empty($incidencia->imagenes) && count($incidencia->imagenes) > 0)
        <div class="field">
            <div class="label">Imágenes adjuntadas</div>
            <div class="value">{{ count($incidencia->imagenes) }} imagen(es)</div>
        </div>
        @endif

        <div class="notice">
            <strong>⏱️ Tiempo de respuesta</strong>
            Habitualmente respondemos en menos de <strong>48 horas laborables</strong>.
            Si tu incidencia es urgente, puedes contactarnos directamente por
            <a href="https://wa.me/34600646123" style="color:#166534;font-weight:700;">WhatsApp</a>.
        </div>

        <div class="cta">
            <a href="https://bycolor.es">Visitar bycolor.es</a>
        </div>

    </div>

    <div class="footer">
        Este correo es una confirmación automática. No respondas a este mensaje.<br>
        <a href="https://bycolor.es">bycolor.es</a> · Toledo, España
    </div>

</div>
</body>
</html>
