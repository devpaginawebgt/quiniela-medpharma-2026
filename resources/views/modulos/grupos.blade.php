<x-app-layout>
    <div>
        <x-main-banner/>

        <div class="overflow-hidden sm:rounded-lg">
            <div class="px-4 pb-6">

                <h5 class="text-3xl 2xl:text-4xl text-center font-bold mt-8 mb-4">Grupos conformados</h5>

                {{-- Group selector --}}
                <div class="max-w-lg mx-auto mb-6">
                    <x-form-select id="selector-grupo" name="selector_grupo" label="Grupo:">
                        @foreach($grupos as $grupo)
                        <option
                            value="{{ $grupo->id }}"
                            class="bg-complementary-primary"
                            {{ $grupo->is_current === true ? 'selected' : '' }}
                        >
                            {{ $grupo->name }}
                        </option>
                        @endforeach
                    </x-form-select>
                </div>

                {{-- Loading spinner --}}
                <div id="grupos-spinner" class="hidden">
                    <div class="flex justify-center py-8">
                        <svg class="animate-spin w-8 h-8 text-secondary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                    </div>
                </div>

                {{-- Tabla de equipos del grupo --}}
                <div class="max-w-4xl mx-auto">
                    <div class="relative overflow-x-auto rounded-2xl">
                        <table class="w-full text-sm text-left text-dark">
                            <thead class="text-xs uppercase bg-dark text-light">
                                <tr>
                                    <th scope="col" class="px-4 py-3 font-bold">Equipo</th>
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
                                <tr class="border-b border-complementary-light/20">
                                    <td class="px-4 py-3 flex items-center gap-3">
                                        <img src="{{ $equipo->imagen }}" alt="{{ $equipo->nombre }}" class="h-8 w-12 object-cover rounded shrink-0">
                                        <span class="font-semibold whitespace-nowrap">{{ $equipo->nombre }}</span>
                                    </td>
                                    <td class="px-2 py-3 text-center">{{ $equipo->partidos_jugados }}</td>
                                    <td class="px-2 py-3 text-center">{{ $equipo->partidos_ganados }}</td>
                                    <td class="px-2 py-3 text-center">{{ $equipo->partidos_empatados }}</td>
                                    <td class="px-2 py-3 text-center">{{ $equipo->partidos_perdidos }}</td>
                                    <td class="px-2 py-3 text-center">{{ $equipo->goles_favor }}</td>
                                    <td class="px-2 py-3 text-center">{{ $equipo->goles_contra }}</td>
                                    <td class="px-2 py-3 text-center">{{ $equipo->goles_favor - $equipo->goles_contra }}</td>
                                    <td class="px-2 py-3 text-center font-bold">{{ $equipo->puntos }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Floating "Ver Jornadas" button --}}
    <div class="fixed bottom-20 right-4 z-30">
        <button
            id="btn-ver-jornadas"
            type="button"
            class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold text-sm px-4 py-2.5 rounded-full shadow-lg transition-colors"
        >
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
            </svg>
            Ver Jornadas
        </button>
    </div>

    {{-- Jornadas section (collapsible) --}}

    <div id="jornadas-section" class="hidden max-w-screen-2xl mx-auto px-4 pb-24 sm:px-6 lg:px-8">

        <h5 id="titulo-jornadas-grupo" class="text-2xl font-bold text-center mt-6 mb-4">
            Jornadas de Partidos del Grupo {{ ($grupos->firstWhere('is_current', true))->name }}
        </h5>

        {{-- Buscador de partidos --}}
        <div class="w-full max-w-lg mx-auto mb-6">
            <x-search-input id="buscar-partidos-grupo" name="buscar_partidos_grupo" placeholder="Buscar Partidos" />
        </div>

        {{-- Spinner jornadas --}}
        <div id="jornadas-spinner" class="hidden">
            <div class="flex justify-center py-8">
                <svg class="animate-spin w-8 h-8 text-secondary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
            </div>
        </div>

        {{-- Contenedor de jornadas con partidos --}}
        <div id="jornadas-partidos-list"></div>

    </div>

</x-app-layout>
