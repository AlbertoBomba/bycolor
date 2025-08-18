<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Cookies - bycolor.es</title>
    <meta name="description" content="Información sobre el uso de cookies en bycolor.es">
    <meta name="author" content="bycolor.es">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="https://bycolor.es/cookies">
    
    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/16_16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/32_32.png') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/favicon/64_64.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon/32_32.png') }}">
    
    @vite(['resources/css/app.css', 'resources/css/landing.css', 'resources/css/tailwind-landing-styles.css'])
</head>
<body class="bg-white">
    <!-- Navigation Menu -->
    <nav class="fixed top-0 w-full bg-black/95 backdrop-blur-sm z-50 shadow-lg border-b border-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-3 sm:py-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl sm:text-3xl font-black transform -rotate-2">
                    <a href="/" class="text-white hover:text-gray-300 transition-colors">
                        <span class="text-red-500">by</span><span class="text-blue-500">co</span><span class="text-green-500">lor</span><span class="text-purple-500">.es</span>
                    </a>
                </div>
                <div class="hidden sm:block">
                    <a href="/" class="text-white hover:text-red-500 transition-all font-bold text-sm sm:text-base transform hover:scale-105">
                        ← VOLVER AL INICIO
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-20 sm:pt-24 min-h-screen bg-gradient-to-br from-gray-50 to-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-16">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="text-center mb-12 sm:mb-16">
                    <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black mb-4 sm:mb-6">
                        <span class="text-red-500">POLÍTICA</span> 
                        <span class="text-blue-500">DE</span> 
                        <span class="text-green-500">COOKIES</span> 
                        <span class="text-yellow-500">🍪</span>
                    </h1>
                    <div class="h-1 w-24 sm:w-32 bg-gradient-to-r from-red-500 via-blue-500 to-green-500 mx-auto rounded-full"></div>
                </div>

                <!-- Content -->
                <div class="bg-white rounded-3xl shadow-2xl p-6 sm:p-12 border border-gray-100">
                    <div class="prose prose-lg max-w-none">
                        <h2 class="text-2xl sm:text-3xl font-black text-gray-800 mb-6 border-b-2 border-red-500 pb-3">¿QUÉ SON LAS COOKIES?</h2>
                        <p class="mb-6 text-gray-700 leading-relaxed">
                            Las cookies son pequeños archivos de texto que se almacenan en su dispositivo cuando visita un sitio web. 
                            Nos ayudan a que el sitio web funcione correctamente, sea más seguro, proporcione una mejor experiencia 
                            de usuario y entienda cómo funciona el sitio web y analizar qué funciona y dónde necesita mejoras.
                        </p>
                        
                        <h2 class="text-2xl sm:text-3xl font-black text-gray-800 mb-6 border-b-2 border-blue-500 pb-3 mt-12">¿CÓMO USAMOS LAS COOKIES?</h2>
                        <p class="mb-4 text-gray-700 leading-relaxed">En bycolor.es utilizamos cookies para:</p>
                        <ul class="list-none mb-6 space-y-3">
                            <li class="flex items-start">
                                <span class="text-red-500 font-black mr-3">📊</span>
                                <div>
                                    <span class="font-bold text-gray-800">Analítica web:</span>
                                    <span class="text-gray-700"> Entender cómo interactúas con nuestro sitio (Google Analytics)</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 font-black mr-3">⚙️</span>
                                <div>
                                    <span class="font-bold text-gray-800">Funcionalidad:</span>
                                    <span class="text-gray-700"> Recordar preferencias y configuraciones</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <span class="text-green-500 font-black mr-3">🔒</span>
                                <div>
                                    <span class="font-bold text-gray-800">Seguridad:</span>
                                    <span class="text-gray-700"> Proteger formularios contra spam</span>
                                </div>
                            </li>
                        </ul>
                        
                        <h2 class="text-2xl sm:text-3xl font-black text-gray-800 mb-6 border-b-2 border-green-500 pb-3 mt-12">TIPOS DE COOKIES QUE UTILIZAMOS</h2>
                        
                        <div class="grid md:grid-cols-2 gap-6 mb-8">
                            <!-- Cookies Técnicas -->
                            <div class="bg-gradient-to-r from-red-50 to-pink-50 p-6 rounded-2xl border border-red-200">
                                <h3 class="text-xl font-black text-red-600 mb-4">🔧 COOKIES TÉCNICAS</h3>
                                <p class="text-gray-700 text-sm mb-3">Son esenciales para el correcto funcionamiento del sitio web.</p>
                                <ul class="text-xs text-gray-600 space-y-1">
                                    <li>• Sesión de usuario</li>
                                    <li>• Configuración de idioma</li>
                                    <li>• Protección CSRF</li>
                                </ul>
                                <div class="mt-3 text-xs font-bold text-red-600">NECESARIAS - No se pueden desactivar</div>
                            </div>

                            <!-- Cookies Analíticas -->
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-2xl border border-blue-200">
                                <h3 class="text-xl font-black text-blue-600 mb-4">📈 COOKIES ANALÍTICAS</h3>
                                <p class="text-gray-700 text-sm mb-3">Nos ayudan a entender cómo usas nuestro sitio web.</p>
                                <ul class="text-xs text-gray-600 space-y-1">
                                    <li>• Google Analytics</li>
                                    <li>• Páginas más visitadas</li>
                                    <li>• Tiempo en el sitio</li>
                                </ul>
                                <div class="mt-3 text-xs font-bold text-blue-600">OPCIONALES - Se pueden desactivar</div>
                            </div>
                        </div>
                        
                        <h2 class="text-2xl sm:text-3xl font-black text-gray-800 mb-6 border-b-2 border-purple-500 pb-3 mt-12">COOKIES DE TERCEROS</h2>
                        <p class="mb-4 text-gray-700 leading-relaxed">Utilizamos algunos servicios de terceros que pueden instalar cookies:</p>
                        
                        <div class="bg-gradient-to-r from-purple-50 to-violet-50 p-6 rounded-2xl border border-purple-200 mb-6">
                            <h3 class="text-lg font-black text-purple-600 mb-3">📊 Google Analytics</h3>
                            <p class="text-gray-700 text-sm mb-2">
                                Utilizamos Google Analytics para analizar el tráfico del sitio web y mejorar nuestros servicios.
                            </p>
                            <div class="text-xs text-gray-600 space-y-1">
                                <p>• <strong>_ga:</strong> Distingue a los usuarios (2 años)</p>
                                <p>• <strong>_ga_XXXXXXXXXX:</strong> Mantiene el estado de la sesión (2 años)</p>
                                <p>• <strong>_gid:</strong> Distingue a los usuarios (24 horas)</p>
                            </div>
                            <p class="text-xs text-purple-600 mt-2">
                                <a href="https://policies.google.com/privacy" target="_blank" class="hover:underline">
                                    Ver política de privacidad de Google →
                                </a>
                            </p>
                        </div>
                        
                        <h2 class="text-2xl sm:text-3xl font-black text-gray-800 mb-6 border-b-2 border-yellow-500 pb-3 mt-12">GESTIONAR SUS COOKIES</h2>
                        <p class="mb-4 text-gray-700 leading-relaxed">Puede controlar y gestionar las cookies de varias maneras:</p>
                        
                        <div class="grid md:grid-cols-3 gap-4 mb-6">
                            <div class="bg-yellow-50 p-4 rounded-xl border border-yellow-200">
                                <p class="font-bold text-yellow-600 mb-2">🌐 NAVEGADOR</p>
                                <p class="text-gray-700 text-sm">Configure las cookies en la configuración de su navegador</p>
                            </div>
                            <div class="bg-green-50 p-4 rounded-xl border border-green-200">
                                <p class="font-bold text-green-600 mb-2">🔧 HERRAMIENTAS</p>
                                <p class="text-gray-700 text-sm">Use extensiones para bloquear cookies no deseadas</p>
                            </div>
                            <div class="bg-blue-50 p-4 rounded-xl border border-blue-200">
                                <p class="font-bold text-blue-600 mb-2">📱 MÓVIL</p>
                                <p class="text-gray-700 text-sm">Configure cookies en la configuración del navegador móvil</p>
                            </div>
                        </div>
                        
                        <h2 class="text-2xl sm:text-3xl font-black text-gray-800 mb-6 border-b-2 border-indigo-500 pb-3 mt-12">CONFIGURACIÓN POR NAVEGADOR</h2>
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-gray-700">
                                <span class="text-red-500 font-black mr-3">🔥</span>
                                <strong>Firefox:</strong>
                                <span class="ml-2">Preferencias → Privacidad y seguridad → Cookies</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <span class="text-blue-500 font-black mr-3">🌐</span>
                                <strong>Chrome:</strong>
                                <span class="ml-2">Configuración → Privacidad y seguridad → Cookies</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <span class="text-purple-500 font-black mr-3">🧭</span>
                                <strong>Safari:</strong>
                                <span class="ml-2">Preferencias → Privacidad → Cookies</span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <span class="text-cyan-500 font-black mr-3">🔷</span>
                                <strong>Edge:</strong>
                                <span class="ml-2">Configuración → Privacidad, búsqueda y servicios</span>
                            </div>
                        </div>
                        
                        <h2 class="text-2xl sm:text-3xl font-black text-gray-800 mb-6 border-b-2 border-pink-500 pb-3 mt-12">CONTACTO</h2>
                        <p class="mb-6 text-gray-700 leading-relaxed">
                            Si tiene preguntas sobre nuestra política de cookies:
                        </p>
                        <div class="bg-gradient-to-r from-red-50 to-blue-50 p-6 rounded-2xl border border-gray-200">
                            <p class="font-bold text-gray-800 mb-2">📧 Email: <span class="text-blue-500">att@bycolor.es</span></p>
                            <p class="font-bold text-gray-800 mb-2">🌐 Web: <span class="text-green-500">https://bycolor.es</span></p>
                            <p class="font-bold text-gray-800">⏱️ Respuesta: <span class="text-purple-500">En menos de 24 horas</span></p>
                        </div>
                        
                        <div class="mt-12 p-6 bg-gray-900 text-white rounded-2xl text-center">
                            <p class="text-sm mb-2">Última actualización: Agosto 2025</p>
                            <div class="text-xl font-black">
                                <span class="text-red-500">by</span><span class="text-blue-500">co</span><span class="text-green-500">lor</span><span class="text-purple-500">.es</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-black py-12 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="text-3xl sm:text-4xl font-black mb-4 transform -rotate-2">
                <span class="text-red-500">by</span><span class="text-blue-500">co</span><span class="text-green-500">lor</span><span class="text-purple-500">.es</span>
            </div>
            <p class="text-gray-400 mb-4">© 2025 bycolor.es - Todos los derechos reservados</p>
            <div class="space-x-4">
                <a href="/terminos-condiciones" class="text-gray-400 hover:text-white transition-colors">Términos y Condiciones</a>
                <span class="text-gray-600">|</span>
                <a href="/politica-privacidad" class="text-gray-400 hover:text-white transition-colors">Política de Privacidad</a>
                <span class="text-gray-600">|</span>
                <a href="/cookies" class="text-gray-400 hover:text-white transition-colors">Cookies</a>
                <span class="text-gray-600">|</span>
                <a href="/" class="text-gray-400 hover:text-white transition-colors">Inicio</a>
            </div>
        </div>
    </footer>
</body>
</html>
