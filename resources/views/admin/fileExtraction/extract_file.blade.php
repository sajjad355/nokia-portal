@extends('layouts.dashboard.dash')
@section('title', $title)
@push('css')

@endpush

@section('content')

<!-- Basic Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{ $title }}
                </h2>
            </div>
            <br>
            @if ($message = Session::get('msg'))
            <div class="alert alert-info"><span class="glyphicon glyphicon-ok"></span><em> {{ $message }}</em></div>
            @endif
            <div class="row clearfix">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                </div>
                <form class="form-horizontal" action="{{ route('file_extraction') }}" method="POST">
                    @csrf
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                        <h2 class="card-inside-title">Range</h2>
                        <div class="input-daterange input-group" id="datepicker" data-provide="datepicker">
                            <div class="form-line" id="datepicker-container">
                                <?php if (isset($from_date)) { ?>
                                    <input type="text" name="from_date" value="{{ date('d-m-Y', strtotime($from_date)) }}" class="form-control" placeholder="Date start..." autocomplete="off">
                                <?php } else { ?>
                                    <input type="text" name="from_date" class="form-control" placeholder="Date start..." autocomplete="off" required>
                                <?php } ?>
                            </div>
                            <span class="input-group-addon">to</span>
                            <div class="form-line" id="datepicker-container">
                                <?php if (isset($to_date)) { ?>
                                    <input type="text" name="to_date" value="{{ date('d-m-Y', strtotime($to_date)) }}" class="form-control" placeholder="Date end..." autocomplete="off">
                                <?php } else { ?>
                                    <input type="text" name="to_date" class="form-control" placeholder="Date end..." autocomplete="off" required>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div>
                            <h2 class="card-inside-title">&nbsp;</h2>
                        </div>
                        <div>
                            <button type="submit" class="btn bg-green waves-effect">Extract</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- #END# Basic Table -->
@endsection

@push('js')

@endpush