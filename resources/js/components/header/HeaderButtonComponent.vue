<template>
    <div
        :class="[
            'relative flex gap-8 transition-all duration-1000 ease-in-out items-center order-2', animationHeaderButton
        ]"
    >
        <div class="hidden">
            <button class="w-12 h-12"></button>
        </div>
        <button
            @click="headerState.toggleMainMenu"
            :class="[
                'bg-transparent border-2 border-my_white rounded-full font-bold flex items-center justify-center transition-all duration-1000 ease-in-out',
                animationHeaderButton === 'animation-slide-down-start-button' ? 'md:w-16 md:h-16 w-12 h-12' : 'w-16 h-16',
            ]"
        >
            ☰
        </button>
    </div>
</template>

<script>
import { computed, ref, watch } from 'vue';
import { useHeaderState } from '../../store/headerState';

export default {
    name: 'HeaderButtonComponent',

    setup() {

        // Управление состоянием заголовка
        const animationHeaderButton = ref("animation-none-button");
        const headerState = useHeaderState();

        // Реактивное значение для текущей анимации заголовка
        const animationHeader = computed(() => headerState.animationHeader);

        // Наблюдение за изменениями состояния анимации заголовка
        watch(animationHeader, (newValue) => {
            if(newValue === 'animation-slide-up-start'){
                animationHeaderButton.value = 'animation-slide-up-start-button';
            }else if(newValue === 'animation-slide-down-start'){
                animationHeaderButton.value = 'animation-slide-down-start-button';
            }
            console.log(animationHeaderButton.value);

        });

        const buttonSizeClass = computed(() => {
            return animationHeaderButton.value === 'animation-slide-down-start-button' ? 'w-12 h-12' : 'w-16 h-16';
        });

        return { animationHeaderButton, headerState, buttonSizeClass};
    }
};
</script>

<style scoped>
/* Анимация для кнопки, когда меню сворачивается вниз */
@keyframes downStartButton {
    0% {
        opacity: 1;
    }
    20% {
        opacity: 0;
        flex-direction: row;
    }
    60% {
        flex-direction: column;
        flex-direction: column-reverse;
        opacity: 0;
        padding: 0;
    }
    100% {
        padding: 2rem 0 2rem 0;
        flex-direction: column;
        flex-direction: column-reverse;
        opacity: 1;
    }
}
/* Анимация для кнопки, когда меню разворачивается вверх */
@keyframes upStartButton {
    0%{
        padding: 2rem 0 2rem 0;
        flex-direction: column;
        flex-direction: column-reverse;
        opacity: 1;
    }
    20% {
        flex-direction: column;
        flex-direction: column-reverse;
        opacity: 0;
        padding: 0;
    }
    60% {
        flex-direction: row;
        opacity: 0;
    }
    100%{
        flex-direction: row;
        opacity: 1;
    }
}

/* Класс для анимации сворачивания вниз */
.animation-slide-down-start-button {
    animation: downStartButton 2s ease-in-out forwards;
    animation-fill-mode: forwards;
}

/* Класс для анимации разворачивания вверх */
.animation-slide-up-start-button {
    animation: upStartButton 2s ease-in-out forwards;
    animation-fill-mode: forwards;
}
</style>
