@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <h1 class="text-xl font-bold mb-4">Dashboard Admin</h1>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <div class="p-4 bg-white rounded shadow">
            <h2 class="text-lg font-semibold">Jumlah Menu</h2>
            <p class="text-2xl">{{ $jumlahMenu }}</p>
        </div>
        <div class="p-4 bg-white rounded shadow">
            <h2 class="text-lg font-semibold">Kategori</h2>
            <p class="text-2xl">{{ $jumlahKategori }}</p>
        </div>
        <div class="p-4 bg-white rounded shadow">
            <h2 class="text-lg font-semibold">User (Admin & Pelayan)</h2>
            <p class="text-2xl">{{ $jumlahUser }}</p>
        </div>
        <div class="p-4 bg-white rounded shadow">
            <h2 class="text-lg font-semibold">Reservasi</h2>
            <p class="text-2xl">{{ $jumlahReservasi }}</p>
        </div>
        <div class="p-4 bg-white rounded shadow">
            <h2 class="text-lg font-semibold">Pesanan Hari Ini</h2>
            <p class="text-2xl">{{ $pesananHariIni }}</p>
        </div>
    </div>
@endsection
