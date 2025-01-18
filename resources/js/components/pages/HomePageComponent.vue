<template>
    <PageWrapper :total-blocks="components.length">
        <div v-for="(component, index) in components"
             :key="index"
             :class="['w-full h-screen absolute transition-transform duration-1000 ease-in-out',
                      isActive(index) ? 'translate-y-0' : 'translate-y-full']">
            <component :is="component" :isActive="isActive(index)" />
        </div>
    </PageWrapper>
</template>

<script>
import PageWrapper from '../wrappers/PageWrapper.vue';
import SliderComponent from '../home/SliderComponent.vue';
import AboutUsComponent from '../home/AboutUsComponent.vue';
import GaleryComponent from '../home/GaleryComponent.vue';
import VideoCarouselComponent from '../home/VideoCarouselComponent.vue';

export default {
    name: 'HomeComponent',

    components: {
        PageWrapper,
        SliderComponent,
        AboutUsComponent,
        GaleryComponent,
        VideoCarouselComponent,
    },

    data() {
        return {
            components: [
                'SliderComponent',
                'AboutUsComponent',
                'GaleryComponent',
                'VideoCarouselComponent'
            ]
        };
    },

    inject: ['currentBlock'], // Получаем текущий блок из PageWrapper

    methods: {
        isActive(index) {
            // Определяем, активен ли текущий компонент
            return this.currentBlock() === index;
        }
    },
};
</script>

<style>
html, body {
    margin: 0;
    padding: 0;
    overflow: hidden;
    height: 100%;
}

.w-full.h-screen {
    top: 0;
    left: 0;
}

.absolute {
    position: absolute;
}

.translate-y-0 {
    transform: translateY(0);
}

.translate-y-full {
    transform: translateY(100%);
}
</style>
