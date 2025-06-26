@extends('layouts.landing')

@section('content')
<section id="menu" class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center text-red-600 mb-12">Menu Kami</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($menus as $menu)
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-300 overflow-hidden">
                    @if($menu->foto)
                        <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama_menu }}" class="w-full h-40 object-cover">
                    @else
                        <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                    @endif

                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800">{{ $menu->nama_menu }}</h3>
                        <p class="text-sm text-gray-500 mb-2">{{ $menu->kategori->kategori_menu ?? '-' }}</p>
                        <p class="text-red-600 font-semibold text-lg mb-2">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-700">{{ $menu->keterangan }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('landing.pesan') }}" class="inline-block bg-red-600 text-white px-6 py-3 rounded hover:bg-red-700 transition text-lg font-semibold shadow-md">
                Pesan Sekarang
            </a>
        </div>
    </div>
</section>
@endsection
