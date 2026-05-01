<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>JangkarMas.id</title>

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <livewire:styles />
    </head>
   <body class="bg-base-200 min-h-screen">
    <!-- Public Header -->
    <header class="bg-blue-600 text-white p-4">
        <nav class="container mx-auto flex justify-start">
            <h1 class="text-xl font-bold text-slate-50  !leading-tight lg:text-2xl dark:text-slate-900">JangkarMassApp</h1>
          
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto p-1">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="sticky bottom-0 bg-gray-200 p-4 mt-8">
        <div class="container mx-auto text-end">
            &copy; {{ date('Y') }} JangkarMasApp by@ansori123cs
        </div>
    </footer>
    <livewire:scripts />

</body>
</html>
