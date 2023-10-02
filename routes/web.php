<?php

use Illuminate\Support\Facades\Route;

//Зарегестрированнные
Route::middleware('auth')->group(function (){
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'home'])->name('home');
    Route::get('order/{order}', [\App\Http\Controllers\HomeController::class, 'show'])->name('orders.show');
});

//Гости
Route::middleware('guest')->group(function (){
    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register_process', [\App\Http\Controllers\AuthController::class, 'register'])->name('register_process');
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login_process');
    Route::get('/forgot', [\App\Http\Controllers\AuthController::class, 'showForgotForm'])->name('forgot');
    Route::post('/forgot_process', [\App\Http\Controllers\AuthController::class, 'forgot'])->name('forgot_process');
});

//Корзина
Route::post('/basket/add/{product}',[\App\Http\Controllers\BasketController::class, 'basketAdd'])->name('basket-add');  //Добавление товара в корзину
Route::middleware('basket_not_empty')->group(function (){
    Route::get('/basket', [\App\Http\Controllers\BasketController::class, 'basket'])->name('basket');
    Route::get('/basket/place', [\App\Http\Controllers\BasketController::class, 'basketPlace'])->name('basket-place');  //Страница оформление заказа
    Route::post('/basket/place', [\App\Http\Controllers\BasketController::class, 'basketConfirm'])->name('basket-confirm'); //Потвердить заказ
    Route::post('/basket/remove/{product}',[\App\Http\Controllers\BasketController::class, 'basketRemove'])->name('basket-remove'); //Удаление товара с корзины
});
Route::get('/get-subcategories-and-brands/{categoryId}', [\App\Http\Controllers\SubcategoriesAndBrandsController::class, 'getSubcategoriesAndBrands']);  //получение брендов и субкатегорий для каталога
Route::get('/get-brands-and-products/{categoryId}/{subcategoryId}', [\App\Http\Controllers\BrandsAndProductsController::class, 'getBrands']);  //получение брендов
Route::get('/get-brands-and-products2/{categoryId}/{brandId}', [\App\Http\Controllers\BrandsAndProductsController::class, 'getProducts']);  //получение продуктов для каталога
Route::get('/', [\App\Http\Controllers\MainConroller::class, 'index'])->name('index');
Route::get('/categories', [\App\Http\Controllers\MainConroller::class, 'categories'])->name('categories');
Route::get('/{category}', [\App\Http\Controllers\MainConroller::class, 'category'])->name('category');
Route::get('/{category}/{product}', [\App\Http\Controllers\MainConroller::class, 'product'])->name('product');
Route::post('subscription/{product}', [\App\Http\Controllers\MainConroller::class, 'subscribe'])->name('subscription');  //уведомление о пуступлении товара


  //получение бренда или субкатегории












