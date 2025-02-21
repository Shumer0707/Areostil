<template>
    <div ref="menuRef"
        :class="['absolute right-4 flex bg-my_black shadow-lg transition-all duration-500 ease-in-out opacity-100 md:opacity-80 text-xl font-normal',
            'hover:opacity-100',
            'md:right-8',
            'lg:right-16',
            isTop ? 'top-100' : 'flex-col h-screen top-0 w-64'
        ]"
        v-if="headerState.isMainMenuVisible"
    >
        <ul :class="[isTop ? 'mx-12 my-6' : 'mx-auto py-6 border-b']">
            <!-- Ссылки на языки -->
            <li><a href="#" @click.prevent="setLanguage('ru')" class="block p-2 hover:border">RU</a></li>
            <li><a href="#" @click.prevent="setLanguage('ro')" class="block p-2 hover:border">RO</a></li>
        </ul>
        <ul :class="[isTop ? 'mx-12 my-6 text-center ' : 'mx-auto py-6 border-b text-center']">
            <!-- Основные ссылки навигации -->
            <li><a href="/" class="block p-2 hover:border">{{ $t('header.home') }}</a></li>
            <li><a href="/about" class="block p-2 hover:border">{{ $t('header.about') }}</a></li>
            <li><a href="/gallery" class="block p-2 hover:border">{{ $t('header.gallery') }}</a></li>
            <li><a href="/contact" class="block p-2 hover:border">{{ $t('header.contact') }}</a></li>
            <li><a href="/dashboard" class="block p-2 hover:border">dashboard</a></li>
        </ul>
    </div>
</template>

<script>
import { useHeaderState } from '../../store/headerState';
import { usePageState } from '../../store/pageState';
import { computed, ref, watch, onMounted, onUnmounted } from 'vue';
import { router } from '@inertiajs/vue3';

export default {
    name: 'HeaderMenuComponent',

    setup(){
        const pageState = usePageState();
        const currentBlock = computed(() => pageState.currentBlock);
        const isTop = ref(computed(() => pageState.currentBlock === 0));

        const headerState = useHeaderState();

        // Закрытие меню при клике вне его области
        const menuRef = ref(null);

        const closeMenu = (event) => {
            if (headerState.isMainMenuVisible && menuRef.value && !menuRef.value.contains(event.target) && !event.target.closest("header") ) {
                headerState.closeMainMenu();
            };
        };

        watch(currentBlock, () => {
            if (headerState.isMainMenuVisible) {
                headerState.closeMainMenu();
            }
        });

        onMounted(() => {
            document.addEventListener('click', closeMenu);
        });

        onUnmounted(() => {
            document.removeEventListener('click', closeMenu);
        });

        // Функция для смены языка
        const setLanguage = async (lang) => {
            try {
                await axios.get(`/api/translations?lang=${lang}`); // ✅ Теперь передаём язык в Laravel
                localStorage.setItem('lang', lang);
                location.reload(); // ✅ Обновляем страницу, чтобы Laravel применил язык
            } catch (error) {
                console.error("Ошибка смены языка:", error);
            }
        };

        return { headerState, menuRef, isTop, setLanguage }
    }
}
</script>
