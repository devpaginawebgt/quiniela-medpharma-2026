<x-app-layout>
    <div>
        <x-main-banner/>

        <div class="overflow-hidden sm:rounded-lg">
            <div
                class="px-4 lg:px-12 my-8 lg:my-12 mx-auto"
                style="max-width: min(84rem, calc(100vw - 2rem));"
            >

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
                                @if($premio->descripcion)
                                    <p class="text-lg lg:text-xl text-complementary-dark mt-2">
                                        {{ $premio->descripcion }}
                                    </p>
                                @endif
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

    {{-- Modal / Drawer Premio --}}
    <x-prize-modal />
</x-app-layout>
