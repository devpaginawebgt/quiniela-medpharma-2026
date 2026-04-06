@props(['estadio'])

<div
    class="estadio-card bg-light border border-zinc-300 rounded-tr-4xl rounded-bl-4xl overflow-hidden cursor-pointer hover:scale-[1.02] transition-transform duration-200"
    data-nombre="{{ $estadio->nombre }}"
    data-imagen="{{ asset($estadio->imagen) }}"
>
    <img
        src="{{ asset($estadio->imagen) }}"
        alt="{{ $estadio->nombre }}"
        class="w-full aspect-video object-cover"
    >

    {{-- Descripción completa (usada por JS para el modal) --}}
    <span class="estadio-descripcion hidden">{{ $estadio->descripcion }}</span>

    <div class="px-5 py-4 flex items-center justify-between gap-4">
        <h3 class="font-bold text-xl leading-tight">{{ $estadio->nombre }}</h3>
        <span class="flex items-center gap-1 font-semibold text-sm text-complementary-dark shrink-0">
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </span>
    </div>
</div>
