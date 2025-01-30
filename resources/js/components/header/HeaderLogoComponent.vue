<template>
    <div
        @animationend="handleAnimationEndLogo"
        :class="[
            'text-xl font-bold transition-all duration-500 ease-in-out flex items-center justify-center w-32 h-32 order-1', animationHeaderLogo
        ]"
    >
        <a href=""><img :src="$getImageUrl('/img/logo/log-1.png')" alt="Areostil logo" class=""></a>
    </div>
</template>

<script>
import { computed, ref, watch } from 'vue';
import { useHeaderState } from '../../store/headerState';
export default {
    name: 'HeaderLogoComponent',

    setup() {
        const headerState = useHeaderState();
        const animationHeaderLogo = ref("animation-none-Logo");
        const animationHeader = computed(() => headerState.animationHeader);

        watch(animationHeader, (newValue) => {
            if(newValue === 'animation-slide-up-start'){
                animationHeaderLogo.value = 'animation-slide-up-start-logo';
            }else if(newValue === 'animation-slide-down-start'){
                animationHeaderLogo.value = 'animation-slide-down-start-logo';
            }
        });
        const handleAnimationEndLogo = (event) => {
            if (event.animationName === "downStartLogo") {
                animationHeaderLogo.value = "downEndLogo";
            } else if (event.animationName === "upStartLogo") {
                animationHeaderLogo.value = "upEndLogo";
            }
        };

        return { animationHeaderLogo, handleAnimationEndLogo};
    }
};
</script>

<style scoped>
@keyframes downStartLogo {
    0% {
        opacity: 1;
    }
    40% {
        width: 8rem;
        height: 8rem;
        opacity: 0;
    }
    60% {
        width: 6rem;
        height: 6rem;
        opacity: 0;
    }
    100% {
        width: 6rem;
        height: 6rem;
        opacity: 1;
    }
}
/* .downEndLogo {
    width: 6rem;
    height: 6rem;
    opacity: 1;
} */
@keyframes upStartLogo {
    0% {
        opacity: 1;
        width: 6rem;
        height: 6rem;
    }
    20% {
        width: 6rem;
        height: 6rem;
        opacity: 0;
    }
    60% {
        width: 8rem;
        height: 8rem;
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
/* .upEndLogo {
    opacity: 1;
} */
.animation-slide-down-start-logo {
    animation: downStartLogo 2s ease-in-out forwards;
    animation-fill-mode: forwards;
}
.animation-slide-up-start-logo {
    animation: upStartLogo 2s ease-in-out forwards;
    animation-fill-mode: forwards;
}

</style>
