@extends('layouts.dashboard.dash')
@section('title','Store Edit')

@push('css')

@endpush
@section('content')

<style>
    .control-label:after {
        content: "*";
        color: red;
    }

    .btn-group.bootstrap-select .dropdown-menu.open {
        overflow: unset !important;
    }
</style>

<div class="container-fluid">
    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ $title }}
                    </h2>
                </div>
                <div class="body">
                    <label for="required_field" class="control-label"></label><i> required field</i>
                    <form class="form-horizontal" action="{{ route('outlet.update', $outlet->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row{{ $errors->has('store_code') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="store_code" class="control-label">Store Code</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="store_code" id="store_code" value="{{ $outlet->store_code }}" class="form-control" placeholder="Enter store code">
                                    </div>
                                </div>
                                @if ($errors->has('store_code'))
                                <span class="help-block">{{ $errors->first('store_code') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('store_name') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="store_name" class="control-label">Store Name</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="store_name" id="store_name" value="{{ $outlet->store_name }}" class="form-control" placeholder="Enter store name">
                                    </div>
                                </div>
                                @if ($errors->has('store_name'))
                                <span class="help-block">{{ $errors->first('store_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('address') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="address" class="control-label">Address</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="address" id="address" class="form-control" value="{{ $outlet->address }}" placeholder="Enter store address">
                                    </div>
                                </div>
                                @if ($errors->has('address'))
                                <span class="help-block">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('district') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="district" class="control-label">District </label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="">
                                        <select class="form-control selectpicker" data-live-search="true" name="district" id="district">
                                            <option value="">Select One</option>
                                        </select>
                                        @if ($errors->has('district'))
                                        <span class="help-block">{{ $errors->first('district') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="area">Area</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="demo-checkbox">
                                        <select class="form-control selectpicker" data-live-search="true" name="area" id="area">
                                            <option value="">Select One</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row{{ $errors->has('contact_details') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="contact_details" class="control-label">Contact Details</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="contact_details" id="contact_details" class="form-control" value="{{ $outlet->contact_details }}" placeholder="Contact Details">
                                    </div>
                                </div>
                                @if ($errors->has('contact_details'))
                                <span class="help-block">{{ $errors->first('contact_details') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <a href="{{route('outlet.index')}}"><button type="button" class="btn btn-primary m-t-15 waves-effect">
                                        << Back</button> </a> </div> <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        load_json_data('district', 0);

        function load_json_data(id, parent) {
            var html_code = '';
            var file_path = "{{ url('storage/district_area.json') }}";
            $.getJSON(file_path, function(data) {
                html_code += '<option value="">Select ' + id + '</option>';
                $.each(data, function(key, value) {

                    if (id == 'district') {

                        if (value.parent == '0') {

                            html_code += '<option value="' + value.name + '">' + value.name + '</option>';
                        }
                    } else {
                        if (value.parent == parent) {

                            html_code += '<option value="' + value.name + '">' + value.name + '</option>';
                        }
                    }
                });
                $('#' + id).html(html_code);
                $('.selectpicker').selectpicker('refresh');
            });
        }

        $(document).on('change', '#district', function() {
            var district = $(this).val();
            if (district != '') {
                load_json_data('area', district);
            } else {
                $('#area').html('<option value="">Select Area</option>');
            }
        });
    });
</script>

@endsection

@push('js')

@endpush