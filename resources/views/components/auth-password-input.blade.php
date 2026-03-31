@props([
    'id',
    'name',
    'icon' => null,
    'placeholder' => '',
    'required' => false,
    'autofocus' => false,
    'autocomplete' => 'off',
    'pattern' => null,
    'message' => null,
    'minlength' => null,
])

<div class="relative">
    @if($icon)
        <div class="absolute inset-y-0 inset-s-0 flex items-center ps-3.5 pointer-events-none">
            <span class="{{ $icon }} w-5 lg:w-6 h-5 lg:h-6 text-secondary"></span>
        </div>
    @endif
    <input
        type="password"
        id="{{ $id }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        @if($autofocus) autofocus @endif
        @if($pattern) pattern="{{ $pattern }}" @endif
        @if($message) title="{{ $message }}" @endif
        @if($minlength) minlength="{{ $minlength }}" @endif
        autocomplete="{{ $autocomplete }}"
        {{ $attributes->merge(['class' => 'w-full py-3 pe-11 bg-transparent border-2 rounded-lg border-secondary text-dark placeholder-complementary-dark focus:ring-0 focus:border-complementary-secondary focus:border-3 text-base ' . ($icon ? 'ps-11' : 'ps-4')]) }}
    >
    <button
        type="button"
        data-toggle-password="{{ $id }}"
        class="absolute inset-y-0 inset-e-0 flex items-center pe-3.5 cursor-pointer text-complementary-dark hover:text-dark"
    >
        <span class="icon-[fluent--eye-24-filled] w-5 h-5 hidden" data-icon-show></span>
        <span class="icon-[fluent--eye-off-24-filled] w-5 h-5 block" data-icon-hide></span>
    </button>
</div>
