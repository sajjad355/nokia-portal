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
                        <li>I am solely accountable for whatever data (IMEI, Date, Model) and Image (Invoice, Phone) is given</li>
                        <li>I shall comply with the image specification</li>
                    </ol>
                    <br><br><br>
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                            <form class="form-horizontal" action="{{ url('chk_disclaimer')}}" method="POST">
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