@extends('layouts.kasir')

@section('content')
<main>
    <h1 class="text-2xl font-bold mb-4">Detail Pesanan</h1>
    <div class="bg-white p-6 shadow-md rounded-lg">
        <p><strong>Nama Pelanggan:</strong> {{ $pesanan->pelanggan }}</p>
        <p><strong>Nomor Meja:</strong> {{ $pesanan->meja ?? '-' }}</p>
        <p><strong>Pelayan:</strong> {{ $pesanan->pelayanUser->nama }}</p>
        <p><strong>Waktu Pemesanan:</strong> {{ $pesanan->created_at->format('d M Y, H:i') }}</p>

        {{-- Menampilkan Status Pesanan --}}
        <p class="mt-2"><strong>Status Pesanan:</strong> 
            @php
                $status = strtolower(trim($pesanan->status));
                $statusClass = match ($status) {
                    'selesai'    => 'bg-green-500',
                    'sudah bayar' => 'bg-blue-500',
                    'dimasak'    => 'bg-orange-500',
                    'pending'    => 'bg-yellow-500',
                    default      => 'bg-gray-500',
                };
            @endphp
            <span class="px-2 py-1 rounded text-white {{ $statusClass }}">
                {{ ucfirst($pesanan->status) }}
            </span>
        </p>

        <h2 class="text-xl font-bold mt-4">Daftar Pesanan</h2>

        @if ($pesanan->listPesanan->isEmpty())
            <p class="text-red-500 font-semibold mt-2">Tidak ada pesanan dalam daftar ini.</p>
        @else
            <div class="overflow-x-auto mt-2">
                <table class="w-full border-collapse border">
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
                        @php 
                            $totalKeseluruhan = 0; 
                            $semuaItemSudahBayar = true; // Cek apakah semua item sudah "sudah bayar"
                        @endphp
                        @foreach ($pesanan->listPesanan as $item)
                            @php
                                $harga = $item->menu->harga ?? 0; 
                                $totalHarga = $harga * $item->jumlah;
                                $totalKeseluruhan += $totalHarga;
                                $itemStatus = strtolower(trim($item->status));
                                if ($itemStatus !== 'sudah bayar') {
                                    $semuaItemSudahBayar = false; // Jika ada item yang belum bayar, atur ke false
                                }
                                $itemStatusClass = match ($itemStatus) {
                                    'selesai'    => 'bg-green-500',
                                    'sudah bayar' => 'bg-blue-500',
                                    'dimasak'    => 'bg-orange-500',
                                    'pending'    => 'bg-yellow-500',
                                    default      => 'bg-gray-500',
                                };
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                                <td class="border p-2">{{ $item->menu->nama_menu ?? 'Menu Tidak Ditemukan' }}</td>
                                <td class="border p-2 text-center">{{ $item->jumlah }}</td>
                                <td class="border p-2">Rp {{ number_format($harga, 0, ',', '.') }}</td>
                                <td class="border p-2">Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                                <td class="border p-2">{{ $item->catatan ?? '-' }}</td>
                                <td class="border p-2 text-center">
                                    <span class="px-2 py-1 rounded text-white {{ $itemStatusClass }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="bg-gray-100 font-bold">
                            <td colspan="4" class="border p-2 text-right">Total Keseluruhan:</td>
                            <td class="border p-2">Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</td>
                            <td colspan="2" class="border p-2"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
        

        {{-- Tombol Bayar hanya muncul jika status pesanan adalah "selesai" dan ada item yang belum dibayar --}}
        @if ($status === 'selesai' && !$semuaItemSudahBayar)
            <form action="{{ route('kasir.pesanan.bayar', $pesanan->id_pesanan) }}" method="get" class="mt-4">
                @csrf
                <button type="submit" class="w-full px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300">
                    Bayar Sekarang
                </button>
            </form>
        @endif
        

        <a href="{{ route('kasir.pesanan.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
            Kembali
        </a>
    </div>
</main>
@endsection
