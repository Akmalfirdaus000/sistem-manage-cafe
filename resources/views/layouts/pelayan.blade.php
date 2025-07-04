<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelayan - KopKit</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; }
    </style>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        }
    </script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-red-700 p-4 text-white flex justify-between items-center shadow-md fixed w-full z-50">
        <div class="flex items-center gap-4">
            <button onclick="toggleSidebar()" class="text-white text-2xl lg:hidden">
                ☰
            </button>
            <span class="text-xl font-semibold">Pelayan - KopKit</span>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="hover:underline text-sm">
            </button>
        </form>
    </nav>

    <!-- Sidebar & Main Content -->
    <div class="flex pt-16">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white shadow-lg fixed lg:relative z-40 min-h-screen transform -translate-x-full lg:translate-x-0 transition duration-300 ease-in-out">
            <div class="p-6">
                <h2 class="text-xl font-bold text-red-700 mb-6">☕ KopKit Pelayan</h2>
                <nav class="space-y-2">
                    <a href="{{ route('pelayan.dashboard') }}"
                       class="flex items-center p-3 rounded-lg hover:bg-red-100 font-medium transition
                              {{ request()->routeIs('pelayan.dashboard') ? 'bg-red-50 text-red-700' : 'text-gray-700' }}">
                        🏠 <span class="ml-3">Dashboard</span>
                    </a>

                    <a href="{{ route('pelayan.pesanan.index') }}"
                       class="flex items-center p-3 rounded-lg hover:bg-red-100 font-medium transition
                              {{ request()->routeIs('pelayan.pesanan.*') ? 'bg-red-50 text-red-700' : 'text-gray-700' }}">
                        📥 <span class="ml-3">Pesanan Masuk</span>
                    </a>

                    <form action="{{ route('logout') }}" method="GET" class="pt-6">
                        <button type="submit" class="flex items-center gap-3 w-full text-left bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded transition">
                            🚪 <span>Logout</span>
                        </button>
                    </form>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1  p-6 transition-all duration-300 ease-in-out">
            @yield('content')
        </main>
    </div>

</body>
</html>
