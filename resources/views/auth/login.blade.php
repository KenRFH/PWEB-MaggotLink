<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body class="h-screen w-screen font-sans overflow-hidden bg-white">
    <div class="flex h-full">
        <div class="w-1/2 h-full bg-cover bg-center"
            style="background-image: url('{{ asset('assets/login4.jpg') }}'); filter: brightness(0.85);">
             <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center p-10">
                <p class="text-white text-xl md:text-2xl font-light leading-relaxed text-left">
                    “Bumi tidak mewarisi kita dari nenek moyang kita, kita meminjamnya dari anak cucu kita.”
                </p>
            </div>
        </div>


        <div class="w-1/2 flex items-center justify-center p-8 bg-white">
            <form method="POST" action="{{ route('postLogin') }}" class="w-full space-y-6 max-w-[90%]">
                @csrf

                <div>
                    <label for="email" class="block text-gray-700 text-sm mb-2">Email</label>
                    <div class="flex items-center border-b border-gray-400 py-2">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M16 12H8m8 0l-8 0m8 0v2a2 2 0 01-2 2H10a2 2 0 01-2-2v-2m12-6a9 9 0 11-18 0 9 9 0 0118 0z"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <input id="email" name="email" type="email" placeholder="Email" required
                            class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 focus:outline-none">
                    </div>
                </div>


                <div>
                    <label for="password" class="block text-gray-700 text-sm mb-2">Password</label>
                    <div class="flex items-center border-b border-gray-400 py-2">
                        <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 11c0-1.104.896-2 2-2s2 .896 2 2v1h-4v-1zM6 20h12a2 2 0 002-2V8a2 2 0 00-2-2h-1V5a4 4 0 00-8 0v1H6a2 2 0 00-2 2v10a2 2 0 002 2z"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <input id="password" name="password" type="password" placeholder="Password" required
                            class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 focus:outline-none">
                        <input type="checkbox" id="showPassword" class="ml-2">
                        <label for="showPassword" class="text-sm ml-1">Tampilkan</label>
                    </div>
                </div>


                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-[#1c3124] text-white px-6 py-2 rounded hover:bg-[#16271d] transition">
                        Sign in
                    </button>
                </div>


                <div class="text-sm text-gray-600 flex items-center justify-end gap-1">
                    <span>Belum punya akun?</span>
                    <a href="{{ route('showRegis') }}" class="text-[#1c3124] hover:underline flex items-center gap-1">
                        Register Sekarang
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>

            </form>

        </div>
    </div>
    <a href="{{ route('beranda') }}"
        class="absolute bottom-4 right-4 text-sm text-red-500  hover:bg-red-500 hover:text-white px-2 py-1 rounded-md duration-500 flex items-center gap-1">
        ← Kembali ke Beranda
    </a>



    <!-- Notifikasi -->
    @if (session('success'))
        <x-modal-error type="success" :message="session('success')" />
    @endif

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
