@extends('layouts.dashboard.dash')
@section('title', $title)
@push('css')

@endpush

@section('content')
<style>
    .glyphicon.glyphicon-plus-sign {
        font-size: inherit !important;
    }

    .glyphicon.glyphicon-minus-sign {
        font-size: inherit !important;
    }

    .control-label:after {
        content: "*";
        color: red;
    }

    .btn-group.bootstrap-select .dropdown-menu.open {
        overflow: unset !important;
    }

    .input-group-handset-front-image {
        width: 100%;
        margin-bottom: 0px;
    }

    .input-group-handset-back-image {
        width: 100%;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #124191 !important;
    }
</style>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                @foreach($outlet_name as $name)
                <h2 class="text-center">{{ $name->store_name }}</h2>
                @endforeach
            </div>
            <br>
            @if($errors->get('fs_code') ? 'has-error' : '')
            <div class="alert alert-danger">
                @foreach($errors->get('fs_code') as $error)
                <span class="help-block" style="color:white;">{{ $error }}</span>
                @endforeach
            </div>
            @endif
            <!-- @if ($message = Session::get('invalidOtpMsg'))
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {{ $message }}</em></div>
            @endif -->
            <div class="row clearfix">
                <h4 class="text-center">{{ $title }}</h4>
                <br><br>
                <p class="text-center">OTP: {{ $otp ?? '' }}</p>
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12"></div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <form class="form-horizontal" action="{{ route('search_by_phone') }}" method="POST" onsubmit="return validateMobileNumber();">
                        @csrf
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 text-right">
                            <label for="phone_number" style="margin-top: 6px;">Mobile Number :</label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 {{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <input type="text" name="phone_number" id="mobile" value="{{ $phone_number }}" class="form-control" readonly>
                            <div class="col-md-12 text-center">
                                @if ($errors->has('phone_number'))
                                <span class="help-block">{{ $errors->first('phone_number') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12"></div>
            </div>
            <hr>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12"></div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <form class="form-horizontal" action="{{ route('verify_otp') }}" method="POST" onsubmit="return validateOtp();">
                        @csrf
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 text-right">
                            <label for="otp" style="margin-top: 6px;">OTP :</label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 {{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <input type="text" name="otp" id="otp" maxlength="4" class="form-control" placeholder="Enter 4 digit OTP">
                            <div class="col-md-12 text-center">
                                @if ($errors->has('otp'))
                                <span class="help-block">{{ $errors->first('otp') }}</span>
                                @endif
                            </div>
                        </div>
                        <input type="hidden" name="phone_number" id="mobile" value="{{ $phone_number }}">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <button type="submit" class="btn bg-green waves-effect btn-sm btn-block">Verify</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12"></div>
            </div>
            <br>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12"></div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 text-center">
                    <div id="timeout">Time left = <span id="timer"></span></div>
                    <!-- <p>OTP will expire within 3 minutes</p> -->
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12"></div>
            </div>
            <hr>
            <br><br><br>
        </div>
    </div>
</div>

<script>
    function validateOtp() {
        // Validate OTP
        var otp = $("#otp").val();
        if (otp == "" || otp == null) {
            alert("Please enter OTP");
            return false;
        } else if (otp.length != 4) {
            alert("OTP must have 4 digits");
            return false;
        }
        return true;
    }

    function validateMobileNumber() {
        // Validate mobile number
        var mobile = $("#mobile").val();
        if (mobile == "" || mobile == null) {
            alert("Please enter mobile number");
            return false;
        } else if (mobile.length != 11) {
            alert("Invalid number; must be 11 digits");
            return false;
        }

        return true;
    }

    let timerOn = true;

    function timer(remaining) {
        var m = Math.floor(remaining / 60);
        var s = remaining % 60;

        m = m < 10 ? '0' + m : m;
        s = s < 10 ? '0' + s : s;
        document.getElementById('timer').innerHTML = m + ':' + s;
        remaining -= 1;

        if (remaining >= 0 && timerOn) {
            setTimeout(function() {
                timer(remaining);
            }, 1000);
            return;
        }

        if (!timerOn) {
            // Do validate stuff here
            return;
        }

        // Do timeout stuff here
        // alert('Timeout for otp');
    }

    timer(180);
</script>

@endsection

@push('js')

@endpush