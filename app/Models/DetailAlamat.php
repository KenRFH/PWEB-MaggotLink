<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAlamat extends Model
{
    use HasFactory;
    protected $table = "detail_alamat";

    protected $fillable =[
        'alamat_id',
        'supplier_id'
    ];

    public function alamat()
    {
        return $this->belongsTo(Alamat::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function penjadwalan()
    {
        return $this->hasMany(Penjadwalan::class);
    }
}
