<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airquality;

class AirQualityController extends Controller
{
    public function storeAirQuality(Request $request)
    {
        $validatedData = $request->validate([
            'co2' => 'required|numeric',
            'lpg' => 'required|numeric',
            'benzin' => 'required|numeric',
            'no2' => 'required|numeric',
        ]);

        $airQuality = Airquality::create($validatedData);

        return response()->json(['message' => 'Air Quality data stored successfully'], 200);
    }

    public function index()
    {
        $airQualities = Airquality::all();
        return view('air_quality', compact('airQualities'));
    }

    public function fetchAirQuality(Request $request)
    {
        $airQualities = Airquality::all();
        return response()->json(['airQualities' => $airQualities], 200);
    }
}