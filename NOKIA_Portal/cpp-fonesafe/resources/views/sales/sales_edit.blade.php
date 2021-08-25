@extends('layouts.dashboard.dash')
@section('title','Sale Edit')

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
                    @foreach ($sales_info as $info)
                    <form class="form-horizontal " id="form_validation" action="{{ url('sales/'.$info->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <div class="row{{ $errors->has('store_code') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label class="control-label" for="store_code">Store Code</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group form-float">
                                    <div class="">
                                        <input type="text" name="store_code" value="{{$info->store_code}}" id="store_code" class="form-control" placeholder="Enter Store Code" readonly>
                                        <input type="hidden" name="store_id" value="{{ $info->store_id }}">
                                    </div>
                                </div>
                                @if ($errors->has('store_code'))
                                <span class="help-block">{{ $errors->first('store_code') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('imei') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label class="control-label" for="imei">IMEI</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="imei" value="{{$info->imei}}" id="imei" class="form-control" placeholder="Enter a IMEI number">
                                    </div>
                                </div>
                                @if ($errors->has('imei'))
                                <span class="help-block">{{ $errors->first('imei') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 form-control-label">
                                <label for="brand">Phone Brand</label>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 clearfix">
                                <div class="form-group">
                                    <div class="demo-checkbox">
                                        <select class="form-control selectpicker" data-live-search="true" name="brand">
                                            <option value="">Select One</option>
                                            <!-- <option value="APPLE" {{$info->brand == "APPLE" ? 'selected="selected"' : ''}}>APPLE</option>
                                            <option value="ASUS" {{$info->brand == "ASUS" ? 'selected="selected"' : ''}}>ASUS</option>
                                            <option value="NOKIA" {{$info->brand == "NOKIA" ? 'selected="selected"' : ''}}>NOKIA</option>
                                            <option value="SAMSUNG" {{$info->brand == "SAMSUNG" ? 'selected="selected"' : ''}}>SAMSUNG</option> -->
                                            <option value="HUAWEI" {{$info->brand == "HUAWEI" ? 'selected="selected"' : ''}}>HUAWEI</option>
                                            <!-- <option value="SONY" {{$info->brand == "SONY" ? 'selected="selected"' : ''}}>SONY</option>
                                            <option value="LG" {{$info->brand == "LG" ? 'selected="selected"' : ''}}>LG</option>
                                            <option value="HTC" {{$info->brand == "HTC" ? 'selected="selected"' : ''}}>HTC</option>
                                            <option value="XIAOMI" {{$info->brand == "XIAOMI" ? 'selected="selected"' : ''}}>XIAOMI</option>
                                            <option value="GOOGLE" {{$info->brand == "GOOGLE" ? 'selected="selected"' : ''}}>GOOGLE</option>
                                            <option value="REALME" {{$info->brand == "REALME" ? 'selected="selected"' : ''}}>REALME</option>
                                            <option value="OPPO" {{$info->brand == "OPPO" ? 'selected="selected"' : ''}}>OPPO</option>
                                            <option value="ONEPLUS" {{$info->brand == "ONEPLUS" ? 'selected="selected"' : ''}}>ONEPLUS</option>
                                            <option value="VIVO" {{$info->brand == "VIVO" ? 'selected="selected"' : ''}}>VIVO</option>
                                            <option value="MEIZU" {{$info->brand == "MEIZU" ? 'selected="selected"' : ''}}>MEIZU</option>
                                            <option value="BLACKBERRY" {{$info->brand == "BLACKBERRY" ? 'selected="selected"' : ''}}>BLACKBERRY</option>
                                            <option value="WALTON" {{$info->brand == "WALTON" ? 'selected="selected"' : ''}}>WALTON</option> -->
                                        </select>
                                        @if ($errors->has('brand'))
                                        <span class="help-block">{{ $errors->first('brand') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 form-control-label">
                                <label class="control-label" for="model">Model</label>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5{{ $errors->has('model') ? ' has-error' : '' }} clearfix">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="model" value="{{$info->model}}" id="model" class="form-control" placeholder="Enter model">
                                    </div>
                                </div>
                                @if ($errors->has('model'))
                                <span class="help-block">{{ $errors->first('model') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('price') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label class="control-label" for="price">Price</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="price" value="{{$info->price}}" id="price" class="form-control" placeholder="Enter Price" readonly>
                                    </div>
                                </div>
                                @if ($errors->has('price'))
                                <span class="help-block">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 form-control-label">
                                <label class="control-label" for="title">Title</label>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 {{ $errors->has('title') ? ' has-error' : '' }} clearfix">
                                <div class="form-group">
                                    <div class="demo-checkbox">
                                        <select class="form-control" id="title" name="title">
                                            <option value="">Select One</option>
                                            <option value="MR" {{$info->title == "MR" ? 'selected="selected"' : ''}}>MR</option>
                                            <option value="MS" {{$info->title == "MS" ? 'selected="selected"' : ''}}>MS</option>
                                            <option value="MRS" {{$info->title == "MRS" ? 'selected="selected"' : ''}}>MRS</option>
                                        </select>
                                        @if ($errors->has('title'))
                                        <span class="help-block">{{ $errors->first('title') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="gender">
                                <input type="hidden" name="gender" value="{{ $info->gender }}">
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 form-control-label">
                                <label class="control-label" for="customer_name">Customer Name</label>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5{{ $errors->has('customer_name') ? ' has-error' : '' }} clearfix">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="customer_name" value="{{$info->customer_name}}" id="customer_name" class="form-control" placeholder="Enter Customer name">
                                    </div>
                                </div>
                                @if ($errors->has('customer_name'))
                                <span class="help-block">{{ $errors->first('customer_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('date_of_birth') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label class="control-label" for="date_of_birth">Date of Birth</label>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <div class="form-line" id="bs_datepicker_container">
                                        <input type="text" name="date_of_birth" value="{{$info->date_of_birth}}" class="form-control" placeholder="Please choose a date..." autocomplete="off">
                                    </div>
                                </div>
                                @if ($errors->has('date_of_birth'))
                                <span class="help-block">{{ $errors->first('date_of_birth') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('mobile') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label class="control-label" for="mobile">Mobile No.</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="mobile" value="{{$info->mobile}}" id="mobile" class="form-control" placeholder="Enter Customer Mobile Number">
                                    </div>
                                </div>
                                @if ($errors->has('mobile'))
                                <span class="help-block">{{ $errors->first('mobile') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="email" value="{{$info->email}}" id="email" class="form-control" placeholder="Enter Customer Email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 form-control-label">
                                <label class="control-label" for="district">Town / District</label>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3{{ $errors->has('district') ? ' has-error' : '' }} clearfix">
                                <div class="form-group">
                                    <div class="">
                                        <select class="form-control selectpicker" data-live-search="true" id="district" name="district">
                                            <option value="">Select One</option>
                                            <option value="Bagerhat" {{$info->district == "Bagerhat" ? 'selected="selected"' : ''}}>Bagerhat</option>
                                            <option value="Bandarban" {{$info->district == "Bandarban" ? 'selected="selected"' : ''}}>Bandarban </option>
                                            <option value="Barguna" {{$info->district == "Barguna" ? 'selected="selected"' : ''}}>Barguna </option>
                                            <option value="Barisal" {{$info->district == "Barisal" ? 'selected="selected"' : ''}}>Barisal </option>
                                            <option value="Bhola" {{$info->district == "Bhola" ? 'selected="selected"' : ''}}>Bhola </option>
                                            <option value="Bogra" {{$info->district == "Bogra" ? 'selected="selected"' : ''}}>Bogra </option>
                                            <option value="Brahmanbaria" {{$info->district == "Brahmanbaria" ? 'selected="selected"' : ''}}>Brahmanbaria </option>
                                            <option value="Chandpur" {{$info->district == "Chandpur" ? 'selected="selected"' : ''}}>Chandpur </option>
                                            <option value="Chittagong" {{$info->district == "Chittagong" ? 'selected="selected"' : ''}}>Chittagong </option>
                                            <option value="Chuadanga" {{$info->district == "Chuadanga" ? 'selected="selected"' : ''}}>Chuadanga </option>
                                            <option value="Comilla" {{$info->district == "Comilla" ? 'selected="selected"' : ''}}>Comilla </option>
                                            <option value="Cox's Bazar" {{$info->district == "Cox's Bazar" ? 'selected="selected"' : ''}}>Cox's Bazar </option>
                                            <option value="Dhaka" {{$info->district == "Dhaka" ? 'selected="selected"' : ''}}>Dhaka </option>
                                            <option value="Dinajpur" {{$info->district == "Dinajpur" ? 'selected="selected"' : ''}}>Dinajpur</option>
                                            <option value="Faridpur" {{$info->district == "Faridpur" ? 'selected="selected"' : ''}}>Faridpur</option>
                                            <option value="Feni" {{$info->district == "Feni" ? 'selected="selected"' : ''}}>Feni</option>
                                            <option value="Gaibandha" {{$info->district == "Gaibandha" ? 'selected="selected"' : ''}}>Gaibandha</option>
                                            <option value="Gazipur" {{$info->district == "Gazipur" ? 'selected="selected"' : ''}}>Gazipur</option>
                                            <option value="Gopalganj" {{$info->district == "Gopalganj" ? 'selected="selected"' : ''}}>Gopalganj</option>
                                            <option value="Habiganj" {{$info->district == "Habiganj" ? 'selected="selected"' : ''}}>Habiganj </option>
                                            <option value="Jaipurhat" {{$info->district == "Jaipurhat" ? 'selected="selected"' : ''}}>Jaipurhat</option>
                                            <option value="Jamalpur" {{$info->district == "Jamalpur" ? 'selected="selected"' : ''}}>Jamalpur</option>
                                            <option value="Jessore" {{$info->district == "Jessore" ? 'selected="selected"' : ''}}>Jessore</option>
                                            <option value="Jhalakati" {{$info->district == "Jhalakati" ? 'selected="selected"' : ''}}>Jhalakati</option>
                                            <option value="Jhenaidah" {{$info->district == "Jhenaidah" ? 'selected="selected"' : ''}}>Jhenaidah</option>
                                            <option value="Khagrachari" {{$info->district == "Khagrachari" ? 'selected="selected"' : ''}}>Khagrachari</option>
                                            <option value="Khulna" {{$info->district == "Khulna" ? 'selected="selected"' : ''}}>Khulna</option>
                                            <option value="Kishoreganj" {{$info->district == "Kishoreganj" ? 'selected="selected"' : ''}}>Kishoreganj</option>
                                            <option value="Kurigram" {{$info->district == "Kurigram" ? 'selected="selected"' : ''}}>Kurigram</option>
                                            <option value="Kushtia" {{$info->district == "Kushtia" ? 'selected="selected"' : ''}}>Kushtia</option>
                                            <option value="Lakshmipur" {{$info->district == "Lakshmipur" ? 'selected="selected"' : ''}}>Lakshmipur</option>
                                            <option value="Lalmonirhat" {{$info->district == "Lalmonirhat" ? 'selected="selected"' : ''}}>Lalmonirhat</option>
                                            <option value="Madaripur" {{$info->district == "Madaripur" ? 'selected="selected"' : ''}}>Madaripur</option>
                                            <option value="Magura" {{$info->district == "Magura" ? 'selected="selected"' : ''}}>Magura</option>
                                            <option value="Manikganj" {{$info->district == "Manikganj" ? 'selected="selected"' : ''}}>Manikganj</option>
                                            <option value="Meherpur" {{$info->district == "Meherpur" ? 'selected="selected"' : ''}}>Meherpur</option>
                                            <option value="Moulvibazar" {{$info->district == "Moulvibazar" ? 'selected="selected"' : ''}}>Moulvibazar</option>
                                            <option value="Munshiganj" {{$info->district == "Munshiganj" ? 'selected="selected"' : ''}}>Munshiganj</option>
                                            <option value="Mymensingh" {{$info->district == "Mymensingh" ? 'selected="selected"' : ''}}>Mymensingh</option>
                                            <option value="Naogaon" {{$info->district == "Naogaon" ? 'selected="selected"' : ''}}>Naogaon</option>
                                            <option value="Narail" {{$info->district == "Narail" ? 'selected="selected"' : ''}}>Narail</option>
                                            <option value="Narayanganj" {{$info->district == "Narayanganj" ? 'selected="selected"' : ''}}>Narayanganj</option>
                                            <option value="Narsingdi" {{$info->district == "Narsingdi" ? 'selected="selected"' : ''}}>Narsingdi</option>
                                            <option value="Natore" {{$info->district == "Natore" ? 'selected="selected"' : ''}}>Natore</option>
                                            <option value="Nawabganj" {{$info->district == "Nawabganj" ? 'selected="selected"' : ''}}>Nawabganj</option>
                                            <option value="Netrakona" {{$info->district == "Netrakona" ? 'selected="selected"' : ''}}>Netrakona</option>
                                            <option value="Nilphamari" {{$info->district == "Nilphamari" ? 'selected="selected"' : ''}}>Nilphamari</option>
                                            <option value="Noakhali" {{$info->district == "Noakhali" ? 'selected="selected"' : ''}}>Noakhali</option>
                                            <option value="Pabna" {{$info->district == "Pabna" ? 'selected="selected"' : ''}}>Pabna</option>
                                            <option value="Panchagarh" {{$info->district == "Panchagarh" ? 'selected="selected"' : ''}}>Panchagarh</option>
                                            <option value="Parbattya Chattagram" {{$info->district == "Parbattya Chattagram" ? 'selected="selected"' : ''}}>Parbattya Chattagram</option>
                                            <option value="Patuakhali" {{$info->district == "Patuakhali" ? 'selected="selected"' : ''}}>Patuakhali</option>
                                            <option value="Pirojpur" {{$info->district == "Pirojpur" ? 'selected="selected"' : ''}}>Pirojpur</option>
                                            <option value="Rajbari" {{$info->district == "Rajbari" ? 'selected="selected"' : ''}}>Rajbari</option>
                                            <option value="Rajshahi" {{$info->district == "Rajshahi" ? 'selected="selected"' : ''}}>Rajshahi</option>
                                            <option value="Rangpur" {{$info->district == "Rangpur" ? 'selected="selected"' : ''}}>Rangpur</option>
                                            <option value="Satkhira" {{$info->district == "Satkhira" ? 'selected="selected"' : ''}}>Satkhira</option>
                                            <option value="Shariatpur" {{$info->district == "Shariatpur" ? 'selected="selected"' : ''}}>Shariatpur</option>
                                            <option value="Sherpur" {{$info->district == "Sherpur" ? 'selected="selected"' : ''}}>Sherpur</option>
                                            <option value="Sirajganj" {{$info->district == "Sirajganj" ? 'selected="selected"' : ''}}>Sirajganj</option>
                                            <option value="Sunamganj" {{$info->district == "Sunamganj" ? 'selected="selected"' : ''}}>Sunamganj</option>
                                            <option value="Sylhet" {{$info->district == "Sylhet" ? 'selected="selected"' : ''}}>Sylhet</option>
                                            <option value="Tangail" {{$info->district == "Tangail" ? 'selected="selected"' : ''}}>Tangail</option>
                                            <option value="Thakurgaon" {{$info->district == "Thakurgaon" ? 'selected="selected"' : ''}}>Thakurgaon</option>
                                        </select>
                                        @if ($errors->has('district'))
                                        <span class="help-block">{{ $errors->first('district') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 form-control-label">
                                <label class="control-label" for="address">Address</label>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5{{ $errors->has('address') ? ' has-error' : '' }} clearfix">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="address" value="{{$info->address}}" id="address" class="form-control" placeholder="Enter Customer Address">
                                    </div>
                                </div>
                                @if ($errors->has('address'))
                                <span class="help-block">{{ $errors->first('address') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label class="control-label" for="fs_code">FS Code</label>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3{{ $errors->has('fs_code') ? ' has-error' : '' }}">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="fs_code" value="{{$info->fs_code}}" id="fs_code" class="form-control" readonly>
                                    </div>
                                </div>
                                @if ($errors->has('fs_code'))
                                <span class="help-block">{{ $errors->first('fs_code') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
                                <label class="control-label" for="mrp">FS MRP(including VAT)&nbsp;&nbsp;<img src="{{ asset('assets/taka.png') }}" width="8" height="10"></label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4{{ $errors->has('mrp') ? ' has-error' : '' }}">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        @if($info->fs_mrp != null)
                                        <input type="text" name="mrp" value="{{$info->fs_mrp}}" id="mrp" class="form-control" readonly>
                                        @else
                                        <input type="text" name="mrp" value="0" id="mrp" class="form-control" readonly>
                                        @endif
                                    </div>
                                </div>
                                @if ($errors->has('mrp'))
                                <span class="help-block">{{ $errors->first('mrp') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <a href="{{route('sales.index')}}"><button type="button" class="btn btn-primary m-t-15 waves-effect">
                                        << Back</button> </a> </div> <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    $('#title').on('change', function() {
        if ($(this).val() === "MR") {
            $("#gender").html('<input type="hidden" name="gender" value="M">');
        } else {
            $("#gender").html('<input type="hidden" name="gender" value="F">');
        }
    });
</script>
@endsection

@push('js')

@endpush