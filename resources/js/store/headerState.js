import { defineStore } from 'pinia';

export const useHeaderState = defineStore('headerState', {
    state: () => ({
        animationHeader: 'animation-none',
        isMainMenuVisible: false,
    }),
    actions: {
        setAnimationHeader(status) {
            this.animationHeader = status;
        },
        toggleMainMenu() {
            this.isMainMenuVisible = !this.isMainMenuVisible;

        },
        closeMainMenu() {
            this.isMainMenuVisible = false;
        }
    },
});
