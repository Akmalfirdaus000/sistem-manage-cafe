@extends('layouts.kasir')

@section('content')
<main>
    <h1 class="text-2xl font-bold mb-6">Daftar Transaksi</h1>

    <!-- Pencarian & Filter -->
    <div class="mb-4 flex flex-col md:flex-row justify-between gap-2">
        <form method="GET" class="flex gap-2 w-full md:w-auto">
            <input type="text" name="search" placeholder="Cari pelanggan..." value="{{ request('search') }}" 
                   class="border p-2 rounded w-full md:w-64 focus:outline-none focus:ring focus:border-blue-300">
            <select name="status" class="border p-2 rounded w-full md:w-40 focus:outline-none focus:ring focus:border-blue-300">
                <option value="">Semua Status</option>
                <option value="sudah bayar" {{ request('status') == 'sudah bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Cari</button>
        </form>
    </div>

    <!-- Tabel Transaksi -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="border p-2">#</th>
                    <th class="border p-2">Pelanggan</th>
                    <th class="border p-2">Total Bayar</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Waktu Bayar</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksi as $trx)
                    <tr class="hover:bg-gray-50">
                        <td class="border p-2 text-center">{{ $loop->iteration }}</td>
                        <td class="border p-2">{{ optional($trx->pesanan)->pelanggan ?? 'Tidak Diketahui' }}</td>
                        <td class="border p-2">Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}</td>
                        <td class="border p-2 text-center">
                            @php
                                $listPesanan = optional($trx->pesanan)->listPesanan ?? collect();
                                $status = $listPesanan->isNotEmpty() ? $listPesanan->pluck('status')->unique()->join(', ') : 'Tidak Diketahui';
                                $statusClass = str_contains($status, 'sudah bayar') ? 'bg-green-500' : 'bg-yellow-500';
                            @endphp
                            <span class="px-2 py-1 rounded text-white {{ $statusClass }}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td class="border p-2 text-center">
                            {{ $trx->waktu_bayar ? \Carbon\Carbon::parse($trx->waktu_bayar)->format('d M Y, H:i') : '-' }}
                        </td>
                        <td class="border p-2 text-center">
                            <a href="{{ route('kasir.transaksi.show', $trx->id_bayar) }}" 
                               class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border p-4 text-center text-gray-500">Tidak ada transaksi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $transaksi->links() }}
    </div>
</main>
@endsection
