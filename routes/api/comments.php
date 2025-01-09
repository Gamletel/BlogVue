<?php

use App\Http\Controllers\UserCommentController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'=>'comments',
    'as'=>'comments.'
], function (){
    Route::get('/{id}', [UserCommentController::class, 'show'])->name('show');
    Route::delete('/{id}', [UserCommentController::class, 'delete'])->name('delete');
    Route::post('/', [UserCommentController::class, 'store'])->name('store');
});
