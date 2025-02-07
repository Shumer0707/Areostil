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
import ContactComponent from '../contact/ContactComponent.vue'
import { usePageState } from '@/store/pageState';
import PageWrapper from '../wrappers/PageWrapper.vue';
export default {
    name: 'ContactPageComponent',

    components: {
        PageWrapper,
        ContactComponent,
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
                'ContactComponent',
            ]
        };
    }
};
</script>
