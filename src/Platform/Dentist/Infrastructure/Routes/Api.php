<?php

use Illuminate\Support\Facades\Route;

Route::post('/store', [\Src\Platform\Dentist\Infrastructure\Controllers\StoreDentistPOSTController::class, 'index']);
