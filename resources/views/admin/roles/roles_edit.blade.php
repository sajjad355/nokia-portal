@extends('layouts.dashboard.dash')
@section('title',$title)

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
                    <form class="form-horizontal" action="{{ route('roles.update', $roles->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row{{ $errors->has('role_name') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="role_name">Role Name</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="role_name" id="role_name" value="{{ $roles->name }}" class="form-control" placeholder="Enter role name">
                                    </div>
                                </div>
                                @if ($errors->has('role_name'))
                                <span class="help-block">{{ $errors->first('role_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('display_name') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="display_name">Display Name</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="display_name" id="display_name" value="{{ $roles->display_name }}" class="form-control" placeholder="Enter display name">
                                    </div>
                                </div>
                                @if ($errors->has('display_name'))
                                <span class="help-block">{{ $errors->first('display_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('description') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="description">Description</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="description" id="description" class="form-control" value="{{ $roles->description }}" placeholder="Enter description">
                                    </div>
                                </div>
                                @if ($errors->has('description'))
                                <span class="help-block">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <a href="{{route('roles.index')}}"><button type="button" class="btn btn-primary m-t-15 waves-effect">
                                        << Back</button> </a> </div> <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
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