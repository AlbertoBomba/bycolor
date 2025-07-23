<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTACTO - bycolor.es</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white overflow-x-hidden">
    <!-- Header Navigation -->
    <div class="absolute top-8 left-8 z-50">
        <a href="/" class="text-blue-900 font-black text-4xl transform -rotate-12 hover:rotate-0 transition-all glitch">
            ← VOLVER
        </a>
    </div>

    <!-- Hero Section CONTACTO -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-white via-blue-50 to-white py-32">
        <!-- Elementos flotantes gigantes -->
        <div class="absolute top-[-10rem] left-[-10rem] text-brutal font-black text-blue-100 transform rotate-[-30deg] animate-spin-slow opacity-20">
            @
        </div>
        
        <div class="absolute top-32 right-[-5rem] text-mega font-black text-blue-50 transform rotate-[25deg] opacity-15">
            MAIL
        </div>
        
        <div class="container mx-auto px-8 relative z-10">
            <div class="text-center mb-16">
                <h1 class="text-8xl md:text-ultra font-black text-blue-900 mb-8 transform -skew-x-12 glitch animate-pulse-brutal brutal-shadow">
                    CONTACTO
                </h1>
                <p class="text-4xl text-blue-700 font-black transform rotate-2">
                    ¡HABLEMOS AHORA!
                </p>
            </div>

            <!-- FORMULARIO BRUTAL -->
            <div class="max-w-4xl mx-auto">
                @if(session('success'))
                    <div class="bg-green-100 border-4 border-green-500 p-8 mb-12 transform rotate-1">
                        <p class="text-3xl font-black text-green-800 text-center glitch">
                            {{ session('success') }}
                        </p>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-100 border-4 border-red-500 p-8 mb-12 transform -rotate-1">
                        <p class="text-2xl font-black text-red-800 text-center">
                            ¡HAY ERRORES EN EL FORMULARIO!
                        </p>
                        <ul class="mt-4 text-red-700 font-bold">
                            @foreach($errors->all() as $error)
                                <li class="transform rotate-1">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="/contacto" method="POST" class="space-y-12">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <!-- Nombre -->
                        <div class="transform rotate-1 hover:rotate-0 transition-all">
                            <label class="block text-3xl font-black text-blue-900 mb-4 transform -rotate-1">
                                NOMBRE *
                            </label>
                            <input type="text" name="nombre" required
                                   class="w-full p-6 text-2xl font-bold text-blue-900 input-brutal transform -skew-x-1 hover:skew-x-0"
                                   placeholder="Tu nombre aquí">
                        </div>

                        <!-- Email -->
                        <div class="transform -rotate-1 hover:rotate-0 transition-all">
                            <label class="block text-3xl font-black text-blue-900 mb-4 transform rotate-1">
                                EMAIL *
                            </label>
                            <input type="email" name="email" required
                                   class="w-full p-6 text-2xl font-bold text-blue-900 input-brutal transform skew-x-1 hover:skew-x-0"
                                   placeholder="tu@email.com">
                        </div>
                    </div>

                    <!-- Teléfono -->
                    <div class="transform rotate-1 hover:rotate-0 transition-all">
                        <label class="block text-3xl font-black text-blue-900 mb-4 transform -rotate-2">
                            TELÉFONO
                        </label>
                        <input type="tel" name="telefono"
                               class="w-full p-6 text-2xl font-bold text-blue-900 input-brutal transform -skew-x-2 hover:skew-x-0"
                               placeholder="+34 XXX XXX XXX">
                    </div>

                    <!-- Tipo de Proyecto -->
                    <div class="transform -rotate-1 hover:rotate-0 transition-all">
                        <label class="block text-3xl font-black text-blue-900 mb-4 transform rotate-1">
                            TIPO DE PROYECTO *
                        </label>
                        <select name="tipo_proyecto" required
                                class="w-full p-6 text-2xl font-bold text-blue-900 input-brutal transform skew-x-1 hover:skew-x-0">
                            <option value="">Selecciona una opción</option>
                            <option value="web_corporativa">WEB CORPORATIVA</option>
                            <option value="ecommerce">E-COMMERCE</option>
                            <option value="aplicacion_web">APLICACIÓN WEB</option>
                            <option value="landing_page">LANDING PAGE</option>
                            <option value="rediseno">REDISEÑO WEB</option>
                            <option value="otro">OTRO PROYECTO</option>
                        </select>
                    </div>

                    <!-- Presupuesto -->
                    <div class="transform rotate-2 hover:rotate-0 transition-all">
                        <label class="block text-3xl font-black text-blue-900 mb-4 transform -rotate-1">
                            PRESUPUESTO
                        </label>
                        <select name="presupuesto"
                                class="w-full p-6 text-2xl font-bold text-blue-900 input-brutal transform -skew-x-1 hover:skew-x-0">
                            <option value="">¿Cuál es tu presupuesto?</option>
                            <option value="menos_5k">Menos de 5.000€</option>
                            <option value="5k_15k">5.000€ - 15.000€</option>
                            <option value="15k_30k">15.000€ - 30.000€</option>
                            <option value="mas_30k">Más de 30.000€</option>
                            <option value="no_definido">Aún no está definido</option>
                        </select>
                    </div>

                    <!-- Mensaje -->
                    <div class="transform -rotate-1 hover:rotate-0 transition-all">
                        <label class="block text-3xl font-black text-blue-900 mb-4 transform rotate-2">
                            CUÉNTANOS TU PROYECTO *
                        </label>
                        <textarea name="mensaje" rows="8" required
                                  class="w-full p-6 text-2xl font-bold text-blue-900 input-brutal transform skew-x-1 hover:skew-x-0 resize-none"
                                  placeholder="Describe tu proyecto, objetivos, ideas... ¡Todo lo que consideres importante!"></textarea>
                    </div>

                    <!-- Botón Submit BRUTAL -->
                    <div class="text-center pt-8">
                        <button type="submit" 
                                class="bg-blue-900 text-white px-20 py-8 text-4xl font-black transform -rotate-3 hover:rotate-0 hover:scale-110 transition-all duration-300 shadow-2xl hover:shadow-blue-500/50 glitch animate-pulse-brutal">
                            ENVIAR PROYECTO!
                        </button>
                        
                        <p class="text-blue-600 font-black text-xl mt-8 transform rotate-1">
                            Respuesta garantizada en menos de 24h
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Elementos decorativos -->
        <div class="absolute bottom-16 left-16 text-huge font-black text-blue-100 transform rotate-45 animate-spin-slow">
            SEND
        </div>
        
        <div class="absolute top-48 left-8 text-giant font-black text-blue-50 transform -rotate-90 opacity-30">
            24H
        </div>
    </section>

    <!-- Información de Contacto -->
    <section class="py-32 bg-blue-900 relative overflow-hidden">
        <div class="absolute -top-32 -right-32 text-brutal font-black text-blue-800 opacity-10 transform rotate-45">
            INFO
        </div>
        
        <div class="container mx-auto px-8 text-center relative z-10">
            <h2 class="text-6xl font-black text-white mb-16 transform -rotate-2 brutal-shadow">
                OTRAS FORMAS DE CONTACTO
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="transform rotate-2 hover:rotate-0 transition-all">
                    <div class="bg-white p-12 shadow-2xl">
                        <h3 class="text-4xl font-black text-blue-900 mb-4">EMAIL</h3>
                        <p class="text-2xl text-blue-700 font-bold">hola@bycolor.es</p>
                    </div>
                </div>
                
                <div class="transform -rotate-1 hover:rotate-0 transition-all">
                    <div class="bg-blue-100 p-12 shadow-2xl border-4 border-blue-900">
                        <h3 class="text-4xl font-black text-blue-900 mb-4">TELÉFONO</h3>
                        <p class="text-2xl text-blue-700 font-bold">+34 XXX XXX XXX</p>
                    </div>
                </div>
                
                <div class="transform rotate-1 hover:rotate-0 transition-all">
                    <div class="bg-white p-12 shadow-2xl">
                        <h3 class="text-4xl font-black text-blue-900 mb-4">HORARIO</h3>
                        <p class="text-xl text-blue-700 font-bold">Lun-Vie: 9:00-18:00</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white py-16 text-center">
        <div class="text-blue-900 font-black text-4xl transform rotate-1 mb-4 glitch">
            bycolor.es
        </div>
        <div class="text-blue-600 font-light text-lg">
            Tu proyecto nos espera
        </div>
    </footer>
</body>
</html>
