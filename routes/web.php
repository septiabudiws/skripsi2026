<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardCotroller;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function (){
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register/store', [AuthController::class, 'registerStore'])->name('register.store');

Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/reset-password', [AuthController::class, 'updateResetPassword'])->name('password.update');
});

Route::middleware(['auth'])->group(function (){

Route::get('/', [DashboardCotroller::class, 'index'])->name('dashboard');

Route::get('/profile', function () {
    return view('profile.profile');
})->name('profile');

Route::put('/profile/change-password', [UserController::class, 'changePassword'])->name('profile.change-password');

Route::middleware(['role:admin'])->group(function (){
    Route::get('/karyawan', [UserController::class, 'index'])->name('karyawan');

    Route::patch('/karyawan/{id}/status', [UserController::class, 'updateStatus'])->name('karyawan.update-status');
    Route::put('/karyawan/{id}/permissions', [UserController::class, 'updatePermissions'])->name('karyawan.update-permissions');

    Route::get('/ranking', [RankingController::class, 'index'])->name('ranking');

    Route::get('/rekap', [RekapitulasiController::class, 'index'])->name('rekap');
    Route::get('/rekapitulasi/export-pdf', [RekapitulasiController::class, 'exportPdf'])->name('rekapitulasi.pdf');
});

Route::middleware(['permission:akses_kategori'])->group(function (){
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori/edit/{kategori}', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/update/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/destroy/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
});

Route::middleware(['permission:akses_menu'])->group(function (){
    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/menu/edit/{menu}', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('/menu/update/{menu}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/menu/destroy/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');
});

Route::middleware(['permission:akses_kriteria'])->group(function (){
    Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria');
    Route::get('/kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
    Route::post('/kriteria/store', [KriteriaController::class, 'store'])->name('kriteria.store');
    Route::get('/kriteria/edit/{kriteria}', [KriteriaController::class, 'edit'])->name('kriteria.edit');
    Route::put('/kriteria/update/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');
    Route::delete('/kriteria/destroy/{kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');
});

Route::middleware(['permission:akses_metode_pembayaran'])->group(function (){
    Route::get('/metode', [MetodePembayaranController::class, 'index'])->name('metode');
    Route::get('/metode/create', [MetodePembayaranController::class, 'create'])->name('metode.create');
    Route::post('/metode/store', [MetodePembayaranController::class, 'store'])->name('metode.store');
    Route::get('/metode/edit/{metode}', [MetodePembayaranController::class, 'edit'])->name('metode.edit');
    Route::put('/metode/update/{metode}', [MetodePembayaranController::class, 'update'])->name('metode.update');
    Route::delete('/metode/destroy/{metode}', [MetodePembayaranController::class, 'destroy'])->name('metode.destroy');
    Route::patch('/metode/toggle-status/{id}', [MetodePembayaranController::class, 'toggleStatus'])->name('metode.toggle-status');
});

Route::middleware(['permission:akses_pos'])->group(function (){
    Route::get('/pos', [TransaksiController::class, 'index'])->name('pos');
    Route::post('/pos/store', [TransaksiController::class, 'store'])->name('pos.store');
    Route::get('/transaksi/hari-ini', [TransaksiController::class, 'hariIni'])->name('transaksi.hari-ini');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});
