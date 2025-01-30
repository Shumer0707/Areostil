<template>
      <HeaderComponent />
      <ButtonDownComponent></ButtonDownComponent>
      <router-view /> <!-- Основной контент приложения -->
      <FooterComponent />
</template>

<script>
import HeaderComponent from './static/HeaderComponent.vue';
import FooterComponent from './static/FooterComponent.vue';
import ButtonDownComponent from './static/ButtonDownComponent.vue';
export default {
  name: 'App',
  components: {
    HeaderComponent,
    FooterComponent,
    ButtonDownComponent
  }
};
</script>
