<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Humidity;

class HumidityController extends Controller
{
    public function storeHumidity($value)
    {
        $humidity = new Humidity();
        $humidity->value = $value;
        $humidity->save();

        return response()->json(['message' => 'Humidity stored successfully'], 200);
    }
    public function index()
    {
        // $humidities = Humidity::all();
        return view('weather-api');
    }


    
public function showHumidity()
{
    // Fetch humidity values from the database or any other source
    $humidityValues = Humidity::all(); // Assuming you have a Humidity model

    return view('humidity', ['humidityValues' => $humidityValues]);
}
}