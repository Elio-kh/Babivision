<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Product routes
    Route::middleware('permission:manage products')->group(function () {
        Route::apiResource('products', ProductController::class);
    });
});

Route::fallback(function () {
    return response()->json([
        'error' => 'Endpoint not found'
    ], 404);
});
