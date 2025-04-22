<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
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
        <span class="text-xl font-bold">Dashboard Kasir</span>
        <a href="#" class="text-white hover:underline">Logout</a>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white shadow-md min-h-screen p-4 fixed lg:relative z-10 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            <h1 class="text-xl font-bold mb-6 text-red-600">Kasir</h1>
            <ul class="space-y-4">
                <li>
                    <a href="{{ route('kasir.dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-red-100 text-red-600 font-semibold">
                        🏠 <span class="ml-2">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kasir.pesanan.index') }}" class="flex items-center p-3 rounded-lg hover:bg-red-100 text-gray-700">
                        📋 <span class="ml-2">Pesanan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kasir.transaksi.index') }}" class="flex items-center p-3 rounded-lg hover:bg-red-100 text-gray-700">
                        💰 <span class="ml-2">Transaksi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('kasir.laporan.index') }}"" class="flex items-center p-3 rounded-lg hover:bg-red-100 text-gray-700">
                        📜 <span class="ml-2">laporan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="flex items-center p-3 rounded-lg hover:bg-red-100 text-red-600 font-semibold">
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
