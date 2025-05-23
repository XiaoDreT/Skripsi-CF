<?php

use App\Http\Controllers\AdminDiagnosaController;
use App\Http\Controllers\AdminGejalaController;
use App\Http\Controllers\AdminPasienController;
use App\Http\Controllers\AdminPenyakitController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',function () {
    return view('admin.auth.login');
});

Route::prefix('/admin')->group(function () {
    Route::get('/dashboard', function () {
       return view('admin.layouts.wrapper');
    //    return view('index');
    });

    Route::resource('/user', AdminUserController::class);
    Route::resource('/gejala', AdminGejalaController::class);
    Route::resource('/pasien', AdminPasienController::class);
    Route::get('/diagnosa', [AdminDiagnosaController::class, 'index']);

    Route::delete('/penyakit/delete-role/{id}', [AdminPenyakitController::class, 'deleteRole']);
    Route::post('/penyakit/add-gejala', [AdminPenyakitController::class, 'addGejala']);
    Route::resource('/penyakit', AdminPenyakitController::class);
});
