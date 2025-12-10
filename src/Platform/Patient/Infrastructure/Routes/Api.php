<?php

use Illuminate\Support\Facades\Route;

Route::post('/store', [\Src\Platform\Patient\Infrastructure\Controllers\StorePatientPOSTController::class, 'index']);
