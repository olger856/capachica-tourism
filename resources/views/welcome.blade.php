<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Turismo en Capachica - Península Mágica del Titicaca</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .hero-bg {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #06b6d4 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-bg::before {
    pointer-events: none;
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="waves" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M0,50 Q25,30 50,50 T100,50 V100 H0 Z" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23waves)"/></svg>');
            animation: wave 20s linear infinite;
        }

        @keyframes wave {
            0% { transform: translateX(-100px); }
            100% { transform: translateX(100px); }
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .gradient-text {
            background: linear-gradient(45deg, #3b82f6, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .pulse-slow {
            animation: pulse 3s infinite;
        }

        .image-overlay {
            position: relative;
            overflow: hidden;
        }

        .image-overlay::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(59, 130, 246, 0.8), rgba(6, 182, 212, 0.8));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .image-overlay:hover::after {
            opacity: 1;
        }

        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Header -->
    <header class="hero-bg text-white py-12 relative z-10">
        <div class="container mx-auto px-4">
            <nav class="flex justify-between items-center mb-12">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">Capachica Explorer</h1>
                        <p class="text-sm opacity-90">Tu ventana al Titicaca</p>
                    </div>
                </div>

                <div class="hidden md:flex items-center space-x-6">
                    <a href="#" class="hover:text-blue-200 transition duration-300">Inicio</a>
                    <a href="#destinos" class="hover:text-blue-200 transition duration-300">Destinos</a>
                    <a href="#experiencias" class="hover:text-blue-200 transition duration-300">Experiencias</a>
                    <a href="#contacto" class="hover:text-blue-200 transition duration-300">Contacto</a>

                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-white text-blue-800 px-4 py-2 rounded-full font-medium hover:bg-blue-100 transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-white text-blue-800 px-4 py-2 rounded-full font-medium hover:bg-blue-100 transition">
                                Iniciar sesión
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-2 bg-white text-blue-800 px-4 py-2 rounded-full font-medium hover:bg-blue-100 transition">
                                    Registrarse
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </nav>

            <div class="text-center relative z-10">
                <h2 class="text-5xl md:text-7xl font-bold mb-6 floating">
                    Descubre <span class="gradient-text">Capachica</span>
                </h2>
                <p class="text-xl md:text-2xl mb-8 opacity-90 max-w-3xl mx-auto">
                    Sumérgete en la magia de la península más hermosa del Lago Titicaca, donde cada amanecer es una obra de arte y cada experiencia es única.
                </p>
                <button class="bg-white text-blue-900 px-8 py-4 rounded-full font-semibold text-lg hover:bg-blue-50 transform hover:scale-105 transition duration-300 pulse-slow">
                    Comenzar Aventura
                </button>
            </div>
        </div>
    </header>


    <!-- Lugares Turísticos -->
    <section id="destinos" class="py-20 bg-gradient-to-br from-blue-50 to-cyan-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    <span class="gradient-text">Destinos Imperdibles</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Cada rincón de Capachica cuenta una historia. Descubre paisajes que te quitarán el aliento y experiencias que marcarán tu alma.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Playa de Ccotos -->
                <div class="card-hover bg-white rounded-3xl overflow-hidden shadow-lg">
                    <div class="image-overlay h-64 bg-gradient-to-br from-blue-400 to-cyan-500 flex items-center justify-center">
                        <div class="text-center text-white">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <h3 class="text-2xl font-bold">Playa de Ccotos</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3 text-gray-800">Playa de Ccotos</h3>
                        <p class="text-gray-600 mb-4">
                            Arena dorada que se encuentra con las aguas cristalinas del Titicaca. Un refugio de tranquilidad donde el tiempo se detiene y la naturaleza susurra secretos milenarios.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Playa</span>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Relajación</span>
                            </div>
                            <button class="text-blue-600 hover:text-blue-800 font-semibold">Explorar →</button>
                        </div>
                    </div>
                </div>

                <!-- Mirador de Llachón -->
                <div class="card-hover bg-white rounded-3xl overflow-hidden shadow-lg">
                    <div class="image-overlay h-64 bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center">
                        <div class="text-center text-white">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z" clip-rule="evenodd"/>
                            </svg>
                            <h3 class="text-2xl font-bold">Mirador de Llachón</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3 text-gray-800">Mirador de Llachón</h3>
                        <p class="text-gray-600 mb-4">
                            Desde las alturas contempla la inmensidad del Titicaca en su máximo esplendor. Un punto de vista privilegiado donde el cielo se funde con el agua en un abrazo eterno.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">Mirador</span>
                                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm">Fotografía</span>
                            </div>
                            <button class="text-blue-600 hover:text-blue-800 font-semibold">Explorar →</button>
                        </div>
                    </div>
                </div>

                <!-- Isla Taquile -->
                <div class="card-hover bg-white rounded-3xl overflow-hidden shadow-lg">
                    <div class="image-overlay h-64 bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center">
                        <div class="text-center text-white">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2h8a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 1a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100-2h.01a1 1 0 000 2H7zm3-2a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                            </svg>
                            <h3 class="text-2xl font-bold">Isla Taquile</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3 text-gray-800">Isla Taquile</h3>
                        <p class="text-gray-600 mb-4">
                            Patrimonio cultural vivo donde las tradiciones ancestrales se entrelazan con la modernidad. Conoce el arte del tejido que ha conquistado corazones en todo el mundo.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Cultura</span>
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">Artesanía</span>
                            </div>
                            <button class="text-blue-600 hover:text-blue-800 font-semibold">Explorar →</button>
                        </div>
                    </div>
                </div>

                <!-- Nuevos destinos adicionales -->
                <div class="card-hover bg-white rounded-3xl overflow-hidden shadow-lg">
                    <div class="image-overlay h-64 bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center">
                        <div class="text-center text-white">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"/>
                            </svg>
                            <h3 class="text-2xl font-bold">Templo de Pachatata</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3 text-gray-800">Templo de Pachatata</h3>
                        <p class="text-gray-600 mb-4">
                            Santuario sagrado donde la espiritualidad andina cobra vida. Un lugar de peregrinación que conecta el alma con la Pachamama en perfecta armonía.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full text-sm">Espiritual</span>
                                <span class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm">Histórico</span>
                            </div>
                            <button class="text-blue-600 hover:text-blue-800 font-semibold">Explorar →</button>
                        </div>
                    </div>
                </div>

                <div class="card-hover bg-white rounded-3xl overflow-hidden shadow-lg">
                    <div class="image-overlay h-64 bg-gradient-to-br from-teal-400 to-cyan-500 flex items-center justify-center">
                        <div class="text-center text-white">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm1 2a1 1 0 000 2h6a1 1 0 100-2H7zm6 7a1 1 0 011 1v3a1 1 0 11-2 0v-3a1 1 0 011-1zm-3 3a1 1 0 100 2h.01a1 1 0 100-2H10zm-4 1a1 1 0 011-1h.01a1 1 0 110 2H7a1 1 0 01-1-1zm1-4a1 1 0 100 2h.01a1 1 0 100-2H7zm2 1a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zm4-4a1 1 0 100 2h.01a1 1 0 100-2H13zM9 9a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1zM7 8a1 1 0 000 2h.01a1 1 0 000-2H7z" clip-rule="evenodd"/>
                            </svg>
                            <h3 class="text-2xl font-bold">Pueblo de Llachón</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3 text-gray-800">Pueblo de Llachón</h3>
                        <p class="text-gray-600 mb-4">
                            Vive la auténtica experiencia del turismo rural comunitario. Comparte con familias locales y descubre tradiciones que han resistido el paso del tiempo.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Comunidad</span>
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Vivencial</span>
                            </div>
                            <button class="text-blue-600 hover:text-blue-800 font-semibold">Explorar →</button>
                        </div>
                    </div>
                </div>

                <div class="card-hover bg-white rounded-3xl overflow-hidden shadow-lg">
                    <div class="image-overlay h-64 bg-gradient-to-br from-rose-400 to-pink-500 flex items-center justify-center">
                        <div class="text-center text-white">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z" clip-rule="evenodd"/>
                            </svg>
                            <h3 class="text-2xl font-bold">Kayak en el Titicaca</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3 text-gray-800">Kayak en el Titicaca</h3>
                        <p class="text-gray-600 mb-4">
                            Navega por las aguas sagradas del lago más alto del mundo. Una aventura acuática que te conectará con la energía pura de los Andes.
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <span class="bg-cyan-100 text-cyan-800 px-3 py-1 rounded-full text-sm">Aventura</span>
                                <span class="bg-teal-100 text-teal-800 px-3 py-1 rounded-full text-sm">Deporte</span>
                            </div>
                            <button class="text-blue-600 hover:text-blue-800 font-semibold">Explorar →</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Experiencias Section -->
    <section id="experiencias" class="py-20 bg-gradient-to-r from-blue-900 to-purple-900 text-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">Experiencias Únicas</h2>
                <p class="text-xl opacity-90 max-w-3xl mx-auto">
                    Cada momento en Capachica es una oportunidad para crear recuerdos inolvidables
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4 floating">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Astronomía Andina</h3>
                    <p class="opacity-80">Observa las estrellas como nunca antes en el cielo más claro del mundo</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4 floating" style="animation-delay: 1s">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Amanecer Sagrado</h3>
                    <p class="opacity-80">Presencia el primer rayo de sol sobre el Titicaca en ceremonia ancestral</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4 floating" style="animation-delay: 2s">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Gastronomía Local</h3>
                    <p class="opacity-80">Degusta sabores únicos con ingredientes frescos del lago y la tierra</p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4 floating" style="animation-delay: 3s">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Música Ancestral</h3>
                    <p class="opacity-80">Escucha melodías que han resonado por siglos en estas tierras sagradas</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-gradient-to-br from-cyan-50 to-blue-100">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">
                ¿Listo para la Aventura?
            </h2>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Capachica te espera con los brazos abiertos. Cada día es una nueva oportunidad para descubrir la magia que solo este lugar puede ofrecerte.
            </p>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-full font-semibold text-lg transform hover:scale-105 transition duration-300">
                    Planificar Viaje
                </button>
                <button class="border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-8 py-4 rounded-full font-semibold text-lg transform hover:scale-105 transition duration-300">
                    Ver Galería
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4 gradient-text">Capachica Explorer</h3>
                    <p class="text-gray-300 mb-4">
                        Descubre la península más hermosa del Lago Titicaca con experiencias auténticas y memorables.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-400 hover:text-blue-300 transition duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-blue-400 hover:text-blue-300 transition duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-blue-400 hover:text-blue-300 transition duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.1.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.174.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-blue-400 hover:text-blue-300 transition duration-300">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Destinos</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-blue-400 transition duration-300">Playa de Ccotos</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition duration-300">Mirador de Llachón</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition duration-300">Isla Taquile</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition duration-300">Templo de Pachatata</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition duration-300">Pueblo de Llachón</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Experiencias</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-blue-400 transition duration-300">Turismo Vivencial</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition duration-300">Kayak en el Titicaca</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition duration-300">Astronomía Andina</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition duration-300">Gastronomía Local</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition duration-300">Artesanía Textil</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contacto</h4>
                    <div class="space-y-3 text-gray-300">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Península de Capachica, Puno - Perú</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                            </svg>
                            <span>+51 951 234 567</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                            <span>info@capachicaexplorer.com</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 mb-4 md:mb-0">
                        &copy; 2025 Capachica Explorer. Todos los derechos reservados.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300">Política de Privacidad</a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300">Términos de Servicio</a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300">Blog</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Animación suave para el scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Efecto parallax simple
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.hero-bg');
            if (hero) {
                hero.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });

        // Animación de contador para estadísticas (si las agregas)
        function animateCounter(element, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16);
            const timer = setInterval(() => {
                start += increment;
                element.textContent = Math.floor(start);
                if (start >= target) {
                    element.textContent = target;
                    clearInterval(timer);
                }
            }, 16);
        }

        // Efectos de hover mejorados
        document.querySelectorAll('.card-hover').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Loading animation
        window.addEventListener('load', () => {
            document.body.classList.add('loaded');
        });
    </script>

</body>
</html>
