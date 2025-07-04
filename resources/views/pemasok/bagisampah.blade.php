@extends('layout.master')

@section('content')
    @include('components.navbar-pemasok')

    <div class="bg-[#183B4E] flex min-h-screen">
        <main class="flex-1 p-6 md:p-10 bg-cover bg-center"
            style="background-image: url('{{ asset('assets/bagi-sampah.png') }}');">
            <div class="flex flex-col lg:flex-row gap-6">
                {{-- Kiri: daftar penjadwalan --}}
                <div class="flex-1 space-y-4">
                    <h2 class="text-4xl mt-2 font-semibold text-white text-center">Pengajuan Jadwal</h2>
                    @if ($penjadwalanSaya->isEmpty())
                        <p>Belum ada pengajuan penjemputan sampah.</p>
                    @else
                        @foreach ($penjadwalanSaya as $penjadwalan)
                            <div class="bg-white p-4 rounded-md shadow-lg mb-3">
                                <p><strong>Tanggal Penjemputan:</strong>
                                    {{ \Carbon\Carbon::parse($penjadwalan->jadwalAdmins->tanggal)->format('d M Y') }}</p>
                                <p><strong>Total Berat:</strong> {{ number_format($penjadwalan->total_berat, 2) }} kg</p>
                                <p><strong>Alamat:</strong>
                                    {{ $penjadwalan->supplier->alamat->jalan ?? 'Belum ada alamat' }}</p>
                                @if ($penjadwalan->gambar)
                                    <p><strong>Gambar:</strong></p>
                                    <img src="{{ asset('storage/' . $penjadwalan->gambar) }}" alt="Gambar Sampah"
                                        class="w-32 mt-2">
                                @endif
                                <div class="flex justify-end px-4">
                                    @if ($penjadwalan->status == 'diproses')
                                        <span
                                            class="bg-lime-500 px-2 py-2 rounded-lg text-white font-semibold">Diproses</span>
                                    @else
                                        <span class="bg-amber-600 text-white p-2 rounded-md font-semibold">Pending</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        {{ $penjadwalanSaya->links('components.pagination') }}
                    @endif
                </div>

                {{-- Form pengajuan --}}
                <div class="w-full lg:w-1/3 bg-white p-6 rounded-xl shadow-2xl space-y-4 max-h-[700px] overflow-y-auto">
                    <h3 class="text-lg font-semibold text-center text-black">Ajukan Sampah Baru</h3>

                    <form id="pengajuanForm" action="{{ route('bagisampah.store') }}" method="POST"
                        enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        {{-- Alamat --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat Anda</label>
                            <div class="mt-1 w-full border rounded-lg p-2 bg-gray-100">
                                {{ $alamat->jalan ?? 'Belum ada alamat' }}
                            </div>
                        </div>

                        {{-- Pilih Tanggal --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <select name="jadwal_admins_id" class="mt-1 w-full border rounded-lg p-2">
                                <option value="">-- Pilih Jadwal --</option>
                                @foreach ($jadwalAdminList as $jadwal)
                                    <option value="{{ $jadwal->id }}">{{ $jadwal->tanggal }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Berat --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Total Berat (,00 kg)</label>
                            <input type="number" name="total_berat" id="total_berat" min="0.01" max="100"
                                step="0.01" class="mt-1 w-full border rounded-lg p-2">
                        </div>

                        {{-- Gambar --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Gambar Sampah</label>
                            <button type="button" onclick="toggleModal(true)"
                                class="mt-1 w-full h-[150px] bg-gray-100 flex justify-center items-center gap-3 rounded-lg p-2 hover:bg-gray-200 text-left">
                                Ambil Gambar <i data-feather="camera"></i>
                            </button>

                            <input type="hidden" name="gambar" class="image-tag">
                            <div id="preview-container" class="mt-2"></div>
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                            class="w-full bg-lime-300 text-white py-2 rounded-lg hover:bg-lime-500 hover:font-bold font-semibold duration-500">
                            Kirim Pengajuan
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    @if (session('success'))
        <x-modal-notifikasi type="success" :message="session('success')" />
    @endif

    @include('components.modal-cam')

    {{-- Webcam setup --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script>
        feather.replace();

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
                document.getElementById('results').innerHTML =
                    '<img src="' + data_uri + '" class="mx-auto rounded" />';
                document.getElementById('preview-container').innerHTML =
                    '<img src="' + data_uri + '" class="w-32 h-32 object-cover rounded mt-2" />';
                toggleModal(false);
            });
        }

        // Validasi sebelum kirim
        document.getElementById('pengajuanForm').addEventListener('submit', function(e) {
            const berat = document.getElementById('total_berat').value.trim();
            const gambar = document.querySelector('.image-tag').value.trim();
            const jadwal = document.querySelector('select[name="jadwal_admins_id"]').value;

            let errors = [];

            if (!jadwal) {
                errors.push("Silakan pilih tanggal jadwal terlebih dahulu.");
            }

            if (!berat || parseFloat(berat) <= 0) {
                errors.push("Silakan masukkan berat sampah yang valid (minimal 0.01 kg).");
            }

            if (!gambar) {
                errors.push("Silakan ambil gambar sampah terlebih dahulu.");
            }

            if (errors.length > 0) {
                e.preventDefault();
                alert(errors.join("\n"));
            }
        });
    </script>
@endsection
