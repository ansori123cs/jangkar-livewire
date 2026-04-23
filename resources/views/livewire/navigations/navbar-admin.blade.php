<!-- Navbar -->
<header class="bg-blue-500 text-white flex items-center justify-between shadow-lg px-4 py-3 md:ml-64">
    <!-- Left -->
    <div class="flex items-center gap-3">
        <!-- Hamburger (mobile only) -->
        <button @click="open = !open" class="md:hidden focus:outline-none">
            ☰
        </button>

        <h1 class="text-lg font-semibold">WMS Jangkar Mas</h1>
    </div>

    <!-- Right -->
    <div>
        <span>{{ $user['name'] }} - {{ $user['role'] }}</span>
    </div>
</header>
