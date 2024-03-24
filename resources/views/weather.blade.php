<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Weather</title>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
        <link rel="stylesheet" href="{{ asset('css/humidity.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/temperature.css') }}">
        <style>
                .card {
                        margin: 5rem auto;
                        background: black;
                        gap: 35px;
                }

                img {
                        width: 140px;
                        height: 140px;
                }

                a {
                        position: absolute;
                        top: 2rem;
                        left: 2rem;
                        background: #514e4e;
                        padding: 11px;
                        border-radius: 14px;

                }

                a:hover {
                        background: black;
                        color: white !important;
                }

                a:hover .uil {
                        color: white !important;
                }

                .uil {
                        color: black;
                        font-size: 30px;
                }

        </style>
</head>
<body>
        <a href="/" class="sensor option"><i class="uil uil-wind"></i></a>

        <div class="card flex-column">
                <h2>Weather Information</h2>
                @if(isset($weather))
                <div class="temperature">
                        <img src="{{ 'http://openweathermap.org/img/wn/' . $weather->weather[0]->icon . '.png' }}" />
                        <div class="temp-details">
                                <div class="temp_value">{{ $weather->main->temp }} °C</div>
                                <div class="date">Date: {{ date('Y-m-d') }}</div>
                                <div class="time">Time: {{ date('H:i:s') }}</div>
                        </div>
                </div>
                <div class="air-quality">
                        <div class="quality">
                                <div class="heading">Humidity</div>
                                <div class="value">{{ $weather->main->humidity }}%</div>
                        </div>
                        <div class="quality">
                                <div class="heading">Wind Speed</div>
                                <div class="value">{{ $weather->wind->speed }} m/s</div>
                        </div>
                        <!-- Add more weather details as needed -->
                </div>
                @else
                <p>No weather data available</p>
                @endif
        </div>
</body>
</html>
