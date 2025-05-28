<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website - @yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body>


    <main class="flex-grow">
        @yield('content')
    </main>

    
</body>

</html>
