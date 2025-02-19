<script setup>
import { defineProps } from 'vue';
import { Link, router } from '@inertiajs/vue3';
const props = defineProps({
    projects: Array,
});
const deleteProject = (id) => {
    if (confirm('Вы уверены, что хотите удалить этот проект?')) {
        router.delete(`/admin/projects/${id}`);
    }
};
</script>

<template>
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <Link
                href="/dashboard"
                class="flex px-4 py-2 bg-my_pink text-white rounded-lg hover:bg-my_pink_op items-center justify-center"
            >
                Назад
            </Link>
            <h1 class="text-2xl font-semibold">Список проектов</h1>
            <Link
                href="/admin/projects/create"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
                Создать проект
            </Link>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">ID</th>
                        <th class="border px-4 py-2">Название</th>
                        <th class="border px-4 py-2">Клиент</th>
                        <th class="border px-4 py-2">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="project in projects" :key="project.id">
                        <td class="border px-4 py-2">{{ project.id }}</td>
                        <td class="border px-4 py-2">{{ project.translations[0]?.title || "Нет имени"}}</td>
                        <td class="border px-4 py-2">{{ project.client }}</td>
                        <td class="border px-4 py-2">
                            <Link
                                :href="`/admin/projects/${project.id}/edit`"
                                class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600"
                            >
                                Редактировать
                            </Link>
                            <Link
                                :href="`/admin/projects/${project.id}/images`"
                                class="px-2 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 ml-2"
                            >
                                Изображения
                            </Link>
                            <button
                                @click="deleteProject(project.id)"
                                class="px-2 py-1 bg-red-500 text-white rounded ml-2 hover:bg-red-600"
                            >
                                Удалить
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

