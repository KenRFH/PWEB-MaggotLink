@extends('layout.master')

@section('title', 'Halaman')

@section('content')



@include('components.navbar-auth')

<section class="relative h-[85vh] bg-cover bg-center flex items-center justify-start" style="background-image: url('{{asset('assets/halaman2.png')}}');">
  <div class="absolute inset-0 bg-black opacity-30"></div> <!-- Overlay gelap -->

  <div class="relative z-10 p-10">
    <h1 class="text-white text-5xl font-semibold leading-snug mb-6">
      Menjadi Bagian<br>Perubahan Dunia
    </h1>
    <button class="bg-[#1c5c3e] hover:bg-[#14422e] text-white px-6 py-3 rounded-full text-lg">
      Kerja sama
    </button>
  </div>
</section>


@endsection

