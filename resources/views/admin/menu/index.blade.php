@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header & Add Button -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-900">Data Menu</h1>
        <!-- Button to Open Modal -->
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="bg-blue-600 text-white py-2 px-5 rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105">Tambah Menu</button>
    </div>

    <!-- Menu Table -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg border border-gray-200">
        <table class="min-w-full table-auto">
            <thead class="bg-gradient-to-r from-green-600 to-green-700 text-white">
                <tr>
                    <th class="py-3 px-6 text-left font-medium">Foto</th>
                    <th class="py-3 px-6 text-left font-medium">Nama Menu</th>
                    <th class="py-3 px-6 text-left font-medium">Kategori</th>
                    <th class="py-3 px-6 text-left font-medium">Harga</th>
                    <th class="py-3 px-6 text-left font-medium">Keterangan</th>
                    <th class="py-3 px-6 text-left font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                <tr class="border-b hover:bg-gray-50 transition duration-300">
                    <td class="py-3 px-6">
                        @if($menu->foto)
                            <img src="{{ asset('storage/menu/' . $menu->foto) }}" alt="Menu Image" class="w-16 h-16 object-cover rounded">
                        @else
                            <span class="text-sm text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="py-3 px-6">{{ $menu->nama_menu }}</td>
                    <td class="py-3 px-6">{{ $menu->kategoriRelasi->kategori_menu ?? '-' }}</td>
                    <td class="py-3 px-6">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                    <td class="py-3 px-6">{{ $menu->keterangan }}</td>
                    <td class="py-3 px-6 flex gap-2">
                        <button onclick="document.getElementById('modalEdit-{{ $menu->id }}').classList.remove('hidden')" class="bg-yellow-500 text-white px-4 py-1 rounded hover:bg-yellow-600 transition duration-300 transform hover:scale-105">Edit</button>
                        <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 transition duration-300">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Menu -->
    <div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white w-full max-w-xl p-6 rounded-lg relative">
            <button onclick="document.getElementById('modalTambah').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>
            <h2 class="text-xl font-semibold mb-4">Tambah Menu</h2>
            <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-4 mb-4">
                    <input type="text" name="nama_menu" placeholder="Nama Menu" class="border p-2 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    <textarea name="keterangan" placeholder="Keterangan" class="border p-2 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                    <select name="kategori" class="border p-2 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id_kat_menu }}">{{ $kategori->jenis_menu }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="harga" placeholder="Harga" class="border p-2 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    <input type="file" name="foto" class="border p-2 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Menu -->
<!-- Modal Edit Menu -->
@foreach($menus as $menu)
    <div id="modalEdit-{{ $menu->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white w-full max-w-xl p-6 rounded-lg relative">
            <button onclick="document.getElementById('modalEdit-{{ $menu->id }}').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>
            <h2 class="text-xl font-semibold mb-4">Edit Menu</h2>
            <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-4 mb-4">
                    <input type="text" name="nama_menu" value="{{ $menu->nama_menu }}" class="border p-2 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    <textarea name="keterangan" class="border p-2 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ $menu->keterangan }}</textarea>
                    <select name="kategori" class="border p-2 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id_kat_menu }}" {{ $menu->kategori == $kategori->id_kat_menu ? 'selected' : '' }}>{{ $kategori->jenis_menu }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="harga" value="{{ $menu->harga }}" class="border p-2 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    <input type="file" name="foto" class="border p-2 rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300 transform hover:scale-105">Update</button>
                </div>
            </form>
        </div>
    </div>
@endforeach


@endsection
