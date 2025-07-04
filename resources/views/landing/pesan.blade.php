@vite(['resources/css/app.css', 'resources/js/app.js'])
@extends('layouts.landing', ['title' => 'Pesan Sekarang'])

@section('content')
<section class="bg-gray-50 min-h-screen py-20 px-6" id="pesan">
    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-xl p-8">
        <h2 class="text-3xl font-bold text-red-600 mb-6 text-center">Form Pemesanan</h2>

@if(session('success'))
    <div class="flex items-center justify-between bg-green-100 border border-green-300 text-green-800 px-5 py-4 rounded-lg mb-6 shadow-md animate-fade-in">
        <div class="flex items-center space-x-3">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M5 13l4 4L19 7"/>
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800 transition">
            &times;
        </button>
    </div>
@elseif(session('error'))
    <div class="flex items-center justify-between bg-red-100 border border-red-300 text-red-800 px-5 py-4 rounded-lg mb-6 shadow-md animate-fade-in">
        <div class="flex items-center space-x-3">
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800 transition">
            &times;
        </button>
    </div>
@endif



        <form action="{{ route('landing.pesan.store') }}" method="POST">
            @csrf

            <!-- Informasi Pelanggan -->
            <div class="grid md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block font-medium mb-1">Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" class="w-full border p-2 rounded" required>
                </div>
                <div>
                    <label class="block font-medium mb-1">No HP</label>
                    <input type="text" name="no_hp" class="w-full border p-2 rounded" required>
                </div>
            </div>

            <!-- Optional Meja -->
            <div class="mb-6">
                <label class="block font-medium mb-1">Nomor Meja (Opsional)</label>
                <input type="text" name="meja" class="w-full border p-2 rounded">
            </div>

            <!-- Daftar Menu -->
            <div id="menuWrapper" class="space-y-4">
                <div class="menu-item bg-gray-100 p-4 rounded-lg shadow-sm">
                    <div class="grid md:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-medium mb-1">Pilih Menu</label>
                            <select name="menu_id[]" class="w-full border p-2 rounded" required>
                                <option value="" disabled selected>-- Pilih Menu --</option>
                                @foreach ($menus as $menu)
    @if ($menu->stok <= 0)
        <option value="" disabled class="text-gray-400 italic">
            {{ $menu->nama_menu }} (Stok Habis)
        </option>
    @else
        <option value="{{ $menu->id }}">
            {{ $menu->nama_menu }}
        </option>
    @endif
@endforeach

                            </select>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Jumlah</label>
                            <input type="number" name="jumlah[]" class="w-full border p-2 rounded" min="1" required>
                        </div>
                        <div>
                            <label class="block font-medium mb-1">Catatan (Opsional)</label>
                            <input type="text" name="catatan[]" class="w-full border p-2 rounded">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Tambah Menu -->
            <div class="my-4 text-right">
                <button type="button" onclick="tambahMenu()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    + Tambah Menu
                </button>
            </div>

            <!-- Submit -->
            <div class="text-center mt-6">
                <button type="submit" class="bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 transition">
                    Kirim Pesanan
                </button>
            </div>
        </form>
    </div>
</section>

<script>
    function tambahMenu() {
        const wrapper = document.getElementById('menuWrapper');
        const item = document.querySelector('.menu-item');
        const clone = item.cloneNode(true);

        // Kosongkan value input
        clone.querySelectorAll('select, input').forEach(input => input.value = '');

        wrapper.appendChild(clone);
    }
</script>
@endsection
