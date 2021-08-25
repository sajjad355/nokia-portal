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
        <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">

            <form class="login100-form validate-form" method="POST" action="{{ route('getUser') }}">
                <span class="login100-form-title p-b-55">
                    {{ $title }}
                </span>
                @csrf
                @if (\Session::has('msg'))
                <div class="alert alert-info">
                    <ul>
                        <li>{!! \Session::get('msg') !!}</li>
                    </ul>
                </div>
                @endif
                <div class="wrap-input100 validate-input m-b-16">
                    <input class="input100 @error('username') is-invalid @enderror" type="text" placeholder="User Name" name="username" value="{{ old('username') }}">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <span class="lnr lnr-user"></span>
                    </span>
                    @error('username')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="wrap-input100 validate-input m-b-16 @error('g-recaptcha-response') is-invalid @enderror">
                    <div class="g-recaptcha" id="g-recaptcha" data-sitekey="{!! env('RECAPTCHA_SITE_KEY','NO-KEY-FOUND') !!}"></div>
                    @error('g-recaptcha-response')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="container-login100-form-btn p-t-25">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                        <button class="btn btn-info waves-effect" type="submit">Submit</button>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush