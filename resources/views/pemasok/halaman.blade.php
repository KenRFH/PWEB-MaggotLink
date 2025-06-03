@extends('layout.master')

@section('title', 'Halaman')

@section('content')



    @include('components.navbar-pemasok')

    <div
        class="flex flex-col lg:flex-row items-center justify-between bg-white p-8 rounded-xl shadow-md space-y-6 lg:space-y-0 lg:space-x-10">
        <!-- Gambar -->
        <div class="w-full lg:w-1/2">
            <img src="{{ asset('assets/halaman.jpg') }}" alt="Orang berdiskusi" class="rounded-lg object-cover w-full h-full">
        </div>

        <!-- Konten Teks -->
        <div class="w-full lg:w-1/2 text-center lg:text-left">
            <h2 class="text-3xl font-extrabold text-[#1D2B20] leading-tight mb-4">
                Ingin mengelola sampah dengan mudah?
            </h2>
            <p class="text-lg text-gray-700 mb-6">
                Ayo distribusikan sampahmu di Muggot.id
            </p>
            <a href="{{ route('kerjasama') }}"
                class="inline-block bg-[#2E5E4E] text-white font-semibold py-3 px-6 rounded-md shadow hover:bg-[#264E42] transition">
                Lihat Status Kerja sama →
            </a>
        </div>
    </div>
    <div class="bg-[#88A79A] py-16 px-4">
        <h2 class="text-2xl md:text-3xl font-bold text-center text-[#1D2B20] mb-12">
            Foto Distribusi Sampah
        </h2>

        <div class="flex flex-col md:flex-row justify-center items-center gap-8 max-w-6xl mx-auto">
            <!-- Gambar 1 -->
            <div class="bg-[#2E5E4E] p-4 rounded-lg">
                <img src="{{ asset('assets/halaman.jpg') }}" alt="Distribusi 1" class="rounded-md border-4 border-white">
            </div>

            <!-- Gambar 2 -->
            <div class="bg-[#2E5E4E] p-4 rounded-lg">
                <img src="{{ asset('assets/halaman.jpg') }}" alt="Distribusi 2" class="rounded-md border-4 border-white">
            </div>

            <!-- Gambar 3 -->
            <div class="bg-[#2E5E4E] p-4 rounded-lg">
                <img src="{{ asset('assets/halaman.jpg') }}" alt="Distribusi 3" class="rounded-md border-4 border-white">
            </div>
        </div>
    </div>
    <div class="flex flex-col md:flex-row items-center justify-between max-w-6xl mx-auto px-6 py-12">
        <!-- Konten teks -->
        <div class="md:w-1/2 mb-8 md:mb-0 text-center md:text-left">
            <h2 class="text-2xl md:text-3xl font-extrabold text-[#1D2B20] mb-3">
                Tanggulangi sampahmu!
            </h2>
            <p class="text-lg text-[#1D2B20] mb-6">
                dengan membuat jadwal penjemputan sampah sekarang!!
            </p>
            <a href="#"
                class="inline-block bg-[#2E5E4E] text-white font-bold px-6 py-3 rounded-md shadow hover:bg-[#264d40] transition">
                Buat Jadwal →
            </a>
        </div>

        <!-- Gambar -->
        <div class="md:w-1/2">
            <img src="{{asset('assets/halaman.jpg')}}" alt="Penjemputan Sampah" class="rounded-md w-full h-auto" />
        </div>
    </div>




    @include('components.footer')
@endsection
