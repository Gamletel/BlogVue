<?php
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'posts',
    'as' => 'posts.'
], function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::post('/create', [PostController::class, 'store'])->name('store');
    Route::get('/{id}/get-comments', [PostController::class, 'getComments'])->name('getComments');
    Route::get('/{id}', [PostController::class, 'show'])->name('show');
    Route::patch('/{id}', [PostController::class, 'update'])->name('update');
    Route::delete('/{id}', [PostController::class, 'delete'])->name('delete');
});
