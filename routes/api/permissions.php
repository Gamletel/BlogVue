<?php

use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'permissions',
    'as' => 'permissions.',
], function () {
    Route::get('/', [PermissionController::class, 'index'])->name('index');
    Route::get('/{id}', [PermissionController::class, 'show'])->name('show');
    Route::post('/store', [PermissionController::class, 'store'])->name('store');
    Route::patch('/{id}', [PermissionController::class, 'update'])->name('update');
    Route::delete('/{id}', [PermissionController::class, 'delete'])->name('delete');
});
