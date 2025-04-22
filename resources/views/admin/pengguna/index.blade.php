@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-16">
    <!-- Add User Button -->
    <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="bg-blue-600 text-white py-3 my-5 px-5 rounded-lg hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
        Tambah Pengguna
    </button>


    <!-- User Table -->
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg border border-gray-200">
        <table class="min-w-full table-auto">
            <thead class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                <tr>
                    <th class="py-3 px-6 text-left font-medium">Nama</th>
                    <th class="py-3 px-6 text-left font-medium">No Hp</th>
                    <th class="py-3 px-6 text-left font-medium">Alamat</th>
                    <th class="py-3 px-6 text-left font-medium">Level</th>
                    <th class="py-3 px-6 text-left font-medium">Tanggal Bergabung</th>
                    <th class="py-3 px-6 text-left font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b hover:bg-gray-50 transition duration-300">
                    <td class="py-3 px-6 text-sm">{{ $user->nama }}</td>
                    <td class="py-3 px-6 text-sm">{{ $user->no_hp }}</td>
                    <td class="py-3 px-6 text-sm">{{ $user->alamat }}</td>
                    <td class="py-3 px-6 text-sm">{{ $user->level }}</td>
                    <td class="py-3 px-6 text-sm">{{ $user->created_at->format('d-m-Y') }}</td>
                    <td class="py-3 px-6 text-sm flex gap-2">
                        <!-- Edit Button -->
                        <button onclick="document.getElementById('editModal-{{ $user->id }}').classList.remove('hidden')" class="bg-yellow-500 text-white py-1 px-4 rounded-lg hover:bg-yellow-600 transition duration-300">Edit</button>

                        <!-- Delete Button -->
                        <form action="{{ route('admin.pengguna.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white py-1 px-4 rounded-lg hover:bg-red-700 transition duration-300">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Edit Pengguna -->
                <div id="editModal-{{ $user->id }}" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
                    <div class="bg-white p-6 rounded-lg w-full max-w-lg relative">
                        <h2 class="text-xl font-semibold mb-4">Edit Pengguna</h2>
                        <form action="{{ route('admin.pengguna.update', $user->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="nama" class="block text-gray-700">Nama</label>
                                <input type="text" name="nama" value="{{ $user->nama }}" class="w-full px-4 py-2 border rounded-lg" required>
                            </div>

                            <div>
                                <label for="no_hp" class="block text-gray-700">No HP</label>
                                <input type="text" name="no_hp" value="{{ $user->no_hp }}" class="w-full px-4 py-2 border rounded-lg" required>
                            </div>

                            <div>
                                <label for="alamat" class="block text-gray-700">Alamat</label>
                                <textarea name="alamat" class="w-full px-4 py-2 border rounded-lg" required>{{ $user->alamat }}</textarea>
                            </div>

                            <div>
                                <label for="level" class="block text-gray-700">Level</label>
                                <input type="text" name="level" value="{{ $user->level }}" class="w-full px-4 py-2 border rounded-lg" required>
                            </div>

                            <div class="flex justify-end gap-3">
                                <button type="button" onclick="document.getElementById('editModal-{{ $user->id }}').classList.add('hidden')" class="bg-gray-300 px-4 py-2 rounded-lg hover:bg-gray-400">Batal</button>
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Modal Tambah Pengguna -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg w-full max-w-lg relative">
        <h2 class="text-xl font-semibold mb-4">Tambah Pengguna</h2>
        <form action="{{ route('admin.pengguna.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="nama" class="block text-gray-700">Nama</label>
                <input type="text" name="nama" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div>
                <label for="no_hp" class="block text-gray-700">No HP</label>
                <input type="text" name="no_hp" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div>
                <label for="alamat" class="block text-gray-700">Alamat</label>
                <textarea name="alamat" class="w-full px-4 py-2 border rounded-lg" required></textarea>
            </div>

            <div>
                <label for="level" class="block text-gray-700">Level</label>
                <select name="level" class="w-full px-4 py-2 border rounded-lg" required>
                    <option value="">-- Pilih Level --</option>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                </select>
            </div>

            <div>
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg" required>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="bg-gray-300 px-4 py-2 rounded-lg hover:bg-gray-400">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
