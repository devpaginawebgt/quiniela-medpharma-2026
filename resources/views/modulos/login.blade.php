<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Quiniela') }} - Iniciar Sesión</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-light antialiased bg-dark">
        {{-- Full screen background --}}
        <div class="relative min-h-screen w-full">
            {{-- Background: main-bg hasta lg, bg-main-web desde lg --}}
            <div class="absolute inset-0 bg-cover bg-top-center lg:hidden"
                 style="background-image: url({{ asset('images/portadas/banner-auth-sm.jpg') }});"></div>
            <div class="absolute inset-0 bg-cover bg-top-right hidden lg:block"
                 style="background-image: url({{ asset('images/portadas/banner-auth.jpg') }});"></div>
            {{-- Overlay oscuro --}}
            <div class="absolute inset-0 bg-black/0"></div>

            {{-- Mobile: bottom drawer / lg+: right drawer --}}
            <div
                class="
                    relative z-10 min-h-screen flex flex-col justify-end items-center
                    lg:flex-row lg:justify-start lg:items-stretch
                "
            >
                {{-- Drawer panel --}}
                <div
                    class="
                        w-full rounded-t-3xl bg-light p-8
                        lg:rounded-none lg:max-w-lg 2xl:max-w-xl lg:w-full lg:min-h-screen lg:flex lg:flex-col lg:justify-center lg:shadow-2xl shadow-black
                    "
                >
                    {{-- Logo --}}
                    <div class="mb-4 lg:mb-0">
                        <img
                            src="/images/logos/medpharma-logo.jpg"
                            class="w-full max-w-84 lg:max-w-52 mx-auto hidden lg:flex"
                            alt="{{ config('app.name', 'Quiniela') }}"
                        >
                    </div>

                    <div class="hidden lg:flex flex-col items-center justify-center text-dark font-brandan uppercase -mt-2 mb-12">
                        <span class="text-8xl text-[#9cc600]">Quiniela</span>
                        <span class="text-6xl text-[#004c3f]">mundialista</span>
                    </div>

                    {{-- Session Status --}}
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    {{-- Toast Errors --}}
                    <x-toast-errors :errors="$errors" />

                    <h1 class="text-3xl lg:hidden text-dark text-center mb-6 font-brandan uppercase">Inicia sesión</h1>

                    {{-- Login Form --}}
                    <form
                        id="login-form"
                        method="POST"
                        action="{{ route('login') }}"
                        class="formulario-auth w-full max-w-108 lg:max-w-108 mx-auto"
                    >
                        @csrf

                        <div class="mb-4">
                            <x-auth-input
                                name="email"
                                type="email"
                                icon="icon-[fluent--mail-24-filled]"
                                placeholder="Correo electrónico"
                                required
                                autofocus
                            />
                        </div>

                        <div class="mb-2">
                            <x-auth-password-input
                                id="login-password"
                                name="password"
                                icon="icon-[fluent--password-32-filled]"
                                placeholder="Contraseña"
                                minlength="4"
                                maxlength="50"
                                required
                            />
                        </div>

                        <button
                            id="login-submit"
                            type="submit"
                            class="w-full bg-comp bg-secondary text-light font-bold rounded-lg px-6 py-3 hover:brightness-110 focus:ring-4 focus:ring-secondary/50 flex items-center justify-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed disabled:hover:brightness-100"
                        >
                            <span data-submit-icon class="icon-[fluent--arrow-enter-16-filled] w-5 h-5"></span>
                            <span data-submit-label>Ingresar</span>
                        </button>
                    </form>

                    <script>
                        (() => {
                            const form = document.getElementById('login-form');
                            const button = document.getElementById('login-submit');

                            form.addEventListener('submit', () => {
                                button.disabled = true;
                                button.querySelector('[data-submit-icon]').className = 'icon-[fluent--spinner-ios-16-filled] w-5 h-5 animate-spin';
                                button.querySelector('[data-submit-label]').textContent = 'Ingresando...';
                            });
                        })();
                    </script>

                    <div class="flex justify-center mt-6 mb-4">
                        <a href="{{ route('password.request') }}" class="text-sm text-secondary font-bold hover:text-dark">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>

                    {{-- Register link --}}
                    <p class="text-center text-sm">
                        <span class="text-complementary-dark mb-2">¿No tienes cuenta?</span>
                        <a href="{{ route('register') }}" class="text-secondary font-bold hover:text-dark">
                            Regístrate
                        </a>
                    </p>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>
