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

            </div>
        </div>
    </div>

    {{-- Modal / Drawer Premio --}}
    <x-prize-modal />
</x-app-layout>
