<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            width: 400px;
            margin: auto;
            border: 1px solid black;
            padding: 10px;
        }
        .header {
            display: flex;
            align-items: center;
            border: 1px solid black;
            padding: 8px;
            margin-bottom: 10px;
        }
        .logo {
            width: 70px;
            height: 70px;
            border: 1px solid black;
            border-radius: 50%;
            text-align: center;
            line-height: 70px;
            font-weight: bold;
        }
        .header-text {
            flex: 1;
            text-align: center;
            font-size: 12px;
        }
        .header-text h2 {
            margin: 0;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .ttd {
            margin-top: 20px;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="header">
    <div class="logo">KopKit</div>
    <div class="header-text">
        <h2>Cafe Kopi Kita</h2>
        Jalan Gajah Mada No.10 Kampung Lapai Baru, Kp. Olo, Kec. Nanggalo, Kota Padang, Sumatera Barat 25173<br>
        Telepon: 0811-6683-115
    </div>
</div>

<h3>Struk Pembayaran</h3>

<p>Nama Pelanggan: {{ $pesanan->nama_pelanggan }}</p>
<p>No Invoice: INV-{{ str_pad($pesanan->id_pesanan, 6, '0', STR_PAD_LEFT) }}</p>
<p>Tanggal: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>

<table>
    <thead>
        <tr>
            <th>Jumlah</th>
            <th>Nama Menu</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pesanan->listPesanan as $item)
        <tr>
            <td>{{ $item->jumlah }}</td>
            <td>{{ $item->menu->nama_menu }}</td>
            <td>Rp {{ number_format($item->jumlah * $item->menu->harga, 0, ',', '.') }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="2"><strong>Total</strong></td>
            <td><strong>Rp {{ number_format($pesanan->pembayaran->total_bayar, 0, ',', '.') }}</strong></td>
        </tr>
    </tbody>
</table>

<div class="ttd text-right">
    Padang, {{ \Carbon\Carbon::now()->format('d M Y') }} <br>
    Kasir <br><br>
    <strong>{{ auth()->user()->nama }}</strong><br>
    No Kasir: {{ auth()->user()->id ?? '..........................' }}
</div>

<script>
    window.print();
</script>

</body>
</html>
