<x-app-layout>
    <div class="flex flex-col flex-1">
        <div id="toast-container"
            class="fixed top-4 left-1/2 -translate-x-1/2 z-50 flex-col items-center gap-3 w-full max-w-sm px-4"
            style="display: none;"
            aria-live="polite">
        </div>

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

                <h1 class="text-center md:text-start text-5xl sm:text-7xl lg:text-8xl uppercase font-brandan max-w-[12ch] mb-2">
                    Calendario de Partidos
                </h1>

                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <h2 class="text-center md:text-start text-2xl sm:text-3xl lg:text-5xl uppercase font-brandan text-zinc-400">
                        Ingresa tus pronósticos
                    </h2>

                    <form
                        class="w-full max-w-sm md:max-w-60"
                        data-url-quiniela="{{ route('web.save-predicciones') }}"
                    >
                        <x-form-select id="selector-jornada" name="selector_jornada">
                            @foreach($jornadas as $jornada)
                                @php
                                    $journey_name = in_array($jornada->name, ['1', '2', '3']) ? "Jornada {$jornada->name}" : $jornada->name;
                                @endphp
                                <option
                                    value="{{ $jornada->id }}"
                                    {{ $jornada->id === $jornada_activa->id ? 'selected' : '' }}
                                >
                                    {{ $journey_name }}
                                </option>
                            @endforeach
                        </x-form-select>
                    </form>
                </div>

                <form
                    id="form-quiniela"
                    action="{{ route('web.save-predicciones') }}"
                    method="POST"
                    data-url-predicciones="{{ route('web.save-predicciones') }}"
                    data-url-quiniela="{{ route('web.quiniela') }}"
                    class="relative mb-6"
                >
                    @csrf

                    {{-- Lista de partidos --}}
                    @if($records->isEmpty())
                        <p class="text-center text-zinc-400 py-20 text-lg sm:text-xl lg:text-2xl font-brandan uppercase">
                            No hay partidos programados para esta jornada.
                        </p>
                    @else
                        @php
                            $user = auth()->user();
                            $timezone = auth()->user()->country->timezone ?? 'America/Guatemala';
                            $grupos_por_fecha = $records
                                ->sortBy(fn($registro) => $registro->partido->fecha_partido->timestamp)
                                ->groupBy(fn($registro) => $registro->partido->fecha_partido->copy()->timezone($timezone)->format('Y-m-d'));
                        @endphp

                        @foreach($grupos_por_fecha as $fecha => $registros_dia)
                            @php
                                $fecha_label = \Carbon\Carbon::parse($fecha)->locale('es')->isoFormat('D [DE] MMMM');
                            @endphp
                            <div class="bg-dark text-light rounded-t-2xl px-6 py-3 mt-8 mb-4">
                                <h3 class="text-xl sm:text-3xl lg:text-4xl uppercase font-optimprov">
                                    {{ strtoupper($fecha_label) }}
                                </h3>
                            </div>
                            <div class="divide-y divide-zinc-300 mb-4">
                                @foreach($registros_dia as $registro)
                                    <x-prediction-card :registro="$registro" />
                                @endforeach
                            </div>
                        @endforeach
                    @endif

                    @if (!$user->hasRole('admin'))
                        {{-- Botón sticky inferior derecha --}}
                        <div class="sticky bottom-4 z-50 flex justify-center pointer-events-none">
                            <button
                                type="submit"
                                class="pointer-events-auto cursor-pointer focus:outline-none hover:brightness-[1.2] focus:ring-4 focus:ring-primary rounded-full shadow-lg shadow-dark bg-green-700 text-light text-md lg:text-xl py-3 px-6 font-semibold gap-2 flex justify-center items-center mr-4"
                            >
                                <span class="icon-[fluent--edit-16-filled] w-6 h-6"></span>
                                Pronosticar
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        {{-- Modal Resultado de Predicciones --}}
        <div id="modal-resultado-predicciones" class="pointer-events-none fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none;">

            {{-- Backdrop --}}
            <div id="modal-resultado-backdrop" class="absolute inset-0 bg-black/70 opacity-0 transition-opacity duration-300"></div>

            {{-- Panel --}}
            <div id="modal-resultado-panel" class="relative bg-light rounded-3xl overflow-hidden w-full max-w-4xl max-h-[90dvh] flex flex-col opacity-0 transition-opacity duration-300 ease-out">

                {{-- Header --}}
                <div class="shrink-0 pt-6 pb-4 px-6 flex items-start justify-between gap-4">
                    <h2 class="text-2xl lg:text-3xl uppercase font-bold text-dark leading-tight font-brandan">Resultado del registro de predicciones</h2>
                    <button type="button" id="modal-resultado-close" class="shrink-0 text-complementary-dark hover:text-dark transition-colors mt-1 cursor-pointer">
                        <span class="icon-[fluent--dismiss-16-filled] w-6 h-6"></span>
                    </button>
                </div>

                {{-- Scrollable cards container --}}
                <div class="overflow-y-auto flex-1 px-6 py-4 pb-6">
                    <div id="modal-resultado-cards" class="flex flex-col"></div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
