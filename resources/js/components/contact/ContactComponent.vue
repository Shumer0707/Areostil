<template>
    <section class="relative w-full h-screen flex items-center justify-center bg-cover bg-center overflow-hidden p-8">
        <div class="bg-my_silver h-auto w-full max-w-4xl flex flex-col md:flex-row items-center shadow-lg p-8">
            <div class="w-full md:w-1/2 p-4">
                <h2 class="text-2xl lg:text-4xl font-bold text-my_black mb-6 text-center">{{ $t('contact.contact_title_1') }}</h2>
                <form @submit.prevent="sendMessage" class="flex flex-col gap-4">
                    <div>
                        <label for="name" class="block text-my_black text-lg font-semibold mb-2">{{ $t('contact.contact_name') }}</label>
                        <input v-model="form.name" type="text" id="name" class="w-full p-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-my_black"
                        :placeholder = "$t('contact.contact_name_placeholder')">
                    </div>
                    <div>
                        <label for="email" class="block text-my_black text-lg font-semibold mb-2">{{ $t('contact.contact_email') }}</label>
                        <input v-model="form.email" type="email" id="email" class="w-full p-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-my_black"
                        :placeholder = "$t('contact.contact_email_placeholder')">
                    </div>
                    <div>
                        <label for="message" class="block text-my_black text-lg font-semibold mb-2">{{ $t('contact.contact_message') }}</label>
                        <textarea v-model="form.message" id="message" class="w-full p-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-my_black h-32"
                        :placeholder = "$t('contact.contact_message_placeholder')"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-my_black text-white text-lg font-semibold py-3 hover:bg-opacity-90 transition duration-300">
                        {{ loading ? $t('contact.contact_btn_load') : $t('contact.contact_btn') }}
                    </button>
                </form>
                <p v-if="successMessage" class="text-green-600 text-center mt-4">{{ successMessage }}</p>
                <p v-if="errorMessage" class="text-red-600 text-center mt-4">{{ errorMessage }}</p>
            </div>
            <div class="w-full md:w-1/2 flex flex-col items-center p-4">
                <h2 class="text-2xl lg:text-4xl font-bold text-my_black mb-4 text-center">{{ $t('contact.contact_title_2') }}</h2>
                <p class="text-lg lg:text-xl text-my_black font-bold mb-4 text-center">📍 {{ $t('contact.contact_addres') }}</p>
                <p class="text-lg lg:text-xl text-my_black font-bold mb-4 text-center">📞 +373987456321</p>
                <p class="text-lg lg:text-xl text-my_black font-bold mb-4 text-center">✉️ areostil_info@gmail.com</p>
            </div>
        </div>
    </section>
</template>

<script>
import axios from "axios";

export default {
    name: "ContactComponent",
    data() {
        return {
            form: {
                name: "",
                email: "",
                message: ""
            },
            loading: false,
            successMessage: "",
            errorMessage: ""
        };
    },
    methods: {
        async sendMessage() {
            this.loading = true;
            this.successMessage = "";
            this.errorMessage = "";

            try {
                const response = await axios.post("api/contact/send", this.form);
                this.successMessage = response.data.message;
                this.form = { name: "", email: "", message: "" };
            } catch (error) {
                this.errorMessage = "Ошибка отправки. Попробуйте позже.";
            } finally {
                this.loading = false;
            }
        }
    }
};
</script>
