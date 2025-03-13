<script setup>
import { defineProps, ref } from 'vue';
import { useForm, router, Link } from '@inertiajs/vue3';

const props = defineProps({
    project: Object,
    images: Array,
});

// Состояния
const files = ref([]);
const errorMessage = ref(null); // Храним ошибки

// Форма
const form = useForm({
    images: [],
});

// Обработчик загрузки файлов
const handleFiles = (event) => {
    const selectedFiles = Array.from(event.target.files);

    // Разрешенные типы файлов (добавляем webp)
    const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
    const maxSize = 2 * 1024 * 1024; // 2MB

    files.value = selectedFiles.filter(file => {
        if (!allowedTypes.includes(file.type)) {
            alert(`Файл ${file.name} имеет недопустимый формат!`);
            return false;
        }
        if (file.size > maxSize) {
            alert(`Файл ${file.name} превышает 2MB!`);
            return false;
        }
        return true;
    });

    event.target.value = ''; // Очищаем input после выбора
};

// Функция загрузки файлов
const uploadImages = () => {
    if (!files.value.length) {
        errorMessage.value = 'Выберите файлы для загрузки!';
        return;
    }

    errorMessage.value = null; // Очищаем ошибки перед отправкой

    const formData = new FormData();
    files.value.forEach(file => {
        formData.append('images[]', file);
    });

    router.post(`/admin/projects/${props.project.id}/images`, formData, {
        onSuccess: () => {
            files.value = [];
            errorMessage.value = null; // Очищаем ошибки после успешной загрузки
        },
        onError: (errors) => {
            console.log("Ошибки с сервера:", errors);

            // Собираем все ошибки валидации
            const errorMessages = Object.values(errors).flat();
            errorMessage.value = errorMessages.join(', ');
        }
    });
};

// Удаление изображения
const deleteImage = (id) => {
    if (confirm('Удалить это изображение?')) {
        router.delete(`/admin/projects/${props.project.id}/images/${id}`);
    }
};

// Установка обложки
const setAsCover = (id) => {
    router.put(`/admin/projects/${props.project.id}/set-cover`, { image_id: id });
};
</script>

<template>
    <div class="p-6">
        <div class="flex justify-between">
            <h1 class="text-2xl font-semibold mb-6">Изображения для {{ project.translations[0]?.title }}</h1>
            <Link
                href="/admin/projects"
                class="flex px-4 py-2 bg-my_pink text-white rounded-lg hover:bg-my_pink_op items-center justify-center"
            >
                Назад
            </Link>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <!-- Форма загрузки изображений -->
            <form @submit.prevent="uploadImages" class="mb-4">
                <input type="file" multiple @change="handleFiles" class="border p-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Загрузить
                </button>
            </form>

            <!-- Ошибки валидации -->
            <div v-if="errorMessage" class="text-red-500 mb-4">
                {{ errorMessage }}
            </div>

            <!-- Показываем выбранные файлы перед загрузкой -->
            <div v-if="files.length" class="mb-4">
                <p class="text-gray-600">Выбранные файлы:</p>
                <ul class="list-disc pl-5">
                    <li v-for="file in files" :key="file.name">{{ file.name }} ({{ (file.size / 1024).toFixed(1) }} KB)</li>
                </ul>
            </div>

            <!-- Галерея загруженных изображений -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div
                    v-for="image in images"
                    :key="image.id"
                    class="relative border-4 rounded-lg shadow"
                    :class="image.image_path === project.cover_image ? 'border-yellow-500' : 'border-gray-300'"
                >
                    <img :src="image.image_path" class="w-full h-32 object-cover rounded">

                    <span
                        v-if="image.image_path === project.cover_image"
                        class="absolute top-2 left-2 bg-yellow-500 text-white px-2 py-1 text-xs rounded"
                    >
                        Обложка
                    </span>

                    <button
                        @click="deleteImage(image.id)"
                        class="absolute top-2 right-2 bg-red-500 text-white rounded p-1 text-sm"
                    >
                        ✕
                    </button>
                    <button
                        @click="setAsCover(image.id)"
                        class="absolute bottom-2 left-2 bg-yellow-500 text-white rounded p-1 text-sm"
                    >
                        Сделать обложкой
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
