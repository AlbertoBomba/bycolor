<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diseño Web en Toledo - Webs Personalizadas | bycolor.es</title>
    <meta name="description" content="Diseño web profesional en Toledo. Creamos páginas web personalizadas, tiendas online y sistemas únicos. ¡100% personalizados, sin plantillas! Contacta ahora."><meta name="keywords" content="diseño web Toledo, páginas web Toledo, desarrollo web personalizado Toledo, tiendas online Toledo, SEO Toledo, diseñador web Toledo">
    <meta name="author" content="bycolor.es">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://bycolor.es/diseño-web-en-toledo">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="https://bycolor.es/sitemap.xml">
    
    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/16_16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/32_32.png') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/favicon/64_64.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon/32_32.png') }}">
    
    @vite(['resources/css/app.css', 'resources/css/landing.css', 'resources/css/tailwind-landing-styles.css', 'resources/js/app.js', 'resources/js/landing.js', 'resources/js/tailwind-landing.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Contact route for JavaScript -->
    <script>
        window.contactRoute = '{{ route("contacto.enviar") }}';
    </script>
</head>
<body class="bg-white overflow-x-hidden">
    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/34600646123?text=Hola%20bycolor,%20quiero%20información%20sobre%20sus%20servicios%20de%20desarrollo%20web" 
       class="whatsapp-float" target="_blank" title="Contactar por WhatsApp">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.531 3.485"/>
        </svg>
    </a>
    <!-- Navigation Menu -->
    <nav class="fixed top-0 w-full bg-black/95 backdrop-blur-sm z-50 shadow-lg border-b border-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-3 sm:py-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl sm:text-3xl font-black transform -rotate-2">
                    <span class="text-red-500">by</span><span class="text-blue-500">co</span><span class="text-green-500">lor</span><span class="text-purple-500">.es</span>
                </div>
                
                <!-- Mobile menu button -->
                <button class="md:hidden p-2 rounded-lg bg-gradient-to-r from-red-500 to-purple-600 text-white" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <!-- Desktop menu -->
                <div class="hidden md:flex space-x-4 lg:space-x-8">
                    <a href="#desarrollo-web" class="text-sm lg:text-lg font-bold text-gray-200 hover:text-red-400 transition-all transform hover:scale-110">SERVICIOS</a>
                    <a href="#clientes-desarrollo-web" class="text-sm lg:text-lg font-bold text-gray-200 hover:text-blue-400 transition-all transform hover:scale-110">CLIENTES</a>
                    <a href="#precio-pagina-web" class="text-sm lg:text-lg font-bold text-gray-200 hover:text-green-400 transition-all transform hover:scale-110">PAQUETES</a>
                    <a href="#preguntas-desarrollo-web" class="text-sm lg:text-lg font-bold text-gray-200 hover:text-purple-400 transition-all transform hover:scale-110">FAQ</a>
                    <a href="#presupuestos-pagina-web" class="bg-gradient-to-r from-red-500 to-purple-600 text-white px-4 lg:px-6 py-2 rounded-full font-black transform hover:scale-110 transition-all text-sm lg:text-base">CONTACTO</a>
                </div>
            </div>
            
            <!-- Mobile menu -->
            <div id="mobileMenu" class="md:hidden hidden mt-4 pb-4 space-y-3">
                <a href="#desarrollo-web" class="block text-lg font-bold text-gray-200 hover:text-red-400 transition-all py-2" onclick="toggleMobileMenu()">SERVICIOS</a>
                <a href="#clientes-desarrollo-web" class="block text-lg font-bold text-gray-200 hover:text-blue-400 transition-all py-2" onclick="toggleMobileMenu()">CLIENTES</a>
                <a href="#precio-pagina-web" class="block text-lg font-bold text-gray-200 hover:text-green-400 transition-all py-2" onclick="toggleMobileMenu()">PAQUETES</a>
                <a href="#preguntas-desarrollo-web" class="block text-lg font-bold text-gray-200 hover:text-purple-400 transition-all py-2" onclick="toggleMobileMenu()">FAQ</a>
                <a href="#presupuestos-pagina-web" class="block bg-gradient-to-r from-red-500 to-purple-600 text-white px-6 py-3 rounded-full font-black transition-all text-center" onclick="toggleMobileMenu()">CONTACTO</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20 sm:pt-24 bg-black">
        <!-- Overlay con gradiente adicional para mayor profundidad -->
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900/80 via-transparent to-gray-800/60"></div>
        
        <!-- Elementos flotantes gigantes de colores - Ocultos en móvil -->
        <div class="absolute top-[-8rem] sm:top-[-15rem] left-[-8rem] sm:left-[-15rem] text-enormous sm:text-insane font-black text-red-500 transform rotate-[-30deg] animate-spin-slow opacity-60 drop-shadow-2xl hidden sm:block">
            YA!
        </div>
        
        <div class="absolute top-10 sm:top-20 right-[-4rem] sm:right-[-8rem] text-mega sm:text-brutal font-black text-blue-500 transform rotate-[25deg] opacity-50 drop-shadow-2xl hidden sm:block">
            TOP!
        </div>
        
        <div class="absolute bottom-10 sm:bottom-20 left-[-4rem] sm:left-[-8rem] text-mega sm:text-brutal font-black text-green-500 transform rotate-[-15deg] opacity-50 drop-shadow-2xl hidden sm:block">
            ÚNICA!
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-20">
            <h1 class="text-3xl sm:text-5xl md:text-7xl lg:text-8xl xl:text-insane font-black mb-6 sm:mb-8 transform -skew-x-6 glitch drop-shadow-xl leading-none">
                <span class="text-red-600">Desarrollo</span> <span class="text-blue-600">WEB en</span> <span class="text-green-600">TOLEDO</span>
            </h1>
            <div class="text-2xl sm:text-4xl md:text-6xl lg:text-7xl xl:text-mega font-black text-purple-600 mb-8 sm:mb-12 transform skew-x-3 rotate-1 animate-pulse-brutal drop-shadow-lg leading-none">
                ¡SOMOS ÚNICOS!
            </div>
            <p class="text-base sm:text-lg md:text-2xl lg:text-3xl text-white font-light mb-6 sm:mb-8 max-w-full sm:max-w-4xl mx-auto leading-relaxed bg-white/10 backdrop-blur-sm p-4 sm:p-6 rounded-2xl shadow-lg border border-white/20">
                No usamos plantillas. Nuestro <span class="font-black text-red-400 text-lg sm:text-xl md:text-3xl lg:text-5xl">Desarrollo web en toledo personalizado</span> 
                100%. Manteniendo la premisa de que cada cliente es único.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center items-center mt-8 sm:mt-16">
                <a href="#contacto" class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-6 sm:px-8 md:px-12 lg:px-16 py-3 sm:py-4 md:py-6 lg:py-8 text-base sm:text-lg md:text-2xl lg:text-4xl font-black transform -rotate-3 hover:rotate-0 hover:scale-110 transition-all shadow-2xl rounded-full backdrop-blur-sm border-2 border-white/20 w-full sm:w-auto text-center">
                    ¡QUIERO TRABAJAR CON VOSOTROS!
                </a>
                <a href="#casos" class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 sm:px-8 md:px-12 lg:px-16 py-3 sm:py-4 md:py-6 lg:py-8 text-base sm:text-lg md:text-2xl lg:text-4xl font-black transform rotate-2 hover:rotate-0 hover:scale-110 transition-all shadow-2xl rounded-full backdrop-blur-sm border-2 border-white/20 w-full sm:w-auto text-center">
                    VER CASOS DE ÉXITO
                </a>
            </div>
        </div>

        <!-- Números flotantes de colores con mejor contraste -->
        {{-- <div class="absolute bottom-8 sm:bottom-16 right-4 sm:right-16 text-2xl sm:text-4xl md:text-massive lg:text-huge font-black text-green-400 transform rotate-[35deg] animate-bounce drop-shadow-2xl bg-white/20 backdrop-blur-sm px-2 sm:px-4 py-1 sm:py-2 rounded-2xl">
            +300%
        </div>
         --}}
        <div class="absolute top-32 sm:top-48 left-2 sm:left-8 text-2xl sm:text-4xl md:text-massive lg:text-huge font-black text-purple-400 transform rotate-[-25deg] animate-pulse drop-shadow-2xl bg-white/20 backdrop-blur-sm px-2 sm:px-4 py-1 sm:py-2 rounded-2xl">
            100% SEO
        </div>
    </section>

    <!-- Sección 1: Servicios -->
    <section id="desarrollo-web" class="py-16 sm:py-24 lg:py-32 bg-white relative overflow-hidden">
        <div class="absolute top-0 right-0 text-6xl sm:text-8xl lg:text-brutal font-black text-red-50 transform rotate-45 opacity-20 hidden md:block">
            SERVICIOS
        </div>
        {{-- Diseño Web en Toledo --}}
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16 lg:mb-20">
                <h2 class="text-4xl sm:text-7xl md:text-9xl lg:text-[12rem] xl:text-[15rem] font-black mb-6 sm:mb-8 transform -rotate-3 brutal-shadow leading-none">
                    <span class="text-red-600">LO</span> <span class="text-blue-600">QUE</span> <span class="text-green-600">HACEMOS</span>
                </h2>
                <p class="text-xs sm:text-sm md:text-lg lg:text-2xl text-gray-700 max-w-full sm:max-w-4xl mx-auto px-4 font-bold">
                    Nuestro objetivo es el diseño web en toledo personalizado para nuestro cliente, porque cada cliente tiene sus necesidades. 
                    Todas nuestras páginas webs están diseñadas con la estructura SEO y UX en mente, facilitando la navegación y mejorando la experiencia del usuario.
                </p>
                    <span class="font-black text-red-500 text-lg sm:text-xl md:text-3xl lg:text-5xl">AUMENTAR</span> tus ventas y 
                    <span class="font-black text-blue-500 text-lg sm:text-xl md:text-3xl lg:text-5xl">GENERAR</span> más clientes. 
                    <span class="font-black text-purple-600 text-xl sm:text-3xl md:text-6xl lg:text-9xl">FACTURE MÁS</span> gracias a tu presencia digital.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12 lg:gap-16 items-center">
                <div class="space-y-6 sm:space-y-8">
                    <div class="bg-gradient-to-r from-red-100 to-red-200 p-4 sm:p-6 transform rotate-6 hover:rotate-0 transition-all rounded-3xl">
                        <h3 class="text-xs sm:text-sm md:text-lg lg:text-2xl font-black text-red-800 mb-1 sm:mb-2">🎯 ESTRATEGIA</h3>
                        <h3 class="text-5xl sm:text-7xl md:text-9xl lg:text-[8rem] font-black text-red-900 mb-2 sm:mb-4 leading-none">DIGITAL</h3>
                        <p class="text-xs sm:text-xs md:text-sm text-red-700 font-medium">Analizamos tu negocio y creamos una estrategia digital para atraer a tu cliente ideal.</p>
                    </div>
                    
                    <div class="bg-gradient-to-r from-blue-100 to-blue-200 p-8 sm:p-12 transform -rotate-4 hover:rotate-0 transition-all rounded-2xl">
                        <h3 class="text-2xl sm:text-4xl md:text-6xl lg:text-8xl font-black text-blue-800 mb-2 sm:mb-4">🚀 WEBS QUE</h3>
                        <h3 class="text-xl sm:text-2xl md:text-4xl lg:text-6xl font-black text-blue-900 mb-2 sm:mb-4 leading-none">CONVIERTEN</h3>
                        <p class="text-sm sm:text-base md:text-xl text-blue-700 font-medium">Diseños psicológicamente optimizados para que tus visitantes se conviertan en clientes.</p>
                    </div>
                    
                    <div class="bg-gradient-to-r from-green-100 to-green-200 p-3 sm:p-4 transform rotate-8 hover:rotate-0 transition-all rounded-xl">
                        <h3 class="text-2xl sm:text-4xl md:text-6xl lg:text-8xl font-black text-green-800 mb-1 sm:mb-2">⚡ VELOCIDAD</h3>
                        <h3 class="text-xs sm:text-sm md:text-lg lg:text-2xl font-black text-green-900 mb-1 sm:mb-2 leading-none">BRUTAL</h3>
                        <p class="text-xs sm:text-xs md:text-sm text-green-700 font-medium">Webs ultrarrápidas que mejoran tu posicionamiento y experiencia de usuario.</p>
                    </div>
                </div>

                <div class="relative mt-8 lg:mt-0">
                    <div class="bg-gradient-to-br from-purple-500 to-pink-500 p-6 sm:p-8 rounded-3xl text-white transform rotate-12 hover:rotate-0 transition-all shadow-2xl">
                        <h3 class="text-xs sm:text-sm md:text-lg lg:text-2xl font-black mb-2 sm:mb-4 text-center leading-tight">RESULTADOS</h3>
                        <h3 class="text-3xl sm:text-5xl md:text-[4rem]  font-black mb-6 sm:mb-8 text-center leading-none">GARANTIZADOS</h3>
                        <div class="grid grid-cols-2 gap-2 sm:gap-4 text-center">
                            <div>
                                <div class="text-lg sm:text-2xl md:text-4xl lg:text-6xl font-black mb-1 sm:mb-2">100%</div>
                                <div class="text-xs sm:text-xs md:text-sm">Satisfacción</div>
                            </div>
                            <div>
                                <div class="text-2xl sm:text-4xl md:text-6xl lg:text-8xl font-black mb-1 sm:mb-2">-70%</div>
                                <div class="text-xs sm:text-xs md:text-sm">Menos rebote</div>
                            </div>
                            <div>
                                <div class="text-3xl sm:text-5xl md:text-7xl lg:text-9xl font-black mb-1 sm:mb-2">24H</div>
                                <div class="text-xs sm:text-xs md:text-sm">Respuesta</div>
                            </div>
                            {{-- <div>
                                <div class="text-sm sm:text-lg md:text-2xl lg:text-4xl font-black mb-1 sm:mb-2">100%</div>
                                <div class="text-xs sm:text-xs md:text-sm">Satisfacción</div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección 2: Casos de Éxito -->
    <section id="clientes-desarrollo-web" class="py-16 sm:py-24 lg:py-32 bg-gradient-to-r from-purple-50 to-pink-50 relative overflow-hidden">
        <div class="absolute top-0 left-0 text-6xl sm:text-8xl lg:text-brutal font-black text-green-100 transform -rotate-45 opacity-10 hidden md:block">
            CASOS
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16 lg:mb-20">
                <h2 class="text-2xl sm:text-3xl md:text-5xl lg:text-8xl font-black mb-4 sm:mb-6 lg:mb-8 transform rotate-2 leading-none">
                    <span class="text-purple-600">CASOS</span> <span class="text-pink-600">DE</span> 
                </h2>
                <h2 class="text-8xl sm:text-9xl md:text-[10rem] lg:text-[15rem] xl:text-[20rem] font-black mb-6 sm:mb-8 transform -rotate-3 leading-none">
                    <span class="text-red-600">ÉXITO</span>
                </h2>
                <p class="text-xs sm:text-sm md:text-lg lg:text-xl text-gray-700 font-light px-4">
                    Resultados reales de clientes reales que han <span class="font-black text-green-600 text-xl sm:text-3xl md:text-5xl lg:text-8xl">MEJORADO</span> día a día.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 sm:gap-8">
                <!-- Caso 1 - MEGA CARD -->
                <div class="bg-white p-0 rounded-3xl shadow-2xl transform rotate-8 hover:rotate-0 hover:scale-105 transition-all overflow-hidden sm:col-span-2 xl:col-span-2">
                    <div class="w-full mb-4 sm:mb-6">
                        <img src="{{ asset('images/casos-exito/cdpuebla.jpg') }}" alt="CD Puebla - Sistema de gestión deportiva" class="w-full h-64 sm:h-80 md:h-96 object-cover lazy" loading="lazy">
                    </div>
                    <div class="px-6 sm:px-8 pb-6 sm:pb-8">
                        <h3 class="text-xs sm:text-sm md:text-lg lg:text-xl font-black text-red-600 mb-2 sm:mb-4">Esc. Deportiva</h3>
                        <h3 class="text-4xl sm:text-6xl md:text-8xl lg:text-9xl font-black text-red-800 mb-3 sm:mb-4 leading-none">SaaS +</h3>
                        <h3 class="text-2xl sm:text-3xl md:text-5xl lg:text-6xl font-black text-red-800 mb-3 sm:mb-4 leading-none">Landing</h3>
                        
                        <!-- Problemas Resueltos -->
                        <div class="bg-gray-50 p-3 sm:p-4 rounded-lg mb-4">
                            <h4 class="text-xs sm:text-sm font-black text-gray-800 mb-2">✅ PROBLEMAS RESUELTOS:</h4>
                            <ul class="space-y-1 text-sm text-gray-600">
                                <li>• Toma de inscripción web</li>
                                <li>• Gestión de matrículas</li>
                                <li>• Cobro de matrículas mediante tarjeta</li>
                                <li>• Control de cobros</li>
                                <li>• Gestión general de alumnos</li>
                            </ul>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-green-100 p-3 sm:p-4 rounded-lg">
                                <div class="text-2xl sm:text-4xl md:text-6xl lg:text-7xl font-black text-green-800">+20%</div>
                                <div class="text-xs sm:text-sm md:text-base text-green-600">Incripciones</div>
                            </div>
                            <div class="bg-blue-100 p-3 sm:p-4 rounded-lg">
                                <div class="text-xl sm:text-3xl md:text-5xl lg:text-6xl font-black text-blue-800">-19%</div>
                                <div class="text-xs sm:text-sm md:text-base text-blue-600">Impagos</div>
                            </div>
                        </div>
                        <p class="text-gray-600 mt-4 text-sm sm:text-base mb-4">
                            "Sistema implantado desde 2022, con más de 1200 alumnos gestionados."
                        </p>
                        <a href="https://cdpuebla.es" target="_blank" class="inline-block w-full bg-gradient-to-r from-red-500 to-red-600 text-white py-3 sm:py-4 px-4 sm:px-6 text-sm sm:text-base font-black rounded-lg hover:from-red-600 hover:to-red-700 transform hover:scale-105 transition-all text-center">
                            🌐 VER WEB EN VIVO
                        </a>
                    </div>
                </div>

                <!-- Caso 2 - MINI CARD -->
                {{-- <div class="bg-white p-3 sm:p-4 rounded-2xl shadow-2xl transform -rotate-12 hover:rotate-0 hover:scale-105 transition-all">
                    <div class="text-2xl sm:text-3xl mb-2 sm:mb-3 text-center">🏥</div>
                    <h3 class="text-xs sm:text-sm font-black text-blue-600 mb-1 sm:mb-2">CLÍNICA</h3>
                    <h3 class="text-lg sm:text-xl md:text-3xl font-black text-blue-800 mb-2 sm:mb-3 leading-none">DENTAL</h3>
                    <div class="space-y-1 sm:space-y-2">
                        <div class="bg-green-100 p-1 sm:p-2 rounded">
                            <div class="text-sm sm:text-lg md:text-2xl font-black text-green-800">+380%</div>
                            <div class="text-xs text-green-600">Citas online</div>
                        </div>
                        <div class="bg-purple-100 p-1 sm:p-2 rounded">
                            <div class="text-xs sm:text-sm md:text-lg font-black text-purple-800">TOP 3</div>
                            <div class="text-xs text-purple-600">Google local</div>
                        </div>
                    </div>
                    <p class="text-gray-600 mt-2 text-xs mb-3">
                        "La web se paga sola con 2 pacientes al mes."
                    </p>
                    <a href="https://clinicadentalejemplo.com" target="_blank" class="inline-block w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-1 sm:py-2 px-2 sm:px-3 text-xs font-black rounded hover:from-blue-600 hover:to-blue-700 transform hover:scale-105 transition-all text-center">
                        🌐 VER WEB
                    </a>
                </div> --}}

                <!-- Caso 3 - MEDIUM CARD -->
                {{-- <div class="bg-white p-5 sm:p-6 rounded-3xl shadow-2xl transform rotate-15 hover:rotate-0 hover:scale-105 transition-all">
                    <div class="text-4xl sm:text-6xl md:text-8xl mb-3 sm:mb-4 text-center">🏢</div>
                    <h3 class="text-sm sm:text-lg md:text-xl font-black text-green-600 mb-2 sm:mb-3">CONSUL</h3>
                    <h3 class="text-2xl sm:text-4xl md:text-6xl font-black text-green-800 mb-3 sm:mb-4 leading-none">TORÍA</h3>
                    <div class="space-y-2 sm:space-y-3">
                        <div class="bg-green-100 p-2 sm:p-3 rounded-lg">
                            <div class="text-lg sm:text-2xl md:text-4xl font-black text-green-800">+290%</div>
                            <div class="text-xs sm:text-sm text-green-600">Leads cualificados</div>
                        </div>
                        <div class="bg-red-100 p-2 sm:p-3 rounded-lg">
                            <div class="text-xl sm:text-3xl md:text-5xl font-black text-red-800">50K€</div>
                            <div class="text-xs sm:text-sm text-red-600">Ventas extra</div>
                        </div>
                    </div>
                    <p class="text-gray-600 mt-3 text-xs sm:text-sm mb-4">
                        "ROI del 800% en el primer año."
                    </p>
                    <a href="https://consultoriaejemplo.com" target="_blank" class="inline-block w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-2 sm:py-3 px-3 sm:px-4 text-xs sm:text-sm font-black rounded-lg hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all text-center">
                        🌐 VER WEB EN VIVO
                    </a>
                </div> --}}

                <!-- Caso 4 - TINY CARD -->
                {{-- <div class="bg-white p-2 sm:p-3 rounded-xl shadow-2xl transform -rotate-6 hover:rotate-0 hover:scale-105 transition-all">
                    <div class="text-xl sm:text-2xl mb-1 sm:mb-2 text-center">🍕</div>
                    <h3 class="text-xs font-black text-orange-600 mb-1">RESTAU</h3>
                    <h3 class="text-sm sm:text-lg font-black text-orange-800 mb-2 leading-none">RANTE</h3>
                    <div class="space-y-1">
                        <div class="bg-green-100 p-1 rounded">
                            <div class="text-xs sm:text-sm font-black text-green-800">+420%</div>
                            <div class="text-xs text-green-600">Pedidos</div>
                        </div>
                        <div class="bg-yellow-100 p-1 rounded">
                            <div class="text-lg sm:text-xl font-black text-yellow-800">#1</div>
                            <div class="text-xs text-yellow-600">En su zona</div>
                        </div>
                    </div>
                    <p class="text-gray-600 mt-2 text-xs mb-2">
                        "De 10 a 50 pedidos diarios."
                    </p>
                    <a href="https://restauranteejemplo.com" target="_blank" class="inline-block w-full bg-gradient-to-r from-orange-500 to-orange-600 text-white py-1 px-2 text-xs font-black rounded hover:from-orange-600 hover:to-orange-700 transform hover:scale-105 transition-all text-center">
                        🌐 VER
                    </a>
                </div> --}}
            </div>

            <div class="text-center mt-12 sm:mt-16">
                <a href="#contacto" class="bg-gradient-to-r from-green-500 to-blue-500 text-white px-6 sm:px-8 md:px-12 lg:px-16 py-3 sm:py-4 md:py-6 lg:py-8 text-base sm:text-lg md:text-2xl lg:text-4xl font-black rounded-full transform hover:scale-110 transition-all shadow-2xl inline-block">
                    QUIERO ESTOS RESULTADOS
                </a>
            </div>
        </div>
    </section>

    <!-- Sección: Tecnologías -->
    <section class="py-16 sm:py-24 lg:py-32 bg-gradient-to-br from-gray-900 via-black to-gray-800 relative overflow-hidden">
        <div class="absolute top-0 right-0 text-6xl sm:text-8xl lg:text-[8rem] font-black text-white opacity-5 transform rotate-12 hidden md:block">
            TECH
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16 lg:mb-20">
                <h2 class="text-5xl sm:text-8xl md:text-[10rem] lg:text-[15rem] xl:text-[18rem] font-black mb-6 sm:mb-8 transform -rotate-2 leading-none">
                    <span class="text-red-500">TECHNO</span>
                </h2>
                <h2 class="text-3xl sm:text-5xl md:text-7xl lg:text-9xl font-black mb-6 sm:mb-8 transform rotate-1 leading-none">
                    <span class="text-blue-500">LOGÍAS</span> <span class="text-green-500">BRUTALES</span>
                </h2>
                <p class="text-sm sm:text-lg md:text-xl lg:text-2xl text-gray-300 font-light px-4">
                    Usamos las <span class="font-black text-purple-400 text-lg sm:text-2xl md:text-4xl lg:text-6xl">MEJORES HERRAMIENTAS</span> para crear tus proyectos
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-6 sm:gap-8 items-center">
                <!-- Laravel -->
                <div class="bg-gradient-to-br from-red-600 to-red-700 p-4 sm:p-6 md:p-8 rounded-3xl shadow-2xl transform rotate-3 hover:rotate-0 hover:scale-110 transition-all group">
                    <div class="text-center">
                        <div class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-white mb-2 sm:mb-3 group-hover:scale-125 transition-all">
                            L
                        </div>
                        <h3 class="text-xs sm:text-sm md:text-lg font-black text-white leading-none">LARAVEL</h3>
                        <div class="text-xs text-red-200 mt-1">Framework PHP</div>
                    </div>
                </div>

                <!-- PHP -->
                <div class="bg-gradient-to-br from-purple-600 to-indigo-700 p-4 sm:p-6 md:p-8 rounded-2xl shadow-2xl transform -rotate-6 hover:rotate-0 hover:scale-110 transition-all group">
                    <div class="text-center">
                        <div class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-white mb-2 sm:mb-3 group-hover:scale-125 transition-all">
                            🐘
                        </div>
                        <h3 class="text-xs sm:text-sm md:text-lg font-black text-white leading-none">PHP</h3>
                        <div class="text-xs text-purple-200 mt-1">Backend Power</div>
                    </div>
                </div>

                <!-- Alpine.js -->
                <div class="bg-gradient-to-br from-teal-500 to-cyan-600 p-4 sm:p-6 md:p-8 rounded-xl shadow-2xl transform rotate-8 hover:rotate-0 hover:scale-110 transition-all group">
                    <div class="text-center">
                        <div class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-white mb-2 sm:mb-3 group-hover:scale-125 transition-all">
                            🏔️
                        </div>
                        <h3 class="text-xs sm:text-sm md:text-lg font-black text-white leading-none">ALPINE</h3>
                        <div class="text-xs text-teal-200 mt-1">JS Framework</div>
                    </div>
                </div>

                <!-- Python -->
                <div class="bg-gradient-to-br from-yellow-400 to-blue-600 p-4 sm:p-6 md:p-8 rounded-3xl shadow-2xl transform -rotate-4 hover:rotate-0 hover:scale-110 transition-all group">
                    <div class="text-center">
                        <div class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-white mb-2 sm:mb-3 group-hover:scale-125 transition-all">
                            🐍
                        </div>
                        <h3 class="text-xs sm:text-sm md:text-lg font-black text-white leading-none">PYTHON</h3>
                        <div class="text-xs text-yellow-200 mt-1">IA & Scripts</div>
                    </div>
                </div>

                <!-- Shopify -->
                <div class="bg-gradient-to-br from-green-500 to-green-700 p-4 sm:p-6 md:p-8 rounded-2xl shadow-2xl transform rotate-12 hover:rotate-0 hover:scale-110 transition-all group">
                    <div class="text-center">
                        <div class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-white mb-2 sm:mb-3 group-hover:scale-125 transition-all">
                            🛒
                        </div>
                        <h3 class="text-xs sm:text-sm md:text-lg font-black text-white leading-none">SHOPIFY</h3>
                        <div class="text-xs text-green-200 mt-1">E-commerce</div>
                    </div>
                </div>

                <!-- Strato -->
                <div class="bg-gradient-to-br from-orange-500 to-red-600 p-4 sm:p-6 md:p-8 rounded-xl shadow-2xl transform -rotate-8 hover:rotate-0 hover:scale-110 transition-all group">
                    <div class="text-center">
                        <div class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black text-white mb-2 sm:mb-3 group-hover:scale-125 transition-all">
                            🌐
                        </div>
                        <h3 class="text-xs sm:text-sm md:text-lg font-black text-white leading-none">STRATO</h3>
                        <div class="text-xs text-orange-200 mt-1">Hosting</div>
                    </div>
                </div>
            </div>

            <!-- Texto adicional -->
            <div class="text-center mt-12 sm:mt-16 lg:mt-20">
                <div class="bg-white/10 backdrop-blur-sm p-6 sm:p-8 md:p-12 rounded-3xl mx-4 sm:mx-0">
                    <h3 class="text-2xl sm:text-4xl md:text-6xl lg:text-8xl font-black text-white mb-4 sm:mb-6 transform -rotate-1">
                        <span class="text-yellow-400">STACK</span> <span class="text-cyan-400">MODERNO</span>
                    </h3>
                    <p class="text-sm sm:text-lg md:text-xl text-gray-300 font-medium max-w-4xl mx-auto">
                        Cada tecnología seleccionada para <span class="font-black text-green-400 text-lg sm:text-2xl md:text-3xl">MÁXIMO RENDIMIENTO</span>, 
                        escalabilidad y resultados que <span class="font-black text-red-400 text-lg sm:text-2xl md:text-3xl">IMPACTAN</span>.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección 3: Paquetes -->
    <section id="precio-pagina-web" class="py-16 sm:py-24 lg:py-32 bg-white relative overflow-hidden">
        <div class="absolute bottom-0 right-0 text-6xl sm:text-8xl lg:text-mega font-black text-blue-50 transform rotate-12 opacity-30 hidden md:block">
            PACKS
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16 lg:mb-20">
                <h2 class="text-4xl sm:text-5xl md:text-7xl lg:text-ultra font-black mb-6 sm:mb-8 transform -rotate-1 leading-none">
                    <span class="text-green-600">NUESTROS</span> <span class="text-blue-600">PAQUETES</span>
                </h2>
                <p class="text-lg sm:text-xl md:text-2xl text-gray-700 font-light px-4">
                    Elige el paquete perfecto para hacer crecer tu negocio
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
                <!-- Paquete STARTER -->
                <div class="bg-gradient-to-br from-green-100 to-green-200 p-6 sm:p-8 rounded-3xl shadow-xl transform rotate-1 hover:rotate-0 hover:scale-105 transition-all border-4 border-green-300">
                    <div class="text-center">
                        <h3 class="text-2xl sm:text-3xl font-black text-green-800 mb-3 sm:mb-4">STARTER</h3>
                        <div class="text-4xl sm:text-5xl font-black text-green-600 mb-4 sm:mb-6">450€</div>
                        <p class="text-green-700 font-medium mb-6 sm:mb-8">Perfecto para empezar</p>
                    </div>
                    
                    <ul class="space-y-3 sm:space-y-4 mb-6 sm:mb-8">
                        <li class="flex items-center">
                            <span class="text-green-600 text-lg sm:text-xl mr-3">✅</span>
                            <span class="font-medium text-sm sm:text-base">Landing Page optimizada</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-green-600 text-lg sm:text-xl mr-3">✅</span>
                            <span class="font-medium text-sm sm:text-base">Diseño responsive</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-green-600 text-lg sm:text-xl mr-3">✅</span>
                            <span class="font-medium text-sm sm:text-base">Formulario de contacto</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-green-600 text-lg sm:text-xl mr-3">✅</span>
                            <span class="font-medium text-sm sm:text-base">SEO básico</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-green-600 text-lg sm:text-xl mr-3">✅</span>
                            <span class="font-medium text-sm sm:text-base">Entrega en 10 días</span>
                        </li>
                    </ul>
                    
                    <a href="#contacto" class="block bg-green-600 text-white text-center py-3 sm:py-4 rounded-full font-black text-base sm:text-lg hover:bg-green-700 transition-all transform hover:scale-105">
                        EMPEZAR AHORA
                    </a>
                </div>

                <!-- Paquete PRO (Destacado) -->
                <div class="bg-gradient-to-br from-blue-100 to-purple-200 p-6 sm:p-8 rounded-3xl shadow-2xl transform -rotate-1 hover:rotate-0 hover:scale-105 transition-all border-4 border-purple-400 relative order-first lg:order-none">
                    <div class="absolute -top-3 sm:-top-4 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 sm:px-6 py-1 sm:py-2 rounded-full font-black text-xs sm:text-sm">
                        MÁS POPULAR
                    </div>
                    
                    <div class="text-center">
                        <h3 class="text-2xl sm:text-3xl font-black text-purple-800 mb-3 sm:mb-4">PRO</h3>
                        <div class="text-4xl sm:text-5xl font-black text-purple-600 mb-4 sm:mb-6">950€</div>
                        <p class="text-purple-700 font-medium mb-6 sm:mb-8">Para negocios serios</p>
                    </div>
                    
                    <ul class="space-y-3 sm:space-y-4 mb-6 sm:mb-8">
                        <li class="flex items-center">
                            <span class="text-purple-600 text-lg sm:text-xl mr-3">✅</span>
                            <span class="font-medium text-sm sm:text-base">Web completa (hasta 5 páginas)</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-purple-600 text-lg sm:text-xl mr-3">✅</span>
                            <span class="font-medium text-sm sm:text-base">Sistema de reservas/citas</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-purple-600 text-lg sm:text-xl mr-3">✅</span>
                            <span class="font-medium text-sm sm:text-base">Blog integrado</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-purple-600 text-lg sm:text-xl mr-3">✅</span>
                            <span class="font-medium text-sm sm:text-base">SEO avanzado</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-purple-600 text-lg sm:text-xl mr-3">✅</span>
                            <span class="font-medium text-sm sm:text-base">Analytics y tracking</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-purple-600 text-lg sm:text-xl mr-3">✅</span>
                            <span class="font-medium text-sm sm:text-base">Entrega en 30 días</span>
                        </li>
                    </ul>
                    
                    <a href="#contacto" class="block bg-gradient-to-r from-purple-600 to-pink-600 text-white text-center py-3 sm:py-4 rounded-full font-black text-base sm:text-lg hover:from-purple-700 hover:to-pink-700 transition-all transform hover:scale-105">
                        ELEGIR PRO
                    </a>
                </div>

                <!-- Paquete ENTERPRISE -->
                <div class="bg-gradient-to-br from-red-100 to-orange-200 p-6 sm:p-8 rounded-3xl shadow-xl transform rotate-2 hover:rotate-0 hover:scale-105 transition-all border-4 border-red-300">
                    <div class="text-center">
                        <h3 class="text-2xl sm:text-3xl font-black text-red-800 mb-3 sm:mb-4">ENTERPRISE</h3>
                        <div class="text-4xl sm:text-5xl font-black text-red-600 mb-4 sm:mb-6">1.300€</div>
                        <p class="text-red-700 font-medium mb-6 sm:mb-8">Máximo rendimiento</p>
                    </div>
                    
                    <ul class="space-y-3 sm:space-y-4 mb-6 sm:mb-8">
                        <li class="flex items-center">
                            <span class="text-red-600 text-lg sm:text-xl mr-3">✅</span>
                            <span class="font-medium text-sm sm:text-base">E-commerce completo</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-red-600 text-lg sm:text-xl mr-3">✅</span>
                            <span class="font-medium text-sm sm:text-base">Panel de administración</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-red-600 text-lg sm:text-xl mr-3">✅</span>
                            <span class="font-medium text-sm sm:text-base">Integración con CRM</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-red-600 text-lg sm:text-xl mr-3">✅</span>
                            <span class="font-medium text-sm sm:text-base">Email marketing</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-red-600 text-lg sm:text-xl mr-3">✅</span>
                            <span class="font-medium text-sm sm:text-base">Soporte prioritario</span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-red-600 text-lg sm:text-xl mr-3">✅</span>
                            <span class="font-medium text-sm sm:text-base">Entrega en 45 días</span>
                        </li>
                    </ul>
                    
                    <a href="#contacto" class="block bg-red-600 text-white text-center py-3 sm:py-4 rounded-full font-black text-base sm:text-lg hover:bg-red-700 transition-all transform hover:scale-105">
                        CONTACTAR
                    </a>
                </div>
            </div>

            <div class="text-center mt-12 sm:mt-16 p-6 sm:p-8 bg-gradient-to-r from-yellow-100 to-orange-100 rounded-3xl mx-4 sm:mx-0">
                <h3 class="text-2xl sm:text-3xl font-black text-orange-800 mb-4 sm:mb-4">🎁 BONUS GRATIS EN TODOS LOS PAQUETES</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 text-center">
                    <div>
                        <div class="text-lg sm:text-2xl font-black text-green-600">✅ HOSTING</div>
                        <div class="text-xs sm:text-sm text-gray-600">1 año gratis</div>
                    </div>
                    <div>
                        <div class="text-lg sm:text-2xl font-black text-blue-600">✅ SSL</div>
                        <div class="text-xs sm:text-sm text-gray-600">Certificado incluido</div>
                    </div>
                    <div>
                        <div class="text-lg sm:text-2xl font-black text-purple-600">✅ SOPORTE</div>
                        <div class="text-xs sm:text-sm text-gray-600">12 meses gratis</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección 4: FAQ -->
    <section id="preguntas-desarrollo-web" class="py-16 sm:py-24 lg:py-32 bg-gradient-to-br from-gray-50 to-gray-100 relative overflow-hidden">
        <div class="absolute top-0 left-0 text-6xl sm:text-8xl lg:text-mega font-black text-gray-200 transform -rotate-12 opacity-20 hidden md:block">
            FAQ
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16 lg:mb-20">
                <h2 class="text-4xl sm:text-5xl md:text-7xl lg:text-ultra font-black mb-6 sm:mb-8 transform rotate-1 leading-none">
                    <span class="text-gray-800">PREGUNTAS</span> <span class="text-red-600">FRECUENTES</span>
                </h2>
                <p class="text-lg sm:text-xl md:text-2xl text-gray-700 font-light px-4">
                    Todas las dudas que tienes sobre trabajar con nosotros
                </p>
            </div>

            <div class="max-w-4xl mx-auto space-y-4 sm:space-y-6">
                <!-- FAQ 1 -->
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg transform rotate-1 hover:rotate-0 transition-all">
                    <h3 class="text-xl sm:text-2xl font-black text-gray-800 mb-3 sm:mb-4">¿Cuánto tiempo tardáis en entregar una web?</h3>
                    <p class="text-gray-600 text-base sm:text-lg">
                        Depende del paquete y de las necesidades finales del cliente: 
                        <span class="font-bold text-green-600">Starter en 10 días</span>, 
                        <span class="font-bold text-blue-600">Pro en 30 días</span> y 
                        <span class="font-bold text-red-600">Enterprise en 45 días</span>. Siempre cumplimos plazos.
                    </p>
                    <p class="text-gray-600 text-base sm:text-lg">
                        Si necesitas algo urgente, <span class="font-bold text-yellow-600">pregúntanos</span> y veremos qué podemos hacer.
                    </p>

                </div>

                <!-- FAQ 2 -->
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg transform -rotate-1 hover:rotate-0 transition-all">
                    <h3 class="text-xl sm:text-2xl font-black text-gray-800 mb-3 sm:mb-4">¿Qué pasa si no me gusta el diseño?</h3>
                    <p class="text-gray-600 text-base sm:text-lg">
                        Incluimos <span class="font-bold text-purple-600">2 rondas de revisiones gratis</span>. 
                        Trabajamos hasta que estés 100% satisfecho. Tu opinión es lo más importante.
                    </p>
                </div>

                <!-- FAQ 3 -->
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg transform rotate-1 hover:rotate-0 transition-all">
                    <h3 class="text-xl sm:text-2xl font-black text-gray-800 mb-3 sm:mb-4">¿Ofrecéis mantenimiento?</h3>
                    <p class="text-gray-600 text-base sm:text-lg">
                        Sí, incluimos <span class="font-bold text-green-600">12 meses de soporte gratis</span>. 
                    </p>
                </div>

                <!-- FAQ 4 -->
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg transform -rotate-1 hover:rotate-0 transition-all">
                    <h3 class="text-xl sm:text-2xl font-black text-gray-800 mb-3 sm:mb-4">¿Trabajáis con todo tipo de negocios?</h3>
                    <p class="text-gray-600 text-base sm:text-lg">
                        Trabajamos con cualquier negocio que quiera <span class="font-bold text-red-600">conseguir más clientes</span>. 
                        Desde tiendas online hasta servicios profesionales.
                    </p>
                </div>

                <!-- FAQ 5 -->
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg transform rotate-1 hover:rotate-0 transition-all">
                    <h3 class="text-xl sm:text-2xl font-black text-gray-800 mb-3 sm:mb-4">¿Y si mi web no consigue más clientes?</h3>
                    <p class="text-gray-600 text-base sm:text-lg">
                        Ofrecemos <span class="font-bold text-blue-600">garantía de satisfacción</span>. 
                        Si en 3 meses no ves resultados, trabajamos gratis hasta conseguir tener los resultados esperados.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección 5: Contacto -->
    <section id="presupuestos-pagina-web" class="py-16 sm:py-24 lg:py-32 bg-gradient-to-br from-purple-900 via-blue-900 to-red-900 relative overflow-hidden">
        <div class="absolute -top-16 sm:-top-32 -right-16 sm:-right-32 text-6xl sm:text-8xl lg:text-brutal font-black text-white opacity-10 transform rotate-45 animate-pulse hidden md:block">
            CONTACTO
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="text-4xl sm:text-5xl md:text-7xl lg:text-ultra font-black text-white mb-6 sm:mb-8 transform -rotate-2 glitch leading-none">
                    HABLEMOS
                </h2>
                <p class="text-base sm:text-xl md:text-2xl text-gray-200 font-light max-w-full sm:max-w-3xl mx-auto px-4">
                    ¿Preparado para conseguir más clientes? Cuéntanos tu proyecto y te enviaremos una propuesta en menos de 24h.
                </p>
            </div>

            <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12 items-start">
                <!-- Información de contacto -->
                <div class="space-y-6 sm:space-y-8 order-2 lg:order-1">
                    <div class="bg-white/10 backdrop-blur-sm p-6 sm:p-8 rounded-3xl">
                        <h3 class="text-2xl sm:text-3xl font-black text-white mb-4 sm:mb-6">📞 CONTACTO DIRECTO</h3>
                        <div class="space-y-3 sm:space-y-4">
                            <div>
                                <div class="text-lg sm:text-xl font-bold text-yellow-400">Email</div>
                                <div class="text-white text-base sm:text-lg">att@bycolor.es</div>
                            </div>
                            <div>
                                <div class="text-lg sm:text-xl font-bold text-blue-400">Respuesta</div>
                                <div class="text-white text-base sm:text-lg">En menos de 24h</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 sm:p-8 rounded-3xl">
                        <h3 class="text-2xl sm:text-3xl font-black text-white mb-4 sm:mb-6">🚀 PROCESO SIMPLE</h3>
                        <div class="space-y-3 sm:space-y-4">
                            <div class="flex items-center">
                                <span class="bg-red-500 text-white w-6 h-6 sm:w-8 sm:h-8 rounded-full flex items-center justify-center font-black mr-3 sm:mr-4 text-sm sm:text-base">1</span>
                                <span class="text-white text-sm sm:text-base">Nos cuentas tu proyecto</span>
                            </div>
                            <div class="flex items-center">
                                <span class="bg-blue-500 text-white w-6 h-6 sm:w-8 sm:h-8 rounded-full flex items-center justify-center font-black mr-3 sm:mr-4 text-sm sm:text-base">2</span>
                                <span class="text-white text-sm sm:text-base">Te enviamos propuesta</span>
                            </div>
                            <div class="flex items-center">
                                <span class="bg-green-500 text-white w-6 h-6 sm:w-8 sm:h-8 rounded-full flex items-center justify-center font-black mr-3 sm:mr-4 text-sm sm:text-base">3</span>
                                <span class="text-white text-sm sm:text-base">¡Empezamos a trabajar!</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulario de contacto -->
                <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-2xl transform rotate-1 hover:rotate-0 transition-all order-1 lg:order-2" 
                     x-data="contactForm()" x-init="init()" id="contactForm">
                    <h3 class="text-2xl sm:text-3xl font-black text-gray-800 mb-4 sm:mb-6 text-center">CUÉNTANOS TU PROYECTO</h3>
                    
                    <!-- Mensaje de éxito/error dinámico -->
                    <div id="messageContainer" style="display: none;" class="px-4 py-3 rounded-lg mb-4 sm:mb-6 text-sm sm:text-base border">
                        <span id="messageText"></span>
                    </div>
                    
                    <div x-show="message && message.length > 0" 
                         :class="messageType === 'success' ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700'"
                         class="px-4 py-3 rounded-lg mb-4 sm:mb-6 text-sm sm:text-base border"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         style="display: none;">
                        <span x-text="message"></span>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 sm:mb-6 text-sm sm:text-base">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form id="contactoForm" @submit.prevent="submitForm" class="space-y-4 sm:space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <label for="nombre" class="block text-xs sm:text-sm font-bold text-gray-700 mb-1 sm:mb-2">NOMBRE *</label>
                                <input type="text" id="nombre" name="nombre" required
                                    class="form-input"
                                    x-model="formData.nombre">
                                <p x-show="errors.nombre" x-text="errors.nombre" class="text-red-500 text-xs sm:text-sm mt-1"></p>
                            </div>
                            
                            <div>
                                <label for="telefono" class="block text-xs sm:text-sm font-bold text-gray-700 mb-1 sm:mb-2">TELÉFONO</label>
                                <input type="tel" id="telefono" name="telefono"
                                    class="form-input"
                                    x-model="formData.telefono">
                                <p x-show="errors.telefono" x-text="errors.telefono" class="text-red-500 text-xs sm:text-sm mt-1"></p>
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-xs sm:text-sm font-bold text-gray-700 mb-1 sm:mb-2">EMAIL *</label>
                            <input type="email" id="email" name="email" required
                                class="form-input"
                                x-model="formData.email">
                            <p x-show="errors.email" x-text="errors.email" class="text-red-500 text-xs sm:text-sm mt-1"></p>
                        </div>

                        <div>
                            <label for="paquete" class="block text-xs sm:text-sm font-bold text-gray-700 mb-1 sm:mb-2">PAQUETE DE INTERÉS</label>
                            <select id="paquete" name="paquete" class="form-select" x-model="formData.paquete">
                                <option value="">Selecciona un paquete</option>
                                <option value="starter">STARTER - 450€</option>
                                <option value="pro">PRO - 950€</option>
                                <option value="enterprise">ENTERPRISE - 1.300€</option>
                                <option value="personalizado">Proyecto personalizado</option>
                            </select>
                        </div>

                        <div>
                            <label for="mensaje" class="block text-xs sm:text-sm font-bold text-gray-700 mb-1 sm:mb-2">CUÉNTANOS TU PROYECTO *</label>
                            <textarea id="mensaje" name="mensaje" required
                                class="form-textarea"
                                placeholder="Describe tu proyecto, objetivos y cualquier detalle importante..."
                                x-model="formData.mensaje"></textarea>
                            <p x-show="errors.mensaje" x-text="errors.mensaje" class="text-red-500 text-xs sm:text-sm mt-1"></p>
                        </div>

                        <button type="submit" id="submitBtn" class="btn-submit" :disabled="loading" :class="loading ? 'opacity-50 cursor-not-allowed' : ''">
                            <span x-show="!loading" id="submitText">🚀 ENVIAR PROPUESTA GRATUITA</span>
                            <span x-show="loading" id="loadingText" class="flex items-center justify-center" style="display: none;">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                ENVIANDO...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black py-12 sm:py-16 text-white relative overflow-hidden">
        <div class="absolute top-0 left-0 text-6xl sm:text-8xl lg:text-ultra font-black text-gray-900 opacity-20 transform -rotate-12 hidden md:block">
            bycolor
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 sm:gap-12">
                <!-- Logo y descripción -->
                <div class="text-center sm:text-left">
                    <h3 class="text-3xl sm:text-4xl font-black mb-3 sm:mb-4 transform -rotate-2">
                        <span class="text-red-500">by</span><span class="text-blue-500">co</span><span class="text-green-500">lor</span><span class="text-purple-500">.es</span>
                    </h3>
                    <p class="text-gray-300 text-base sm:text-lg">
                        Creamos webs que consiguen clientes reales. 
                        No hacemos páginas bonitas, hacemos máquinas de ventas.
                    </p>
                </div>

                <!-- Enlaces rápidos -->
                <div class="text-center sm:text-left">
                    <h4 class="text-xl sm:text-2xl font-black text-red-500 mb-4 sm:mb-6">NAVEGACIÓN</h4>
                    <ul class="space-y-2 sm:space-y-3">
                        <li><a href="#servicios" class="text-gray-300 hover:text-white transition-all font-medium text-sm sm:text-base">Servicios</a></li>
                        <li><a href="#casos" class="text-gray-300 hover:text-white transition-all font-medium text-sm sm:text-base">Casos de Éxito</a></li>
                        <li><a href="#paquetes" class="text-gray-300 hover:text-white transition-all font-medium text-sm sm:text-base">Paquetes</a></li>
                        <li><a href="#faq" class="text-gray-300 hover:text-white transition-all font-medium text-sm sm:text-base">FAQ</a></li>
                        <li><a href="#contacto" class="text-gray-300 hover:text-white transition-all font-medium text-sm sm:text-base">Contacto</a></li>
                    </ul>
                </div>

                <!-- Contacto -->
                <div class="text-center sm:text-left sm:col-span-2 lg:col-span-1">
                    <h4 class="text-xl sm:text-2xl font-black text-blue-500 mb-4 sm:mb-6">CONTACTO</h4>
                    <div class="space-y-2 sm:space-y-3">
                        <div>
                            <div class="text-yellow-400 font-bold text-sm sm:text-base">Email</div>
                            <div class="text-gray-300 text-sm sm:text-base">hola@bycolor.es</div>
                        </div>
                        <div>
                            <div class="text-green-400 font-bold text-sm sm:text-base">WhatsApp</div>
                            <div class="text-gray-300 text-sm sm:text-base">+34 XXX XXX XXX</div>
                        </div>
                        <div>
                            <div class="text-purple-400 font-bold text-sm sm:text-base">Respuesta</div>
                            <div class="text-gray-300 text-sm sm:text-base">En menos de 24h</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 sm:mt-12 pt-6 sm:pt-8 text-center">
                <div class="text-gray-400 text-sm sm:text-base mb-3 sm:mb-4">
                    © 2024 bycolor.es - Todos los derechos reservados
                </div>
                <div class="text-lg sm:text-xl font-black transform rotate-1">
                    <span class="text-red-500">WEBS</span> 
                    <span class="text-blue-500">QUE</span> 
                    <span class="text-green-500">VENDEN</span>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
