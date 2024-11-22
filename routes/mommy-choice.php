<?php

use App\Http\Controllers\MommyChoice\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products',[ProductController::class, 'index']);