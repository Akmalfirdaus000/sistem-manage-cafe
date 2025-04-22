<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dapur</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
        }
    </script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-red-600 p-4 text-white flex justify-between items-center">
        <button onclick="toggleSidebar()" class="text-white focus:outline-none lg:hidden">
            ☰
        </button>
        <span class="text-xl font-bold">Dashboard Dapur</span>
        <a href="{{ route('logout') }}" class="text-white hover:underline">Logout</a>
    </nav>

    <!-- Sidebar & Main Content -->
    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white shadow-md min-h-screen p-4 fixed lg:relative z-10 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('dapur.dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-red-100 text-red-600 font-semibold">
                        🏠 <span class="ml-2">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dapur.pesanan.index') }}" class="flex items-center p-3 rounded-lg hover:bg-red-100 text-gray-700">
                        🔥 <span class="ml-2">Pesanan Masuk</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dapur.riwayat.index') }}" class="flex items-center p-3 rounded-lg hover:bg-red-100 text-gray-700">
                        📜 <span class="ml-2">Riwayat Pesanan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="flex items-center p-3 rounded-lg hover:bg-red-100 text-gray-700">
                        🚪 <span class="ml-2">Logout</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Konten Utama -->
        <main class="flex-1 p-6 ml-64 lg:ml-0">
            @yield('content')
        </main>
    </div>

</body>
</html>
