<?php

use App\Events\OrderSuccess;
use App\Jobs\Testing;
use Illuminate\Support\Facades\Route;

Route::get("/test", function () {
    OrderSuccess::dispatch();
});

Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');
