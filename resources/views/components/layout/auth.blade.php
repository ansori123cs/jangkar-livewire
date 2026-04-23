<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <livewire:styles />
</head>

<body class="bg-base-200 min-h-screen">
    <!-- Public Header -->
    <header class="bg-blue-600 text-white p-4">
        <nav class="container mx-auto flex justify-between">
            <h1 class="text-xl font-bold">My Website</h1>
            <div>
                <a href="/" class="px-3 hover:text-blue-200">Home</a>
                <a href="/about" class="px-3 hover:text-blue-200">About</a>
                <a href="/contact" class="px-3 hover:text-blue-200">Contact</a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto p-4">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 p-4 mt-8">
        <div class="container mx-auto text-center">
            &copy; {{ date('Y') }} My Website
        </div>
    </footer>
    <livewire:scripts />

</body>

</html>
