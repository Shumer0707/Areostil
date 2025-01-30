<template>
    <div
        @animationend="handleAnimationEndButton"
        :class="[
            'relative flex gap-8 transition-all duration-1000 ease-in-out items-center order-2', animationHeaderButton
        ]"
    >
        <!-- Язык переключатель -->
        <!-- <button
            :class="[
                'w-12 h-12 bg-transparent flex items-center justify-center transition-transform duration-1000 ease-in-out'
            ]"
        >
            Ru
        </button> -->
        <button
            data-id="menu-button"
            @click="headerState.toggleMainMenu"
            :class="[
                'w-16 h-16 bg-transparent border-2 border-my_white rounded-full font-bold flex items-center justify-center transition-transform duration-1000 ease-in-out'
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
        });

        // Обработчик окончания анимации
        const handleAnimationEndButton = (event) => {
            if (event.animationName === "downStartButton") {
                animationHeaderButton.value = "downEndButton";
            } else if (event.animationName === "upStartButton") {
                animationHeaderButton.value = "upEndButton";
            }
        };

        return { animationHeaderButton, handleAnimationEndButton, headerState};
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
.downEndButton {
    padding: 2rem 0 2rem 0;
    flex-direction: column;
    flex-direction: column-reverse;
    opacity: 1;
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
.upEndButton {
    flex-direction: row;
    opacity: 1
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
