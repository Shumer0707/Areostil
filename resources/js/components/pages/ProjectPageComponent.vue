<template>
    <PageWrapper :total-blocks="components.length">
        <div v-for="(component, index) in components"
             :key="component + '-' + index"
             :class="['w-full h-screen absolute transition-transform duration-1000 ease-in-out',
             isActive(index) ? 'translate-y-0' : 'translate-y-full']">

            <component :is="component" :isActive="isActive(index)" :project="project" v-if="project"/>
        </div>
    </PageWrapper>
</template>

<script setup>
import { ref, onMounted, markRaw } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';
import PageWrapper from '../wrappers/PageWrapper.vue';
import ProjectComponent from '../projectpage/ProjectComponent.vue';
import { usePageState } from '@/store/pageState';

// ✅ Получаем `id` из роута
const route = useRoute();
const project = ref(null);
const pageState = usePageState();

// ✅ НЕ делаем массив реактивным (markRaw)
const components = markRaw([ProjectComponent]);

const isActive = (index) => pageState.currentBlock === index;

// ✅ Загружаем проект при монтировании
onMounted(async () => {
    try {
        const response = await axios.get(`/api/projects/${route.params.id}`);
        project.value = response.data;
    } catch (error) {
        console.error('Ошибка загрузки проекта:', error);
    }
    pageState.updateTotalBlocks(components.length);
});
</script>
