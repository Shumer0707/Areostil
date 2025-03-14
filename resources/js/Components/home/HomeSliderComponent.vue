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
                    class="absolute inset-0 flex flex-col justify-center items-start transition-all duration-1000 ease-in-out transform scale-90 opacity-0"
                    :class="{ 'opacity-100 scale-100': index === currentSlide }"
                    :style="slide.style"
                >
                    <h2 :ref="el => titleRef[index] = el" class="font-serif text-my_white text-4xl font-bold mb-4"></h2>
                    <p :ref="el => descRef[index] = el" class="text-my_white text-lg opacity-0"></p>
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
import { ref, computed, watch, onMounted, onBeforeUnmount, nextTick } from 'vue';
import Typed from 'typed.js';
import { useLocalizationStore } from '@/store/localization';

const localizationStore = useLocalizationStore();
const currentSlide = ref(0);
const titleRef = ref([]);
const descRef = ref([]);
const titleComplete = ref(false);
let typedTitleInstance, typedDescriptionInstance;
let slideTimeout = null;

// ✅ Определяем слайды
const slides = ref([
    { image: '/img/home/slider/slide-1.webp', title: 'home.slider_1_title', description: 'home.slider_1_description', style: { top: '20%', left: '10%' } },
    { image: '/img/home/slider/slide-2.webp', title: 'home.slider_2_title', description: 'home.slider_2_description', style: { bottom: '30%', right: '10%' } },
    { image: '/img/home/slider/slide-3.webp', title: 'home.slider_3_title', description: 'home.slider_3_description', style: { top: '50%', left: '50%'} }
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

// ✅ Функция печатания текста с Typed.js
const startTyping = async () => {
    titleComplete.value = false;
    await nextTick();

    setTimeout(() => {
        const titleElement = titleRef.value[currentSlide.value];
        const descElement = descRef.value[currentSlide.value];

        if (!titleElement || !descElement) return;

        const slide = translatedSlides.value[currentSlide.value];

        // Удаляем старые экземпляры Typed.js перед запуском новых
        if (typedTitleInstance) typedTitleInstance.destroy();
        if (typedDescriptionInstance) typedDescriptionInstance.destroy();

        // Запускаем Typed.js для заголовка
        typedTitleInstance = new Typed(titleElement, {
            strings: [slide.title],
            typeSpeed: 50,
            showCursor: false,
            onComplete: () => {
                titleComplete.value = true;
                descElement.classList.remove("opacity-0");

                // Запускаем Typed.js для описания
                typedDescriptionInstance = new Typed(descElement, {
                    strings: [slide.description],
                    typeSpeed: 30,
                    showCursor: false,
                    onComplete: startSlideShow
                });
            }
        });
    }, 100);
};

// ✅ Автоматическая смена слайдов
const startSlideShow = () => {
    clearTimeout(slideTimeout);

    slideTimeout = setTimeout(() => {
        currentSlide.value = (currentSlide.value + 1) % slides.value.length;
        startTyping();
    }, 5000);
};

// ✅ Следим за изменением `currentSlide` и запускаем `Typed.js` только когда новый слайд уже отрендерился
watch(currentSlide, () => {
    startTyping();
});

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
    if (typedTitleInstance) typedTitleInstance.destroy();
    if (typedDescriptionInstance) typedDescriptionInstance.destroy();
    clearTimeout(slideTimeout);
});
</script>

