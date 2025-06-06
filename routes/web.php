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

Route::get('/bagisampah', [BagiSampahController::class, 'index'])->name('bagisampah');
Route::post('/bagisampah', [BagiSampahController::class, 'jadwalStore'])->name('bagisampah.jadwal');
Route::post('/bagisampah/delete', [BagiSampahController::class, 'delete'])->name('bagisampah.delete');

// Supplier
Route::post('/bagisampah/supplier', [BagiSampahController::class, 'store'])->name('bagisampah.store');

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
    Route::get('/admin/kerjasama/data', [KerjasamaController::class, 'getData'])->name('admin.kerjasama.data');

});
