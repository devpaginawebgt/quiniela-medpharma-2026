@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-center text-green-600 max-w-108 mx-auto']) }}>
        {{ $status }}
    </div>
@endif
