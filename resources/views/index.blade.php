@extends('layout.master')

@section('title', 'Index')

{{-- @section('no-navbar')
@endsection --}}


@section('content')

    <nav
        class="flex sticky items-center justify-between px-8 py-6 bg-[#172C1F] shadow-md top-0 left-0 right-0 transition-all duration-500 z-50">
        <div>
            <a href="{{ route ('showLogin') }}" class="text-xl px-2 py-3 font-bold italic text-white">MaggotLink</a>
        </div>
        <div class="space-x-6 font-semibold sm:gap-1">
            <a href="{{ route('showLogin') }}"
                class="text-white px-4 py-1 hover:bg-white hover:text-green-700 hover:font-bold duration-500 rounded-lg">Login</a>
            <a href="{{ route('showRegis') }}"
                class="text-white px-4 py-1 hover:bg-white hover:text-green-700 hover:font-bold duration-500 rounded-lg">Daftar</a>
        </div>
    </nav>

    <section class="bg-white py-16 px-4 md:px-16">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-10">

            <!-- Gambar -->
            <div class="w-full md:w-1/2">
                <img src="{{ asset('assets/indexx.png') }}" alt="Anak Tanam Pohon" class="w-full h-auto">
            </div>

            <!-- Konten teks -->
            <div class="w-full md:w-1/2 space-y-4">
                <h2 class="text-3xl font-bold text-[#345C4A]">Menghidupkan Kembali Lingkungan</h2>
                <p class="text-[#345C4A] text-lg">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum, velit.
                </p>
                <a href="{{ route('showRegis') }}"
                    class="inline-block px-6 py-3 bg-[#345C4A] text-white rounded-lg hover:bg-[#2b4d3d] transition">Coba Daftar</a>
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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
            <!-- Card 1 -->
            <div class="bg-[#88A097] p-6 rounded-2xl text-center">
                <h2 class="text-xl font-bold text-black mb-2">Pemeliharaan Maggot</h2>
                <p class="text-black mb-4">Apa kalian tau cara memelihara Maggot dengan benar?</p>
                <div class="w-full aspect-video">
                    <iframe class="w-full h-full rounded-xl"
                        src="https://www.youtube.com/embed/FPALstZU7fI?si=o6cG_HAKx2MEtdq4" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" title="Video 1" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-[#88A097] p-6 rounded-2xl text-center">
                <h2 class="text-xl font-bold text-black mb-2">Pemeliharaan Maggot</h2>
                <p class="text-black mb-4">Apa kalian tau cara memelihara Maggot dengan benar?</p>
                <div class="w-full aspect-video">
                    <iframe class="w-full h-full rounded-xl"
                        src="https://www.youtube.com/embed/FPALstZU7fI?si=o6cG_HAKx2MEtdq4" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" title="Video 2" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-[#88A097] p-6 rounded-2xl text-center">
                <h2 class="text-xl font-bold text-black mb-2">Pemeliharaan Maggot</h2>
                <p class="text-black mb-4">Apa kalian tau cara memelihara Maggot dengan benar?</p>
                <div class="w-full aspect-video">
                    <iframe class="w-full h-full rounded-xl"
                        src="https://www.youtube.com/embed/FPALstZU7fI?si=o6cG_HAKx2MEtdq4" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin " title="Video 3" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>

        </div>

    </section>
    @include('components.footer')

@endsection

{{-- @section('components.footer')

@endsection --}}
