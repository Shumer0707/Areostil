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
import HomeSliderComponent from '../home/HomeSliderComponent.vue';
import HomeAboutUsComponent from '../home/HomeAboutUsComponent.vue';
import HomeGaleryComponent from '../home/HomeGaleryComponent.vue';
import HomeVideoCarouselComponent from '../home/HomeVideoCarouselComponent.vue';
import { usePageState } from '@/store/pageState';

export default {
    name: 'HomeComponent',

    components: {
        PageWrapper,
        HomeSliderComponent,
        HomeAboutUsComponent,
        HomeGaleryComponent,
        // HomeVideoCarouselComponent,
    },

    setup() {
        const pageState = usePageState();

        const isActive = (index) => {
            // Определяем, активен ли текущий компонент
            return pageState.currentBlock === index;
        };

        return { pageState, isActive };
    },

    data() {
        return {
            components: [
                'HomeSliderComponent',
                'HomeAboutUsComponent',
                'HomeGaleryComponent',
                // 'HomeVideoCarouselComponent'
            ]
        };
    }
};
</script>

<style>
/* .w-full.h-screen {
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
} */
</style>
