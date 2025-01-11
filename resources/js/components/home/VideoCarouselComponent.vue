<template>
    <section class="relative w-full h-screen flex items-center justify-center overflow-hidden">
      <!-- Видео Карусель -->
      <div class="relative w-full h-full flex items-center">
        <!-- Левая стрелка -->
        <button
          @click="prevVideo"
          class="absolute left-4 z-10 bg-black bg-opacity-50 text-white p-2 rounded-full">
          &#9664;
        </button>

        <!-- Видео слайдер -->
        <div class="flex w-full h-full items-center justify-center space-x-4 overflow-hidden">
          <div v-for="(video, index) in videos" :key="index"
            class="flex-none w-[70%] h-4/5 overflow-hidden relative rounded-lg shadow-lg transition-transform duration-700"
            :style="{ transform: `translateX(${-currentVideo * 90}%)` }">
            <video
              :src="video.src"
              class="w-full h-full object-cover cursor-pointer"
              :autoplay="currentVideo === index"
              muted
              loop
              playsinline
              @click="playVideo(index)"></video>
          </div>
        </div>

        <!-- Правая стрелка -->
        <button
          @click="nextVideo"
          class="absolute right-4 z-10 bg-black bg-opacity-50 text-white p-2 rounded-full">
          &#9654;
        </button>
      </div>
    </section>
  </template>

  <script>
  export default {
    name: "VideoCarouselComponent",
    data() {
      return {
        videos: [
          { src: '/videos/video1.mp4' },
          { src: '/videos/video2.mp4' },
          { src: '/videos/video3.mp4' }
        ],
        currentVideo: 0,
      };
    },
    methods: {
      playVideo(index) {
        this.currentVideo = index;
        const videoElements = this.$el.querySelectorAll('video');
        videoElements[index].play();
      },
      nextVideo() {
        this.currentVideo = (this.currentVideo + 1) % this.videos.length;
      },
      prevVideo() {
        this.currentVideo = (this.currentVideo - 1 + this.videos.length) % this.videos.length;
      },
    },
  };
  </script>

  <style scoped>
  section {
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
  }
  video {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
    cursor: pointer;
  }
  </style>
