<script setup>
import { useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    project: Object,
});

const form = useForm({
    title: props.project.title,
    short_desc: props.project.short_desc,
    client: props.project.client,
    trend: props.project.trend,
    full_desc: props.project.full_desc,
});

const submit = () => {
    form.put(`/admin/projects/${props.project.id}`);
};
</script>

<template>
    <div class="p-6">
        <h1 class="text-2xl font-semibold mb-6">Редактировать проект</h1>
        <div class="bg-white shadow rounded-lg p-4">
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label class="block text-gray-700">Название</label>
                    <input v-model="form.title" class="w-full border rounded p-2" type="text">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Краткое описание</label>
                    <textarea v-model="form.short_desc" class="w-full border rounded p-2"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Клиент</label>
                    <input v-model="form.client" class="w-full border rounded p-2" type="text">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Тренд</label>
                    <input v-model="form.trend" class="w-full border rounded p-2" type="text">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Полное описание</label>
                    <textarea v-model="form.full_desc" class="w-full border rounded p-2"></textarea>
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Сохранить изменения
                </button>
            </form>
        </div>
    </div>
</template>
