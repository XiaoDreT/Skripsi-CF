<?php

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

    Route::resource('user', AdminUserController::class);
});
