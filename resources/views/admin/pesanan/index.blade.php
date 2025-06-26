@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold mb-6 text-gray-900">Daftar Pesanan Belum Dibayar</h1>

    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">#</th>
                    <th class="py-3 px-4 text-left">Nama Pelanggan</th>
                    <th class="py-3 px-4 text-left">Meja</th>
                    <th class="py-3 px-4 text-left">Total Harga</th>
                    <th class="py-3 px-4 text-left">Waktu Pesan</th>
                    <th class="py-3 px-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesanans as $index => $pesanan)
                    @php
                        $total = $pesanan->listPesanan->sum(function ($item) {
                            return $item->menu->harga * $item->jumlah;
                        });
                    @endphp
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4">{{ $pesanan->nama_pelanggan }}</td>
                        <td class="py-3 px-4">{{ $pesanan->meja ?? '-' }}</td>
                        <td class="py-3 px-4 text-green-600 font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</td>
                        <td class="py-3 px-4">{{ \Carbon\Carbon::parse($pesanan->waktu_pesanan)->translatedFormat('d F Y H:i') }}</td>
                        <td class="py-3 px-4 text-center">
                            <button onclick="document.getElementById('modalBayar-{{ $pesanan->id_pesanan }}').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm">
                                Bayar
                            </button>
                        </td>
                    </tr>

                    {{-- Modal Pembayaran --}}
                    <div id="modalBayar-{{ $pesanan->id_pesanan }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
                        <div class="bg-white rounded-lg p-6 max-w-md w-full relative">
                            <button onclick="document.getElementById('modalBayar-{{ $pesanan->id_pesanan }}').classList.add('hidden')" class="absolute top-2 right-3 text-xl text-gray-500 hover:text-red-500">&times;</button>
                            <h2 class="text-xl font-bold mb-4">Pembayaran Pesanan</h2>
                            <p><strong>Nama:</strong> {{ $pesanan->nama_pelanggan }}</p>
                            <p><strong>Meja:</strong> {{ $pesanan->meja ?? '-' }}</p>
                            <p><strong>Total Bayar:</strong> Rp {{ number_format($total, 0, ',', '.') }}</p>

                            <form action="{{ route('admin.pesanan.bayar.store') }}" method="POST" class="mt-4 space-y-4">
                                @csrf
                                <input type="hidden" name="id_pesanan" value="{{ $pesanan->id_pesanan }}">
                                <input type="hidden" name="total_bayar" value="{{ $total }}">
                                <div>
                                    <label class="block text-sm font-medium">Nominal Uang Diterima</label>
                                    <input type="number" name="nominal_uang" min="{{ $total }}" required class="w-full mt-1 p-2 border rounded focus:ring focus:ring-indigo-300">
                                </div>
                                <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Konfirmasi Bayar</button>
                            </form>
                        </div>
                    </div>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">Tidak ada pesanan yang menunggu pembayaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($pesanans->hasPages())
    <div class="mt-4">
        {{ $pesanans->links() }}
    </div>
    @endif
</div>
@endsection
