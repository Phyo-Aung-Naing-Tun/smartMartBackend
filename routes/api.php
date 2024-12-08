<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\RoleAndPermissionController;
use App\Http\Controllers\Backend\ShopController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    //limit and ban the request for security
    Route::post("/register", "register")->middleware(['failToBan:auth','throttle:auth']);
    Route::post("/login", "login")->middleware(['failToBan:auth','throttle:auth']);
    Route::post("/logout", "logout")->middleware(['auth:sanctum','throttle:auth']);
    Route::post("/verify_otp", "verifyOtp")->middleware(['failToBan:auth','throttle:auth']);
});

Route::middleware(['auth:sanctum'])->prefix('profile')->group(
    function () {
        Route::get('/', [ProfileController::class, 'index']);
    }
);

Route::middleware(['auth:sanctum'])->prefix('users')->group(
    function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
    }
);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/roles', [RoleAndPermissionController::class, 'showRoles']);
});

Route::get('/shop/{id}', [ShopController::class,'show']);