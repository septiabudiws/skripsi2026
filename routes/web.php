<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/kategori', function (){
    return view('kategori.kategori');
});

Route::get('/kategori/create', function (){
    return view('kategori.kategori-create');
});

Route::get('/kategori/edit', function (){
    return view('kategori.kategori-update');
});

Route::get('/menu', function (){
    return view('menu.menu');
});

Route::get('/menu/create', function (){
    return view('menu.menu-create');
});

Route::get('/menu/edit', function (){
    return view('menu.menu-update');
});

Route::get('/kriteria', function (){
    return view('kriteria.kriteria');
});

Route::get('/kriteria/create', function (){
    return view('kriteria.kriteria-create');
});

Route::get('/kriteria/edit', function (){
    return view('kriteria.kriteria-update');
});
