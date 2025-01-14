<template>
    <section v-if="showFooter">
        <div class="flex justify-between items-center">
            <!-- Логотип -->
            <div>
                <a href=""><img :src="$getImageUrl('/img/logo/log-1.png')" alt="Areostil logo" class="w-32 h-32"></a>
            </div>
            <!-- Навигация -->
            <nav class="flex gap-8 text-primary">
                <a href="/" class="hover:text-primary">Home</a>
                <a href="/about" class="hover:text-primary">About</a>
                <a href="/galery" class="hover:text-primary">Galery</a>
                <a href="/contact" class="hover:text-primary">Contact</a>
            </nav>
            <!-- Контакты -->
            <div class="text-sm text-primary">
                <p>Email: info@areostil.com</p>
                <p>Phone: +123456789</p>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "FooterComponent",
        data() {
            return {
                showFooter: false,
                lastScrollY: 0 // Позиция скролла для определения направления
            };
        },
        mounted() {
            window.addEventListener('scroll', this.handleScroll);
            window.addEventListener('touchstart', this.handleTouchStart);
            window.addEventListener('touchend', this.handleTouchEnd);
            console.log(window.showFooter);
        },
        beforeDestroy() {
            window.removeEventListener('scroll', this.handleScroll);
            window.removeEventListener('touchstart', this.handleTouchStart);
            window.removeEventListener('touchend', this.handleTouchEnd);
        },
        methods: {
            handleScroll() {
                if (!window.showFooter) return; // Проверяем глобальный флаг

                const currentScrollY = window.scrollY;
                if (currentScrollY > this.lastScrollY) {
                    // Скролл вниз — показываем футер
                    this.showFooter = true;
                } else {
                    // Скролл вверх — скрываем футер
                    this.showFooter = false;
                }
                this.lastScrollY = currentScrollY;
            },
            handleTouchStart(event) {
                this.touchStartY = event.touches[0].clientY;
            },
            handleTouchEnd(event) {
                if (!window.showFooter) return; // Проверяем глобальный флаг

                const touchEndY = event.changedTouches[0].clientY;
                const touchDelta = this.touchStartY - touchEndY;

                if (touchDelta > 50) {
                    // Свайп вверх — скрываем футер
                    this.showFooter = false;
                } else if (touchDelta < -50) {
                    // Свайп вниз — показываем футер
                    this.showFooter = true;
                }
            }
        }
    };
</script>
