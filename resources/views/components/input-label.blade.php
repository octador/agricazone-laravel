@props(['for', 'value'])

<label for="{{ $for }}" {{ $attributes->merge(['class' => 'block font-medium text-sm text-customGreen-700 dark:text-36A793']) }}>
    {{ $value ?? $slot }}
</label>