<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Supplier extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = "supplier";
    protected $fillable =[
        "email",
        "password",
        "name_company",
        "phone_number",
        "gambar",
    ];

    public function detailAlamat(){
        return $this->hasMany(DetailAlamat::class);
    }
}


