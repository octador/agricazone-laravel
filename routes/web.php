<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\WelcomeController;
use App\Models\Category;
use App\Models\Reservation;

Route::prefix('/')->name('welcome.')->controller(WelcomeController::class)->group(function () {
    
    Route::get('/', 'index')->name('welcome');
});


// specifier si il va dans tel ou tel route
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Routes pour les catégories
Route::prefix('category')->name('category.')->controller(CategoryController::class)->group(function () {

    Route::get('/', 'index')->name('index');
    // Route::get('/new', 'create')->name('create');
    // Route::post('/new', 'store')->name('store');
    // Route::get('/{category}',  'show')->name('show');
    // Route::get('/{category}/edit', 'edit')->name('edit');
    // Route::post('/{category}/edit', 'update')->name('update');
    Route::get('{name}', 'search')->name('search');
    // Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    // Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});






Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () { 

    // Route::get('/', 'index')->name('index');
    // Route::get('/new', 'create')->name('create');
    // Route::post('/new', 'store')->name('store');
    // Route::get('/{product}/edit', 'edit')->name('edit');
    // Route::post('/{product}/edit', 'update')->name('update');
    // Route::get('/{product}', 'show')->name('show');
    Route::get('/{id}','search')->name('search');
});

Route::prefix('stocks')->name('stocks.')->controller(StockController::class)->group(function () {

    Route::get('/', 'index')->name('index');
    // Route::get('/new', 'create')->name('create');
    // Route::post('/new', 'store')->name('store');
    // Route::get('/{product}/edit', 'edit')->name('edit');
    // Route::post('/{product}/edit', 'update')->name('update');
    // Route::get('/{product}', 'show')->name('show');
    Route::get('/{id}','search')->name('search');
}); 

Route::prefix('reservations')->name('reservations.')->controller(ReservationController::class)->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/new/{id}', 'create')->name('create');
    Route::post('/new', 'store')->name('store');
    // Route::get('/{product}/edit', 'edit')->name('edit');
    // Route::post('/{product}/edit', 'update')->name('update');
    Route::get('/{id}', 'show')->name('show');
});