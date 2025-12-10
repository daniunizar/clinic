<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('receptionist')->group(base_path('src/Platform/Receptionist/Infrastructure/Routes/Api.php'));


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
