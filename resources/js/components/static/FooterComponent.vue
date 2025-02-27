<template>
    <div>
        <!-- Затемнение -->
        <div
            class="fixed inset-0 bg-my_black bg-opacity-70 transition-transform duration-500"
            :class="{ 'translate-y-0': pageState.showOverlay, 'translate-y-full': !pageState.showOverlay }">
        </div>
        <!-- Футер -->
        <footer
        class="w-full bg-my_black text-my_white py-8 px-10 md:px-36 fixed bottom-0 left-0 z-20
               transition-transform duration-500 ease-in-out"
        :class="{ 'translate-y-0 opacity-100': pageState.showOverlay, 'translate-y-full opacity-0': !pageState.showOverlay }">

        <!-- Верхний блок с заголовком и кнопкой -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 px-4 md:px-0">
            <h3 class="text-lg md:text-xl font-semibold text-center md:text-left">
                {{ $t('header.foter_text_1') }} <span class="text-my_pink">{{ $t('header.foter_text_2') }}</span>
            </h3>
            <a href="/contact" class="mt-3 md:mt-0 bg-my_pink text-white px-6 py-3 font-medium
                                    transition hover:bg-opacity-80">
                {{ $t('header.foter_button') }}
            </a>
        </div>
        <!-- Основной блок футера -->

        <div class="flex flex-col md:flex-row justify-between items-center gap-6 ">

            <!-- Логотип -->
            <div class="flex w-1/3 items-center gap-4">
                <a href="/" class="block w-24">
                    <img :src="$getImageUrl('/img/logo/log-1.png')" alt="Areostil logo" class="w-full">
                </a>
                <p class="text-sm text-gray-400 hidden md:block">
                    Architecture & Design Studio
                </p>
            </div>

            <!-- Навигация -->
            <nav class="flex w-1/3 gap-6 text-sm font-medium justify-center">
                <a href="/" class="hover:text-primary transition" :tabindex="pageState.showOverlay ? '0' : '-1'">{{ $t('header.home') }}</a>
                <a href="/about" class="hover:text-primary transition" :tabindex="pageState.showOverlay ? '0' : '-1'">{{ $t('header.about') }}</a>
                <a href="/galery" class="hover:text-primary transition" :tabindex="pageState.showOverlay ? '0' : '-1'">{{ $t('header.gallery') }}</a>
                <a href="/contact" class="hover:text-primary transition" :tabindex="pageState.showOverlay ? '0' : '-1'">{{ $t('header.contact') }}</a>
            </nav>

            <!-- Контакты и соцсети -->
            <div class="text-center  w-1/3 md:text-right ">
                <p class="text-sm">Phone: <a href="tel:+373987456321" class="hover:text-primary">+373 987 456 321</a></p>
                <p class="text-sm">Email: <a href="mailto:areostil_info@gmail.com" class="hover:text-primary">areostil_info@gmail.com</a></p>

                <div class="flex justify-center md:justify-end gap-4 mt-3">
                    <a href="#" class="text-gray-400 hover:text-primary transition">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-primary transition">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-primary transition">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="border-t border-gray-700 mt-6 pt-4 text-center text-xs text-gray-400">
            <p>All rights reserved &copy; 2024 Areostil</p>
        </div>
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
        const threshold = 50; // Порог в 50 пикселей

        // Проверка: если свайп не превышает порог, игнорируем его
        if (Math.abs(touchDelta) < threshold) return;

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

</style>
