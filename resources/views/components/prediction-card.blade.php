@props(['registro'])

@php
    $partido    = $registro->partido;
    $equipoUno  = $registro->equipoUno;
    $equipoDos  = $registro->equipoDos;
    $prediccion = $registro->prediccion;
    $resultado  = $registro->resultado;

    $pronosticado = !empty($prediccion);
    $pred_e1 = $pronosticado ? $prediccion->goles_equipo_1 : '';
    $pred_e2 = $pronosticado ? $prediccion->goles_equipo_2 : '';

    $fecha_utc   = $partido->fecha_partido;
    $timezone    = auth()->user()->country->timezone ?? 'America/Guatemala';
    $fecha_local = $fecha_utc->copy()->timezone($timezone)->locale('es');
    $hora_fmt    = strtoupper($fecha_local->translatedFormat('g:i A'));
@endphp

<div class="flex flex-col items-center py-8 sm:py-6 px-2 sm:px-4 font-optimprov">
    {{-- Fila principal: Equipo1 | Predicción/Score | Hora | Predicción/Score | Equipo2 --}}
    <div class="flex items-center justify-between w-full gap-4 sm:gap-8">

        {{-- Equipo 1 --}}
        <div class="flex items-center gap-3 flex-1 justify-start min-w-0">
            <img
                src="{{ asset($equipoUno->imagen) }}"
                alt="{{ $equipoUno->nombre }}"
                class="w-18 sm:w-12 md:w-20 aspect-8/5 object-cover rounded-tr-lg rounded-bl-lg sm:rounded-tr-xl sm:rounded-bl-xl shrink-0"
            >
            <span class="text-base sm:text-sm md:text-base lg:text-lg uppercase">{{ $equipoUno->nombre }}</span>
        </div>

        {{-- Predicción Equipo 1 --}}
        @if($partido->estado === 0)
            <input
                type="number"
                name="prediccion_equipo1_{{ $registro->partido_id }}"
                min="0"
                max="25"
                value="{{ $pred_e1 }}"
                data-partido="{{ $registro->partido_id }}"
                class="marcador-equipo-1 border border-zinc-400 text-dark text-center rounded-lg hide-input-arrows w-10 h-10 lg:w-12 lg:h-12 text-lg lg:text-xl font-bold shrink-0"
            >
        @else
            <span class="text-2xl lg:text-3xl font-bold shrink-0">{{ $pred_e1 !== '' ? $pred_e1 : '-' }}</span>
        @endif

        {{-- Hora --}}
        <div class="flex flex-col items-center shrink-0 text-center px-2">
            <span class="text-sm md:text-base lg:text-lg font-brandan">{{ $hora_fmt }}</span>
        </div>

        {{-- Predicción Equipo 2 --}}
        @if($partido->estado === 0)
            <input
                type="number"
                name="prediccion_equipo2_{{ $registro->partido_id }}"
                min="0"
                max="25"
                value="{{ $pred_e2 }}"
                data-partido="{{ $registro->partido_id }}"
                class="marcador-equipo-2 border border-zinc-400 text-dark text-center rounded-lg hide-input-arrows w-10 h-10 lg:w-12 lg:h-12 text-lg lg:text-xl font-bold shrink-0"
            >
        @else
            <span class="text-2xl lg:text-3xl font-bold shrink-0">{{ $pred_e2 !== '' ? $pred_e2 : '-' }}</span>
        @endif

        {{-- Equipo 2 --}}
        <div class="flex items-center flex-row-reverse sm:flex-row gap-3 flex-1 justify-end min-w-0">
            <span class="text-base sm:text-sm md:text-base lg:text-lg uppercase sm:text-end">{{ $equipoDos->nombre }}</span>
            <img
                src="{{ asset($equipoDos->imagen) }}"
                alt="{{ $equipoDos->nombre }}"
                class="w-18 sm:w-12 md:w-18 lg:w-20 aspect-8/5 object-cover rounded-tr-lg rounded-bl-lg sm:rounded-tr-xl sm:rounded-bl-xl shrink-0"
            >
        </div>
    </div>

    {{-- Resultado y mensaje (solo si estado === 1 y tiene resultado) --}}
    @if($partido->estado === 1 && !empty($resultado))
        <div class="flex flex-col items-center mt-3">
            <p class="text-lg lg:text-xl font-brandan font-bold uppercase">
                Resultado
            </p>
            <p class="text-xl lg:text-2xl font-bold">
                {{ $resultado->goles_equipo_1 }}-{{ $resultado->goles_equipo_2 }}
            </p>
            <p class="text-sm text-complementary-dark mt-1">
                {{ $registro->mensaje }}
            </p>
        </div>
    @endif
</div>
