<template>
    <div v-if="!translationsLoaded" class="flex justify-center items-center h-screen bg-my_crem">
        <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-white"></div>
    </div>

    <div v-else>
        <HeaderComponent />
        <ButtonDownComponent />
        <ModalSliderComponent />

        <router-view v-slot="{ Component }">
        <transition
            enter-active-class="transition-all duration-1000 ease-out"
            enter-from-class="opacity-0 translate-y-10"
            enter-to-class="opacity-100 translate-y-0"
            mode="out-in"
        >
            <component
            :is="Component"
            v-if="showContent"
            :key="componentKey"
            />
        </transition>
        </router-view>

        <FooterComponent />
    </div>
</template>

<script setup>
import { computed, ref, watch, onMounted } from "vue";
import { useRoute } from 'vue-router';
import { useLocalizationStore } from "@/store/localization";

import HeaderComponent from "../Components/static/HeaderComponent.vue";
import FooterComponent from "../Components/static/FooterComponent.vue";
import ButtonDownComponent from "../Components/static/ButtonDownComponent.vue";
import ModalSliderComponent from "../Components/static/ModalSliderComponent.vue";

const route = useRoute();
const localizationStore = useLocalizationStore();

const translationsLoaded = computed(() => Object.keys(localizationStore.translations).length > 0);
const showContent = ref(false);
const componentKey = ref(route.fullPath);

// Показ контента после загрузки переводов
watch(translationsLoaded, (loaded) => {
    if (loaded && !showContent.value) {
        setTimeout(() => {
            showContent.value = true;
        }, 50);
    }
});

// Восстановление состояния при возврате назад (если translations уже загружены)
onMounted(() => {
    if (translationsLoaded.value) {
        showContent.value = true;
    }
});
</script>
