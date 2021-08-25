@extends('layouts.dashboard.dash')
@section('title','Sale View')

@push('css')

@endpush
@section('content')
<div class="container-fluid">
    <!-- Widgets -->

    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Details
                    </h2>
                </div>
                <div class="body">
                    @foreach ($sales_info as $info)

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">Store Code :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">{{$info->store_code}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">Store Name :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">{{$info->store_name}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">Service Type :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">{{$info->service_type}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">IMEI :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">{{$info->imei}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">Brand :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">{{$info->brand}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">Model :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">{{$info->model}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">Price :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">{{$info->price}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">Gender :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            @if($info->gender=='M')
                            <label for="store_id">Male</label>
                            @else
                            <label for="store_id">Female</label>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">Customer Name :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">{{$info->title}}&nbsp;&nbsp;{{$info->customer_name}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">Date of Birth :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">{{$info->date_of_birth}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">Mobile No. :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">{{$info->mobile}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">E-mail :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">{{$info->email}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">District :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">{{$info->district}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">Address :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">{{$info->address}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">FS Code :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">{{$info->fs_code}}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">FS MRP(including VAT) :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            @if($info->fs_mrp != null)
                            <label for="store_id"><img src="{{ asset('assets/taka.png') }}" width="8" height="10">&nbsp;&nbsp;{{$info->fs_mrp}}</label>
                            @else
                            <label for="store_id"><img src="{{ asset('assets/taka.png') }}" width="8" height="10">&nbsp;&nbsp;0</label>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">Retailed Commission :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id"><img src="{{ asset('assets/taka.png') }}" width="8" height="10">&nbsp;&nbsp;{{ $info->retailed_commission }}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">Created At :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">{{ Carbon\Carbon::parse($info->created_at)->isoformat('M/D/YYYY, h:mm:ss a') }}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">Updated At :</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <label for="store_id">{{ Carbon\Carbon::parse($info->updated_at)->isoformat('M/D/YYYY, h:mm:ss a') }}</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">

                        </div>
                    </div>


                    <div class="row clearfix">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <a href="{{route('sales.index')}}"><button type="button" class="btn btn-primary m-t-15 waves-effect">
                                    << Back</button> </a> </div> </div> @endforeach </div> </div> </div> </div> </div> @endsection @push('js') @endpush