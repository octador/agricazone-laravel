import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                customGreen: {
                    DEFAULT: '#36A793',
                    50: '#EBF7F5',
                    100: '#D7F0EB',
                    200: '#B0E1D6',
                    300: '#89D2C1',
                    400: '#62C3AC',
                    500: '#36A793',
                    600: '#2A8373',
                    700: '#1E6053',
                    800: '#133D33',
                    900: '#081A13',
                },
                customBody: '#FCF5E5',
            },
        },
    },

    plugins: [
        forms,
        function ({ addComponents }) {
            addComponents({
                '.btnCustom': {
                    backgroundColor: '#36A793',
                    padding: '10px',
                    borderRadius: '15px',
                    color: '#fff',
                    display: 'inline-block',
                    textAlign: 'center',
                    textDecoration: 'none',
                    '&:hover': {
                        backgroundColor: '#2A8373',
                    },
                },
                '.btnCustomRed': {
                    backgroundColor: '#EB5757',
                    padding: '10px',
                    borderRadius: '15px',
                    color: '#fff',
                    display: 'inline-block',
                    textAlign: 'center',
                    textDecoration: 'none',
                    '&:hover': {
                        backgroundColor: '#D32F2F',
                    },
                },
            });
        },
    ],
};
