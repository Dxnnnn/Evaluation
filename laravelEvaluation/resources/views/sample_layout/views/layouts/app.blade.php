<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>System - @yield('title')</title>

    <!-- Global Styles declare here -->
</head>

<body>
    <div class="master-wrapper">
        <div class="overlay">
            <div id="spinner"></div>
        </div>
        <div id="app">
            @yield('content')
        </div>
        <!-- JavaScript -->
        @yield('before_end')
    </div>
</body>

<!-- ALL js declare here -->
</html>
