@extends('layouts.dashboard.dash')
@section('title', $title)
@push('css')

@endpush
@section('content')

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
                    <form class="form-horizontal" action="{{ route('txtimport.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row{{ $errors->has('fscode') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="fscode">Fscode</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="fscode" id="fscode"
                                            value="{{ $data->fscode }}" class="form-control"
                                            placeholder="Enter Fscode">
                                    </div>
                                </div>
                                @if ($errors->has('fscode'))
                                <span class="help-block">{{ $errors->first('fscode') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('tier') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="tier">Tier</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="tier" id="tier"
                                            value="{{ $data->tier }}" class="form-control"
                                            placeholder="Enter Tier">
                                    </div>
                                </div>
                                @if ($errors->has('tier'))
                                <span class="help-block">{{ $errors->first('tier') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('status') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="status">Status</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="demo-checkbox">
                                        <select class="form-control" id="status" name="status">
                                            <option value="">Select One</option>
                                            <option value="1" {{$data->status == 1 ? 'selected="selected"' : ''}}>Available</option>
                                            <option value="2" {{$data->status == 2 ? 'selected="selected"' : ''}}>Disable</option>
                                            <option value="3" {{$data->status == 3 ? 'selected="selected"' : ''}}>Sold</option>
                                        </select>
                                        @if ($errors->has('status'))
                                        <span class="help-block">{{ $errors->first('status') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <a href="{{route('txtimport.index')}}"><button type="button" class="btn btn-primary m-t-15 waves-effect"> << Back</button></a>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
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