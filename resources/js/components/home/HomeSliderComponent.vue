<template>
    <section id="slider-section" class="relative w-full h-screen overflow-hidden">
        <div class="inset-0 w-full h-full overflow-hidden relative">
            <div v-for="(slide, index) in translatedSlides" :key="index" class="absolute inset-0">
                <img
                    :src="slide.image"
                    :alt="'Slide ' + index"
                    class="h-full w-full object-cover transition-opacity duration-500 ease-in-out"
                    :class="{'opacity-100': index === currentSlide, 'opacity-0': index !== currentSlide}"
                />
                <div
                    class="absolute inset-0 bg-black bg-opacity-60 transition-opacity duration-500 ease-in-out"
                    :class="{'opacity-100': index === currentSlide, 'opacity-0': index !== currentSlide}"
                ></div>
                <div
                    v-if="index === currentSlide"
                    class="absolute inset-0 flex flex-col justify-center items-start  transition-all duration-1000 ease-in-out transform scale-90 opacity-0"
                    :class="{ 'opacity-100 scale-100': index === currentSlide }"
                    :style="slide.style"
                >
                    <h2 class="font-serif text-my_white text-4xl font-bold mb-4">{{ typedTitle }}</h2>
                    <p v-if="titleComplete" class="text-my_white text-lg">{{ typedDescription }}</p>
                </div>
            </div>

            <div class="absolute bottom-4 w-full flex justify-center space-x-2">
                <div
                    v-for="(slide, index) in slides"
                    :key="'indicator-' + index"
                    @click="goToSlide(index)"
                    class="w-4 h-4 rounded-full border-2 border-my_white cursor-pointer transition-all duration-300"
                    :class="{ 'bg-my_white': index === currentSlide, 'bg-transparent': index !== currentSlide }"
                ></div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { useLocalizationStore } from '@/store/localization';

const localizationStore = useLocalizationStore();
const currentSlide = ref(0);
const typedTitle = ref('');
const typedDescription = ref('');
const titleComplete = ref(false);
let animationFrameId = null;
let timeoutId = null;

// ✅ Определяем слайды с ключами для перевода
const slides = ref([
    { image: '/img/home/slider/img1.jpg', title: 'home.slider_1_title', description: 'home.slider_1_description', style: { top: '20%', left: '10%' } },
    { image: '/img/home/slider/img2.jpg', title: 'home.slider_2_title', description: 'home.slider_2_description', style: { bottom: '30%', right: '10%' } },
    { image: '/img/home/slider/img3.jpg', title: 'home.slider_3_title', description: 'home.slider_3_description', style: { top: '50%', left: '50%'} }
]);

// ✅ Автоматически переводим слайды при изменении переводов
const translatedSlides = computed(() => {
    if (!localizationStore.translations || Object.keys(localizationStore.translations).length === 0) {
        return slides.value;
    }
    return slides.value.map(slide => ({
        ...slide,
        title: localizationStore.translations?.home?.[slide.title.split('.')[1]] || slide.title,
        description: localizationStore.translations?.home?.[slide.description.split('.')[1]] || slide.description
    }));
});

// ✅ Запускаем печатание текста текущего слайда
const startTyping = () => {
    const slide = translatedSlides.value[currentSlide.value];

    typedTitle.value = '';
    typedDescription.value = '';
    titleComplete.value = false;

    typeText(slide.title, 'typedTitle', () => {
        titleComplete.value = true;
        typeText(slide.description, 'typedDescription', startSlideShow);
    });
};


const typingSpeed = 50; // ⏳ Устанавливаем скорость печатания (мс)

// ✅ Функция печатания текста с анимацией
const typeText = (text, target, callback) => {
    let index = 0;
    let tempText = '';

    const animateTyping = () => {
        if (index < text.length) {
            tempText += text[index];
            if (target === 'typedTitle') typedTitle.value = tempText;
            if (target === 'typedDescription') typedDescription.value = tempText;
            index++;

            // ⏳ Добавляем задержку перед следующим вызовом requestAnimationFrame
            setTimeout(() => {
                animationFrameId = requestAnimationFrame(animateTyping);
            }, typingSpeed);
        } else {
            if (callback) callback();
        }
    };

    animationFrameId = requestAnimationFrame(animateTyping);
};


// ✅ Автоматическая смена слайдов
const startSlideShow = () => {
    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => {
        animationFrameId = requestAnimationFrame(() => {
            currentSlide.value = (currentSlide.value + 1) % slides.value.length;
            startTyping();
        });
    }, 10000);
};

// ✅ Вручную переключаем слайд
const goToSlide = (index) => {
    currentSlide.value = index;
    startTyping();
    startSlideShow();
};

// ✅ Загружаем переводы при монтировании
onMounted(async () => {
    if (!localizationStore.translations || Object.keys(localizationStore.translations).length === 0) {
        await localizationStore.fetchTranslations();
    }
    startTyping();
    startSlideShow();
});

// ✅ Очищаем анимации при выходе
onBeforeUnmount(() => {
    cancelAnimationFrame(animationFrameId);
    clearTimeout(timeoutId);
});
</script>

<style>
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fade-in-up 1s ease forwards;
}

.delay-150 {
    animation-delay: 0.15s;
}
</style>
