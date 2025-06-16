<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    // Gunakan relasi yang benar
    $alamat = $user->alamat()->with('kecamatan')->first();

    $kecamatanList = Kecamatan::all();
    $kerjasama = $user->kerjasama()->latest()->first();

    return view('pemasok.profile', compact('user', 'kecamatanList', 'kerjasama', 'alamat'));
}

}

    public function update(Request $request)
    {
        $user = auth()->guard('supplier')->user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'nama_perusahaan' => 'required|string',
            'no_telp' => 'required|string|max:30',
            'alamat' => 'required|string',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'password' => 'nullable|confirmed|min:6',
            'gambar' => 'nullable|image|max:2048',
        ]);

        // Update data supplier
        $user->update([
            'nama' => $request->nama,
            'nama_perusahaan' => $request->nama_perusahaan,
            'no_telp' => $request->no_telp,
            'gambar' => $request->gambar
        ]);

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update gambar jika ada
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('gambar_profil', 'public');
            $user->gambar = $path;
        }

        $user->save();

        // Simpan atau update alamat berdasarkan supplier_id
        Alamat::updateOrCreate(
            ['supplier_id' => $user->id],
            [
                'jalan' => $request->alamat,
                'kecamatan_id' => $request->kecamatan_id,
            ]
        );

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }






}
