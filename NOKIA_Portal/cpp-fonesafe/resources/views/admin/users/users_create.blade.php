@extends('layouts.dashboard.dash')
@section('title','User Create')
@push('css')

@endpush

@section('content')

<style>
    .control-label:after {
        content: "*";
        color: red;
    }

    .btn-group.bootstrap-select .dropdown-menu.open {
        overflow: unset !important;
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
                    <label for="required_field" class="control-label"></label><i> required field</i>
                    <form class="form-horizontal" action="{{ route('users.store') }}" method="POST" onsubmit="return validateForm()">
                        @csrf
                        <div class="row{{ $errors->has('name') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="name" class="control-label">Name </label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="name" id="name" value="{{ Request::old('name') ?: '' }}" class="form-control" placeholder="Enter role name">
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
                                        <input type="text" name="username" id="username" value="{{ Request::old('username') ?: '' }}" class="form-control" placeholder="Enter username">
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
                                        <input type="email" name="email" id="email" value="{{ Request::old('email') ?: '' }}" class="form-control" placeholder="Enter E-mail">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row{{ $errors->has('password') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="password" class="control-label">Password </label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" name="password" id="password" class="form-control" value="{{ Request::old('password') ?: '' }}" placeholder="Enter password" autocomplete="new-password">
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="confirm_password" class="control-label">Confirm Password </label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" name="password_confirmation" id="password-confirm" class="form-control" placeholder="Re-enter password" autocomplete="new-password">
                                    </div>
                                </div>
                                @if ($errors->has('confirm_password'))
                                <span class="help-block">{{ $errors->first('confirm_password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('store_id') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="store_id" class="control-label">Store </label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="demo-checkbox">
                                        <select class="form-control selectpicker" data-live-search="true" id="store_id" name="store_id">
                                            <option value="">Select One</option>
                                            @if(count($stores))
                                            @foreach($stores as $store)
                                            <option value="{{$store->id}}" @if (old('store_id')=="$store->id" ) {{ 'selected' }} @endif>{{$store->store_name}}</option>
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
                                            <option value="{{$row->id}}" @if (old('role_id')=="$row->id" ) {{ 'selected' }} @endif>{{$row->display_name}}</option>
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
                                <a href="{{route('users.index')}}"><button type="button" class="btn btn-primary m-t-15 waves-effect">
                                        << Back</button> </a> </div> <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Create</button>
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
      function validateForm() {
        
        var password = $("#password").val();
        if (password == "" || password == null) {
            alert("Please enter password");
            return false;
        } else if (!password.match("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})")) {
            alert("Password contains at least 1 lowercase alphabetical character, 1 uppercase alphabetical character, 1 numeric character and length must be eight characters or longer");
            return false;
        }
        return true;
      }
</script>

@endsection

@push('js')

@endpush