<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/karyawan', [UserController::class, 'index'])->name('karyawan');

Route::patch('/karyawan/{id}/status', [UserController::class, 'updateStatus'])->name('karyawan.update-status');

Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori/edit/{kategori}', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/update/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/destroy/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');
Route::get('/menu/edit/{menu}', [MenuController::class, 'edit'])->name('menu.edit');
Route::put('/menu/update/{menu}', [MenuController::class, 'update'])->name('menu.update');
Route::delete('/menu/destroy/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');

Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria');
Route::get('/kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
Route::post('/kriteria/store', [KriteriaController::class, 'store'])->name('kriteria.store');
Route::get('/kriteria/edit/{kriteria}', [KriteriaController::class, 'edit'])->name('kriteria.edit');
Route::put('/kriteria/update/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update');
Route::delete('/kriteria/destroy/{kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

Route::get('/metode', [MetodePembayaranController::class, 'index'])->name('metode');
Route::get('/metode/create', [MetodePembayaranController::class, 'create'])->name('metode.create');
Route::post('/metode/store', [MetodePembayaranController::class, 'store'])->name('metode.store');
Route::get('/metode/edit/{metode}', [MetodePembayaranController::class, 'edit'])->name('metode.edit');
Route::put('/metode/update/{metode}', [MetodePembayaranController::class, 'update'])->name('metode.update');
Route::delete('/metode/destroy/{metode}', [MetodePembayaranController::class, 'destroy'])->name('metode.destroy');
Route::patch('/metode/toggle-status/{id}', [MetodePembayaranController::class, 'toggleStatus'])->name('metode.toggle-status');

Route::get('/pos', [TransaksiController::class, 'index'])->name('pos');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/profile', function () {
    return view('profile.profile');
})->name('profile');
