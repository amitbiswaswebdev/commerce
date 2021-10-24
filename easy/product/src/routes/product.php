<?php

use Illuminate\Support\Facades\Route;
use Easy\Product\Http\Controllers\Product\{
    IndexController,
    Simple\CreateController,
    Simple\StoreController
    // DeleteController,
    // EditController,
    // UpdateController
};

Route::prefix('admin/product')->name('admin.product.')->middleware(['web','auth:admin'])->group( function () {
    Route::get('index', IndexController::class)->name('index');
    Route::prefix('simple')->name('simple.')->group(function () {
        Route::get('create', CreateController::class)->name('create');
        Route::post('store', StoreController::class)->name('store');
    });
    // Route::prefix('simple')->name('simple.')->group( function () {
    //     Route::post('store', StoreController::class)->name('store');
    //     // Route::get('edit/{id}', EditController::class)->name('edit');
    //     // Route::put('update/{id}', UpdateController::class)->name('update');
    //     // Route::delete('delete/{id}', DeleteController::class)->name('delete');
    // });
});
