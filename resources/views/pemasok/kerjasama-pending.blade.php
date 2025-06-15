@extends('layout.master')

@section('title', 'Form Kerja Sama')
@include('components.navbar-pemasok')

@section('content')

    @if ($errors->has('error'))
        <x-modal-notifikasi :message="$error->first('error')" type="error" />
    @endif


<div class="min-h-screen flex items-center justify-center bg-gray-400/60">
  <div class="bg-white rounded-2xl shadow-md p-10 text-center w-full max-w-md">
    <div class="flex justify-center mb-6">
      <div class="bg-yellow-400 p-4 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 8v5l3 3m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
    </div>
    <h2 class="text-lg font-semibold text-gray-800 mb-2">
      Mohon menunggu konfirmasi dari admin untuk menyetujui pengajuan
    </h2>
    <p class="text-sm text-gray-600">
      Mohon bersabar, pengajuan anda sedang dalam proses verivikasi
    </p>
  </div>
</div>
@include('components.footer')
@endsection
