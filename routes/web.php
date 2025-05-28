<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\KerjasamaController;
use App\Http\Controllers\BagiSampahController;
use App\Http\Controllers\DashboardController;


Route::get('/', fn () => view('index'));

Route::get('/register', [AuthController::class, 'showRegis'])->name('showRegis');
Route::post('/register', [AuthController::class, 'register'])->name('register.register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
Route::post('/login', [AuthController::class, 'login'])->name('postLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// dashboard admin
Route::get('/dashboard', [DashboardController::class, 'showDash'])->name('dashboard');
// halaman pemasok
Route::get('/halaman', [HalamanController::class, 'showForm'])->name('halaman');





Route::get('/kerjasama', [KerjasamaController::class, 'create'])->name('kerjasama');
Route::post('/kerjasama', [KerjasamaController::class, 'store'])->name('kerjasama.store');





Route::middleware(['auth:admin,supplier'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'showForm'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/kerjasama', [KerjasamaController::class, 'index'])->name('admin.kerjasama.index');
    Route::post('/admin/kerjasama/{id}/approve', [KerjasamaController::class, 'approve'])->name('admin.kerjasama.approve');
    Route::post('/admin/kerjasama/{id}/reject', [KerjasamaController::class, 'reject'])->name('admin.kerjasama.reject');
});
