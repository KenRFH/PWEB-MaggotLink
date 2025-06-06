<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\DetailAlamat;
use App\Models\Alamat;

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
return view('pemasok.profile', compact('user', 'detailAlamat', 'kecamatanList'));


     
    }

    return redirect()->route('login');
}



   public function update(Request $request)
{
    if (Auth::guard('admin')->check()) {
        $user = Auth::guard('admin')->user();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'password' => 'nullable|min:6|confirmed',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->nama = $validated['nama'];

    } elseif (Auth::guard('supplier')->check()) {
    $user = Auth::guard('supplier')->user();

    $validated = $request->validate([
        'name_company' => 'required|string|max:255',
        'phone_number' => 'nullable|string|max:20',
        'alamat' => 'required|string|max:255',
        'kecamatan_id' => 'required|exists:kecamatan,id',
        'password' => 'nullable|min:6|confirmed',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user->name_company = $validated['name_company'];
    $user->phone_number = $validated['phone_number'];

    // ✅ Simpan ke tabel alamat terlebih dahulu
    $alamatBaru = Alamat::create([
        'jalan' => $validated['alamat'],
        'kecamatan_id' => $request->kecamatan_id, // opsional
    ]);

    // ✅ Simpan ke detail_alamat
    DetailAlamat::updateOrCreate(
        ['supplier_id' => $user->id],
        ['alamat_id' => $alamatBaru->id]
    );
}




    // Update password jika diisi
    if (!empty($validated['password'])) {
        $user->password = Hash::make($validated['password']);
    }

    // Upload gambar jika ada
    if ($request->hasFile('gambar')) {
        $path = $request->file('gambar')->store('uploads', 'public');
        $user->gambar = 'storage/' . $path;
    }

    $user->save();

    return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
}



}
