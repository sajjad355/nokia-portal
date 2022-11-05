@extends('layouts.dashboard.dash')

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
                @if ($message = Session::get('status'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="body">
                    <form class="form-horizontal" action="{{ route('import.store')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row{{ $errors->has('store_code') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                                {{-- <label for="store_code">Store Code</label> --}}
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                <div class="form-group">
                                    {{-- <div class="form-line"> --}}
                                    <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="customFile" name="upload_code">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                                @if ($errors->has('store_code'))
                                <span class="help-block">{{ $errors->first('store_code') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <a href="{{route('import.index')}}"><button type="button"
                                        class="btn btn-primary m-t-15 waves-effect">
                                        << Back</button> </a> </div> <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                            <button type="submit"
                                                class="btn btn-primary m-t-15 waves-effect">Upload</button>
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