@props(['equipo'])

<div
    class="team-card bg-light border-4 lg:border-6 border-light cursor-pointer
        rounded-tr-xl rounded-bl-xl lg:rounded-tr-3xl lg:rounded-bl-3xl
        hover:-translate-y-1 transition-translate duration-200"
    data-equipo-id="{{ $equipo->id }}"
    data-nombre="{{ $equipo->nombre }}"
    data-imagen="{{ asset($equipo->imagen) }}"
    data-has-white-flag="{{ $equipo->has_white_flag ? 'true' : 'false' }}"
    data-popover-target="popover-{{ $equipo->id }}"
    data-popover-trigger="hover"
    data-popover-placement="top"
>
    {{-- Description hidden — used by JS for the modal --}}
    <span class="team-card-descripcion hidden">{{ $equipo->descripcion }}</span>

    <div>
        <img
            src="{{ asset($equipo->imagen) }}"
            alt="{{ $equipo->nombre }}"
            class="w-full object-cover aspect-8/5
                max-w-16 min-[420px]:max-w-20 sm:max-w-24 md:max-w-34 lg:max-w-24 xl:max-w-32 
                rounded-tr-lg rounded-bl-lg lg:rounded-tr-3xl lg:rounded-bl-3xl"
        >
    </div>
</div>

<div
    data-popover
    id="popover-{{ $equipo->id }}"
    role="tooltip"
    class="absolute hidden lg:inline-block px-4 pt-4 pb-6 rounded-tr-3xl rounded-bl-3xl shadow-md
        text-lg uppercase text-dark bg-light
        invisible opacity-0 transition-opacity duration-200 font-optimprov"
>
    {{ $equipo->nombre }}
    <div data-popper-arrow class="border-light"></div>
</div>
