@extends('layouts.dapur')

@section('content')
<main>
    <h1 class="text-2xl font-bold mb-4">Riwayat Pesanan</h1>

    @if(session('success'))
        <div class="p-3 bg-green-500 text-white mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 shadow rounded">
        <table class="w-full border-collapse border mt-2">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="border p-2">#</th>
                    <th class="border p-2">Nama Pelanggan</th>
                    <th class="border p-2">Nomor Meja</th>
                    <th class="border p-2">Waktu Pemesanan</th>
                    <th class="border p-2">Menu</th>
                    <th class="border p-2">Jumlah</th>
                    <th class="border p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pesanans as $pesanan)
                    <!-- Header: Nama Pelanggan & Meja -->
                    <tr class="bg-gray-100">
                        <td colspan="7" class="border p-2 font-bold">
                            {{ $pesanan->pelanggan }} (Meja: {{ $pesanan->meja ?? '-' }}) - {{ $pesanan->waktu_pesanan }}
                        </td>
                    </tr>

                    @foreach ($pesanan->listPesanan as $item)
                        <tr>
                            <td class="border p-2">{{ $loop->iteration }}</td>
                            <td class="border p-2">{{ $pesanan->pelanggan }}</td>
                            <td class="border p-2">{{ $pesanan->meja ?? '-' }}</td>
                            <td class="border p-2">{{ $pesanan->waktu_pesanan }}</td>
                            <td class="border p-2">{{ $item->menu->nama_menu ?? 'Menu Tidak Ditemukan' }}</td>
                            <td class="border p-2 text-center">{{ $item->jumlah }}</td>
                            <td class="border p-2 text-center">
                                <span class="px-2 py-1 text-white rounded-lg 
                                    {{ $item->status == 'pending' ? 'bg-yellow-500' : '' }}
                                    {{ $item->status == 'dimasak' ? 'bg-blue-500' : '' }}
                                    {{ $item->status == 'selesai' ? 'bg-green-500' : '' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="7" class="text-center border p-4">Belum ada riwayat pesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>
@endsection
