@extends('layouts.dashboard.dash')
@section('title','User Edit')
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
                    @foreach ($users as $user)
                    <label for="required_field" class="control-label"></label><i> required field</i>
                    <form class="form-horizontal" action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row{{ $errors->has('name') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="name" class="control-label">Name </label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="name" id="name"
                                            value="{{ $user->name }}" class="form-control"
                                            placeholder="Enter name">
                                    </div>
                                </div>
                                @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('username') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="username" class="control-label">Username </label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="username" id="username"
                                            value="{{ $user->username }}" class="form-control"
                                            placeholder="Enter username">
                                    </div>
                                </div>
                                @if ($errors->has('username'))
                                <span class="help-block">{{ $errors->first('username') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email">E-mail</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="email" name="email" id="email" class="form-control"
                                            value="{{ $user->email }}"
                                            placeholder="Enter email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row{{ $errors->has('store_id') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="store_id" class="control-label">Store </label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="demo-checkbox">
                                        <select class="form-control" id="store_id" name="store_id">
                                            <option value="">Select One</option>
                                            @if(count($stores))
                                            @foreach($stores as $store)
                                            <option value="{{$store->id}}" {{$store->id == $user->store_id ? 'selected="selected"' : ''}}>{{$store->store_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('store_id'))
                                        <span class="help-block">{{ $errors->first('store_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row{{ $errors->has('role_id') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="role_id" class="control-label">Role </label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="demo-checkbox">
                                        <select class="form-control" id="role_id" name="role_id">
                                            <option value="">Select One</option>
                                            @if(count($roles))
                                            @foreach($roles as $row)
                                            <option value="{{$row->id}}" {{$row->id == $user->role_id ? 'selected="selected"' : ''}}>{{$row->display_name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('role_id'))
                                        <span class="help-block">{{ $errors->first('role_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <a href="{{route('users.index')}}"><button type="button" class="btn btn-primary m-t-15 waves-effect"> << Back</button></a>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush