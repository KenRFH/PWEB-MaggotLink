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
        'detail_alamat_id',
        'gambar',
        'jadwal_admins_id',
        'status',
    ];

    public function detailAlamat()
    {
        return $this->belongsTo(DetailAlamat::class);
    }

   public function jadwalAdmins()
{
    return $this->belongsTo(JadwalAdmin::class, 'jadwal_admins_id');
}

    public function supplier()
    {
        return $this->hasOneThrough(Supplier::class, DetailAlamat::class, 'id', 'id', 'detail_alamat_id', 'supplier_id');
    }
}
