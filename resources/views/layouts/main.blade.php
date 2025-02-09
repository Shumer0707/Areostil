<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-background text-text flex flex-col min-h-screen">
    {{-- <header class="fixed top-0 left-0 w-full bg-transparent z-30 flex justify-between items-center px-32 py-8">
        <div class="text-xl font-bold text-primary">
            <a href=""><img src="/img/logo/log-2.png" alt="Areostil logo" class="w-32 h-32"></a>
        </div>
        <div class="flex items-center gap-4">
            <button
            class="w-12 h-12 bg-transparent text-my_white rounded-full flex items-center justify-center
                hover:text-primary hover:border-primary">
                Ru
            </button>
            <button class="w-16 h-16 bg-transparent text-my_white rounded-full border-2 border-my_white font-bold flex items-center justify-center
                hover:bg-my_white hover:text-my_black hover:border-my_black transition duration-300">
                ☰
            </button>
        </div>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="bg-footer text-text px-32 py-8">
        <section id="footer" class="relative w-full">
            <footer-component></footer-component>
        </section>
    </footer> --}}
    <div id="app"></div>
</body>
</html>
