import '../css/app.css';
import './bootstrap';

import { createApp, h } from 'vue';
import { createPinia } from 'pinia'; // Импортируем Pinia
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { ZiggyVue } from 'ziggy-js'; // Обновлённый импорт Ziggy
import { Ziggy } from 'ziggy-js';   // Обновлённый импорт маршрутов

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
// router.afterEach((to) => {
//     document.title = to.meta.title || 'Default Title';
//   });

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        app.use(plugin);
        app.use(ZiggyVue, Ziggy); // Добавляем второй параметр
        app.use(createPinia()); // Подключаем Pinia
        app.use(router); // Подключаем Vue Router

        app.config.globalProperties.$getImageUrl = (path) => {
            return `${import.meta.env.VITE_APP_URL}${path}`;
        };

        app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
