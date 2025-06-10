<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\KerjasamaController;
use App\Http\Controllers\BagiSampahController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// =====================
// GUEST / PUBLIC ROUTES
// =====================

Route::get('/', fn () => view('index'));

Route::get('/register', [AuthController::class, 'showRegis'])->name('showRegis');
Route::post('/register', [AuthController::class, 'register'])->name('register.register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
Route::post('/login', [AuthController::class, 'login'])->name('postLogin');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =====================
// ADMIN ROUTES
// =====================

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'showDash'])->name('dashboard');

    // Admin - Kerjasama
    Route::get('/admin/kerjasama', [KerjasamaController::class, 'index'])->name('admin.kerjasama.index');
    Route::get('/admin/kerjasama/data', [KerjasamaController::class, 'getData'])->name('admin.kerjasama.data');
    Route::post('/admin/kerjasama/{id}/approve', [KerjasamaController::class, 'approve'])->name('admin.kerjasama.approve');
    Route::post('/admin/kerjasama/{id}/reject', [KerjasamaController::class, 'reject'])->name('admin.kerjasama.reject');

    // Admin - Penjadwalan
    Route::post('/admin/bagisampah', [BagiSampahController::class, 'jadwalStore'])->name('bagisampah.jadwal');
    Route::get('/admin/bagisampah', [BagiSampahController::class, 'indexAdmin'])->name('admin.bagisampah');
});


// =====================
// SUPPLIER ROUTES
// =====================

Route::middleware(['auth:supplier'])->group(function () {
    Route::get('/halaman', [HalamanController::class, 'showForm'])->name('halaman');

    // Bagi Sampah untuk supplier
    Route::get('/bagisampah', [BagiSampahController::class, 'indexSupplier'])->name('bagisampah');
    Route::post('/bagisampah/supplier', [BagiSampahController::class, 'store'])->name('bagisampah.store');
    Route::post('/bagisampah/delete', [BagiSampahController::class, 'delete'])->name('bagisampah.delete');

    // Kerjasama
    Route::get('/kerjasama', [KerjasamaController::class, 'create'])->name('kerjasama');
    Route::post('/kerjasama', [KerjasamaController::class, 'store'])->name('kerjasama.store');
});


// =====================
// SHARED ROUTES (ADMIN + SUPPLIER)
// =====================

Route::middleware(['auth:admin,supplier'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'showForm'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
