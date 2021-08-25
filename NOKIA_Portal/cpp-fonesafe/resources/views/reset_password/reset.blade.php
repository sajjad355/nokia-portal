@extends('layouts.app')

@section('title', $title)

@push('css')

@endpush

@section('content')

<style>
    .btn-info {
        background-color: #124191 !important;
        border-color: #124191 !important;
    }

    .btn-primary {
        background-color: #001135 !important;
        border-color: #001135 !important;
    }
</style>

<div class="limiter">
    <div class="container-login100">
        @if (session('msg'))
        <div class="alert alert-success">
            <strong>Done!</strong> {{ session('msg')}}
        </div>
        @endif
        <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
            <form class="login100-form validate-form" method="POST" action="{{ route('password_reset') }}">
                <span class="login100-form-title p-b-55">
                    {{ $title }}
                </span>
                @csrf
                <div class="wrap-input100 validate-input m-b-16 text-center">
                    <span>User ID: {{ $userInfo['username'] }}</span>
                </div>

                <span><i class="text-info"><i class="fa fa-info-circle" aria-hidden="true"></i> By click on the below button you will receive a new password via SMS in your registered phone number.</i></span>
                <input type="hidden" name="username" value="{{ $userInfo['username'] }}">
                <input type="hidden" name="mobile_number" value="{{ $userInfo['contact_number'] }}">
                <div class="container-login100-form-btn p-t-25">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                        <button class="btn btn-info" type="submit">Reset Password</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush