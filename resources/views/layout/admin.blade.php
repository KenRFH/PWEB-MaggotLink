<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website - @yield('title')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>


    <div class="flex-1 ml-48 p-4 overflow-auto">
        @yield('content')
    </div>


<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script src="//unpkg.com/alpinejs" defer></script>

@stack('scripts')
</body>

</html>
