<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temperature; // Import the Temperature model

class TemperatureController extends Controller
{
        public function storeTemperature($temp)
        {
            $temperature = new Temperature();
            $temperature->temp_value = $temp; // Assign to the correct column name
            $temperature->save();
        
            return response()->json(['message' => 'Temperature stored successfully'], 200);
        }
        

    public function index()
    {
        $temperatures = Temperature::all();
        return view('temperature', compact('temperatures'));
    }
}