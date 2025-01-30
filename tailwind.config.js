import defaultTheme from 'tailwindcss/defaultTheme';
import plugin from 'tailwindcss/plugin';

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
            transitionDelay: {
                1500: '1500ms',
                2000: '2000ms',
                2500: '2500ms',
                3000: '3000ms',
              },
            transitionDuration: {
            2000: '2000ms' // Добавляем класс duration-2000
            },
            scale: {
                200: '2', // Добавляем класс scale-200, который увеличивает элемент в 2 раза
                300: '3',
            },
            inset: {
                '150': '150%', // Добавляем класс left-150 для значения 150%
                '100': '100%', // Добавляем класс left-150 для значения 150%
                '-100': '-100%', // Добавляем класс left-150 для значения 150%
            },
            translate: {
                '1000': '1000px', // Добавляем класс translate-x-150 для сдвига на 150 пикселей
                '150' : '150px',
                'full': '100%',
                '0': '0',
            },
            zIndex: {
                60: '60',
                100: '100',
                '-10': '-10' // Отрицательный z-index
            },
            rotate: {
                '-40deg': '-40deg',
                '40deg': '40deg',
            },
        },
    },
    plugins: [
        plugin(function ({ addUtilities }) {
          addUtilities({
            '.tab-disabled': {
              tabindex: '-1',
            },
            '.tab-enabled': {
              tabindex: '0',
            },
          });
        }),
        function({ addBase, theme }) {
            addBase({
                ':root': {
                    '--color-primary': theme('colors.primary'),
                    '--color-secondary': theme('colors.secondary'),
                    '--color-my-white': theme('colors.my_white'),
                    '--color-my-black': theme('colors.my_black'),
                    '--color-footer': theme('colors.footer'),
                },
            });
        },
      ],
};
