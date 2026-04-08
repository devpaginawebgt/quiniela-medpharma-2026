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

            {{-- Titulo y posicion del usuario --}}
            <div class="flex flex-col md:flex-row justify-center items-center md:items-start gap-4 lg:gap-8 2xl:gap-12 mx-auto mb-8 lg:mb-12">
                <h1 class="text-center md:text-start text-5xl sm:text-7xl lg:text-8xl uppercase font-brandan">
                    Resultados de quiniela
                </h1>

                <div class="flex flex-col items-center md:items-end shrink-0 my-6 md:my-0">
                    <span class="text-4xl font-brandan text-zinc-400 uppercase">
                        Mi posici&oacute;n
                    </span>
                    <span class="text-8xl lg:text-9xl font-black leading-none my-2 md:my-0">
                        {{ $user_rank ?? '-' }}
                    </span>
                    <a href="{{ route('web.users.ranking-general') }}" class="text-3xl font-brandan text-fuchsia-800">
                        Ver mi posici&oacute;n
                    </a>
                </div>
            </div>

            {{-- Subtitulo --}}
            <h2 class="text-2xl sm:text-3xl lg:text-4xl uppercase font-brandan mb-2 mx-auto">
                Top 10 Quiniela
            </h2>

            {{-- Tabla de ranking --}}
            <div class="mx-auto rounded-t-3xl overflow-x-auto">
                <table class="w-full text-left text-dark">
                    <thead class="uppercase bg-dark text-light">
                        <tr class="font-optimprov text-sm sm:text-lg lg:text-2xl">
                            <th scope="col" class="px-4 py-3 text-center font-bold">Posici&oacute;n</th>
                            <th scope="col" class="px-4 py-3 font-bold">Nombre</th>
                            <th scope="col" class="px-4 py-3 text-center font-bold">Puntos</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($top10 as $participante)
                        <tr class="border-b border-zinc-300 text-lg sm:text-2xl lg:text-3xl font-brandan">
                            <td class="px-4 py-3 lg:py-4 text-center">{{ $participante->posicion }}</td>
                            <td class="px-4 py-3 lg:py-4 uppercase whitespace-nowrap">{{ $participante->nombres }} {{ $participante->apellidos }}</td>
                            <td class="px-4 py-3 lg:py-4 text-center">{{ $participante->puntos }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-zinc-400 py-20 text-lg sm:text-xl lg:text-2xl font-brandan uppercase">
                                No hay participantes para mostrar
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            </div>
        </div>
    </div>
</x-app-layout>
