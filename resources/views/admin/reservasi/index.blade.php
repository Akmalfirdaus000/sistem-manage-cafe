@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Reservasi Meja</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full table-auto border border-gray-200">
            <thead class="bg-blue-700 text-white text-sm">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Nama</th>
                    <th class="px-4 py-3 text-left">No HP</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Jam</th>
                    <th class="px-4 py-3 text-left">Jumlah</th>
                    <th class="px-4 py-3 text-left">Meja</th>
                    <th class="px-4 py-3 text-left">Pembayaran</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Bukti</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-700">
                @forelse($reservasis as $res)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3">{{ $res->nama_pelanggan }}</td>
                    <td class="px-4 py-3">{{ $res->no_hp }}</td>
                    <td class="px-4 py-3">{{ $res->email }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($res->tanggal_reservasi)->translatedFormat('d F Y') }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($res->jam_reservasi)->format('H:i') }}</td>
                    <td class="px-4 py-3">{{ $res->jumlah_orang }} org</td>
                    <td class="px-4 py-3">{{ ucfirst($res->meja) }}</td>
                    <td class="px-4 py-3">
                        <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                            {{ $res->status_pembayaran === 'sudah bayar' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($res->status_pembayaran) }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                            @if($res->status_reservasi == 'menunggu') bg-yellow-100 text-yellow-800
                            @elseif($res->status_reservasi == 'diterima') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($res->status_reservasi) }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        @if($res->bukti_transfer)
                            <a href="{{ asset('storage/' . $res->bukti_transfer) }}" target="_blank" class="text-blue-600 underline text-xs">Lihat</a>
                        @else
                            <span class="text-gray-400 text-xs italic">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center">
                        @if($res->status_reservasi == 'menunggu')
                            <form action="{{ route('admin.reservasi.updateStatus', $res->id) }}" method="POST" class="flex flex-col items-center gap-2">
                                @csrf
                                @method('PUT')
                                <button name="status_reservasi" value="diterima"
                                    class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs w-24 transition">
                                    Terima
                                </button>
                                <button name="status_reservasi" value="dibatalkan"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs w-24 transition">
                                    Tolak
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400 text-xs italic">Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="12" class="text-center py-6 text-gray-500">Belum ada reservasi masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $reservasis->links() }}
    </div>
</div>
@endsection
