<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alamat;
use App\Models\Kecamatan;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatan = Kecamatan::get()->first();
        // $detail_alamat = DetailAlamat::get()->first();

        Alamat::create([

            'kecamatan_id' => $kecamatan->id,
             'jalan' => 'Jl. Contoh No.123',
        ]);
    }
}
