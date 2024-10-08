<?php

use project\app\Http\Controllers\AuthController;
use project\app\Http\Controllers\CartController;
use project\app\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('signup', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{product}', [ProductController::class, 'show']);

    Route::post('products', [ProductController::class, 'store']);
    Route::patch('products/{product}', [ProductController::class, 'update']);
    Route::delete('products/{product}', [ProductController::class, 'delete']);

    Route::post('cart/purchase', [CartController::class, 'purchase']);
    Route::get('cart', [CartController::class, 'index']);
    Route::post('cart/{product}', [CartController::class, 'add']);
    Route::delete('cart/{cart}', [CartController::class, 'remove']);
    Route::get('order', [CartController::class, 'order']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
