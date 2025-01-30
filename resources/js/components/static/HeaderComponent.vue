<template>
    <!-- контрольная -->
    <header
        @animationend="handleAnimationEnd"
        :class="[animationHeader,
            'fixed z-30 transition-all duration-1000 transform ease-in-out text-my_white top-0 right-0 w-full h-40 px-4 py-4',
            'md:px-8',
            'lg:px-16',
        ]"
    >
        <!-- логотип -->
        <HeaderLogoComponent></HeaderLogoComponent>
        <!-- кнопки -->
        <HeaderButtonComponent></HeaderButtonComponent>
        <!-- навигация -->
        <HeaderNavComponent></HeaderNavComponent>
        <!-- Выпадающее меню -->
        <HeaderMenuComponent></HeaderMenuComponent>

    </header>
</template>

<script>
import { computed, ref, watch } from 'vue';
import { usePageState } from '../../store/pageState';
import { useHeaderState } from '../../store/headerState';
import HeaderButtonComponent from '../header/HeaderButtonComponent.vue';
import HeaderLogoComponent from '../header/HeaderLogoComponent.vue';
import HeaderNavComponent from '../header/HeaderNavComponent.vue';
import HeaderMenuComponent from '../header/HeaderMenuComponent.vue';

export default {
    name: "HeaderComponent",
    components: {
        HeaderButtonComponent,
        HeaderLogoComponent,
        HeaderNavComponent,
        HeaderMenuComponent
    },
    setup() {
        const pageState = usePageState();
        const headerState = useHeaderState();
        const animationState = ref("animation-none");

        const isTop = computed(() => pageState.currentBlock === 0);
        const animationHeader = computed(() => headerState.animationHeader);

        watch(isTop, (newValue) => {
            if (newValue) {
                headerState.setAnimationHeader("animation-slide-up-start");
            } else {
                headerState.setAnimationHeader("animation-slide-down-start");
            }
        });

        const handleAnimationEnd = (event) => {
            if (event.animationName === "downStart") {
                animationState.value = "downEnd";
            } else if (event.animationName === "upStart") {
                animationState.value = "upEnd";
            }
        };

        return { isTop, animationState, handleAnimationEnd, animationHeader};
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

@keyframes downStart {
    0% {
        width: 100%;
        height: 10rem;
        flex-direction: row;
        padding-left: 8rem;
        padding-right: 8rem;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
    49% {
        flex-direction: row;
        justify-content:space-between;
    }
    50% {
        width: 8rem;
        height: 10rem;
        flex-direction: row;
        padding: 2rem;
        background-color: var(--color-my-black);
    }
    51% {
        flex-direction: column;
        justify-content:flex-start;
    }
    100% {
        width: 8em;
        height: 100vh;
        flex-direction: column;
        padding: 2rem;
        justify-content: flex-start;
        background-color: var(--color-my-black);
    }
}
.downEnd {
    top: 0;
    right: 0;
    height: 100vh;
    width: 8rem;
    flex-direction: column;
    padding: 2rem;
    justify-content: flex-start;
    background-color: var(--color-my-black)
}
@keyframes upStart {
    0%{
        height: 100vh;
        width: 8rem;
        flex-direction: column;
        justify-content: flex-start;
        padding: 2rem;
        background-color: var(--color-my-black);
    }
    49% {
        flex-direction: column;
        justify-content:flex-start;
    }
    50%{
        width: 8rem;
        height: 10rem;
        padding: 2rem;
        background-color: var(--color-my-black);
    }
    51% {
        flex-direction: row;
        justify-content: space-between;
    }
    100%{
        width: 100%;
        height: 10rem;
        flex-direction: row;
        padding-left: 8rem;
        padding-right: 8rem;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
}
.upEnd {
    width: 100%;
    height: 10rem;
    flex-direction: row;
    padding: 2rem 8rem;
}
.animation-slide-down-start {
    animation: downStart 2s ease-in-out forwards;
    animation-fill-mode: forwards;
}
.animation-slide-up-start {
    animation: upStart 2s ease-in-out forwards;
    animation-fill-mode: forwards;
}

</style>
