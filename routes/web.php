<?php
use App\Http\Controllers\AirQualityController;
use App\Http\Controllers\HumidityController;
use App\Http\Controllers\TemperatureController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;

// Just For Rendering UI
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/temperature', [TemperatureController::class, 'index'])->name('temperature.index');
Route::get('/humidity', [HumidityController::class, 'index'])->name('humidity.index');
Route::get('/air-quality', [AirQualityController::class, 'index'])->name('air_quality.index');

// Route to fetch Sensor data
Route::get('/fetch-air-quality', [AirQualityController::class, 'fetchAirQuality']);
Route::get('/fetch-humidity', [HumidityController::class, 'fetchHumidity']);
Route::get('/fetch-temperature', [TemperatureController::class, 'fetchTemperature']);

// Route to store Sensor Data 
Route::get('/store-air-quality', [AirQualityController::class, 'storeAirQuality']);
Route::get('/store-temperature', [TemperatureController::class, 'storeTemperature'])->name('temperature.store');        
Route::get('/store-humidity', [HumidityController::class, 'storeHumidity'])->name('humidity.store');


Route::get('/weather', [WeatherController::class, 'getWeather']);