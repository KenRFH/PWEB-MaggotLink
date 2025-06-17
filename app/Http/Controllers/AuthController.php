<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Supplier;
use App\Models\Admin;
use App\Models\Alamat;
use App\Models\DetailAlamat;
use App\Models\Kecamatan;
use Illuminate\View\View;


class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    // Validasi input
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6'
    ]);

   if (Auth::guard('supplier')->attempt($credentials)) {
    $request->session()->regenerate();
    return redirect()->route('halaman')->with('success', 'Login sebagai supplier berhasil!');
}

if (Auth::guard('admin')->attempt($credentials)) {
    $request->session()->regenerate();
    return redirect()->route('dashboard')->with('success', 'Login sebagai admin berhasil!');
}

return back()->withErrors([
    'email' => 'Email atau password salah.',
])->onlyInput('email');}



    public function logout(Request $request)
    {

        Auth::guard('supplier')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

     public function showRegis(): View
    {
        $kecamatans = Kecamatan::all();

        return view('auth.register', compact('kecamatans'));
    }

    public function register(Request $request)
    {



    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:supplier,email',
        'password' => 'required|min:6',
    ]);

    $supplier = Supplier::create([
        'nama' => $validatedData['nama'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
    ]);

    // Login langsung setelah registrasi
    Auth::guard('supplier')->login($supplier);

    return redirect()->route('showLogin');

        // Login langsung setelah registrasi berhasil

    }
}
