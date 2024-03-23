<?php

use App\Http\Controllers\AirQualityController;
use App\Http\Controllers\HumidityController;
use App\Http\Controllers\TemperatureController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/temperature', [TemperatureController::class, 'index'])->name('temperature.index');
Route::get('/humidity', [HumidityController::class, 'index'])->name('humidity.index');
Route::get('/air-quality', [AirQualityController::class, 'index'])->name('air_quality.index');

// Route to fetch air quality data
Route::get('/fetch-air-quality', [AirQualityController::class, 'fetchAirQuality']);

// Route to store air quality data
Route::get('/store-air-quality/{gas}/{h2}/{lpg}/{ch4}/{co}/{alcohol}', [AirQualityController::class, 'storeAirQuality'])->name('airquality.store');

// Route to store temperature data
Route::get('/store-temperature/{temp}', [TemperatureController::class, 'storeTemperature'])->name('temperature.store');

// Route to store humidity data
Route::get('/store-humidity/{value}', [HumidityController::class, 'storeHumidity'])->name('humidity.store');