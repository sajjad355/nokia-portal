@extends('layouts.dashboard.dash')
@section('title',$title)
@push('css')

@endpush

@section('content')

<style>
    .btn-group.bootstrap-select .dropdown-menu.open {
        overflow: unset !important;
    }
</style>

<!-- Basic Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    {{$title}}
                </h2>
            </div>
            <br>
            @if (session('msg'))
            <div class="alert alert-warning">
                <strong>{{ session('msg')}}</strong>
            </div>
            @endif
            <div class="row clearfix">
                <form class="form-horizontal" action="{{ route('total_sale_report') }}" method="POST">
                    @csrf
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">



                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                            <h2 class="card-inside-title"> Service Type</h2>
                            <div class="input-group">
                                <div class="demo-checkbox"  style="padding-top: 1px">
                                    <select name="service_type" class="form-control selectpicker" data-live-search="true" id="product">
                                        <option value="">Select One</option>
                                        @foreach ($products as $product)
                                        <?php $value = $product->product_name; ?>
                                        <option value="{{ $product->product_name }}" @if (old('service_type')==$value ) {{ 'selected' }} @endif>{{$product->product_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <h2 class="card-inside-title"> Date Range</h2>
                            <div class="input-daterange input-group" id="datepicker" data-provide="datepicker">
                                <div class="form-line" id="datepicker-container">
                                    <?php if (isset($from_date)) { ?>
                                        <input type="text" name="from_date" value="{{ date('d-m-Y', strtotime($from_date)) }}" class="form-control" placeholder="Date start..." autocomplete="off">
                                    <?php } else { ?>
                                        <input type="text" name="from_date" class="form-control" placeholder="Date start..." autocomplete="off">
                                    <?php } ?>

                                </div>
                                <span class="input-group-addon">to</span>
                                <div class="form-line" id="datepicker-container">
                                    <?php if (isset($to_date)) { ?>
                                        <input type="text" name="to_date" value="{{ date('d-m-Y', strtotime($to_date)) }}" class="form-control" placeholder="Date end..." autocomplete="off">
                                    <?php } else { ?>
                                        <input type="text" name="to_date" class="form-control" placeholder="Date end..." autocomplete="off">
                                    <?php } ?>
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
                    </div>
                </form>
            </div>
            <br>

            <?php if (isset($service_type)) { ?>
                <p style="font-size: 16px; padding: 10px 20px;" class="bg-warning">
                    <strong>Service type: </strong><?php echo $service_type; ?>
                </p>
            <?php } ?>

            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tier Name</th>
                                <th>Sales Count</th>
                                <th>MRP</th>
                                <th>DRP</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Tier Name</th>
                                <th>Sales Count</th>
                                <th>MRP</th>
                                <th>DRP</th>
                                <th>Total</th>
                            </tr>
                        </tfoot>
                        <tbody>
                          @isset($results)
                          <?php $i = 1; ?>
                          @foreach($results as $row)
                          <tr>
                              <td>{{ $i++ }}</td>
                              <td>{{ $row['Tier'] }}</td>
                              <td>{{ $row['SalesCount'] }}</td>
                              <td>{{ $row['MRP_i'] }}</td>
                              <td>{{ $row['DRP_i'] }}</td>
                              <td>{{ $row['DRP_i'] * $row['SalesCount'] }}</td>
                          </tr>
                          @endforeach
                          @endisset
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="graph_container">
                            <canvas id="Chart1" height="220"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- #END# Basic Table -->

@endsection

@push('js')

@endpush