<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Quiniela') }} - Registro</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/js/app.js', 'resources/js/views/register.js'])
    </head>
    <body class="font-sans text-light antialiased bg-dark">
        {{-- Full screen background --}}
        <div class="relative min-h-screen w-full">
            {{-- Background --}}
            {{-- <div class="absolute inset-0 bg-cover bg-center lg:hidden"
                 style="background-image: url({{ asset('images/portadas/portada-auth.jpg') }});"></div>
            <div class="absolute inset-0 bg-cover bg-center hidden lg:block"
                 style="background-image: url({{ asset('images/portadas/portada-auth.jpg') }});"></div> --}}
            {{-- Overlay --}}
            {{-- <div class="absolute inset-0 bg-black/0"></div> --}}

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
                        w-full max-h-screen sm:rounded-t-3xl bg-light p-8 flex flex-col
                        lg:rounded-none lg:max-w-lg 2xl:max-w-xl lg:w-full lg:shadow-2xl shadow-black
                    "
                >
                    <div class="overflow-y-auto my-auto">
                        {{-- Logo --}}
                        <div class="mb-4">
                            <img
                                src="/images/logos/medpharma-logo.jpg"
                                class="w-full max-w-82 mx-auto"
                                alt="{{ config('app.name', 'Quiniela') }}"
                            >
                        </div>
    
                        {{-- Title --}}
                        <h1 class="text-2xl text-center font-bold text-complementary-dark mb-4">Crear cuenta</h1>
    
                        {{-- Toast Errors --}}
                        <x-toast-errors :errors="$errors" />
    
                        {{-- Register Form --}}
                        <form
                            method="POST"
                            action="{{ route('register') }}"
                            class="w-full max-w-108 mx-auto space-y-3"
                        >
                            @csrf
    
                            <input type="hidden" name="accepted_terms" value="{{ old('accepted_terms', '') }}">
    
                            {{-- Nombres --}}
                            <x-auth-input
                                name="nombres"
                                icon="icon-[fluent--person-24-filled]"
                                placeholder="Nombres"
                                minlength="2"
                                maxlength="60"
                                required
                                autofocus
                            />
    
                            {{-- Apellidos --}}
                            <x-auth-input
                                name="apellidos"
                                icon="icon-[fluent--person-24-filled]"
                                placeholder="Apellidos"
                                minlength="2"
                                maxlength="60"
                                required
                            />
    
                            {{-- Numero de Documento de Identidad --}}
                            @php
                                $regex    = $country->document_regex;
                                $message  = $country->document_regex_message;
                                $document = $country->document_name;
                            @endphp

                            <x-auth-input
                                name="numero_documento"
                                icon="icon-[fluent--contact-card-16-filled]"
                                placeholder="Numero de {{ $document }}"
                                pattern="{{ $regex }}"
                                message="{{ $message }}"
                                required
                            />
    
                            {{-- Numero de Telefono --}}
                            <x-auth-input
                                name="telefono"
                                icon="icon-[fluent--call-24-filled]"
                                placeholder="Numero de Telefono"
                                required
                                minlength="8"
                                maxlength="8"
                            />
    
                            {{-- Email --}}
                            <x-auth-input
                                name="email"
                                type="email"
                                icon="icon-[fluent--mail-24-filled]"
                                placeholder="Email"
                                minlength="5"
                                maxlength="255"
                                required
                            />
    
                            {{-- Codigo de registro --}}
                            <x-auth-input
                                name="codigo"
                                icon="icon-[fluent--text-number-format-20-filled]"
                                placeholder="Codigo de registro"
                                minlength="7"
                                maxlength="7"
                                required
                            />
    
                            {{-- Pais (detectado por IP) --}}
                            <input type="hidden" name="pais_id" value="{{ $country->id }}">
                            <div class="flex items-center gap-3 py-3 px-4 bg-transparent border-2 rounded-lg border-secondary text-dark text-base cursor-default">
                                <img src="{{ asset($country->image) }}" alt="{{ $country->name }}" class="w-6 aspect-6/4 rounded-sm object-cover shadow-sm">
                                <span>{{ $country->name }}</span>
                            </div>
    
                            {{-- Contraseña --}}
                            <x-auth-password-input
                                id="password"
                                name="password"
                                icon="icon-[fluent--password-24-filled]"
                                placeholder="Contraseña"
                                required
                            />
    
                            {{-- Confirmar Contraseña --}}
                            <x-auth-password-input
                                id="password_confirmation"
                                name="password_confirmation"
                                icon="icon-[fluent--password-24-filled]"
                                placeholder="Confirmar Contraseña"  
                                required
                            />
    
                            {{-- Actions --}}
                            <div class="w-full flex items-center justify-between gap-4 pt-2">
                                <button
                                    type="submit"
                                    class="bg-secondary text-light font-bold rounded-lg px-6 py-3 hover:brightness-110 focus:ring-4 focus:ring-secondary/50 flex items-center justify-center gap-2 w-full"
                                >
                                    <span class="icon-[fluent--person-16-filled] w-5 h-5"></span>
                                    Registrarme
                                </button>
                            </div>
    
                            {{-- Login link --}}
                            <p class="text-center mt-8 text-sm">
                                <span class="text-complementary-dark mb-2">¿Ya estás registrado?</span>
                                <a href="{{ route('ingresa') }}" class="text-secondary font-bold hover:text-dark">
                                    Inicia sesión
                                </a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Terms & Conditions Modal --}}
        <x-terms-modal />
    </body>
</html>
