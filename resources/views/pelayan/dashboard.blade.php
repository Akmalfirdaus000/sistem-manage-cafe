@extends('layouts.pelayan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard Pelayan</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- Pesanan Masuk -->
        <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-yellow-500">
            <h2 class="text-xl font-semibold">Pesanan Masuk</h2>
            <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $jumlahPesananMasuk }}</p>
        </div>

        <!-- Pesanan Diproses -->
        <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-blue-500">
            <h2 class="text-xl font-semibold">Sedang Diproses</h2>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $jumlahPesananDiproses }}</p>
        </div>

        <!-- Reservasi Hari Ini -->
        <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-green-500">
            <h2 class="text-xl font-semibold">Reservasi Hari Ini</h2>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $jumlahReservasiHariIni }}</p>
        </div>

        <!-- Pesanan Selesai -->
        <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-gray-700">
            <h2 class="text-xl font-semibold">Pesanan Selesai</h2>
            <p class="text-3xl font-bold text-gray-700 mt-2">{{ $jumlahSelesaiHariIni }}</p>
        </div>
    </div>
</div>
@endsection
