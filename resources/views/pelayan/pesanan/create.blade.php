@extends('layouts.pelayan')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold text-red-600 mb-6">Tambah Pesanan Baru</h2>

    <form action="{{ route('pelayan.pesanan.store') }}" method="POST">
        @csrf

        <div class="grid md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="font-medium">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label class="font-medium">No HP</label>
                <input type="text" name="no_hp" class="w-full border rounded p-2" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="font-medium">Nomor Meja (opsional)</label>
            <input type="text" name="meja" class="w-full border rounded p-2">
        </div>

        <div id="menuWrapper" class="space-y-4">
            <div class="menu-item bg-gray-50 p-4 rounded border">
                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label class="font-medium">Pilih Menu</label>
                        <select name="menu_id[]" class="w-full border p-2 rounded" required>
                            <option value="" disabled selected>-- Pilih Menu --</option>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}">{{ $menu->nama_menu }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="font-medium">Jumlah</label>
                        <input type="number" name="jumlah[]" class="w-full border p-2 rounded" min="1" required>
                    </div>
                    <div>
                        <label class="font-medium">Catatan</label>
                        <input type="text" name="catatan[]" class="w-full border p-2 rounded">
                    </div>
                </div>
            </div>
        </div>

        <div class="text-right mt-3">
            <button type="button" onclick="tambahMenu()" class="text-sm bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Tambah Menu</button>
        </div>

        <div class="text-center mt-6">
            <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded hover:bg-red-700">Simpan Pesanan</button>
        </div>
    </form>
</div>

<script>
    function tambahMenu() {
        const wrapper = document.getElementById('menuWrapper');
        const item = document.querySelector('.menu-item');
        const clone = item.cloneNode(true);
        clone.querySelectorAll('input, select').forEach(i => i.value = '');
        wrapper.appendChild(clone);
    }
</script>
@endsection
