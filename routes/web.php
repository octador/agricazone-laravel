<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StatusController;
use App\Http\Middleware\RedirectIfNotCustomerOrFarmer;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    //  route affecté par le middleware
})->name('dashboard')->middleware('redirectToTheRightDashboard');


Route::get('/dashboardFarmer', [DashboardController::class, 'dashboardFarmer'])->name('dashboardFarmer')->middleware('auth');
Route::get('/dashboardClient', [DashboardController::class, 'dashboardClient'])->name('dashboardClient')->middleware('auth');


Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('auth');

Route::prefix('category')->name('category.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/{name}', [CategoryController::class, 'search'])->name('search');
    Route::get('{id}/show', [CategoryController::class, 'show'])->name('show');
});

Route::prefix('product')->name('product.')->group(function () {

    Route::get('/{id}', [ProductController::class, 'search'])->name('search');
});

Route::prefix('stocks')->name('stocks.')->group(function () {
    Route::get('/', [StockController::class, 'index'])->name('index');
    Route::get('/new', [StockController::class, 'create'])->name('create');
    Route::post('/new', [StockController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [StockController::class, 'edit'])->name('edit');
    Route::put('/{id}/edit', [StockController::class, 'update'])->name('update');
    Route::delete('/{id}', [StockController::class, 'destroy'])->name('destroy');
    Route::get('/{id}', [StockController::class, 'search'])->name('search');
});

Route::prefix('collections')->name('collections.')->group(function () {
    Route::get('/', [CollectionController::class, 'index'])->name('index');
    Route::get('/new', [CollectionController::class, 'create'])->name('create');
    Route::post('/new', [CollectionController::class, 'store'])->name('store');
    Route::get('/{collection}', [CollectionController::class, 'show'])->name('show'); 
    Route::get('/{collection}/edit', [CollectionController::class, 'edit'])->name('edit');
    Route::put('/{collection}/edit', [CollectionController::class, 'update'])->name('update');
    Route::delete('/{collection}', [CollectionController::class, 'destroy'])->name('destroy');
});


Route::prefix('reservations')->name('reservations.')->group(function () {
    Route::get('/', [ReservationController::class, 'index'])->name('index');
    Route::get('/new/{id}', [ReservationController::class, 'create'])->name('create');
    Route::post('/new', [ReservationController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [ReservationController::class, 'edit'])->name('edit');
    Route::put('/{id}/edit', [ReservationController::class, 'update'])->name('update');
    Route::get('/show/{id}', [ReservationController::class, 'show'])->name('show');
    Route::delete('/{id}', [ReservationController::class, 'destroy'])->name('destroy');
    Route::get('/{id}', [ReservationController::class, 'search'])->name('search');
})->middleware('auth');

Route::prefix('status')->name('status.')->group(function () {
    Route::get('/{id}', [StatusController::class, 'update'])->name('update');
});


// Authentification et routes de vérification
require __DIR__ . '/auth.php';
