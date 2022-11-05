@extends('layouts.dashboard.dash')
@section('title', $title)
@push('css')

@endpush
@section('content')

<style>
    .fa.fa-bars {
        font-size: inherit !important;
    }

    .fa.fa-pencil-square-o {
        font-size: inherit !important;
    }

    .fa.fa-trash-o {
        font-size: inherit !important;
    }
</style>

<div class="container-fluid">
    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row ">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <h2>
                                {{ $title }}
                            </h2>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <a href="{{ route('download_sample_bulk_user_creation') }}"><button type="button" class="btn bg-green waves-effect">Download Sample</button></a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('msg'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="alert alert-info" role="alert">
                    <ul>
                        <li><label for="info"> Must be a file of type: .txt</label></li>
                        <li><label for="info">File format must be text separated with pipe ( | )</label></li>
                    </ul>
                </div>
                <div class="body">
                    <form class="form-horizontal" action="{{ route('bulk_user')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row{{ $errors->has('upload_user') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label"></div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="margin-bottom: auto;">
                                <div class="form-group">
                                    <div class="control-group input-group panel panel-default">
                                        <input type="file" class="form-control" name="upload_user">
                                    </div>
                                </div>
                                @if ($errors->has('upload_user'))
                                <span class="help-block">{{ $errors->first('upload_user') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label"></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Upload</button>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
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