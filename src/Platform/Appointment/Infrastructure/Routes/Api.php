<?php

use Illuminate\Support\Facades\Route;

Route::get('/list', [\Src\Platform\Appointment\Infrastructure\Controllers\ListAppointmentsByStartDateGETController::class, 'index']);
Route::get('/show', [\Src\Platform\Appointment\Infrastructure\Controllers\ShowAppointmentByIdGETController::class, 'index']);
Route::post('/store', [\Src\Platform\Appointment\Infrastructure\Controllers\StoreAppointmentPOSTController::class, 'index']);
