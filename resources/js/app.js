import '../css/app.css';
import './bootstrap';

import { createApp, h } from 'vue';
import { createPinia } from 'pinia';
import { useLocalizationStore } from './store/localization';
import { createInertiaApp, usePage } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue, route } from 'ziggy-js';
import { Ziggy } from './ziggy';
import router from './router';

// Добавляем `route()` в `window`, чтобы он работал в консоли и в коде
window.route = route;

// Создаём приложение Inertia
createInertiaApp({
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        ),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        // Отключаем логи Pinia в продакшн-режиме
        // const pinia = createPinia();
        // if (import.meta.env.MODE === 'production') {
            console.log = (...args) => {
                if (args[0]?.includes?.('🍍')) return; // Блокируем Pinia-логи
                console.info(...args); // Разрешаем остальные логи
            };
        // }
        // pinia.use(() => ({ debug: false }));

        app.use(plugin);
        app.use(ZiggyVue, Ziggy);
        app.use(createPinia());
        app.use(router);



        app.config.globalProperties.route = (name, params = {}) => {
            try {
                const page = usePage(); // Берём usePage() только когда он доступен
                const ziggyRoutes = page?.props?.ziggy?.routes;
                if (!ziggyRoutes || !ziggyRoutes[name]) {
                    console.warn(`Маршрут "${name}" не найден в Ziggy.`);
                    return '/';
                }
                return `/${ziggyRoutes[name].uri}`;
            } catch (error) {
                console.warn(`Ошибка при вызове route("${name}")`, error);
                return '/';
            }
        };

        // Функция для получения URL изображений
        app.config.globalProperties.$getImageUrl = (path) => {
            return `${import.meta.env.VITE_APP_URL}${path}`;
        };

        // Глобальный обработчик ошибок
        app.config.errorHandler = (err) => {
            console.error('Ошибка Vue:', err);
        };

        const localizationStore = useLocalizationStore();
        localizationStore.fetchTranslations(); // Загружаем переводы перед стартом приложения

        // ✅ Добавляем глобальный доступ к переводам
        app.config.globalProperties.$t = (key) => {
            const keys = key.split('.');
            let translation = localizationStore.translations;

            for (const k of keys) {
                translation = translation?.[k];
                if (!translation) return key; // Если перевод не найден, возвращаем ключ
            }
            return translation;
        };

        // ✅ Делаем `localizationStore` глобально доступным
        // app.config.globalProperties.localizationStore = localizationStore;

        app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
