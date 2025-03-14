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

<script setup>
import { onMounted, markRaw } from 'vue';
import ContactComponent from '../contact/ContactComponent.vue'
import { usePageState } from '@/store/pageState';
import PageWrapper from '../wrappers/PageWrapper.vue';

const pageState = usePageState();

// ✅ НЕ делаем массив реактивным (markRaw)
const components = markRaw([
    ContactComponent
]);

const isActive = (index) => pageState.currentBlock === index;

onMounted(() => {
    pageState.updateTotalBlocks(components.length);
});
</script>
