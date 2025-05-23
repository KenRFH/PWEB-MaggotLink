<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // <== ini yang penting
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin'; // nama tabel sesuai dengan database kamu

    protected $fillable = [
        'nama', 'email', 'password', 'address', 'profile_picture', 'phone_number'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
