import { createRouter, createWebHistory } from 'vue-router';

import HomePageComponent from './pages/HomePageComponent.vue';
import AboutPageComponent from './pages/AboutPageComponent.vue';
import GaleryPageComponent from './pages/GaleryPageComponent.vue';
import ContactPageComponent from './pages/ContactPageComponent.vue';

const routes = [
  { path: '/', component: HomePageComponent, meta: { title: 'HomePage - Areostil Pro' }},
  { path: '/about', component: AboutPageComponent },
  { path: '/galery', component: GaleryPageComponent },
  { path: '/contact', component: ContactPageComponent }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
