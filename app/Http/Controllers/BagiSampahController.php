<?php

namespace App\Http\Controllers;


use App\Models\Admin;
use App\Models\JadwalAdmin;
use App\Models\Kecamatan;
use App\Models\Alamat;
use App\Models\Penjadwalan;
use App\Models\Kerjasama;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

class BagiSampahController extends Controller
{
    // ========================
    // ADMIN VIEW: Lihat Jadwal & Pengajuan
    // ========================
    public function indexAdmin()
{
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

    $penjadwalanAll = Penjadwalan::with(['jadwalAdmins', 'supplier.alamat.kecamatan'])->get();

    return view('admin.bagisampah', compact(
        'penjadwalanAll',
        'tanggalTerpakai',
        'jadwalDenganJumlah'
    ));
}


    // admin update status
   public function updateStatus(Request $request, $id)
{
    $penjadwalan = Penjadwalan::findOrFail($id);
    $penjadwalan->status = 'diproses'; // ubah dari 'menunggu' ke 'diproses'
    $penjadwalan->save();

    return redirect()->back()->with('success', 'Status berhasil diperbarui.');
}

    // ========================
    // SUPPLIER VIEW
    // ========================
    public function indexSupplier()
{
    $supplier = auth('supplier')->user();
    if (!$supplier) {
        return abort(403, 'Anda tidak terdaftar sebagai supplier.');
    }

    // Cek status pengajuan kerjasama
    $pengajuan = Kerjasama::where('supplier_id', $supplier->id)->latest()->first();

        if (!$pengajuan || $pengajuan->status !== 'approved') {
        return redirect()->route('kerjasama')->withErrors([
            'errors' => 'Pengajuan kerja sama Anda belum disetujui.',
        ]);

    }

    $alamat = Alamat::where('supplier_id', $supplier->id)->first();
    if (!$alamat) {
        return redirect()->back()->withErrors(['error' => 'Alamat Anda belum tersedia. Harap lengkapi terlebih dahulu.']);
    }

    $jadwalAdminList = JadwalAdmin::whereDate('tanggal', '>=', \Carbon\Carbon::tomorrow())->get();

    $penjadwalanSaya = Penjadwalan::with(['supplier.alamat', 'jadwalAdmins'])
        ->whereHas('supplier.alamat', function ($query) use ($supplier) {
            $query->where('supplier_id', $supplier->id);
        })
        ->orderByDesc('created_at')
        ->paginate(3);


    return view('pemasok.bagisampah', compact('jadwalAdminList', 'penjadwalanSaya', 'alamat'));
}


    // ========================
    // ADMIN - Menyimpan Tanggal Jadwal
    // ========================
    public function jadwalStore(Request $request)
    {
       $admin = auth('admin')->user();
        $request->validate([
            'tanggal' => 'required|string'

        ], ['tanggal.required' => 'Harap pilih minimal satu tanggal.']);

        if($request->tanggal > Date::now()->addDays(7)) {
            return redirect()->route('admin.bagisampah')->with('error', 'Tanggal gagal disimpan.');
        }

        $tanggalDipilih = array_map('trim', explode(',', $request->tanggal));

       foreach ($tanggalDipilih as $tanggal) {
    JadwalAdmin::firstOrCreate(
        ['tanggal' => $tanggal, 'admin_id' => $admin->id] // ✅ tambahkan admin_id
    );
}

        return redirect()->route('admin.bagisampah')->with('success', 'Tanggal berhasil disimpan.');
    }

    // ========================
    // SUPPLIER - Menyimpan Pengajuan Penjadwalan
    // ========================
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'nullable|string',
            'total_berat' => 'required|numeric|min:0.01',
            'jadwal_admins_id' => 'required|exists:jadwal_admins,id',
        ]);

        $supplier = auth('supplier')->user();


        $gambarPath = null;
        if ($request->filled('gambar') && Str::startsWith($request->gambar, 'data:image')) {
            $image_parts = explode(";base64,", $request->gambar);
            $image_base64 = base64_decode($image_parts[1]);
            $imageName = 'gambar_' . time() . '.jpg';
            $imagePath = 'gambar_sampah/' . $imageName;
            Storage::disk('public')->put($imagePath, $image_base64);
            $gambarPath = $imagePath;
        }

        Penjadwalan::create([
            'total_berat' => $request->total_berat,
            'supplier_id' => $supplier->id,
            'gambar' => $gambarPath,
            'jadwal_admins_id' => $request->jadwal_admins_id,
            'status' => 'menunggu',
        ]);

        return redirect()->back()->with('success', 'Pengajuan penjadwalan berhasil disimpan.');
    }

    // ========================
    // SUPPLIER - Hapus Jadwal
    // ========================

}

