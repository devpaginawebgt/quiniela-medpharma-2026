@props([
    'name',
    'icon' => null,
    'image' => null,
    'required' => false,
])

<div class="relative">
    @if($image)
        <div class="absolute inset-y-0 inset-s-0 flex items-center ps-3.5 pointer-events-none">
            <img src="{{ $image }}" alt="" class="w-5 lg:w-6 h-5 lg:h-6 rounded-full object-cover">
        </div>
    @elseif($icon)
        <div class="absolute inset-y-0 inset-s-0 flex items-center ps-3.5 pointer-events-none">
            <span class="{{ $icon }} w-5 lg:w-6 h-5 lg:h-6 text-secondary"></span>
        </div>
    @endif
    <select
        name="{{ $name }}"
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'w-full py-3 bg-transparent border-2 rounded-lg border-secondary text-dark focus:ring-0 focus:border-complementary-secondary focus:border-3 text-base ' . ($icon || $image ? 'ps-11' : 'ps-4')]) }}
    >
        {{ $slot }}
    </select>
</div>
