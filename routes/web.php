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

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/kerjasama', [KerjasamaController::class, 'admin'])->name('kerjasama');
    Route::get('/bagi-sampah', [BagiSampahController::class, 'adminForm'])->name('bagisampah');
});


Route::prefix('pemasok')->name('pemasok.')->group(function () {
    Route::get('/kerjasama', [KerjasamaController::class, 'pemasok'])->name('kerjasama');
    Route::get('/bagi-sampah', [BagiSampahController::class, 'showForm'])->name('bagisampah'); //
});






Route::middleware(['auth:admin,supplier'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'showForm'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});
