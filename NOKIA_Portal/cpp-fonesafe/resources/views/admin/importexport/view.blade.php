@extends('layouts.dashboard.dash')

@push('css')

@endpush
@section('content')
<div class="container-fluid">

    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="card">
                <div class="header">
                    <h2>
                        Details
                    </h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                           <strong>Column 1 :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$data->Variable_code}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Column 2 :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$data->Industry_aggregation_NZSIOC}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Column 3 :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$data->Industry_code_NZSIOC}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Column 4 :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$data->Industry_name_NZSIOC}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Column 5 :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$data->Units}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Column 6 :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$data->Year}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Column 7 :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$data->Variable_name}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Column 8 :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$data->Variable_category}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Column 9 :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$data->Value}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Column 10 :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$data->Industry_code_ANZSIC06}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Created At :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$data->created_at->format('M d Y')}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Updated At :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$data->updated_at->format('M d Y')}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <a href="{{route('import.index')}}"><button type="button" class="btn btn-primary m-t-15 waves-effect"> << Back</button></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush