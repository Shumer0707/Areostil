import '../css/app.css';
import './bootstrap';

import { createApp, h } from 'vue';
import { createPinia } from 'pinia';
import { createInertiaApp, usePage } from '@inertiajs/vue3'; // <-- Добавили usePage
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from 'ziggy-js';
import { Ziggy } from './ziggy'; // Убедись, что файл существует!
import router from './router'; // Добавляем импорт router

// Создаём приложение Inertia
createInertiaApp({
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        app.use(plugin);
        app.use(ZiggyVue, Ziggy);
        app.use(createPinia());
        app.use(router);

        // Глобально передаём route()
        app.config.globalProperties.route = (...args) => {
            return window.route ? window.route(...args) : null;
        };

        // Функция для получения URL изображений
        app.config.globalProperties.$getImageUrl = (path) => {
            return `${import.meta.env.VITE_APP_URL}${path}`;
        };

        // Глобальный обработчик ошибок
        app.config.errorHandler = (err) => {
            console.error('Ошибка Vue:', err);
        };

        app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
