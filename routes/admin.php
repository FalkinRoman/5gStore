<?php

use Illuminate\Support\Facades\Route;



Route::middleware('auth:admin')->group(function () {
    Route::get('orders', [\App\Http\Controllers\Admin\HomeController::class, 'orders'])->name('orders');
    Route::get('orders/{order}', [\App\Http\Controllers\Admin\HomeController::class, 'show'])->name('orders.show');
    Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('cryptocurrencies', \App\Http\Controllers\Admin\CryptocurrencyController::class);

    Route::post('confirm_order/{orderId}', [\App\Http\Controllers\Admin\HomeController::class, 'confirmOrderCashback'])->name('confirm.order');

});

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [\App\Http\Controllers\Admin\AuthController::class, 'index'])->name('login');  //Страница входа в админку
    Route::post('login_process', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login_process');  //Процесс входа
});
