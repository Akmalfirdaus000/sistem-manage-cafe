@extends('layouts.pelayan')

@section('content')
<main>
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Daftar Pesanan Masuk</h1>

    <div class="bg-white p-6 shadow rounded-lg overflow-x-auto">
        <table class="w-full table-auto border border-gray-200">
            <thead class="bg-red-600 text-white">
                <tr>
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Pelanggan</th>
                    <th class="p-3 text-left">Meja</th>
                    <th class="p-3 text-left">Waktu Pesanan</th>
                    <th class="p-3 text-left">List Menu</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pesanans as $index => $pesanan)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $pesanans->firstItem() + $index }}</td>
                    <td class="p-3">{{ $pesanan->nama_pelanggan }}</td>
                    <td class="p-3">{{ $pesanan->meja ?? '-' }}</td>
                    <td class="p-3">{{ \Carbon\Carbon::parse($pesanan->waktu_pesanan)->format('d-m-Y H:i') }}</td>
                    <td class="p-3">
                        @if($pesanan->listPesanan->isNotEmpty())
                            <ul class="space-y-2">
                                @foreach ($pesanan->listPesanan as $item)
                                    <li class="flex justify-between items-center gap-2 border-b pb-1">
                                        <div>
                                            <span>{{ $item->menu->nama_menu ?? 'Menu Tidak Ditemukan' }}</span><br>
                                            <span class="text-sm text-gray-500">Status:</span>
                                            <span class="text-xs font-semibold px-2 py-1 rounded text-white
                                                {{ $item->status == 'pending' ? 'bg-yellow-500' : '' }}
                                                {{ $item->status == 'dimasak' ? 'bg-blue-500' : '' }}
                                                {{ $item->status == 'selesai' ? 'bg-green-500' : '' }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </div>
                                        @if ($item->status !== 'selesai')
                                        <form action="{{ route('pelayan.pesanan.ubahStatus', $item->id_list_pesanan) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="{{ $item->status === 'pending' ? 'dimasak' : 'selesai' }}">
                                            <button type="submit" class="text-sm bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 transition">
                                                @if($item->status == 'pending')
                                                    Masak
                                                @elseif($item->status == 'dimasak')
                                                    Antar
                                                @endif
                                            </button>
                                        </form>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-500">Belum ada item</span>
                        @endif
                    </td>
                    <td class="p-3 text-center">
                        <a href="{{ route('pelayan.pesanan.show', $pesanan->id_pesanan) }}" class="text-blue-600 hover:underline">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-gray-500">Belum ada pesanan masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        @if ($pesanans->hasPages())
        <div class="mt-4">
            {{ $pesanans->links() }}
        </div>
        @endif
    </div>
</main>
@endsection
