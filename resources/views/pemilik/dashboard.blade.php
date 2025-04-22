@extends('layouts.pemilik')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-semibold text-gray-800">Dashboard Pemilik</h1>
    <p class="text-gray-500">Ringkasan aktivitas dan statistik restoran.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Total Pendapatan -->
    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition transform hover:scale-[1.02]">
        <h2 class="text-gray-500 text-sm mb-2">Total Pendapatan</h2>
        <p class="text-2xl font-bold text-green-600">Rp 12.500.000</p>
    </div>

    <!-- Jumlah Transaksi -->
    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition transform hover:scale-[1.02]">
        <h2 class="text-gray-500 text-sm mb-2">Jumlah Transaksi</h2>
        <p class="text-2xl font-bold text-blue-600">128</p>
    </div>

    <!-- Menu Terlaris -->
    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition transform hover:scale-[1.02]">
        <h2 class="text-gray-500 text-sm mb-2">Menu Terlaris</h2>
        <p class="text-2xl font-bold text-yellow-600">Ayam Geprek</p>
    </div>
</div>

<div class="mt-8">
    <h2 class="text-xl font-semibold mb-4 text-gray-700">Grafik Pendapatan</h2>
    <div class="bg-white p-6 rounded-2xl shadow-md h-64 flex items-center justify-center text-gray-400">
        [Grafik akan ditampilkan di sini]
    </div>
</div>
@endsection
