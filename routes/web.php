<?php

use App\Enums\UserRoleEnum;
use App\Http\Middleware\EnsureArticleCategoryExists;
use App\Http\Middleware\EnsureUserRole;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

Route::controller(\App\Http\Controllers\ArticleController::class)->middleware(['auth', 'has_article_category'])->group(function () {
    Route::get('/articles', 'list')->name('article.list');
    Route::match(['get', 'post'], '/articles/create', 'create')
        ->name('article.create')
        ->middleware('role:' . UserRoleEnum::Administrator->value . ',' . UserRoleEnum::Author->value);
    Route::get('/articles/{slug}', 'single')->name('article.single');
    Route::match(
        ['get', 'post'],
        '/articles/{id}/edit',
        'edit'
    )
        ->name('article.edit')
        ->middleware('role:' . UserRoleEnum::Administrator->value . ',' . UserRoleEnum::Author->value);
    Route::post('/articles/{id}/delete', 'delete')->name('article.delete');
});

Route::controller(\App\Http\Controllers\ArticleCommentController::class)->middleware('auth')->group(function () {
    Route::post('/articles/{id}/comment', 'comment')->name('article.comment');
    Route::post('/comments/{id}/delete', 'deleteComment')->name('article.comment.delete');
    Route::post('/comments/{id}/edit', 'editComment')->name('article.comment.edit');
});

Route::controller(\App\Http\Controllers\UserController::class)->middleware('auth')->group(function () {
    Route::get('/users', 'list')->name('user.list');
    Route::match(['get', 'post'], '/users/create', 'create')->name('user.create');
    Route::match(['get', 'post'], '/users/{id}/edit', 'edit')->name('user.edit');
    Route::post('/users/{id}/delete', 'delete')->name('user.delete');
});

Route::controller(\App\Http\Controllers\LoginController::class)->group(function () {
    Route::match(['get', 'post'], '/login', 'form')->middleware('guest')->name('login');
    Route::match(['get', 'post'], '/logout', 'logout')->middleware('auth')->name('logout');
});
