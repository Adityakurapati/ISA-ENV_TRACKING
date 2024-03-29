<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temperature;

class TemperatureController extends Controller
{
    public function storeTemperature(Request $request)
    {
        $temperature = new Temperature();
        $temperature->temp_value = $request->temperature;
        $temperature->save();
        return response()->json(['message' => 'Temperature stored successfully'], 200);
    }

    public function index()
    {
        $temperatures = Temperature::all();
        return view('temperature', compact('temperatures'));
    }

    public function fetchTemperature()
    {
        $temperatures = Temperature::all(); 
        return response()->json(['temperatureValue' => $temperatures], 200);
    }
}