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
        'file_mou',
        'catatan',
        'status',
    ];

    
    public function supplier()
{
    return $this->belongsTo(Supplier::class);
}



public function alamat()
{
    return $this->belongsTo(Alamat::class);
}

}


