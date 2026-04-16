@props([
    'name',
    'id' => null,
    'type' => 'text',
    'icon' => null,
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'maxlength' => null,
    'minlength' => null,
    'pattern' => null,
    'message' => null,
    'autofocus' => false,
    'autocomplete' => null,
])

<div class="relative">
    @if($icon)
        <div class="absolute inset-y-0 inset-s-0 flex items-center ps-3.5 pointer-events-none">
            <span class="{{ $icon }} w-5 lg:w-6 h-5 lg:h-6 text-secondary"></span>
        </div>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        @if($id) id="{{ $id }}" @endif
        @if($required) required @endif
        @if($maxlength) maxlength="{{ $maxlength }}" @endif
        @if($minlength) minlength="{{ $minlength }}" @endif
        @if($pattern) pattern="{{ $pattern }}" @endif
        @if($message) title="{{ $message }}" @endif
        @if($autofocus) autofocus @endif
        @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
        {{ $attributes->merge(['class' => 'w-full py-3 bg-transparent border-2 rounded-lg border-secondary text-dark placeholder-complementary-dark focus:ring-0 focus:border-complementary-secondary focus:border-3 text-base ' . ($icon ? 'ps-11' : 'ps-4')]) }}
    >
</div>
