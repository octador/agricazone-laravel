@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-customGreen-500 dark:border-customGreen-500 text-customGreen-50 dark:text-customGreen-500 focus:border-customGreen-600 dark:focus:border-customGreen-600 focus:ring-customGreen-600 dark:focus:ring-customGreen-600 rounded-md shadow-sm opacity-75']) !!}>