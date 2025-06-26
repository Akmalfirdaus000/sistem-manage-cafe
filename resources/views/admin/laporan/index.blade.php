@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Laporan Penjualan</h1>

        <!-- Tombol Print -->
        <button onclick="printLaporan()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
            🖨️ Cetak Laporan
        </button>
    </div>

    <!-- Periode -->
    <div class="mb-4 text-gray-600">
        Periode: <strong>{{ \Carbon\Carbon::parse($start)->translatedFormat('d F Y') }}</strong> -
        <strong>{{ \Carbon\Carbon::parse($end)->translatedFormat('d F Y') }}</strong>
    </div>

    <!-- Tabel -->
    <div class="bg-white shadow-lg rounded-lg overflow-x-auto" id="laporanTable">
        <table class="min-w-full table-auto border border-gray-200">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="py-3 px-6 text-left">#</th>
                    <th class="py-3 px-6 text-left">Kode Pesanan</th>
                    <th class="py-3 px-6 text-left">Nama Pelanggan</th>
                    <th class="py-3 px-6 text-left">Total Bayar</th>
                    <th class="py-3 px-6 text-left">Nominal Uang</th>
                    <th class="py-3 px-6 text-left">Waktu Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($laporan as $index => $item)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="py-3 px-6">{{ $laporan->firstItem() + $index }}</td>
                    <td class="py-3 px-6">{{ $item->id_pesanan }}</td>
                    <td class="py-3 px-6">{{ $item->pesanan->nama_pelanggan ?? 'Tidak Diketahui' }}</td>
                    <td class="py-3 px-6 text-green-700 font-semibold">Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                    <td class="py-3 px-6 text-blue-600 font-semibold">Rp {{ number_format($item->nominal_uang, 0, ',', '.') }}</td>
                    <td class="py-3 px-6">{{ \Carbon\Carbon::parse($item->waktu_bayar)->translatedFormat('d F Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">Belum ada transaksi penjualan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $laporan->links() }}
    </div>
</div>

<!-- Script Print -->
<script>
    function printLaporan() {
        const printContent = document.getElementById('laporanTable').innerHTML;
        const originalContent = document.body.innerHTML;

        document.body.innerHTML = `
            <html>
                <head>
                    <title>Laporan Penjualan</title>
                    <style>
                        body { font-family: sans-serif; padding: 40px; }
                        table { width: 100%; border-collapse: collapse; }
                        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
                        th { background-color: #f0f0f0; }
                        h1 { margin-bottom: 20px; }
                    </style>
                </head>
                <body>
                    <h1>Laporan Penjualan</h1>
                    <div>Periode: {{ \Carbon\Carbon::parse($start)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($end)->translatedFormat('d F Y') }}</div>
                    <br>
                    ${printContent}
                </body>
            </html>
        `;

        window.print();
        document.body.innerHTML = originalContent;
        window.location.reload();
    }
</script>
@endsection
