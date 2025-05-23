<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Supplier;
use App\Models\Admin;

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

     public function showRegis()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:supplier',
            'password' => 'required|min:6',
            'phone_number' => 'required|min:6',
            'address' => 'required'
        ]);

        $supplier = Supplier::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone_number' => $validatedData['phone_number'],
            'address' => $validatedData['address'],
        ]);

        // Login langsung setelah registrasi berhasil
        Auth::guard('supplier')->login($supplier);
return redirect()->route('halaman');
    }
}
