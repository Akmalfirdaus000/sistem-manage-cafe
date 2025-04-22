@extends('layouts.dapur')

@section('content')
<main>
    <h1 class="text-2xl font-bold mb-4">Pesanan Masuk</h1>

    @include('components.alert')

    <div class="bg-white p-6 shadow rounded">
        <table class="w-full border border-collapse mt-2">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="border p-2 w-12 text-center">#</th>
                    <th class="border p-2">Nama Pelanggan</th>
                    <th class="border p-2">Menu</th>
                    <th class="border p-2 text-center w-16">Jumlah</th>
                    <th class="border p-2 text-center w-32">Status</th>
                    <th class="border p-2 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @forelse ($pesanans as $pesanan)
                    <!-- Baris Nama Pelanggan -->
                    <tr class="bg-gray-100 font-bold">
                        <td class="border p-2 text-center">{{ $no++ }}</td>
                        <td class="border p-2" colspan="5">{{ $pesanan->pelanggan }}</td>
                    </tr>

                    <!-- Daftar Menu Pesanan -->
                    @foreach ($pesanan->listPesanan as $item)
                        <tr>
                            <td class="border p-2 text-center"></td>
                            <td class="border p-2"></td>
                            <td class="border p-2">{{ $item->menu->nama_menu ?? 'Menu Tidak Ditemukan' }}</td>
                            <td class="border p-2 text-center">{{ $item->jumlah }}</td>
                            <td class="border p-2 text-center">
                                <span class="px-3 py-1 text-white rounded-lg text-sm font-semibold
                                    {{ $item->status == 'pending' ? 'bg-yellow-500' : '' }}
                                    {{ $item->status == 'dimasak' ? 'bg-blue-500' : '' }}
                                    {{ $item->status == 'selesai' ? 'bg-green-500' : '' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="border p-2 text-center">
                                <form action="{{ route('dapur.pesanan.updateStatus', $item->id_list_pesanan) }}" method="POST"
                                      onsubmit="return confirmUpdateStatus(event, this);">
                                    @csrf
                                    <select name="status" class="border p-1 rounded cursor-pointer bg-gray-100 text-sm font-medium"
                                            onchange="this.form.submit()">
                                        <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="dimasak" {{ $item->status == 'dimasak' ? 'selected' : '' }}>Dimasak</option>
                                        <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="6" class="text-center border p-4 text-gray-500">Belum ada pesanan masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>

<script>
    function confirmUpdateStatus(event, form) {
        let status = form.querySelector('select[name="status"]').value;
        let message = "";

        if (status === 'dimasak') {
            message = "Pesanan akan mulai dimasak. Lanjutkan?";
        } else if (status === 'selesai') {
            message = "Pesanan sudah selesai. Konfirmasi perubahan status?";
        }

        if (message && !confirm(message)) {
            event.preventDefault(); // Mencegah pengiriman form jika user membatalkan
        }
    }
</script>
@endsection
