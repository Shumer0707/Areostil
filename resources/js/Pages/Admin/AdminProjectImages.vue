<script setup>
import { defineProps } from 'vue';
import { useForm, router, Link  } from '@inertiajs/vue3';

const props = defineProps({
    project: Object,
    images: Array,
});

const form = useForm({
    image: null,
});

const uploadImage = () => {
    form.post(`/admin/projects/${props.project.id}/images`, {
        onSuccess: () => {
            form.reset();
        }
    });
};

const deleteImage = (id) => {
    if (confirm('Удалить это изображение?')) {
        router.delete(`/admin/projects/${props.project.id}/images/${id}`);
    }
};

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
            <form @submit.prevent="uploadImage" class="mb-4">
                <input type="file" @change="form.image = $event.target.files[0]" class="border p-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Загрузить
                </button>
            </form>

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
