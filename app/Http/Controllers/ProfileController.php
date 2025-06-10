<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\DetailAlamat;
use App\Models\Alamat;
use App\Models\Kecamatan;
use App\Models\Kerjasama;


class ProfileController extends Controller
{
   public function showForm()
{

    if (Auth::guard('admin')->check()) {
        $user = Auth::guard('admin')->user();
        return view('admin.profile', compact('user'));
    }

    if (Auth::guard('supplier')->check()) {
        $user = Auth::guard('supplier')->user();
        $detailAlamat = DetailAlamat::with('alamat')->where('supplier_id', $user->id)->first();
        $kecamatanList = Kecamatan::all();
        $kerjasama = $user->kerjasama()->latest()->first();
return view('pemasok.profile', compact('user', 'detailAlamat', 'kecamatanList', 'kerjasama'));




    }
}



   public function update(Request $request)
{
    $user = auth()->guard('supplier')->user();

    $request->validate([
        'nama' => 'required|string|max:255',
        'name_company' => 'required|string',
        'phone_number' => 'required|string|max:30',
        'alamat' => 'nullable|string',
        'kecamatan_id' => 'required|exists:kecamatan,id',
        'password' => 'nullable|confirmed|min:6',
        'gambar' => 'nullable|image|max:2048',
    ]);

    // Update kerjasama
    $kerjasama = Kerjasama::where('supplier_id', $user->id)->latest()->first();
    if ($kerjasama) {
        $kerjasama->name_company = $request->name_company;
        $kerjasama->no_telepon = $request->phone_number;
        $kerjasama->kecamatan_id = $request->kecamatan_id;
        $kerjasama->save();
    }

    // Update alamat supplier jika ada
    $alamat = Alamat::firstOrCreate([
        'jalan' => $request->alamat,
        'kecamatan_id' => $request->kecamatan_id,
    ]);

    DetailAlamat::updateOrCreate(
        ['supplier_id' => $user->id],
        [
            'alamat_id' => $alamat->id,
            'kecamatan_id' => $request->kecamatan_id
        ]
    );

    $user->nama = $request->nama;

    // Update gambar jika ada
    if ($request->hasFile('gambar')) {
        $path = $request->file('gambar')->store('gambar_profil', 'public');
        $user->gambar = $path;
    }

    // Update password jika diisi
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }
    if ($request->filled('nama')) {
        $user->nama = $request->nama;
    }

    // Simpan alamat jika ada

    $user->save();

    return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
}




}
