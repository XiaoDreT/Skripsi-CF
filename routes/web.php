<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDiagnosaController;
use App\Http\Controllers\AdminGejalaController;
use App\Http\Controllers\AdminPasienController;
use App\Http\Controllers\AdminPenyakitController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[AdminAuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[AdminAuthController::class, 'login'])->middleware('guest');
Route::get('/logout',[AdminAuthController::class, 'logout'])->middleware('auth');

Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
       return view('admin.layouts.wrapper');
    //    return view('index');
    });

    Route::resource('/user', AdminUserController::class);
    Route::resource('/gejala', AdminGejalaController::class);
    Route::resource('/pasien', AdminPasienController::class);

    Route::get('/diagnosa', [AdminDiagnosaController::class, 'index']);
    Route::get('/diagnosa/pilih-gejala', [AdminDiagnosaController::class, 'pilihGejala']);
    Route::get('/diagnosa/hapus-gejala', [AdminDiagnosaController::class, 'hapusGejalaTerpilih']);
    Route::get('/diagnosa/proses', [AdminDiagnosaController::class, 'prosesDiagnosa']);
    Route::get('/diagnosa/pilih', [AdminDiagnosaController::class, 'pilih']);
    Route::post('/diagnosa/create-pasien', [AdminDiagnosaController::class, 'createPasien']);
    Route::get('/diagnosa/keputusan/{id}', [AdminDiagnosaController::class, 'keputusan']);

    Route::get('/pasien/cetak/{id}', [AdminPasienController::class, 'print']);

    Route::delete('/penyakit/delete-role/{id}', [AdminPenyakitController::class, 'deleteRole']);
    Route::post('/penyakit/add-gejala', [AdminPenyakitController::class, 'addGejala']);
    Route::resource('/penyakit', AdminPenyakitController::class);
});
