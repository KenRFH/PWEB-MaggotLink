@extends('layout.master')

@section('content')
<h2 class="text-xl font-bold mb-4">Daftar Pengajuan Kerjasama</h2>

<table class="table-auto w-full border">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Perusahaan</th>
            <th>Kecamatan</th>
            <th>Status</th>
            <th>File MOU</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pengajuanList as $pengajuan)
        <tr class="border-t">
            <td>{{ $pengajuan->nama }}</td>
            <td>{{ $pengajuan->name_company }}</td>
            <td>{{ $pengajuan->kecamatan->nama ?? '-' }}</td>
            <td>
                @if ($pengajuan->status == 'pending')
                    <span class="text-yellow-600">Pending</span>
                @elseif ($pengajuan->status == 'approved')
                    <span class="text-green-600">Disetujui</span>
                @else
                    <span class="text-red-600">Ditolak</span>
                @endif
            </td>
            <td><a href="{{ asset('storage/' . $pengajuan->file_mou) }}" class="text-blue-500" target="_blank">Lihat PDF</a></td>
            <td>
                @if ($pengajuan->status == 'pending')
                <form action="{{ route('admin.kerjasama.approve', $pengajuan->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-green-600">Setujui</button>
                </form>

                <form action="{{ route('admin.kerjasama.reject', $pengajuan->id) }}" method="POST" class="inline ml-2">
                    @csrf
                    <button type="submit" class="text-red-600">Tolak</button>
                </form>
                @else
                    <span class="text-gray-400 italic">Sudah diproses</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
