<template>
      <HeaderComponent />
      <router-view /> <!-- Основной контент приложения -->
      <FooterComponent />
</template>

<script>
import HeaderComponent from './static/HeaderComponent.vue';
import FooterComponent from './static/FooterComponent.vue';

export default {
  name: 'App',
  components: {
    HeaderComponent,
    FooterComponent
  }
};
</script>
