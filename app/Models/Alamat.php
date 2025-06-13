<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;
    protected $table = "alamat";

    protected $fillable =[
        'supplier_id',
        'jalan',
        'kecamatan_id',

    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }



    // App\Models\Alamat.php



}
