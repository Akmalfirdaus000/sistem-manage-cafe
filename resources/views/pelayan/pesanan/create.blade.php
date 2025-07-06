@extends('layouts.pelayan')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold text-red-600 mb-6">Tambah Pesanan</h2>

    @if(session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">{{ session('error') }}</div>
    @endif

    <form action="{{ route('pelayan.pesanan.store') }}" method="POST">
        @csrf

        <!-- Data Pelanggan -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block font-semibold mb-1">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Nomor HP</label>
                <input type="text" name="no_hp" class="w-full border p-2 rounded" required>
            </div>
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-1">Nomor Meja (Opsional)</label>
            <input type="text" name="meja" class="w-full border p-2 rounded">
        </div>

        <!-- List Menu -->
        <div id="menuWrapper" class="space-y-4 mb-6">
            <div class="menu-item bg-gray-100 p-4 rounded">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Pilih Menu</label>
                        <select name="menu_id[]" class="w-full border p-2 rounded" required>
                            <option value="" disabled selected>-- Pilih Menu --</option>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}">
                                    {{ $menu->nama_menu }} (Stok: {{ $menu->stok }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Jumlah</label>
                        <input type="number" name="jumlah[]" min="1" class="w-full border p-2 rounded" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Catatan (Opsional)</label>
                        <input type="text" name="catatan[]" class="w-full border p-2 rounded">
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Tambah Menu -->
        <div class="text-right mb-6">
            <button type="button" onclick="tambahMenu()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Tambah Menu
            </button>
        </div>

        <!-- Submit -->
        <div class="text-center">
            <button type="submit" class="bg-red-600 text-white px-8 py-3 rounded hover:bg-red-700 transition">
                Simpan Pesanan
            </button>
        </div>
    </form>
</div>

<script>
    function tambahMenu() {
        const wrapper = document.getElementById('menuWrapper');
        const item = document.querySelector('.menu-item');
        const clone = item.cloneNode(true);

        clone.querySelectorAll('input, select').forEach(field => field.value = '');
        wrapper.appendChild(clone);
    }
</script>
@endsection
