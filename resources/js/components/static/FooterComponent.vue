<template>
    <div>
        <!-- Затемнение -->
        <div
            v-if="showOverlay"
            class="fixed inset-0 bg-my_black bg-opacity-70 transition-opacity duration-500"
            :class="{ 'opacity-100': showOverlay, 'opacity-0': !showOverlay }">
        </div>
        <!-- Футер -->
        <footer
            class="w-full bg-my_black text-my_white py-6 fixed bottom-0 left-0 z-50 transition-transform duration-500"
            :class="{ 'translate-y-0': showOverlay, 'translate-y-full': !showOverlay }">
            <div class="w-full px-32 flex justify-between items-center text-ml">
                <div class=" font-bold text-primary">
                    <a href=""><img :src="$getImageUrl('/img/logo/log-1.png')" alt="Areostil logo" class="w-32 h-32"></a>
                </div>
                <nav class="flex gap-4">
                    <a href="/" class="hover:underline">Home</a>
                    <a href="/about" class="hover:underline">About</a>
                    <a href="/galery" class="hover:underline">Galery</a>
                    <a href="/contact" class="hover:underline">Contact</a>
                </nav>
                <div >
                    <p class="py-2">Phone: +373987456321</p>
                    <p class="py-2">Email: areostil_info@gmail.com</p>
                </div>
            </div>
            <p class="text-sm block px-32 py-2">All rights reserved &copy; 2024</p>
        </footer>
    </div>
</template>

<script>
export default {
  name: "FooterComponent",
  inject: ['currentBlock', 'totalBlocks', 'disableScroll', 'enableScroll'], // Получаем данные от App.vue
  data() {
    return {
      showOverlay: false, // Флаг, указывающий, должен ли отображаться футер и затемнение
      lastScrollDirection: null, // Направление последнего скролла
      touchStartY: 0 // Начальная позиция касания для отслеживания свайпов
    };
  },
  computed: {
    currentBlockValue() {
      return this.currentBlock(); // Вызываем функцию, чтобы получить значение
    },
    totalBlocksValue() {
      return this.totalBlocks(); // Вызываем функцию, чтобы получить значение
    },
  },
  methods: {
    handleScroll(event) {
      // Определяем направление скролла
      const direction = event.deltaY > 0 ? 'down' : 'up';
      this.lastScrollDirection = direction;
      console.log('[Footer Scroll] Direction:', direction);

      // Проверяем, достигнут ли последний блок и направление скролла
      if (this.currentBlockValue === this.totalBlocksValue - 1) {
        if (direction === 'down' && !this.showOverlay) {
          this.showOverlay = true;
          this.disableScroll(); // Блокируем скролл
          console.log('[Footer Method] showOverlay set to true');
        } else if (direction === 'up' && this.showOverlay) {
          this.showOverlay = false;
          this.enableScroll(); // Разблокируем скролл
          console.log('[Footer Method] showOverlay set to false');
        }
      }
    },
    handleTouchStart(event) {
      this.touchStartY = event.touches[0].clientY;
    },
    handleTouchEnd(event) {
      const touchEndY = event.changedTouches[0].clientY;
      const touchDelta = this.touchStartY - touchEndY;
      const direction = touchDelta > 0 ? 'down' : 'up';
      this.lastScrollDirection = direction;
      console.log('[Footer Touch] Direction:', direction);

      // Проверяем, достигнут ли последний блок и направление свайпа
      if (this.currentBlockValue === this.totalBlocksValue - 1) {
        if (direction === 'down' && !this.showOverlay) {
          this.showOverlay = true;
          this.disableScroll(); // Блокируем скролл
          console.log('[Footer Method] showOverlay set to true via touch');
        } else if (direction === 'up' && this.showOverlay) {
          this.showOverlay = false;
          this.enableScroll(); // Разблокируем скролл
          console.log('[Footer Method] showOverlay set to false via touch');
        }
      }
    }
  },
  mounted() {
    console.log('[Footer Mounted] Initializing...');
    window.addEventListener('wheel', this.handleScroll); // Слушаем событие скролла
    window.addEventListener('touchstart', this.handleTouchStart); // Слушаем начало свайпа
    window.addEventListener('touchend', this.handleTouchEnd); // Слушаем конец свайпа
  },
  beforeDestroy() {
    window.removeEventListener('wheel', this.handleScroll); // Убираем слушатель события при уничтожении компонента
    window.removeEventListener('touchstart', this.handleTouchStart); // Убираем слушатель свайпа
    window.removeEventListener('touchend', this.handleTouchEnd); // Убираем слушатель конца свайпа
  }
};
</script>


<style>
footer {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  z-index: 50;
  transform: translateY(100%);
}

.opacity-0 {
  opacity: 0;
}

.opacity-100 {
  opacity: 1;
}
</style>
