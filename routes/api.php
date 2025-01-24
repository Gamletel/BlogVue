<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'api.',
], function () {
    $files = glob(base_path('routes/api/*.php'));
    foreach ($files as $file) {
        include $file;
    }
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum')->name('api.user');


