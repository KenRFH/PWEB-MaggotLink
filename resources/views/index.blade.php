@extends('layout.master')

@section('title', 'Index')

{{-- @section('no-navbar')
@endsection --}}


@section('content')

    <nav class="flex sticky items-center justify-between px-8 py-6 bg-[#172C1F] shadow-md top-0 left-0 right-0 transition-all duration-500 z-50">
        <div>
            <a href="{{ route('showLogin') }}" class="text-xl px-2 py-3 font-bold italic text-white">MaggotLink</a>
        </div>
        <div class="space-x-6 font-semibold">
            <a href="{{ route('showLogin') }}"
                class="text-white px-4 py-1 hover:bg-white hover:text-green-700 hover:font-bold duration-500 rounded-lg">Login</a>
            <a href="{{ route('showRegis') }}"
                class="text-white px-4 py-1 hover:bg-white hover:text-green-700 hover:font-bold duration-500 rounded-lg">Daftar</a>
        </div>
    </nav>

    <section class="relative overflow-hidden py-12 md:py-20">
        <video autoplay muted loop playsinline class="absolute top-0 left-0 w-full h-full object-cover z-0 opacity-100">
            <source src="{{ asset('assets/index_bg.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between px-4 md:px-8">
            <div class="max-w-xl space-y-4 text-center md:text-left">
                <h1 class="text-3xl md:text-4xl font-bold text-white shadow-2xl">Menjadi Bagian <br><span
                        class="text-lime-500">Perubahan Dunia</span></h1>
                <p class="text-sm md:text-base text-white italic">“Menyenangkan bila tempat tinggal yang kita huni hari
                    ini masih terjaga dengan baik hingga anak, cucu, dan generasi penerus kita.”</p>
                <div class="flex justify-center md:justify-start">
                    <a href="{{ route('showLogin') }}"
                        class="bg-green-900 text-white px-5 py-2 rounded hover:bg-amber-500 duration-500 hover:font-bold inline-block text-sm md:text-base">Gabung
                        Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16 px-4 md:px-16">
        <!-- Judul & Gambar Atas -->
        <div class="grid md:grid-cols-2 gap-8 items-start mb-16">
            <!-- Teks -->
            <div>
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Maggot</h2>
                <h3 class="text-2xl font-bold text-green-900 mb-4">PT. SARANA UTAMA WELLTRASH</h3>
                <p class="text-gray-700 leading-relaxed">
                    Bayangkan jika sampah organik dari usaha Anda tidak lagi menjadi beban lingkungan,
                    tetapi justru menjadi sumber kehidupan baru—bagi maggot dan juga bumi. Melalui fitur
                    "Bank Sampah", kami menghadirkan solusi cerdas, praktis, dan berdampak bagi pelaku
                    usaha yang ingin berkontribusi langsung dalam pengelolaan sampah organik yang
                    berkelanjutan.
                </p>
            </div>
            <!-- Gambar Atas -->
            <div>
                <img src="{{ asset('assets/gambar1.jpeg') }}" alt="Peternakan Maggot"
                    class="rounded-xl w-full object-cover shadow-xl" />
            </div>
        </div>

        <!-- Tautan Galeri -->
        <div class="bg-[#2B4636] p-6 rounded-2xl">
            <h4 class="text-white text-3xl text-center font-semibold mb-4">Tautan</h4>
            <div class="grid grid-cols-2 py-4 gap-4">
                <!-- Gambar Galeri -->
                <img src="{{ asset('assets/larva.jpg') }}" alt="Peternakan Maggot"
                    class="rounded-xl w-full h-auto object-cover" />
                <img src="{{ asset('assets/larva.jpg') }}" alt="Maggot di tangan"
                    class="rounded-xl w-full h-auto object-cover" />
                <img src="{{ asset('assets/larva.jpg') }}" alt="Peternakan Maggot"
                    class="rounded-xl w-full h-auto object-cover" />
                <img src="{{ asset('assets/larva.jpg') }}" alt="Maggot di tangan"
                    class="rounded-xl w-full h-auto object-cover" />
            </div>
        </div>
    </section>


@endsection

{{-- @section('components.footer')

@endsection --}}
