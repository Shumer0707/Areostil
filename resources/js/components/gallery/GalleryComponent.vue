<template>
    <section class="relative w-full h-screen flex flex-col items-center justify-evenly bg-cover bg-center overflow-hidden">
        <div class="font-serif bg-my_gray_op w-full h-1/4 flex flex-col md:flex-row px-24 lg:px-48 items-center justify-evenly text-2xl md:text-3xl select-none">
            <p><a :class="['hover:border-b-2 hover:border-b-my_pink md:hover:border-b-my_pink_op p-2',
            currentCategory === 'architecture' ? 'border-b-2 border-b-my_pink' : '']"
                href="" @click.prevent="setCategory('architecture')"
                >Архитектура
            </a></p>
            <p><a :class="['hover:border-b-2 hover:border-b-my_pink md:hover:border-b-my_pink_op p-2',
            currentCategory === 'engineering' ? 'border-b-2 border-b-my_pink' : '']"
                href="" @click.prevent="setCategory('engineering')">
                Инженеринг
            </a></p>
            <p><a :class="['hover:border-b-2 hover:border-b-my_pink md:hover:border-b-my_pink_op p-2',
            currentCategory === 'design' ? 'border-b-2 border-b-my_pink' : '']"
                href="" @click.prevent="setCategory('design')">
                Дизайн
            </a></p>
        </div>
        <!-- карусель -->
        <div class="bg-my_gray_op w-full h-2/4 relative flex items-center">
            <Swiper
                v-if="currentItems.length > 0"
                effect="coverflow"
                navigation
                pagination
                loop
                watchOverflow
                centeredSlides
                :spaceBetween="30"
                :breakpoints="{
                    320: { slidesPerView: 1 },   // Мобильные (до 640px)
                    640: { slidesPerView: 2 },   // Планшеты (от 640px)
                    1024: { slidesPerView: 3 }   // Десктопы (от 1024px)
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
                <SwiperSlide v-for="(item, index) in currentItems" :key="index">
                    <a :href="item.link" class="cursor-pointer">
                    <img :src="$getImageUrl(item.image)"
                        :alt="item.name"
                        class="rounded-2xl shadow-lg object-cover w-full h-full max-w-full max-h-full" />
                    <div class="absolute bottom-4 left-4 bg-my_gray_op p-2 rounded-lg text-white">
                        <h3 class="text-xl font-bold">{{ item.name }}</h3>
                        <p class="text-sm">{{ item.details }}</p>
                    </div>
                    </a>
                </SwiperSlide>
            </Swiper>
        </div>
    </section>
</template>

<script>
import SwiperCore from 'swiper';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { Navigation, Pagination, EffectCoverflow } from 'swiper';
SwiperCore.use([Navigation, Pagination, EffectCoverflow]);
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-coverflow';

export default {
    name: 'GaleryComponent',
    components: {
        Swiper,
        SwiperSlide
    },
    props: {
    isActive: {
        type: Boolean,
        required: true
    },
    title: {
        type: String,
        required: true
    },
    description: {
        type: String,
        required: true
    },
    allItems: {  // Исправлено название пропа
        type: Object,
        default: () => ({
            architecture: [],
            engineering: [],
            design: []
        })
    }
    },
    data() {
        return {
            currentItems: [],  // Изменено название, чтобы избежать конфликта с пропсом
            currentCategory: 'architecture'  // Устанавливаем категорию по умолчанию
        };
    },
    mounted() {
        this.setCategory(this.title);
    },
    methods: {
        setCategory(type) {
            this.currentCategory = type;
            this.currentItems = this.allItems[type] || [];  // Исправленное обращение к пропсу
        }
    }
}
</script>

<style>
.swiper-button-next, .swiper-button-prev {
    color: #F43F5E;
    width: 40px;
    height: 40px;
    top: 50%;
    transform: translateY(-50%);
    position: absolute;
    z-index: 9999;
    cursor: pointer;
    pointer-events: auto;
}

.swiper-pagination-bullet {
    background: #334155;
    opacity: 0.7;
}

.swiper-pagination {
    bottom: 10px;
    z-index: 10;
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
