@extends('layout.admin')

@section('title', 'Halaman')
@include('components.navbar-admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>

    <div class="grid grid-cols-3 gap-4">
        <div class="bg-green-100 p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Kerjasama Disetujui</h2>
            <p class="text-3xl">{{ $jumlahApproved }}</p>
        </div>

        <div class="bg-yellow-100 p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Kerjasama Pending</h2>
            <p class="text-3xl">{{ $jumlahPending }}</p>
        </div>

        <div class="bg-blue-100 p-4 rounded shadow">
            <h2 class="text-lg font-semibold">Total Berat Sampah</h2>
            <p class="text-3xl">{{ $totalBerat }} kg</p>
        </div>
    </div>
</div>

<div class="p-6">
    <h2 class="text-xl font-bold mb-2">Grafik Berat Sampah per Tanggal</h2>
    <canvas id="chartBerat" class="w-full h-64"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = {!! json_encode($beratPerTanggal->pluck('tanggal')) !!};
    const data = {!! json_encode($beratPerTanggal->pluck('total_kg')->map(fn($v) => (float) $v)) !!};

    const ctx = document.getElementById('chartBerat').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Berat (kg)',
                data: data,
                backgroundColor: '#4ade80'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'kg'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tanggal Jadwal'
                    }
                }
            }
        }
    });
</script>
@endsection
