<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cline') }}</title>
    <script src="https://kit.fontawesome.com/af6aba113a.js" crossorigin="anonymous"></script>
    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
        rel="stylesheet"
    />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-custom-black bg-cover bg-center" style="background-image: url('/bg.svg');">
<div class="min-h-screen bg-custom-black">
    <!-- Page Content -->
    <div class="flex">
        @include('layouts.partials.client.sidebar')
        <main class="bg-gray-100 rounded-[10px] w-full m-2">
            @include('layouts.navigation')
            @include('session.alerts')
            {{ $slot }}
        </main>
    </div>
</div>
</body>
</html>
