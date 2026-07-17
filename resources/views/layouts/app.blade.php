<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@100..900&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="@yield('body-class')" data-userid="{{ auth()->id() }}">

    @include('components.navbar')

    @yield('content')

    @include('components.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>