@extends('layouts.dashboard.dash')
@section('title', $title)
@push('css')

@endpush
@section('content')
@foreach($phone_models as $value)
<div class="container-fluid">
    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ $title }}
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Brand :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$value->brand_name}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Model :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$value->model_name}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>MRP (Screen Protection):</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <img src="{{ asset('assets/taka.png') }}" width="8" height="10">&nbsp;{{$value->mrp}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>MRP (Extended Warranty):</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <img src="{{ asset('assets/taka.png') }}" width="8" height="10">&nbsp;{{$value->mrp_ew}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Status :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            @if($value->status == 1)
                            <p style="color: green;">Available</p>
                            @else
                            <p style="color: red;">Disable</p>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Added By :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$value->name}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Created At :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{ Carbon\Carbon::parse($value->created_at)->format('M d Y') }}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Updated At :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{ Carbon\Carbon::parse($value->updated_at)->format('M d Y') }}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <a href="{{route('phone_models.index')}}"><button type="button" class="btn btn-primary m-t-15 waves-effect">
                                    << Back</button> </a> </div> </div> </div> </div> </div> </div> </div> @endforeach @endsection @push('js') @endpush