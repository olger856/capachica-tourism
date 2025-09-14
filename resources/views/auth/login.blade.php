<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Capachica</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 50%, #ec4899 100%);
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
            background: radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 40% 40%, rgba(120, 119, 198, 0.2) 0%, transparent 50%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 20s infinite ease-in-out;
        }

        .floating-element:nth-child(1) {
            width: 120px;
            height: 120px;
            top: 10%;
            left: 15%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 80px;
            height: 80px;
            top: 70%;
            left: 75%;
            animation-delay: 7s;
        }

        .floating-element:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 50%;
            left: 85%;
            animation-delay: 14s;
        }

        .floating-element:nth-child(4) {
            width: 40px;
            height: 40px;
            top: 25%;
            left: 70%;
            animation-delay: 3s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) translateX(0px) rotate(0deg);
                opacity: 0.5;
            }
            25% {
                transform: translateY(-20px) translateX(10px) rotate(90deg);
                opacity: 0.8;
            }
            50% {
                transform: translateY(-40px) translateX(-10px) rotate(180deg);
                opacity: 0.3;
            }
            75% {
                transform: translateY(-20px) translateX(-20px) rotate(270deg);
                opacity: 0.6;
            }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        }

        .input-container {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-field {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .input-field:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 1);
        }

        .input-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            transition: color 0.3s ease;
        }

        .input-field:focus + .input-icon {
            color: #8b5cf6;
        }

        .floating-label {
            position: absolute;
            left: 3rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1rem;
            transition: all 0.3s ease;
            pointer-events: none;
            background: rgba(255, 255, 255, 0.9);
            padding: 0 0.25rem;
        }

        .input-field:focus ~ .floating-label,
        .input-field:not(:placeholder-shown) ~ .floating-label {
            top: 0;
            left: 0.75rem;
            font-size: 0.75rem;
            color: #8b5cf6;
            font-weight: 500;
        }

        .btn-primary {
            background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
            padding: 1rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(139, 92, 246, 0.3);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(139, 92, 246, 0.4);
        }

        .checkbox-custom {
            appearance: none;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #d1d5db;
            border-radius: 0.25rem;
            position: relative;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .checkbox-custom:checked {
            background: linear-gradient(135deg, #8b5cf6, #ec4899);
            border-color: #8b5cf6;
        }

        .checkbox-custom:checked::after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 0.875rem;
            font-weight: bold;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .fade-in {
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .slide-left {
            animation: slideLeft 1.2s ease-out;
        }

        @keyframes slideLeft {
            from { opacity: 0; transform: translateX(-100px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .slide-right {
            animation: slideRight 1.2s ease-out 0.3s both;
        }

        @keyframes slideRight {
            from { opacity: 0; transform: translateX(100px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .welcome-icon {
            width: 4rem;
            height: 4rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            animation: iconPulse 2s ease-in-out infinite;
        }

        @keyframes iconPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .feature-list {
            margin-top: 2rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            opacity: 0;
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .feature-item:nth-child(1) { animation-delay: 1s; }
        .feature-item:nth-child(2) { animation-delay: 1.2s; }
        .feature-item:nth-child(3) { animation-delay: 1.4s; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .link-hover {
            position: relative;
            transition: color 0.3s ease;
        }

        .link-hover::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(90deg, #8b5cf6, #ec4899);
            transition: width 0.3s ease;
        }

        .link-hover:hover::after {
            width: 100%;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-purple-50 via-blue-50 to-pink-50 min-h-screen">

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-5xl glass-card rounded-3xl flex flex-col lg:flex-row overflow-hidden fade-in">

            <!-- Panel izquierdo -->
            <div class="lg:w-1/2 gradient-bg p-12 text-white flex flex-col justify-center relative slide-left">
                <div class="floating-elements">
                    <div class="floating-element"></div>
                    <div class="floating-element"></div>
                    <div class="floating-element"></div>
                    <div class="floating-element"></div>
                </div>

                <div class="relative z-10">
                    <div class="welcome-icon">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>

                    <h2 class="text-4xl font-bold mb-4 leading-tight">
                        ¡Bienvenido de nuevo!
                    </h2>
                    <p class="text-lg opacity-90 leading-relaxed mb-6">
                        Nos alegra verte otra vez. Continúa tu increíble experiencia en Capachica.
                    </p>

                    <div class="feature-list">
                        <div class="feature-item">
                            <div class="w-3 h-3 bg-yellow-300 rounded-full mr-3 flex-shrink-0"></div>
                            <span class="text-sm opacity-85">Acceso instantáneo a tu perfil</span>
                        </div>
                        <div class="feature-item">
                            <div class="w-3 h-3 bg-yellow-300 rounded-full mr-3 flex-shrink-0"></div>
                            <span class="text-sm opacity-85">Experiencias personalizadas</span>
                        </div>
                        <div class="feature-item">
                            <div class="w-3 h-3 bg-yellow-300 rounded-full mr-3 flex-shrink-0"></div>
                            <span class="text-sm opacity-85">Continúa donde lo dejaste</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario -->
            <div class="lg:w-1/2 w-full p-12 slide-right">
                <div class="max-w-md mx-auto">
                    <div class="text-center mb-10">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Inicia sesión</h2>
                        <p class="text-gray-600">Ingresa tus credenciales para continuar</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <div class="input-container">
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus placeholder=" "
                                class="input-field" />
                            <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                            <label for="email" class="floating-label">Correo electrónico</label>
                            @error('email')<span class="text-sm text-red-500 mt-2 block">{{ $message }}</span>@enderror
                        </div>

                        <div class="input-container">
                            <input id="password" name="password" type="password" required placeholder=" "
                                class="input-field" />
                            <svg class="input-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <label for="password" class="floating-label">Contraseña</label>
                            @error('password')<span class="text-sm text-red-500 mt-2 block">{{ $message }}</span>@enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center space-x-3 text-sm text-gray-600 cursor-pointer">
                                <input type="checkbox" name="remember" class="checkbox-custom">
                                <span>Recuérdame</span>
                            </label>
                            <a href="{{ route('password.request') }}" class="text-sm text-purple-600 hover:text-purple-800 link-hover font-medium">¿Olvidaste tu contraseña?</a>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="btn-primary w-full text-white font-semibold text-lg">
                                Iniciar sesión
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-8">
                        <p class="text-gray-600">
                            ¿No tienes una cuenta?
                            <a href="{{ route('register') }}" class="text-purple-600 hover:text-purple-800 font-semibold link-hover ml-1">Regístrate aquí</a>
                        </p>
                    </div>

                    <!-- Divider -->
                    <div class="relative my-8">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">O continúa con</span>
                        </div>
                    </div>

                    <!-- Social Login Options -->
                    <div class="grid grid-cols-2 gap-4">
                        <button class="flex items-center justify-center px-4 py-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Google</span>
                        </button>
                        <button class="flex items-center justify-center px-4 py-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="#1877F2" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-700">Facebook</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
