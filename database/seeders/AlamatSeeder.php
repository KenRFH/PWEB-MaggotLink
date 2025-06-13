<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alamat;
use App\Models\Kecamatan;
use App\Models\Supplier;

class AlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecamatan = Kecamatan::get()->first();
        $supplier = Supplier::get()->first();

        Alamat::create([

            'supplier_id' => $supplier -> id,
            'kecamatan_id' => $kecamatan->id,
             'jalan' => 'Jl. Contoh No.123',
        ]);
    }
}
