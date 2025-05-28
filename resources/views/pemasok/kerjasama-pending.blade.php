@extends('layout.master')

@section('title', 'Form Kerja Sama')
@include('components.navbar-pemasok')

@section('content')

<div class="text-center">
    <img src="{{ asset('images/menunggu.png') }}" alt="menunggu" class="mx-auto mb-4">
    <h2 class="text-lg font-semibold">Mohon menunggu konfirmasi dari admin untuk menyetujui pengajuan</h2>
    <p>Pengajuan Anda sedang dalam proses verifikasi.</p>
</div>
