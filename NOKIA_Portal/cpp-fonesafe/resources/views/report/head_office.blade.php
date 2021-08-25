@extends('layouts.dashboard.dash')
@section('title', $title)
@push('css')

@endpush

@section('content')

<style>
    figure {
        margin: 0 auto;
        max-width: 1100px;
        position: relative;
    }

    .graphic {
        padding-left: 30px;
    }

    .row {
        margin-bottom: 1.5em;
    }

    @keyframes expand {
        from {
            width: 0%;
        }

        to {
            width: 100%;
        }
    }

    @media screen and (min-width: 768px) {
        @keyframes expand {
            from {
                width: 0%;
            }

            to {
                width: calc(100% - 75px);
            }
        }
    }

    .chart {
        overflow: hidden;
        width: 0%;
        animation: expand 1.5s ease forwards;
    }

    .row+.row .chart {
        animation-delay: .2s;
    }

    .row+.row+.row .chart {
        animation-delay: .4s;
    }

    .block {
        display: block;
        height: 100px;
        color: #fff;
        font-size: .75em;
        float: left;
        background-color: #334D5C;
        position: relative;
        overflow: hidden;
        opacity: 1;
        transition: opacity, .3s ease;
        cursor: pointer;
    }

    .block:nth-of-type(2),
    .legend li:nth-of-type(2):before {
        background-color: #45B29D;
    }

    .block:nth-of-type(3),
    .legend li:nth-of-type(3):before {
        background-color: #EFC94C;
    }

    .block:nth-of-type(4),
    .legend li:nth-of-type(4):before {
        background-color: #E27A3F;
    }

    .block:nth-of-type(5),
    .legend li:nth-of-type(5):before {
        background-color: #DF5A49;
    }

    .block:nth-of-type(6),
    .legend li:nth-of-type(6):before {
        background-color: #962D3E;
    }

    .block:hover {
        opacity: .65;
    }

    .value {
        display: block;
        line-height: 1em;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%);
    }

    .x-axis {
        text-align: center;
        padding: .5em 0 2em;
    }

    .y-axis {
        height: 20px;
        transform: translate(-32px, 170px) rotate(270deg);
        position: absolute;
        left: 0;
    }

    .legend {
        margin: 0 auto;
        padding: 0;
        font-size: .9em;
    }

    .legend li {
        display: inline-block;
        padding: .25em 1em;
        line-height: 1em;
    }

    .legend li:before {
        content: "";
        margin-right: .5em;
        display: inline-block;
        width: 8px;
        height: 8px;
        background-color: #334D5C;
    }

    @media screen and (min-width: 768px) {
        h6 {
            padding: 0;
            width: 75px;
            float: left;
            line-height: 100px;
        }

        .block {
            font-size: 1em;
        }

        .legend {
            width: 50%;
        }
    }
</style>

<!-- Basic Table -->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
        <div class="header">
            <i class="glyphicon glyphicon-dashboard"></i><span> {{ $title }}</span>
        </div>
        <br>
        <div class="row clearfix">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <h3 class="text-center">{{ $headline }}</h3>
                <div class="body table-responsive text-center">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="info">
                                <th class="text-center">Sold</th>
                                <th class="text-center">Count</th>
                                <th class="text-center">Available</th>
                                <th class="text-center">Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @isset($results)
                            @foreach($results as $row)
                            <tr>
                                <td>{{ str_replace($row['tier'], "", "Tier") }} {{ $i++ }}</td>
                                @if(isset($row['sold']))
                                <td>{{ $row['sold'] }}</td>
                                @else
                                <td>0</td>
                                @endif
                                <td>{{ str_replace($row['tier'], "", "Tier") }} {{ $i-1 }}</td>
                                <td>{{ $row['available'] }}</td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <br><br><br><br>
                <div class="graph_container">
                    <canvas id="Chart1" height="220"></canvas>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>
</div>
<!-- #END# Basic Table -->

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script> -->
<script src="{{asset('assets/dashboard/plugins/chartjs/Chart.js')}}"></script>

<script>
    var barOptions_stacked = {
        tooltips: {
            enabled: true,
        },
        hover: {
            animationDuration: 0
        },
        scales: {
            xAxes: [{
                ticks: {
                    mirror: true,
                    beginAtZero: true,
                    fontFamily: "'Open Sans Bold', sans-serif",
                    fontSize: 12
                },
                scaleLabel: {
                    display: true
                },
                gridLines: {},
                stacked: true
            }],
            yAxes: [{
                gridLines: {
                    display: false,
                    color: "#fff",
                    zeroLineColor: "#fff",
                    zeroLineWidth: 0
                },
                ticks: {
                    fontFamily: "'Open Sans Bold', sans-serif",
                    fontSize: 12
                },
                stacked: true
            }]
        },
        legend: {
            display: true,
            position: 'top',
            align: 'center'
        },

        animation: {
            duration: 1500,
            easing: "easeInOutQuart",
            onComplete: function() {
                var chartInstance = this.chart;
                var ctx = chartInstance.ctx;
                ctx.textAlign = "left";
                ctx.font = "9px Open Sans";
                ctx.fillStyle = "#000000";

                Chart.helpers.each(this.data.datasets.forEach(function(dataset, i) {
                    var meta = chartInstance.controller.getDatasetMeta(i);
                    Chart.helpers.each(meta.data.forEach(function(bar, index) {
                        data = dataset.label + ' - ' + dataset.data[index];
                        if (i == 0) {
                            ctx.fillText(data, 50, bar._model.y + 4);
                        } else {
                            ctx.fillText(data, bar._model.x - 100, bar._model.y + 4);
                        }
                    }), this)
                }), this);
            }
        },
        pointLabelFontFamily: "Quadon Extra Bold",
        scaleFontFamily: "Quadon Extra Bold",
    };

    var ctx = document.getElementById("Chart1");
    var available = <?php echo $available_bar; ?>;
    var sold = <?php echo $sold_bar; ?>;
    // console.log(available);
    var tier = [];
    var available_fs = [];
    var sold_fs = [];

    for (var i in available) {
        tier.push(available[i].label);
        available_fs.push(available[i].y);
    }

    for (var j in sold) {
        if (sold[j].y != null) {
            sold_fs.push(+sold[j].y);
        } else {
            sold_fs.push("0");
        }
    }

    // console.log(sold_fs);

    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: tier,

            datasets: [{
                label: 'Sold',
                data: sold_fs,
                backgroundColor: "yellow",
                hoverBackgroundColor: "rgba(50,90,100,1)"
            }, {
                label: 'In hand',
                data: available_fs,
                backgroundColor: "#8fbf8e",
                hoverBackgroundColor: "rgba(140,85,100,1)"
            }]
        },

        options: barOptions_stacked,
    });
</script>

@endsection

@push('js')

@endpush