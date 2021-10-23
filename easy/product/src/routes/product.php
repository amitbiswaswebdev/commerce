<?php

use Illuminate\Support\Facades\Route;
use Easy\Product\Http\Controllers\Product\{
    IndexController
    // DeleteController,
    // EditController,
    // StoreController,
    // UpdateController
};

Route::prefix('admin/product')->name('admin.product.')->middleware(['web','auth:admin'])->group( function () {
    Route::get('index', IndexController::class)->name('index');
    // Route::post('store', StoreController::class)->name('store');
    // Route::get('edit/{id}', EditController::class)->name('edit');
    // Route::put('update/{id}', UpdateController::class)->name('update');
    // Route::delete('delete/{id}', DeleteController::class)->name('delete');
});
