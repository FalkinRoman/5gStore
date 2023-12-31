<?php

use Illuminate\Support\Facades\Route;



Route::middleware('auth:admin')->group(function () {
    Route::get('/main', [\App\Http\Controllers\Admin\HomeController::class, 'main'])->name('main');
    Route::get('orders', [\App\Http\Controllers\Admin\HomeController::class, 'orders'])->name('orders');
    Route::get('orders/{order}', [\App\Http\Controllers\Admin\HomeController::class, 'show'])->name('orders.show');
    Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('subcategories', \App\Http\Controllers\Admin\SubcategoryController::class);
    Route::resource('brands', \App\Http\Controllers\Admin\BrandController::class);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('cryptocurrencies', \App\Http\Controllers\Admin\CryptocurrencyController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('reviews', \App\Http\Controllers\Admin\ReviewController::class);

    Route::post('confirm_order/{orderId}', [\App\Http\Controllers\Admin\HomeController::class, 'confirmOrderCashback'])->name('confirm.order');

});

Route::middleware('guest:admin')->group(function () {
    Route::get('login', [\App\Http\Controllers\Admin\AuthController::class, 'index'])->name('login');  //Страница входа в админку
    Route::post('login_process', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login_process');  //Процесс входа
});
