import { createRouter, createWebHistory } from 'vue-router';
import HomePageComponent from './components/pages/HomePageComponent.vue';
import AboutPageComponent from './components/pages/AboutPageComponent.vue';
import GaleryPageComponent from './components/pages/GalleryPageComponent.vue';
import ContactPageComponent from './components/pages/ContactPageComponent.vue';
import ProjectPageComponent from './components/pages/ProjectPageComponent.vue';

const routes = [
  { path: '/', component: HomePageComponent, meta: { title: 'HomePage - Areostil Pro' }},
  { path: '/about', component: AboutPageComponent, meta: { title: 'About - Areostil Pro' }},
  { path: '/gallery/:category?', component: GaleryPageComponent, meta: { title: 'Gallery - Areostil Pro' }},
  { path: '/contact', component: ContactPageComponent, meta: { title: 'Contact - Areostil Pro' }},
  { path: '/project/:id', component: ProjectPageComponent, props: true, meta: { title: 'Project - Areostil Pro' }},
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

// Глобальный guard для установки заголовка страницы и проверки авторизации
router.beforeEach((to, from, next) => {

    document.title = to.meta.title || 'Areostil Pro';
    // Устанавливаем title страницы
    document.title = to.meta.title || 'Areostil Pro';

    // Проверяем авторизацию, если требуется
    const user = window.Inertia?.page?.props?.auth?.user;
    if (to.meta.requiresAuth && !user) {
        next('/'); // Если нет пользователя, отправляем на главную
    } else {
        next();
    }
});

export default router;
