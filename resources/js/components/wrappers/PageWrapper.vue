<template>
    <main ref="container" class="w-full min-h-screen overflow-hidden relative">
        <!-- Фоновое изображение -->
        <div class="absolute inset-0 bg-cover bg-center animate-background-move"
             :style="{ backgroundImage: `url(${randomBackground})` }"></div>
        <div class="absolute inset-0 bg-primary bg-opacity-50"></div>

        <!-- Контейнер с контентом -->
        <div
            class="transition-all ease-out duration-700 will-change-transform"
        >
            <slot />
        </div>
    </main>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount, watch } from 'vue';
import { usePageState } from '@/store/pageState';

// ✅ Получаем `props` с totalBlocks
const props = defineProps({
    totalBlocks: {
        type: Number,
        required: true
    }
});
const totalBlocks = ref(props.totalBlocks);
// 📌 Pinia Stores
const pageState = usePageState();

// ✅ Фоновые изображения
const backgrounds = [
    '/img/back/back-1.jpg',
    '/img/back/back-2.jpg',
    '/img/back/back-3.jpg',
];

// ✅ Выбираем случайный фон
const randomBackground = computed(() => backgrounds[Math.floor(Math.random() * backgrounds.length)]);

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
        filter: blur(0px);
        background-position: 50% 50%;
        transform: rotate(0deg) scale(1.02);
    }
    25% {
        transform: rotate(0.5deg) scale(1.03);
    }
    50% {
        filter: blur(5px);
        background-position: 49% 51%;
        transform: scale(1.02);
    }
    75% {
        transform: rotate(-0.5deg) scale(1.03);
    }
    100% {
        filter: blur(0px);
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
