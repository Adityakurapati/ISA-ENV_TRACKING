<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<title>Environment Health Monitor</title>
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>

<div class="container">

    <h1>Relative Values</h1>
  <div class="row">

    <div class="col-md-4">
      <div class="card rounded-circle">
        <div class="icon">
          <i class="uil uil-wind"></i>
        </div>
        <div class="card-content">
          <h2>Air Quality</h2>
          <div class="value">25°C</div>
          <div class="label">Ambient Temperature</div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card rounded-circle">
        <div class="icon">
          <i class="uil uil-thermometer"></i>
        </div>
        <div class="card-content">
          <h2>Temperature</h2>
          <div class="value">25°C</div>
          <div class="label">Ambient Temperature</div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card rounded-circle">
        <div class="icon">
                <i class="uil uil-raindrops-alt"></i>
        </div>
        <div class="card-content">
          <h2>Humidity</h2>
          <div class="value">25°C</div>
          <div class="label">Ambient Temperature</div>
        </div>
      </div>
    </div>
  </div> <!-- End of first row -->

  <h1>Absolute Values</h1>
  <div class="row">
    <div class="col-md-4">
      <div class="card  rounded-circle">
        <canvas id="barChart"></canvas>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <canvas id="labelChart"></canvas>
      </div>
    </div>
  </div> <!-- End of second row -->

  <div class="blur"></div>
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <canvas id="scatterChart"></canvas>
      </div>
    </div>
    <!-- Add another col-md-6 here if you want to display another chart -->
  </div> <!-- End of third row -->

</div> <!-- End of container -->

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Include Chart.js plugin for datalabels -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>


// Scatter CHart
var ctxSc = document.getElementById('scatterChart').getContext('2d');
  var scatterData = {
    datasets: [{
      borderColor: 'rgba(99,0,125, .2)',
      backgroundColor: 'rgba(99,0,125, .5)',
      label: 'V(node2)',
      data: [{
        x: 1,
        y: -1.711e-2,
      }, {
        x: 1.26,
        y: -2.708e-2,
      }, {
        x: 1.58,
        y: -4.285e-2,
      }, {
        x: 2.0,
        y: -6.772e-2,
      }, {
        x: 2.51,
        y: -1.068e-1,
      }, {
        x: 3.16,
        y: -1.681e-1,
      }, {
        x: 3.98,
        y: -2.635e-1,
      }, {
        x: 5.01,
        y: -4.106e-1,
      }, {
        x: 6.31,
        y: -6.339e-1,
      }, {
        x: 7.94,
        y: -9.659e-1,
      }, {
        x: 10.00,
        y: -1.445,
      }, {
        x: 12.6,
        y: -2.110,
      }, {
        x: 15.8,
        y: -2.992,
      }, {
        x: 20.0,
        y: -4.102,
      }, {
        x: 25.1,
        y: -5.429,
      }, {
        x: 31.6,
        y: -6.944,
      }, {
        x: 39.8,
        y: -8.607,
      }, {
        x: 50.1,
        y: -1.038e1,
      }, {
        x: 63.1,
        y: -1.223e1,
      }, {
        x: 79.4,
        y: -1.413e1,
      }, {
        x: 100.00,
        y: -1.607e1,
      }, {
        x: 126,
        y: -1.803e1,
      }, {
        x: 158,
        y: -2e1,
      }, {
        x: 200,
        y: -2.199e1,
      }, {
        x: 251,
        y: -2.398e1,
      }, {
        x: 316,
        y: -2.597e1,
      }, {
        x: 398,
        y: -2.797e1,
      }, {
        x: 501,
        y: -2.996e1,
      }, {
        x: 631,
        y: -3.196e1,
      }, {
        x: 794,
        y: -3.396e1,
      }, {
        x: 1000,
        y: -3.596e1,
      }]
    }]
  }

  var config1 = new Chart(ctxSc, {
    type: 'scatter',
    data: scatterData,
    options: {
      title: {
        display: true,
        text: 'Scatter Chart - Logarithmic X-Axis'
      },
      scales: {
        xAxes: [{
          type: 'logarithmic',
          position: 'bottom',
          ticks: {
            userCallback: function (tick) {
              var remain = tick / (Math.pow(10, Math.floor(Chart.helpers.log10(tick))));
              if (remain === 1 || remain === 2 || remain === 5) {
                return tick.toString() + 'Hz';
              }
              return '';
            },
          },
          scaleLabel: {
            labelString: 'Frequency',
            display: true,
          }
        }],
        yAxes: [{
          type: 'linear',
          ticks: {
            userCallback: function (tick) {
              return tick.toString() + 'dB';
            }
          },
          scaleLabel: {
            labelString: 'Voltage',
            display: true
          }
        }]
      }
    }
  });
</script>

</body>
</html>
