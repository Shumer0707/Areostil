import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/views/**/*.blade.php', // Улучшение
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                sans: ['Roboto', 'Arial', 'sans-serif'], // Основной шрифт
                serif: ['Georgia', 'serif'], // Для заголовков
            },
            colors: {
                primary: '#deded5', // Основной цвет
                secondary: '#ffc857', // Для кнопок и акцента
                my_white: '#f8f8f5', // для Фона
                my_black: '#121211', // для Текст
                footer: '#121211' // для footer
            },
        },
    },
    plugins: [],
};
