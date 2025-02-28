<template>
    <main ref="container" class="w-full min-h-screen overflow-hidden relative">
        <!-- Фоновое изображение -->
        <div class="absolute inset-0 bg-cover bg-center animate-background-move"
             :style="{ backgroundImage: `url(${randomBackground})` }"></div>
        <div class="absolute inset-0 bg-primary bg-opacity-50"></div>

        <!-- Контейнер с контентом -->
        <div
            v-if="translationsLoaded"
            class="transition-all ease-out duration-700 will-change-transform"
            :class="{ 'opacity-100 translate-y-0': showContent, 'opacity-0 translate-y-4': !showContent }"
        >
            <slot />
        </div>

        <!-- Лоадер -->
        <div
            v-if="!translationsLoaded"
            class="flex justify-center items-center h-full transition-opacity duration-500 ease-in"
        >
            <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-white"></div>
        </div>
    </main>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { usePageState } from '@/store/pageState';
import { useLocalizationStore } from '@/store/localization';

// ✅ Получаем `props` с totalBlocks
const props = defineProps({
    totalBlocks: {
        type: Number,
        required: true
    }
});

// 📌 Pinia Stores
const pageState = usePageState();
const localizationStore = useLocalizationStore();
// Флаг для активации анимации
const showContent = ref(false);

// ✅ Проверяем, загружены ли переводы
const translationsLoaded = computed(() => {
    return localizationStore.translations && Object.keys(localizationStore.translations).length > 0;
});

// ✅ Загружаем переводы при монтировании
onMounted(async () => {
    if (!translationsLoaded.value) {
        await localizationStore.fetchTranslations();
    }
    // Даем Vue отрендерить div, а затем включаем анимацию
    setTimeout(() => {
        showContent.value = true;
    }, 10);
});

// ✅ Фоновые изображения
const backgrounds = [
    '/img/back/back-1.jpg',
    '/img/back/back-2.jpg',
    '/img/back/back-3.jpg',
];

// ✅ Выбираем случайный фон
const randomBackground = computed(() => backgrounds[Math.floor(Math.random() * backgrounds.length)]);

// ✅ Обновляем количество блоков в `pageState`
onMounted(() => {
    pageState.updateTotalBlocks(props.totalBlocks); // 👈 Теперь используем `props.totalBlocks`
    pageState.updateCurrentBlock(pageState.currentBlock);
});

// ✅ Переключение блоков
const nextBlock = () => {
    if (!pageState.scrollDisabled && pageState.currentBlock < props.totalBlocks - 1) {
        pageState.updateCurrentBlock(pageState.currentBlock + 1);
        pageState.disableBlockScroll();
    }
};

const previousBlock = () => {
    if (!pageState.scrollDisabled && pageState.currentBlock > 0) {
        pageState.updateCurrentBlock(pageState.currentBlock - 1);
        pageState.disableBlockScroll();
    }
};

// ✅ Обработка скролла
const handleScroll = (event) => {
    if (pageState.scrollDisabled) return;
    const currentTime = Date.now();
    if (currentTime - pageState.lastScrollTime < pageState.scrollDelay) return;

    pageState.lastScrollTime = currentTime;
    event.deltaY > 0 ? nextBlock() : previousBlock();
};

// ✅ Обработка свайпа
const touchStartY = ref(0);

const handleTouchStart = (event) => {
    if (pageState.scrollDisabled) return;
    touchStartY.value = event.touches[0].clientY;
};

const handleTouchEnd = (event) => {
    if (pageState.scrollDisabled) return;
    const touchEndY = event.changedTouches[0].clientY;
    const touchDelta = touchStartY.value - touchEndY;
    const currentTime = Date.now();

    if (currentTime - pageState.lastScrollTime < pageState.scrollDelay) return;

    pageState.lastScrollTime = currentTime;
    if (touchDelta > 50) {
        nextBlock();
    } else if (touchDelta < -50) {
        previousBlock();
    }
};

// ✅ Подключаем обработчики событий
onMounted(() => {
    window.addEventListener("wheel", handleScroll);
    window.addEventListener("touchstart", handleTouchStart);
    window.addEventListener("touchend", handleTouchEnd);
});

// ✅ Очищаем обработчики событий при размонтировании
onBeforeUnmount(() => {
    window.removeEventListener("wheel", handleScroll);
    window.removeEventListener("touchstart", handleTouchStart);
    window.removeEventListener("touchend", handleTouchEnd);
});
</script>

<style scoped>
@keyframes background-move {
    0% {
        background-position: 50% 50%;
        transform: rotate(0deg) scale(1.02);
    }
    25% {
        background-position: 52% 48%;
        transform: rotate(1deg) scale(1.04);
    }
    50% {
        background-position: 48% 52%;
        transform: rotate(-1deg) scale(1.02);
    }
    75% {
        background-position: 51% 49%;
        transform: rotate(0.5deg) scale(1.04);
    }
    100% {
        background-position: 50% 50%;
        transform: rotate(0deg) scale(1.02);
    }
}

.animate-background-move {
    animation: background-move 15s ease-in-out infinite alternate;
    width: 110%;
    height: 110%;
    position: absolute;
    top: -5%;
    left: -5%;
    background-size: cover;
}
</style>
