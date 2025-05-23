<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup_schedule extends Model
{
    use HasFactory;
    protected $table = "Pickup_schedule";
    protected $fillable =[
        "date",
        "address",
        "application_status",
        "notes",
    ];
}
