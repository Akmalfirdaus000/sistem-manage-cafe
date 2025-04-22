<!-- resources/views/layouts/pemilik.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pemilik</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-800 text-white min-h-screen p-6">
            <h2 class="text-2xl font-bold mb-8">Pemilik</h2>
            <nav class="space-y-4">
                <a href="#" class="block py-2 px-4 rounded hover:bg-blue-600">Dashboard</a>
                <a href="#" class="block py-2 px-4 rounded hover:bg-blue-600">Laporan</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
