<template>
    <section class="relative w-full h-screen flex flex-col items-center justify-evenly bg-cover bg-center overflow-hidden">
        <!-- Категории -->

        <div class="text-my_black font-serif font-bold bg-my_crem_op w-full h-1/4 flex flex-col md:flex-row px-24 lg:px-48 items-center justify-evenly text-2xl md:text-3xl select-none">
            <p v-for="category in categories" :key="category.value">
                <a
                    :class="['hover:border-b-2 hover:border-b-my_pink md:hover:border-b-my_pink_op p-2 ',
                            selectedCategory === category.value ? 'border-b-2 border-b-my_pink' : '']"
                    href=""
                    @click.prevent="setCategory(category.value)"
                >
                    {{ $t(category.label) }}
                </a>
            </p>
        </div>

        <!-- Карусель -->
        <div class="bg-my_crem_op w-full h-2/4 relative flex items-center">
            <Swiper
                v-if="filteredProjects.length > 0"
                :key="filteredProjects.length"
                effect="coverflow"
                navigation
                :pagination="{ clickable: true }"
                loop
                watchOverflow
                centeredSlides
                :spaceBetween="30"
                :breakpoints="{
                    320: { slidesPerView: 1 },
                    640: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 }
                }"
                :coverflowEffect="{
                    rotate: 50,
                    stretch: 0,
                    depth: 200,
                    modifier: 1,
                    slideShadows: true
                }"
                class="h-full w-full"
            >
                <SwiperSlide v-for="(item, index) in filteredProjects" :key="index">
                    <router-link :to="`/project/${item.id}`" class="cursor-pointer block w-full h-full">
                        <div class="relative w-full h-full ">
                            <img
                                :src="item.cover_image"
                                :alt="item.client"
                                class="absolute top-0 left-0 w-full h-full object-cover shadow-lg hover:scale-110 transition-all duration-500"
                            />
                            <div class="absolute bottom-4 left-4 bg-my_gray_op p-2 text-my_white">
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
import { computed, ref, watch, toRef } from 'vue';
import SwiperCore from 'swiper';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, Pagination, EffectCoverflow } from 'swiper';
SwiperCore.use([Navigation, Pagination, EffectCoverflow]);
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-coverflow';

// ✅ Корректно объявляем `props`
const props = defineProps({
    isActive: Boolean,
    currentCategory: String,
    projects: {
        type: Array,
        default: () => []
    }
});

// ✅ Делаем `projects` реактивным
const projectsRef = toRef(props, 'projects');

const categories = ref([
    { value: 'architecture', label: 'home.gallery_Architecture' },
    { value: 'engineering', label: 'home.gallery_Engineering' },
    { value: 'design', label: 'home.gallery_Design' }
]);

const selectedCategory = ref(props.currentCategory || 'architecture');

// ✅ Фильтрация проектов по `trend`
const filteredProjects = computed(() => {
    // console.log("Фильтрация проектов для категории:", selectedCategory.value);
    return projectsRef.value.filter(project => project.trend === selectedCategory.value);
});

// ✅ Изменение категории
const setCategory = (category) => {
    selectedCategory.value = category;
};

// ✅ Следим за изменением `currentCategory`
watch(() => props.currentCategory, (newCategory) => {
    selectedCategory.value = newCategory || 'architecture';
});

// ✅ Следим за изменением `filteredProjects`
watch(filteredProjects, (newProjects) => {
    console.log("Отфильтрованные проекты:", newProjects);
});
</script>

<style>
.swiper-button-next, .swiper-button-prev {
    color: #F43F5E;
    width: 40px;
    height: 40px;
    top: 50%;
    transform: translateY(-50%);
    position: absolute;
    z-index: 60;
    cursor: pointer;
    pointer-events: auto;
}

.swiper-pagination-bullet {
    background: #334155;
    opacity: 0.7;
}

.swiper-pagination {
    bottom: 10px;
    z-index: 60;
}

.swiper-pagination-bullet {
    background: #334155;
    width: 12px;
    height: 12px;
    opacity: 0.7;
    margin: 0 4px;
}

.swiper-pagination-bullet-active {
    background: #F43F5E;
    opacity: 1;
}

/* Центрирование слайдов по вертикали */
.swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    height: 100%;
}
</style>
