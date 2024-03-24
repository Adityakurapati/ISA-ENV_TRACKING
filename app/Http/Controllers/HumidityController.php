<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Humidity;

class HumidityController extends Controller
{
    public function storeHumidity(Request $request)
    {
        $humidity = new Humidity();
        $humidity->value = $request->humidity;
        $humidity->save();
        return response()->json(['message' => 'Humidity stored successfully'], 200);
    }
    
    public function index()
    {
        $humidities = Humidity::all();
        return view('humidity', compact('humidities'));
    }
    
    public function fetchHumidity()
    {
        $humidityValues = Humidity::all(); 
        return response()->json(['humidityValues' => $humidityValues]);
    }
}