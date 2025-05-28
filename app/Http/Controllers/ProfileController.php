<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
        return view('pemasok.profile', compact('user'));
    }

    // Kalau tidak ada yang login, redirect ke login
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
            'password' => 'nullable|min:6|confirmed',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name_company = $validated['name_company'];
        $user->phone_number = $validated['phone_number'];
    }

    // Update password jika diisi
    if (!empty($validated['password'])) {
        $user->password = Hash::make($validated['password']);
    }

    // ✅ Upload gambar jika ada
    if ($request->hasFile('gambar')) {
        $path = $request->file('gambar')->store('uploads', 'public');
        $user->gambar = 'storage/' . $path; // agar bisa dipanggil pakai asset()
    }

    $user->save();

    return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
}



}
