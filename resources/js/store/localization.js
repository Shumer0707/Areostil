import { defineStore } from 'pinia';
import axios from 'axios';

export const useLocalizationStore = defineStore('localization', {
    state: () => ({
        translations: {},
    }),
    actions: {
        async fetchTranslations() {
            try {
                const response = await axios.get('/api/translations');
                this.translations = response.data;
            } catch (error) {
                console.error("Ошибка загрузки переводов:", error);
            }
        },
    }
});
