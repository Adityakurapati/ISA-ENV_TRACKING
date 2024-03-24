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
        @foreach($airQualities as $quality) 
            <div class="card">
                    <h2>ID: {{ $quality->id }}</h2>
                    <h2>Location: Pune</h2>
                    <h2>Co2 : {{ $quality->co2 }}</h2>
                    <h2>LPG : {{ $quality->lpg }}</h2>
                    <h2>Benzin : {{ $quality->benzin }}</h2>
                    <h2>No2 : {{ $quality->no2 }}</h2>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>
