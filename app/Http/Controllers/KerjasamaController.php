<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KerjasamaController extends Controller
{
    public function showForm()
    {
        return view('kerjasama');
    }
    public function adminForm()
    {
        return view('kerjasama');
    }

}
