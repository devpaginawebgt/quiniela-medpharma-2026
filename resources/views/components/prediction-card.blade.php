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

<div class="flex flex-col items-center py-8 md:py-6 px-2 md:px-4 font-optimprov">

    <input
        type="number"
        name="partidos[]"
        value="{{ $partido->id }}"
        hidden
        class="hidden partido-jornada-quiniela"
    >

    {{--
        Móvil: layout vertical (cada equipo en su fila con input al lado)
        md+:   layout horizontal (todo en una fila)
    --}}
    <div class="flex flex-col md:flex-row items-center md:justify-between w-full gap-4 md:gap-4 lg:gap-8">

        {{-- Equipo 1 + Input --}}
        <div class="flex items-center justify-between w-full md:w-auto md:flex-1 md:min-w-0 gap-3">
            <div class="flex items-center gap-3">
                <img
                    src="{{ asset($equipoUno->imagen) }}"
                    alt="{{ $equipoUno->nombre }}"
                    class="w-12 md:w-14 lg:w-20 aspect-8/5 object-cover rounded-tr-lg rounded-bl-lg md:rounded-tr-xl md:rounded-bl-xl shrink-0 @if($equipoUno->has_white_flag === true) border border-zinc-300 @endif"
                >
                <span class="text-sm lg:text-lg uppercase">{{ $equipoUno->nombre }}</span>
            </div>
            @if($partido->estado === 0)
                <input
                    type="number"
                    name="prediccion_equipo1_{{ $registro->partido_id }}"
                    min="0"
                    max="25"
                    value="{{ $pred_e1 }}"
                    data-partido="{{ $registro->partido_id }}"
                    class="marcador-equipo-1 border border-zinc-400 text-dark text-center rounded-lg hide-input-arrows text-sm md:text-md lg:text-xl w-full max-w-14 md:max-w-16 lg:max-w-16 h-10 font-bold shrink-0 p-2 hover:ring-2 hover:ring-zinc-600 focus:ring-2 focus:ring-zinc-600 transition-shadow"
                >
            @else
                <span class="text-2xl lg:text-3xl font-bold shrink-0">{{ $pred_e1 !== '' ? $pred_e1 : '-' }}</span>
            @endif
        </div>

        {{-- Hora --}}
        <div class="shrink-0 text-center">
            <span class="text-lg md:text-base lg:text-2xl font-brandan">{{ $hora_fmt }}</span>
        </div>

        {{-- Input Equipo 2 + Equipo 2 --}}
        <div class="flex items-center justify-between flex-row-reverse md:flex-row w-full md:w-auto md:flex-1 md:min-w-0 gap-3">
            @if($partido->estado === 0)
                <input
                    type="number"
                    name="prediccion_equipo2_{{ $registro->partido_id }}"
                    min="0"
                    max="25"
                    value="{{ $pred_e2 }}"
                    data-partido="{{ $registro->partido_id }}"
                    class="marcador-equipo-2 border border-zinc-400 text-dark text-center rounded-lg hide-input-arrows text-sm md:text-md lg:text-xl w-full max-w-14 md:max-w-16 lg:max-w-16 h-10 font-bold shrink-0 md:order-first p-2 hover:ring-2 hover:ring-zinc-600 focus:ring-2 focus:ring-zinc-600 transition-shadow"
                >
            @else
                <span class="text-2xl lg:text-3xl font-bold shrink-0 md:order-first">{{ $pred_e2 !== '' ? $pred_e2 : '-' }}</span>
            @endif
            <div class="flex items-center flex-row-reverse md:flex-row gap-3">
                <span class="text-sm lg:text-lg uppercase text-start md:text-end">{{ $equipoDos->nombre }}</span>
                <img
                    src="{{ asset($equipoDos->imagen) }}"
                    alt="{{ $equipoDos->nombre }}"
                    class="w-12 md:w-14 lg:w-20 aspect-8/5 object-cover rounded-tr-lg rounded-bl-lg md:rounded-tr-xl md:rounded-bl-xl shrink-0 @if($equipoDos->has_white_flag === true) border border-zinc-300 @endif"
                >
            </div>
        </div>
    </div>

    {{-- Resultado y mensaje (solo si estado === 1 y tiene resultado) --}}
    @if($partido->estado === 1 && !empty($resultado))
        <div class="flex flex-col items-center mt-3">
            <p class="text-2xl lg:text-4xl font-brandan uppercase">
                Resultado
            </p>
            <p class="text-2xl lg:text-4xl font-optimprov">
                {{ $resultado->goles_equipo_1 }}-{{ $resultado->goles_equipo_2 }}
            </p>
            <p class="font-brandan text-2xl lg:text-3xl text-zinc-400 mt-1">
                {{ $registro->mensaje }}
            </p>
        </div>
    @endif
</div>
