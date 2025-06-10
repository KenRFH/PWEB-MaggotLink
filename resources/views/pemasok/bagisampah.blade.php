@extends('layout.master')

@section('content')
    @include('components.navbar-pemasok')

    <div class="flex min-h-screen">
        <main class="flex-1 p-6 md:p-10 bg-cover bg-center"
            style=" background-image: url('{{ asset('assets/bagi-sampah.png') }}');">
            <div class="flex flex-col lg:flex-row gap-6">
                {{-- Kiri: daftar penjadwalan --}}
                <div class="flex-1 space-y-4">
                    <h2 class="text-lg font-bold mt-4">Pengajuan Jadwal Anda</h2>
                    @if ($penjadwalanSaya->isEmpty())
                        <p>Belum ada pengajuan penjemputan sampah.</p>
                    @else
                        @foreach ($penjadwalanSaya as $penjadwalan)
                            <div class="bg-white p-4 rounded shadow mb-3">
                                <p><strong>Tanggal Penjemputan:</strong>
                                    {{ \Carbon\Carbon::parse($penjadwalan->jadwalAdmin->tanggal)->format('d M Y') }}</p>
                                <p><strong>Total Berat:</strong> {{ number_format($penjadwalan->total_berat, 2) }} kg</p>
                                @if ($penjadwalan->gambar)
                                    <p><strong>Gambar:</strong></p>
                                    <img src="{{ asset('storage/' . $penjadwalan->gambar) }}" alt="Gambar Sampah"
                                        class="w-32 mt-2">
                                @endif

                            </div>
                        @endforeach
                    @endif

                </div>

                {{-- Kanan: form ajukan sampah baru --}}
                <div class="w-full lg:w-1/3 bg-white p-6 rounded-xl shadow-2xl space-y-4">
                    <h3 class="text-lg font-semibold text-center text-black">Ajukan Sampah Baru</h3>

                    <form action="{{ route('bagisampah.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <select name="jadwal_admins_id" class="mt-1 w-full border rounded-lg p-2">
                                @foreach ($jadwalAdminList as $jadwal)
                                    <option value="{{ $jadwal->id }}">{{ $jadwal->tanggal }}</option>
                                @endforeach
                            </select>
                        </div>

                        <p><strong>Alamat:</strong> {{ $user->detailAlamat->alamat ?? 'Alamat tidak tersedia' }}</p>


                        <div>
                            <label class="block text-sm font-medium text-gray-700">Total Berat (,00 kg)</label>
                            <input type="number" name="total_berat" id="total_berat" min="0.01" max="100"
                                step="0.01" class="mt-1 w-full border rounded-lg p-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Gambar Sampah</label>
                            <!-- Tombol trigger modal -->
                            <button type="button" onclick="toggleModal(true)"
                                class="mt-1 w-full min-h-[200px] bg-gray-100 flex justify-center items-center gap-3 rounded-lg p-2 hover:bg-gray-200 text-left">
                                Ambil Gambar<i data-feather="camera"></i>
                            </button>

                            <!-- Input hidden untuk simpan base64 -->
                            <input type="hidden" name="gambar" class="image-tag">

                            <!-- Preview gambar -->
                            <div id="preview-container" class="mt-2"></div>
                        </div>

                        <button type="submit"
                            class="w-full bg-amber-500 text-white py-2 rounded-lg hover:bg-lime-500 hover:font-bold font-semibold duration-500">
                            Kirim Pengajuan
                        </button>
                        @if ($errors->any())
                            <div class="text-red-500 mb-4">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                    </form>

                </div>
            </div>
        </main>
    </div>
    @include('components.modal-cam')

    <script>
        feather.replace();
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

    <script>
        function toggleModal(show) {
            const modal = document.getElementById('webcamModal');
            modal.classList.toggle('hidden', !show);

            if (show) {
                Webcam.set({
                    width: 480,
                    height: 320,
                    image_format: 'jpeg',
                    jpeg_quality: 90
                });
                Webcam.attach('#my_camera');
            } else {
                Webcam.reset();
            }
        }

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                document.querySelector('.image-tag').value = data_uri;
                document.getElementById('results').innerHTML = '<img src="' + data_uri +
                    '" class="mx-auto rounded" />';
                document.getElementById('preview-container').innerHTML = '<img src="' + data_uri +
                    '" class="w-32 h-32 object-cover rounded mt-2" />';
                toggleModal(false);
            });
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const beratInput = document.getElementById('total_berat');
            const metodeSelect = document.getElementById('metode_pengambilan_id');

            beratInput.addEventListener('input', function() {
                const berat = parseFloat(this.value) || 0;

                // Tampilkan semua opsi dulu
                Array.from(metodeSelect.options).forEach(option => {
                    option.hidden = false;
                });

                if (berat < 5) {
                    Array.from(metodeSelect.options).forEach(option => {
                        if (option.dataset.metode === 'diambil') {
                            option.hidden = true;

                            // Jika opsi yang tersembunyi sedang dipilih, ganti ke yang lain
                            if (metodeSelect.value == option.value) {
                                metodeSelect.selectedIndex = 0;
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
