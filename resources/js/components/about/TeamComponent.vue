<template>
    <section class="relative w-full h-screen flex items-center justify-between bg-cover bg-center overflow-hidden">
        <!-- <div class="absolute bottom-0 w-full h-full flex z-20"> -->
            <div :class="['absolute p-4 lg:w-3/4 w-1/3 h-1/3 flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000',
            isActive ? 'lg:left-0 left-0 top-0 scale-100 delay-1500' : 'left-200 top-2/4 delay-500 scale-300']">
                <img :src="$getImageUrl('/img/home/about/right-2.jpg')" alt="Фото 5" class="w-1/4 h-full object-cover" />
                <div class="flex flex-col items-center justify-center w-3/4 h-full">
                    <h2 class="text-1xl lg:text-5xl font-bold text-my_black mb-4">{{ $t('about.about_2_name_1') }}</h2>
                    <p class="text-md lg:text-lg text-my_black mb-6 font-bold">
                        {{ $t('about.about_2_description_1') }}
                    </p>
                </div>
            </div>
            <div :class="['absolute p-4 lg:w-3/4 w-1/3 h-1/3 flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000',
            isActive ? 'lg:left-[calc(25%-8rem)] left-0 top-1/3 scale-100 delay-2000' : 'left-200 top-2/4 delay-500 scale-300']">
                <img :src="$getImageUrl('/img/home/about/right-3.jpg')" alt="Фото 5" class="w-1/4 h-full object-cover" />
                <div class="flex flex-col items-center justify-center w-3/4 h-full">
                    <h2 class="text-1xl lg:text-5xl font-bold text-my_black mb-4">{{ $t('about.about_2_name_2') }}</h2>
                    <p class="text-md lg:text-lg text-my_black mb-6 font-bold">
                        {{ $t('about.about_2_description_2') }}
                    </p>
                </div>
            </div>
            <div :class="['absolute p-4 lg:w-3/4 w-1/3 h-1/3 flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000',
            isActive ? 'lg:left-0 left-0 top-2/3 scale-100 delay-2500' : 'left-200 top-2/4 delay-500 scale-300']">
                <img :src="$getImageUrl('/img/home/about/right.jpg')" alt="Фото 5" class="w-1/4 h-full object-cover" />
                <div class="flex flex-col items-center justify-center w-3/4 h-full">
                    <h2 class="text-1xl lg:text-5xl font-bold text-my_black mb-4">{{ $t('about.about_2_name_3') }}</h2>
                    <p class="text-md lg:text-lg text-my_black mb-6 font-bold">
                        {{ $t('about.about_2_description_3') }}
                    </p>
                </div>
            </div>
        <!-- </div> -->
    </section>
</template>

<script>
    export default{
        name : 'TeamComponent',
        props: {
            isActive: {
                type: Boolean,
                required: true
            }
        }
    }
</script>
