@extends('layout.master')

@section('title', 'Form Kerja Sama')
@include('components.navbar-pemasok')

@section('content')



<div class="min-h-screen flex items-center justify-center bg-gray-400/60">
  <div class="bg-white rounded-2xl shadow-md p-10 text-center w-full max-w-md">
    <div class="flex justify-center mb-6">
      <div class="bg-green-400 p-4 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
        </svg>
      </div>
    </div>
    <h2 class="text-lg font-semibold text-gray-800 mb-2">Selamat! Pengajuan kerja sama anda telah disetujui</h2>
    <p class="text-sm text-gray-600 mb-6">Selanjutnya, anda akan menampilkan halaman pemasok</p>
    <button class="bg-black text-white py-2 px-5 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 transition">
      Lanjutkan
    </button>
  </div>
</div>

@include('components.footer')
@endsection
