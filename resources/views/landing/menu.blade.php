@extends('layouts.landing')

@section('content')
<section id="menu" class="py-20 bg-gradient-to-b from-white to-gray-100">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-red-600 tracking-tight mb-2">Menu KopKit Padang</h2>
            <p class="text-gray-600 text-lg">Pilih menu favoritmu dan nikmati langsung di tempat atau pesan online!</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($menus as $menu)
                <div class="bg-white rounded-xl shadow hover:shadow-2xl transition duration-300 transform hover:-translate-y-1 overflow-hidden">
                    @if($menu->foto)
                        <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama_menu }}" class="w-full h-44 object-cover">
                    @else
                        <div class="w-full h-44 bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                    @endif

                    <div class="p-5">
                        <h3 class="text-xl font-semibold text-gray-800 mb-1">{{ $menu->nama_menu }}</h3>
                        <p class="text-sm text-gray-500 mb-2">{{ $menu->kategori->kategori_menu ?? '-' }}</p>
                        <p class="text-red-600 font-bold text-lg mb-3">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">{{ $menu->keterangan }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    Belum ada menu yang tersedia saat ini.
                </div>
            @endforelse
        </div>

        <div class="mt-14 text-center">
            <a href="{{ route('landing.pesan') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-full text-lg font-semibold shadow-lg transition">
                Pesan Sekarang
            </a>
        </div>
    </div>
</section>
@endsection
