@extends('layouts.dashboard.dash')
@section('title', $title)
@push('css')

@endpush
@section('content')
<div class="container-fluid">

    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
            <div class="card">
                <div class="header">
                    <h2>
                        Details
                    </h2>
                </div>
                @foreach($fscodes as $data)
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Fscode :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$data['fscode']}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Tier :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$data['tier']}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Status :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            @if($data['status']==1)
                            <strong style="color: green;">Available</strong>
                            @elseif($data['status']==2)
                            <strong style="color: red;">Disable</strong>
                            @else
                            <strong style="color: greenyellow;">Sold</strong>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Used By :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            @if($data['sale_by']=='0')
                            None
                            @else
                            {{$data['sale_by']}}
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Sale/Use Date :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            @if($data['sale_date']=='None')
                            {{ $data['sale_date'] }}
                            @else
                            {{\Carbon\Carbon::parse($data['sale_date'])->format('M d Y')}}
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Uploaded At :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{\Carbon\Carbon::parse($data['created_at'])->format('M d Y')}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Updated At :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{\Carbon\Carbon::parse($data['updated_at'])->format('M d Y')}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <a href="{{route('txtimport.index')}}"><button type="button" class="btn btn-primary m-t-15 waves-effect">
                                    << Back</button> </a> </div> </div> </div> @endforeach </div> </div> </div> </div> @endsection @push('js') @endpush