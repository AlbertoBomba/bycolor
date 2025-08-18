<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 403 - Acceso Denegado - bycolor.es</title>
    <meta name="description" content="Acceso denegado. Vuelve al inicio de bycolor.es">
    <meta name="author" content="bycolor.es">
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/16_16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/32_32.png') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/favicon/64_64.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon/32_32.png') }}">
    
    @vite(['resources/css/app.css', 'resources/css/landing.css', 'resources/css/tailwind-landing-styles.css'])
    
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(-2deg); }
            50% { transform: translateY(-20px) rotate(-2deg); }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(239, 68, 68, 0.5); }
            50% { box-shadow: 0 0 40px rgba(239, 68, 68, 0.8), 0 0 60px rgba(59, 130, 246, 0.3); }
        }
        .float-animation { animation: float 3s ease-in-out infinite; }
        .pulse-glow { animation: pulse-glow 2s ease-in-out infinite; }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-900 via-black to-gray-900 min-h-screen overflow-hidden relative">
    <!-- Elementos decorativos de fondo -->
    <div class="absolute inset-0">
        <div class="absolute top-10 left-10 text-8xl text-red-500 opacity-10 font-black transform rotate-12">403</div>
        <div class="absolute top-32 right-20 text-6xl text-yellow-500 opacity-10 font-black transform -rotate-12">🔒</div>
        <div class="absolute bottom-20 left-32 text-7xl text-orange-500 opacity-10 font-black transform rotate-45">STOP</div>
        <div class="absolute bottom-32 right-10 text-5xl text-red-500 opacity-10 font-black transform -rotate-45">NO</div>
    </div>

    <!-- Contenido principal -->
    <div class="relative z-10 min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-4xl mx-auto">
            <!-- Logo flotante -->
            <div class="mb-8 sm:mb-12 float-animation">
                <div class="text-6xl sm:text-8xl lg:text-9xl font-black">
                    <span class="text-red-500">by</span><span class="text-blue-500">co</span><span class="text-green-500">lor</span><span class="text-purple-500">.es</span>
                </div>
            </div>

            <!-- Mensaje principal -->
            <div class="mb-8 sm:mb-12">
                <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black text-white mb-4 sm:mb-6 leading-tight">
                    🔒 <span class="text-red-500">ACCESO</span> 
                    <span class="text-orange-400">DENEGADO</span>
                </h1>
                <h2 class="text-2xl sm:text-4xl lg:text-5xl font-black text-gray-300 mb-6 sm:mb-8">
                    <span class="text-red-500">ERROR</span> 
                    <span class="text-yellow-500">403</span>
                </h2>
                
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-6 sm:p-8 border border-white/20 shadow-2xl">
                    <p class="text-lg sm:text-xl lg:text-2xl text-gray-300 leading-relaxed mb-6 sm:mb-8">
                        No tienes permisos para acceder a esta sección. 
                        <span class="text-yellow-400 font-black">Esta área está restringida</span>. 
                        <br class="hidden sm:block">
                        Vuelve al inicio para conocer todos nuestros servicios públicos.
                    </p>
                    
                    <!-- Botón de acción -->
                    <a href="/" class="inline-block group">
                        <div class="bg-gradient-to-r from-red-500 via-blue-500 to-green-500 p-1 rounded-2xl pulse-glow transform hover:scale-105 transition-all duration-300">
                            <div class="bg-black rounded-xl px-8 sm:px-12 py-4 sm:py-6 group-hover:bg-gray-900 transition-all duration-300">
                                <div class="flex items-center justify-center space-x-3 sm:space-x-4">
                                    <span class="text-2xl sm:text-3xl">🏠</span>
                                    <span class="text-xl sm:text-2xl lg:text-3xl font-black text-white group-hover:text-yellow-400 transition-colors duration-300">
                                        VOLVER AL INICIO
                                    </span>
                                    <span class="text-xl sm:text-2xl lg:text-3xl text-red-500 group-hover:translate-x-2 transition-transform duration-300">
                                        →
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/34600646123?text=Hola%20bycolor,%20necesito%20acceso%20a%20una%20sección%20restringida" 
       class="fixed bottom-6 right-6 bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-2xl transform hover:scale-110 transition-all duration-300 z-50 pulse-glow" 
       target="_blank" 
       title="Solicitar acceso por WhatsApp">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.531 3.485"/>
        </svg>
    </a>
</body>
</html>
