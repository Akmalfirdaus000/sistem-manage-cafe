<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'KopKit Padang' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-white text-gray-800 font-sans">

    <!-- Navbar -->
    <header class="fixed top-0 left-0 w-full z-50 bg-white/90 backdrop-blur shadow-md transition duration-500">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Logo -->
            <a href="/login" class="text-2xl font-extrabold text-[#5D4037] tracking-wide hover:text-red-700 transition">
                KopKit Padang
            </a>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex space-x-8 font-medium text-gray-700">
                <a href="{{ route('landing.index') }}" class="hover:text-red-600 transition">Beranda</a>
                <a href="{{ route('landing.menu') }}" class="hover:text-red-600 transition">Menu</a>
                <a href="{{ route('landing.pesan') }}" class="hover:text-red-600 transition">Pesan</a>
                <a href="{{ route('landing.reservasi') }}" class="hover:text-red-600 transition">Reservasi</a>
                <a href="{{ route('landing.kontak') }}" class="hover:text-red-600 transition">Kontak</a>
            </nav>

            <!-- Mobile Toggle -->
            <div class="md:hidden">
                <button onclick="toggleMobileMenu()" class="text-red-600 text-2xl focus:outline-none transition-transform duration-300 hover:rotate-90">
                    ☰
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-200 transition-all duration-300 ease-in-out">
            <nav class="flex flex-col space-y-2 py-4 px-6 text-gray-700 font-medium">
                <a href="{{ route('landing.index') }}" class="hover:text-red-600">Beranda</a>
                <a href="{{ route('landing.menu') }}" class="hover:text-red-600">Menu</a>
                <a href="{{ route('landing.pesan') }}" class="hover:text-red-600">Pesan</a>
                <a href="{{ route('landing.reservasi') }}" class="hover:text-red-600">Reservasi</a>
                <a href="{{ route('landing.kontak') }}" class="hover:text-red-600">Kontak</a>
            </nav>
        </div>
    </header>

    <!-- Konten -->
    <main class="pt-24 min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-20 bg-[#5D4037] text-white text-center py-6 text-sm">
        &copy; {{ date('Y') }} <strong>KopKit Padang</strong>. Dibuat dengan ❤️ di Sumatera Barat.
    </footer>

    <!-- Script -->
    <script>
        function toggleMobileMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }
    </script>

</body>
</html>
