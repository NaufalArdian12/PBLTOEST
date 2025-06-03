<!DOCTYPE html>
<html>
<head>
    <title>@yield('title') - Admin Panel</title>
    @vite('resources/css/app.css') <!-- Laravel Vite integration -->
</head>
<body>
    @yield('content')
    @stack('scripts')
</body>
</html>
