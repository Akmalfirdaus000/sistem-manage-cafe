    @extends('layouts.admin')

    @section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header & Filter Section -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-900">Daftar Reservasi Selesai</h1>
        </div>

        <!-- Pesanan Table -->
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg border border-gray-200">
            <table class="min-w-full table-auto">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left font-medium">Kode Pesanan</th>
                        <th class="py-3 px-6 text-left font-medium">Pelanggan</th>
                        <th class="py-3 px-6 text-left font-medium">Menu</th>
                        <th class="py-3 px-6 text-left font-medium">Jumlah</th>
                        <th class="py-3 px-6 text-left font-medium">Catatan</th>
                        <th class="py-3 px-6 text-left font-medium">Status Pembayaran</th>
                        <th class="py-3 px-6 text-left font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservasi as $pesanan)
                    <tr class="border-b hover:bg-gray-50 transition duration-300">
                        <td class="py-3 px-6">{{ $pesanan->kode_pesanan }}</td>
                        <td class="py-3 px-6">{{ $pesanan->pesanan->pelanggan ?? 'Pelanggan Tidak Ditemukan' }}</td>


                        <td class="py-3 px-6">{{ $pesanan->menu->nama_menu }}</td>
                        <td class="py-3 px-6">{{ $pesanan->jumlah }}</td>
                        <td class="py-3 px-6">{{ $pesanan->catatan ?? '-' }}</td>
                        <td class="py-3 px-6">
                            <span class="px-3 py-1 rounded-full {{ $pesanan->status == 'selesai' ? 'bg-green-500' : 'bg-red-500' }} text-white">
                                {{ ucfirst($pesanan->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-6 flex gap-2">
                            <!-- Detail Button -->
                            <button onclick="document.getElementById('modalDetail-{{ $pesanan->id_list_pesanan }}').classList.remove('hidden')" class="bg-blue-600 text-white px-4 py-1 rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                                Detail
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 bg-white border-t border-gray-200">
            {{ $reservasi->links() }}
        </div>
    </div>

    <!-- Modal Detail Pesanan -->
    @foreach($reservasi as $pesanan)
    <div id="modalDetail-{{ $pesanan->id_list_pesanan }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white w-full max-w-xl p-6 rounded-lg relative transform hover:scale-105 transition duration-300">
            <button onclick="document.getElementById('modalDetail-{{ $pesanan->id_list_pesanan }}').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>
            <h2 class="text-xl font-semibold mb-4">Detail Pesanan #{{ $pesanan->kode_pesanan }}</h2>
            <div class="mb-4">
                <h3 class="font-medium text-lg">Menu: {{ $pesanan->menu->nama_menu }}</h3>
                <p><strong>Jumlah:</strong> {{ $pesanan->jumlah }}</p>
                <p><strong>Catatan:</strong> {{ $pesanan->catatan ?? 'Tidak ada' }}</p>
                <p><strong>Status Pembayaran:</strong>
                    <span class="px-3 py-1 rounded-full {{ $pesanan->status == 'selesai' ? 'bg-green-500' : 'bg-red-500' }} text-white">
                        {{ ucfirst($pesanan->status) }}
                    </span>
                </p>
            </div>
            <div class="text-right">
                <button onclick="document.getElementById('modalDetail-{{ $pesanan->id_list_pesanan }}').classList.add('hidden')" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transform hover:scale-105 transition duration-300">Tutup</button>
            </div>
        </div>
    </div>
    @endforeach

    @endsection
