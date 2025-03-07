<template>
    <div v-if="!translationsLoaded" class="flex justify-center items-center h-screen bg-my_crem">
      <div class="animate-spin rounded-full h-12 w-12 border-t-4 border-white"></div>
    </div>
    <div v-else>
      <HeaderComponent />
      <ButtonDownComponent />
      <div
            class="transition-all ease-out duration-1000 will-change-transform"
            :class="{ 'opacity-100 translate-y-0': showContent, 'opacity-0 translate-y-10': !showContent }"
        >
            <router-view /> <!-- Основной контент приложения -->
        </div>
      <FooterComponent />
    </div>
  </template>

  <script setup>
  import { computed, onMounted, watch, ref } from "vue";
  import { useLocalizationStore } from "@/store/localization";
  import HeaderComponent from "../components/static/HeaderComponent.vue";
  import FooterComponent from "../components/static/FooterComponent.vue";
  import ButtonDownComponent from "../components/static/ButtonDownComponent.vue";

  const localizationStore = useLocalizationStore();
  const translationsLoaded = computed(() => Object.keys(localizationStore.translations).length > 0);
  const showContent = ref(false);
  // Загружаем переводы перед рендером приложения
  watch(() => translationsLoaded.value, (newVal) => {
    if (newVal) {
        setTimeout(() => {
            showContent.value = true;
        }, 50); // Задержка 50 мс, чтобы Vue успел отрисовать компонент
    }
 });
  </script>
