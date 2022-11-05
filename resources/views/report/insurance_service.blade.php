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
            <div class="row clearfix">
                <form class="form-horizontal" action="{{ route('insurance_service_report') }}" method="POST">
                    @csrf
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">

                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <label for="storeName" style="margin-top: 8px;">IMEI Number :</label>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 {{ $errors->has('imei_number') ? ' has-error' : '' }}">
                        <?php if (isset($imei)) { ?>
                            <input type="text" name="imei_number" value="{{ $imei }}" id="imei_number" class="form-control">
                        <?php } else { ?>
                            <input type="text" name="imei_number" id="imei_number" class="form-control" placeholder="Enter IMEI number">
                        <?php } ?>
                        <div class="col-md-12 text-center">
                            @if ($errors->has('imei_number'))
                            <span class="help-block">{{ $errors->first('imei_number') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <button type="submit" class="btn bg-green waves-effect">Search</button>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">

                    </div>
                </form>
            </div>
            <div class="body">
                <div class="table-responsive">
                    @isset($search_results)
                    @if ($search_results!=null)
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Store Code</th>
                                <th>Store Type</th>
                                <th>Store Name</th>
                                <th>Service Center Name</th>
                                <th>IMEI</th>
                                <th>Model</th>
                                <th>Price</th>
                                <th>Customer Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>FS Code</th>
                                <th>Sales Date and Time</th>
                                <th>Handset Received</th>
                                <th>Handset Delivered</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Store Code</th>
                                <th>Store Type</th>
                                <th>Store Name</th>
                                <th>Service Center Name</th>
                                <th>IMEI</th>
                                <th>Model</th>
                                <th>Price</th>
                                <th>Customer Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>FS Code</th>
                                <th>Sales Date and Time</th>
                                <th>Handset Received</th>
                                <th>Handset Delivered</th>
                                <th>Image</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($search_results as $row)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $row->store_code }}</td>
                                @if($row->store_type == 'Sales Center')
                                <td>SALES</td>
                                @else
                                <td>SERVICE</td>
                                @endif
                                <td>{{ $row->sales_center_name }}</td>
                                <td>{{ $row->service_center_name }}</td>
                                <td>{{ $row->imei }}</td>
                                <td>{{ $row->model }}</td>
                                <td>{{ $row->price }}</td>
                                <td>{{ $row->customer_name }}</td>
                                <td>{{ $row->mobile }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->address }}</td>
                                <td>{{ $row->fs_code }}</td>
                                <td>{{ Carbon\Carbon::parse($row->purchase_date)->isoformat('M/D/YYYY, h:mm:ss a') }}</td>
                                @if($row->created_at != null)
                                <!-- <td>{{ Carbon\Carbon::parse($row->created_at)->format('M d Y') }}</td> -->
                                <td>{{ Carbon\Carbon::parse($row->created_at)->isoformat('M/D/YYYY, h:mm:ss a') }}</td>
                                @else
                                <td>N/A</td>
                                @endif
                                @if($row->delivery_date !=null)
                                <!-- <td>{{ Carbon\Carbon::parse($row->delivery_date)->format('M d Y') }}</td> -->
                                <td>{{ Carbon\Carbon::parse($row->delivery_date)->isoformat('M/D/YYYY, h:mm:ss a') }}</td>
                                @else
                                <td>N/A</td>
                                @endif
                                <td><button data-id="{{ $row->imei }}" class='btn btn-info image'>Image</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-center"><strong>No record found</strong></div>
                    <div class="col-md-4"></div>
                    @endif
                    @endisset
                </div>
            </div>
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
<!-- #END# Basic Table -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $('.image').click(function() {

            var imei = $(this).data('id');

            // AJAX request
            $.ajax({
                url: '{{route("ins_display_service_image")}}',
                type: 'post',
                data: {
                    _token: CSRF_TOKEN,
                    serviceImei: imei
                },
                dataType: 'JSON',
                async: false,
                success: function(response) {
                    // console.log(response);
                    // Add response in Modal body
                    $('.modal-body').html(response);

                    // Display Modal
                    $('#myModal').modal('show');
                }
            });
        });
    });
</script>

@endsection

@push('js')

@endpush