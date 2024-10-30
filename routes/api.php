<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

include_once "auth.php";

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'prefix'=>'posts',
    'name'=>'posts.'
], function (){
   Route::get('/', [PostController::class, 'index'])->name('index');
   Route::post('/create', [PostController::class, 'store'])->name('store');
   Route::get('/{id}', [PostController::class, 'show'])->name('show');
   Route::patch('/{id}', [PostController::class, 'update'])->name('update');
   Route::delete('/{id}', [PostController::class, 'delete'])->name('delete');
});
