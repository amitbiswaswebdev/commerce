<?php

use Illuminate\Support\Facades\Route;
use Easy\Category\Http\Controllers\Category;

Route::prefix('admin/category')->name('admin.category.')->middleware(['web','auth:admin'])->group( function () {
    Route::get('index', [Category::class, 'index'])->name('index');
});
