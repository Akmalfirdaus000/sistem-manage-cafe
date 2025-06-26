@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="container mx-auto px-4 py-10">

    {{-- Flash Message --}}
    @if(session('message'))
        <div class="mb-4 p-4 bg-emerald-100 text-emerald-800 rounded-lg shadow">
            {{ session('message') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg shadow">
            {{ implode(', ', $errors->all()) }}
        </div>
    @endif

    {{-- Button Tambah --}}
    <div class="flex justify-end mb-6">
        <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-3 rounded-xl shadow transition">
            + Tambah Pengguna
        </button>
    </div>

    {{-- Tabel Pengguna --}}
    <div class="overflow-x-auto bg-white rounded-xl shadow border border-gray-200">
        <table class="min-w-full text-sm">
            <thead class="bg-gradient-to-r from-indigo-600 to-violet-600 text-white">
                <tr>
                    <th class="py-3 px-6 text-left font-semibold">Nama</th>
                    <th class="py-3 px-6 text-left font-semibold">No HP</th>
                    <th class="py-3 px-6 text-left font-semibold">Alamat</th>
                    <th class="py-3 px-6 text-left font-semibold">Level</th>
                    <th class="py-3 px-6 text-left font-semibold">Bergabung</th>
                    <th class="py-3 px-6 text-left font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="py-3 px-6">{{ $user->nama }}</td>
                    <td class="py-3 px-6">{{ $user->no_hp }}</td>
                    <td class="py-3 px-6">{{ $user->alamat }}</td>
                    <td class="py-3 px-6 capitalize">{{ $user->level }}</td>
                    <td class="py-3 px-6">{{ $user->created_at->format('d-m-Y') }}</td>
                    <td class="py-3 px-6 flex gap-2">
                        {{-- Edit --}}
                        <button onclick="document.getElementById('editModal-{{ $user->id }}').classList.remove('hidden')" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1 rounded-lg shadow">
                            Edit
                        </button>

                        {{-- Delete --}}
                        <form action="{{ route('admin.pengguna.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded-lg shadow">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>

                {{-- Modal Edit --}}
                <div id="editModal-{{ $user->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-2xl w-full max-w-xl shadow-xl my-10">
        <h2 class="text-lg md:text-xl font-semibold mb-5 text-gray-800">Edit Pengguna</h2>
        <form action="{{ route('admin.pengguna.update', $user->id) }}" method="POST" class="grid grid-cols-1 gap-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="nama" value="{{ $user->nama }}" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:ring-indigo-400 focus:outline-none" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" name="username" value="{{ $user->username }}" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:ring-indigo-400 focus:outline-none" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No HP</label>
                    <input type="text" name="no_hp" value="{{ $user->no_hp }}" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:ring-indigo-400 focus:outline-none" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                    <select name="level" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:ring-indigo-400 focus:outline-none" required>
                        <option value="admin" {{ $user->level === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="pelayan" {{ $user->level === 'pelayan' ? 'selected' : '' }}>Pelayan</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <textarea name="alamat" rows="2" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:ring-indigo-400 focus:outline-none" required>{{ $user->alamat }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                    <input type="password" name="password" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:ring-indigo-400 focus:outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:ring-indigo-400 focus:outline-none">
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="document.getElementById('editModal-{{ $user->id }}').classList.add('hidden')" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Batal</button>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah Pengguna --}}
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 overflow-y-auto hidden">
    <div class="bg-white p-6 rounded-2xl w-full max-w-xl shadow-xl my-10">
        <h2 class="text-lg md:text-xl font-semibold mb-5 text-gray-800">Tambah Pengguna</h2>
        <form action="{{ route('admin.pengguna.store') }}" method="POST" class="grid grid-cols-1 gap-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="nama" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" name="username" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No HP</label>
                    <input type="text" name="no_hp" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                    <select name="level" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
                        <option value="">-- Pilih Level --</option>
                        <option value="admin">Admin</option>
                        <option value="pelayan">Pelayan</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <textarea name="alamat" rows="2" class="w-full border px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400" required></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Batal</button>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>


{{-- Script: buka modal otomatis jika ada error --}}
<script>
    @if ($errors->any() && old('username'))
        document.getElementById('addModal')?.classList.remove('hidden');
    @endif
</script>

@endsection
