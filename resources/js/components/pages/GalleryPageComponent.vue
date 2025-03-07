<template>
    <PageWrapper :total-blocks="components.length">
        <div
            v-for="(component, index) in components"
            :key="index"
            class="w-full h-screen absolute transition-transform duration-1000 ease-in-out"
            :class="{ 'translate-y-0': isActive(index), 'translate-y-full': !isActive(index) }"
        >
            <component
                :is="component.name"
                v-bind="component.props"
                :isActive="isActive(index)"
            />
        </div>
    </PageWrapper>
</template>

<script setup>
import { ref, onMounted, watch, markRaw } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
import { usePageState } from '@/store/pageState';

import PageWrapper from '../wrappers/PageWrapper.vue';
import GalleryComponent from '../gallery/GalleryComponent.vue';

// Состояние страницы (какой блок активен)
const pageState = usePageState();
const isActive = (index) => pageState.currentBlock === index;

// Текущая категория (из URL)
const route = useRoute();
const currentCategory = ref(route.params.category || 'architecture');

// Данные проектов
const projects = ref([]);

// Функция загрузки проектов из API
const fetchProjects = async () => {
    try {
        const response = await axios.get('/api/projects');
        projects.value = response.data;
    } catch (error) {
        console.error('Ошибка загрузки проектов:', error);
    }
};

// Загружаем проекты при монтировании
onMounted(fetchProjects);

// Следим за изменением `route.params.category`
watch(() => route.params.category, (newCategory) => {
    currentCategory.value = newCategory || 'architecture';
});

// Список динамических компонентов
const components = ref([
    {
        name: markRaw(GalleryComponent),
        props: {
            currentCategory,
            projects,
        }
    }
]);

// Функция для добавления новых компонентов (пример)
const addComponent = (component, props = {}) => {
    components.value.push({
        name: markRaw(component),
        props
    });
};

onMounted(() => {
    console.log(components.value.length);

    pageState.updateTotalBlocks(components.value.length);
});

</script>
