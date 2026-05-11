<x-app-layout>
    <div class="w-full overflow-hidden flex flex-col flex-1">
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

            <div class="relative px-6 md:px-8 lg:px-12 pb-8 pt-8 mx-auto" style="max-width: min(84rem, calc(100vw - 2rem));">
                <div class="flex flex-col md:flex-row justify-center items-center md:items-end gap-4 lg:gap-8 2xl:gap-12 mx-auto">
                    <h1 class="text-center md:text-start text-4xl sm:text-6xl lg:text-8xl uppercase font-brandan mb-8 lg:mb-12">
                        Grupos conformados
                    </h1>

                    {{-- Group selector --}}
                    <div class="w-full max-w-sm md:max-w-48 mb-2">
                        <x-form-select id="selector-grupo" name="selector_grupo">
                            @foreach($grupos as $grupo)
                            <option
                                value="{{ $grupo->id }}"
                                class="text-complementary-dark"
                                {{ $grupo->is_current === true ? 'selected' : '' }}
                            >
                                Grupo {{ $grupo->name }}
                            </option>
                            @endforeach
                        </x-form-select>
                    </div>
                </div>
                

                {{-- Loading spinner --}}
                <div id="grupos-spinner" class="hidden">
                    <div class="flex justify-center py-8">
                        <svg class="custom-animate-spin w-8 h-8 text-secondary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                    </div>
                </div>

                {{-- Tabla de equipos del grupo --}}
                <div class="mx-auto rounded-t-3xl overflow-x-auto">
                    <table class="min-w-150 w-full text-left text-dark font-optimprov">
                        <thead class="uppercase bg-dark text-light text-xs sm:text-sm lg:text-xl">
                            <tr>
                                <th scope="col" class="px-4 py-3">Equipo</th>
                                <th scope="col" class="px-2 py-3 text-center font-bold">PJ</th>
                                <th scope="col" class="px-2 py-3 text-center font-bold">PG</th>
                                <th scope="col" class="px-2 py-3 text-center font-bold">PE</th>
                                <th scope="col" class="px-2 py-3 text-center font-bold">PP</th>
                                <th scope="col" class="px-2 py-3 text-center font-bold">GF</th>
                                <th scope="col" class="px-2 py-3 text-center font-bold">GC</th>
                                <th scope="col" class="px-2 py-3 text-center font-bold">DG</th>
                                <th scope="col" class="px-2 py-3 text-center font-bold">PTS</th>
                            </tr>
                        </thead>
                        <tbody id="equipos-grupo-list">
                            @foreach($equipos_grupo as $equipo)
                            <tr class="border-b border-zinc-300 text-xs sm:text-base lg:text-xl">
                                <td class="px-4 py-3 lg:py-4 flex items-center gap-4">
                                    <img
                                        src="{{ $equipo->imagen }}"
                                        alt="{{ $equipo->nombre }}"
                                        class="w-12 sm:w-18 lg:w-20 aspect-8/5 object-cover rounded-tr-xl rounded-bl-xl sm:rounded-tr-2xl sm:rounded-bl-2xl shrink-0 @if($equipo->has_white_flag === true) border border-zinc-300 @endif"
                                    >
                                    <span class="uppercase whitespace-nowrap">{{ $equipo->nombre }}</span>
                                </td>
                                <td class="px-2 py-3 text-center">{{ $equipo->partidos_jugados }}</td>
                                <td class="px-2 py-3 text-center">{{ $equipo->partidos_ganados }}</td>
                                <td class="px-2 py-3 text-center">{{ $equipo->partidos_empatados }}</td>
                                <td class="px-2 py-3 text-center">{{ $equipo->partidos_perdidos }}</td>
                                <td class="px-2 py-3 text-center">{{ $equipo->goles_favor }}</td>
                                <td class="px-2 py-3 text-center">{{ $equipo->goles_contra }}</td>
                                <td class="px-2 py-3 text-center">{{ $equipo->goles_favor - $equipo->goles_contra }}</td>
                                <td class="px-2 py-3 text-center border-s border-zinc-400">{{ $equipo->puntos }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Jornadas section --}}
                <div id="jornadas-section">

                    {{-- Spinner jornadas --}}
                    <div id="jornadas-spinner" class="hidden">
                        <div class="flex justify-center py-8">
                            <svg class="custom-animate-spin w-8 h-8 text-secondary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                        </div>
                    </div>

                    {{-- Contenedor de jornadas con partidos --}}
                    <div id="jornadas-partidos-list" class="mx-auto mt-12 sm:mt-20" style="max-width: min(82rem, calc(100vw - 2rem));">
                        @foreach([$jornada_uno, $jornada_dos, $jornada_tres] as $jornada)
                            @if($jornada && isset($jornada->partidos))
                            <div class="mb-16 sm:mb-24">
                                <h2 class="text-3xl sm:text-4xl lg:text-5xl uppercase font-brandan mb-4 lg:mb-6 text-center md:text-start">
                                    Jornada {{ $jornada->id }}
                                </h2>
                                <div class="divide-y divide-zinc-300">
                                    @foreach($jornada->partidos as $partido)
                                        <x-match-card :partido="$partido" />
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
