<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Geologica:wght@100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <title>Laravel</title>
</head>

<body>
    <main class="bg-background min-h-screen p-4 font-sans">
        @yield('content')
    </main>
    @yield('script')
</body>

</html>
