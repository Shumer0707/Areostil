import { createRouter, createWebHistory } from 'vue-router';
import { usePage } from '@inertiajs/vue3';
import HomePageComponent from './components/pages/HomePageComponent.vue';
import AboutPageComponent from './components/pages/AboutPageComponent.vue';
import GaleryPageComponent from './components/pages/GalleryPageComponent.vue';
import ContactPageComponent from './components/pages/ContactPageComponent.vue';
import ProjectPageComponent from './components/pages/ProjectPageComponent.vue';

const routes = [
  { path: '/', component: HomePageComponent, meta: { title: 'HomePage - Areostil Pro' }},
  { path: '/about', component: AboutPageComponent },
  { path: '/gallery', component: GaleryPageComponent },
  { path: '/contact', component: ContactPageComponent },
  { path: '/project/:id', component: ProjectPageComponent, props: true }, // Динамический маршрут для проекта
];

const router = createRouter({
  history: createWebHistory(),
  routes
    });
    // Глобальный guard для проверки авторизации
    router.beforeEach((to, from, next) => {
        const page = usePage();
        const user = page.props.auth?.user;

        if (to.meta.requiresAuth && !user) {
        next('/'); // Если нет пользователя, отправляем на главную
        } else {
        document.title = to.meta.title || 'Areostil Pro';
        next();
    }
  });
export default router;
