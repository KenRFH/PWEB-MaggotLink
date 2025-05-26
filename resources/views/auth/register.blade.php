<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-[#2d3a2e] h-screen w-screen m-0 p-0 overflow-hidden font-sans">
    <div class="flex h-full w-full">

        <!-- Kiri: Gambar dan Kutipan -->
        <div class="w-1/2 relative bg-cover bg-center"
            style="background-image: url('https://source.unsplash.com/featured/?larva,insects');">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center p-10">
                <p class="text-white text-xl md:text-2xl font-light leading-relaxed text-left">
                    “Bumi tidak mewarisi kita dari nenek moyang kita, kita meminjamnya dari anak cucu kita.”
                </p>
            </div>
        </div>

        <!-- Kanan: Formulir -->
        <div class="w-1/2 bg-[#2d3a2e] flex items-center justify-center">
            <form method="POST" action="{{ route('register.register') }}"
                class="bg-white w-full max-w-md p-10 rounded-2xl space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label class="text-sm font-light text-gray-700 mb-1 block">Email</label>
                    <input type="email" name="email" placeholder="Masukkan Email"
                        class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <!-- Password -->
                <div>
                    <label class="text-sm font-light text-gray-700 mb-1 block">Password</label>
                    <input type="password" name="password" placeholder="Masukkan Password"
                        class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <!-- Nomor Telepon -->
                <div>
                    <label class="text-sm font-light text-gray-700 mb-1 block">Nomor Telepon</label>
                    <input type="text" name="phone_number" placeholder="Masukkan Nomor Telepon"
                        class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <!-- Nama Perusahaan -->
                {{-- <div>
          <label class="text-sm font-light text-gray-700 mb-1 block">Nama Perusahaan</label>
          <input type="text" name="name_company" placeholder="Masukkan Nama Perusahaan"
                 class="w-full p-2 border border-gray-300 rounded" required>
        </div> --}}

                <!-- Alamat -->
                <div>
                    <label class="text-sm font-light text-gray-700 mb-1 block">Alamat</label>
                    <textarea name="alamat" placeholder="Masukkan Alamat" class="w-full p-2 border border-gray-300 rounded" required></textarea>
                </div>
                <div class="mt-6"> {{-- Adjusted margin for better spacing --}}
                    <label for="district" class="block mb-2 font-semibold">Kecamatan</label>
                    <select name="kecamatan_id" id="district"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-chartreuse"
                        required>
                        <option value="">Pilih Kecamatan</option>
                        @foreach ($kecamatans as $kecamatan)
                            <option value="{{ $kecamatan->id }}"
                                {{ old('kecamatan') == $kecamatan->id ? 'selected' : '' }}>{{ $kecamatan->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Registrasi -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-[#2d3a2e] text-white px-6 py-2 rounded hover:bg-[#1f291f] transition">
                        Registrasi
                    </button>
                </div>

                <!-- Teks Sudah Punya Akun di bawah tombol -->
                <div class="text-center mt-4">
                    <a href="{{ route('showLogin') }}" class="text-gray-600 text-sm hover:underline">Sudah punya
                        akun?</a>
                </div>

            </form>
        </div>

    </div>
</body>

</html>
