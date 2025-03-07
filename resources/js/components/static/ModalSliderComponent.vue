<template>
<!-- Глобальное модальное окно -->
    <div v-if="modalStore.isOpen"
        @click.self="modalStore.closeModal"
        class="fixed inset-0 bg-my_black bg-opacity-80 flex items-center justify-center z-100"
    >
        <div class="relative w-full max-w-5xl h-[80vh] bg-my_crem_op p-4 shadow-lg">
            <!-- Кнопка закрытия -->
            <button @click="modalStore.closeModal"
                class="flex cursor-pointer absolute top-0 right-0 text-my_black text-5xl z-100 w-10 h-10 justify-center"
                >
                &times;
            </button>

            <!-- Swiper внутри модального окна -->
            <Swiper
                :modules="[Navigation, Pagination]"
                navigation
                :pagination="{ clickable: true }"
                loop
                :initialSlide="modalStore.activeSlide"
                class="w-full h-full"
            >
                <SwiperSlide v-for="image in modalStore.images" :key="image.id">
                    <div class="w-full h-full flex items-center justify-center">
                        <img
                            :src="image.image_path"
                            alt="Enlarged image"
                            class="max-w-full max-h-full object-contain"
                        />
                    </div>
                </SwiperSlide>
            </Swiper>
        </div>
    </div>
</template>

<script setup>
import SwiperCore from 'swiper';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, Pagination, EffectCoverflow } from 'swiper';
SwiperCore.use([Navigation, Pagination, EffectCoverflow]);
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-coverflow';
import { useModalStore } from '@/store/modalStore';

const modalStore = useModalStore();
</script>
