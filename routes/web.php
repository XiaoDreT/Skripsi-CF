<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminBasisPengetahuanController;
use App\Http\Controllers\AdminDiagnosaController;
use App\Http\Controllers\AdminGejalaController;
use App\Http\Controllers\AdminPasienController;
use App\Http\Controllers\AdminPenyakitController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserDiagnosaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/login', [AdminAuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AdminAuthController::class, 'login'])->middleware('guest');
Route::get('/logout', [AdminAuthController::class, 'logout'])->middleware('auth');
Route::get('/register', [AdminAuthController::class, 'register'])->middleware('guest');
Route::post('/register', [AdminAuthController::class, 'storeRegister'])->middleware('guest');


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
    Route::get('/basis-pengetahuan', [AdminBasisPengetahuanController::class, 'index']);
});

Route::prefix('/user')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.layouts.wrapper');
        //    return view('index');
    });

    Route::get('/diagnosa', [UserDiagnosaController::class, 'index']);
    Route::get('/diagnosa/riwayat', [UserDiagnosaController::class, 'riwayat_diagnosa']);
    Route::get('/diagnosa/pilih-gejala', [UserDiagnosaController::class, 'pilihGejala']);
    Route::get('/diagnosa/hapus-gejala', [UserDiagnosaController::class, 'hapusGejalaTerpilih']);
    Route::get('/diagnosa/proses', [UserDiagnosaController::class, 'prosesDiagnosa']);
    Route::get('/diagnosa/pilih', [UserDiagnosaController::class, 'pilih']);
    Route::post('/diagnosa/create-pasien', [UserDiagnosaController::class, 'createPasien']);
    Route::get('/diagnosa/keputusan/{id}', [UserDiagnosaController::class, 'keputusan']);
    Route::get('/diagnosa/cetak/{id}', [AdminPasienController::class, 'print']);
});

