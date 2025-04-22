@extends('layouts.kasir')

@section('content')
<main>
    <h1 class="text-2xl font-bold mb-4">Pembayaran</h1>
    <div class="bg-white p-6 shadow rounded">
        <p><strong>Nama Pelanggan:</strong> {{ $pesanan->pelanggan }}</p>
        <p><strong>Nomor Meja:</strong> {{ $pesanan->meja ?? '-' }}</p>
        <p><strong>Pelayan:</strong> {{ $pesanan->pelayanUser->nama }}</p>
        <p><strong>Waktu Pemesanan:</strong> {{ $pesanan->created_at->format('d M Y, H:i') }}</p>

        <h2 class="text-xl font-bold mt-4">Total Pembayaran</h2>
        @php
            $totalBayar = $pesanan->listPesanan->sum(fn($item) => ($item->menu->harga ?? 0) * $item->jumlah);
        @endphp
        <p class="text-lg font-semibold">Rp {{ number_format($totalBayar, 0, ',', '.') }}</p>

        @if (session('error'))
            <div class="text-red-500 mt-2">{{ session('error') }}</div>
        @endif

        <form action="{{ route('kasir.pesanan.bayar', $pesanan->id_pesanan) }}" method="POST" class="mt-4">
            @csrf

            <label class="block font-semibold mb-2">Metode Pembayaran:</label>
            <select name="metode_pembayaran" required class="w-full p-2 border rounded mb-4">
                <option value="cash">Cash</option>
                <option value="transfer">Transfer</option>
            </select>

            <label class="block font-semibold mb-2">Nominal Uang:</label>
            <input type="number" name="nominal_uang" required class="w-full p-2 border rounded mb-4" placeholder="Masukkan nominal uang" min="{{ $totalBayar }}">

            <button type="submit" class="w-full px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                Konfirmasi Pembayaran
            </button>
        </form>

        <a href="{{ route('kasir.pesanan.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">
            Kembali
        </a>
    </div>
</main>
@endsection
