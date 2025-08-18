<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Páginas de Error - bycolor.es</title>
    <meta name="robots" content="noindex, nofollow">
    
    @vite(['resources/css/app.css', 'resources/css/landing.css', 'resources/css/tailwind-landing-styles.css'])
</head>
<body class="bg-gray-900 text-white min-h-screen">
    <div class="container mx-auto px-4 py-16">
        <div class="text-center mb-12">
            <h1 class="text-4xl sm:text-6xl font-black mb-6">
                <span class="text-red-500">TEST</span> 
                <span class="text-blue-500">PÁGINAS</span> 
                <span class="text-green-500">ERROR</span>
            </h1>
            <p class="text-xl text-gray-300 mb-8">Prueba las páginas de error personalizadas</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-4xl mx-auto">
            <!-- Test 404 -->
            <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20">
                <div class="text-6xl text-red-500 font-black mb-4 text-center">404</div>
                <h2 class="text-2xl font-black text-white mb-4 text-center">PÁGINA NO ENCONTRADA</h2>
                <p class="text-gray-300 text-center mb-6">Prueba la página de error 404 personalizada</p>
                <div class="text-center">
                    <a href="/test-404" class="inline-block bg-red-500 hover:bg-red-600 text-white font-black px-6 py-3 rounded-xl transition-all transform hover:scale-105">
                        PROBAR 404
                    </a>
                </div>
            </div>

            <!-- Test 403 -->
            <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20">
                <div class="text-6xl text-yellow-500 font-black mb-4 text-center">403</div>
                <h2 class="text-2xl font-black text-white mb-4 text-center">ACCESO DENEGADO</h2>
                <p class="text-gray-300 text-center mb-6">Prueba la página de error 403 personalizada</p>
                <div class="text-center">
                    <a href="/test-403" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-black font-black px-6 py-3 rounded-xl transition-all transform hover:scale-105">
                        PROBAR 403
                    </a>
                </div>
            </div>

            <!-- Test 500 -->
            <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20">
                <div class="text-6xl text-orange-500 font-black mb-4 text-center">500</div>
                <h2 class="text-2xl font-black text-white mb-4 text-center">ERROR SERVIDOR</h2>
                <p class="text-gray-300 text-center mb-6">Prueba la página de error 500 personalizada</p>
                <div class="text-center">
                    <a href="/test-500" class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-black px-6 py-3 rounded-xl transition-all transform hover:scale-105">
                        PROBAR 500
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="/" class="inline-block bg-gradient-to-r from-red-500 via-blue-500 to-green-500 text-white font-black px-8 py-4 rounded-xl transform hover:scale-105 transition-all">
                🏠 VOLVER AL INICIO
            </a>
        </div>

        <div class="mt-12 bg-white/5 backdrop-blur rounded-2xl p-6 max-w-4xl mx-auto">
            <h3 class="text-2xl font-black text-yellow-400 mb-4">ℹ️ INFORMACIÓN IMPORTANTE</h3>
            <div class="space-y-3 text-gray-300">
                <p>• <strong>En desarrollo (APP_DEBUG=true):</strong> Se mostrarán las páginas de error personalizadas usando las rutas de prueba</p>
                <p>• <strong>En producción (APP_DEBUG=false):</strong> Las páginas se mostrarán automáticamente cuando ocurra un error real</p>
                <p>• <strong>Para probar en producción:</strong> Cambia APP_DEBUG=false en el archivo .env</p>
                <p>• <strong>Las páginas incluyen:</strong> Diseño consistente, botones de retorno, contacto por WhatsApp</p>
            </div>
        </div>
    </div>
</body>
</html>
