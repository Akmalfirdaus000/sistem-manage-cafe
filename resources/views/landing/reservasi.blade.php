@extends('layouts.landing')

@section('content')
<div class="max-w-xl mx-auto py-12 px-4">
    <h2 class="text-2xl font-bold mb-6 text-center">Form Reservasi Meja</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('landing.reservasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block font-medium">Nama Lengkap</label>
            <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" required class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp') }}" required class="w-full border p-2 rounded">
        </div>

<div>
    <label>Email</label>
    <input type="email" name="email" required class="w-full border p-2 rounded">
</div>


        <div>
            <label class="block font-medium">Tanggal Reservasi</label>
            <input type="date" name="tanggal_reservasi" value="{{ old('tanggal_reservasi') }}" required class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Jam Reservasi</label>
            <input type="time" name="jam_reservasi" value="{{ old('jam_reservasi') }}" required class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Jumlah Tamu</label>
            <input type="number" name="jumlah_orang" value="{{ old('jumlah_orang', 1) }}" min="1" required class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block font-medium">Tipe Meja</label>
            <select name="meja" class="w-full border p-2 rounded" required>
                <option disabled selected>Pilih Meja</option>
                <option value="Indoor">Indoor</option>
                <option value="Outdoor">Outdoor</option>
                <option value="Sofa">Sofa</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Bukti Transfer (Rek BRI: 01824918422)</label>
            <input type="file" name="bukti_transfer" accept="image/*" required class="w-full border p-2 rounded">
            <small class="text-sm text-gray-500">Silakan transfer DP Rp50.000 lalu upload bukti di sini.</small>
        </div>

        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
            Kirim Reservasi
        </button>
    </form>
</div>
@endsection
