@extends('layouts.kasir')

@section('content')
<main>
    <h1 class="text-2xl font-bold mb-6">Laporan Penjualan</h1>
   

    <!-- Ringkasan Laporan -->
    <div class="grid grid-cols-4 gap-6 mb-6  items-center text-center ">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-700">Total Pendapatan</h2>
            <p class="text-2xl font-bold text-green-600">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-700">Jumlah Transaksi</h2>
            <p class="text-2xl font-bold text-blue-600">{{ $jumlahTransaksi }}</p>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-700">Total Item Terjual</h2>
            <p class="text-2xl font-bold text-red-600">{{ $totalItemTerjual }}</p>
        </div>
    </div>
    

    <!-- Filter Laporan -->
    <form method="GET" action="{{ route('kasir.laporan.index') }}" class="mb-6 flex gap-4">
        <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="p-2 border rounded">
        <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="p-2 border rounded">
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Filter</button>
    </form>
    
    <div class=" p-3">

        <a href="{{ route('kasir.laporan.cetak', request()->all()) }}" class="bg-blue-500  m-3  hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Cetak PDF
        </a>
    </div>
    <!-- Tabel Transaksi -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-3">Daftar Transaksi</h2>
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border">
                <thead>
                    <tr class="bg-red-500 text-white">
                        <th class="border p-2">#</th>
                        <th class="border p-2">Tanggal</th>
                        <th class="border p-2">No. Pesanan</th>
                        <th class="border p-2">Pelanggan</th>
                        <th class="border p-2">Sub Total</th>
                        <th class="border p-2">Total Penjualan</th>
                        <th class="border p-2">Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksi as $index => $t)
                        <tr class="hover:bg-gray-50">
                            <td class="border p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border p-2">{{ $t->waktu_bayar ? date('d M Y', strtotime($t->waktu_bayar)) : '-' }}</td>


                            <td class="border p-2">{{ $t->id_pesanan }}</td>
                            <td class="border p-2">{{ $t->pesanan->pelanggan }}</td>
                              <td class="border p-2">
    Rp {{ number_format($t->pesanan->listPesanan->sum(fn($item) => $item->menu->harga * $item->jumlah), 0, ',', '.') }}
</td>
        <td class="border p-2">Rp {{ number_format($t->total_bayar, 0, ',', '.') }}</td>
        <td class="border p-2">Rp {{ number_format($t->nominal_uang, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="border p-4 text-center text-gray-500">Tidak ada transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-gray-100 font-bold">
    <td colspan="4" class="border p-2 text-right">Total :</td>
    <td class="border p-2">Rp {{ number_format($totalSubTotal, 0, ',', '.') }}</td>
    <td class="border p-2">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</td>
    <td class="border p-2">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</td>
</tr>

                </tfoot>
            </table>
        </div>
    </div>
</main>
@endsection
