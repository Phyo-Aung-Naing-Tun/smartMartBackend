<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\RoleAndPermissionController;

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
    function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
    }
);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/roles', [RoleAndPermissionController::class, 'showRoles']);
});

Route::get('example', function () {
    dd('Here');
});
