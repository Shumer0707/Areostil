<template>
    <section class="relative w-full h-screen overflow-hidden">

     <div class="relative z-10 flex w-full h-full mx-32">
        <div class="w-1/3 relative z-10 flex items-center h-full flex-wrap bg-my_black text-primary">
            <div class="border border-primary p-8">
                <h3 class="text-3xl font-bold mb-4">Ознакомьтесь с нашими работами</h3>
                <p class="text-lg">Мы предлагаем уникальные проекты, сочетающие современный стиль и функциональность. Посмотрите наши работы и найдите вдохновение для своего проекта.</p>
            </div>
            <div class="border border-primary p-8 w-full">
                <h3 class="text-3xl font-bold mb-4">Тут какие-то цифры должны быть</h3>
            </div>
        </div>
        <!-- Контейнер с перспективой -->
        <div class="w-2/3 relative z-10 flex items-center py-32 h-full mr-32" style="perspective: 1100px;">
        <!-- первый блок -->
            <div class="w-1/3 h-full bg-my_black bg-cover bg-center rounded-lg shadow-lg transform rotate-y--40 scale-95 transition-transform duration-700 hover-effect z-30">
                <a href="/link1">
                <img :src="$getImageUrl('/img/home/galery/galery-1.jpg')" alt="Фото 2" class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                <h3 class="absolute inset-x-0 bottom-4 text-center text-xl font-bold text-white">Архитектура</h3>
                </a>
            </div>

            <div class="w-1/3 h-full bg-my_black bg-cover bg-center rounded-lg shadow-lg transform rotate-y--40 scale-95 transition-transform duration-700 hover-effect -ml-10 z-20">
                <a href="/link2">
                <img :src="$getImageUrl('/img/home/galery/galery-2.jpg')" alt="Фото 2" class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                <h3 class="absolute inset-x-0 bottom-4 text-center text-xl font-bold text-white">Инженеринг</h3>
                </a>
            </div>

            <div class="w-1/3 h-full bg-my_black bg-cover bg-center rounded-lg shadow-lg transform rotate-y--40 scale-95 transition-transform duration-700 hover-effect -ml-10 z-10">
                <a href="/link1">
                <img :src="$getImageUrl('/img/home/galery/galery-4.jpg')" alt="Фото 2" class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-black bg-opacity-50"></div>
                <h3 class="absolute inset-x-0 bottom-4 text-center text-xl font-bold text-white">Дизайн</h3>
                </a>
            </div>
        </div>
     </div>
   </section>
 </template>

 <script>
 export default {
   name: "GaleryComponent",
 };
 </script>

<style scoped>
.hover-effect {
  position: relative;
  transition: transform 1s;
  transform-style: preserve-3d;
}
.hover-effect::before,
.hover-effect::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  /* background-size: cover;
  background-position: center; */
  /* border: 1px solid white; */
  /* background-image: url('/img/home/galery/left.jpg'); */
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
  transform: rotateY(0deg) scale(1.1) translateZ(10px) translateX(50px);
  /* z-index: 40; */
}
</style>
