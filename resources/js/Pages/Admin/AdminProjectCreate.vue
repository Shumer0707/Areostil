<script setup>
import { ref } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';

const form = useForm({
    client: '',
    trend: '',
    translations: {
        ru: { title: '', short_desc: '', full_desc: '' },
        ro: { title: '', short_desc: '', full_desc: '' },
    }
});

const submit = () => {
    form.post('/admin/projects');
};
</script>

<template>
    <div class="p-6 overflow-auto h-screen">
        <div class="flex justify-between">
            <h1 class="text-2xl font-semibold mb-6">Создать новый проект</h1>
            <Link
                href="/admin/projects"
                class="flex px-4 py-2 bg-my_pink text-white rounded-lg hover:bg-my_pink_op items-center justify-center"
            >
                Назад
            </Link>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label class="block text-gray-700">Клиент</label>
                    <input v-model="form.client" class="w-full border rounded p-2" type="text">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Тренд</label>
                    <input v-model="form.trend" class="w-full border rounded p-2" type="text">
                </div>

                <!-- Русский перевод -->
                <h2 class="text-xl font-semibold mb-2">Русский</h2>
                <div class="mb-4">
                    <label class="block text-gray-700">Название</label>
                    <input v-model="form.translations.ru.title" class="w-full border rounded p-2" type="text">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Краткое описание</label>
                    <textarea v-model="form.translations.ru.short_desc" class="w-full border rounded p-2"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Полное описание</label>
                    <textarea v-model="form.translations.ru.full_desc" class="w-full border rounded p-2"></textarea>
                </div>

                <!-- Румынский перевод -->
                <h2 class="text-xl font-semibold mb-2">Română</h2>
                <div class="mb-4">
                    <label class="block text-gray-700">Titlu</label>
                    <input v-model="form.translations.ro.title" class="w-full border rounded p-2" type="text">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Descriere scurtă</label>
                    <textarea v-model="form.translations.ro.short_desc" class="w-full border rounded p-2"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Descriere completă</label>
                    <textarea v-model="form.translations.ro.full_desc" class="w-full border rounded p-2"></textarea>
                </div>

                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Создать
                </button>
            </form>
        </div>
    </div>
</template>
