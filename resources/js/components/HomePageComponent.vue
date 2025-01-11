<template>
    <div ref="container" class="w-full h-screen overflow-hidden">
        <div v-for="(component, index) in components" :key="index" class="w-full h-screen">
            <component :is="component" />
        </div>
    </div>
</template>

<script>
import SliderComponent from './home/SliderComponent.vue';
import AboutUsComponent from './home/AboutUsComponent.vue';
import GaleryComponent from './home/GaleryComponent.vue';
import VideoCarouselComponent from './home/VideoCarouselComponent.vue';

export default {
    name: 'HomeComponent',

    components: {
        SliderComponent,
        AboutUsComponent,
        GaleryComponent,
        VideoCarouselComponent
    },

    data() {
        return {
            components: [
                'SliderComponent',
                'AboutUsComponent',
                'GaleryComponent',
                // 'VideoCarouselComponent'
            ],
            currentIndex: 0,
            lastScrollTime: 0, // Время последней прокрутки
            scrollDelay: 1000, // Задержка между прокрутками (в миллисекундах)
            touchStartY: 0 // Начальная позиция касания
        };
    },

    mounted() {
        window.addEventListener('wheel', this.handleScroll);
        window.addEventListener('touchstart', this.handleTouchStart);
        window.addEventListener('touchend', this.handleTouchEnd);
    },

    beforeDestroy() {
        window.removeEventListener('wheel', this.handleScroll);
        window.removeEventListener('touchstart', this.handleTouchStart);
        window.removeEventListener('touchend', this.handleTouchEnd);
    },

    methods: {
        handleScroll(event) {
            const currentTime = Date.now();
            if (currentTime - this.lastScrollTime < this.scrollDelay) return;

            this.lastScrollTime = currentTime;
            if (event.deltaY > 0) {
                this.nextBlock();
            } else {
                this.previousBlock();
            }
        },

        handleTouchStart(event) {
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
            if (this.currentIndex < this.components.length - 1) {
                this.currentIndex++;
                this.scrollToBlock();
            }
        },

        previousBlock() {
            if (this.currentIndex > 0) {
                this.currentIndex--;
                this.scrollToBlock();
            }
        },

        scrollToBlock() {
            const container = this.$refs.container;
            if (!container) return; // Проверяем, существует ли контейнер

            const targetPosition = this.currentIndex * window.innerHeight;
            container.scrollTo({ top: targetPosition, behavior: 'smooth' });
        }
    }
};
</script>

<style>
html, body {
    margin: 0;
    padding: 0;
    overflow: hidden;
    height: 100%;
}
</style>
