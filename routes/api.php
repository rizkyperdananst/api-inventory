<?php

use App\Http\Controllers\API\Admin\CategoryController;
use App\Http\Controllers\API\Admin\GoodsController;
use App\Http\Controllers\API\Admin\SupplierController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::post('/register', App\Http\Controllers\API\Auth\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\API\Auth\LoginController::class)->name('login');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::apiResource('/category', CategoryController::class);
    Route::apiResource('/goods', GoodsController::class);
    Route::apiResource('/supplier', SupplierController::class);
});