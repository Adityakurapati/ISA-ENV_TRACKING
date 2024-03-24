<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class WeatherController extends Controller
{
    public function getWeather()
    {
        // $apiKey = '2b5fc755ac2ec59250868b5527df31c4
        // ';
        $cityId = 'Solapur'; // Replace 'Solapur' with the desired city ID

        // Construct the OpenWeatherMap API URL
        $openWeatherMapUrl = 'https://api.openweathermap.org/data/2.5/weather?q='.$cityId.',India&lang=en&units=metric&APPID=d41a70ef2fcf93a3ee161b62fbe9a04b';

        // Make a GET request to the OpenWeatherMap API endpoint using GuzzleHttp
        $client = new Client();
        $response = $client->get($openWeatherMapUrl);

        // Check if the response is successful (status code 200)
        if ($response->getStatusCode() == 200) {
            // Decode the JSON response body
            $data = json_decode($response->getBody());

            // Return the weather data to the view
            return view('weather', ['weather' => $data]);
        } else {
            // Handle the error
            return response()->json(['error' => 'Failed to fetch weather data'], $response->getStatusCode());
        }
    }
}