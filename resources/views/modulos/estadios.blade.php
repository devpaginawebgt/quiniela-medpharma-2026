<x-app-layout>
    {{-- <x-carousel-section-banners :banners="$banners" /> --}}

    <div class="pt-16">
        <x-main-banner/>

        <div class="overflow-hidden">
            <div class="px-6 pb-6">

                <h5 class="text-3xl 2xl:text-4xl text-center font-bold mt-8 mb-4">Estadios de la Copa Mundial</h5>

                <div class="w-full max-w-lg mx-auto mb-6">
                    <x-search-input id="buscar-estadios" name="buscar_estadios" placeholder="Buscar Estadios" />
                </div>

                <div id="estadios-grid" class="grid grid-cols-1 md:grid-cols-2 2xl:gap-12 max-w-6xl mx-auto gap-4 lg:gap-8 items-start">
                    @foreach($estadios as $estadio)
                        <x-estadio-card :estadio="$estadio" />
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Estadio --}}
    <x-estadio-modal />

</x-app-layout>
