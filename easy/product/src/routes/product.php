<?php

use Illuminate\Support\Facades\Route;
use Easy\Product\Http\Controllers\Product\{
    IndexController,
    Simple\CreateController,
    Simple\StoreController,
    // DeleteController,
    // EditController,
    // UpdateController,
    Attribute\IndexController as AttributeIndexController,
    Attribute\CreateController as AttributeCreateController
};

Route::prefix('admin/product')->name('admin.product.')->middleware(['web', 'auth:admin'])->group(function () {
    Route::get('index', IndexController::class)->name('index');
    Route::prefix('simple')->name('simple.')->group(function () {
        Route::get('create', CreateController::class)->name('create');
        Route::post('store', StoreController::class)->name('store');
    });
    Route::prefix('attribute')->name('attribute.')->group(function () {
        Route::get('index', AttributeIndexController::class)->name('index');
        Route::get('create/{type}', AttributeCreateController::class)->name('create');
    });
});
