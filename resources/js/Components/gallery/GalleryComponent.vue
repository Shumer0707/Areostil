<template>
    <section class="relative w-full h-screen flex flex-col items-center justify-evenly bg-cover bg-center overflow-hidden">
        <!-- Категории -->
        <div class="text-my_black font-serif font-bold bg-my_crem_op w-full h-1/4 flex flex-col md:flex-row px-24 lg:px-48 items-center justify-evenly text-2xl md:text-3xl select-none">
            <p v-for="category in categories" :key="category.value">
                <a
                    :class="[
                        'hover:border-b-2 hover:border-b-my_pink md:hover:border-b-my_pink_op p-2 ',
                        selectedCategory === category.value ? 'border-b-2 border-b-my_pink' : ''
                    ]"
                    href="#"
                    @click.prevent="setCategory(category.value)"
                >
                    {{ $t(category.label) }}
                </a>
            </p>
        </div>

        <!-- Карусель -->
        <div class="bg-my_crem_op w-full h-2/4 relative flex items-center">
            <Swiper
                v-if="filteredProjects.length"
                :key="selectedCategory"
                effect="coverflow"
                navigation
                :pagination="{ clickable: true }"
                loop
                watchOverflow
                centeredSlides
                :spaceBetween="30"
                :breakpoints="{320: { slidesPerView: 1 },640: { slidesPerView: 2 },1024: { slidesPerView: 3 }}"
                :coverflowEffect="{ rotate: 50, stretch: 0, depth: 200, modifier: 1, slideShadows: true }"
                class="h-full w-full"
            >
                <SwiperSlide v-for="item in filteredProjects" :key="item.id">
                    <router-link :to="`/project/${item.id}`" class="block w-full h-full">
                        <div class="relative w-full h-full overflow-hidden"
                             :class="{'bg-my_gray_op animate-pulse': !item.loaded}">
                            <img
                                :src="item.cover_image"
                                :alt="item.client"
                                loading="lazy"
                                class="absolute top-0 left-0 w-full h-full object-cover shadow-lg transition-all duration-1000 ease-out hover:scale-110"
                                :class="item.loaded ? 'opacity-100' : 'opacity-0'"
                                @load="item.loaded = true"
                            />
                            <div v-if="item.loaded" class="absolute bottom-4 left-4 bg-my_gray_op p-2 text-my_white">
                                <h3 class="text-xl font-bold">{{ item.client }}</h3>
                                <p class="text-sm">{{ item.trend }}</p>
                            </div>
                        </div>
                    </router-link>
                </SwiperSlide>
            </Swiper>
        </div>
    </section>
</template>

<script setup>
import { computed, ref, watch, toRef, watchEffect } from 'vue';
import SwiperCore, { Navigation, Pagination, EffectCoverflow } from 'swiper';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-coverflow';

SwiperCore.use([Navigation, Pagination, EffectCoverflow]);

const props = defineProps({
  currentCategory: String,
  projects: { type: Array, default: () => [] }
});

const projectsRef = toRef(props, 'projects');

const categories = ref([
  { value: 'architecture', label: 'home.gallery_Architecture' },
  { value: 'engineering', label: 'home.gallery_Engineering' },
  { value: 'design', label: 'home.gallery_Design' }
]);

const selectedCategory = ref(props.currentCategory || 'architecture');

const setCategory = (category) => {
  selectedCategory.value = category;
};

// Реактивный массив проектов с состоянием загрузки
const projectsWithLoading = ref([]);

watchEffect(() => {
  projectsWithLoading.value = projectsRef.value
    .filter(p => p.trend === selectedCategory.value)
    .map(p => ({
      ...p,
      loaded: false,
    }));
});

// Сброс состояния загрузки при смене категории
watch(selectedCategory, () => {
  projectsWithLoading.value.forEach(p => p.loaded = false);
});

// Используем подготовленный массив
const filteredProjects = computed(() => projectsWithLoading.value);
</script>

<style>
.swiper-button-next, .swiper-button-prev {
    color: #F43F5E;
    width: 4rem;
    height: 4rem;
    top: 50%;
    transform: translateY(-50%);
    position: absolute;
    z-index: 60;
    cursor: pointer;
    pointer-events: auto;
}
.swiper-button-next::after, .swiper-button-prev::after{
    font-weight:bold;
}

.swiper-pagination {
    bottom: 10px;
    z-index: 60;
}

.swiper-pagination-bullet {
    background: #334155;
    width: 12px;
    height: 12px;
    opacity: 1;
}

.swiper-pagination-bullet-active {
    background: #F43F5E;
    opacity: 1;
}

.swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    height: 100%;
}
</style>
