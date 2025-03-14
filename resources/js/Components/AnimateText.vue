<template>
    <section class="relative w-full h-screen bg-gray-100 flex items-center justify-center text-my_black overflow-hidden">
        <h1 class="text-4xl font-bold relative" ref="animatedText">
            <span v-for="(char, index) in textArray" :key="index" class="absolute" :style="charStyles[index]">{{ char }}</span>
        </h1>
    </section>
</template>

<script>
export default {
    name: "AnimatedText",
    data() {
        return {
            text: "Свяжитесь с нами",
            textArray: [],
            charStyles: []
        };
    },
    mounted() {
        this.initializeAnimation();
    },
    methods: {
        initializeAnimation() {
            // Разбить текст на массив символов
            this.textArray = this.text.split("");

            // Сгенерировать случайные позиции для каждой буквы
            this.charStyles = this.textArray.map(() => ({
                // left: `${Math.random() * 100}vw`,
                right: `${Math.random() * 100}vw`,
                top: `${Math.random() * 100}vh`,
                opacity: 0,
            }));

            // Запустить анимацию через небольшой таймаут
            setTimeout(() => {
                const textContainer = this.$refs.animatedText.getBoundingClientRect();
                this.charStyles = this.textArray.map((_, index) => ({
                    left: `${index * 1}em`, // Позиция для букв в строке
                    top: "0",
                    opacity: 1,
                    transition: "all 2s ease-in-out"
                }));
            }, 100);
        }
    }
};
</script>

<style>
h1 span {
    position: absolute;
    font-size: inherit;
}
</style>
