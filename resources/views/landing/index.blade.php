@extends('layouts.landing')

@section('content')

<!-- Hero Section -->
<section id="home" class="relative bg-cover bg-center h-screen flex items-center justify-center text-white" style="background-image: url('/images/kopkit-hero.jpg');">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="relative z-10 text-center px-6">
        <h1 class="text-4xl md:text-6xl font-bold mb-4">Selamat Datang di <span class="text-red-500">KopKit Padang</span></h1>
        <p class="text-lg md:text-2xl mb-6">Rasakan nikmatnya kopi & menu istimewa dalam suasana cozy ala KopKit</p>
        <div class="space-x-4">
            <a href="{{ route('landing.reservasi') }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-full transition">Reservasi Sekarang</a>
            <a href="{{ route('landing.pesan') }}" class="bg-transparent border-2 border-red-600 hover:bg-red-600 hover:text-white text-white font-semibold px-6 py-3 rounded-full transition">Pesan Sekarang</a>
        </div>
    </div>
</section>

<!-- Tentang Kami -->
<section id="about" class="py-16 bg-white">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Tentang KopKit Padang</h2>
        <p class="text-gray-600 text-lg leading-relaxed">
            KopKit Padang adalah tempat ngopi 24 jam dengan konsep cozy kerja dan nongkrong. Ditata modern minimalis dengan sentuhan kayu & lampu warm — sangat cocok untuk kumpul, kerja, atau hangout bareng teman.
        </p>
    </div>
</section>

<!-- Menu Unggulan -->
<section id="menu" class="py-16 bg-gray-100">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Menu Unggulan</h2>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($menus->take(6) as $menu)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition">
                    <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama_menu }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $menu->nama_menu }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($menu->keterangan, 80) }}</p>
                        <span class="text-red-600 font-bold">Rp {{ number_format($menu->harga,0,',','.') }}</span>
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
<section id="reservasi" class="py-20 bg-red-600 text-white text-center">
    <h2 class="text-3xl md:text-4xl font-bold mb-4">Pesan Tempat & Nikmati Kopi Kami</h2>
    <p class="text-lg mb-6">Booking sekarang, DP Rp50.000 via transfer. Unggah bukti pembayaran untuk reservasi.</p>
    <a href="{{ route('landing.reservasi') }}" class="bg-white text-red-600 font-semibold px-6 py-3 rounded-full hover:bg-gray-100 transition">Reservasi Sekarang</a>
</section>

<!-- Kontak -->
<section id="kontak" class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-800 text-center mb-10">Kontak & Lokasi</h2>
        <div class="grid md:grid-cols-2 gap-10 items-start">
            <!-- Kontak Info -->
            <div class="space-y-4 text-gray-700">
                <div class="flex items-start gap-4">
                    <div class="text-2xl text-red-600">📍</div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Alamat</h3>
                        <p>Jl. Veteran No.23, Padang, Sumatera Barat</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="text-2xl text-red-600">📞</div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Telepon</h3>
                        <p>0812-XXXX-XXXX</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="text-2xl text-red-600">⏰</div>
                    <div>
                        <h3 class="font-bold text-lg text-gray-900">Jam Operasional</h3>
                        <p>Buka setiap hari 24 jam</p>
                    </div>
                </div>
            </div>

            <!-- Google Maps Embed -->
            <div class="rounded overflow-hidden shadow-lg">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15945.889756674855!2d100.358!3d-0.9506!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b9295b53699b%3A0xd88e397adf90cfe4!2sKopKit%20Padang!5e0!3m2!1sen!2sid!4v1687422581234!5m2!1sen!2sid"
                    width="100%"
                    height="300"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>

@endsection
