@extends('layouts.dashboard.dash')
@section('title', $title)
@push('css')

@endpush

@section('content')

<style>
    .control-label::before {
        content: "*";
        color: red;
    }
</style>

<!-- Basic Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{ $title }}
                </h2>
            </div>
            <br>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-6">
                        <p style="color: #009688;" class="control-label"> Please select date range before search</p>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                </div>
                <form class="form-horizontal" action="{{ route('date_wise_reaport') }}" method="POST">
                    @csrf
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                        <h2 class="card-inside-title">Range</h2>
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
                </form>
            </div>
            <div class="body">
                <div class="table-responsive">
                    @isset($search_results)
                    @if ($search_results!=null)
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Store Code</th>
                                <th>Store Type</th>
                                <th>Store Name</th>
                                <th>Service Type</th>
                                <th>IMEI</th>
                                <!-- <th>Brand</th> -->
                                <th>Model</th>
                                <th>Price</th>
                                <th>Payment Status</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>District</th>
                                <!-- <th>Gender</th> -->
                                <!-- <th>Customer Name</th> -->
                                <!-- <th>District</th>
                                <th>FS Code</th> -->
                                <th>CPP Price</th>

 
                                <th>Nokia Safeguard MRP</th>
                                <th>Sales Person</th>
                                <!-- <th>Device Purchase Date</th> -->
                                <th>Sale Date</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Store Code</th>
                                <th>Store Type</th>
                                <th>Store Name</th>
                                <th>Service Type</th>
                                <th>IMEI</th>
                                <!-- <th>Brand</th> -->
                                <th>Model</th>
                                <th>Price</th>
                                <th>Payment Status</th>
                                <th>Mobile</th>
                                <!-- <th>Gender</th> -->
                                <!-- <th>Customer Name</th> -->
                                <th>Address</th>
                                <th>District</th>

                                <!-- <th>FS Code</th> -->
                                <th>CPP Price</th>

 
                                <th>Nokia Safeguard MRP</th>
                                <th>Sales Person</th>

                                <!-- <th>Device Purchase Date</th> -->
                                <th>Sale Date</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($search_results as $row)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $row->store_code }}</td>
                                @if($row->display_name == 'Sales Center')
                                <td>SALES</td>
                                @else
                                <td>SERVICE</td>
                                @endif
                                <td>{{ $row->store_name}}</td>
                                <td>{{ $row->service_type}}</td>
                                <td>{{ $row->imei}}</td>
                                <td>{{ $row->model}}</td>
                                <td>{{ $row->price}}</td>
                                <td>{{ $row->status}}</td>

                                <td>{{ $row->mobile}}</td>
                                <td>{{ $row->address}}</td>
                                <td>{{ $row->district}}</td>

                                <td>{{ $row->cpp_price}}</td>
                                @if($row->fs_mrp != null)
                                <td><img src="{{ asset('assets/taka.png') }}" width="8" height="10">&nbsp;&nbsp;{{ $row->fs_mrp}}</td>
                                @else
                                <td><img src="{{ asset('assets/taka.png') }}" width="8" height="10">&nbsp;&nbsp;0</td>
                                @endif
                                <td>{{ $row->customer_name}}</td>
                                <td>{{ Carbon\Carbon::parse($row->created_at)->isoformat('M/D/YYYY, h:mm:ss a') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-center"><strong>No record found for this date range</strong></div>
                    <div class="col-md-4"></div>
                    @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Basic Table -->
@endsection

@push('js')

@endpush