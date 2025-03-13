<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Areostil Pro')</title>

    <!-- Подключение иконок и шрифтов -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}">
    <!-- Подключение твоих стилей и скриптов -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @inertiaHead
</head>
<body class="bg-background text-text flex flex-col min-h-screen">
    @inertia
</body>
</html>
