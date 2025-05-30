@extends('layout.admin')

@section('title', 'Halaman')
@include('components.navbar-admin')
@section('content')

<section class="bg-slate-200">
    <div class="flex justify-center py-6">
        <h1 class="relative items-start text-3xl">Selamat Datang <br><span class="text-5xl">Admin</span></h1>
        <img src="{{asset('assets/larva.jpg')}}" alt="" class="w-1/3 items-end">
    </div>

</section>
