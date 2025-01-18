<template>
    <main ref="container" class="w-full h-screen overflow-hidden bg-cover bg-center"
        :style="{ backgroundImage: 'url(/img/home/about/back.jpg)' }">
        <div class="absolute inset-0 bg-primary bg-opacity-50"></div>
      <!-- Слот для рендеринга дочерних компонентов -->
      <slot />
    </main>
  </template>

  <script>
  export default {
    name: "PageWrapper",
    props: {
      totalBlocks: {
        type: Number,
        required: true
      }
    },
    mounted() {
      // Устанавливаем общее количество блоков в глобальное состояние
      this.$root.updateCurrentBlock(this.$root.currentBlock, this.totalBlocks);

      // Добавляем обработчики событий
      window.addEventListener("wheel", this.handleScroll);
      window.addEventListener("touchstart", this.handleTouchStart);
      window.addEventListener("touchend", this.handleTouchEnd);
    },
    beforeDestroy() {
      // Удаляем обработчики событий
      window.removeEventListener("wheel", this.handleScroll);
      window.removeEventListener("touchstart", this.handleTouchStart);
      window.removeEventListener("touchend", this.handleTouchEnd);
    },
    data() {
      return {
        lastScrollTime: 0, // Время последнего события прокрутки
        scrollDelay: 1000, // Задержка между прокрутками (в миллисекундах)
        touchStartY: 0 // Начальная позиция касания для отслеживания свайпов
      };
    },
    methods: {
      handleScroll(event) {
        const currentTime = Date.now();
        if (currentTime - this.lastScrollTime < this.scrollDelay) return;

        this.lastScrollTime = currentTime;
        if (event.deltaY > 0) {
          // Скролл вниз
          this.nextBlock();
        } else {
          // Скролл вверх
          this.previousBlock();
        }
      },
      handleTouchStart(event) {
        // Сохраняем начальную позицию касания
        this.touchStartY = event.touches[0].clientY;
      },
      handleTouchEnd(event) {
        const touchEndY = event.changedTouches[0].clientY;
        const touchDelta = this.touchStartY - touchEndY;
        const currentTime = Date.now();

        if (currentTime - this.lastScrollTime < this.scrollDelay) return;

        this.lastScrollTime = currentTime;
        if (touchDelta > 50) {
          // Свайп вверх
          this.nextBlock();
        } else if (touchDelta < -50) {
          // Свайп вниз
          this.previousBlock();
        }
      },
      nextBlock() {
        if (this.$root.currentBlock < this.totalBlocks - 1) {
          this.$root.currentBlock++;
        }
      },
      previousBlock() {
        if (this.$root.currentBlock > 0) {
          this.$root.currentBlock--;
        }
      }
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
