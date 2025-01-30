<template>
    <section class="relative w-full h-screen flex items-center justify-between bg-cover bg-center overflow-hidden">
      <!-- :style="{ backgroundImage: 'url(/img/home/about/back.jpg)' }"> -->
      <!-- Полупрозрачный слой затемнения -->
      <!-- <div class="absolute inset-0 bg-primary bg-opacity-50"></div> -->

      <!-- Блок с фото верх -->
      <div class="absolute top-0 w-full h-1/3 flex z-10">
        <div class="w-1/4 h-full flex items-center justify-center">
        </div>
        <div :class="['absolute w-1/4 h-full flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000',
          isActive ? 'left-1/4 top-0 delay-500 scale-100 opacity-100 -rotate-6' : 'left-150 top-2/4 scale-300 delay-500']">
          <img :src="$getImageUrl('/img/home/about/right-3.jpg')" alt="Фото 3" class="w-full h-full object-cover" />
        </div>
        <div :class="['absolute w-1/4 h-full flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000',
          isActive ? 'left-2/4 top-0 delay-1000 scale-100 opacity-100 rotate-12' : 'left-150 top-1/4 scale-300 delay-500']">
          <img :src="$getImageUrl('/img/home/about/right-2.jpg')" alt="Фото 2" class="w-full h-full object-cover" />
        </div>
        <div class="w-1/4 h-full flex items-center justify-center">
        </div>
      </div>

      <!-- Левый блок -->
      <div class="relative w-2/3 h-full flex flex-col justify-center px-32 z-10 text-left">
        <h2 class="text-5xl font-bold text-my_black mb-4">О нас</h2>
        <p class="text-lg text-my_black mb-6 font-bold">
          Мы — архитектурная компания, которая создаёт уникальные пространства, вдохновляя современными трендами и технологиями.
          У нас огромный опыт как в частной, так и коммерческой застройке.
        </p>
        <a
          href="/about"
          class="text-my_black underline hover:no-underline font-bold"
          :tabindex="isActive ? '0' : '-1'"
        >
          Узнайте больше о нас
        </a>
      </div>

      <!-- Правый блок -->
      <div :class="['relative w-1/3 h-full flex items-center justify-center z-20 pr-32 py-8 transition-all duration-1000 -rotate-6',
        isActive ? 'translate-x-0 delay-3000 scale-100' : 'translate-x-1000 delay-500 scale-150']">
        <div class="w-full h-full flex items-center justify-center">
            <img :src="$getImageUrl('/img/home/about/right-3.jpg')" alt="Фото" class="w-full h-full object-cover" />
        </div>
      </div>

      <!-- Блок с фото низ -->
      <div class="absolute bottom-0 w-full h-1/3 flex z-10">
        <div :class="['absolute w-1/4 h-full flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000',
          isActive ? 'left-0 top-0 scale-100 delay-1500 rotate-6 w-1/4' : 'left-150 top-2/4 delay-500 scale-300']">
          <img :src="$getImageUrl('/img/home/about/right.jpg')" alt="Фото 5" class="w-full h-full object-cover" />
        </div>
        <div :class="['absolute w-1/4 h-full flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000',
          isActive ? 'left-1/4 top-0 scale-100 delay-2000 -rotate-4 w-1/4' : 'left-150 top-1/4 delay-500 scale-300']">
          <img :src="$getImageUrl('/img/home/about/right-2.jpg')" alt="Фото 6" class="w-full h-full object-cover" />
        </div>
        <div :class="['absolute w-1/4 w-1/4 h-full flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000',
          isActive ? 'left-2/4 top-0 scale-100 delay-2500 rotate-12' : 'left-150 top-3/4 delay-500 scale-300']">
          <img :src="$getImageUrl('/img/home/about/right-3.jpg')" alt="Фото 7" class="w-full h-full object-cover" />
        </div>
        <div class="left-3/4 w-1/4 h-full flex items-center justify-center">
        </div>
      </div>
    </section>
</template>

<script>
export default {
    name: "AboutUsComponent",
    props: {
        isActive: {
            type: Boolean,
            required: true
        }
    }
};
</script>

<style scoped>
</style>
