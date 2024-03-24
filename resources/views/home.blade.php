<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Include Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <title>Environment Health Monitor</title>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
        <!-- Include Moment.js library -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/adapters/moment.min.js"></script>
        <!-- Include Chart.js library -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Include Chart.js plugin for datalabels -->
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

        {{-- Custom Styles --}}

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <style>
                .day {
                        margin-bottom: 20px;
                }

                .temp-details {
                        display: flex;
                        align-items: center;
                        margin-bottom: 10px;
                        padding: 5px;
                }

                .temp-details .icon {
                        width: 60px;
                        height: 60px;
                        margin-right: 10px;
                }

                .temp-details .temp_value,
                .temp-details .time {
                        font-size: 1.2rem;
                }

                .temp-details .temp_value {
                        flex: 1;
                }

        </style>
</head>

<body>
        <div class="blur"></div>
        <!-- Include Chart.js library -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Include Chart.js plugin for datalabels -->
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>




        <div class="container">
                <div class="menu card flex-column">
                        <a href="/" class="sensor option"><i class="uil uil-wind"></i></a>
                        <a href="/weather" class="api option"><i class="uil uil-cloud-sun"></i></a>
                </div>
                <div class="temperature card flex-column">
                        <h2>Temperature</h2>
                        <img src="/images/tem-icon.png" alt="" class="icon">
                        <h2>{{ $temperatures->last()->temp_value }} <sup>*C</sup></h2>
                        <hr>

                </div>
                <div class="flex-column card" style="align-items: flex-start;">
                        <h2>Overall-Strategy</h2>
                        <div class="overall-strategy ">
                                <div class="box box-1">
                                        <h3 class="strategy-heading">Air Quality</h3>
                                        <canvas id="doughnutChart"></canvas>

                                        <div class="values">7.90</div>
                                </div>
                                <div class="box box-2">
                                        <h3 class="strategy-heading">Temperture</h3>
                                        <canvas id="lineChart-temp" height="220"></canvas>
                                        <div class="values">03</div>
                                </div>
                                <div class="box box-3">
                                        <h3 class="strategy-heading">Humidity</h3>
                                        {{-- <canvas id="lineChart" height="220px"></canvas> --}}
                                        <canvas id="barChart" height="220px"></canvas>

                                        <div class="values">42 deg</div>
                                </div>
                        </div>
                </div>
                <div class="temperature-detailed card">
                        <div class="head-text flex-row start">
                                <h3>Past-Forecast</h3>
                        </div>
                        <div class="scrollable">
                                @php
                                $groupedTemperatures = $temperatures->reverse()->groupBy(function($item) {
                                return $item->created_at->format('Y-m-d');
                                });
                                @endphp

                                @foreach($groupedTemperatures as $date => $records)
                                <div class="day">
                                        <h4>{{ \Carbon\Carbon::parse($date)->isoFormat('dddd, MMMM Do YYYY') }}</h4>
                                        @foreach($records as $temperature)
                                        <div class="temp-details">
                                                <img src="/images/tem-icon.png" alt="" class="icon">
                                                <div class="temp_value">{{ $temperature->temp_value }}</div>
                                                <div class="time"></div>
                                        </div>
                                        @endforeach
                                </div>
                                @endforeach
                        </div>
                </div>


                <script>
                        // Loop through each temperature element and set the time
                        document.querySelectorAll('.temp-details').forEach(function(element) {
                                var timestamp = new Date('{{ $temperature->updated_at }}');
                                var formattedTime = timestamp.toLocaleString('en-US', {
                                        hour: 'numeric'
                                        , minute: 'numeric'
                                        , hour12: true
                                });
                                element.querySelector('.time').textContent = formattedTime;
                        });

                </script>


                <div class="flex-column card" style="align-items: flex-start;">
                        <h2>Air Quality</h2>
                        <div class="air-quality">
                                @foreach($airQualities as $airQuality)
                                <div class="quality">
                                        <div class="heading">CO2</div>
                                        <div class="value">{{ $airQuality->co2 }}</div>
                                </div>
                                <div class="quality">
                                        <div class="heading">LPG</div>
                                        <div class="value">{{ $airQuality->lpg }}</div>
                                </div>
                                <div class="quality">
                                        <div class="heading">Benzin</div>
                                        <div class="value">{{ $airQuality->benzin }}</div>
                                </div>
                                <div class="quality">
                                        <div class="heading">NO2</div>
                                        <div class="value">{{ $airQuality->no2 }}</div>
                                </div>
                                @endforeach
                        </div>
                </div>

        </div>


        <script src="/js/script.js"></script>
</body>

</html>
