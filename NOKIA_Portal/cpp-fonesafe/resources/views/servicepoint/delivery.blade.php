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

    .input-group-handset-front-image {
        width: 100%;
        margin-bottom: 0px;
    }

    .input-group-handset-back-image {
        width: 100%;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #124191 !important;
    }
</style>


<?php
$imei = '';
if (isset($search_results) && $search_results != null) {
    $imei = $search_results->imei;
}
$store_name = '';
foreach ($outlet_name as $name) {
    $store_name = $name->store_name;
}
?>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2 class="text-center">{{ $store_name }}</h2>
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
            <div class="row clearfix">
                <h4 class="text-center">{{ $title }}</h4>
                <br><br>
                
                @role('callcenter')
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <form class="form-horizontal" action="{{ route('search') }}" method="POST" onsubmit="return validateImeiNumber();">
                        @csrf
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 text-right">
                            <label for="imei_number" style="margin-top:8px;">Search IMEI :</label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 {{ $errors->has('imei_number') ? ' has-error' : '' }}">
                            <input type="text" name="imei_number" id="imei" value="" class="form-control" placeholder="Enter IMEI number">
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
                            <label for="phone_number" style="margin-top: 6px;">Mobile Number :</label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 {{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <input type="text" name="phone_number" id="mobile" class="form-control" placeholder="Enter 11 digit mobile number">
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
                @endrole
                @role('servicepoint')
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12"></div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                    <form class="form-horizontal" action="{{ route('search_by_phone') }}" method="POST" onsubmit="return validateMobileNumber();">
                        @csrf
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 text-right">
                            <label for="phone_number" style="margin-top: 6px;">Mobile Number :</label>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 {{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <input type="text" name="phone_number" id="mobile" class="form-control" placeholder="Enter 11 digit mobile number">
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
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12"></div>
                @endrole
            </div>

            <hr>
            @isset($search_results)
            <div class="body table-responsive">
                @if ($search_results!=null)
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <label class="control-label" for="info"></label><i> required field</i>
                    <form class="form-horizontal" id="form_validation" action="{{ route('delivery') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                        @csrf
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>IMEI</th>
                                    <td><input type="text" class="form-control" value="{{ $search_results->imei }}" readonly></td>
                                </tr>
                                <tr>
                                    <th>Model</th>
                                    <td><input type="text" class="form-control" name="model" value="{{ $search_results->model }}" readonly></td>
                                </tr>
                                <input type="hidden" value="{{ $search_results->price }}" name="price">
                                <input type="hidden" value="{{ $search_results->fs_code }}" name="fs_code">
                                <tr>
                                    <td colspan="2">
                                        <div class="row">
                                            <div class="col-md-6"><b>Purchase Date</b><input type="text" value="{{ Carbon\Carbon::parse($search_results->created_at)->isoformat('M/D/YYYY, h:mm:ss a') }}" class="form-control" readonly></div>
                                            <div class="col-md-6"><b>Purchase Center</b><input type="text" value="{{ $purchase_center_name }}" class="form-control" readonly></div>
                                        </div>
                                    </td>
                                    <input type="hidden" name="purchase_date" value="{{ $search_results->created_at }}">
                                </tr>
                                <tr>
                                    <th>Customer Name:</th>
                                    <td><input type="text" class="form-control" value="{{ $search_results->customer_name }}" readonly></td>
                                </tr>
                                <tr>
                                    <th>Days</th>
                                    @if ($days<'365') <td><label style="color: green;">{{ $days }} Days from
                                            purchase</label>
                                        <input type="hidden" name="imei_number" value="{{ $search_results->imei }}">
                                        </td>
                                        @else
                                        <td><label style="color: red;">{{ $days }} Days from purchase</label>
                                            <input type="hidden" name="imei_number" value="{{ $search_results->imei }}">
                                        </td>
                                        @endif
                                </tr>
                                @role(['supadmin', 'callcenter'])
                                @if($bongo_tv_codes != null)
                                <tr>
                                    <th>Bongo TV Codes</th>
                                    <td><label for="bongo_tv_codes">{{ $bongo_tv_codes }}</label></td>
                                </tr>
                                @endif
                                @endrole
                                @role('servicepoint')
                                <tr>
                                    <th><label class="control-label" for="image">Handset Front side picture</label></th>
                                    <td>
                                        <div class="control-group input-group-handset-front-image increment{{ $errors->has('image') ? ' has-error' : '' }} clearfix">
                                            <input type="file" name="image[]" id="handset-front-side-picture" value="{{ Request::old('image') ?: '' }}" class="form-control" accept="image/x-png,image/jpg,image/jpeg">
                                            
                                        </div><br>
                                        <i class="fa fa-info-circle" aria-hidden="true"></i> <span><i style="color: #124191;">Please ensure IMEI is displayed on the screen</i></span><br>
                                        
                                        @if ($errors->has('image'))
                                        <span class="help-block">{{ $errors->first('image') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th><label class="control-label" for="image">Handset Back side picture</label></th>
                                    <td>
                                        <div class="control-group input-group-handset-back-image increment{{ $errors->has('image') ? ' has-error' : '' }} clearfix">
                                            <input type="file" name="image[]" id="handset-back-side-picture" value="{{ Request::old('image') ?: '' }}" class="form-control" accept="image/x-png,image/jpg,image/jpeg">
                                            
                                        </div>
                                        <i class="fa fa-info-circle" aria-hidden="true"></i> <span><i style="color: #124191;">Please ensure back side clear picture</i></span><br>
                                        <i class="fa fa-info-circle" aria-hidden="true"></i> <span><i class="text-info">Image size should not more than 1 MB (Allowed extensions: .jpg, .jpeg, .png)</i></span>
                                        
                                        @if ($errors->has('image'))
                                        <span class="help-block">{{ $errors->first('image') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endrole
                                @role(['servicepoint', 'callcenter'])
                                <tr>
                                    <td colspan="2" style="border: 2px solid lavender;">
                                        @isset($receive_history)
                                        @foreach($receive_history as $receive)
                                        <div class="col-md-6">
                                            <p><b>Receive Center:&nbsp;&nbsp;</b>{{ $receive->store_name }}</p>
                                            <p><b>Receive Date:&nbsp;&nbsp;</b>{{ Carbon\Carbon::parse($receive->created_at)->isoformat('M/D/YYYY, h:mm:ss a') }}</p>
                                        </div>
                                        @endforeach
                                        @endisset
                                        @isset($delivery_history)
                                        @foreach($delivery_history as $delivery)
                                        <div class="col-md-6">
                                            <p><b>Delivery Center:&nbsp;&nbsp;</b>{{ $delivery->store_name }}</p>
                                            <p><b>Delivery Date:&nbsp;&nbsp;</b>{{ Carbon\Carbon::parse($delivery->created_at)->isoformat('M/D/YYYY, h:mm:ss a') }}</p>
                                        </div>
                                        @endforeach
                                        @endisset
                                    </td>
                                </tr>
                                @endrole
                                @role('callcenter')
                                @if($activation_history->count() > 0)
                                <tr>
                                    <td colspan="2" style="border: 2px solid lavender;">

                                        @foreach($activation_history as $ac_history)
                                        <div class="col-md-6">
                                            <p><b>Activated By:&nbsp;&nbsp;</b>{{ $ac_history->store_name }}</p>
                                            <p><b>Activation Date:&nbsp;&nbsp;</b>{{ Carbon\Carbon::parse($ac_history->created_at)->isoformat('M/D/YYYY, h:mm:ss a') }}</p>
                                        </div>
                                        @endforeach
                                        <div class="col-md-6"></div>
                                    </td>
                                </tr>
                                @endif
                                @endrole
                                @role('servicepoint')
                                <tr>
                                    @if ($deliveryStatus==3)
                                    <td colspan="2"><button type="submit" class="btn bg-deep-purple waves-effect btn-lg btn-block" disabled><i class="material-icons">check_circle</i> Handset Delivered</button></td>
                                    @endif
                                    @if($deliveryStatus==2)
                                    <td colspan="2"><button type="submit" id="btn" class="btn bg-deep-purple waves-effect btn-lg btn-block">Handset Delivery</button></td>
                                    @endif
                                </tr>
                                @endrole
                                @role('callcenter')
                                <tr>
                                    @isset($activation_status)
                                    @if($activation_status==4 && ($deliveryStatus==2 || $deliveryStatus==3)) 
                                    <td colspan="2"><button type="submit" id="btn" class="btn bg-green waves-effect btn-lg btn-block" disabled>Activated</button></td>
                                    @endif
                                    @endisset
                                </tr>
                                @endrole
                            </tbody>
                        </table>
                        <input type="hidden" name="service_center_name" value="{{ $store_name }}">
                        <input type="hidden" name="mobile_number" value="{{ $search_results->mobile }}">
                    </form>
                    <form action="{{ route('notification') }}" method="post">
                        @csrf
                        <input type="hidden" name="imei_number" value="{{ $search_results->imei }}">
                        <input type="hidden" name="service_center_name" value="{{ $store_name }}">
                        <input type="hidden" name="mobile_number" value="{{ $search_results->mobile }}">
                        <button type="submit" id="btn-notify" class="btn bg-green waves-effect btn-lg btn-block" style="display: none;">Send Notification</button>
                    </form>
                </div>
                <div class="col-md-2"><button data-id="{{ $search_results->imei }}" class='btn btn-info image'>Image</button></div>
                @else
                <div class="col-md-4"></div>
                <div class="col-md-4 text-center"><strong>No record found</strong></div>
                <div class="col-md-4"></div>
                @endif
            </div>
            @endisset
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Image Details</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center-center">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        //image upload start
        $(".btn-success").click(function() {
            var html = $(".clone").html();
            $(".increment").after(html);
        });

        $("body").on("click", ".btn-danger", function() {
            $(this).parents(".control-group").remove();
        });
        //image upload end

        $('#early_notification').on('change', function() {
            $get_value = $("#early_notification").val();
            if ($get_value == 'yes') {
                $("#btn").css("display", "none");
                $("#btn-notify").css("display", "block");
            } else {
                $("#btn").css("display", "block");
                $("#btn-notify").css("display", "none");
            }
        });


        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('.image').click(function() {

            var imei = $(this).data('id');

            // AJAX request
            $.ajax({
                url: '{{route("displayImage")}}',
                type: 'post',
                data: {
                    _token: CSRF_TOKEN,
                    imei: imei
                },
                dataType: 'JSON',
                async: false,
                success: function(response) {
                    console.log(response);
                    // Add response in Modal body
                    $('.modal-body').html(response);

                    // Display Modal
                    $('#myModal').modal('show');
                }
            });
        });
    });

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

    function validateServiceType() {
        //Validate service type
        var service_type = $("#service_type").val();
        if (service_type == "" || service_type == null) {
            alert("Please select one service type");
            return false;
        }

        return true;
    }

    function validateForm() {
        // validate Image upload
        var image_front = document.getElementById("handset-front-side-picture");
        var image_back = document.getElementById("handset-back-side-picture");
        var file_front = image_front.value;
        var file_back = image_back.value;
        var reg = /(.*?)\.(jpg|jpeg|png)$/;
        if (image_front.value == "" || image_front.value == null) {
            alert("Please select handset front side picture");
            return false;
        } else if (!file_front.match(reg)) {
            alert("Invalid file, allowed extensions are: .jpg, .jpeg, .png");
            return false;
        }
        if (image_back.value == "" || image_back.value == null) {
            alert("Please select handset back side picture");
            return false;
        } else if (!file_back.match(reg)) {
            alert("Invalid file, allowed extensions are: .jpg, .jpeg, .png");
            return false;
        }
        return true;
    }
</script>

@endsection

@push('js')

@endpush