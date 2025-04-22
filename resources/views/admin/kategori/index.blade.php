@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header & Add Button -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-900">Data Kategori</h1>
        <!-- Button to Open Modal -->
        <button onclick="document.getElementById('modalTambah').classList.remove('hidden')" class="bg-blue-600 text-white py-2 px-5 rounded-lg hover:bg-blue-700 transition duration-300">Tambah Kategori</button>
    </div>

    <!-- Kategori Table -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg border border-gray-200">
        <table class="min-w-full table-auto">
            <thead class="bg-gradient-to-r from-green-600 to-green-700 text-white">
                <tr>
                    <th class="py-3 px-6 text-left font-medium">Jenis Menu</th>
                    <th class="py-3 px-6 text-left font-medium">Kategori Menu</th>
                    <th class="py-3 px-6 text-left font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategoris as $kategori)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-6">{{ $kategori->jenis_menu }}</td>
                    <td class="py-3 px-6">{{ $kategori->kategori_menu }}</td>
                    <td class="py-3 px-6 flex gap-2">
                        <!-- Edit Button -->
                        <button onclick="document.getElementById('modalEdit-{{ $kategori->id_kat_menu }}').classList.remove('hidden')" class="bg-yellow-500 text-white px-4 py-1 rounded hover:bg-yellow-600">Edit</button>
                        <!-- Delete Form -->
                        <form action="{{ route('admin.kategori.destroy', $kategori->id_kat_menu) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Tambah Kategori -->
    <div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white w-full max-w-xl p-6 rounded-lg relative">
            <button onclick="document.getElementById('modalTambah').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>
            <h2 class="text-xl font-semibold mb-4">Tambah Kategori</h2>
            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-4 mb-4">
                    <input type="text" name="jenis_menu" placeholder="Jenis Menu" class="border p-2 rounded w-full" required>
                    <input type="text" name="kategori_menu" placeholder="Kategori Menu" class="border p-2 rounded w-full" required>
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Kategori -->
    @foreach($kategoris as $kategori)
    <div id="modalEdit-{{ $kategori->id_kat_menu }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white w-full max-w-xl p-6 rounded-lg relative">
            <button onclick="document.getElementById('modalEdit-{{ $kategori->id_kat_menu }}').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>
            <h2 class="text-xl font-semibold mb-4">Edit Kategori</h2>
            <form action="{{ route('admin.kategori.update', $kategori->id_kat_menu) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-4 mb-4">
                    <input type="text" name="jenis_menu" value="{{ $kategori->jenis_menu }}" class="border p-2 rounded w-full" required>
                    <input type="text" name="kategori_menu" value="{{ $kategori->kategori_menu }}" class="border p-2 rounded w-full" required>
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Function to open modal
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.querySelector('button').addEventListener('click', function () {
                modal.classList.add('hidden');
            });
        });
    });
</script>
@endsection
