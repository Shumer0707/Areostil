import { defineStore } from 'pinia';

export const usePageState = defineStore('pageState', {
  state: () => ({
    currentBlock: 0, // Текущий блок, отображаемый на экране
    totalBlocks: 0,  // Общее количество блоков на странице
    scrollDisabled: false, // Флаг блокировки прокрутки
    showOverlay: false, // Флаг видимости футера и затемнения
  }),
  getters: {
    isLastBlock(state) {
      // Проверяет, является ли текущий блок последним
      return state.currentBlock === state.totalBlocks - 1;
    },
  },
  actions: {
    updateCurrentBlock(block) {
      // Обновляет текущий блок
      this.currentBlock = block;
    //   console.log(`[Pinia] Current block updated: ${block}`);
    },
    updateTotalBlocks(total) {
      // Обновляет общее количество блоков
      this.totalBlocks = total;
    },
    disableScroll() {
      // Блокирует прокрутку
      this.scrollDisabled = true;
    },
    enableScroll() {
      // Разблокирует прокрутку
      setTimeout(() => {
        this.scrollDisabled = false;
      },750);
    },
    disableBlockScroll(){
        this.disableScroll();
        this.enableScroll();
    },
    toggleOverlay(show) {
      // Управляет видимостью футера и затемнения
      this.showOverlay = show;
    },
  },
});
