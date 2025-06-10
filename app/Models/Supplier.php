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
        "nama",
        "phone_number",
        "gambar",
        "alamat",
    ];

    public function detailAlamat(){
        return $this->hasOne(DetailAlamat::class);
    }

    public function kerjasama()
{
    return $this->hasMany(Kerjasama::class);
}

}


