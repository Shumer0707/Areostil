<template>
 <section class="relative w-full h-screen flex items-center justify-between bg-cover bg-center overflow-hidden">
    <!-- Блок с текстом с лева и центр -->
    <div class="absolute top-1/3 left-0 w-3/4 h-1/3 flex z-10 bg-my_silver flex flex-col md:px-32 px-4 z-10 justify-center">
        <h2 class="text-3xl lg:text-5xl font-bold text-my_black mb-4">{{ $t('about.about_1_title') }}</h2>
        <p class="text-md lg:text-lg text-my_black mb-6 font-bold">
            {{ $t('about.about_1_description') }}
        </p>
    </div>
    <!-- Блок с фото низ -->
    <div class="absolute bottom-0 w-full h-1/3 flex z-20">
        <div :class="['absolute lg:w-1/4 w-1/3 h-full flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000',
          isActive ? 'lg:left-0 left-0 top-0 scale-100 delay-1500 rotate-6' : 'left-150 top-2/4 delay-500 scale-300']">
          <img :src="$getImageUrl('/img/home/about/right.jpg')" alt="Фото 5" class="w-full h-full object-cover" />
        </div>
        <div :class="['absolute lg:w-1/4 w-1/3 h-full flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000',
          isActive ? 'lg:left-1/4 left-1/3 top-0 scale-100 delay-2000 -rotate-4' : 'left-150 top-1/4 delay-500 scale-300']">
          <img :src="$getImageUrl('/img/home/about/right-2.jpg')" alt="Фото 6" class="w-full h-full object-cover" />
        </div>
        <div :class="['absolute lg:w-1/4 w-1/3 h-full flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000',
          isActive ? 'lg:left-2/4 left-2/3 top-0 scale-100 delay-2500 rotate-12' : 'left-150 top-3/4 delay-500 scale-300']">
          <img :src="$getImageUrl('/img/home/about/right-3.jpg')" alt="Фото 7" class="w-full h-full object-cover" />
        </div>
        <div class="left-3/4 w-1/4 h-full lg:flex hidden items-center justify-center">
        </div>
    </div>
    <!-- Блок с цифрами право -->
    <div class="absolute right-0 w-1/4 h-full flex flex-col z-10 bg-my_silver items-center justify-between pt-32 pb-16">
        <div class="flex flex-col items-center justify-center">
            <h2 class="text-1xl lg:text-5xl font-bold text-my_black mb-4">100+</h2>
            <p class="text-md lg:text-lg text-my_black mb-6 font-bold">
                {{ $t('about.about_1_clients') }}
            </p>
        </div>
        <div class="flex flex-col items-center justify-center">
            <h2 class="text-1xl lg:text-5xl font-bold text-my_black mb-4">25000+</h2>
            <p class="text-md lg:text-lg text-my_black mb-6 font-bold">
                m2 {{ $t('about.about_1_commercial') }}
            </p>
        </div>
        <div class="flex flex-col items-center justify-center">
            <h2 class="text-1xl lg:text-5xl font-bold text-my_black mb-4">15000+</h2>
            <p class="text-md lg:text-lg text-my_black mb-6 font-bold">
                m2 {{ $t('about.about_1_private') }}
            </p>
        </div>
        <div class="flex flex-col items-center justify-center">
            <h2 class="text-1xl lg:text-5xl font-bold text-my_black mb-4">21+</h2>
            <p class="text-md lg:text-lg text-my_black mb-6 font-bold">
                {{ $t('about.about_1_experience') }}
            </p>
        </div>
    </div>
 </section>
</template>

<script>
export default {
    name: "CompanyComponent",
    props: {
        isActive: {
            type: Boolean,
            required: true
        }
    }
};
</script>

<style>
</style>
