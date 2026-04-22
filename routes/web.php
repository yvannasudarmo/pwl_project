<?php

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show']);
Route::get('/mahasiswa-create', [MahasiswaController::class, 'create']);
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.save');
Route::get('/mahasiswa-edit/{id}', [MahasiswaController::class, 'edit']);
Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.edit');
Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.delete');


// Route::get      => Get Data     => R => select
// SELECT ALL   /   SELECT SPESIFIK
// Route::post     => Save Data    => C => insert into  /   create
// Route::put      => Update Data  => U => update  /   alter
// Route::delete   => Delete Data  => D => delete  /   drop

// Create, Read, Update, Delete