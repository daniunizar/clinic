<?php

use Illuminate\Support\Facades\Route;

Route::get('/list', [\Src\Platform\Appointment\Infrastructure\Controllers\ListAppointmentsByStartDateGETController::class, 'index']);
