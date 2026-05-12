<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Quiniela') }} - Página no encontrada</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-light antialiased bg-dark">
        {{-- Full screen background --}}
        <div class="relative min-h-screen w-full">
            {{-- Background: banner-auth-sm hasta lg, banner-auth desde lg --}}
            <div class="absolute inset-0 bg-cover bg-top-center lg:hidden"
                 style="background-image: url({{ asset('images/portadas/banner-auth-sm.jpg') }});"></div>
            <div class="absolute inset-0 bg-cover bg-top-right hidden lg:block"
                 style="background-image: url({{ asset('images/portadas/banner-auth.jpg') }});"></div>
            {{-- Overlay oscuro --}}
            <div class="absolute inset-0 bg-black/0"></div>

            {{-- Mobile: bottom drawer / lg+: left drawer --}}
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

                    <div class="hidden lg:flex flex-col items-center justify-center text-dark font-brandan uppercase -mt-2 mb-8">
                        <span class="text-8xl text-[#9cc600]">Quiniela</span>
                        <span class="text-6xl text-[#004c3f]">mundialista</span>
                    </div>

                    <div class="w-full max-w-108 mx-auto text-center">
                        <p class="font-brandan text-7xl lg:text-8xl leading-none text-secondary uppercase mb-2">
                            404
                        </p>

                        <h1 class="text-3xl text-dark mb-4 font-brandan uppercase">
                            Página no encontrada
                        </h1>

                        <p class="text-complementary-dark mb-8">
                            La página que buscas no existe o fue movida. Inicia sesión para acceder a la quiniela.
                        </p>

                        <a
                            href="{{ route('ingresa') }}"
                            class="w-full bg-secondary text-light font-bold rounded-lg px-6 py-3 hover:brightness-110 focus:ring-4 focus:ring-secondary/50 flex items-center justify-center gap-2"
                        >
                            <span class="icon-[fluent--arrow-enter-16-filled] w-5 h-5"></span>
                            Iniciar sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
