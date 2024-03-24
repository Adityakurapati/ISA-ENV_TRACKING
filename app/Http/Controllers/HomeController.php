<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Airquality;
use App\Models\Humidity;
use App\Models\Temperature;
class HomeController extends Controller
{
    public function index()
    {
        
        $airQualities = Airquality::all();
        $humidities = Humidity::all();
        $temperatures = Temperature::all(); 

        // Pass fetched data to the view
        return view('home', [
            'temperatures' => $temperatures,
            'airQualities' => $airQualities,
            'humidities' => $humidities,
        ]);
    }
}