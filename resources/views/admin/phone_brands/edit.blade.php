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
                    <form class="form-horizontal" action="{{ route('phone_brands.update', $phone_brand->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                       
                        <div class="row{{ $errors->has('brand_name') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="brand_name" class="control-label">Brand </label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="brand_name" id="brand_name" class="form-control" value="{{ $phone_brand->brand_name }}" placeholder="ex-Apple">
                                    </div>
                                </div>
                                @if ($errors->has('brand_name'))
                                <span class="help-block">{{ $errors->first('brand_name') }}</span>
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
                                            <option value="1" {{$phone_brand->status == 1 ? 'selected="selected"' : ''}}>Available</option>
                                            <option value="2" {{$phone_brand->status == 2 ? 'selected="selected"' : ''}}>Disable</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-2 col-xs-2">
                                <a href="{{route('phone_brands.index')}}"><button type="button" class="btn btn-primary m-t-15 waves-effect">
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