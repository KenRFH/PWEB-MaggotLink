<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function showForm()
    {
        $user = Auth::guard('supplier')->check() ? Auth::guard('supplier')->user() : Auth::guard('admin')->user();
        if (!$user) return redirect()->route('login');

        return view('profile', compact('user'));
    }

    public function update(Request $request)
{
    // Ambil user yang sedang login
    $user = Auth::guard('supplier')->user() ?? Auth::guard('admin')->user();

    if (!$user) {
        return redirect()->route('login');
    }

    // Validasi
    $validatedData = $request->validate([
        'name_company' => 'nullable|string|max:255',
        'phone_number' => 'nullable|string',
        'address' => 'nullable|string|max:255',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    // Update password hanya jika diisi
    if (!empty($validatedData['password'])) {
        $user->password = Hash::make($validatedData['password']);
    }

    // Update field lain
    $user->name_company = $validatedData['name_company'] ?? $user->name_company;
    $user->phone_number = $validatedData['phone_number'] ?? $user->phone_number;
    $user->address = $validatedData['address'] ?? $user->address;

    // Handle upload gambar baru
    if ($request->hasFile('gambar')) {
        $gambar = $request->file('gambar');
        $gambarName = time() . '_' . $gambar->getClientOriginalName();
        $gambar->move(public_path('uploads/profile'), $gambarName);
        $user->gambar = 'uploads/profile/' . $gambarName;
    }

    // Simpan perubahan
    $user->save();

    return redirect()->back()->with('success', 'Profile berhasil diupdate.');
}

}

