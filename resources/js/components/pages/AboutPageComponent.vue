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
import CompanyComponent from '../about/CompanyComponent.vue';
import TeamComponent from '../about/TeamComponent.vue';
import { usePageState } from '@/store/pageState';
import PageWrapper from '../wrappers/PageWrapper.vue';
export default {
    name: 'AboutPageComponent',

    components: {
        PageWrapper,
        CompanyComponent,
        TeamComponent
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
                'CompanyComponent',
                'TeamComponent'
            ]
        };
    }
};
</script>
