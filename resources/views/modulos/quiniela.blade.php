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

                <h1 class="text-center md:text-start text-5xl sm:text-7xl lg:text-8xl uppercase font-brandan max-w-[12ch] mb-2">
                    Calendario de Partidos
                </h1>

                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <h2 class="text-center md:text-start text-2xl sm:text-3xl lg:text-5xl uppercase font-brandan text-zinc-400">
                        Ingresa tus pronósticos
                    </h2>

                    <div class="w-full max-w-sm md:max-w-48">
                        <x-form-select id="selector-fecha" name="selector_fecha">
                            @foreach($fechas_filtro as $fecha)
                                <option
                                    value="{{ $fecha->fecha }}"
                                    {{ $fecha->fecha === $fecha_filtrada ? 'selected' : '' }}
                                >
                                    {{ $fecha->fecha_larga }}
                                </option>
                            @endforeach
                        </x-form-select>
                    </div>
                </div>

                {{-- Fecha seleccionada como header --}}
                @php
                    $fecha_activa = $fechas_filtro->firstWhere('fecha', $fecha_filtrada);
                @endphp

                {{-- Lista de partidos --}}
                @if($records->isEmpty())
                    <p class="text-center text-zinc-400 py-20 text-lg sm:text-xl lg:text-2xl font-brandan uppercase">
                        No hay partidos programados para esta fecha.
                    </p>
                @else
                    <div class="bg-dark text-light rounded-t-2xl px-6 py-3 mt-8 mb-4">
                        <h3 class="text-xl sm:text-3xl lg:text-4xl uppercase font-optimprov">
                            {{ $fecha_activa->fecha_larga ?? '' }}
                        </h3>
                    </div>
                    <div class="divide-y divide-zinc-300">
                        @foreach($records as $registro)
                            <x-prediction-card :registro="$registro" />
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>

    <script>
    document.getElementById('selector-fecha').addEventListener('change', function () {
        window.location.href = "{{ route('web.quiniela') }}?fecha=" + this.value;
    });
    </script>
</x-app-layout>
