<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(\App\Http\Controllers\ArticleController::class)
    ->group(function () {
        Route::get('/articles', 'list')->name('articles.list');
        Route::match(['get', 'post'], '/articles/create', 'create')->name('articles.create');
    });
