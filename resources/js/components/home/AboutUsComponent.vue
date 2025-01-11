<template>
    <section class="relative w-full min-h-screen flex flex-col md:flex-row items-center justify-between bg-cover bg-center"
      :style="{ backgroundImage: 'url(/img/home/about/back.jpg)' }">
      <!-- Полупрозрачный слой затемнения -->
      <div class="absolute inset-0 bg-primary bg-opacity-50"></div>

      <!-- Блок с фото верх -->
      <div class="absolute top-0 w-full h-1/3 flex z-10 hidden md:flex">
        <div class="w-1/4 h-full bg-cover bg-center"></div>
        <div class="w-1/4 h-full bg-cover bg-center shadow-2xl overflow-hidden" :style="{ backgroundImage: 'url(/img/home/about/right-3.jpg)' }"></div>
        <div class="w-1/4 h-full bg-cover bg-center shadow-2xl overflow-hidden" :style="{ backgroundImage: 'url(/img/home/about/right-2.jpg)' }"></div>
        <div class="w-1/4 h-full bg-cover bg-center"></div>
      </div>

      <!-- Левый блок -->
      <div class="relative w-full md:w-2/3 h-auto md:h-full flex flex-col justify-center px-4 sm:px-8 md:px-32 z-10 text-center md:text-left">
        <h2 class="text-2xl sm:text-3xl md:text-5xl font-bold text-my_black mb-4">О нас</h2>
        <p class="text-sm sm:text-base md:text-lg text-my_black mb-6 font-bold">
          Мы — архитектурная компания, которая создаёт уникальные пространства, вдохновляя современными трендами и технологиями.
          У нас огромный опыт как в частной, так и коммерческой застройке.
        </p>
        <a
          href="/about"
          class="text-my_black underline hover:no-underline font-bold">
          Узнайте больше о нас
        </a>
      </div>

      <!-- Правый блок -->
      <div class="relative w-full md:w-1/3 h-screen md:h-full flex items-center justify-center z-10 pr-4 sm:pr-8 md:pr-32 py-4 sm:py-8">
        <div
          class="w-full h-full bg-cover bg-center shadow-2xl overflow-hidden"
          :style="{ backgroundImage: 'url(/img/home/about/right-3.jpg)' }">
        </div>
      </div>

      <!-- Блок с фото низ -->
      <div class="absolute bottom-0 w-full h-1/3 flex z-10 hidden md:flex">
        <div class="w-1/4 h-full bg-cover bg-center shadow-2xl overflow-hidden" :style="{ backgroundImage: 'url(/img/home/about/right.jpg)' }"></div>
        <div class="w-1/4 h-full bg-cover bg-center shadow-2xl overflow-hidden" :style="{ backgroundImage: 'url(/img/home/about/right-2.jpg)' }"></div>
        <div class="w-1/4 h-full bg-cover bg-center shadow-2xl overflow-hidden" :style="{ backgroundImage: 'url(/img/home/about/right-3.jpg)' }"></div>
        <div class="w-1/4 h-full bg-cover bg-center shadow-2xl"></div>
      </div>
    </section>
  </template>

  <script>
  export default {
    name: "AboutUsComponent",
  };
  </script>

  <style scoped>
  @media (max-width: 768px) {
    .h-screen {
      height: auto;
    }
    .h-1\/2 {
      height: auto;
    }
    .bottom-0 {
      position: relative;
    }
    .text-center {
      text-align: center;
    }
    .px-8 {
      padding-left: 1rem;
      padding-right: 1rem;
    }
  }

  @media (max-width: 640px) {
    h2 {
      font-size: 1.5rem;
    }
    p {
      font-size: 0.875rem;
    }
    a {
      font-size: 0.875rem;
    }
  }
  </style>
