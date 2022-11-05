@extends('layouts.dashboard.dash')
@section('title', $title)
@push('css')

@endpush
@section('content')

<style>
    .btn-group.bootstrap-select .dropdown-menu.open {
        overflow: unset !important;
    }

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
                    <form class="form-horizontal" action="{{ route('tiers.store')}}" method="POST">
                        @csrf
                        <div class="row{{ $errors->has('tier') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="tier" class="control-label">Tier </label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="tier" id="tier" class="form-control" value="{{ Request::old('tier') ?: '' }}" placeholder="ex-T1">
                                    </div>
                                </div>
                                @if ($errors->has('tier'))
                                <span class="help-block">{{ $errors->first('tier') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                        <div class="row{{ $errors->has('price_range_start') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="price_range_start" class="control-label">Price Range Start&nbsp;&nbsp;<img src="{{ asset('assets/taka.png') }}" width="10" height="12"> </label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" name="price_range_start" id="price_range_start" value="{{ Request::old('price_range_start') ?: '' }}" class="form-control" placeholder="ex-5000">
                                    </div>
                                </div>
                                @if ($errors->has('price_range_start'))
                                <span class="help-block">{{ $errors->first('price_range_start') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                        <div class="row{{ $errors->has('price_range_end') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="price_range_end" class="control-label">Price Range End&nbsp;&nbsp;<img src="{{ asset('assets/taka.png') }}" width="10" height="12"> </label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" name="price_range_end" id="price_range_end" class="form-control" value="{{ Request::old('price_range_end') ?: '' }}" placeholder="ex-10000">
                                    </div>
                                </div>
                                @if ($errors->has('price_range_end'))
                                <span class="help-block">{{ $errors->first('price_range_end') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-2"></div>
                        </div>

                        <!-- <div class="row{{ $errors->has('service_type') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="service_type" class="control-label">Service Type </label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="demo-checkbox">
                                        <select name="service_type" class="form-control selectpicker" data-live-search="true" id="service_type">
                                            <option value="">Select One</option>
                                            <option value="Accidental Screen Damage" @if (old('service_type')=="Accidental Screen Damage" ) {{ 'selected' }} @endif>Accidental Screen Damage</option>
                                            <option value="1 Year Extended Warranty" @if (old('service_type')=="1 Year Extended Warranty" ) {{ 'selected' }} @endif>1 Year Extended Warranty</option>
                                            <option value="Both Service" @if (old('service_type')=="Both Service" ) {{ 'selected' }} @endif>Both Service</option>
                                        </select>
                                    </div>
                                </div>
                                @if ($errors->has('service_type'))
                                <span class="help-block">{{ $errors->first('service_type') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-2"></div>
                        </div>

                        <div class="row{{ $errors->has('mrp') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="mrp" class="control-label">MRP&nbsp;&nbsp;<img src="{{ asset('assets/taka.png') }}" width="10" height="12"> </label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" name="mrp" id="mrp" class="form-control" value="{{ Request::old('mrp') ?: '' }}" placeholder="ex-599">
                                    </div>
                                </div>
                                @if ($errors->has('mrp'))
                                <span class="help-block">{{ $errors->first('mrp') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-2"></div>
                        </div>

                        <div class="row{{ $errors->has('commission') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-5 form-control-label">
                                <label for="commission" class="control-label">Commission&nbsp;&nbsp;<img src="{{ asset('assets/taka.png') }}" width="10" height="12"> </label>
                            </div>
                            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" name="commission" id="commission" class="form-control" value="{{ Request::old('commission') ?: '' }}" placeholder="ex-125">
                                    </div>
                                </div>
                                @if ($errors->has('commission'))
                                <span class="help-block">{{ $errors->first('commission') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-2"></div>
                        </div> -->
                        <br>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-2 col-xs-2">
                                <a href="{{route('tiers.index')}}"><button type="button" class="btn btn-primary m-t-15 waves-effect">
                                        << Back</button> </a> </div> <div class="col-lg-8 col-md-8 col-sm-10 col-xs-10">
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                            </div>
                        </div>
                    </form>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush