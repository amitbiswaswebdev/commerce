<?php

use Illuminate\Support\Facades\Route;
use Easy\Category\Http\Controllers\{
    IndexController,
    DeleteController,
    EditController,
    ReorderController,
    StoreController,
    UpdateController
};

Route::prefix('admin/category')->name('admin.category.')->middleware(['web','auth:admin'])->group( function () {
    Route::get('index', IndexController::class)->name('index');
    Route::post('store', StoreController::class)->name('store');
    Route::get('edit/{id}', EditController::class)->name('edit');
    Route::put('update/{id}', UpdateController::class)->name('update');
    Route::post('reorder', ReorderController::class)->name('reorder');
    Route::delete('delete/{id}', DeleteController::class)->name('delete');
});
