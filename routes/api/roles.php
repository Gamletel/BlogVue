<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'roles',
    'as' => 'roles.',
], function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('/full', [RoleController::class, 'full'])->name('full');
    Route::get('/{id}', [RoleController::class, 'show'])->name('show');
    Route::post('/store', [RoleController::class, 'store'])->name('store');
    Route::patch('/{id}', [RoleController::class, 'update'])->name('update');
    Route::delete('/{id}', [RoleController::class, 'delete'])->name('delete');
});
