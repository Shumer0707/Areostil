<template>
    <PageWrapper v-show="translationsLoaded" :total-blocks="components.length">
        <div v-for="(component, index) in components"
             :key="component + '-' + index"
             :class="['w-full h-screen absolute transition-transform duration-1000 ease-in-out',
             isActive(index) ? 'translate-y-0' : 'translate-y-full']">

            <component :is="component" :isActive="isActive(index)" />
        </div>
    </PageWrapper>
</template>

<script setup>
import { computed, onMounted, markRaw } from 'vue';
import { useLocalizationStore } from '@/store/localization';
import PageWrapper from '../wrappers/PageWrapper.vue';
import HomeSliderComponent from '../home/HomeSliderComponent.vue';
import HomeAboutUsComponent from '../home/HomeAboutUsComponent.vue';
import HomeGaleryComponent from '../home/HomeGaleryComponent.vue';
import HomeVideoCarouselComponent from '../home/HomeVideoCarouselComponent.vue';
import { usePageState } from '@/store/pageState';

// ✅ Pinia Store
const pageState = usePageState();
const localizationStore = useLocalizationStore();

// ✅ НЕ делаем массив реактивным (markRaw)
const components = markRaw([
    HomeSliderComponent,
    HomeAboutUsComponent,
    HomeGaleryComponent,
    // HomeVideoCarouselComponent,
]);

// ✅ Проверка загрузки переводов
const translationsLoaded = computed(() => {
    return localizationStore.translations && Object.keys(localizationStore.translations).length > 0;
});

const isActive = (index) => pageState.currentBlock === index;

onMounted(() => {
    pageState.updateTotalBlocks(components.length);
});
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
