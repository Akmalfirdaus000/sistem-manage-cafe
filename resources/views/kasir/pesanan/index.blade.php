@extends('layouts.kasir')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4 text-red-600">Daftar Pesanan</h1>

    <!-- Form Pencarian -->
    <div class="flex flex-wrap gap-4 mb-4">
        <input type="text" id="searchNama" placeholder="Cari berdasarkan nama..." class="p-2 border rounded-lg w-1/3 focus:ring-red-500">
        <input type="date" id="searchTanggal" class="p-2 border rounded-lg w-1/4 focus:ring-red-500">
        <select id="searchStatus" class="p-2 border rounded-lg w-1/4 focus:ring-red-500">
            <option value="">Semua Status</option>
            <option value="pending">Pending</option>
            <option value="dimasak">Dimasak</option>
            <option value="selesai">Selesai</option>
            <option value="sudah bayar">Sudah Bayar</option>
        </select>
    </div>

    <!-- Tabel Pesanan -->
    <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-red-600 text-white text-center">
                    <th class="p-3">No</th>
                    <th class="p-3">Nama Pelanggan</th>
                    <th class="p-3">Tanggal Pesanan</th>
                    <th class="p-3">Total Pembayaran</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody id="pesananTable">
                @foreach ($pesanans as $index => $pesanan)
                    <tr class="border-b border-gray-200 text-center">
                        <td class="p-3">{{ ($pesanans->currentPage() - 1) * $pesanans->perPage() + $loop->iteration }}</td>
                        <td class="p-3">{{ $pesanan->pelanggan }}</td>
                        <td class="p-3">{{ \Carbon\Carbon::parse($pesanan->created_at)->format('d-m-Y') }}</td>
                        <td class="p-3">
                            Rp {{ number_format($pesanan->listPesanan->sum(fn($item) => $item->jumlah * $item->menu->harga), 0, ',', '.') }}
                        </td>
                        <td class="p-3">
                            @php
                                $status = $pesanan->listPesanan->pluck('status')->unique()->toArray();
                            @endphp

                            @foreach ($status as $s)
                                @if ($s === 'pending')
                                    <span class="px-3 py-1 bg-yellow-500 text-white rounded-lg status-tag">Pending</span>
                                @elseif ($s === 'dimasak')
                                    <span class="px-3 py-1 bg-orange-500 text-white rounded-lg status-tag">Dimasak</span>
                                @elseif ($s === 'selesai')
                                    <span class="px-3 py-1 bg-blue-500 text-white rounded-lg status-tag">Selesai</span>
                                @elseif ($s === 'sudah bayar')
                                    <span class="px-3 py-1 bg-green-500 text-white rounded-lg status-tag">Sudah Bayar</span>
                                @endif
                            @endforeach
                        </td>
                    <td class="p-3 space-x-2">
    <!-- Tombol Detail -->
   <a href="{{ route('kasir.pesanan.show', ['id' => $pesanan->id_pesanan]) }}" 
   class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
   Detail
</a>


    <!-- Tombol Bayar (Hanya jika status selesai) -->
    @if (in_array('selesai', $status))
        <form action="{{ route('kasir.pesanan.bayar', $pesanan->id_pesanan) }}" method="get" class="inline">
            @csrf
            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                Bayar
            </button>
        </form>
    @endif
</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $pesanans->links() }}
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchNama = document.getElementById("searchNama");
    const searchTanggal = document.getElementById("searchTanggal");
    const searchStatus = document.getElementById("searchStatus");
    const tableRows = document.querySelectorAll("#pesananTable tr");

    function filterPesanan() {
        const namaQuery = searchNama.value.toLowerCase();
        const tanggalQuery = searchTanggal.value;
        const statusQuery = searchStatus.value.toLowerCase();

        tableRows.forEach(row => {
            const nama = row.children[1].textContent.toLowerCase();
            const tanggal = row.children[2].textContent.split("-").reverse().join("-"); // Format ke YYYY-MM-DD
            const statusElements = row.children[4].querySelectorAll(".status-tag");
            const statusText = Array.from(statusElements).map(el => el.textContent.toLowerCase()).join(" ");

            if (
                (nama.includes(namaQuery) || namaQuery === "") &&
                (tanggal.includes(tanggalQuery) || tanggalQuery === "") &&
                (statusText.includes(statusQuery) || statusQuery === "")
            ) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    searchNama.addEventListener("input", filterPesanan);
    searchTanggal.addEventListener("change", filterPesanan);
    searchStatus.addEventListener("change", filterPesanan);
});
</script>

@endsection
