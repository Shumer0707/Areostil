<template>
    <div @animationend="handleAnimationEndNav"
        :class = "['bottom-4 flex justify-center gap-4 flex-col order-3 fixed opacity-0 pointer-events-none',
        animationHeaderNav,
        ]"
    >
        <!-- кнопка вверх -->
        <button
            :class="[' w-16 h-16 text-my_white bg-transparent border-2 border-my_white rounded-full flex items-center justify-center opacity-50',
            'duration-300 hover:opacity-100',
            ]"
            :tabindex = "actionButtonUp ? '0' : '-1'"
            @click="navigateUp">
            <i class="fa-solid fa-arrow-up fa-2x"></i>
        </button>
         <!-- точки -->
        <button
            v-for="(totalBlock, index) in totalBlock"
            :key="'indicator-' + index"
            @click="updateBlock(index)"
            :tabindex = "actionButtonUp ? '0' : '-1'"
            :class="['w-4 h-4 rounded-full mx-auto flex border-2 border-my_white cursor-pointer transition-all duration-300 opacity-50',
            pageState.currentBlock === index ? 'bg-my_white' : '', 'hover:opacity-100'
            ]"
        ></button>
        <!-- кнопка вниз -->
        <button
            :class="[' w-16 h-16 text-my_white bg-transparent border-2 border-my_white rounded-full flex items-center justify-center opacity-50',
            'duration-300 hover:opacity-100',
            ]"
            :tabindex = "actionButtonUp ? '0' : '-1'"
            @click="navigateDown">
            <i class="fa-solid fa-arrow-down fa-2x"></i>
        </button>
    </div>
</template>

<script>
import { computed, ref, watch } from 'vue';
import { usePageState } from '../../store/pageState';
import { useHeaderState } from '../../store/headerState';
export default{

    name: 'HeaderNavComponent',

    setup(){
        const pageState = usePageState();
        const headerState = useHeaderState();
        const totalBlock = computed(() => pageState.totalBlocks);
        const isTop = computed(() => pageState.currentBlock === 0);
        const isBottom = computed(() => pageState.currentBlock === pageState.totalBlocks - 1);
        const actionButtonUp = ref(false);
        const actionButtonDown = ref(false);
        const animationHeaderNav = ref("animation-none-nav");
        const animationHeader = computed(() => headerState.animationHeader);
        // управление анимацией
        watch(animationHeader, (newValue) => {
            if(newValue === 'animation-slide-up-start'){
                animationHeaderNav.value = 'animation-slide-up-start-nav';
            }else if(newValue === 'animation-slide-down-start'){
                animationHeaderNav.value = 'animation-slide-down-start-nav';
            }
        });
        const handleAnimationEndNav = (event) => {
            if (event.animationName === "downStartNav") {
                animationHeaderNav.value = "downEndNav";
            } else if (event.animationName === "upStartNav") {
                animationHeaderNav.value = "upEndNav";
            }
        };
        // управление навигацие
        watch(isTop, (newValue) => {
            actionButtonUp.value = !newValue;
        });

        watch(isBottom, (newValue) => {
            actionButtonDown.value = !newValue;
        });

        const navigateUp = () => {
            if (pageState.showOverlay) {
                pageState.toggleOverlay(false);
                pageState.enableScroll();
            }
            else if (!isTop.value) {
                pageState.updateCurrentBlock(pageState.currentBlock - 1);
            }
        };

        const navigateDown = () => {
            if (!isBottom.value) {
                pageState.updateCurrentBlock(pageState.currentBlock + 1);
            }else{
                pageState.toggleOverlay(true);
                pageState.disableScroll();
            }
        };

        const updateBlock = (index) => {
            pageState.updateCurrentBlock(index);
            pageState.toggleOverlay(false);
            pageState.enableScroll();
        };

        return { totalBlock,
            actionButtonUp,
            actionButtonDown,
            navigateUp,
            navigateDown,
            updateBlock,
            animationHeaderNav,
            handleAnimationEndNav,
            pageState
        };
    }
}
</script>

<style scoped>
@keyframes downStartNav {
    0% {
        opacity: 0;
    }
    70% {
        opacity: 0;
    }
    100% {
        pointer-events: all;
        opacity: 1;
    }
}
.downEndNav {
    pointer-events: all;
    opacity: 1;
}
@keyframes upStartNav {
    0% {
        opacity: 1;
    }
    30% {
        opacity: 0;
    }
    100% {
        opacity: 0;
        pointer-events: none;
    }
}
.upEndNav {
    pointer-events: none;
    opacity: 0;
}
.animation-slide-down-start-nav {
    animation: downStartNav 2s ease-in-out forwards;
    animation-fill-mode: forwards;
}
.animation-slide-up-start-nav {
    animation: upStartNav 2s ease-in-out forwards;
    animation-fill-mode: forwards;
}

</style>
