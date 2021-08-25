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
            @if ($message = Session::get('invalidOtpMsg'))
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {{ $message }}</em></div>
            @endif
            <div class="row clearfix">
                <h4 class="text-center">{{ $title }}</h4>
                <br><br>
                <!-- <p class="text-center">OTP: {{ $otp ?? '' }}</p> -->
                <p class="text-center">Customer Number: {{ $mobile_number ?? '' }}</p>
            </div>
            <hr>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12"></div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <form class="form-horizontal" action="{{ route('otpVerify') }}" method="POST" onsubmit="return validateOtp();">
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
                        <input type="hidden" name="phone_number" id="mobile" value="{{ $mobile_number }}">
                        <input type="hidden" name="imei" value="{{ $imei }}">
                        <input type="hidden" name="model" value="{{ $model }}">
                        <input type="hidden" name="service_type" value="{{ $service_type }}">
                        <input type="hidden" name="first_verify_request" value="{{ $verify_request }}">
                        <input type="hidden" name="fs_code" value="{{ $fscode }}">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            @if($verify_request>=2)
                            <button type="submit" id="verify_otp" class="btn bg-green waves-effect btn-sm btn-block" disabled>Verify</button>
                            @else
                            <button type="submit" class="btn bg-green waves-effect btn-sm btn-block">Verify</button>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12"></div>
            </div>
            <br>
            <div class="row clearfix">
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12"></div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 text-center">
                    @if($verify_request>=3)
                    <!-- <p>New OTP will expire within 3 minutes</p><br> -->
                    <form action="{{ route('submit_without_otp') }}" method="POST">
                        @csrf
                        <input type="hidden" name="phone_number" id="mobile" value="{{ $mobile_number }}">
                        <input type="hidden" name="imei" value="{{ $imei }}">
                        <input type="hidden" name="model" value="{{ $model }}">
                        <input type="hidden" name="first_verify_request" value="{{ $verify_request }}">
                        <input type="hidden" name="fs_code" value="{{ $fscode }}">
                        <button type="submit" class="btn bg-green waves-effect btn-lg" id="without_otp">Submit without OTP</button>
                    </form>
                    @else
                    <div id="timeout">Time left = <span id="timer"></span></div>
                    @endif
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12"></div>
            </div>
            <hr>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12"></div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn bg-green waves-effect btn-sm btn-block" id="btnonOtp" style="display: none;">Resend OTP</button>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12"></div>
            <hr>
            <br><br><br>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        // resend OTP
        $('#btnonOtp').click(function() {
            var mobile = $('#mobile').val()
            // console.log(value);
            $.ajax({
                type: 'post',
                url: '{{route("resend_otp")}}',
                data: {
                    _token: CSRF_TOKEN,
                    mobile: mobile
                },
                dataType: 'JSON',
                success: function(data) {
                    // console.log(data);
                    if (data != null) {
                        $('#btnonOtp').attr('disabled', 'disabled');
                        $('#verify_otp').removeAttr('disabled');
                    }
                }
            });
        });

        // $("#without_otp").click(function() {
        //     window.location.href = "{{URL::to('submit_without_otp')}}"
        // });

    });


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
        document.getElementById('btnonOtp').style.display = "block";
    }

    timer(180);
</script>

@endsection

@push('js')

@endpush