<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BagiSampahController extends Controller
{
    public function showForm()
    {
        return view('bagi_sampah');
    }
    public function adminForm()
    {
        return view('bagi_sampah');
    }

}
