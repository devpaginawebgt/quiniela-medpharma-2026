<x-app-layout>
    <div>
        <x-main-banner/>

        <section class="w-full relative lg:aspect-4/6 flex flex-col bg-[#a8c938] pb-84 lg:pb-6 xl:pb-0">
            {{-- Imagenes de fondo --}}
            <div class="absolute inset-0 bg-cover bg-center z-0 lg:hidden"
                 style="background-image: url({{ asset('/images/portadas/portada_selecciones_sm.jpg') }});"></div>
            <div class="absolute inset-0 bg-cover bg-center z-0 hidden lg:block"
                 style="background-image: url({{ asset('/images/portadas/portada-selecciones.jpg') }});"></div>

            <h1 class="uppercase z-10 text-center mt-10 font-brandan text-4xl sm:text-7xl px-4 lg:hidden">Selecciones Clasificadas</h1>

            {{-- Contenido --}}
            <div
                class="z-20 flex flex-wrap items-start justify-center lg:justify-start
                    gap-4 sm:gap-6 lg:gap-x-8 lg:gap-y-10 
                    px-4 lg:pr-0 lg:pl-16
                    lg:max-w-2xl
                    mt-8 lg:mt-[25%] xl:max-w-3xl
                    2xl:ps-20 2xl:mt-108">

                @foreach($equipos as $equipo)
                    <x-team-card :equipo="$equipo" />
                @endforeach
            </div>

            <div class="w-full max-w-84 aspect-5/6 absolute bottom-0 left-0 right-0 mx-auto bg-cover bg-top z-10 lg:hidden"
                 style="background-image: url({{ asset('/images/portadas/doctores_selecciones_sm.png') }});"></div>
        </section>
    </div>

    {{-- Modal / Drawer Selección --}}
    <x-team-modal />

</x-app-layout>
