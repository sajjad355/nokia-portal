@extends('layouts.dashboard.dash')
@section('title','Sales List')

@push('css')

@endpush

@section('content')

<style>
    .fa.fa-bars {
        font-size: inherit !important;
    }

    .fa.fa-pencil-square-o {
        font-size: inherit !important;
    }

    .fa.fa-trash-o {
        font-size: inherit !important;
    }

    .control-label::before {
        content: "*";
        color: red;
    }
</style>

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
                    <!-- @role('servicepoint')
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <a href="{{route('sales.create')}}"><button type="button" class="btn bg-green waves-effect">Add New</button></a>
                    </div>
                    @endrole -->
                </div>
            </div>
            @if (session('successMsg'))
            <div class="alert alert-success">
                <strong>Well done!</strong> {{ session('successMsg')}}
            </div>
            @endif
            <br>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-6">
                        <p style="color: #009688;" class="control-label"> Select date range to filter</p>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                </div>
                <form class="form-horizontal" action="{{ route('sales_report') }}" method="POST">
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
                <div class="table-responsive ">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <!-- <th>Store Code</th> -->
                                <th>Store Name</th>
                                <th>Service Type</th>
                                <th>IMEI</th>
                                <!-- <th>Brand</th> -->
                                <th>Model</th>
                                <th>Price</th>
                                <th>Mobile</th>
                                <!-- <th>Gender</th> -->
                                <!-- <th>Customer Name</th> -->
                                <!-- <th>District</th>
                                <th>FS Code</th> -->
                                <th>CPP Price</th>

 
                                <th>Nokia Safeguard MRP</th>
                                <!-- <th>Device Purchase Date</th> -->
                                <th>Sale Date</th>
                                <!-- <th>OTP Verification Status</th> -->
                                <!-- <th>Verified By</th> -->
                                @role(['supadmin', 'callcenter'])
                                <th>Action</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($sales_info as $sale)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <!-- <td>{{ $sale->store_code}}</td> -->
                                <td>{{ $sale->store_name}}</td>
                                <td>{{ $sale->service_type}}</td>
                                <td>{{ $sale->imei}}</td>
                                <!-- <td>{{ $sale->brand}}</td> -->
                                <td>{{ $sale->model}}</td>
                                <td>{{ $sale->price}}</td>
                                <td>{{ $sale->mobile}}</td>
                                <td>{{ $sale->cpp_price}}</td>

                                <!-- @if($sale->gender=='M')
                                <td>Male</td>
                                @else
                                <td>Female</td>
                                @endif -->
                                <!-- <td>{{ $sale->title}}&nbsp;&nbsp;{{ $sale->customer_name}}</td> -->
                                <!-- <td>{{ $sale->district}}</td>
                                <td>{{ $sale->fs_code}}</td> -->
                                @if($sale->fs_mrp != null)
                                <td><img src="{{ asset('assets/taka.png') }}" width="8" height="10">&nbsp;&nbsp;{{ $sale->fs_mrp}}</td>
                                @else
                                <td><img src="{{ asset('assets/taka.png') }}" width="8" height="10">&nbsp;&nbsp;0</td>
                                @endif
                                <!-- <td>{{$sale->device_purchase_date}}</td> -->
                                <td>{{ Carbon\Carbon::parse($sale->created_at)->isoformat('M/D/YYYY, h:mm:ss a') }}</td>
                                <!-- @if($sale->is_verified==0)
                                <td style="color: red;">Not Veified</td>
                                @else
                                <td style="color: green;">Verified</td>
                                @endif -->
                                
                                @role('callcenter')
                                <td>
                                @if($sale->is_verified==0)
                                    <form action="{{route('sale_verification', ['id'=>$sale->id])}}" method="POST" style="display: block;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Verify Sale</button>
                                    </form>
                                    <br>
                                    @endif
                                </td>
                                @endrole
                                @role('supadmin')
                                <td>
                                    @if($sale->is_verified==0)
                                    <form action="{{route('sale_verification', ['id'=>$sale->id])}}" method="POST" style="display: block;">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Verify Sale</button>
                                    </form>
                                    <br>
                                    @endif

                                    <!-- <a class="btn btn-defauld" href="{{route('sales.show', $sale->id)}}"><i class="fa fa-bars" aria-hidden="true" title="view"></i></a> -->

                                    <!-- &nbsp;&nbsp;
                                    <a class="btn btn-primary" href="{{route('sales.edit', $sale->id)}}"><i class="fa fa-pencil-square-o " aria-hidden="true" title="edit"></i></a> -->
                                    <form action="{{route('sales.destroy', $sale->id)}}" method="POST" id="delete-form-{{$sale->id}}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button class="btn btn-danger"><a onclick="if(confirm('Are you sure?')){
                                event.preventDefault();
                            document.getElementById('delete-form-{{$sale->id}}').submit();
                            }else{
                                event.preventDefault();
                            }"><i class="fa fa-trash-o " style="color:white" aria-hidden="true" type="submit" title="delete"></i></a></button>

                                </td>
                                @endrole
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