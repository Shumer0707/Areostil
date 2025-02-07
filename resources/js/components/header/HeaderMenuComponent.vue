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
            <li><a href="#" class="block p-2 hover:border">RU</a></li>
            <li><a href="#" class="block p-2 hover:border">RO</a></li>
        </ul>
        <ul :class="[isTop ? 'mx-12 my-6 text-center ' : 'mx-auto py-6 border-b text-center']">
            <!-- Основные ссылки навигации -->
            <li><a href="/" class="block p-2 hover:border">Home</a></li>
            <li><a href="/about" class="block p-2 hover:border">About</a></li>
            <li><a href="/gallery" class="block p-2 hover:border">Gallery</a></li>
            <li><a href="/contact" class="block p-2 hover:border">Contact</a></li>
        </ul>
    </div>
</template>

<script>
import { useHeaderState } from '../../store/headerState';
import { usePageState } from '../../store/pageState';
import { computed, ref, watch, onMounted, onUnmounted } from 'vue';

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
            // if (headerState.isMainMenuVisible && menuRef.value && !menuRef.value.contains(event.target) && event.target.dataset.id !== 'menu-button') {
            if (headerState.isMainMenuVisible && menuRef.value && !menuRef.value.contains(event.target) && !event.target.closest("header") ) {
                headerState.closeMainMenu();
            };
        };
        // Закрытие меню при прокрутке или свайпе
        watch(currentBlock, () => {
            if (headerState.isMainMenuVisible) {
                headerState.closeMainMenu();
            }
        });

        // Добавление обработчиков событий при монтировании компонента
        onMounted(() => {
            document.addEventListener('click', closeMenu); // Закрытие при клике вне меню
        });

        // Удаление обработчиков событий при размонтировании компонента
        onUnmounted(() => {
            document.removeEventListener('click', closeMenu);
        });

        return {headerState, menuRef, isTop}
    }
}
</script>
