<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>Home</h1>
    <div id="app" class="flex items-center justify-center min-h-screen bg-gray-100"> <!-- Контейнер для Vue.js -->
        <example-component></example-component>
    </div>
</body>
</html>
