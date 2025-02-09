<template>
    <main ref="container" class="w-full h-screen overflow-hidden bg-cover bg-center"
        :style="{ backgroundImage: `url(${randomBackground})` }">
        <div class="absolute inset-0 bg-primary bg-opacity-50"></div>
        <!-- Слот для рендеринга дочерних компонентов -->
        <slot />
    </main>
</template>

<script>
import { usePageState } from '@/store/pageState';
import { ref, computed } from 'vue';
export default {
  name: "PageWrapper",
  props: {
    totalBlocks: {
      type: Number,
      required: true
    }
  },
  setup() {
    const pageState = usePageState();

    // Массив с путями к изображениям
    const backgrounds = [
        '/img/back/back-1.jpg',
        '/img/back/back-2.jpg',
        '/img/back/back-3.jpg',
    ];

    // Функция для выбора случайного элемента из массива
    const randomBackground = computed(() => {
        return backgrounds[Math.floor(Math.random() * backgrounds.length)];
    });

    const handleScroll = (event) => {
      if (pageState.scrollDisabled) return; // Блокируем прокрутку, если scroll отключён
      const currentTime = Date.now();
      if (currentTime - pageState.lastScrollTime < pageState.scrollDelay) return;

      pageState.lastScrollTime = currentTime;
      if (event.deltaY > 0) {
        // Скролл вниз
        nextBlock();
        pageState.disableBlockScroll();
      } else {
        // Скролл вверх
        previousBlock();
        pageState.disableBlockScroll();
      }
    };

    const handleTouchStart = (event) => {
      if (pageState.scrollDisabled) return; // Блокируем начало свайпа
      pageState.touchStartY = event.touches[0].clientY;
    };

    const handleTouchEnd = (event) => {
      if (pageState.scrollDisabled) return; // Блокируем конец свайпа
      const touchEndY = event.changedTouches[0].clientY;
      const touchDelta = pageState.touchStartY - touchEndY;
      const currentTime = Date.now();

      if (currentTime - pageState.lastScrollTime < pageState.scrollDelay) return;

      pageState.lastScrollTime = currentTime;
        if (touchDelta > 50) {
            event.preventDefault();
            previousBlock();
            pageState.disableBlockScroll();
        } else if (touchDelta < -50) {
            event.preventDefault();
            nextBlock();
            pageState.disableBlockScroll();
        }
    };

    const nextBlock = () => {
      if (pageState.scrollDisabled) return; // Проверяем, заблокирован ли скролл
      if (pageState.currentBlock < pageState.totalBlocks - 1) {
        pageState.updateCurrentBlock(pageState.currentBlock + 1);
      }
    };

    const previousBlock = () => {
      if (pageState.scrollDisabled) return; // Проверяем, заблокирован ли скролл
      if (pageState.currentBlock > 0) {
        pageState.updateCurrentBlock(pageState.currentBlock - 1);
      }
    };

    return { pageState, handleScroll, handleTouchStart, handleTouchEnd, randomBackground };
  },
  mounted() {
    const pageState = usePageState();
    pageState.updateTotalBlocks(this.totalBlocks); // Устанавливаем общее количество блоков
    pageState.updateCurrentBlock(pageState.currentBlock);
    window.addEventListener("wheel", this.handleScroll);
    window.addEventListener("touchstart", this.handleTouchStart);
    window.addEventListener("touchend", this.handleTouchEnd);
  },
  beforeUnmount() {
    window.removeEventListener("wheel", this.handleScroll);
    window.removeEventListener("touchstart", this.handleTouchStart);
    window.removeEventListener("touchend", this.handleTouchEnd);
  }
};
</script>

<style scoped>
html, body {
  margin: 0;
  padding: 0;
  overflow: hidden;
  height: 100%;
}
</style>
