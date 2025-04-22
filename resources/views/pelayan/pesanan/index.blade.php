@extends('layouts.pelayan')

@section('content')
<main>
    <h1 class="text-2xl font-bold mb-4">Daftar Pesanan</h1>
    <a href="{{ route('pelayan.pesanan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Buat Pesanan</a>

    <div class="mt-4 bg-white p-4 shadow rounded">
        <table class="w-full border border-collapse border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="border p-2 w-12 text-center">No</th>
                    <th class="border p-2">Pelanggan</th>
                    <th class="border p-2">Meja</th>
                    <th class="border p-2">Pelayan</th>
                    <th class="border p-2">Waktu Pesanan</th>
                    <th class="border p-2 text-center">Status</th>
                    <th class="border p-2 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pesanans as $index => $pesanan)
                    <tr>
                        <td class="border p-2 text-center">{{ $pesanans->firstItem() + $index }}</td>
                        <td class="border p-2">{{ $pesanan->pelanggan }}</td>
                        <td class="border p-2 text-center">{{ $pesanan->meja ?? '-' }}</td>
                        <td class="border p-2">{{ $pesanan->pelayanUser->nama }}</td>
                        <td class="border p-2">{{ \Carbon\Carbon::parse($pesanan->waktu_pesanan)->format('d-m-Y H:i') }}</td>
                        <td class="border p-2">
                            @if($pesanan->listPesanan->isNotEmpty())
                                @foreach ($pesanan->listPesanan as $item)
                                    <div class="flex justify-between items-center">
                                        <span>{{ $item->menu->nama_menu ?? 'Menu Tidak Ditemukan' }}</span>
                                        <span class="px-3 py-1 text-white rounded-lg text-sm font-semibold
                                            {{ $item->status == 'pending' ? 'bg-yellow-500' : '' }}
                                            {{ $item->status == 'dimasak' ? 'bg-blue-500' : '' }}
                                            {{ $item->status == 'selesai' ? 'bg-green-500' : '' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </div>
                                @endforeach
                            @else
                                <span class="text-gray-500">Belum ada pesanan</span>
                            @endif
                        </td>
                        <td class="border p-2 text-center">
                            <a href="{{ route('pesanan.show', $pesanan->id_pesanan) }}" class="text-blue-500">Lihat Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center border p-4 text-gray-500">Belum ada pesanan masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        {{-- <div class="mt-4">
            {{ $pesanans->links() }}
        </div> --}}
    </div>
</main>
@endsection
