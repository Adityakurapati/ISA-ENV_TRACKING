<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Temperature Readings</title>
        <!-- Import Google Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/humidity.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/temperature.css') }}">
</head>
<body>
        <div class="container flex-column">
                <center>
                        <h1>Temperature</h1>
                </center>
                <div class="row">
                        @foreach($temperatures as $temperature)
                        <div class="card flex-column">
                                <h3>{{ $temperature->temp_value }}</h3>
                                <div class="card-content">
                                        <p>{{ $temperature->updated_at }}</p>
                                </div>
                        </div>
                        @endforeach
                </div>
        </div>
</body>
</html>
