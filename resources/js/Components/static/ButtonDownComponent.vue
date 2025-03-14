<template>
    <button :class="['bottom-4 md:bottom-8 fixed w-16 h-16 text-my_white bg-transparent border-2 border-my_white  rounded-full flex items-center justify-center opacity-100',
    'transition-all duration-500 transform hover:opacity-100 z-30',
    actionByttonDown ? '-right-16' : 'right-4 md:right-16'
    ]"
    :tabindex = "actionByttonDown ? '-1' : '0'"
    @click="navigateDown"
    >
        <i class="fa-solid fa-arrow-down fa-2x"></i>
        <span class="absolute -inset-6 w-[200%] h-[200%] -z-10 bg-my_black blur-2xl opacity-30 rounded-full"></span>
    </button>
</template>

<script>
import { computed, ref, watch } from 'vue';
import { usePageState } from '../../store/pageState';
export default{
    name: 'ButtonDownComponent',

    setup(){
        const pageState = usePageState();
        const actionByttonDown = ref(false);
        const isTop = computed(() => pageState.currentBlock === 0);
        const isBottom = computed(() => pageState.currentBlock === pageState.totalBlocks - 1);

        watch(isTop, (newValue) => {
            actionByttonDown.value = !newValue;
        });

        const navigateDown = () => {
            if (!isBottom.value) {
                pageState.updateCurrentBlock(pageState.currentBlock + 1);
            }else{
                pageState.toggleOverlay(true);
                pageState.disableScroll();
            }
        };
        return{actionByttonDown, navigateDown};
    }
}
</script>
