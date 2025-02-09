<?php

use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'user-roles',
    'as' => 'usersRoles.',
    'middleware'=>'is.admin',
], function () {
    Route::get('/', [UserRoleController::class, 'index'])->name('index');
    Route::get('/{id}', [UserRoleController::class, 'show'])->name('show');
    Route::post('/store', [UserRoleController::class, 'store'])->name('store');
    Route::patch('/{id}', [UserRoleController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserRoleController::class, 'delete'])->name('delete');
});
