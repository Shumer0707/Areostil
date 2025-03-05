<template>
    <section class="relative w-full h-screen flex items-center justify-between bg-cover bg-center overflow-hidden">
      <!-- Блок с текстом слева -->
      <div class="absolute pt-32 md:pt-4 top-0 md:top-1/3 left-0 w-full md:w-3/4 md:h-1/3 h-2/5 flex z-10 bg-my_gray_op flex-col md:px-32 px-4 z-10 justify-center">
        <h2 class="text-3xl lg:text-5xl font-bold text-my_black mb-4">{{ $t('about.about_1_title') }}</h2>
        <p class="text-md lg:text-lg text-my_black mb-6 font-bold">
          {{ $t('about.about_1_description') }}
        </p>
      </div>

      <!-- Блок с фото низ -->
      <div class="absolute bottom-0 w-full h-2/5 md:h-1/3 flex z-20">
        <div :class="['absolute lg:w-1/4 w-1/2 h-full flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000', img1Class]">
          <img :src="$getImageUrl('/img/home/about/right.jpg')" alt="Фото 5" class="w-full h-full object-cover" />
        </div>
        <div :class="['absolute lg:w-1/4 w-1/2 h-full flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000', img2Class]">
          <img :src="$getImageUrl('/img/home/about/right-2.jpg')" alt="Фото 6" class="w-full h-full object-cover" />
        </div>
        <div :class="['absolute lg:w-1/4 w-1/3 h-full hidden md:flex items-center justify-center shadow-2xl overflow-hidden transition-all duration-1000', img3Class]">
          <img :src="$getImageUrl('/img/home/about/right-3.jpg')" alt="Фото 7" class="w-full h-full object-cover" />
        </div>
      </div>

      <!-- Блок с цифрами справа -->
      <div class="absolute md:right-0 md:w-1/4 h-1/5 md:h-full flex md:flex-col z-10 bg-my_gray_op items-center justify-between p-4 md:pt-32 md:pb-16">
        <div class="md:flex hidden flex-col items-center justify-center">
          <h2 class="text-1xl md:text-5xl font-bold text-my_black mb-4 select-none">{{ counter1 }}<span class="text-my_pink">+</span></h2>
          <p class="text-md md:text-lg text-my_black mb-6 font-bold">{{ $t('about.about_1_clients') }}</p>
        </div>
        <div class="flex flex-col items-center justify-center select-none">
          <h2 class="text-1xl md:text-5xl font-bold text-my_black mb-4">{{ counter2 }}<span class="text-my_pink">+</span></h2>
          <p class="text-sm text-md md:text-lg text-my_black mb-6 font-bold">m² {{ $t('about.about_1_commercial') }}</p>
        </div>
        <div class="flex flex-col items-center justify-center select-none">
          <h2 class="text-1xl md:text-5xl font-bold text-my_black mb-4">{{ counter3 }}<span class="text-my_pink">+</span></h2>
          <p class="text-sm md:text-lg text-my_black mb-6 font-bold">m² {{ $t('about.about_1_private') }}</p>
        </div>
        <div class="flex flex-col items-center justify-center select-none">
          <h2 class="text-1xl lg:text-5xl font-bold text-my_black mb-4">{{ counter4 }}<span class="text-my_pink">+</span></h2>
          <p class="text-sm text-md lg:text-lg text-my_black mb-6 font-bold">{{ $t('about.about_1_experience') }}</p>
        </div>
      </div>
    </section>
  </template>

  <script setup>
  import { ref, watch, onMounted, nextTick} from "vue";

  // ✅ Принимаем проп `isActive`
  const props = defineProps({
    isActive: {
      type: Boolean,
      required: true,
    },
  });

  // ✅ Счетчики
  const counter1 = ref(0);
  const counter2 = ref(0);
  const counter3 = ref(0);
  const counter4 = ref(0);

  // ✅ Максимальные значения
  const max1 = 100;
  const max2 = 25000;
  const max3 = 15000;
  const max4 = 21;
  const duration = 2000;

  // ✅ Реактивные классы для анимации изображений
  const imgClassAll = {
  img1: ["left-150 top-1/4 delay-500 scale-300", "lg:left-0 left-0 top-0 scale-100 delay-1000 rotate-6"],
  img2: ["left-150 top-2/4 delay-500 scale-300", "lg:left-1/4 left-1/2 top-0 scale-100 delay-1500 -rotate-4"],
  img3: ["left-150 top-3/4 delay-500 scale-300", "lg:left-2/4 left-2/3 top-0 scale-100 delay-2000 rotate-12"]
};

  const img1Class = ref(imgClassAll.img1[0]);
  const img2Class = ref(imgClassAll.img2[0]);
  const img3Class = ref(imgClassAll.img3[0]);


  // ✅ Запуск анимации (меняет классы)
  const startImageAnimations = async () => {
    await nextTick();
    setTimeout(() => (img1Class.value = imgClassAll.img1[1]), 0);
    setTimeout(() => (img2Class.value = imgClassAll.img2[1]), 0);
    setTimeout(() => (img3Class.value = imgClassAll.img3[1]), 0);
  };

  // ✅ Функция для запуска счетчиков
  const startCounting = (counter, max, delay = 1000) => {
    setTimeout(() => {
      let startTime;
      const step = (timestamp) => {
        if (!startTime) startTime = timestamp;
        const progress = Math.min((timestamp - startTime) / duration, 1);
        counter.value = Math.floor(progress * max);
        if (progress < 1) {
          requestAnimationFrame(step);
        }
      };
      requestAnimationFrame(step);
    }, delay);
  };

  // ✅ Следим за `isActive`
  watch(
    () => props.isActive,
    (newVal) => {
    //   console.log("[CompanyComponent] 🔄 isActive изменился:", newVal);
      if (newVal) {
        startImageAnimations();
        startCounting(counter1, max1, 0);
        startCounting(counter2, max2, 500);
        startCounting(counter3, max3, 1000);
        startCounting(counter4, max4, 1500);
      } else {
        // Если `isActive` === false, сбрасываем классы и счетчики
        img1Class.value = imgClassAll.img1[0];
        img2Class.value = imgClassAll.img2[0];
        img3Class.value = imgClassAll.img3[0];
        counter1.value = 0;
        counter2.value = 0;
        counter3.value = 0;
        counter4.value = 0;
      }
    }, { flush: "post" }
  );

  // ✅ Если `isActive` сразу `true`, запускаем анимации и счетчики
  onMounted(() => {
    // console.log("[CompanyComponent] 🔍 isActive при монтировании:", props.isActive);
    if (props.isActive) {
      startImageAnimations();
      startCounting(counter1, max1, 0);
      startCounting(counter2, max2, 500);
      startCounting(counter3, max3, 1000);
      startCounting(counter4, max4, 1500);
    }
  });
  </script>
