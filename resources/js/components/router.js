import { createRouter, createWebHistory } from 'vue-router';

import HomePageComponent from './pages/HomePageComponent.vue';
import AboutPageComponent from './pages/AboutPageComponent.vue';
import GaleryPageComponent from './pages/GalleryPageComponent.vue';
import ContactPageComponent from './pages/ContactPageComponent.vue';
import ProjectPageComponent from './pages/ProjectPageComponent.vue';

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

export default router;
