<!DOCTYPE html>
<html>
<head>
    <title>Humidity Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0; /* Light Grey */
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .row {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            grid-gap: 20px;
        }
        .card {
            position: relative;
            overflow: hidden;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff; /* White */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.6));
            z-index: 2;
            transition: opacity 0.3s ease;
        }
        .card:hover::before {
            opacity: 0;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .card-content {
            position: relative;
            z-index: 3;
        }
        .card h2 {
            margin-top: 0;
            font-size: 24px;
            color: #333; /* Dark Grey */
            margin-bottom: 10px;
        }
        .card p {
            margin: 0;
            font-size: 18px;
            color: #666; /* Medium Grey */
        }
        .low {
            background-color: #d0f0c0; /* Light Green */
        }
        .medium {
            background-color: #fffacd; /* Light Yellow */
        }
        .high {
            background-color: #ffb6c1; /* Light Pink */
        }
        @media (max-width: 768px) {
            .card {
                width: calc(100% - 20px);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Humidity Values</h1>
        <div class="row">
            @foreach($humidities as $humidity)
            <div class="card @if($humidity->value < 30) low @elseif($humidity->value < 60) medium @else high @endif">
                <div class="card-content">
                    <h2>Date: {{ $humidity->date }}</h2>
                    <p>Time: {{ $humidity->time }}</p>
                    <p>Value: {{ $humidity->value }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>
