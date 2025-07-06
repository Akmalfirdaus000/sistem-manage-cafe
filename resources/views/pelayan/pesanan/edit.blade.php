@extends('layouts.pelayan')

@section('content')
<main>
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Pesanan</h1>

    <div class="bg-white shadow p-6 rounded-lg max-w-4xl">
        <form action="{{ route('pelayan.pesanan.update', $pesanan->id_pesanan) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" value="{{ $pesanan->nama_pelanggan }}" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block font-medium text-gray-700 mb-1">Nomor Meja (Opsional)</label>
                    <input type="text" name="meja" value="{{ $pesanan->meja }}" class="w-full border p-2 rounded">
                </div>
            </div>

            <div id="list-menu" class="space-y-4">
                @foreach($pesanan->listPesanan as $index => $item)
                <div class="grid md:grid-cols-3 gap-4 items-end border rounded p-4 bg-gray-50 relative">
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Menu</label>
                        <select name="menu_id[]" class="w-full border p-2 rounded" required>
                            @foreach($menus as $menu)
                            <option value="{{ $menu->id }}" {{ $menu->id == $item->menu_id ? 'selected' : '' }}>{{ $menu->nama_menu }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Jumlah</label>
                        <input type="number" name="jumlah[]" class="w-full border p-2 rounded" min="1" value="{{ $item->jumlah }}" required>
                    </div>
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">Catatan</label>
                        <input type="text" name="catatan[]" class="w-full border p-2 rounded" value="{{ $item->catatan }}">
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-right my-4">
                <button type="button" onclick="tambahItem()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">+ Tambah Menu</button>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</main>

<script>
    function tambahItem() {
        const container = document.getElementById('list-menu');
        const sample = container.querySelector('div').cloneNode(true);

        sample.querySelectorAll('input').forEach(i => i.value = '');
        sample.querySelector('select').selectedIndex = 0;

        container.appendChild(sample);
    }
</script>
@endsection
