<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // <== ini yang penting
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';

    protected $fillable = [
        'nama', 'email', 'password', 'address', 'gambar', 'phone_number'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function jadwalAdmin()
{
    return $this->hasMany(jadwalAdmin::class);
}

}


