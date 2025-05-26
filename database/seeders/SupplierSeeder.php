<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         echo "Seeder jalan!\n";
        DB::table('supplier')->insert([
            'email' => 'user@test',
            'password' => Hash::make('password123'), // enkripsi password
            'gambar' => '',
            'name_company' => 'Indofood',
            'phone_number' => '081234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
