<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelayan</title>
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
        <button onclick="toggleSidebar()" class="text-white focus:outline-none lg:hidden text-2xl">
            ☰
        </button>
        <span class="text-xl font-bold">Dashboard Pelayan</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="hover:underline">Logout</button>
        </form>
    </nav>

    <!-- Sidebar & Content -->
    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white shadow-md min-h-screen p-4 fixed lg:relative z-10 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            <nav class="space-y-4">
                <a href="{{ route('pelayan.dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-red-100 text-red-600 font-semibold">
                    🏠 <span class="ml-2">Dashboard</span>
                </a>

                <a href="{{ route('pelayan.pesanan.index') }}" class="flex items-center p-3 rounded-lg hover:bg-red-100 text-gray-700">
                    📥 <span class="ml-2">Pesanan Masuk</span>
                </a>

                {{-- <a href="{{ route('pelayan.riwayat.index') }}" class="flex items-center p-3 rounded-lg hover:bg-red-100 text-gray-700">
                    📜 <span class="ml-2">Riwayat Pesanan</span>
                </a> --}}

                 <form action="{{ route('logout') }}" method="GET" class="mt-6">
          <button type="submit" class="flex items-center gap-3 w-full text-left hover:bg-red-600 px-3 py-2 rounded bg-red-500 text-white">
            <span class="text-xl">🚪</span> <span>Logout</span>
          </button>
        </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 ml-64 lg:ml-0">
            @yield('content')
        </main>
    </div>

</body>
</html>
