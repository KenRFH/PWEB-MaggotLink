<?php

namespace Database\Seeders;

use App\Models\Alamat;
use App\Models\DetailAlamat;
use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailAlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $supplier = Supplier::first();
        $alamat = Alamat::first();

        if ($supplier && $alamat) {
            DetailAlamat::create([
                'supplier_id' => $supplier->id,
                'alamat_id' => $alamat->id,
            ]);
    }
}
}
