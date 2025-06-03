@extends('layout.master')

@section('title', 'Form Kerja Sama')
@include('components.navbar-pemasok')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-400/60">
  <div class="bg-white rounded-2xl shadow-md p-10 text-center w-full max-w-md">
    <div class="flex justify-center mb-6">
      <div class="bg-red-500 p-4 rounded-full text-white ">
        X
      </div>
    </div>
    <h2 class="text-lg font-semibold text-gray-800 mb-2">
      Pengajuan ditolak
    </h2>
    <p class="text-sm text-gray-600">
      Mohon bersabar, pengajuan anda sedang dalam proses verivikasi
    </p>
  </div>
</div>

@include('components.footer')
@endsection

