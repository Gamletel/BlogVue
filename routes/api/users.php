<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'users',
    'as' => 'users.'
], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/{id}/posts', [UserController::class, 'postsByUser'])->name('posts');
    Route::get('/{id}', [UserController::class, 'show'])->name('show');
    Route::post('/{id}', [UserController::class, 'update'])->name('update')->middleware("auth:sanctum");
});
