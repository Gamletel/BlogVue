<?php

use App\Http\Controllers\RolePermissionController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'rolesPermissions',
    'as' => 'rolesPermissions.',
], function () {
    Route::get('/', [RolePermissionController::class, 'index'])->name('index');
    Route::get('/{id}', [RolePermissionController::class, 'show'])->name('show');
    Route::post('/store', [RolePermissionController::class, 'store'])->name('store');
    Route::patch('/{id}', [RolePermissionController::class, 'update'])->name('update');
    Route::delete('/{id}', [RolePermissionController::class, 'delete'])->name('delete');
});
