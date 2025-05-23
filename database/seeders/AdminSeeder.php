<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         echo "Seeder jalan!\n";
        DB::table('admin')->insert([
            'nama' => 'Admin Utama',
            'email' => 'admin@test',
            'password' => Hash::make('password123'), // enkripsi password
            'address' => 'Jl. Contoh No. 123',
            'profile_picture' => '',
            'phone_number' => '081234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
