@props(['partido'])

@php
    $equipoUno = $partido->equipoUno;
    $equipoDos = $partido->equipoDos;
    $match     = $partido->partido;

    $timezone = auth()->user()->country->timezone ?? 'America/Guatemala';
    $fecha = $match->fecha_partido->timezone($timezone)->locale('es');
    $fechaFormateada = ucfirst($fecha->isoFormat('dddd D [de] MMMM'));
    $horaFormateada  = strtoupper($fecha->format('g:i A'));
@endphp

<div
    class="match-card flex flex-col sm:flex-row items-center justify-between gap-8 sm:gap-12 py-12 sm:py-6 px-2 sm:px-4 font-optimprov"
    data-equipos="{{ strtolower($equipoUno['nombre'] . ' ' . $equipoDos['nombre']) }}"
>
    {{-- Equipo 1 --}}
    <div class="flex items-center gap-3 flex-1 justify-start min-w-0">
        <img
            src="{{ asset($equipoUno['imagen']) }}"
            alt="{{ $equipoUno['nombre'] }}"
            class="w-18 sm:w-12 md:w-20 aspect-8/5 object-cover rounded-tr-lg rounded-bl-lg sm:rounded-tr-xl sm:rounded-bl-xl shrink-0 @if($equipoUno['has_white_flag'] === true) border border-zinc-300 @endif"
        >
        <span class="text-base sm:text-sm md:text-base lg:text-lg uppercase">{{ $equipoUno['nombre'] }}</span>
    </div>

    {{-- Fecha y hora --}}
    <div class="flex flex-row sm:flex-col gap-2 sm:gap-0 items-center shrink-0 text-center px-2 text-xl sm:text-md md:text-xl lg:text-2xl font-brandan">
        <span>{{ $fechaFormateada }}</span>
        <span>{{ $horaFormateada }}</span>
    </div>

    {{-- Equipo 2 --}}
    <div class="flex items-center flex-row-reverse sm:flex-row gap-3 flex-1 justify-end min-w-0">
        <span class="text-base sm:text-sm lg:text-lg uppercase sm:text-end">{{ $equipoDos['nombre'] }}</span>
        <img
            src="{{ asset($equipoDos['imagen']) }}"
            alt="{{ $equipoDos['nombre'] }}"
            class="w-18 sm:w-12 md:w-18 lg:w-20 aspect-8/5 object-cover rounded-tr-lg rounded-bl-lg sm:rounded-tr-xl sm:rounded-bl-xl shrink-0 @if($equipoDos['has_white_flag'] === true) border border-zinc-300 @endif"
        >
    </div>
</div>
