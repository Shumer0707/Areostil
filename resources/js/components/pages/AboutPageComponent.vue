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
import { usePageState } from '@/store/pageState';
import { useLocalizationStore } from '@/store/localization';
import PageWrapper from '../wrappers/PageWrapper.vue';
import CompanyComponent from '../about/CompanyComponent.vue';
import TeamComponent from '../about/TeamComponent.vue';

// ✅ Pinia Store
const pageState = usePageState();
const localizationStore = useLocalizationStore();

// ✅ НЕ делаем массив реактивным (markRaw)
const components = markRaw([
    CompanyComponent,
    TeamComponent
]);

// ✅ Проверка загрузки переводов
const translationsLoaded = computed(() => {
    return localizationStore.translations && Object.keys(localizationStore.translations).length > 0;
});

// ✅ Функция определения активного блока
const isActive = (index) => pageState.currentBlock === index;

// ✅ Лог при монтировании
onMounted(() => {
    pageState.updateTotalBlocks(components.length);
});
</script>
