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

            <div class="relative px-6 md:px-8 lg:px-12 pb-16 pt-8 mx-auto" style="max-width: min(84rem, calc(100vw - 2rem));">

                <h1 class="text-center md:text-start text-5xl sm:text-7xl lg:text-8xl uppercase font-brandan max-w-[12ch]">
                    Premios Ganadores
                </h1>

                {{-- Lista de premios alternados --}}
                <div class="flex flex-col gap-12 lg:gap-16 mt-10 lg:mt-16">
                    @foreach($premios as $index => $premio)
                        @php
                            $isEven = $index % 2 === 0;
                        @endphp

                        <div class="flex flex-col {{ $isEven ? 'md:flex-row' : 'md:flex-row-reverse' }} items-start gap-6 lg:gap-12">
                            {{-- Texto --}}
                            <div class="flex-1 {{ $isEven ? 'md:text-left' : 'md:text-right' }} text-center mt-16">
                                <p class="text-3xl sm:text-4xl lg:text-5xl font-brandan uppercase text-[#95c908]">
                                    {{ $premio->titulo_posicion }}
                                </p>
                                <h2 class="text-5xl sm:text-7xl lg:text-8xl font-brandan uppercase leading-tight">
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
