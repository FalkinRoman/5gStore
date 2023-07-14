<?php

use Illuminate\Support\Facades\Route;



Route::middleware('auth:admin')->group(function () {
    Route::get('home', [\App\Http\Controllers\Admin\HomeController::class, 'home'])->name('home');
    Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
});

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [\App\Http\Controllers\Admin\AuthController::class, 'index'])->name('login');  //Страница входа в админку
    Route::post('login_process', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login_process');  //Процесс входа
});
