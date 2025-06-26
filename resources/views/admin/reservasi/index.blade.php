@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Data Reservasi</h1>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full">
            <thead class="bg-blue-600 text-white">
                <tr>
                    <th class="px-4 py-2 text-left">Nama Pelanggan</th>
                    <th class="px-4 py-2 text-left">No HP</th>
                    <th class="px-4 py-2 text-left">Jumlah Orang</th>
                    <th class="px-4 py-2 text-left">Meja</th>
                    <th class="px-4 py-2 text-left">Waktu</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservasis as $r)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2">{{ $r->nama_pelanggan }}</td>
                    <td class="px-4 py-2">{{ $r->no_hp }}</td>
                    <td class="px-4 py-2">{{ $r->jumlah_orang }}</td>
                    <td class="px-4 py-2">{{ $r->meja ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $r->waktu_reservasi->format('d M Y H:i') }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 text-white rounded {{ $r->status === 'menunggu' ? 'bg-yellow-500' : ($r->status === 'diterima' ? 'bg-green-600' : 'bg-red-500') }}">
                            {{ ucfirst($r->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2">
                        @if($r->status === 'menunggu')
                        <form action="{{ route('admin.reservasi.updateStatus', $r->id) }}" method="POST" class="inline">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="diterima">
                            <button class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700" onclick="return confirm('Terima reservasi ini?')">Terima</button>
                        </form>
                        <form action="{{ route('admin.reservasi.updateStatus', $r->id) }}" method="POST" class="inline">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="dibatalkan">
                            <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 ml-2" onclick="return confirm('Batalkan reservasi ini?')">Tolak</button>
                        </form>
                        @else
                        <span class="text-gray-500 italic">Sudah {{ $r->status }}</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $reservasis->links() }}
    </div>
</div>
@endsection
