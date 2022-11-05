@extends('layouts.app')

@section('title','Login')

@push('css')

@endpush

@section('content')

<style>
    .btn {
        line-height: 2.9 !important;
        border-radius: unset !important;
        background-color: #e6e6e6 !important;
        border: unset !important;
        transition: unset !important;
    }
    .btn-outline-secondary.focus, .btn-outline-secondary:focus{
        box-shadow: unset !important;
    }
    .input100{
        border-radius: unset !important;
    }
</style>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                <span class="login100-form-title p-b-55">
                    Login
                </span>
                @csrf
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

                <div class="wrap-input100 validate-input m-b-16">
                    <input class="input100 @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" id="password" autocomplete="current-password" data-toggle="password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <span class="lnr lnr-lock"></span>
                    </span>

                    @error('password')
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

                <div class="contact100-form-checkbox m-l-4">
                    <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                    <label class="label-checkbox100" for="ckb1">
                        Remember me
                    </label>
                </div>

                <div class="container-login100-form-btn p-t-25">
                    <button type="submit" class="login100-form-btn">
                        Login
                    </button>
                </div>

                <div class="container-login100-form-btn p-t-25">
                    <a href="{{ route('resetPassword') }}">Forgot Your Password?</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    localStorage.clear();
</script>


@endsection

@push('js')

@endpush