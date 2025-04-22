@extends('layouts.pelayan')

@section('content')
<main>
    <h1 class="text-2xl font-bold mb-4">Buat Pesanan Baru</h1>
    <div class="bg-white p-6 shadow rounded">
        <form action="{{ route('pelayan.pesanan.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Nama Pelanggan</label>
                <input type="text" name="pelanggan" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Nomor Meja (Opsional)</label>
                <input type="text" name="meja" class="w-full border p-2 rounded">
            </div>
            
            <div id="menu-container">
                <div class="menu-item mb-4 flex space-x-2">
                    <select name="menus[0][id]" class="w-2/3 border p-2 rounded" required>
                        <option value="" disabled selected>Pilih Menu</option>
                        @foreach ($menus as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->nama_menu }} - Rp{{ number_format($menu->harga, 0, ',', '.') }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="menus[0][jumlah]" class="w-1/4 border p-2 rounded" required min="1" placeholder="Jumlah">
                    <input type="text" name="menus[0][catatan]" class="w-1/3 border p-2 rounded" placeholder="Catatan">
                    <button type="button" class="remove-menu bg-red-500 text-white px-2 py-1 rounded">✕</button>
                </div>
            </div>

            <button type="button" id="add-menu" class="bg-blue-500 text-white px-4 py-2 rounded">+ Tambah Menu</button>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-4">Simpan Pesanan</button>
        </form>
    </div>
</main>

<script>
    let menuIndex = 1;
    document.getElementById('add-menu').addEventListener('click', function() {
        let menuContainer = document.getElementById('menu-container');
        let newMenu = document.createElement('div');
        newMenu.classList.add('menu-item', 'mb-4', 'flex', 'space-x-2');
        newMenu.innerHTML = `
            <select name="menus[${menuIndex}][id]" class="w-2/3 border p-2 rounded" required>
                <option value="" disabled selected>Pilih Menu</option>
                @foreach ($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->nama_menu }} - Rp{{ number_format($menu->harga, 0, ',', '.') }}</option>
                @endforeach
            </select>
            <input type="number" name="menus[${menuIndex}][jumlah]" class="w-1/4 border p-2 rounded" required min="1" placeholder="Jumlah">
            <input type="text" name="menus[${menuIndex}][catatan]" class="w-1/3 border p-2 rounded" placeholder="Catatan">
            <button type="button" class="remove-menu bg-red-500 text-white px-2 py-1 rounded">✕</button>
        `;
        menuContainer.appendChild(newMenu);

        newMenu.querySelector('.remove-menu').addEventListener('click', function() {
            newMenu.remove();
        });

        menuIndex++;
    });

    document.querySelectorAll('.remove-menu').forEach(button => {
        button.addEventListener('click', function() {
            this.parentElement.remove();
        });
    });
</script>

@endsection
