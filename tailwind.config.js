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
            colors: {
                darkBackground: '#1a202c', // Custom dark background color
                darkText: '#a0aec0', // Custom dark text color
                darkCard: '#2d3748', // Custom dark card color
                customGreen: {
                    light: '#6ee7b7',
                    DEFAULT: '#10b981',
                    dark: '#047857',
                },
                customYellow: {
                    light: '#fde68a',
                    DEFAULT: '#f59e0b',
                    dark: '#b45309',
                },
                customRed: {
                    light: '#fca5a5',
                    DEFAULT: '#ef4444',
                    dark: '#991b1b',
                },
                customTeal: {
                    light: '#81d0d3',
                    DEFAULT: '#54b9bd',
                    dark: '#3a8689',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [forms],
};