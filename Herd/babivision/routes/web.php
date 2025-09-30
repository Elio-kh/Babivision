<?php

use Illuminate\Support\Facades\Route;

// Update the namespace to point to the api folder
use App\Http\Controllers\api\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product-login', [ProductController::class, 'showLoginPage']);
