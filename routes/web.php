<?php

use App\Http\Controllers\TrafficLightController;

Route::get('/traffic-light/{zone}', [TrafficLightController::class, 'index']);
