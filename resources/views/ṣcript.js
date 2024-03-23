
// labelChart -->

var ctxP=document.getElementById( "labelChart" ).getContext( '2d' );
var myPieChart=new Chart( ctxP, {
        plugins: [ ChartDataLabels ],
        type: 'pie',
        data: {
                labels: [ "Red", "Green", "Yellow", "Grey", "Dark Grey" ],
                datasets: [ {
                        data: [ 210, 130, 120, 160, 120 ],
                        backgroundColor: [ "#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360" ],
                        hoverBackgroundColor: [ "#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774" ]
                } ]
        },
        options: {
                responsive: true,
                legend: {
                        position: 'right',
                        labels: {
                                padding: 20,
                                boxWidth: 10
                        }
                },
                plugins: {
                        datalabels: {
                                formatter: ( value, ctx ) =>
                                {
                                        let sum=0;
                                        let dataArr=ctx.chart.data.datasets[ 0 ].data;
                                        dataArr.map( data =>
                                        {
                                                sum+=data;
                                        } );
                                        let percentage=( value*100/sum ).toFixed( 2 )+"%";
                                        return percentage;
                                },
                                color: 'white',
                                labels: {
                                        title: {
                                                font: {
                                                        size: '16'
                                                }
                                        }
                                }
                        }
                }
        }
} );

// Scatter Plot
var ctx=document.getElementById( 'scatterChart' ).getContext( '2d' );
var scatterChart=new Chart( ctx, {
        type: 'scatter',
        data: {
                datasets: [ {
                        label: 'Scatter Dataset',
                        data: [ { x: 1, y: 1 }, { x: 2, y: 3 }, { x: 3, y: 2 }, { x: 4, y: 4 } ]
                } ]
        },
        options: {
                scales: {
                        x: {
                                type: 'linear',
                                position: 'bottom'
                        },
                        y: {
                                type: 'linear',
                                position: 'left'
                        }
                }
        }
} );

//Line Chart
//line
var ctxL=document.getElementById( "lineChart" ).getContext( '2d' );
var myLineChart=new Chart( ctxL, {
        type: 'line',
        data: {
                labels: [ "January", "February", "March", "April", "May", "June", "July" ],
                datasets: [ {
                        label: "My First dataset",
                        data: [ 65, 59, 80, 81, 56, 55, 40 ],
                        backgroundColor: [
                                'rgba(105, 0, 132, .2)',
                        ],
                        borderColor: [
                                'rgba(200, 99, 132, .7)',
                        ],
                        borderWidth: 2
                },
                {
                        label: "My Second dataset",
                        data: [ 28, 48, 40, 19, 86, 27, 90 ],
                        backgroundColor: [
                                'rgba(0, 137, 132, .2)',
                        ],
                        borderColor: [
                                'rgba(0, 10, 130, .7)',
                        ],
                        borderWidth: 2
                }
                ]
        },
        options: {
                responsive: true
        }
} );
