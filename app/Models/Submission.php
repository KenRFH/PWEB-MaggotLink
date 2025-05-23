<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    protected $table = "Submission";
    protected $fillable =[
        "submission_date",
        "application_status",
        "notes",
    ];
}
