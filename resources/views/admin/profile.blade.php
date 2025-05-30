@extends('layout.admin')

@section('title', 'Profile')
@include('components.navbar-admin')
@section('content')
    <div class="p-10 h-[700px]">

        <div class="bg-white p-6 rounded-lg shadow-md max-w-xl mx-auto ">
            <div class="flex items-center space-x-6">
                <img src="{{ $user->gambar ? asset($user->gambar) : 'https://via.placeholder.com/80' }}"
                    class="w-20 h-20 rounded-xl object-cover" />
                <div>
                    <h2 class="text-xl font-bold">{{ $user->nama ?? $user->name }}</h2>
                    <p class="text-sm text-gray-600">{{ $user->email }}</p>
                </div>
            </div>

            <div class="mt-6 space-y-2">
                <p><strong>Nama Admin:</strong> {{ $user->nama }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>

            <div class="mt-6 text-center">
                <button onclick="document.getElementById('editModal').classList.remove('hidden')"
                    class="bg-yellow-500 text-white px-4 py-2 rounded">
                    Ubah Profil
                </button>
            </div>
        </div>

        {{-- Modal Edit --}}
        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
            <div class="bg-white p-6 rounded-xl shadow-md w-full max-w-lg relative">
                <button onclick="document.getElementById('editModal').classList.add('hidden')"
                    class="absolute top-2 right-2 text-gray-500">✕</button>
                <h2 class="text-lg font-bold mb-4">Edit Profil</h2>

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-semibold">Nama</label>
                        <input type="text" name="nama" {{-- ← ganti dari name_company ke nama --}} value="{{ old('nama', $user->nama) }}"
                            class="border p-2 rounded w-full" />
                    </div>


                    <div>
                        <label class="block font-semibold">Password Baru</label>
                        <input type="password" name="password" class="border p-2 rounded w-full" />
                    </div>

                    <div>
                        <label class="block font-semibold">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="border p-2 rounded w-full" />
                    </div>

                    <div>
                        <label class="block font-semibold">Gambar Profil</label>
                        <input type="file" name="gambar" class="border p-2 rounded w-full" />
                    </div>

                    <div class="text-right">
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        @if ($errors->has('gambar'))
            <div class="text-red-600 mt-2">{{ $errors->first('gambar') }}</div>
        @endif

        <div class="text-center mt-8">
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="text-red-600">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>
@endsection
