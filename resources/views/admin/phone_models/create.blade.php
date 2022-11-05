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
                    <form class="form-horizontal" action="{{ route('phone_models.store')}}" method="POST">
                        @csrf
                        <div class="row{{ $errors->has('brand_name') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="brand_name" class="control-label">Brand </label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="demo-checkbox">
                                        <select name="brand_name" class="form-control selectpicker" id="brand_name">
                                            <option value="">Select One</option>
                                            @foreach ($brands as $brand)
                                            <?php $value = $brand->brand_name; ?>
                                            <option value="{{ $brand->brand_name }}" @if (old('brand_name')==$value ) {{ 'selected' }} @endif>{{$brand->brand_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if ($errors->has('brand_name'))
                                <span class="help-block">{{ $errors->first('brand_name') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-2"></div>
                        </div>

                        <div class="row{{ $errors->has('brand_name') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="brand_name" class="control-label">Service Type </label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="demo-checkbox">
                                        <select name="service_type" class="form-control selectpicker" id="service_type">
                                            <option value="">Select One</option>
                                            @foreach ($services as $service)
                                            <?php $value = $service->service_type; ?>
                                            <option value="{{ $service->service_type }}">{{$service->service_type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if ($errors->has('service_type'))
                                <span class="help-block">{{ $errors->first('service_type') }}</span>
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
                                        <input type="text" name="model_name" id="model_name" class="form-control" value="{{ Request::old('model_name') ?: '' }}" placeholder="ex-P30">
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
                                <label for="fs_mrp" class="control-label">Device Price&nbsp;<img src="{{ asset('assets/taka.png') }}" width="8" height="10"> </label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" name="device_price" id="device_price" class="form-control" value="{{ Request::old('device_price') ?: '' }}" placeholder="ex-1590">
                                    </div>
                                </div>
                                @if ($errors->has('device_price'))
                                <span class="help-block">{{ $errors->first('device_price') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-2"></div>
                        </div>

                        <div class="row{{ $errors->has('fs_mrp') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="fs_mrp" class="control-label">CPP Price&nbsp;<img src="{{ asset('assets/taka.png') }}" width="8" height="10"> </label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" name="Cpp_Price" id="Cpp_Price" class="form-control" value="{{ Request::old('Cpp_Price') ?: '' }}" placeholder="ex-1590">
                                    </div>
                                </div>
                                @if ($errors->has('Cpp_Price'))
                                <span class="help-block">{{ $errors->first('Cpp_Price') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-2"></div>
                        </div>

                        
                        
                        <div class="row{{ $errors->has('fs_mrp') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="fs_mrp" class="control-label">Nokia Safeguard MRP (Incl. Vat)&nbsp;<img src="{{ asset('assets/taka.png') }}" width="8" height="10"> </label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" name="fs_mrp" id="fs_mrp" class="form-control" value="{{ Request::old('fs_mrp') ?: '' }}" placeholder="ex-1590">
                                    </div>
                                </div>
                                @if ($errors->has('fs_mrp'))
                                <span class="help-block">{{ $errors->first('fs_mrp') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-2"></div>
                        </div>

                        <div class="row{{ $errors->has('mrp_ew') ? ' has-error' : '' }} clearfix" hidden>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="mrp_ew" class="control-label">MRP (Extended Warranty)&nbsp;<img src="{{ asset('assets/taka.png') }}" width="8" height="10"> </label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" name="mrp_ew" id="mrp_ew" class="form-control" value="1234" placeholder="ex-1590">
                                    </div>
                                </div>
                                @if ($errors->has('mrp_ew'))
                                <span class="help-block">{{ $errors->first('mrp_ew') }}</span>
                                @endif
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {         
            $('#model_name').on('change', function() {
            var model = $(this).val();
            var service = $("#service_type").val();
            if(service=="")
            {
                var model = $(this).val();
            }
            var merge= model+" - "+service;
            $('#model_name').val(merge);
            });

            $('#service_type').on('change', function() {
                $('#model_name').val("");
            var service = $(this).val();
            var model = $("#model_name").val();
            if(model=="")
            {
                var model = "";
            }
            else
            {
            var merge= model+" - "+service;
            $('#model_name').val(merge);
            }

            
            });
        });

</script>

@endsection

@push('js')

@endpush