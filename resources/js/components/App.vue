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
  },
  data() {
    return {
      currentBlock: 0, // Текущий активный блок
      totalBlocks: 0   // Общее количество блоков на странице
    };
  },
  provide() {
    return {
      // Делаем доступными для всех дочерних компонентов
      currentBlock: () => this.currentBlock,
      totalBlocks: () => this.totalBlocks,
      disableScroll: this.disableScroll,
      enableScroll: this.enableScroll
    };
  },
  methods: {
    // Обновляет глобальное состояние блоков
    updateCurrentBlock(current, total) {
      this.currentBlock = current;
      this.totalBlocks = total;
    }
  }
};
</script>
