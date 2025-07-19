@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold mb-6 text-gray-900">Daftar Transaksi Pembayaran</h1>

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg border border-gray-200">
        <table class="min-w-full table-auto">
            <thead class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
                <tr>
                    <th class="py-3 px-6 text-left font-medium">Kode Pesanan</th>
                    <th class="py-3 px-6 text-left font-medium">Pelanggan</th>
                    <th class="py-3 px-6 text-left font-medium">Meja</th>
                    <th class="py-3 px-6 text-left font-medium">Nominal Uang</th>
                    <th class="py-3 px-6 text-left font-medium">Total Bayar</th>
                    <th class="py-3 px-6 text-left font-medium">Waktu Bayar</th>
                    <th class="py-3 px-6 text-left font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $item)
                <tr class="border-b hover:bg-gray-50 transition duration-300">
                    <td class="py-3 px-6">{{ $item->id_pesanan }}</td>
                    <td class="py-3 px-6">{{ $item->pesanan->nama_pelanggan ?? '-' }}</td>
                    <td class="py-3 px-6">{{ $item->pesanan->meja }}</td>
                    <td class="py-3 px-6 text-blue-600 font-semibold">Rp {{ number_format($item->nominal_uang, 0, ',', '.') }}</td>
                    <td class="py-3 px-6 text-green-600 font-semibold">Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                    <td class="py-3 px-6">{{ \Carbon\Carbon::parse($item->waktu_bayar)->translatedFormat('d F Y H:i') }}</td>
<td class="py-3 px-6 space-y-2">
    <button onclick="document.getElementById('modalDetail-{{ $item->id_bayar }}').classList.remove('hidden')"
            class="w-full bg-indigo-600 text-white px-4 py-1 rounded hover:bg-indigo-700 transition duration-300 transform hover:scale-105">
        Detail
    </button>

    <a href="{{ route('admin.pesanan.struk', $item->id_pesanan) }}" target="_blank"
       class="w-full inline-block bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 transition duration-300 transform hover:scale-105 text-center">
        Cetak Struk
    </a>
</td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">Tidak ada transaksi ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $transaksi->links() }}
    </div>
</div>

<!-- Modal Detail -->
@foreach($transaksi as $item)
<div id="modalDetail-{{ $item->id_bayar }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white w-full max-w-lg p-6 rounded-lg relative transform transition-all duration-300 hover:scale-105">
        <button onclick="document.getElementById('modalDetail-{{ $item->id_bayar }}').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>
        <h2 class="text-xl font-bold mb-4">Detail Transaksi</h2>
        <p><strong>Kode Pesanan:</strong> {{ $item->id_pesanan }}</p>
        <p><strong>Pelanggan:</strong> {{ $item->pesanan->nama_pelanggan ?? '-' }}</p>
        <p><strong>Nominal Uang:</strong> Rp {{ number_format($item->nominal_uang, 0, ',', '.') }}</p>
        <p><strong>Total Bayar:</strong> Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</p>
        <p><strong>Waktu Bayar:</strong> {{ \Carbon\Carbon::parse($item->waktu_bayar)->translatedFormat('d F Y H:i') }}</p>

        <div class="text-right mt-4">
            <button onclick="document.getElementById('modalDetail-{{ $item->id_bayar }}').classList.add('hidden')" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Tutup</button>
        </div>
    </div>
</div>
@endforeach
@endsection
