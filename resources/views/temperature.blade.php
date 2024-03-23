<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temperature Readings</title>
    <!-- Import Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif; /* Apply Google Font */
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
        @media (max-width: 768px) {
            .card {
                width: calc(100% - 20px);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <center><h1>Temperature</h1></center>
        <div class="row">
            @foreach($temperatures as $temperature)
            <div class="card">
                <div class="card-content">
                    <h2>ID: {{ $temperature->id }}</h2>
                    <p>Temperature Value: {{ $temperature->temp_value }}</p>
                    <p>Timestamp: {{ $temperature->created_at }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>
