<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $role_id = auth()->user()->role_id;

        if ($role_id == 2) {
            return redirect()->route('dashboardFarmer');
        } elseif ($role_id == 3) {
            return redirect()->route('dashboardClient');
        } else {
            abort(403);
        }
    })->name('dashboard');

    Route::get('/dashboardFarmer', [DashboardController::class, 'dashboardFarmer'])->name('dashboardFarmer');
    Route::get('/dashboardClient', [DashboardController::class, 'dashboardClient'])->name('dashboardClient');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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
        Route::get('/{collection}', [CollectionController::class, 'show'])->name('show'); // Ajout de la route show
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
    });
    Route::prefix('status')->name('status.')->group(function () {
        Route::get('/{id}', [StatusController::class, 'update'])->name('update');
    });

});


// Authentification et routes de vérification
require __DIR__ . '/auth.php';
