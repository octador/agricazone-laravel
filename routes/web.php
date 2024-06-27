<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';

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






// Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () {

    // Route::get('/', 'index')->name('index');
    // Route::get('/new', 'create')->name('create');
    // Route::post('/new', 'store')->name('store');
    // Route::get('/{product}/edit', 'edit')->name('edit');
    // Route::post('/{product}/edit', 'update')->name('update');
    // Route::get('/{product}', 'show')->name('show');
    Route::get('/{id}', 'search')->name('search');
});

Route::prefix('stocks')->name('stocks.')->controller(StockController::class)->group(function () {

    Route::get('/', 'index')->name('index');
    // Route::get('/new', 'create')->name('create');
    // Route::post('/new', 'store')->name('store');
    // Route::get('/{product}/edit', 'edit')->name('edit');
    // Route::post('/{product}/edit', 'update')->name('update');
    // Route::get('/{product}', 'show')->name('show');
    Route::get('/{id}', 'search')->name('search');
});

Route::prefix('reservations')->name('reservations.')->controller(ReservationController::class)->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/new/{id}', 'create')->name('create');
    Route::post('/new', 'store')->name('store');
    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::PUT('/{id}/edit', 'update')->name('update');
    Route::get('/{id}', 'show')->name('show');
    Route::delete('/{id}', 'destroy')->name('destroy');
});
