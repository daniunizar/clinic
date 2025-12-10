<?php

use Illuminate\Support\Facades\Route;

Route::post('/login', [\Src\Platform\Receptionist\Infrastructure\Controllers\LoginReceptionistPOSTController::class, 'index']);
