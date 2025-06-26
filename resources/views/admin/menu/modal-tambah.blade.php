<div id="modalTambah" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white w-full max-w-xl p-6 rounded-lg relative">
        <button onclick="document.getElementById('modalTambah').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>
        <h2 class="text-xl font-semibold mb-4">Tambah Menu</h2>
        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <input type="text" name="nama_menu" placeholder="Nama Menu" class="border p-2 rounded w-full" required>
                <select name="kategori" class="border p-2 rounded w-full" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id_kat_menu }}">{{ $kategori->jenis_menu }}</option>
                    @endforeach
                </select>
                <input type="number" name="harga" placeholder="Harga" class="border p-2 rounded w-full" required>
                <input type="number" name="stok" placeholder="Stok" class="border p-2 rounded w-full" required>
                <textarea name="keterangan" placeholder="Keterangan" class="border p-2 rounded col-span-full"></textarea>
                <input type="file" name="foto" class="border p-2 rounded col-span-full">
            </div>
            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
