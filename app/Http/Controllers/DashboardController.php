<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDash()
    {
        return view('admin.dashboard');
    }
}
