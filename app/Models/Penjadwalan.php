<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjadwalan extends Model
{
    use HasFactory;

    protected $table = "penjadwalan";

    protected $fillable =[
        'total_berat',
        'supplier_id',
        'gambar',
        'jadwal_admins_id',
        'status',
    ];


   public function jadwalAdmins()
{
    return $this->belongsTo(JadwalAdmin::class);
}

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
