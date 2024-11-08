const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
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
                'orange-300': '#ff9800',
                'blue':'#0000ff',
                'gray': '#808080',
                'green': '#008000',
                'bluee': '#3B82F6',
                'greend': '#b6e3a7',
                'red-500': '#F44336'

            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
