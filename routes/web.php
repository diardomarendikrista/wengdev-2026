<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(\App\Http\Controllers\ArticleController::class)
    ->group(function () {
        Route::get('/articles', 'list')->name('article.list');
        Route::match(['get', 'post'], '/articles/create', 'create')->name('article.create');
        Route::get('/articles/{slug}', 'single')->name('article.single');
        Route::match(
            ['get', 'post'],
            '/articles/{id}/edit',
            'edit'
        )->name('article.edit');
        Route::post('/articles/{id}/delete', 'delete')->name('article.delete');
    });

Route::controller(\App\Http\Controllers\ArticleCommentController::class)
    ->group(function () {
        Route::post('/articles/{id}/comment', 'comment')->name('article.comment');
        Route::post('/comments/{id}/delete', 'deleteComment')->name('article.comment.delete');
    });
