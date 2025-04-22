<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 5px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Penjualan</h2>
    <p>Periode: {{ request()->tanggal_awal ?? now()->startOfMonth()->format('d M Y') }} - {{ request()->tanggal_akhir ?? now()->endOfMonth()->format('d M Y') }}</p>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No Pesanan</th>
                <th>Pelanggan</th>
                <th>Sub Total</th>
                <th>Total Penjualan</th>
                <th>Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $index => $t)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $t->created_at->format('d M Y') }}</td>
                    <td>{{ $t->pesanan->id_pesanan ?? '-' }}</td>
                    <td>{{ $t->pesanan->pelanggan ?? '-' }}</td>
                    <td>Rp {{ number_format($t->pesanan->listPesanan->sum('harga') ?? 0, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($t->total_bayar, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($t->nominal_uang, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="font-weight: bold; background: #f2f2f2;">
                <td colspan="4">Total Keseluruhan</td>
                <td>Rp {{ number_format($totalSubTotal, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
