<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    Route::post("/register", "register");
    Route::post("/login", "login");
    Route::post("/logout", "logout")->middleware('auth:sanctum');
    Route::post("/verify_otp", "verifyOtp");
});

Route::middleware(['auth:sanctum'])->prefix('profile')->group(
    function () {
        Route::get('/', [ProfileController::class, 'index']);
    }
);

Route::middleware(['auth:sanctum'])->prefix('users')->group(
    function(){
        Route::get('/',[UserController::class, 'index']);
    }
);