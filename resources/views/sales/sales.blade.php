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

    .btn-group.bootstrap-select .dropdown-menu.open {
        overflow: unset !important;
    }

    .control-label:after {
        content: "*";
        color: red;
    }

    .card .body .col-xs-4 {
        margin-bottom: 0px !important;
    }

    .alert-success {
        background-color: #124191 !important;
    }
</style>

<div id="myModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h2>Disclaimer</h2>
            </div>
            <div class="modal-body">
                <ol style="line-height: 3; font-size: 16px;">
                    <li>I understand the privacy of customer data and I understand my responsibility of keeping customer data secure.</li>
                    <li>I shall not use or disclose any customer data and privacy to any one</li>
                    <li>I am solely accountable for whatever data (IMEI, Date, Model) and Image (Invoice, Phone) is given</li>
                    <li>I shall comply with the image specification</li>
                    <li>IMEI Image Should contain 4 digits OTP-see image at below</li>
                    <img src="{{ asset('assets/imeiDis.png') }}" width="400" height="400">

                </ol>
                <br><br><br>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                        <button type="submit" id="accept" class="btn btn-primary btn-lg waves-effect">Accept</button>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="container-fluid">

    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header text-center">
                    @if($store_code->count()>0)
                    @foreach ($store_code as $name)
                    <h2>{{ $name->store_name }}</h2>
                    @endforeach
                    @else
                    <h2>Not a store user</h2>
                    @endif
                </div>
                @if (session('successMsg'))
                <div class="alert alert-success">
                    <strong>Well done!</strong> {{ session('successMsg')}}
                </div>
                @endif
                <br>
                <div class="body">
                    <label class="control-label" for="info"></label><i> required field</i>
                    <form class="form-horizontal" action="{{ url('sales')}}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                        @csrf
                        
                        @isset($store_code)
                        @foreach ($store_code as $code)
                        <input type="hidden" name="store_id" value="{{ $code->id }}">
                        @endforeach
                        @endisset
                        <!-- <input type="hidden" name="service_type" value="Don’t Worry Screen Protection"> -->

                        <div class="col-lg-5 col-md-12 ">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                                                <label class="" for="imei" style="font-size:20px;font-weight:bold;color:maroon">OTP is:</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8{{ $errors->has('imei') ? ' has-error' : '' }} clearfix">
                                                <div class="form-group form-float">
                                                    <div class="">
                                                    <input type="text" name="fs_code" id="fs_code" value="<?php echo rand(1000,9999); ?>" readonly style="margin-top:6px; font-size:20px;font-weight:bold;color:maroon;border:none" >
                                                    </div>
                                                </div>
                                                @if ($errors->has('imei'))
                                                <span class="help-block">{{ $errors->first('imei') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                                                <label class="control-label" for="product">Service Type </label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8{{ $errors->has('product') ? ' has-error' : '' }} clearfix">
                                                <div class="form-group">
                                                    <div class="demo-checkbox">
                                                        <select name="service_type" class="form-control selectpicker" data-live-search="true" id="product">
                                                        <option disabled selected>Please Select Service</option>
                                                            @foreach ($products as $product)
                                                            <option value="{{ $product->service_type }}">{{$product->service_type}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                @if ($errors->has('product'))
                                                <span class="help-block">{{ $errors->first('product') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-5 col-md-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                                                <label class="control-label" for="imei">IMEI </label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8{{ $errors->has('imei') ? ' has-error' : '' }} clearfix">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" name="imei" id="imei" class="form-control" value="{{ Request::old('imei') ?: '' }}" placeholder="Enter 15 digit IMEI No" autocomplete="off" maxlength="15" required>
                                                    </div>
                                                </div>
                                                @if ($errors->has('imei'))
                                                <span class="help-block">{{ $errors->first('imei') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 form-control-label">
                                                <label class="control-label" for="model">Model </label>
                                            </div>
                                            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-8{{ $errors->has('model') ? ' has-error' : '' }} clearfix">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <!-- <input type="text" name="brand" id="brand" class="form-control" value="{{ Request::old('brand') ?: '' }}" placeholder="Enter phone brand" autocomplete="off" maxlength="15"> -->
                                                        <select name="model" id="model" class="form-control" value="{{ Request::old('model') ?: '' }}" placeholder="Enter phone model" autocomplete="off" required  >
                                                            <option disabled selected>Please Select Model Name</option>
                                                            @foreach($phone_models as $phone_model)
                                                            
                                                            <option value="{{$phone_model->model_name }}">{{$phone_model->model_name}}</option>
                                                             
                                                            @endforeach
                                                        </select>                                 
                                                    </div>
                                                </div>
                                                @if ($errors->has('model'))
                                                <span class="help-block">{{ $errors->first('model') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                                                <label class="control-label" for="price">Device Price </label>
                                            </div>
                                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-8 {{ $errors->has('price') ? ' has-error' : '' }} clearfix">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="number" name="price" value="{{ Request::old('price') ?: '' }}" id="price" class="form-control" readonly>
                                                    </div>
                                                    <div id="price_range_alert"></div>
                                                </div>
                                                @if ($errors->has('price'))
                                                <span class="help-block">{{ $errors->first('price') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-6 col-md-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                                                <label class="control-label" for="mobile">Customer Mobile No. </label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 {{ $errors->has('mobile') ? ' has-error' : '' }} clearfix">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="number" name="mobile" id="mobile" value="{{ Request::old('mobile') ?: '' }}" class="form-control" placeholder="Enter Customer Mobile Number (ex - 01712000000)" autocomplete="off" required> 
                                                    </div>
                                                </div>
                                                @if ($errors->has('mobile'))
                                                <span class="help-block">{{ $errors->first('mobile') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-6 col-sm-6 col-xs-6 form-control-label">
                                                <label class="control-label" for="mrp">Nokia Safeguard MRP (including VAT)&nbsp;<img src="{{ asset('assets/taka.png') }}" width="8" height="10"> </label>
                                            </div>
                                            <div class="col-lg-7 col-md-6 col-sm-6 col-xs-6{{ $errors->has('mrp') ? ' has-error' : '' }}">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" name="mrp" id="mrp" value="{{ Request::old('mrp') ?: '' }}" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                @if ($errors->has('mrp'))
                                                <span class="help-block">{{ $errors->first('mrp') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-6" >
                                        <div class="row">

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label" >
                                                <label class="" for="fs_code">CPP Price</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" name="Cpp_Price" id="Cpp_Price" value="" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  
                                                      <div class="row">
                            <div class="col-lg-2 col-md-12 col-sm-4 col-xs-4 form-control-label">
                                <label class="control-label" for="image">Invoice Image </label>
                            </div>
                            <div class="col-lg-4 col-md-8 col-sm-8 col-xs-8{{ $errors->has('image') ? ' has-error' : '' }} clearfix">
                                <div class="control-group input-group increment panel panel-default">
                                    <input type="file" name="image[]" id="invoice-image" class="form-control" accept="image/x-png,image/jpg,image/jpeg">
                                    
                                </div>
                                <i class="fa fa-info-circle" aria-hidden="true"></i> <span><i style="color: #124191;">Date, IMEI and Phone Model should be mentioned in the invoice</i></span>
                                
                                @if ($errors->has('image'))
                                <span class="help-block">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row{{ $errors->has('image') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 form-control-label">
                                <label class="control-label" for="image">Handset Front side picture </label>
                            </div>
                            <div class="col-lg-10 col-md-8 col-sm-8 col-xs-8">
                                <div class="control-group input-group increment panel panel-default">
                                    <input type="file" name="image[]" id="handset-front-side-picture" class="form-control" accept="image/x-png,image/jpg,image/jpeg">
                                    
                                </div>
                                <i class="fa fa-info-circle" aria-hidden="true"></i> <span><i style="color: #124191;">Please ensure IMEI is displayed on the screen</i></span><br>
                                <i class="fa fa-info-circle" aria-hidden="true"></i> <span><i style="color: #124191;">Image size should not more than 1 MB (Allowed extensions: .jpg, .jpeg, .png)</i></span><br>
                                <i class="fa fa-info-circle" aria-hidden="true"></i> <span><i style="color: #124191;">OTP should be visible</i></span>
                                
                                @if ($errors->has('image'))
                                <span class="help-block">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                        </div>

                        

                                    <!-- <div class="col-lg-6" hidden >
                                        <div class="row">

                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label" >
                                                <label class="" for="fs_code">Fs code</label>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" name="fs_code" id="fs_code" value="123456789" class="form-control" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->



                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" name="gender" value="M">
                        <input type="hidden" name="title" value="MR">

                        @isset($store_code)
                        @foreach ($store_code as $store)
                        <input type="hidden" name="address" value="{{ $store->address }}">
                        <input type="hidden" name="district" value="{{ $store->district }}">
                        @endforeach
                        @endisset
                        
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                                <button disabled style="background-color:#124191;color:white" type="submit"  id="submit" class="btn btn-lg btn-block waves-effect">Payment</button>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            </div>
                        </div>
                    </form>
                    <br><br><br>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                // get mrp & retailler-commission by model selection
            $('#model').on('change', function() {
            var value = $(this).val();
            var service = $('#product').val();
            // console.log(service);
            $.ajax({
                type: 'post',
                url: '{{route("get_mrp")}}',
                data: {
                    _token: CSRF_TOKEN,
                     model: value,
                     service: service
                },
                dataType: 'JSON',
                success: function(data) {
                    // console.log(data);
                    if (data != null) {
                        $('#mrp').change().val(data.mrp);
                        $('#price').change().val(data.device_price);
                        $('#Cpp_Price').change().val(data.Cpp_Price);
                        // $('#retailed_commission').change().val(data.retailler_commission);
                    } else {
                        $('#mrp').change().val('');
                        // $('#retailed_commission').change().val('');
                    }
                }
            });
        });

        $('#product').on('change', function() {
            $('#model').val(null).trigger('change');
            // console.log("h");

        });


        

        var gettingModel = false;

        // get mrp & retailler-commission by model selection
        $('#product').on('change', function() {
            setMRP();
        });

        // get phone models
        // $('#brand').on('change', function() {
        //     if(!gettingModel) {
        //         $('#model').html('');
        //         var value = $(this).val();
        //         $.ajax({
        //             type: 'post',
        //             url: '{{route("get_models")}}',
        //             data: {
        //                 _token: CSRF_TOKEN,
        //                 brand: value
        //             },
        //             dataType: 'JSON',
        //             success: function(data) {
        //                 var options = `<option value="">Select One</option>`;
        //                 for (var x = 0; x < data.length; x++) {
        //                     options += '<option value="' + data[x]['model_name'] + '">' + data[x]['model_name'] + '</option>';
        //                 }
        //                 $('#model').html(options);
        //                 $('#model').selectpicker('refresh');
        //                 $('#model').selectpicker('render');
        //             }
        //         });
        //     }
        // });

        // get device info if imei is entered
        $('#imei').keyup(function() {
            var imei = $(this).val();
            if(imei.length === 15) {
                gettingModel = true;
                $.ajax({
                    type: 'post',
                    url: '{{route("get_device_info")}}',
                    data: {
                        _token: CSRF_TOKEN,
                        imei: imei
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        // console.log(data)
                        if (data != null && data.length > 0) {
 
                            // $('#brand').val(data[0].brand);
                            // $('#model').val(data[0].model);
                            // var options = '<option value="' + data[0]['model'] + '">' + data[0]['model'] + '</option>';
                            // $('#model').html(options);
                            // $('#model').selectpicker('refresh');
                            // $('#model').selectpicker('render');
                            // setTimeout(() => {
                            //     gettingModel = false;
                            //     $('#brand').attr('disabled', 'disabled'); 
                            // }, 1000);              
                            $('#submit').attr('disabled', null);
                            // $('#model').attr('readonly', true);
                            // $('#brand').attr('readonly', true);
                        } else {
                            alert('This IMEI number is not found or Already Used')
                            // $('#brand').val('');
                            // $('#model').val('');
                            $('#submit').attr('disabled', 'disabled');
                            // $('#model').attr('readonly', false);
                            // $('#brand').attr('readonly', false);
                        }
                      //  setMRP();
                    }
                });
            }
            else {
                $('#submit').attr('disabled', 'disabled');
            }
        });

        // get fscode by price
        $('#price').keyup(function() {
            var price = $(this).val();
          //  setMRP();
            $.ajax({
                type: 'post',
                url: '{{route("get_fscode")}}',
                data: {
                    _token: CSRF_TOKEN,
                    price: price
                },
                dataType: 'JSON',
                success: function(data) {
                    if (data != null) {
                        $('#fs_code').change().val(data.fscode);
                        // console.log(data.fscode); 
                    } else {
                        $('#fs_code').change().val('');
                        // console.log("No Fs Code Selected!"); 

                    }
                }
            });
        });

        // get device info if imei is entered
        $('#imei').keyup(function() {
            var imei = $(this).val();
            if(imei.length === 15) {
              $('#submit').attr('disabled', null);
            }
            else {
                $('#submit').attr('disabled', 'disabled');
            }
        });

        if (localStorage.getItem('accept') != 'true') {
            $('#myModal').modal({backdrop: 'static', keyboard: false});
        }

        $("#accept").click(function() {
            localStorage.setItem('accept', 'true');
            $('#myModal').delay(1000).fadeOut('slow');

            setTimeout(function() {
                $('#myModal').modal("hide");
            }, 1500);
        });


    });

    function setMRP() {
        var price = $('#price').val();
        let service = $('#product').val();
        let mrpVal= price*0.045;
        $('#mrp').change().val(mrpVal);

 
    }

    //form validation

    function validateForm() {


        var serviceType = $("#product").val();
        if (serviceType == "" || serviceType == null) {
            alert("Please select service type");
            return false;
        }


        // Validate IMEI Number
        var imei = $("#imei").val();
        if (imei == "" || imei == null) {
            alert("Please enter 15 digits IMEI number");
            return false;
        } else if (imei.length != 15) {
            alert("IMEI number must have 15 digits");
            return false;
        }
        
        // var phone_brand = $("#brand").val();
        // if (phone_brand == "" || phone_brand == null) {
        //     alert("Please select phone brand");
        //     return false;
        // }

        // Validate phone model
        var phone_model = $("#model").val();
        if (phone_model == "" || phone_model == null) {
            alert("Please select phone model");
            return false;
        }
         

        // Validate price
        var price = $("#price").val();
        if (price == "" || price == null) {
            alert("Please enter price");
            return false;
        }

        // Validate customer name
        // var customer_name = $("#customer_name").val();
        // if (customer_name == "" || customer_name == null) {
        //     alert("Please enter customer name");
        //     return false;
        // }

        // Validate mobile number
        var mobile = $("#mobile").val();
        if (mobile == "" || mobile == null) {
            alert("Please enter mobile number");
            return false;
        } else if (mobile.length != 11) {
            alert("Invalid number; must be 11 digits");
            return false;
        }

        // validate Image upload
        var image_front = document.getElementById("handset-front-side-picture");
        var invoice_image = document.getElementById("invoice-image");
        var file_front = image_front.value;
        var file_invoice = invoice_image.value;
        var reg = /(.*?)\.(jpg|jpeg|png)$/;
        if (invoice_image.value == "" || invoice_image.value == null) {
            alert("Please select invoice image");
            return false;
        } else if (!file_invoice.match(reg)) {
            alert("Invalid file, allowed extensions are: .jpg, .jpeg, .png");
            return false;
        }
        if (image_front.value == "" || image_front.value == null) {
            alert("Please select handset front side picture");
            return false;
        } else if (!file_front.match(reg)) {
            alert("Invalid file, allowed extensions are: .jpg, .jpeg, .png");
            return false;
        }

        // Validate purchase date
        // var purchaseDate = $("#device_purchase_date").val();
        // if (purchaseDate == "" || purchaseDate == null) {
        //     alert("Please set device purchase date");
        //     return false;
        // }

        // Validate mrp
        var mrp = $("#mrp").val();
        if (mrp == "" || mrp == null) {
            alert("MRP may not empty");
            return false;
        }

        return true;
    }
</script>


@endsection

@push('js')

@endpush