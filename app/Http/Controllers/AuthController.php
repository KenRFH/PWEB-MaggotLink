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

    // Coba login supplier dulu
    if (Auth::guard('supplier')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('halaman'); // ganti sesuai route supplier
    }

    // Coba login admin
    if (Auth::guard('admin')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('dashboard'); // ganti sesuai route admin
    }

    // Jika gagal login di kedua guard
    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
}


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
        'email' => 'required|email|unique:supplier',
        'password' => 'required|min:6',
        'phone_number' => 'required|min:6',
        'alamat' => 'required',
        'kecamatan_id' => 'required|exists:kecamatan,id',
    ]);
$supplier = Supplier::create([
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'phone_number' => $validatedData['phone_number'],
    ]);

    $alamat = Alamat::create([
        'jalan' => $validatedData['alamat'], // ← cocokkan field dari form
        'kecamatan_id' => $validatedData['kecamatan_id'],
        'supplier_id' => $supplier->id, // ← pastikan kalau kolom ini memang ada
    ]);

    DetailAlamat::create([
        'supplier_id' => $supplier->id,
        'alamat_id' => $alamat->id,
    ]);

    Auth::guard('supplier')->login($supplier);

    return redirect()->route('halaman');






        // Login langsung setelah registrasi berhasil
        Auth::guard('supplier')->login($supplier);
return redirect()->route('halaman');
    }
}
