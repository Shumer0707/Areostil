import { createApp } from 'vue';
import App from './components/App.vue';
import router from './components/router';

router.afterEach((to) => {
    document.title = to.meta.title || 'Default Title';
  });

const app = createApp(App);

// Добавляем глобальный метод $getImageUrl
app.config.globalProperties.$getImageUrl = (path) => {
    return `${import.meta.env.VITE_APP_URL}${path}`;
};

app.use(router).mount('#app');

// import { createApp } from 'vue';
// import HomePageComponent from './components/pages/HomePageComponent.vue';
// import AboutPageComponent from './components/pages/AboutPageComponent.vue';
// import GaleryPageComponent from './components/pages/GaleryPageComponent.vue';
// import ContactPageComponent from './components/pages/ContactPageComponent.vue';
// import FooterComponent from './components/static/FooterComponent.vue';


// function mountComponent(selector, component, componentName) {
//     const element = document.querySelector(selector);
//     if (element) {
//         const app = createApp({});

//         app.config.globalProperties.$getImageUrl = (path) => {
//             return `${import.meta.env.VITE_APP_URL}${path}`;
//         };

//         app.component(componentName, component);
//         app.mount(selector);
//     }
// }

// mountComponent('#home', HomePageComponent, 'homepage-component');
// mountComponent('#about', AboutPageComponent, 'aboutpage-component');
// mountComponent('#galery', GaleryPageComponent, 'galerypage-component');
// mountComponent('#contact', ContactPageComponent, 'contactpage-component');
// mountComponent('#footer', FooterComponent, 'footer-component');


// const appElement = document.querySelector('#app'); // Ищем элемент с id="app"

// if (appElement) {
//     const app = createApp({}); // Создаем приложение
//     app.component('example-component', ExampleComponent); // Регистрируем компонент
//     app.mount('#app'); // Монтируем приложение на элемент с id="app"
// }
