<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo contacto desde bycolor.es</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .logo {
            font-size: 2rem;
            font-weight: 900;
            margin-bottom: 10px;
        }
        .logo .red { color: #ef4444; }
        .logo .blue { color: #3b82f6; }
        .logo .green { color: #10b981; }
        .logo .purple { color: #8b5cf6; }
        .content {
            padding: 30px;
        }
        .field {
            margin-bottom: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }
        .field-label {
            font-weight: bold;
            color: #667eea;
            font-size: 14px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .field-value {
            font-size: 16px;
            color: #333;
        }
        .priority-high {
            border-left-color: #ef4444;
        }
        .priority-high .field-label {
            color: #ef4444;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <span class="red">by</span><span class="blue">co</span><span class="green">lor</span><span class="purple">.es</span>
            </div>
            <h1>🚀 ¡Nuevo contacto desde la web!</h1>
            <p>Tienes un nuevo lead interesado en tus servicios</p>
        </div>

        <div class="content">
            <div class="field priority-high">
                <div class="field-label">👤 Nombre</div>
                <div class="field-value">{{ $data['nombre'] }}</div>
            </div>

            <div class="field priority-high">
                <div class="field-label">📧 Email</div>
                <div class="field-value">{{ $data['email'] }}</div>
            </div>

            @if(!empty($data['telefono']))
            <div class="field">
                <div class="field-label">📱 Teléfono</div>
                <div class="field-value">{{ $data['telefono'] }}</div>
            </div>
            @endif

            @if(!empty($data['paquete']))
            <div class="field">
                <div class="field-label">📦 Paquete de interés</div>
                <div class="field-value">
                    @switch($data['paquete'])
                        @case('starter')
                            <strong>STARTER - 450€</strong>
                            @break
                        @case('pro')
                            <strong>PRO - 950€</strong>
                            @break
                        @case('enterprise')
                            <strong>ENTERPRISE - 1.300€</strong>
                            @break
                        @case('personalizado')
                            <strong>Proyecto personalizado</strong>
                            @break
                        @default
                            {{ $data['paquete'] }}
                    @endswitch
                </div>
            </div>
            @endif

            <div class="field priority-high">
                <div class="field-label">💬 Mensaje del cliente</div>
                <div class="field-value">{{ $data['mensaje'] }}</div>
            </div>

            <div class="field">
                <div class="field-label">📅 Fecha y hora</div>
                <div class="field-value">{{ now()->format('d/m/Y H:i:s') }}</div>
            </div>

            <div class="field">
                <div class="field-label">🌐 Origen</div>
                <div class="field-value">Formulario web - Diseño Web en Toledo</div>
            </div>
        </div>

        <div class="footer">
            <p><strong>🎯 Acción recomendada:</strong> Responder en menos de 24h para maximizar conversión</p>
            <a href="mailto:{{ $data['email'] }}" class="btn">📧 Responder Ahora</a>
            <p style="margin-top: 20px; color: #6c757d; font-size: 14px;">
                Este email se generó automáticamente desde bycolor.es<br>
                Diseño web profesional en Toledo
            </p>
        </div>
    </div>
</body>
</html>
