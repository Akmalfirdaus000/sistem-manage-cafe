@extends('layouts.kasir')

@section('content')
<main class="p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Detail Transaksi</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 space-y-2">
        <!-- Informasi Pelanggan -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-3">Informasi Pelanggan</h2>
            <p class="text-gray-600"><strong>Nama:</strong> {{ optional($transaksi->pesanan)->pelanggan ?? 'Tidak Diketahui' }}</p>
            <p class="text-gray-600"><strong>Nomor Meja:</strong> {{ optional($transaksi->pesanan)->meja ?? '-' }}</p>
        {{-- <p><strong>Pelayan:</strong> {{ $transaksi->pelayanUser->nama }}</p> --}}

        </div>
        
        <!-- Detail Transaksi -->
        <div class="bg-white shadow-md rounded-lg p-6 space-y-2">
            <h2 class="text-lg font-semibold text-gray-700 mb-3">Detail Transaksi</h2>
            <p class="text-gray-600"><strong>Total Bayar:</strong> Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</p>
            @php
                $status = $transaksi->pesanan->listPesanan->first()->status ?? 'pending';
            @endphp
            <p class="text-gray-600">
                <strong>Status:</strong>
                <span class="px-3 py-1 rounded text-white {{ $status == 'sudah bayar' ? 'bg-green-500' : 'bg-yellow-500' }}">
                    {{ ucfirst($status) }}
                </span>
            </p>
            <p class="text-gray-600">
                <strong>Waktu Pembayaran:</strong>
                {{ $transaksi->waktu_bayar ? \Carbon\Carbon::parse($transaksi->waktu_bayar)->format('d M Y, H:i') : '-' }}
            </p>
        </div>

        <!-- Ringkasan Pembayaran -->
        <div class="bg-white shadow-md rounded-lg p-6 space-y-2">
            <h2 class="text-lg font-semibold text-gray-700 mb-3">Ringkasan Pembayaran</h2>
            <p class="text-gray-600"><strong>Total Pembayaran:</strong> Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</p>
            <p class="text-gray-600"><strong>Dibayar:</strong> Rp {{ number_format($transaksi->nominal_uang, 0, ',', '.') }}</p>
            <p class="text-gray-600"><strong>Kembalian:</strong> Rp {{ number_format($transaksi->nominal_uang - $transaksi->total_bayar, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Daftar Pesanan -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-3">Daftar Pesanan</h2>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border rounded-lg">
                <thead>
                    <tr class="bg-red-500 text-white">
                        <th class="border p-3">#</th>
                        <th class="border p-3">Pesanan</th>
                        <th class="border p-3">Jumlah</th>
                        <th class="border p-3">Harga Satuan</th>
                        <th class="border p-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi->pesanan->listPesanan ?? [] as $index => $pesanan)
                        <tr class="hover:bg-gray-50 text-gray-700">
                            <td class="border p-3 text-center">{{ $index + 1 }}</td>
                            <td class="border p-3">{{ $pesanan->menu->nama_menu ?? 'Tidak Diketahui' }}</td>
                            <td class="border p-3 text-center">{{ $pesanan->jumlah }}</td>
                            <td class="border p-3">Rp {{ number_format($pesanan->menu->harga, 0, ',', '.') }}</td>
                            <td class="border p-3">Rp {{ number_format($pesanan->jumlah * $pesanan->menu->harga, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="border p-4 text-center text-gray-500">Tidak ada pesanan dalam transaksi ini</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="flex justify-between mt-6">
        <a href="{{ route('kasir.transaksi.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Kembali
        </a>
       
    </div>
</main>
@endsection
