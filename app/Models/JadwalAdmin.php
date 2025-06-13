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
        'admin_id',
    ];

    public function penjadwalan()
    {
        return $this->hasMany(Penjadwalan::class);
    }

    public function jadwalAdmin()
    {
        return $this->belongsTo(jadwalAdmin::class);
    }

}
