<template>
    <section class="relative w-full h-screen bg-primary bg-center">
      <!-- Полупрозрачный слой затемнения -->
      <!-- <div class="absolute inset-0 bg-black bg-opacity-50"></div> -->

      <!-- Заголовок -->
      <div class="relative z-10 text-center py-8">
        <h2 class="text-5xl font-bold text-my_black">Наши работы</h2>
      </div>

      <!-- Блок с фотографиями -->
      <div class="relative z-10 flex justify-center items-center gap-8 px-32 h-[calc(100%-10rem)]">
        <!-- Фотография 1 -->
        <a
          href="/link1"
          class="w-1/3 h-full bg-cover bg-center rounded-lg shadow-lg relative"
          :style="{ backgroundImage: 'url(/img/home/galery/left.jpg)' }">
          <div class="absolute inset-0 bg-black bg-opacity-50 rounded-lg"></div>
          <h3 class="absolute inset-x-0 bottom-4 text-center text-xl font-bold text-white">Архитектура</h3>
        </a>

        <!-- Фотография 2 -->
        <a
          href="/link2"
          class="w-1/3 h-full bg-cover bg-center rounded-lg shadow-lg relative"
          :style="{ backgroundImage: 'url(/img/home/galery/center.jpg)' }">
          <div class="absolute inset-0 bg-black bg-opacity-50 rounded-lg"></div>
          <h3 class="absolute inset-x-0 bottom-4 text-center text-xl font-bold text-white">Инженеринг</h3>
        </a>

        <!-- Фотография 3 -->
        <a
          href="/link3"
          class="w-1/3 h-full bg-cover bg-center rounded-lg shadow-lg relative"
          :style="{ backgroundImage: 'url(/img/home/galery/galery-4.jpg)' }">
          <div class="absolute inset-0 bg-black bg-opacity-50 rounded-lg"></div>
          <h3 class="absolute inset-x-0 bottom-4 text-center text-xl font-bold text-white">Дизайн</h3>
        </a>
      </div>
    </section>
  </template>

  <script>
  export default {
    name: "GaleryComponent",
  };
  </script>

  <style scoped>
  </style>
