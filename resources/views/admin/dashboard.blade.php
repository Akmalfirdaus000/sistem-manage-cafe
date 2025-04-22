@extends(' layouts.admin')
@section('title', 'Dashboard Admin')
@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Admin</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Pesanan</div>
                <div class="card-body">
                    <h5 class="card-title">Jumlah Pesanan</h5>
                    {{-- <p class="card-text">{{ $totalPesanan }}</p> --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Pendapatan</div>
                <div class="card-body">
                    <h5 class="card-title">Pendapatan Bulanan</h5>
                    {{-- <p class="card-text">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p> --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Total Menu</div>
                <div class="card-body">
                    <h5 class="card-title">Jumlah Menu</h5>
                    {{-- <p class="card-text">{{ $totalMenu }}</p> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>Pesanan Terbaru</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Nama Pelanggan</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach($pesananTerbaru as $pesanan)
                        <tr>
                            <td>{{ $pesanan->id }}</td>
                            <td>{{ $pesanan->nama_pelanggan }}</td>
                            <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            <td>{{ $pesanan->status }}</td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
