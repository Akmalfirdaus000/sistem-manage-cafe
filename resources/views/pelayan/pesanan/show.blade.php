@extends('layouts.pelayan')

@section('content')
<main>
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Detail Pesanan</h1>

    <div class="bg-white p-6 rounded shadow-md">
        <!-- Informasi Umum -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <p class="text-gray-700"><strong>Nama Pelanggan:</strong> {{ $pesanan->nama_pelanggan }}</p>
                <p class="text-gray-700"><strong>Nomor HP:</strong> {{ $pesanan->no_hp }}</p>
                <p class="text-gray-700"><strong>Nomor Meja:</strong> {{ $pesanan->meja ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-700"><strong>Pelayan:</strong> {{ $pesanan->pelayanUser->nama ?? '-' }}</p>
                <p class="text-gray-700"><strong>Waktu Pemesanan:</strong> {{ \Carbon\Carbon::parse($pesanan->waktu_pesanan)->translatedFormat('d F Y H:i') }}</p>
                <p class="text-gray-700"><strong>Tipe Pesanan:</strong> {{ ucfirst($pesanan->tipe) }}</p>
            </div>
        </div>

        <!-- Tabel Menu Dipesan -->
        <h2 class="text-xl font-semibold mb-3 text-gray-800">Daftar Menu Dipesan</h2>
        <div class="overflow-x-auto">
            <table class="w-full table-auto border border-gray-200 text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="border p-2">#</th>
                        <th class="border p-2">Menu</th>
                        <th class="border p-2">Jumlah</th>
                        <th class="border p-2">Harga</th>
                        <th class="border p-2">Total</th>
                        <th class="border p-2">Catatan</th>
                        <th class="border p-2 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalKeseluruhan = 0; @endphp
                    @foreach ($pesanan->listPesanan as $item)
                        @php
                            $harga = $item->menu->harga ?? 0;
                            $total = $harga * $item->jumlah;
                            $totalKeseluruhan += $total;
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border p-2">{{ $item->menu->nama_menu ?? 'Menu tidak ditemukan' }}</td>
                            <td class="border p-2 text-center">{{ $item->jumlah }}</td>
                            <td class="border p-2 text-right">Rp {{ number_format($harga, 0, ',', '.') }}</td>
                            <td class="border p-2 text-right">Rp {{ number_format($total, 0, ',', '.') }}</td>
                            <td class="border p-2">{{ $item->catatan ?? '-' }}</td>
                            <td class="border p-2 text-center">
                                <span class="text-xs font-semibold text-white px-2 py-1 rounded
                                    {{ $item->status === 'pending' ? 'bg-yellow-500' : '' }}
                                    {{ $item->status === 'dimasak' ? 'bg-blue-500' : '' }}
                                    {{ $item->status === 'selesai' ? 'bg-green-600' : '' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-100 font-semibold">
                        <td colspan="4" class="border p-2 text-right">Total Keseluruhan:</td>
                        <td class="border p-2 text-right text-green-600">Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</td>
                        <td colspan="2" class="border p-2"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-6">
            <a href="{{ route('pelayan.pesanan.index') }}" class="inline-block bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                ← Kembali ke Daftar Pesanan
            </a>
        </div>
    </div>
</main>
@endsection
