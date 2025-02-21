<template>
    <section class="relative w-full h-screen overflow-hidden">

     <div class="relative z-10 flex lg:flex-row flex-col w-full h-full">
        <div class="lg:w-1/3 w-full relative z-10 lg:flex items-center lg:h-full h-1/3 lg:py-0 py-8 flex-wrap bg-my_black text-primary">
            <div class="lg:border border-my_pink lg:p-8 p-4">
                <h3 class="font-serif lg:text-3xl text-2xl font-bold mb-4">Ознакомьтесь с нашими работами</h3>
                <p class="font-sans lg:text-lg text-md">Мы предлагаем уникальные проекты, сочетающие современный стиль и функциональность. Посмотрите наши работы и найдите вдохновение для своего проекта.</p>
            </div>
            <div class="border border-my_pink p-8 w-full lg:flex hidden">
                <h3 class="font-serif text-3xl font-bold mb-4">Тут какие-то цифры должны быть</h3>
            </div>
        </div>
        <!-- Контейнер с перспективой -->
        <div class="lg:w-2/3 w-full gap-4 relative z-10 flex flex-col lg:flex-row items-center lg:py-32 py-8 lg:h-full h-2/3" style="perspective: 900px;">
        <!-- первый блок -->
            <div :class="['w-full h-1/3 bg-my_black bg-cover bg-center rounded-lg shadow-lg transform scale-1 transition-transform duration-700 z-30',
                'hover-effect lg:rotate-y--40 lg:w-1/3 lg:h-full'
            ]">
                <a href="/link1"
                :tabindex="isActive ? '0' : '-1'"
                >
                <img :src="$getImageUrl('/img/home/galery/galery-1.jpg')" alt="Фото 2" class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                <h3 class="font-serif absolute inset-x-0 bottom-4 text-center text-xl font-bold text-my_white">Архитектура</h3>
                </a>
            </div>

            <div :class="['w-full h-1/3 bg-my_black bg-cover bg-center rounded-lg shadow-lg transform scale-1 transition-transform duration-700 z-20',
                'hover-effect lg:rotate-y--40 lg:w-1/3 lg:h-full lg:-ml-32'
            ]">
                <a href="/link2"
                :tabindex="isActive ? '0' : '-1'"
                >
                <img :src="$getImageUrl('/img/home/galery/galery-2.jpg')" alt="Фото 2" class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                <h3 class="font-serif absolute inset-x-0 bottom-4 text-center text-xl font-bold text-my_white">Инженеринг</h3>
                </a>
            </div>

            <div :class="['w-full h-1/3 bg-my_black bg-cover bg-center rounded-lg shadow-lg transform scale-1 transition-transform duration-700 z-10',
                'hover-effect lg:rotate-y--40 lg:w-1/3 lg:h-full lg:-ml-32'
            ]">
                <a href="/link3"
                :tabindex="isActive ? '0' : '-1'"
                >
                <img :src="$getImageUrl('/img/home/galery/galery-4.jpg')" alt="Фото 2" class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                <h3 class="font-serif absolute inset-x-0 bottom-4 text-center text-xl font-bold text-my_white">Дизайн</h3>
                </a>
            </div>
        </div>
     </div>
   </section>
 </template>

 <script>
 export default {
   name: "GaleryComponent",
   props: {
        isActive: {
            type: Boolean,
            required: true
        }
    }
 };
 </script>

<style scoped>
/* @keyframes slide-back {
    0% {
        transform: translateX(100px);
    }
    100% {
        transform: translateX(0);
    }
}

.animate-slide-back {
    animation: slide-back 0.3s ease-out;
} */
.hover-effect {
  position: relative;
  transition: transform 0.7s ease-in-out; /* Плавное возвращение */
  transform-style: preserve-3d;
}
.hover-effect::before,
.hover-effect::after {
  content: '';
  position: absolute;
  /* border: 2px solid var(--color-my-pink); */
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: inherit;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  z-index: -1;
  transform-style: preserve-3d;
}
.hover-effect::before {
  transform: rotateY(0deg) translateZ(-15px);
}
.hover-effect::after {
  transform: rotateY(0deg) translateZ(-30px);
}
.hover-effect:hover {
  transform: rotateY(0deg) translateZ(10px) translateX(50px);
}
/* .hover-effect:not(:hover) {
    animation: slide-in 0.7s ease-in-out;
}
@keyframes slide-back {
    0% {
        transform: rotateY(-40deg) translateZ(0px);
    }
    100% {
        transform: rotateY(0deg) translateZ(10px) translateX(50px);
    }
}
@keyframes slide-in {
    0% {
        transform: rotateY(0deg) translateZ(10px) translateX(50px);
        pointer-events: none;
    }
    100% {
        transform: rotateY(-40deg) translateZ(0px) translateX(0px);
    }
} */
</style>
