<template>
      <HeaderComponent />
      <ButtonDownComponent></ButtonDownComponent>
      <router-view /> <!-- Основной контент приложения -->
      <FooterComponent />
</template>

<script>
import HeaderComponent from '../components/static/HeaderComponent.vue';
import FooterComponent from '../components/static/FooterComponent.vue';
import ButtonDownComponent from '../components/static/ButtonDownComponent.vue';
export default {
  name: 'App',
  components: {
    HeaderComponent,
    FooterComponent,
    ButtonDownComponent
  }
};
</script>
