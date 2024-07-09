@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-customerGreen-700']) }}>
        {{ $status }}
    </div>
@endif
