@extends('layouts.pelayan')

@section('content')
<main>
    <h1 class="text-2xl font-bold mb-4">Detail Pesanan</h1>
    <div class="bg-white p-6 shadow rounded">
        <p><strong>Nama Pelanggan:</strong> {{ $pesanan->pelanggan }}</p>
        <p><strong>Nomor Meja:</strong> {{ $pesanan->meja ?? '-' }}</p>
        <p><strong>Pelayan:</strong> {{ $pesanan->pelayanUser->nama }}</p>
        <p><strong>Waktu Pemesanan:</strong> {{ $pesanan->waktu_pesanan }}</p>

        <h2 class="text-xl font-bold mt-4">Daftar Pesanan</h2>
        <table class="w-full border-collapse border mt-2">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">#</th>
                    <th class="border p-2">Menu</th>
                    <th class="border p-2">Jumlah</th>
                    <th class="border p-2">Harga</th>
                    <th class="border p-2">Total Harga</th>
                    <th class="border p-2">Catatan</th>
                    <th class="border p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @php $totalKeseluruhan = 0; @endphp
                @foreach ($pesanan->listPesanan as $item)
                    @php
                        $harga = $item->menu->harga ?? 0; 
                        $totalHarga = $harga * $item->jumlah;
                        $totalKeseluruhan += $totalHarga;
                    @endphp
                    <tr>
                        <td class="border p-2">{{ $loop->iteration }}</td>
                        <td class="border p-2">{{ $item->menu->nama_menu ?? 'Menu Tidak Ditemukan' }}</td>
                        <td class="border p-2">{{ $item->jumlah }}</td>
                        <td class="border p-2">Rp {{ number_format($harga, 0, ',', '.') }}</td>
                        <td class="border p-2">Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                        <td class="border p-2">{{ $item->catatan ?? '-' }}</td>
                        <td class="border p-2">{{ $item->status }}</td>
                    </tr>
                @endforeach
                <tr class="bg-gray-100 font-bold">
                    <td colspan="4" class="border p-2 text-right">Total Keseluruhan:</td>
                    <td class="border p-2">Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</td>
                    <td colspan="2" class="border p-2"></td>
                </tr>
            </tbody>
        </table>

        <a href="{{ route('pelayan.pesanan.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
    </div>
</main>
@endsection
