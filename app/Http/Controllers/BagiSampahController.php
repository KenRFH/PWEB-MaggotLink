<?php

namespace App\Http\Controllers;

use App\Models\JadwalAdmin;
use App\Models\Kecamatan;
use App\Models\DetailAlamat;
use App\Models\Penjadwalan;
use Illuminate\Http\Request;
use Carbon\Carbon;
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

        $penjadwalanAll = Penjadwalan::with(['jadwalAdmins', 'detailAlamat.supplier'])->get();

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

        $detailAlamat = DetailAlamat::where('supplier_id', $supplier->id)->first();
        if (!$detailAlamat) {
            return redirect()->back()->withErrors(['error' => 'Alamat Anda belum tersedia. Harap lengkapi terlebih dahulu.']);
        }

        $jadwalAdminList = JadwalAdmin::whereDate('tanggal', '>=', Carbon::tomorrow())->get();

        $penjadwalanSaya = Penjadwalan::with(['jadwalAdmins', 'detailAlamat'])
            ->whereHas('detailAlamat', function ($query) use ($supplier) {
                $query->where('supplier_id', $supplier->id);
            })
            ->orderByDesc('created_at')
            ->get();

        return view('pemasok.bagisampah', compact('jadwalAdminList', 'penjadwalanSaya', 'detailAlamat'));
    }

    // ========================
    // ADMIN - Menyimpan Tanggal Jadwal
    // ========================
    public function jadwalStore(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|string'
        ], ['tanggal.required' => 'Harap pilih minimal satu tanggal.']);

        $tanggalDipilih = array_map('trim', explode(',', $request->tanggal));

        foreach ($tanggalDipilih as $tanggal) {
            JadwalAdmin::firstOrCreate(['tanggal' => $tanggal]);
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
        $detailAlamat = DetailAlamat::where('supplier_id', $supplier->id)->first();

        if (!$detailAlamat) {
            return back()->withErrors(['error' => 'Detail alamat tidak ditemukan untuk supplier ini.']);
        }

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
            'gambar' => $gambarPath,
            'jadwal_admins_id' => $request->jadwal_admins_id,
            'detail_alamat_id' => $detailAlamat->id,
            'status' => 'menunggu',
        ]);

        return redirect()->back()->with('success', 'Pengajuan penjadwalan berhasil disimpan.');
    }


}

