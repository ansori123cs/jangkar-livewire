<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>FlyonUI Laravel Livewire Starter Kit</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <livewire:styles />
</head>

<body class="bg-base-200 min-h-screen" x-data="{ open: false }">


    @livewire('navigations.navbar-admin')
    <div class="flex">
        <!-- Overlay (mobile) -->
        <div x-show="open" @click="open = false" class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"></div>

        @livewire('navigations.sidebar-admin')

        <!-- Main Content -->
        <main class="flex-1 p-6 md:ml-64 mt-4 md:mt-0">
            {{ $slot }}
        </main>
    </div>

    <livewire:scripts />

</body>

</html>
