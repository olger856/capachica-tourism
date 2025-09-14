<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Capachica</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .gradient-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="30" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }

        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .floating-shapes::before,
        .floating-shapes::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .floating-shapes::before {
            width: 100px;
            height: 100px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-shapes::after {
            width: 60px;
            height: 60px;
            bottom: 20%;
            right: 10%;
            animation-delay: 3s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .input-group {
            position: relative;
        }

        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label {
            transform: translateY(-1.5rem) scale(0.8);
            color: #667eea;
        }

        .floating-label {
            position: absolute;
            left: 1rem;
            top: 0.75rem;
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
            pointer-events: none;
            background: white;
            padding: 0 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .card-enter {
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .checkbox-custom {
            appearance: none;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #d1d5db;
            border-radius: 0.375rem;
            position: relative;
            transition: all 0.3s ease;
        }

        .checkbox-custom:checked {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
        }

        .checkbox-custom:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 0.875rem;
            font-weight: bold;
        }

        .pulse-ring {
            animation: pulse-ring 2s infinite;
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(0.33);
                opacity: 1;
            }
            80%, 100% {
                transform: scale(1);
                opacity: 0;
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Background Pattern -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(139, 92, 246, 0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg> </div>
    </div>

    <div class="relative z-10 min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-5xl">
            <div class="glass-effect rounded-3xl shadow-2xl overflow-hidden card-enter">
                <div class="flex flex-col lg:flex-row">

                    <!-- Panel izquierdo -->
                    <div class="lg:w-2/5 gradient-bg p-8 lg:p-12 text-white relative">
                        <div class="floating-shapes"></div>
                        <div class="relative z-10">
                            <div class="mb-8">
                                <div class="w-16 h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center mb-6">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h1 class="text-4xl lg:text-5xl font-bold mb-4 leading-tight">
                                    ¡Bienvenido a
                                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-white to-purple-200">
                                        Capachica!
                                    </span>
                                </h1>
                                <p class="text-lg opacity-90 leading-relaxed">
                                    Únete a nuestra comunidad y descubre experiencias únicas que transformarán tu manera de explorar el mundo.
                                </p>
                            </div>

                            <!-- Stats -->
                            <div class="grid grid-cols-3 gap-4 mt-8">
                                <div class="text-center">
                                    <div class="text-2xl font-bold">10K+</div>
                                    <div class="text-sm opacity-80">Usuarios</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold">500+</div>
                                    <div class="text-sm opacity-80">Destinos</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold">4.9★</div>
                                    <div class="text-sm opacity-80">Rating</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario -->
                    <div class="lg:w-3/5 p-8 lg:p-12">
                        <div class="max-w-md mx-auto">
                            <div class="text-center mb-8">
                                <h2 class="text-3xl font-bold text-gray-800 mb-2">Crear cuenta</h2>
                                <p class="text-gray-600">Completa el formulario para comenzar tu aventura</p>
                            </div>

                            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                                @csrf

                                <!-- Nombre -->
                                <div class="input-group">
                                    <input
                                        id="name"
                                        name="name"
                                        type="text"
                                        value="{{ old('name') }}"
                                        placeholder=" "
                                        required
                                        autofocus
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:outline-none transition-all duration-300 bg-white/80 backdrop-blur-sm"
                                    />
                                    <label for="name" class="floating-label">Nombre completo</label>
                                    @error('name')
                                        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="input-group">
                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        value="{{ old('email') }}"
                                        placeholder=" "
                                        required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:outline-none transition-all duration-300 bg-white/80 backdrop-blur-sm"
                                    />
                                    <label for="email" class="floating-label">Correo electrónico</label>
                                    @error('email')
                                        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Contraseña -->
                                <div class="input-group">
                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        placeholder=" "
                                        required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:outline-none transition-all duration-300 bg-white/80 backdrop-blur-sm"
                                    />
                                    <label for="password" class="floating-label">Contraseña</label>
                                    <div class="text-xs text-gray-500 mt-1 flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                        Mínimo 8 caracteres
                                    </div>
                                    @error('password')
                                        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Confirmar contraseña -->
                                <div class="input-group">
                                    <input
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        type="password"
                                        placeholder=" "
                                        required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:outline-none transition-all duration-300 bg-white/80 backdrop-blur-sm"
                                    />
                                    <label for="password_confirmation" class="floating-label">Confirmar contraseña</label>
                                    @error('password_confirmation')
                                        <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Términos y condiciones -->
                                <div class="flex items-start space-x-3">
                                    <input
                                        id="terms"
                                        name="terms"
                                        type="checkbox"
                                        required
                                        class="checkbox-custom mt-1"
                                    />
                                    <label for="terms" class="text-sm text-gray-600 leading-relaxed">
                                        Acepto los
                                        <a href="#" class="text-purple-600 hover:text-purple-800 hover:underline font-medium">Términos y Condiciones</a>
                                        y la
                                        <a href="#" class="text-purple-600 hover:text-purple-800 hover:underline font-medium">Política de Privacidad</a>
                                    </label>
                                </div>

                                <!-- Botón de registro -->
                                <div class="pt-4">
                                    <button
                                        type="submit"
                                        class="btn-primary w-full py-4 px-6 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 text-lg"
                                    >
                                        Crear mi cuenta
                                    </button>
                                </div>
                            </form>

                            <!-- Login link -->
                            <div class="text-center mt-8 pt-6 border-t border-gray-200">
                                <p class="text-gray-600">
                                    ¿Ya tienes una cuenta?
                                    <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-800 font-semibold hover:underline transition-colors duration-200">
                                        Inicia sesión aquí
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
