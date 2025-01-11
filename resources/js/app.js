import './bootstrap';
import { createApp } from 'vue';
import HomePageComponent from './components/HomePageComponent.vue';
import AboutPageComponent from './components/AboutPageComponent.vue';
import GaleryPageComponent from './components/GaleryPageComponent.vue';
import ContactPageComponent from './components/ContactPageComponent.vue';

function mountComponent(selector, component, componentName) {
    const element = document.querySelector(selector);
    if (element) {
        const app = createApp({});
        app.component(componentName, component);
        app.mount(selector);
    }
}

mountComponent('#home', HomePageComponent, 'homepage-component');
mountComponent('#about', AboutPageComponent, 'aboutpage-component');
mountComponent('#galery', GaleryPageComponent, 'galerypage-component');
mountComponent('#contact', ContactPageComponent, 'contactpage-component');

// const appElement = document.querySelector('#app'); // Ищем элемент с id="app"

// if (appElement) {
//     const app = createApp({}); // Создаем приложение
//     app.component('example-component', ExampleComponent); // Регистрируем компонент
//     app.mount('#app'); // Монтируем приложение на элемент с id="app"
// }
