@extends('layouts.dashboard.dash')
@section('title',$title)
@push('css')

@endpush

@section('content')

<style>
    .btn-group.bootstrap-select .dropdown-menu.open {
        overflow: unset !important;
    }
</style>

<!-- Basic Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{$title}}
                </h2>
            </div>
            <br>
            @if (session('msg'))
            <div class="alert alert-warning">
                <strong>{{ session('msg')}}</strong>
            </div>
            @endif
            <div class="row clearfix">
                <form class="form-horizontal" action="{{ route('store_wise_report') }}" method="POST">
                    @csrf
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label for="storeName">Store Name :</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 {{ $errors->has('store') ? ' has-error' : '' }}">
                            <select class="form-control selectpicker" name="store" data-live-search="true">
                                <option value="">Select Store Name</option>
                                @if(isset($store_id))
                                @foreach ($outlets as $item)
                                <option value="{{ $item->id }}" {{$item->id == $store_id ? 'selected="selected"' : ''}}>{{$item->store_name}}</option>
                                @endforeach
                                @else
                                @foreach ($outlets as $item)
                                <option value="{{ $item->id }}">{{$item->store_name}}</option>
                                @endforeach
                                @endif
                            </select>
                            @if ($errors->has('store'))
                            <span class="help-block">{{ $errors->first('store') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <h2 class="card-inside-title"> Date Range</h2>
                            <div class="input-daterange input-group" id="datepicker" data-provide="datepicker">
                                <div class="form-line" id="datepicker-container">
                                    <?php if (isset($from_date)) { ?>
                                        <input type="text" name="from_date" value="{{ date('d-m-Y', strtotime($from_date)) }}" class="form-control" placeholder="Date start..." autocomplete="off">
                                    <?php } else { ?>
                                        <input type="text" name="from_date" class="form-control" placeholder="Date start..." autocomplete="off">
                                    <?php } ?>

                                </div>
                                <span class="input-group-addon">to</span>
                                <div class="form-line" id="datepicker-container">
                                    <?php if (isset($to_date)) { ?>
                                        <input type="text" name="to_date" value="{{ date('d-m-Y', strtotime($to_date)) }}" class="form-control" placeholder="Date end..." autocomplete="off">
                                    <?php } else { ?>
                                        <input type="text" name="to_date" class="form-control" placeholder="Date end..." autocomplete="off">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div>
                                <h2 class="card-inside-title">&nbsp;</h2>
                            </div>
                            <div>
                                <button type="submit" class="btn bg-green waves-effect">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <br>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tier</th>
                                <th>Sold</th>
                                <th>Available</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Tier</th>
                                <th>Sold</th>
                                <th>Available</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @isset($results)
                            <?php $i = 1; ?>
                            @foreach($results as $row)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ str_replace($row['tier'], "", "Tier") }} {{ $i-1 }}</td>
                                @if(isset($row['sold']))
                                <td>{{ $row['sold'] }}</td>
                                @else
                                <td>0</td>
                                @endif
                                <td>{{ $row['available'] }}</td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="graph_container">
                            <canvas id="Chart1" height="220"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- #END# Basic Table -->
<?php if (isset($sold_bar) || isset($available_bar)) { ?>
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

<?php } ?>

@endsection

@push('js')

@endpush