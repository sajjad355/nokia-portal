@extends('layouts.dashboard.dash')
@section('title',$title)

@push('css')

@endpush

@section('content')

<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <div class="row ">
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <h2>
                            {{ $title }}
                        </h2>
                    </div>
                </div>
            </div>
            <br>
            <div class="row clearfix">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                </div>
                <form class="form-horizontal" action="{{ route('sales_report') }}" method="POST">
                    @csrf
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                        <h2 class="card-inside-title">Range</h2>
                        <div class="input-daterange input-group" id="datepicker" data-provide="datepicker">
                            <div class="form-line">
                                <?php if (isset($from_date)) { ?>
                                    <input type="text" name="from_date" value="{{ date('d-m-Y', strtotime($from_date)) }}" class="form-control" placeholder="Date start..." autocomplete="off">
                                <?php } else { ?>
                                    <input type="text" name="from_date" class="form-control" placeholder="Date start..." autocomplete="off">
                                <?php } ?>

                            </div>
                            <span class="input-group-addon">to</span>
                            <div class="form-line">
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
                </form>
            </div>
            <div class="body">
                <div class="table-responsive ">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <!-- <th>Store Code</th> -->
                                <th>Store Name</th>
                                <th>Service Type</th>
                                <th>IMEI</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Price</th>
                                <!-- <th>Gender</th> -->
                                <!-- <th>Customer Name</th> -->
                                <th>District</th>
                                <th>FS Code</th>
                                <th>FS MRP(including VAT)</th>
                                <th>device purchase Date</th>
                                <th>Sale Date</th>
                                <th>OTP Verification Status</th>
                                <!-- <th>Verified By</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($search_results as $sale)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <!-- <td>{{ $sale->store_code}}</td> -->
                                <td>{{ $sale->store_name}}</td>
                                <td>{{ $sale->service_type}}</td>
                                <td>{{ $sale->imei}}</td>
                                <td>{{ $sale->brand}}</td>
                                <td>{{ $sale->model}}</td>
                                <td>{{ $sale->price}}</td>
                                <!-- @if($sale->gender=='M')
                                <td>Male</td>
                                @else
                                <td>Female</td>
                                @endif -->
                                <!-- <td>{{ $sale->title}}&nbsp;&nbsp;{{ $sale->customer_name}}</td> -->
                                <td>{{ $sale->district}}</td>
                                <td>{{ $sale->fs_code}}</td>
                                @if($sale->fs_mrp != null)
                                <td><img src="{{ asset('assets/taka.png') }}" width="8" height="10">&nbsp;&nbsp;{{ $sale->fs_mrp}}</td>
                                @else
                                <td><img src="{{ asset('assets/taka.png') }}" width="8" height="10">&nbsp;&nbsp;0</td>
                                @endif
                                <td>{{ $sale->device_purchase_date }}</td>
                                <td>{{ Carbon\Carbon::parse($sale->created_at)->isoformat('M/D/YYYY, h:mm:ss a') }}</td>
                                @if($sale->is_verified==0)
                                <td style="color: red;">Not Veified</td>
                                @else
                                <td style="color: green;">Verified</td>
                                @endif
                                
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Exportable Table -->
@endsection

@push('js')

@endpush