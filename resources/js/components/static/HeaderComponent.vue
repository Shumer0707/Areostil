<template>
    <header
        :class="[
            'fixed z-30 transition-all duration-1000 transform ease-in-out text-white',
            isTop && !isTransitioning ? 'top-0 right-0 w-full h-40 flex-row px-32 py-8' :
            isTransitioning ? 'top-0 right-0 w-36 h-40 flex-row px-8 py-8 bg-my_black' :
            'top-0 right-0 h-screen flex-col py-8 px-8 bg-my_black'
        ]"
    >
        <div
            :class="[
                'text-xl font-bold transition-all duration-500 ease-in-out flex items-center justify-center ',
                isTop && !isTransitioning ? 'opacity-100 scale-100 w-32 h-32' :
                isTransitioning ? 'opacity-0 scale-50 w-20 h-20' :
                'opacity-100 scale-100 w-20 h-20 mx-auto'
            ]"
        >
            <a href=""><img :src="$getImageUrl('/img/logo/log-1.png')" alt="Areostil logo" class=""></a>
        </div>
        <!-- кнопки -->
        <div
            :class="[
                'flex gap-8 transition-all duration-1000 ease-in-out items-center',
                isTop ? 'flex-row': 'flex-col py-8 flex-col-reverse'
            ]"
        >
            <!-- язык -->
            <button
                :class="[
                    'w-12 h-12 bg-transparent rounded-full flex items-center justify-center border-2 border-white transition-transform duration-1000 ease-in-out',
                    isTop && !isTransitioning ? 'scale-100' :
                    isTransitioning ? 'scale-50' :
                    'scale-100'
                ]"
            >
                Ru
            </button>
            <!-- меню -->
            <button
                :class="[
                    'w-16 h-16 bg-transparent border-2 border-white rounded-full font-bold flex items-center justify-center transition-transform duration-1000 ease-in-out',
                    isTop && !isTransitioning ? 'scale-100' :
                    isTransitioning ? 'scale-50' :
                    'scale-100'
                ]"
            >
                ☰
            </button>
        </div>
    </header>
</template>

<script>
import { computed, ref, watch } from 'vue';
import { usePageState } from '../../store/pageState';

export default {
    name: "HeaderComponent",

    setup() {
        const pageState = usePageState();
        const isTransitioning = ref(false); // Флаг для анимации

        const isTop = computed(() => pageState.currentBlock === 0);

        // Следим за изменением блока
        watch(isTop, (newValue) => {
            if (!newValue) {
                isTransitioning.value = true;
                setTimeout(() => {
                    isTransitioning.value = false; // Завершение анимации
                }, 1000);
            } else {
                isTransitioning.value = true;
                setTimeout(() => {
                    isTransitioning.value = false; // Завершение
                }, 1000);
            }
        });

        return { isTop, isTransitioning};
    }
};
</script>

<style scoped>
header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

header.flex-col {
    justify-content: flex-start;
}
</style>
