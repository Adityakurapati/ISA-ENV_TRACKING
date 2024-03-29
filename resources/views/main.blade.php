<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Include Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <title>Environment Health Monitor</title>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>

<body>

        <!-- Include Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Include Chart.js plugin for datalabels -->
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

        <style>
                * {
                        color: rgb(160, 159, 159);
                        margin: 0;
                        padding: 0;
                }

                body {
                        font-family: Arial, sans-serif;
                        max-height: 100vh ;
                        width: 100vw;
                        background-color: #191B1F;
                }

                h1 {
                        color: white;
                }

                .blur {
                        filter: blur(40px);
                        background: rgb(146 43 240);
                        width: 540px;
                        height: 485px;
                        position: absolute;
                        top: -95px;
                        left: -84px;
                        border-radius: 50%;
                        z-index: -1;
                        background: url('/css/blur.png');
                }

                .container {
                        max-height: 100vh;
                        display: grid;
                        min-width: 100vw;
                        height: 100vh;
                        gap:35px;
                        grid-template-columns: 4% 30% auto;
                }

                .card {
                        transform: scale(0.9);
                        transition: transform 0.5s ease;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        /* box-sizing: content-box; */
                        background: rgba(255, 255, 255, 0.25);
                        border-radius: 20px;
                        border: 1px solid rgba(255, 255, 255, 0.18);
                        padding: 3rem;
                }

                h1,
                h2,
                h3,
                h4 {
                        color: white;
                        font-weight: bold;
                }

                .menu {
                        grid-column: 1;
                        grid-row: 1/3;
                        display: flex !important;
                        width: auto !important;
                        flex-direction: column;
                        color: gainsboro;
                        justify-content: flex-start;
                        align-items: center !important;
                }

                .menu>.option {
                        color: blue;
                        font-size: 2rem;
                        background: rgb(32, 32, 46);
                        padding: .9rem;
                        border-radius: 1.2rem;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        width: 60px;
                        height: 60px;
                        transition: all 0.4s ease-in;
                }
                .menu>.option:hover {
                        background-color: rgb(15, 15, 24);
                        cursor: pointer;
                        color: white;
                }

                /* Smooth scrollbar for webkit browsers */
                ::-webkit-scrollbar {
                        width: 8px;
                        height: 60%;
                }

                /* Track */
                ::-webkit-scrollbar-track {
                        background: transparent;
                }

                /* Handle */
                ::-webkit-scrollbar-thumb {
                        background: #888;
                        border-radius: 4px;
                }

                /* Handle on hover */
                ::-webkit-scrollbar-thumb:hover {
                        background: #555;
                }


                .flex-row {
                        display: flex;
                        flex-direction: row;
                        width: 100% !important;
                        gap: 50px;
                }

                .flex-column {
                        display: flex;
                        flex-direction: column;
                        gap: 5px;
                        /* box-sizing: content-box; */
                        width: 100%;
                        
                        padding: 2.5rem;
                }

                .start {
                        justify-content: flex-start;
                }

                .end {
                        justify-content: flex-end;
                }

                .temperature {
                        grid-column: 2;
                        align-items: flex-start;
                }

                .row {
                        font-size: 1.2rem;
                }

                .temperature>.icon {
                        font-size: 4rem;
                        width: 200px;
                        height: 200px;
                        background: url('E:/env-tracking/public/images/tem-icon.png');
                }

                hr {
                        border: none;
                        border-top: 1px solid #eee;
                        width: 100%;
                        margin: 10px 0;
                }

                .temperature h2 {
                        font-size: 2.2rem;
                        font-weight: 700;
                        color: wheat;
                }


                .flex-row>.icon {
                        width: 60px;
                        height: 60px;
                }

                .temp-details {
                        align-items: center;
                }

                .air-quality {
                        grid-column: 3;
                        display: grid;
                        grid-template-columns: repeat(3, 1fr);
                        gap: 20px;
                        width: 100%;
                }

                .overall-strategy {
                        grid-column: 3;
                        display: grid;
                        /* height: 100%; */
                        grid-template-columns: repeat(3, minmax(0, 1fr));
                        width: 100%;
                        gap: 25px;
                }

                .box {
                        background: #2f2f30;
                        /* background: #2b2d2e; */
                        border-radius: 20px;
                        padding: 20px;
                        text-align: center;
                        margin-bottom: 20px;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                        max-width: 300px;
                        /* Adjusted */
                        width: 100%;
                        height: 100%;
                }

                .box h3 {
                        font-size: 1.5rem;
                        margin-bottom: 10px;
                }

                .quality {
                        background-color: rgb(207, 206, 206);
                        padding: 1.2rem;
                        display: flex;
                        flex-direction: column;
                        align-items: flex-start;
                        gap: 20px;
                        border-radius: 20px;
                        margin-bottom: 20px;

                }

                .quality .heading {
                        font-size: 1.2rem;
                        margin-bottom: 10px;
                }

                .quality .value {
                        font-size: 1.5rem;
                        color: #FFD700;
                        /* Golden color */
                }

                .temperature-detailed {
                        max-height: 300px;
                        overflow-y: auto;
                        position: relative;
                }

                .temperature-detailed h3 {
                        position: absolute;
                        top: .8rem;
                }

                .temperature-detailed .temp-details {
                        display: flex;
                        align-items: center;
                        margin-bottom: 10px;
                }

                .temperature-detailed .temp-details .icon {
                        width: 60px;
                        height: 60px;
                        margin-right: 10px;
                }

                .temperature-detailed .temp-details .temp_value,
                .temperature-detailed .temp-details .date,
                .temperature-detailed .temp-details .time {
                        font-size: 1.2rem;
                        margin-right: 10px;
                }
        </style>

        <div class="container">
                <div class="menu card flex-column">
                        <div class="sensor option"><i class="uil uil-wind"></i></div>
                        <div class="api option"><i class="uil uil-cloud-sun"></i></div>
                </div>
                <div class="temperature card flex-column">
                        <h2>Temperature</h2>
                        <img src="/public/images/tem-icon.png" alt="" class="icon">
                        <h2>28 <sup>*C</sup> </h2>
                        <div class="row flex-row">
                                <div class="row-icon">
                                        <i class="uil uil-cloud"></i>
                                </div>
                                <div class="row-text">Rainy Cloud </div>
                        </div>
                        <hr>
                        <div class="row flex-row">
                                <div class="row-icon">
                                        <i class="uil uil-cloud"></i>
                                </div>
                                <div class="row-text">Rainy Cloud </div>
                        </div>
                        <div class="row flex-row">
                                <div class="row-icon">
                                        <i class="uil uil-cloud"></i>
                                </div>
                                <div class="row-text">Rainy Cloud </div>
                        </div>
                </div>
                <div class="flex-column card" style="align-items: flex-start;">
                        <h2>Overall-Strategy</h2>
                <div class="overall-strategy ">
                        
                        <div class="box box-1">
                                <h3>Air Quality</h3>
                                <canvas id="labelChart"></canvas>
                                <div class="values">7.90</div>
                        </div>
                        <div class="box box-2">
                                <h3>Humidity</h3>
                                <canvas id="scatterChart"></canvas>
                                <div class="values">03</div>
                        </div>
                        <div class="box box-3">
                                <h3>Temperature</h3>
                                <canvas id="lineChart"></canvas>
                                <div class="values">42 deg</div>
                        </div>
                </div>
                </div>
                
                <div class="temperature-detailed card">
                        <div class="head-text flex-row start">
                                <h3>Past-Forecast</h3>
                        </div>
                        <div class="flex-row temp-details">
                                <img src="/public/images/tem-icon.png" alt="" class="icon">
                                <div class="temp_value">35</div>
                                <div class="date">today</div>
                                <div class="time">24.00</div>
                        </div>
                        <div class="flex-row temp-details">
                                <img src="/public/images/tem-icon.png" alt="" class="icon">
                                <div class="temp_value">35</div>
                                <div class="date">today</div>
                                <div class="time">24.00</div>
                        </div>
                        <div class="flex-row temp-details">
                                <img src="/public/images/tem-icon.png" alt="" class="icon">
                                <div class="temp_value">35</div>
                                <div class="date">today</div>
                                <div class="time">24.00</div>
                        </div>
                        <div class="flex-row temp-details">
                                <img src="/public/images/tem-icon.png" alt="" class="icon">
                                <div class="temp_value">35</div>
                                <div class="date">today</div>
                                <div class="time">24.00</div>
                        </div>
                        <div class="flex-row temp-details">
                                <img src="/public/images/tem-icon.png" alt="" class="icon">
                                <div class="temp_value">35</div>
                                <div class="date">today</div>
                                <div class="time">24.00</div>
                        </div>
                        <div class="flex-row temp-details">
                                <img src="/public/images/tem-icon.png" alt="" class="icon">
                                <div class="temp_value">35</div>
                                <div class="date">today</div>
                                <div class="time">24.00</div>
                        </div>
                </div>
                <div class="flex-column card" style="align-items: flex-start;">
                        <h2>Air Quality</h2>
                        <div class="air-quality">
                                <div class="quality">
                                        <div class="heading">Co</div>
                                        <div class="value">23</div>
                                </div>
                                <div class="quality">
                                        <div class="heading">Co</div>
                                        <div class="value">23</div>
                                </div>
                                <div class="quality">
                                        <div class="heading">Co</div>
                                        <div class="value">23</div>
                                </div>
                                <div class="quality">
                                        <div class="heading">Co</div>
                                        <div class="value">23</div>
                                </div>
                                <div class="quality">
                                        <div class="heading">Co</div>
                                        <div class="value">23</div>
                                </div>
                                <div class="quality">
                                        <div class="heading">Co</div>
                                        <div class="value">23</div>
                                </div>
                        </div>
                </div>
        </div>
       <script src="/resources/views/ṣcript.js"></script>
</body>

</html>