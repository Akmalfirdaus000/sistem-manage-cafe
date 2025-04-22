@extends('layouts.pelayan')

@section('content')
<main>
    <h1 class="text-2xl font-bold mb-4">Riwayat Pesanan</h1>
    
    <!-- Filter Riwayat -->
    <form method="GET" action="{{ route('pelayan.riwayat.index') }}" class="mb-4 flex items-center justify-between gap-4">
        <div>
            <label for="tanggal" class="mr-2 font-semibold">Filter Tanggal:</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}" class="border p-2 rounded">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
        </div>
         <div class="">
        {{ $pesanans->links() }}
    </div>

    

    </form>

    <!-- Tabel Riwayat Pesanan -->
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
                            {{ $pesanan->pelanggan }} (Meja: {{ $pesanan->meja ?? '-' }}) - {{ \Carbon\Carbon::parse($pesanan->waktu_pesanan)->format('d-m-Y H:i') }}
                        </td>
                    </tr>

                    @foreach ($pesanan->listPesanan as $index => $item)
                        <tr>
                            <td class="border p-2 text-center">{{ $index + 1 }}</td>
                            <td class="border p-2">{{ $pesanan->pelanggan }}</td>
                            <td class="border p-2 text-center">{{ $pesanan->meja ?? '-' }}</td>
                            <td class="border p-2 text-center">{{ \Carbon\Carbon::parse($pesanan->waktu_pesanan)->format('H:i') }}</td>
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

    <!-- Pagination -->
    <div class="mt-4">
        {{ $pesanans->links() }}
    </div>

    <a href="{{ route('pelayan.pesanan.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Kembali</a>
</main>
@endsection