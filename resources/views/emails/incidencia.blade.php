<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva incidencia — bycolor.es</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background: #f4f4f4; margin: 0; padding: 20px; }
        .wrap { max-width: 620px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,.1); }
        .header { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); color: #fff; padding: 28px 30px; text-align: center; }
        .header h1 { margin: 0 0 4px; font-size: 1.5rem; }
        .header p  { margin: 0; opacity: .7; font-size: .85rem; }
        .badge { display: inline-block; background: #ff5733; color: #fff; border-radius: 20px; padding: 3px 14px; font-size: .78rem; font-weight: 700; margin-bottom: 8px; }
        .body  { padding: 28px 30px; }
        .field { margin-bottom: 16px; padding: 14px 16px; background: #f8f9fa; border-left: 4px solid #ff5733; border-radius: 6px; }
        .field .label { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: #888; margin-bottom: 4px; }
        .field .value { font-size: .95rem; color: #1a1a2e; word-break: break-word; }
        .section-title { font-size: .8rem; font-weight: 800; text-transform: uppercase; letter-spacing: .1em; color: #888; border-bottom: 1px solid #eee; padding-bottom: 6px; margin: 24px 0 14px; }
        .footer { background: #f8f9fa; padding: 18px 30px; text-align: center; font-size: .78rem; color: #aaa; border-top: 1px solid #eee; }
        .footer a { color: #ff5733; text-decoration: none; }
    </style>
</head>
<body>
<div class="wrap">

    <div class="header">
        <div class="badge">NUEVA INCIDENCIA</div>
        <h1>Incidencia #{{ $incidencia->id }}</h1>
        <p>Recibida el {{ $incidencia->created_at->format('d/m/Y \a \l\a\s H:i') }}</p>
    </div>

    <div class="body">

        <div class="section-title">Datos del cliente</div>

        <div class="field">
            <div class="label">Nombre completo</div>
            <div class="value">{{ $incidencia->nombre }} {{ $incidencia->apellidos }}</div>
        </div>

        <div class="field">
            <div class="label">Teléfono</div>
            <div class="value">{{ $incidencia->telefono }}</div>
        </div>

        <div class="field">
            <div class="label">Email</div>
            <div class="value"><a href="mailto:{{ $incidencia->email }}">{{ $incidencia->email }}</a></div>
        </div>

        <div class="section-title">Detalle de la incidencia</div>

        <div class="field">
            <div class="label">Dónde consiguió la ropa</div>
            <div class="value">{{ $incidencia->donde_compro }}</div>
        </div>

        <div class="field">
            <div class="label">Descripción</div>
            <div class="value" style="white-space:pre-line;">{{ $incidencia->descripcion }}</div>
        </div>

        @if(!empty($incidencia->imagenes))
        <div class="section-title">Imágenes adjuntas</div>
        <div class="field">
            <div class="label">Archivos</div>
            <div class="value">
                Se han adjuntado {{ count($incidencia->imagenes) }} imagen(es) a este correo.
            </div>
        </div>
        @endif

    </div>

    <div class="footer">
        Notificación automática de <a href="https://bycolor.es">bycolor.es</a> · IP: {{ $incidencia->ip }}
    </div>

</div>
</body>
</html>
