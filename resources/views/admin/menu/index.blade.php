@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header & Add Button -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-900">Data Menu</h1>
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="bg-blue-600 text-white py-2 px-5 rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105">
            Tambah Menu
        </button>
    </div>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg border border-gray-200">
        <table class="min-w-full table-auto">
            <thead class="bg-gradient-to-r from-green-600 to-green-700 text-white">
                <tr>
                    <th class="py-3 px-6 text-left">Foto</th>
                    <th class="py-3 px-6 text-left">Nama Menu</th>
                    <th class="py-3 px-6 text-left">Kategori</th>
                    <th class="py-3 px-6 text-left">Harga</th>
                    <th class="py-3 px-6 text-left">Stok</th>
                    <th class="py-3 px-6 text-left">Keterangan</th>
                    <th class="py-3 px-6 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($menus as $menu)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-6">
                            @if($menu->foto)
                                <img src="{{ asset('storage/' . $menu->foto) }}" class="w-16 h-16 object-cover rounded" alt="Foto">
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="py-3 px-6">{{ $menu->nama_menu }}</td>
                        <td class="py-3 px-6">{{ $menu->kategoriRelasi->jenis_menu ?? '-' }}</td>
                        <td class="py-3 px-6">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                        <td class="py-3 px-6">{{ $menu->stok }}</td>
                        <td class="py-3 px-6">{{ $menu->keterangan }}</td>
                        <td class="py-3 px-6 flex gap-2">
                            <button onclick="document.getElementById('modalEdit-{{ $menu->id }}').classList.remove('hidden')" class="bg-yellow-500 text-white px-4 py-1 rounded hover:bg-yellow-600">
                                Edit
                            </button>
                            <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    {{-- Modal Edit per Menu --}}
                    @include('admin.menu.modal-edit', ['menu' => $menu, 'kategoris' => $kategoris])
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah --}}
@include('admin.menu.modal-tambah', ['kategoris' => $kategoris])
@endsection
