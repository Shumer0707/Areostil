<template>
    <section class="relative w-full h-screen flex flex-col items-center justify-evenly bg-cover bg-center overflow-hidden">
      <div v-if="loading" class="text-center text-xl">Загрузка...</div>
      <div v-else>
        <h1 class="text-3xl font-bold mb-4">{{ project.title }}</h1>
        <p class="mb-4">{{ project.short_desc }}</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
          <img v-for="(photo, index) in project.images" :key="index" :src="photo.url" class="rounded-lg shadow-md" />
        </div>
      </div>
    </section>
  </template>

  <script>
  import axios from 'axios';

  export default {
    name: 'ProjectPageComponent',
    props: ['id'],  // Получаем id проекта из URL
    data() {
      return {
        project: {},
        loading: true
      };
    },
    mounted() {
      this.fetchProject();
    },
    methods: {
      fetchProject() {
        axios.get(`/api/projects/${this.id}`)
          .then(response => {
            this.project = response.data;
            this.loading = false;
          })
          .catch(error => {
            console.error('Ошибка загрузки проекта:', error);
            this.loading = false;
          });
      }
    }
  }
  </script>
