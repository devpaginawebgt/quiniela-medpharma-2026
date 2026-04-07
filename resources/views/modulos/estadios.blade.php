<x-app-layout>
    <div>
        <x-main-banner/>

        <div class="px-4 lg:px-12 pb-6 overflow-hidden mx-auto" style="max-width: min(84rem, calc(100vw - 2rem));">

            <div class="flex flex-col md:flex-row justify-center items-center md:justify-between md:items-end my-8 lg:my-12 gap-4 lg:gap-8 2xl:gap-12 mx-auto">
                <h1 class="text-center md:text-start text-5xl sm:text-6xl lg:text-8xl uppercase font-brandan">
                    Estadios del mundial
                </h1>

                <div class="w-full max-w-sm md:max-w-56 mb-2">
                    <x-search-input id="buscar-estadios" name="buscar_estadios" placeholder="Buscar Estadios" />
                </div>
            </div>

            <div id="estadios-grid" class="grid grid-cols-1 md:grid-cols-2 mx-auto gap-8 lg:gap-8 2xl:gap-12 items-start">
                @foreach($estadios as $estadio)
                    <x-estadio-card :estadio="$estadio" />
                @endforeach
            </div>

        </div>        
    </div>

    {{-- Modal Estadio --}}
    <x-estadio-modal />

</x-app-layout>
