<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalAdmin extends Model
{
    use HasFactory;
    protected $table = "jadwal_admins";

    protected $fillable =[
        'tanggal',
    ];

    public function penjadwalan()
    {
        return $this->hasMany(Penjadwalan::class);
    }

}
