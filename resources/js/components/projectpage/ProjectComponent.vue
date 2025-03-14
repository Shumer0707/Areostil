<template>
    <div class="relative w-full h-screen flex flex-col bg-cover bg-center overflow-hidden">
        <!-- Верхняя часть (2/3 экрана) -->
        <div class="w-full h-2/3 flex flex-col lg:flex-row items-center justify-center lg:justify-between">
            <!-- Левая часть: Заголовок, клиент, описание -->
            <div class="w-full h-full lg:w-1/3 md:py-6 md:pl-6 flex">
                <div class="w-full h-full flex flex-col items-center justify-center bg-my_crem_op text-left space-y-2 lg:space-y-4 p-6 pt-20">
                    <h1 class="text-xl text-center lg:text-4xl font-bold text-my_black leading-tight">
                        {{ projectTitle }}
                    </h1>
                    <p class="text-md md:text-xl font-semibold text-my_black text-center">
                        {{ project.client }}
                    </p>
                    <p class="text-sm md:text-lg text-my_black leading-relaxed">
                        {{ projectDescription }}
                    </p>
                </div>
            </div>

            <!-- Правая часть: Основное изображение -->
            <div class="w-full lg:w-2/3 h-64 lg:h-full md:py-6 md:pr-6">
                <div class="w-full h-full overflow-hidden">
                    <img
                        :src="project.cover_image"
                        :alt="projectTitle"
                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                    />
                </div>
            </div>
        </div>

        <!-- Галерея Swiper (1/3 экрана) -->
        <div v-if="imagesWithLoading.length" class="bg-my_crem_op w-full h-1/3 relative flex items-center py-8">
            <Swiper
                effect="coverflow"
                navigation
                :pagination="{ clickable: true }"
                loop
                watchOverflow
                centeredSlides
                :spaceBetween="30"
                :breakpoints="{320: { slidesPerView: 2 },640: { slidesPerView: 3 },1024: { slidesPerView: 4 }}"
                :coverflowEffect="{ rotate: 30, stretch: 0, depth: 200, modifier: 1, slideShadows: true }"
                class="h-full w-full"
            >
                <SwiperSlide v-for="(image, index) in imagesWithLoading" :key="image.id">
                    <div class="relative w-full h-full overflow-hidden"
                        :class="{ 'bg-my_gray_op animate-pulse': !image.loaded }">
                        <img
                            :src="image.image_path"
                            alt="Project image"
                            loading="lazy"
                            class="w-full h-full object-cover shadow-lg transition-all duration-500 cursor-pointer hover:scale-110"
                            :class="image.loaded ? 'opacity-100' : 'opacity-0'"
                            @load="image.loaded = true"
                            @click="openImageModal(index)"
                        />
                    </div>
                </SwiperSlide>
            </Swiper>
        </div>
    </div>
</template>

<script setup>
import { useModalStore } from '@/store/modalStore';
import { ref, computed, watchEffect, toRef } from 'vue';
import SwiperCore from 'swiper';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, Pagination, EffectCoverflow } from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-coverflow';

SwiperCore.use([Navigation, Pagination, EffectCoverflow]);

const props = defineProps({
    project: Object
});

const projectRef = toRef(props, 'project');

// Название и описание проекта
const projectTitle = computed(() => projectRef.value?.translation?.title || 'Название проекта');
const projectDescription = computed(() => projectRef.value?.translation?.short_desc || 'Описание проекта пока недоступно.');

const modalStore = useModalStore();
const openImageModal = (index) => {
    modalStore.openModal(index, props.project.images);
};

// Реактивный массив с состоянием загрузки изображений
const imagesWithLoading = ref([]);

// Обрабатываем массив изображений, добавляя поле loaded
watchEffect(() => {
    imagesWithLoading.value = (projectRef.value?.images || []).map(img => ({
        ...img,
        loaded: false,
    }));
});

</script>


