fetch( 'http://127.0.0.1:8000/fetch-air-quality' )
        .then( response => response.json() )
        .then( data =>
        {
                // Extract the air quality object from the received data
                var airQualityData=data.airQualities[ 0 ]; // Assuming there is only one air quality object in the array

                // Create an array of labels and values from the air quality data
                var labels=Object.keys( airQualityData );
                var values=Object.values( airQualityData );

                // Exclude the first and last two elements from the labels and values arrays
                labels=labels.slice( 1, -2 );
                values=values.slice( 1, -2 );

                // Update the chart with the new data
                var ctxD=document.getElementById( "doughnutChart" ).getContext( '2d' );
                var myDoughnutChart=new Chart( ctxD, {
                        type: 'doughnut',
                        data: {
                                labels: labels,
                                datasets: [ {
                                        data: values,
                                        backgroundColor: [ "#4A235A", "#0E6655", "#E67E22", "#2E4053" ], // Dark colors excluding the first and last two
                                        hoverBackgroundColor: [ "#78281F", "#117A65", "#D35400", "#34495E" ] // Dark hover colors excluding the first and last two
                                } ]
                        },
                        options: {
                                responsive: true
                        }
                } );
        } )
        .catch( error =>
        {
                console.error( 'Error fetching air quality data:', error );
        } );





//Line Chart   ====================================================
fetch( 'http://127.0.0.1:8000/fetch-humidity' )
        .then( response => response.json() )
        .then( data =>
        {
                const humidityData=data.humidityValues.map( entry => ( {
                        label: new Date( entry.created_at ).toLocaleDateString(), // Use date as label
                        value: parseFloat( entry.value ) // Use humidity value
                } ) );

                var ctxB=document.getElementById( "barChart" ).getContext( '2d' );
                var myBarChart=new Chart( ctxB, {
                        type: 'bar',
                        data: {
                                labels: humidityData.map( entry => entry.label ), // Use date as labels
                                datasets: [ {
                                        label: 'Humidity', // Set label for the dataset
                                        data: humidityData.map( entry => entry.value ), // Use humidity values as data
                                        backgroundColor: humidityData.map( entry =>
                                        {
                                                if ( entry.value<30 ) return 'rgba(255, 99, 132, 0.2)'; // Red for low humidity
                                                else if ( entry.value>=30&&entry.value<70 ) return 'rgba(255, 206, 86, 0.2)'; // Yellow for moderate humidity
                                                else return 'rgba(75, 192, 192, 0.2)'; // Green for high humidity
                                        } ),
                                        borderColor: humidityData.map( entry =>
                                        {
                                                if ( entry.value<30 ) return 'rgba(255,99,132,1)';
                                                else if ( entry.value>=30&&entry.value<70 ) return 'rgba(255, 206, 86, 1)';
                                                else return 'rgba(75, 192, 192, 1)';
                                        } ),
                                        borderWidth: 1
                                } ]
                        },
                        options: {
                                scales: {
                                        yAxes: [ {
                                                ticks: {
                                                        beginAtZero: true
                                                }
                                        } ]
                                }
                        }
                } );
        } )
        .catch( error =>
        {
                console.error( 'Error fetching humidity data:', error );
        } );


//Scatter  Chart   ====================================================
// Fetch temperature data from the provided endpoint
fetch( 'http://127.0.0.1:8000/fetch-temperature' )
        .then( response => response.json() )
        .then( data =>
        {
                // Convert fetched data into suitable format for the chart
                const temperatures=data.temperatureValue.map( entry => ( {
                        x: new Date( entry.created_at ), // Use the timestamp as x-axis value
                        y: parseFloat( entry.temp_value ), // Use temperature value as y-axis value
                        color: getColorForTemperature( parseFloat( entry.temp_value ) ) // Determine color based on temperature value
                } ) );

                // Define a function to determine color based on temperature value
                function getColorForTemperature ( temperature )
                {
                        if ( temperature<20 )
                        {
                                return 'rgba(0, 0, 255, 0.2)'; // Blue for safe temperature
                        } else if ( temperature>=20&&temperature<=30 )
                        {
                                return 'rgba(0, 255, 0, 0.2)'; // Green for neutral temperature
                        } else
                        {
                                return 'rgba(255, 0, 0, 0.2)'; // Red for hot temperature
                        }
                }

                // Update the chart configuration to use temperature data
                var ctxL=document.getElementById( "lineChart-temp" ).getContext( '2d' );
                var myLineChart=new Chart( ctxL, {
                        type: 'line',
                        data: {
                                labels: temperatures.map( entry => entry.x.toLocaleDateString() ), // Use date string as label
                                datasets: [ {
                                        label: "Temperature",
                                        data: temperatures,
                                        backgroundColor: temperatures.map( entry => entry.color ), // Set background color based on temperature
                                        borderColor: temperatures.map( entry => entry.color ), // Set border color based on temperature
                                        borderWidth: 2
                                } ]
                        },
                        options: {
                                responsive: true,
                                scales: {
                                        xAxes: [ {
                                                type: 'time', // Use time scale for x-axis
                                                time: {
                                                        unit: 'day', // Adjust time unit if needed
                                                        displayFormats: {
                                                                day: 'MMM D' // Display format for day
                                                        }
                                                },
                                                scaleLabel: {
                                                        labelString: 'Time',
                                                        display: true
                                                }
                                        } ],
                                        yAxes: [ {
                                                scaleLabel: {
                                                        labelString: 'Temperature',
                                                        display: true
                                                }
                                        } ]
                                }
                        }
                } );
        } )
        .catch( error =>
        {
                console.error( 'Error fetching temperature data:', error );
        } );






/*
Line Chart For Humidity

fetch( 'http://127.0.0.1:8000/fetch-humidity' )
        .then( response => response.json() )
        .then( data =>
        {
                const humidityData=data.humidityValues.map( entry => ( {
                        x: new Date( entry.updated_at )
                        , y: parseFloat( entry.value )
                } ) );

                // Update chart configuration to use humidity data
                var ctxL=document.getElementById( "lineChart" ).getContext( '2d' );
                var myLineChart=new Chart( ctxL, {
                        type: 'line'
                        , data: {
                                labels: humidityData.map( entry => entry.x.toLocaleDateString() ), // Use date string as label
                                datasets: [ {
                                        label: "Humidity"
                                        , data: humidityData
                                        , backgroundColor: 'rgba(105, 0, 132, .2)', // Dark background color
                                        borderColor: 'rgba(200, 99, 132, .7)', // Dark border color
                                        borderWidth: 2
                                } ]
                        }
                        , options: {
                                responsive: true
                        }
                } );
        } )
        .catch( error =>
        {
                console.error( 'Error fetching humidity data:', error );
        } );
*/






// fetch( 'http://127.0.0.1:8000/fetch-temperature' )
//         .then( response => response.json() )
//         .then( data =>
//         {
//                 const temperatures=data.temperatureValue.map( entry => ( {
//                         x: new Date( entry.created_at ).getTime(), // Use the timestamp as x-axis value
//                         y: parseFloat( entry.temp_value ) // Use temperature value as y-axis value
//                 } ) );

//                 var ctxSc=document.getElementById( 'scatterChart' ).getContext( '2d' );
//                 var scatterData={
//                         datasets: [ {
//                                 borderColor: 'rgba(99,0,125, .2)',
//                                 backgroundColor: 'rgba(99,0,125, .5)',
//                                 label: 'Temperature',
//                                 data: temperatures
//                         } ]
//                 };

//                 var config1=new Chart.Scatter( ctxSc, {
//                         data: scatterData,
//                         options: {
//                                 title: {
//                                         display: true,
//                                         text: 'Temperature Scatter Chart'
//                                 },
//                                 scales: {
//                                         xAxes: [ {
//                                                 type: 'time', // Use time scale for x-axis
//                                                 time: {
//                                                         displayFormats: {
//                                                                 millisecond: 'HH:mm:ss',
//                                                                 second: 'HH:mm:ss',
//                                                                 minute: 'HH:mm',
//                                                                 hour: 'HH:mm',
//                                                                 day: 'MMM D',
//                                                                 week: 'MMM D',
//                                                                 month: 'MMM YYYY',
//                                                                 quarter: '[Q]Q - YYYY',
//                                                                 year: 'YYYY'
//                                                         }
//                                                 },
//                                                 scaleLabel: {
//                                                         labelString: 'Time',
//                                                         display: true
//                                                 }
//                                         } ],
//                                         yAxes: [ {
//                                                 scaleLabel: {
//                                                         labelString: 'Temperature (°C)',
//                                                         display: true
//                                                 }
//                                         } ]
//                                 }
//                         }
//                 } );
//         } )
//         .catch( error =>
//         {
//                 console.error( 'Error fetching temperature data:', error );
//         } );
