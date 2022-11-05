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
                             <span style="color:red">* </span>{{ $title }} <span style="font-size:12px">(New password will be expired after 180 days)</span>

                    </h2>
                </div>
                @if (\Session::has('msg'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('msg') !!}</li>
                    </ul>
                </div>
                @endif
                <div class="body">
                    <label for="required_field" class="control-label"></label><i> required field</i>
                    <form class="form-horizontal" action="{{ route('change_password.store')}}" method="POST" onsubmit="return validateForm()"> 
                        @csrf
                        <div class="row{{ $errors->has('current_password') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                                <label for="current_password" class="control-label">Current Password </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Enter current password" autocomplete="current-password">
                                    </div>
                                </div>
                                @if ($errors->has('current_password'))
                                <span class="help-block">{{ $errors->first('current_password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('password') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                                <label for="password" class="control-label">New Password </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password" autocomplete="current-password">
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                                <label for="confirm_new_password" class="control-label">Confirm New Password </label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Enter confirm new password" required autocomplete="current-password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix text-center">
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Change Password</button>
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