<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

include_once "auth.php";

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'prefix' => 'posts',
    'as' => 'posts.'
], function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::post('/create', [PostController::class, 'store'])->name('store');
    Route::get('/{id}', [PostController::class, 'show'])->name('show');
    Route::patch('/{id}', [PostController::class, 'update'])->name('update');
    Route::delete('/{id}', [PostController::class, 'delete'])->name('delete');
});

Route::group([
    'prefix' => 'users',
    'as' => 'users.'
], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/{id}/posts', [UserController::class, 'postsByUser'])->name('posts');
    Route::get('/{id}', [UserController::class, 'show'])->name('show');
    Route::post('/{id}', [UserController::class, 'update'])->name('update');
});
