<x-app-layout>
    <div class="flex flex-col flex-1">
        <x-main-banner/>

        <div class="relative flex-1">
            {{-- Background image --}}
            <img
                src="{{ asset('images/portadas/portada_shared_sm.jpg') }}"
                alt=""
                class="absolute inset-0 w-full h-full object-cover"
            >
            {{-- White overlay --}}
            <div class="absolute inset-0 bg-white mx-4 lg:mx-8 mb-4 lg:mb-8"></div>

            <div class="relative px-6 md:px-8 lg:px-16 pb-16 lg:pb-24 pt-8 mx-auto" style="max-width: min(84rem, calc(100vw - 2rem));">

                {{-- Encabezado --}}
                <div class="flex flex-col items-center text-center">
                    <img
                        src="{{ asset('images/logos/medpharma-logo.jpg') }}"
                        alt="Medpharma"
                        class="w-44 md:w-60 lg:w-60 h-auto object-contain"
                    >

                    <h1 class="text-6xl md:text-9xl font-brandan uppercase text-dark">
                        Premios
                    </h1>

                    <p class="mt-4 sm:mt-3 text-4xl md:text-5xl font-brandan font-black uppercase text-green-600">
                        Quiniela Mundialista
                    </p>

                    @if(!empty($pais))
                        <p class="mt-4 sm:mt-6 text-3xl md:text-5xl lg:text-5xl font-brandan font-bold uppercase tracking-[0.6rem] lg:tracking-[1rem] text-zinc-400">
                            {{ $pais }}
                        </p>
                    @endif
                </div>

                {{-- Lista de premios alternados --}}
                <div class="flex flex-col gap-2 mt-10 lg:mt-16">
                    @foreach($premios as $index => $premio)
                        @php
                            $isEven = $index % 2 === 1;
                        @endphp

                        <div class="flex flex-col {{ $isEven ? 'md:flex-row' : 'md:flex-row-reverse' }} items-center gap-6 lg:gap-12">
                            {{-- Texto --}}
                            <div class="flex-1 text-center md:text-left mt-8 lg:mt-16">
                                <p class="text-5xl sm:text-6xl lg:text-7xl font-brandan text-[#95c908] mb-4">
                                    {{ $premio->titulo_posicion }}
                                </p>
                                <h2 class="text-5xl sm:text-6xl lg:text-7xl text-zinc-500 font-brandan leading-tight">
                                    {{ $premio->nombre }}
                                </h2>
                            </div>

                            {{-- Imagen --}}
                            <div class="flex-1 flex {{ $isEven ? 'justify-end' : 'justify-start' }} justify-center">
                                <img
                                    src="{{ asset($premio->imagen) }}"
                                    alt="{{ $premio->nombre }}"
                                    class="max-w-xs sm:max-w-sm lg:max-w-lg xl:max-w-xl w-full h-auto object-contain"
                                >
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
