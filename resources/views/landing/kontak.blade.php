@extends('layouts.landing', ['title' => 'Kontak Kami'])

@section('content')
<section class="bg-gray-50 py-20 px-6 min-h-screen">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-4xl font-bold text-red-600 text-center mb-12">Hubungi KopKit Padang</h2>

        <div class="grid md:grid-cols-2 gap-12">
            <!-- Formulir Kontak -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h3 class="text-2xl font-semibold mb-6 text-gray-800">Kirim Pesan</h3>
                <form action="#" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block border p-3 rounded mb-1 font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama" required class="w-full border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                    </div>
                    <div class="mb-4">
                        <label class="block border p-3 rounded mb-1 font-medium text-gray-700">Email</label>
                        <input type="email" name="email" required class="w-full border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                    </div>
                    <div class="mb-4">
                        <label class="block border p-3 rounded mb-1 font-medium text-gray-700">Pesan</label>
                        <textarea name="pesan" rows="5" required class="w-full border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none"></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition">Kirim</button>
                    </div>
                </form>
            </div>

            <!-- Info Kontak -->
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h4 class="text-xl font-semibold text-red-600 mb-2">Alamat</h4>
                    <p class="text-gray-700">Jl. Veteran No.55, Belakang Tangsi, Kec. Padang Barat, Kota Padang, Sumatera Barat 25114</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h4 class="text-xl font-semibold text-red-600 mb-2">Jam Operasional</h4>
                    <ul class="text-gray-700">
                        <li>Senin - Jumat: 10.00 - 22.00</li>
                        <li>Sabtu - Minggu: 09.00 - 23.00</li>
                    </ul>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h4 class="text-xl font-semibold text-red-600 mb-2">Kontak</h4>
                    <p class="text-gray-700">📞 0812-3456-7890</p>
                    <p class="text-gray-700">✉️ kopkit.padang@gmail.com</p>
                </div>
            </div>
        </div>

        <!-- Google Maps -->
        <div class="mt-16">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63791.55682669048!2d100.34033283875258!3d-0.9492398114058591!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b8a0cd656f1b%3A0xa4c2d1e4f885d1e6!2sKopKit%20Padang!5e0!3m2!1sid!2sid!4v1719432613173!5m2!1sid!2sid"
                width="100%"
                height="350"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                class="rounded-xl shadow-lg"
            ></iframe>
        </div>
    </div>
</section>
@endsection
