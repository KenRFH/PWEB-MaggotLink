<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kerjasama;
use App\Models\Penjadwalan;
use App\Models\JadwalAdmin;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function showDash()
    {
        $jumlahApproved = Kerjasama::where('status', 'approved')->count();
        $jumlahPending = Kerjasama::where('status', 'pending')->count();
        $beratPerTanggal = DB::table('penjadwalan')
        ->join('jadwal_admins', 'penjadwalan.jadwal_admins_id', '=', 'jadwal_admins.id')
        ->select('jadwal_admins.tanggal', DB::raw('SUM(penjadwalan.total_berat) as total_kg'))
        ->where('penjadwalan.status', 'diproses')
        ->groupBy('jadwal_admins.tanggal')
        ->orderBy('jadwal_admins.tanggal', 'asc')
        ->get();
        // Total berat sampah dari penjadwalan yang statusnya diproses
        $totalBerat = Penjadwalan::where('status', 'diproses')->sum('total_berat');
       return view('admin.dashboard', compact('jumlahApproved', 'jumlahPending', 'totalBerat', 'beratPerTanggal'));

    }
}
