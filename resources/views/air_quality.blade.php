<!DOCTYPE html>
<html>
<head>
    <title>CO2 Sensor Data</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/air_quality.css') }}">
</head>
<body>
    
<!-- Air Quality Section -->
<div id="airQualitySection">
    <h1>Air Quality</h1>
    <div id="airQualityDetails" class="card-container">
        @foreach($quality as $airQualities)
            <div class="card">
                    <h2>ID: {{ $temperature->id }}</h2>
                    <p>Location: Pune</p>
                    <p>Co2 : {{ $quality->co2 }}</p>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
