<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KerjaSama extends Model
{
    use HasFactory;

    protected $table = 'kerja_sama';

    protected $fillable = [
        'supplier_id',
        'nama',
        'name_company',
        'alamat',
        'kecamatan_id',
        'no_telepon',
        'file_mou',
        'catatan',
        'status',
    ];

    // Relasi ke user (pemilik pengajuan)
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Relasi ke alamat (misal detail alamat seperti jalan, rt/rw, dll)


    // Relasi ke kecamatan
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}


