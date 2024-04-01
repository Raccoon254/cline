<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
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
        @include('layouts.partials.sidebar')
        <main class="bg-gray-100 rounded-[10px] w-full m-2">
            @include('layouts.navigation')
            @include('session.alerts')
            {{ $slot }}
        </main>
    </div>
    <!-- Project creation modal -->
    <dialog id="project_creation_modal" class="modal rounded-[10px] text-gray-200">
      <div class="modal-box backdrop-blur-sm">
        <form method="dialog">
          <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h3 class="font-semibold text-lg">New Project</h3>
        <p>
            Fill in the form below to create a new project
        </p>
        <form class="flex flex-col">
            <label class="mt-4 mb-2" for="name">
                Name
            </label>
            <input class="input ring-1" type="text" placeholder="name">

            <label class="mt-4 mb-2" for="description">
                Description
            </label>
            <textarea class="textarea ring-1" type="text" placeholder="description"></textarea>
            <label class="mt-4 mb-2" for="end_date">
                End Date
            </label>
            <input class="input ring-1" type="date" placeholder="end_date">
            <label class="mt-4 mb-2" for="client">
                Client
            </label>
            <input class="input ring-1" type="text" placeholder="client_id">
        </form>
        <p class="py-4 text-xs">Press ESC key or click on ✕ button to close</p>
      </div>
    </dialog>
</div>
</body>
</html>
