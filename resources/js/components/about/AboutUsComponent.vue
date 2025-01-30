<template>
    <section class="relative w-full h-screen flex items-center justify-center">
      <!-- Анимация Плана Дома -->
      <svg
        xmlns="http://www.w3.org/2000/svg"
        :viewBox="`0 0 ${width} ${height}`"
        class="w-full h-full">
        <template v-for="line in computedLines" :key="line.d">
          <path :d="line.d" :stroke="line.stroke" :stroke-width="line.strokeWidth" fill="none" :stroke-dasharray="line.dasharray" :stroke-dashoffset="line.dashoffset" style="animation: draw 10s linear infinite forwards;" />
        </template>
      </svg>
    </section>
</template>

<script>
    export default {
    name: "HousePlanAnimation",
    data() {
        return {
        width: 800, // Ширина SVG
        height: 800, // Высота SVG
        offset: 64, // Отступ px-32
        };
    },
    computed: {
        computedLines() {
        const { width, height, offset } = this;
        return [
            // Вертикальные линии слева и справа
            { d: `M${offset} 0 V${height}`, stroke: "black", strokeWidth: 3, dasharray: height, dashoffset: height },
            { d: `M${width - offset} 0 V${height}`, stroke: "black", strokeWidth: 3, dasharray: height, dashoffset: height },
            // Горизонтальные линии сверху и снизу
            { d: `M0 ${offset} H${width}`, stroke: "black", strokeWidth: 3, dasharray: width, dashoffset: width },
            { d: `M0 ${height - offset} H${width}`, stroke: "black", strokeWidth: 3, dasharray: width, dashoffset: width }
        ];
        }
    }
    };
</script>

<style>
    @keyframes draw {
        to {
            stroke-dashoffset: 0;
        }
    }
</style>
