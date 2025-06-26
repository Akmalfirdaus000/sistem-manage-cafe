@extends('layouts.landing')

@section('content')

<!-- Hero Section -->
<section class="relative bg-cover bg-center h-[80vh] flex items-center justify-center text-white" style="background-image: url('/images/kafe-hero.jpg');">
    <div class="bg-black bg-opacity-60 w-full h-full absolute inset-0"></div>
    <div class="relative z-10 text-center px-6">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">Selamat Datang di <span class="text-yellow-400">Cafe El-Jufa</span></h1>
        <p class="text-lg md:text-2xl mb-6">Nikmati pengalaman makan terbaik dengan suasana nyaman & menu lezat</p>
        <a href="{{ route('landing.reservasi') }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-semibold px-6 py-3 rounded-full transition">Reservasi Sekarang</a>
    </div>
</section>

<!-- Tentang Kami -->
<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Tentang Kami</h2>
        <p class="text-gray-600 text-lg leading-relaxed">
            Cafe El-Jufa menyajikan menu lokal dan internasional terbaik, dengan suasana hangat dan pelayanan ramah.
            Tempat ideal untuk hangout, kerja, atau kumpul keluarga.
        </p>
    </div>
</section>

<!-- Menu Unggulan -->
<section class="py-16 bg-gray-100">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Menu Unggulan Kami</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($menus->take(3) as $menu)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama_menu }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $menu->nama_menu }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($menu->keterangan, 100) }}</p>
                        <span class="text-red-600 font-bold">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('landing.menu') }}" class="text-red-600 font-semibold hover:underline">Lihat Semua Menu &rarr;</a>
        </div>
    </div>
</section>

<!-- CTA Reservasi -->
<section class="py-20 bg-red-600 text-white text-center">
    <h2 class="text-3xl md:text-4xl font-bold mb-4">Ingin Pesan Meja Sekarang?</h2>
    <p class="text-lg mb-6">Klik tombol di bawah untuk melakukan reservasi secara online</p>
    <a href="{{ route('landing.reservasi') }}" class="bg-white text-red-600 font-semibold px-6 py-3 rounded-full hover:bg-gray-100 transition">Reservasi Sekarang</a>
</section>

@endsection
