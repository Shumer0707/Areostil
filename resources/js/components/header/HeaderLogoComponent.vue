<template>
    <div
        :class="[
            'relative text-xl font-bold transition-all duration-500 ease-in-out flex items-center justify-center w-16 h-16 order-1', animationHeaderLogo,
            'md:w-32 md:h-32'
        ]"
    >
        <a href=""><img :src="$getImageUrl('/img/logo/log-1.png')" alt="Areostil logo" class=""></a>
        <span class="absolute inset-0 w-[100%] h-[100%] -z-10 bg-my_black blur-2xl opacity-50 rounded-full"></span>
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

        return { animationHeaderLogo};
    }
};
</script>

<style scoped>
@keyframes downStartLogo {
    0% {
        opacity: 1;
    }
    40% {
        width: 4rem;
        height: 4rem;
        opacity: 0;
    }
    60% {
        width: 3rem;
        height: 3rem;
        opacity: 0;
    }
    100% {
        width: 3rem;
        height: 3rem;
        opacity: 1;
    }
}
@media (min-width: 768px) {
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
}
@keyframes upStartLogo {
    0% {
        width: 3rem;
        height: 3rem;
        opacity: 1;
    }
    20% {
        width: 3rem;
        height: 3rem;
        opacity: 0;
    }
    60% {
        width: 4rem;
        height: 4rem;
        opacity: 0;
    }
    100% {
        width: 4rem;
        height: 4rem;
        opacity: 1;
    }
}
@media (min-width: 768px) {
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
}
.animation-slide-down-start-logo {
    animation: downStartLogo 2s ease-in-out forwards;
    animation-fill-mode: forwards;
}
.animation-slide-up-start-logo {
    animation: upStartLogo 2s ease-in-out forwards;
    animation-fill-mode: forwards;
}

</style>
