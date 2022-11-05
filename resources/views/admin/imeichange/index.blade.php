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
</style>

<!-- Basic Table -->
<?php
$imei = '';
if (isset($search_results) && $search_results != null) {
    $imei = $search_results->imei;
}
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                @foreach($outlet_name as $name)
                {{ $name->store_name }}
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
            @if ($message = Session::get('msg'))
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {{ $message }}</em></div>
            @endif
            @if ($message = Session::get('msg_warning'))
            <div class="alert alert-warning"><span class="glyphicon glyphicon-cross"></span><em> {{ $message }}</em></div>
            @endif
            <div class="row clearfix">
                <h4 class="text-center">{{ $title }}</h4>
                <br>
                <form class="form-horizontal" action="{{ route('imeidetail') }}" method="POST">
                    @csrf
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">

                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-right">
                        <label for="imei_number" style="margin-top:8px;">Search IMEI :</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 {{ $errors->has('imei_number') ? ' has-error' : '' }}">
                        <input type="text" name="imei_number" id="" value="<?= $imei; ?>" class="form-control" placeholder="Enter 15 digits IMEI number">
                        <div class="col-md-12 text-center">
                            @if ($errors->has('imei_number'))
                            <span class="help-block">{{ $errors->first('imei_number') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-1 col-sm-1 col-xs-1">
                        <button type="submit" class="btn bg-green waves-effect btn-sm btn-block">Search</button>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">

                    </div>
                </form>
            </div>

            <hr>
            @isset($search_results)
            <div class="body table-responsive">
                @if ($search_results!=null)
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <form class="form-horizontal" id="form_validation" action="{{ route('imeichange.update', $search_results->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Model</th>
                                    <td><input type="text" class="form-control" name="model" value="{{ $search_results->model }}" readonly></td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td><input type="text" value="{{ $search_results->price }}" class="form-control" name="price" readonly></td>
                                </tr>
                                <tr>
                                    <th>FS Code</th>
                                    <td><input type="text" value="{{ $search_results->fs_code }}" class="form-control" name="fs_code" readonly></td>
                                </tr>
                                <tr>
                                    <th>Purchase Date</th>
                                    <td><input type="text" value="{{ Carbon\Carbon::parse($search_results->created_at)->format('d-M-Y') }}" class="form-control" name="purchase_date" readonly></td>
                                </tr>
                                <tr>
                                    <th>Days</th>
                                    @if ($days<'365') <td><label style="color: green;">{{ $days }} Days from
                                            purchase</label>
                                        </td>
                                        @else
                                        <td><label style="color: red;">{{ $days }} Days from purchase</label>
                                        </td>
                                        @endif
                                </tr>
                                <tr>
                                    <th><label class="control-label" for="new_imei">New IMEI</label></th>
                                    <td>
                                        <div class="control-group{{ $errors->has('new_imei') ? ' has-error' : '' }} clearfix">
                                            <input type="text" name="new_imei" id="new_imei" value="{{ Request::old('new_imei') ?: '' }}" placeholder="The imei number must be 15 digits." class="form-control" required pattern="[0-9]{15}">
                                            <input type="hidden" name="old_imei" value="{{ $search_results->imei }}">
                                        </div>
                                        @if ($errors->has('new_imei'))
                                        <span class="help-block">{{ $errors->first('new_imei') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><button type="submit" class="btn bg-green waves-effect btn-lg btn-block">Update IMEI</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="col-md-2"></div>
                @else
                <div class="col-md-4"></div>
                <div class="col-md-4 text-center"><strong>No record found</strong></div>
                <div class="col-md-4"></div>
                @endif
            </div>
            @endisset
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush