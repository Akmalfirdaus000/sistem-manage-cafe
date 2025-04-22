@extends('layouts.kasir')

@section('content')
<main>
    <h1 class="text-2xl font-bold mb-6">Dashboard Kasir</h1>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Pesanan -->
        <div class="bg-white p-6 shadow rounded text-center">
            <h2 class="text-lg font-semibold text-gray-600">Total Pesanan</h2>
            <p class="text-3xl font-bold text-red-600">{{ $total_pesanan }}</p>
        </div>

        <!-- Pesanan Selesai -->
        <div class="bg-white p-6 shadow rounded text-center">
            <h2 class="text-lg font-semibold text-gray-600">Pesanan Selesai</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $total_selesai }}</p>
        </div>

        <!-- Total Pendapatan -->
        <div class="bg-white p-6 shadow rounded text-center">
            <h2 class="text-lg font-semibold text-gray-600">Total Pendapatan</h2>
            <p class="text-3xl font-bold text-green-600">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</p>
        </div>
    </div>
</main>
@endsection
