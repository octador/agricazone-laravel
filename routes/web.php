<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});
// specifier si il va dans tel ou tel route

// Routes pour les catégories
Route::prefix('categories')->name('categories.')->controller(CategoryController::class)->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/new', 'create')->name('create');
    Route::post('/new', 'store')->name('store');
    // Route::get('/{category}',  'show')->name('show');
    Route::get('/{category}/edit', 'edit')->name('edit');
    Route::post('/{category}/edit', 'update')->name('update');
    // Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    // Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});
