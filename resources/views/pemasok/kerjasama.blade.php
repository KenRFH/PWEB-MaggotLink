@extends('layout.master')

@section('title', 'Form Kerja Sama')
@include('components.navbar-pemasok')

@section('content')

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

    <div class="p-6 max-w-xl mx-auto bg-white shadow-lg rounded-2xl">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Kerja Sama</h2>
            <a href="{{ asset('template/Mou_MaggotLink.pdf') }}" target="_blank"
                class="bg-black text-white px-4 py-2 rounded-lg flex items-center gap-2 border-2 border-transparent hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-purple-500">
                Download
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                </svg>
            </a>
        </div>

        <form action="{{ route('kerjasama.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold">Nama</label>
                <input type="text" name="nama" class="border p-2 rounded w-full" required>
            </div>

            <div>
                <label class="block font-semibold">Nama Perusahaan</label>
                <input type="text" name="name_company" class="border p-2 rounded w-full" required>
            </div>

            <div class="flex space-x-2">
                <div class="w-1/2">
                    <label class="block font-semibold">Alamat</label>
                    <input type="text" name="alamat" class="border p-2 rounded w-full" required>
                </div>
                <label for="district" class="block mb-1 font-medium">Kecamatan</label>
                <select name="kecamatan_id" id="district"
                    class="w-1/2 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                    required>
                    <option value="">Pilih Kecamatan</option>
                    @foreach ($kecamatanList as $kecamatan)
                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold">No. Telepon</label>
                <input type="text" name="no_telepon" class="border p-2 rounded w-full" required>
            </div>

            <div>
                <label class="block font-semibold">Unggah File MOU (PDF)</label>
                <input type="file" name="file_mou" accept="application/pdf" class="border p-2 rounded w-full" required>
            </div>

            <div>
                <label class="block font-semibold">Catatan (Opsional)</label>
                <textarea name="notes" class="border p-2 rounded w-full"></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">
                    Submit
                </button>
            </div>
        </form>
    </div>

    @include('components.footer')
@endsection
