<?php

use Illuminate\Support\Facades\Route;

//Зарегестрированнные
Route::middleware('auth')->group(function (){
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'home'])->name('home');

});


//Гости
Route::middleware('guest')->group(function (){
    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register_process', [\App\Http\Controllers\AuthController::class, 'register'])->name('register_process');
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login_process');
});

//Корзина

Route::post('/basket/add/{id}',[\App\Http\Controllers\BasketController::class, 'basketAdd'])->name('basket-add');  //Добавление товара в корзину

Route::middleware('basket_not_empty')->group(function (){
    Route::get('/basket', [\App\Http\Controllers\BasketController::class, 'basket'])->name('basket');
    Route::get('/basket/place', [\App\Http\Controllers\BasketController::class, 'basketPlace'])->name('basket-place');  //Страница оформление заказа
    Route::post('/basket/place', [\App\Http\Controllers\BasketController::class, 'basketConfirm'])->name('basket-confirm'); //Потвердить заказ
    Route::post('/basket/remove/{id}',[\App\Http\Controllers\BasketController::class, 'basketRemove'])->name('basket-remove'); //Удаление товара с корзины
});







Route::get('/', [\App\Http\Controllers\MainConroller::class, 'index'])->name('index');
Route::get('/categories', [\App\Http\Controllers\MainConroller::class, 'categories'])->name('categories');


Route::get('/{category}', [\App\Http\Controllers\MainConroller::class, 'category'])->name('category');
Route::get('/{category}/{product}', [\App\Http\Controllers\MainConroller::class, 'product'])->name('product');





