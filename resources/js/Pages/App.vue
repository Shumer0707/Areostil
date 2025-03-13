<template>
    <div v-if="!translationsLoaded" class="flex justify-center items-center h-screen bg-my_crem">
      <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-white"></div>
    </div>
    <div v-else>
      <HeaderComponent />
      <ButtonDownComponent />
      <ModalSliderComponent />
      <div
            class="transition-all ease-out duration-1000 will-change-transform"
            :class="{ 'opacity-100 translate-y-0': showContent, 'opacity-0 translate-y-10': !showContent }"
        >
            <router-view :key="$route.fullPath"></router-view>
        </div>
      <FooterComponent />
    </div>
  </template>

<script setup>
import { computed, watch } from "vue";
import { useRoute } from "vue-router";
import { useLocalizationStore } from "@/store/localization";

import HeaderComponent from "../Components/static/HeaderComponent.vue";
import FooterComponent from "../Components/static/FooterComponent.vue";
import ButtonDownComponent from "../Components/static/ButtonDownComponent.vue";
import ModalSliderComponent from "../Components/static/ModalSliderComponent.vue";

const route = useRoute();
const localizationStore = useLocalizationStore();
const translationsLoaded = computed(() => Object.keys(localizationStore.translations).length > 0);

// ✅ Теперь `showContent` — это computed!
const showContent = computed(() => {
    console.log("🔄 Проверяем showContent, translationsLoaded:", translationsLoaded.value);
    return translationsLoaded.value; // showContent будет true, если переводы загружены
});

// ✅ Логирование для контроля
watch(() => showContent.value, (newVal) => {
    console.log("✅ showContent изменился:", newVal);
});
</script>
