<template>
    <section id="slider-section" class="relative w-full h-screen overflow-hidden">
      <div class="inset-0 w-full h-full overflow-hidden relative">
        <div v-for="(slide, index) in slides" :key="index" class="absolute inset-0">
          <img
            :src="slide.image"
            :alt="'Slide ' + index"
            class="h-full w-full object-cover transition-opacity duration-500 ease-in-out"
            :class="{'opacity-100': index === currentSlide, 'opacity-0': index !== currentSlide}"
          />
          <div
            class="absolute inset-0 bg-black bg-opacity-50 transition-opacity duration-500 ease-in-out"
            :class="{'opacity-100': index === currentSlide, 'opacity-0': index !== currentSlide}"
          ></div>
          <div
            v-if="index === currentSlide"
            class="absolute inset-0 flex flex-col justify-center items-start p-8 transition-all duration-1000 ease-in-out transform scale-90 opacity-0"
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

<script>
export default {
    name: 'SliderComponent',
    data() {
        return {
            slides: [
                {
                    image: '/img/home/slider/img1.jpg',
                    title: 'Welcome to Our Gallery',
                    description: 'Explore the beauty of our collection.',
                    style: { top: '20%', left: '10%' } // Расположение текста
                },
                {
                    image: '/img/home/slider/img2.jpg',
                    title: 'Experience the Art',
                    description: 'Every picture tells a story.',
                    style: { bottom: '15%', right: '10%' } // Расположение текста
                },
                {
                    image: '/img/home/slider/img3.jpg',
                    title: 'Capture the Moment',
                    description: 'Memories that last forever.',
                    style: { top: '50%', left: '50%', transform: 'translate(-50%, -50%)' } // Центрированный текст
                }
            ],
            currentSlide: 0, // Индекс текущего слайда
            typedTitle: '', // Заголовок, который постепенно печатается
            typedDescription: '', // Описание, которое постепенно печатается
            titleIndex: 0, // Индекс текущего символа для заголовка
            descriptionIndex: 0, // Индекс текущего символа для описания
            titleComplete: false, // Флаг завершения печатания заголовка
            intervalId: null // ID для управления setInterval
        };
    },
    mounted() {
        // Показ текста на первой картинке сразу при загрузке компонента
        this.resetTyping();
        this.typeText('title', this.slides[this.currentSlide].title, 'typedTitle', () => {
            this.titleComplete = true;
            this.typeText('description', this.slides[this.currentSlide].description, 'typedDescription');
        });
        this.startSlideShow();
    },
    methods: {
        // Метод для смены слайдов каждые 5 секунд
        startSlideShow() {
            // Очищаем предыдущий интервал, если он существует
            if (this.intervalId) {
                clearInterval(this.intervalId);
            }

            // Устанавливаем новый интервал для автоматической смены слайдов
            this.intervalId = setInterval(() => {
                this.currentSlide = (this.currentSlide + 1) % this.slides.length; // Обновление текущего слайда
                this.resetTyping(); // Сброс текста перед началом печатания нового
                this.typeText('title', this.slides[this.currentSlide].title, 'typedTitle', () => {
                    this.titleComplete = true;
                    this.typeText('description', this.slides[this.currentSlide].description, 'typedDescription');
                });
            }, 10000);
        },
        // Сброс текста и индексов для нового слайда
        resetTyping() {
            this.typedTitle = '';
            this.typedDescription = '';
            this.titleIndex = 0;
            this.descriptionIndex = 0;
            this.titleComplete = false;
        },
        // Общий метод для печатания текста (заголовков и описаний)
        typeText(type, text, target, callback) {
            const interval = setInterval(() => {
                const indexKey = `${type}Index`; // Динамическое определение индекса для заголовка или описания
                if (this[indexKey] < text.length) {
                    this[target] += text[this[indexKey]]; // Добавление символа в текущий текст
                    this[indexKey]++; // Увеличение индекса
                } else {
                    clearInterval(interval); // Остановка интервала, когда текст завершён
                    if (callback) callback(); // Вызов callback, если он передан
                }
            }, 100); // Скорость печатания
        },
        // Переход к выбранному слайду
        goToSlide(index) {
            this.currentSlide = index; // Устанавливаем текущий слайд
            this.resetTyping(); // Сброс текста для нового слайда
            this.typeText('title', this.slides[this.currentSlide].title, 'typedTitle', () => {
                this.titleComplete = true;
                this.typeText('description', this.slides[this.currentSlide].description, 'typedDescription');
            });
            this.startSlideShow(); // Перезапускаем интервал для смены слайдов
        }
    },
    beforeDestroy() {
        // Убираем интервал при уничтожении компонента
        if (this.intervalId) {
            clearInterval(this.intervalId);
        }
    }
};
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
