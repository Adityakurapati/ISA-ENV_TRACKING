<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airquality;

class AirQualityController extends Controller
{

    public function storeAirQuality($gas, $h2, $lpg, $ch4, $co, $alcohol)
    {
        $airQuality = new Airquality();
        $airQuality->gas_value = $gas;
        $airQuality->h2ppm = $h2;
        $airQuality->lpg = $lpg;
        $airQuality->ch4 = $ch4;
        $airQuality->co = $co;
        $airQuality->alcohol = $alcohol;
        $airQuality->save();

        return response()->json(['message' => 'Air Quality data stored successfully'], 200);
    }

    public function index()
    {
        $airQualities = Airquality::all();
        return view('air_quality', compact('airQualities'));
    }

    public function fetchAirQuality(Request $request)
    {
        // Implement your logic to fetch air quality data here
        // You can use $request->input('location') to get the location parameter
        
        // For now, let's return dummy data
        return response()->json([
            'location' => $request->input('location'),
            'aqi' => 80,
            'primaryPollutant' => 'PM2.5',
            'pm25' => 15,
            'pm10' => 25,
            'ozone' => 10,
            'no2' => 5,
            'so2' => 3,
        ]);
    }
}