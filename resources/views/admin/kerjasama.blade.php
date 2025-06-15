@extends('layout.admin')
@section('title', 'Kerjasama')
@include('components.navbar-admin')
@section('content')

<h2 class="text-xl font-bold mt-10 text-center">Daftar Pengajuan Kerjasama</h2>

<table id="kerjasama-table" class="table table-striped table-hover table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Perusahaan</th>
            <th>Alamat</th> {{-- diganti dari Kecamatan --}}
            <th>Status</th>
            <th>File MOU</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

{{-- Tambahkan CDN DataTables --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#kerjasama-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.kerjasama.data') }}',
            columns: [
                { data: 'nama', name: 'supplier.nama' },
                { data: 'nama_perusahaan', name: 'supplier.nama_perusahaan' },
                { data: 'alamat', name: 'alamat.jalan', defaultContent: '-' }, // diganti dari kecamatan
                { data: 'status', name: 'kerja_sama.status' },
                { data: 'file_mou_link', orderable: false, searchable: false },
                { data: 'aksi', orderable: false, searchable: false }
            ]
        });
    });
</script>

@endsection
