<template>
    <div class="relative w-full h-screen flex flex-col bg-cover bg-center overflow-hidden">
        <!-- Верхняя часть (2/3 экрана) -->
        <div class="w-full h-2/3 flex flex-col lg:flex-row items-center justify-center lg:justify-between">
            <!-- Левая часть: Заголовок, клиент, описание -->
            <div class="w-full h-full lg:w-1/3 md:py-6 md:pl-6 flex">
                <div class="w-full h-full flex flex-col items-center justify-center bg-my_crem_op text-left space-y-2 lg:space-y-4 p-6 pt-20">
                    <h1 class="text-xl lg:text-4xl font-bold text-my_black leading-tight">
                        {{ projectTitle }}
                    </h1>
                    <p class="text-md md:text-xl font-semibold text-my_black">
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
        <div v-if="project.images.length > 0" class="bg-my_crem_op w-full h-1/3 relative flex items-center py-8">
            <Swiper
                effect="coverflow"
                navigation
                :pagination="{ clickable: true }"
                loop
                watchOverflow
                centeredSlides
                :spaceBetween="30"
                :breakpoints="{
                    320: { slidesPerView: 2 },
                    640: { slidesPerView: 3 },
                    1024: { slidesPerView: 4 }
                }"
                :coverflowEffect="{
                    rotate: 30,
                    stretch: 0,
                    depth: 200,
                    modifier: 1,
                    slideShadows: true
                }"
                class="h-full w-full"
            >
                <SwiperSlide v-for="(image, index) in project.images" :key="image.id">
                    <div class="relative w-full h-full">
                        <img
                            :src="image.image_path"
                            alt="Project image"
                            class="w-full h-full object-cover shadow-lg hover:scale-110 transition-all duration-500 cursor-pointer"
                            @click="openModal(index)"
                        />
                    </div>
                </SwiperSlide>
            </Swiper>
        </div>

        <!-- Модальное окно с увеличенными фото -->
        <div v-if="isModalOpen" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-[10000]">
            <div class="relative w-full max-w-5xl h-[80vh] bg-white p-4 rounded-lg shadow-lg z-[9999]">
                <!-- Закрыть модалку -->
                <button @click="closeModal" class="cursor-pointer absolute top-4 right-4 text-my_black text-5xl z-[9999]">&times;</button>

                <!-- Swiper внутри модального окна -->
                <Swiper
                    :modules="[Navigation, Pagination]"
                    navigation
                    :pagination="{ clickable: true }"
                    loop
                    :initialSlide="activeSlide"
                    class="w-full h-full"
                >
                    <SwiperSlide v-for="image in project.images" :key="image.id">
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
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import SwiperCore from 'swiper';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, Pagination, EffectCoverflow } from 'swiper';
SwiperCore.use([Navigation, Pagination, EffectCoverflow]);
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-coverflow';

const props = defineProps({
    project: Object
});

// ✅ Лог для отладки (оставил на всякий случай)
console.log("Текущий перевод проекта:", props.project.translation);

// ✅ Гарантированно получаем название проекта
const projectTitle = computed(() => props.project?.translation?.title || 'Название проекта');

// ✅ Гарантированно получаем описание проекта
const projectDescription = computed(() => props.project?.translation?.short_desc || 'Описание проекта пока недоступно.');

// ✅ Управление модальным окном
const isModalOpen = ref(false);
const activeSlide = ref(0);

// ✅ Открытие модального окна
const openModal = (index) => {
    activeSlide.value = index;
    isModalOpen.value = true;
};

// ✅ Закрытие модального окна
const closeModal = () => {
    isModalOpen.value = false;
};
</script>

<style>
/* Стилизация кнопки закрытия */

/* Убираем лишнее выделение */
/* button:focus {
    outline: none;
} */
</style>
