<template>
    <section class="relative w-full h-screen flex items-center justify-between bg-cover bg-center overflow-hidden">
      <!-- :style="{ backgroundImage: 'url(/img/home/about/back.jpg)' }"> -->
      <!-- Полупрозрачный слой затемнения -->
      <!-- <div class="absolute inset-0 bg-primary bg-opacity-50"></div> -->

      <!-- Блок с фото верх -->
      <div class="absolute top-0 w-full h-1/3 flex z-10">
        <div class="w-1/4 h-full lg:flex hidden items-center justify-center ">
        </div>
        <div :class="['absolute lg:w-1/4 w-1/2 h-full flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000',
          isActive ? 'lg:left-1/4 left-0 top-0 delay-500 scale-100 opacity-100 -rotate-6' : 'left-150 top-2/4 scale-300 delay-500']">
          <img :src="$getImageUrl(`/img/about/${photos[0]}`)" alt="random-company-1" class="w-full h-full object-cover" />
        </div>
        <div :class="['absolute lg:w-1/4 w-1/2 h-full flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000',
          isActive ? 'lg:left-2/4 left-1/2 top-0 delay-1000 scale-100 opacity-100 rotate-12' : 'left-150 top-1/4 scale-300 delay-500']">
          <img :src="$getImageUrl(`/img/about/${photos[1]}`)" alt="random-company-2" class="w-full h-full object-cover" />
        </div>
        <div class="lg:w-1/4 w-1/3 h-full lg:flex items-center justify-center hidden">
        </div>
      </div>

      <!-- Левый блок -->
      <div class="relative w-4/5 lg:w-2/3 h-full flex flex-col justify-center md:px-32 px-4 z-10 text-left">
        <h2 class="font-serif text-3xl lg:text-5xl font-bold text-my_black mb-4">{{ $t('home.about_us_title') }}</h2>
        <p class="text-md lg:text-lg text-my_black mb-6 font-bold">
            {{ $t('home.about_us_description') }}
        </p>
        <a
            href="/about"
            class="w-fit inline-block text-my_black font-bold border-b-2 border-b-my_pink_op hover:border-b-my_pink"
            :tabindex="isActive ? '0' : '-1'"
            >
            {{ $t('home.about_us_link') }}
        </a>
      </div>

      <!-- Правый блок -->
      <div :class="['relative w-1/3 h-full items-center justify-center z-20 pr-32 py-8 transition-all duration-1000 -rotate-6 hidden lg:flex',
        isActive ? 'translate-x-0 delay-3000 scale-100' : 'translate-x-1000 delay-500 scale-150']">
        <div class="w-full h-full flex items-center justify-center">
            <img :src="$getImageUrl('/img/about/people-5.webp')" alt="people-5.webp" class="w-full h-full object-cover" />
        </div>
      </div>

      <!-- Блок с фото низ -->
      <div class="absolute bottom-0 w-full h-1/3 flex z-10">
        <div :class="['absolute lg:w-1/4 w-1/3 h-full flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000',
          isActive ? 'lg:left-0 left-0 top-0 scale-100 delay-1500 rotate-6' : 'left-150 top-2/4 delay-500 scale-300']">
          <img :src="$getImageUrl(`/img/about/${photos[2]}`)" alt="random-company-3" class="w-full h-full object-cover" />
        </div>
        <div :class="['absolute lg:w-1/4 w-1/3 h-full flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000',
          isActive ? 'lg:left-1/4 left-1/3 top-0 scale-100 delay-2000 -rotate-4' : 'left-150 top-1/4 delay-500 scale-300']">
          <img :src="$getImageUrl(`/img/about/${photos[3]}`)" alt="random-company-4" class="w-full h-full object-cover" />
        </div>
        <div :class="['absolute lg:w-1/4 w-1/3 h-full flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000',
          isActive ? 'lg:left-2/4 left-2/3 top-0 scale-100 delay-2500 rotate-12' : 'left-150 top-3/4 delay-500 scale-300']">
          <img :src="$getImageUrl(`/img/about/${photos[4]}`)" alt="random-company-5" class="w-full h-full object-cover" />
        </div>
        <div class="left-3/4 w-1/4 h-full lg:flex hidden items-center justify-center">
        </div>
      </div>
    </section>
</template>

<script setup>
import { ref, watch } from 'vue';
import { getRandomPhotos } from '@/utils/random'; // Импортируем функцию

const props = defineProps({
    isActive: Boolean,
});

const allPhotos = [ 'people-1.webp', 'people-2.webp', 'people-3.webp', 'people-4.webp', 'people-5.webp', 'people-6.webp',
'people-9.webp', 'people-10.webp', 'people-11.webp',
];

const photos = ref(getRandomPhotos(allPhotos, 5));


watch(() => props.isActive, (newVal) => {
    if (newVal) {
        photos.value = getRandomPhotos(allPhotos, 5);
    }
});

</script>
