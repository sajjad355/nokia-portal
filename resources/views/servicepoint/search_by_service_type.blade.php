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
</style>

<!-- Basic Table -->
<?php
$selected_service_type = '';
if (isset($search_results) && $search_results != null) {
    foreach ($search_results as $result) {
        $selected_service_type = $result->service_type;
    }
}
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                @foreach($outlet_name as $name)
                <h2 class="text-center">{{ $name->store_name }}</h2>
                @endforeach
            </div>
            <br>
            <div class="row clearfix">
                <h4 class="text-center">{{ $title }}</h4>
                <br><br>
                <div class="row clearfix">
                    <div class="col-lg-12 c0l-md-12 c0l-sm-12 col-xs-12">
                        <form class="form-horizontal" action="{{ route('search_by_service_type') }}" method="POST" onsubmit="return validateServiceType();">
                            @csrf
                            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 text-right">
                                <label for="service_type">Search By Service Type :</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <div class="demo-checkbox">
                                        <select name="service_type" class="form-control selectpicker" data-live-search="true" id="service_type">
                                            <option value="">Select One</option>
                                            <option value="Accidental Screen Damage" {{$selected_service_type == "Accidental Screen Damage" ? 'selected="selected"' : ''}}>Accidental Screen Damage</option>
                                            <option value="1 Year Extended Warranty" {{$selected_service_type == "1 Year Extended Warranty" ? 'selected="selected"' : ''}}>1 Year Extended Warranty</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <button type="submit" class="btn bg-green waves-effect btn-sm btn-block">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <br><br>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <form class="form-horizontal" action="{{ route('search') }}" method="POST" onsubmit="return validateImeiNumber();">
                        @csrf
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 text-right">
                            <label for="imei_number">Search By IMEI :</label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 {{ $errors->has('imei_number') ? ' has-error' : '' }}">
                            <input type="text" name="imei_number" id="imei" class="form-control" placeholder="Enter 15 digit IMEI number">
                            <div class="col-md-12 text-center">
                                @if ($errors->has('imei_number'))
                                <span class="help-block">{{ $errors->first('imei_number') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <button type="submit" class="btn bg-green waves-effect btn-sm btn-block">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <form class="form-horizontal" action="{{ route('search_by_phone') }}" method="POST" onsubmit="return validateMobileNumber();">
                        @csrf
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 text-right">
                            <label for="phone_number">Search By Mobile No. :</label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 {{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <input type="text" name="phone_number" id="mobile" value="" class="form-control" placeholder="Enter 11 digit mobile number">
                            <div class="col-md-12 text-center">
                                @if ($errors->has('phone_number'))
                                <span class="help-block">{{ $errors->first('phone_number') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <button type="submit" class="btn bg-green waves-effect btn-sm btn-block">Search</button>
                        </div>
                    </form>
                </div>
            </div>

            <hr>
            @isset($search_results)
            <div class="body table-responsive">
                @if ($search_results->count() > 0)
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service Type</th>
                                <th>IMEI</th>
                                <th>Model</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($search_results as $result)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $result->service_type }}</td>
                                <td>{{ $result->imei }}</td>
                                <td>{{ $result->model }}</td>
                                <td>{{ $result->price }}</td>
                                <td>
                                    <form action="{{route('search')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="imei_number" value="{{ $result->imei }}">
                                        <button type="submit" class="btn bg-green waves-effect btn-sm btn-block">Details</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-2"></div>
                @else
                <div class="col-md-4"></div>
                <div class="col-md-4 text-center"><strong>No record found for this service type</strong></div>
                <div class="col-md-4"></div>
                @endif
            </div>
            @endisset
        </div>
    </div>
</div>

<script>
    function validateImeiNumber() {
        // Validate IMEI Number
        var imei = $("#imei").val();
        if (imei == "" || imei == null) {
            alert("Please enter 15 digits IMEI number");
            return false;
        } else if (imei.length != 15) {
            alert("IMEI number must have 15 digits");
            return false;
        }
        return true;
    }

    function validateServiceType() {
        //Validate service type
        var service_type = $("#service_type").val();
        if (service_type == "" || service_type == null) {
            alert("Please select one service type");
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
</script>

@endsection

@push('js')

@endpush