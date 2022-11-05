@extends('layouts.dashboard.dash')
@section('title', $title)
@push('css')

@endpush

@section('content')

<style>
    .control-label::before {
        content: "*";
        color: red;
    }
</style>

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
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-6">
                        <p style="color: #009688;" class="control-label"> Please select date</p>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                </div>
                <form class="form-horizontal" action="{{ route('date_wise_log_reaport') }}" method="POST" onsubmit="return validateForm();">
                    @csrf
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                        <h2 class="card-inside-title">Range</h2>
                        <div class="input-daterange input-group" id="datepicker" data-provide="datepicker">
                            <div class="form-line" id="datepicker-container">
                                <?php if (isset($from_date)) { ?>
                                    <input type="text" name="from_date" id="from_date" value="" class="form-control" placeholder="Date start..." autocomplete="off">
                                <?php } else { ?>
                                    <input type="text" name="from_date" class="form-control" id="from_date" placeholder="Date start..." autocomplete="off">
                                <?php } ?>

                            </div>
                            <div class="form-line" id="datepicker-container">

                         <select id="" name="log">
                         <option value="SMS_Log">SMS Log</option>
                         <option value="Search_Log">Search Log</option>

                         </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div>
                            <h2 class="card-inside-title">&nbsp;</h2>
                        </div>
                        <div>
                            <button type="submit" class="btn bg-green waves-effect">Search</button>
                        </div>
                    </div>
                </form>
</div>
                <p>
                @foreach ($logData as $search_results)
                       <p>{{ $search_results }}</p>     
                @endforeach
                </p>
                

            </div>
        </div>
    </div>
</div>
<!-- #END# Basic Table -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>

function validateForm() {

// Validate IMEI Number
var imei = $("#from_date").val();
if (imei == "" || imei == null) {
    alert("Please select date");
    return false;
}
}
</script>
@endsection

@push('js')

@endpush