@extends('layouts.dashboard.dash')
@section('title', $title)
@push('css')

@endpush
@section('content')

<style>
    .control-label:after {
        content: "*";
        color: red;
    }
</style>

<div class="container-fluid">
    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ $title }}
                    </h2>
                </div>
                <div class="body">
                    <div class="col-lg-10 col-lg-offset-2 col-md-12">
                        <label for="required_field" class="control-label"></label><i> required field</i>
                    </div>
                    <form class="form-horizontal" action="{{ route('phone_models.update', $phone_models->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                       
                        <div class="row{{ $errors->has('brand_name') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="brand_name" class="control-label">Brand </label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <select name="brand_name" class="form-control selectpicker" id="brand_name">
                                        <option value="">Select One</option>
                                        @foreach ($brands as $brand)
                                        <?php $value = $brand->brand_name; ?>
                                        <option value="{{ $brand->brand_name }}" @if ($phone_models->brand_name==$value ) {{ 'selected' }} @endif>{{$brand->brand_name}}</option>
                                        @endforeach
                                    </select>
                                    <!-- <div class="form-line">
                                        <input type="text" name="brand_name" id="brand_name" class="form-control" value="{{ $phone_models->brand_name }}" placeholder="ex-P30">
                                    </div> -->
                                </div>
                                @if ($errors->has('brand_name'))
                                <span class="help-block">{{ $errors->first('brand_name') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-2"></div>
                        </div>

                        <div class="row{{ $errors->has('model_name') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="model_name" class="control-label">Model </label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="model_name" id="model_name" class="form-control" value="{{ $phone_models->model_name }}" placeholder="ex-P30">
                                    </div>
                                </div>
                                @if ($errors->has('model_name'))
                                <span class="help-block">{{ $errors->first('model_name') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                        <div class="row{{ $errors->has('fs_mrp') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="fs_mrp" class="control-label">MRP (Screen Protection)&nbsp;<img src="{{ asset('assets/taka.png') }}" width="8" height="10"> </label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" name="fs_mrp" id="fs_mrp" class="form-control" value="{{ $phone_models->mrp }}" placeholder="ex-15990">
                                    </div>
                                </div>
                                @if ($errors->has('fs_mrp'))
                                <span class="help-block">{{ $errors->first('fs_mrp') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                        
                        <div class="row{{ $errors->has('mrp_ew') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="mrp_ew" class="control-label">MRP (Extended Warranty)&nbsp;<img src="{{ asset('assets/taka.png') }}" width="8" height="10"> </label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" name="mrp_ew" id="mrp_ew" class="form-control" value="{{ $phone_models->mrp_ew }}" placeholder="ex-15990">
                                    </div>
                                </div>
                                @if ($errors->has('mrp_ew'))
                                <span class="help-block">{{ $errors->first('mrp_ew') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-2"></div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="status">Status</label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="">
                                        <select class="form-control selectpicker" name="status" id="status">
                                            <option value="1" {{$phone_models->status == 1 ? 'selected="selected"' : ''}}>Available</option>
                                            <option value="2" {{$phone_models->status == 2 ? 'selected="selected"' : ''}}>Disable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-2 col-xs-2">
                                <a href="{{route('phone_models.index')}}"><button type="button" class="btn btn-primary m-t-15 waves-effect">
                                        << Back</button> </a> </div> <div class="col-lg-8 col-md-8 col-sm-10 col-xs-10">
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush