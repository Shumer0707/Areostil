import { defineStore } from "pinia";
import { ref } from "vue";

export const useModalStore = defineStore("modal", () => {
    const isOpen = ref(false);
    const images = ref([]);
    const activeSlide = ref(0);

    function openModal(index, imgs) {
        images.value = imgs;
        activeSlide.value = index;
        isOpen.value = true;
    }

    function closeModal() {
        isOpen.value = false;
    }

    return { isOpen, images, activeSlide, openModal, closeModal };
});
