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
        <!-- Air Quality Details will be populated dynamically -->
        <div class="card">
            <h2>Location</h2>
            <p id="location">Loading...</p>
        </div>
        <div class="card">
            <h2>Air Quality Index (AQI)</h2>
            <p id="aqi">Loading...</p>
        </div>
        <div class="card">
            <h2>Primary Pollutant</h2>
            <p id="primaryPollutant">Loading...</p>
        </div>
        <div class="card">
            <h2>PM2.5 Level</h2>
            <p id="pm25">Loading...</p>
        </div>
        <div class="card">
            <h2>PM10 Level</h2>
            <p id="pm10">Loading...</p>
        </div>
        <div class="card">
            <h2>Ozone Level</h2>
            <p id="ozone">Loading...</p>
        </div>
        <div class="card">
            <h2>Nitrogen Dioxide (NO2) Level</h2>
            <p id="no2">Loading...</p>
        </div>
        <div class="card">
            <h2>Sulfur Dioxide (SO2) Level</h2>
            <p id="so2">Loading...</p>
        </div>
    </div>
</div>

<script>
    // Function to fetch and display air quality details
    async function fetchAirQualityDetails(location) {
        try {
            const response = await fetch(`http://127.0.0.1:8000/air-quality?location=${location}`);
            const data = await response.json();

            // Populate air quality details in HTML
            document.getElementById('location').innerText = data.location;
            document.getElementById('aqi').innerText = data.aqi;
            document.getElementById('primaryPollutant').innerText = data.primaryPollutant;
            document.getElementById('pm25').innerText = `${data.pm25} μg/m³`;
            document.getElementById('pm10').innerText = `${data.pm10} μg/m³`;
            document.getElementById('ozone').innerText = `${data.ozone} ppb`;
            document.getElementById('no2').innerText = `${data.no2} ppb`;
            document.getElementById('so2').innerText = `${data.so2} ppb`;
        } catch (error) {
            console.error('Error fetching air quality details:', error);
            // Display error message if fetching data fails
            const airQualityDetailsElement = document.getElementById('airQualityDetails');
            airQualityDetailsElement.innerHTML = `<p>Error fetching air quality details. Please try again later.</p>`;
        }
    }

    // Example usage: Fetch air quality details for a specific location
    const locationName = 'solapur'; // Changed variable name from location to locationName
    fetchAirQualityDetails(locationName); // Changed variable name from location to locationName
</script>
</body>
</html>
