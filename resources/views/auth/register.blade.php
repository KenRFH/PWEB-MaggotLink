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

                <div>
                    <label class="text-sm font-light text-gray-700 mb-1 block">Nama </label>
                    <input type="text" name="nama" placeholder="Masukkan Nama Perusahaan"
                        class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <!-- Email -->
                <div>
                    <label class="text-sm font-light text-gray-700 mb-1 block">Email</label>
                    <input type="email" name="email" placeholder="Masukkan Email"
                        class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <!-- Password -->
                <div>
                    <label class="text-sm font-light text-gray-700 mb-1 block">Password</label>
                    <input id="password" type="password" name="password" placeholder="Masukkan Password"
                        class="w-full p-2 border border-gray-300 rounded" required>
                </div>
                <input type="checkbox" id="showPassword" class="mr-2">
                <label for="showPassword" class="text-sm">Tampilkan kata sandi</label>

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

     @if (session('success'))
        <x-modal-error type="success" :message="session('success')" />
    @endif

    {{-- Notifikasi Gagal --}}
    @if (session('error'))
        <x-modal-error type="error" :message="session('error')" />
    @endif
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showPasswordCheckbox = document.getElementById('showPassword');
            const passwordInput = document.getElementById('password');

            showPasswordCheckbox.addEventListener('change', function() {
                passwordInput.type = this.checked ? 'text' : 'password';
            });
        });
    </script>
</body>

</html>
