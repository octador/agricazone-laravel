@props(['disabled' => false])

<button {{ $attributes->merge([
    'type' => 'submit', 
    'class' => 'inline-flex items-center px-4 py-2 bg-customGreen-500 dark:bg-customGreen-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-customGreen-600 dark:hover:bg-customGreen-600 focus:bg-customGreen-600 dark:focus:bg-customGreen-600 active:bg-customGreen-700 dark:active:bg-customGreen-700 focus:outline-none focus:ring-2 focus:ring-customGreen-600 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 disabled:opacity-50'
]) }} {{ $disabled ? 'disabled' : '' }}>
    {{ $slot }}
</button>
