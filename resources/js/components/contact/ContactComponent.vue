<template>
    <section class="relative w-full h-screen flex items-center justify-center bg-cover bg-center overflow-hidden p-8">
        <div class="bg-my_silver h-auto w-full max-w-4xl flex flex-col md:flex-row items-center shadow-lg p-8">
            <div class="w-full md:w-1/2 p-4">
                <h2 class="text-2xl lg:text-4xl font-bold text-my_black mb-6 text-center">Свяжитесь с нами</h2>
                <form action="" class="flex flex-col gap-4">
                    <div>
                        <label for="name" class="block text-my_black text-lg font-semibold mb-2">Ваше имя</label>
                        <input type="text" id="name" class="w-full p-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-my_black" placeholder="Введите ваше имя">
                    </div>
                    <div>
                        <label for="email" class="block text-my_black text-lg font-semibold mb-2">Ваш Email</label>
                        <input type="email" id="email" class="w-full p-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-my_black" placeholder="Введите ваш email">
                    </div>
                    <div>
                        <label for="message" class="block text-my_black text-lg font-semibold mb-2">Ваше сообщение</label>
                        <textarea id="message" class="w-full p-3 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-my_black h-32" placeholder="Введите ваше сообщение"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-my_black text-white text-lg font-semibold py-3 hover:bg-opacity-90 transition duration-300">Отправить</button>
                </form>
            </div>
            <div class="w-full md:w-1/2 flex flex-col items-center p-4">
                <h2 class="text-2xl lg:text-4xl font-bold text-my_black mb-4">Контакты</h2>
                <p class="text-lg lg:text-xl text-my_black font-bold mb-4">📍 Кишинев, ул. Василе Александри 1</p>
                <p class="text-lg lg:text-xl text-my_black font-bold mb-4">📞 +373987456321</p>
                <p class="text-lg lg:text-xl text-my_black font-bold mb-4">✉️ areostil_info@gmail.com</p>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "ContactComponent",
};
</script>
