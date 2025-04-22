<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-100">
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex flex-col py-6 px-4">
      <h2 class="text-2xl font-bold mb-8 text-center">☕ Bat & Arrow Admin</h2>
      <nav class="space-y-4">
        <a href="#" class="flex items-center gap-3 hover:bg-gray-700 px-3 py-2 rounded">
          <span class="text-xl">📊</span> <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.pengguna.index') }}" class="flex items-center gap-3 hover:bg-gray-700 px-3 py-2 rounded">
          <span class="text-xl">👥</span> <span>Data User</span>
        </a>
        <a href="{{ route('admin.menu.index') }}" class="flex items-center gap-3 hover:bg-gray-700 px-3 py-2 rounded">
          <span class="text-xl">🍽️</span> <span>Data Menu</span>
        </a>
        <a href="{{ route('admin.kategori.index') }}" class="flex items-center gap-3 hover:bg-gray-700 px-3 py-2 rounded">
          <span class="text-xl">📂</span> <span>Kategori Menu</span>
        </a>
        <a href="{{ route('admin.reservasi.index') }}" class="flex items-center gap-3 hover:bg-gray-700 px-3 py-2 rounded">
          <span class="text-xl">📝</span> <span>Reservasi</span>
        </a>
        <a href="{{ route('admin.transaksi.index') }}" class="flex items-center gap-3 hover:bg-gray-700 px-3 py-2 rounded">
          <span class="text-xl">💳</span> <span>Transaksi</span>
        </a>
        <a href="#" class="flex items-center gap-3 hover:bg-gray-700 px-3 py-2 rounded">
          <span class="text-xl">📈</span> <span>Laporan Penjualan</span>
        </a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 ml-64 lg:ml-0">
        @yield('content')
    </main>
  </div>
</body>
</html>
