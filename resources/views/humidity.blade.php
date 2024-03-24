<!DOCTYPE html>
<html>
<head>
        <title>Humidity Data</title>

        <link rel="stylesheet" href="{{ asset('css/humidity.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/temperature.css') }}">




</head>
<body>
        <div class="container flex-column">
                <center>
                        <h1>Humidity Values</h1>
                </center>
                <div class="row">
                        @foreach($humidities as $humidity)
                        <div class="card flex-column @if($humidity->value < 30) low @elseif($humidity->value < 60) medium @else high @endif">
                                <h2>{{ $humidity->value }} Deg C</h2>
                                <div class="card-content">
                                        <p>Time: {{ $humidity->updated_at }}</p>
                                </div>
                        </div>
                        @endforeach
                </div>
        </div>
</body>
</html>
