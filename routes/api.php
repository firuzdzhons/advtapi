<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdvertisementController;

Route::apiResource('advertisement', AdvertisementController::class);