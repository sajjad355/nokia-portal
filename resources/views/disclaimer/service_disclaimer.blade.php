@extends('layouts.dashboard.dash')
@section('title', 'Disclaimer')

@push('css')

@endpush
@section('content')

<div class="container-fluid">

    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header text-center">
                    <h2>Disclaimer</h2>
                </div>
                <div class="body">
                    <ol style="line-height: 3; font-size: 16px;">
                        <li>I understand the privacy of customer data and I understand my responsibility of keeping customer data secure.</li>
                        <li>I shall not use or disclose any customer data and privacy to any one</li>
                        <li>Image is taken in front of me. Any attempt to fraudulent activity shall nullify claim</li>
                        <li>I shall comply with the image specification (IMEI showing in the screen – where possible before and after servicing.</li>
                    </ol><br><br><br>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                            <form class="form-horizontal" action="{{ url('chk_service_disclaimer')}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-lg waves-effect">Accept</button>
                            </form>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush