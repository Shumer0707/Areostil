<template>
    <div>
        <!-- Затемнение -->
        <div
            class="fixed inset-0 bg-my_black bg-opacity-70 transition-transform duration-500"
            :class="{ 'translate-y-0': pageState.showOverlay, 'translate-y-full': !pageState.showOverlay }">
        </div>
        <!-- Футер -->
        <footer
            class="w-full bg-my_black text-my_white py-6 fixed bottom-0 left-0 z-50 transition-transform duration-500"
            :class="{ 'translate-y-0': pageState.showOverlay, 'translate-y-full': !pageState.showOverlay }">
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
import { usePageState } from '@/store/pageState';

export default {
  name: "FooterComponent",
  setup() {
    const pageState = usePageState();

    const handleScroll = (event) => {
      const direction = event.deltaY > 0 ? 'down' : 'up';

      if (pageState.currentBlock === pageState.totalBlocks - 1) {
        if (direction === 'down' && !pageState.showOverlay) {
          if (pageState.scrollDisabled) return; // Проверяем, заблокирован ли скролл
          pageState.toggleOverlay(true);
          pageState.disableScroll();
        } else if (direction === 'up' && pageState.showOverlay) {
          pageState.toggleOverlay(false);
          pageState.enableScroll();
        }
      }
    };

    const handleTouchStart = (event) => {
      pageState.touchStartY = event.touches[0].clientY;
    };

    const handleTouchEnd = (event) => {
      const touchEndY = event.changedTouches[0].clientY;
      const touchDelta = pageState.touchStartY - touchEndY;
      const direction = touchDelta > 0 ? 'down' : 'up';

      if (pageState.currentBlock === pageState.totalBlocks - 1) {
        if (direction === 'down' && !pageState.showOverlay) {
          pageState.toggleOverlay(true);
          pageState.disableScroll();
        } else if (direction === 'up' && pageState.showOverlay) {
          pageState.toggleOverlay(false);
          pageState.enableScroll();
        }
      }
    };

    window.addEventListener('wheel', handleScroll);
    window.addEventListener('touchstart', handleTouchStart);
    window.addEventListener('touchend', handleTouchEnd);

    return { pageState };
  },
  beforeUnmount() {
    window.removeEventListener('wheel', this.handleScroll);
    window.removeEventListener('touchstart', this.handleTouchStart);
    window.removeEventListener('touchend', this.handleTouchEnd);
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
