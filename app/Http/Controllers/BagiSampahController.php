<?php

namespace App\Http\Controllers;

use App\Models\JadwalAdmin;
use App\Models\Kecamatan;
use App\Models\Penjadwalan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BagiSampahController extends Controller
{
    public function index()
    {
        $besok = Carbon::tomorrow();
        $kecamatanList = Kecamatan::all();

        // Admin login
        if (auth('admin')->check()) {
            $tanggalTerpakai = JadwalAdmin::pluck('tanggal')->toArray();

            $jadwalDenganJumlah = JadwalAdmin::select(
                    'jadwal_admins.id',
                    'jadwal_admins.tanggal',
                    DB::raw('COUNT(penjadwalan.id) as jumlah_pengambilan')
                )
                ->leftJoin('penjadwalan', 'penjadwalan.jadwal_admins_id', '=', 'jadwal_admins.id')
                ->whereDate('jadwal_admins.tanggal', '>=', Carbon::today())
                ->groupBy('jadwal_admins.id', 'jadwal_admins.tanggal')
                ->orderBy('jadwal_admins.tanggal')
                ->get();

            $penjadwalanAll = Penjadwalan::with('jadwalAdmin')->get();

            return view('admin.bagisampah', compact(
                'penjadwalanAll',
                'tanggalTerpakai',
                'jadwalDenganJumlah'
            ));

        // Supplier login
        } elseif (auth('supplier')->check()) {
            $supplier = auth('supplier')->user();

            if (!$supplier) {
                return abort(403, 'Anda tidak terdaftar sebagai supplier.');
            }

            $jadwalAdminList = JadwalAdmin::whereDate('tanggal', '>=', $besok)->get();

            return view('pemasok.bagisampah', compact('jadwalAdminList'));
        }

        return abort(403, 'Unauthorized');
    }

    public function jadwalStore(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|string'
        ], ['tanggal.required' => 'Harap pilih minimal satu tanggal.']);

        $tanggalDipilih = array_map('trim', explode(',', $request->tanggal));

        foreach ($tanggalDipilih as $tanggal) {
            JadwalAdmin::firstOrCreate(['tanggal' => $tanggal]);
        }

        return redirect()->route('bagisampah')->with('success', 'Tanggal berhasil disimpan.');
    }

   public function store(Request $request)
{
    
    $request->validate([
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'total_berat' => 'required|numeric|min:0.01',
        'jadwal_admin_id' => 'required|exists:jadwal_admins,id',
    ]);

    $supplier = auth('supplier')->user();

    // Ambil detail alamat milik supplier (asumsinya satu supplier satu alamat)
    $detailAlamat = DetailAlamat::where('supplier_id', $supplier->id)->first();

    if (!$detailAlamat) {
        return back()->withErrors(['error' => 'Detail alamat tidak ditemukan untuk supplier ini.']);
    }

    $gambarPath = null;
    if ($request->hasFile('gambar')) {
        $gambarPath = $request->file('gambar')->store('gambar_sampah', 'public');
    }

    Penjadwalan::create([
        'total_berat' => $request->total_berat,
        'gambar' => $gambarPath,
        'jadwal_admin_id' => $request->jadwal_admin_id,
        'detail_alamat_id' => $detailAlamat->id,
    ]);

    return redirect()->back()->with('success', 'Pengajuan penjadwalan berhasil disimpan.');
}


    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:penjadwalan,id',
        ]);

        $penjadwalan = Penjadwalan::findOrFail($request->id);
        $penjadwalan->delete();

        return redirect()->back()->with('success', 'Penjadwalan berhasil dibatalkan.');
    }
}
