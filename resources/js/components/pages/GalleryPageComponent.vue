<template>
    <PageWrapper :total-blocks="components.length">
        <div v-for="(component, index) in components"
             :key="index"
             :class="['w-full h-screen absolute transition-transform duration-1000 ease-in-out',
                      isActive(index) ? 'translate-y-0' : 'translate-y-full']">
            <component :is="component.name" v-bind="component.props" :isActive="isActive(index)" />
        </div>
    </PageWrapper>
</template>

<script>
import GalleryComponent from '../gallery/GalleryComponent.vue';
import { usePageState } from '@/store/pageState';
import PageWrapper from '../wrappers/PageWrapper.vue';
import { markRaw } from 'vue';

export default {
    name: 'GalleryPageComponent',

    components: {
        PageWrapper,
        GalleryComponent
    },

    setup() {
        const pageState = usePageState();

        const isActive = (index) => pageState.currentBlock === index;

        const mockData = {
            architecture: [
                { id: 1, name: 'Проект А1', details: 'Описание А1', image: '/img/home/about/right.jpg' },
                { id: 2, name: 'Проект А2', details: 'Описание А2', image: '/img/home/about/right.jpg' },
                { id: 3, name: 'Проект А3', details: 'Описание А3', image: '/img/home/about/right.jpg' },
                { id: 4, name: 'Проект А4', details: 'Описание А4', image: '/img/home/about/right.jpg' },
                { id: 5, name: 'Проект А5', details: 'Описание А5', image: '/img/home/about/right.jpg' }
            ],
            engineering: [
                { id: 6, name: 'Проект И1', details: 'Описание И1', image: '/img/home/about/right.jpg' },
                { id: 7, name: 'Проект И2', details: 'Описание И2', image: '/img/home/about/right.jpg' },
                { id: 8, name: 'Проект И3', details: 'Описание И3', image: '/img/home/about/right.jpg' },
                { id: 9, name: 'Проект И4', details: 'Описание И4', image: '/img/home/about/right.jpg' },
                { id: 10, name: 'Проект И5', details: 'Описание И5', image: '/img/home/about/right.jpg' }
            ],
            design: [
                { id: 11, name: 'Проект Д1', details: 'Описание Д1', image: '/img/home/about/right.jpg' },
                { id: 12, name: 'Проект Д2', details: 'Описание Д2', image: '/img/home/about/right.jpg' },
                { id: 13, name: 'Проект Д3', details: 'Описание Д3', image: '/img/home/about/right.jpg' },
                { id: 14, name: 'Проект Д4', details: 'Описание Д4', image: '/img/home/about/right.jpg' },
                { id: 15, name: 'Проект Д5', details: 'Описание Д5', image: '/img/home/about/right.jpg' }
            ]
        };

        const components = [
            {
                name: markRaw(GalleryComponent),
                props: {
                    title: 'architecture',
                    description: 'Детали архитектурных проектов',
                    allItems: mockData  // Исправлено название пропа для соответствия дочернему компоненту
                }
            }
        ];

        return { pageState, isActive, components };
    }
};
</script>
