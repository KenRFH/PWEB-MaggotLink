<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kerjasama;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\Storage;

class KerjasamaController extends Controller
{
   public function create()
{
    $userId = auth()->guard('supplier')->user()->id;
    $pengajuan = Kerjasama::where('supplier_id', $userId)->latest()->first();

    if ($pengajuan) {
        if ($pengajuan->status === 'approved') {
            return view('pemasok.kerjasama-approved');
        } elseif ($pengajuan->status === 'pending') {
            return view('pemasok.kerjasama-pending');
        } elseif ($pengajuan->status === 'rejected') {
            return view('pemasok.kerjasama-rejected');
        }
    }

    // Jika belum ada pengajuan, tampilkan form pengajuan
    $kecamatanList = Kecamatan::all();

    return view('pemasok.kerjasama', [
        'kecamatanList' => $kecamatanList,
    ]);
}


     public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string',
        'name_company' => 'required|string',

        'alamat' => 'required|string',
        'no_telepon' => 'required|string|max:30',
        'kecamatan_id' => 'required|exists:kecamatan,id',
        'file_mou' => 'required|file|mimes:pdf|max:2048',
        'catatan' => 'nullable|string',
    ]);

    $path = $request->file('file_mou')->store('mou', 'public');

    Kerjasama::create([
    'supplier_id' => auth()->guard('supplier')->user()->id,
    'nama' => $request->nama,
    'name_company' => $request->name_company,
    'alamat' => $request->alamat,
    'kecamatan_id' => $request->kecamatan_id,
    'no_telepon' => $request->no_telepon,
    'file_mou' => $path,
    'catatan' => $request->catatan,
    'status' => 'pending', // tambahkan ini
]);

    return redirect()->route('halaman')->with('success', 'Pengajuan berhasil disimpan!');
}

    // Menampilkan semua pengajuan untuk admin
public function index()
{
    $pengajuanList = Kerjasama::with('supplier', 'kecamatan')->latest()->get();
    return view('admin.kerjasama', compact('pengajuanList'));
}

// Menyetujui pengajuan
public function approve($id)
{
    $pengajuan = Kerjasama::findOrFail($id);
    $pengajuan->status = 'approved';
    $pengajuan->save();

    return redirect()->back()->with('success', 'Pengajuan disetujui.');
}

// Menolak pengajuan
public function reject($id)
{
    $pengajuan = Kerjasama::findOrFail($id);
    $pengajuan->status = 'rejected';
    $pengajuan->save();

    return redirect()->back()->with('success', 'Pengajuan ditolak.');
}


}

