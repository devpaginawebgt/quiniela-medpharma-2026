@props([
    'id'    => 'select',
    'name'  => 'select',
    'label' => null,
])

<div class="w-full flex gap-2 border border-zinc-400">
    @if($label)
        <label for="{{ $id }}" class="text-light font-bold whitespace-nowrap">{{ $label }}</label>
    @endif
    <div class="w-full relative flex items-center">
        <select
            id="{{ $id }}"
            name="{{ $name }}"
            style="-webkit-appearance: none; -moz-appearance: none; appearance: none; background-image: none;"
            {{ $attributes->merge(['class' => 'form-select-custom bg-transparent text-complementary-dark cursor-pointer focus:outline-none border-none w-full pr-6']) }}
        >
            {{ $slot }}
        </select>
        <div class="pointer-events-none absolute right-0 bg-dark text-light px-2 h-full flex justify-center items-center">
            <span class="icon-[fluent--caret-down-24-filled] w-7 h-7"></span>
        </div>
    </div>
</div>
