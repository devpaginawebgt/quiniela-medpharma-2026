<x-app-layout>
    <div>
        <x-main-banner/>

        <section class="w-full relative lg:aspect-4/6 flex bg-[#a8c938]">
            {{-- Imagenes de fondo --}}
            {{-- <div class="absolute inset-0 bg-cover bg-center z-0 lg:hidden"
                 style="background-image: url({{ asset('/images/portadas/portada-selecciones.jpg') }});"></div> --}}
            <div class="absolute inset-0 bg-cover bg-center z-0 hidden lg:block"
                 style="background-image: url({{ asset('/images/portadas/portada-selecciones.jpg') }});"></div>

            {{-- Contenido --}}
            <div
                class="z-10 flex flex-wrap items-start justify-center lg:justify-start
                    gap-4 sm:gap-6 lg:gap-5 2xl:gap-8
                    px-4 lg:pr-0 lg:pl-16
                    lg:max-w-2xl
                    mt-[27%] sm:mt-24 mb-8 lg:mt-[25%] lg:mb-0 xl:max-w-3xl
                    2xl:ps-20 2xl:mt-108">
                @foreach($equipos as $equipo)
                    <x-team-card :equipo="$equipo" />
                @endforeach
            </div>
        </section>
    </div>

    {{-- Modal / Drawer Selección --}}
    <x-team-modal />

</x-app-layout>
