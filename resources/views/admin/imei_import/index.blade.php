@extends('layouts.dashboard.dash')
@section('title', $title)
@push('css')

@endpush
@section('content')

<style>
    .fa.fa-bars {
        font-size: inherit !important;
    }

    .fa.fa-pencil-square-o {
        font-size: inherit !important;
    }

    .fa.fa-trash-o {
        font-size: inherit !important;
    }
</style>

<div class="container-fluid">
    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row ">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <h2>
                                {{ $title }}
                            </h2>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <a href="{{ route('download_sample_imei') }}"><button type="button" class="btn bg-green waves-effect">Download Sample</button></a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('msg'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="alert alert-info" role="alert">
                    <ul>
                        <li><label for="info"> Must be a file of type: .txt</label></li>
                        <li><label for="info">File format must be text separated with pipe ( | )</label></li>
                    </ul>
                </div>
                <div class="body">
                    <form class="form-horizontal" action="{{ route('import_imei.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row{{ $errors->has('imei_import') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label"></div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="margin-bottom: auto;">
                                <div class="form-group">
                                    <div class="control-group input-group panel panel-default">
                                        <input type="file" class="form-control" name="imei_import">
                                    </div>
                                </div>
                                @if ($errors->has('imei_import'))
                                <span class="help-block">{{ $errors->first('imei_import') }}</span>
                                @endif
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label"></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Upload</button>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"></div>
                        </div>
                    </form>
                </div>
                @isset($imeis)
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>IMEI</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <!-- <th>Device Price</th> -->
                                    <th>Status</th>
                                    <th>Used By</th>
                                    <th>Sale/Use Date</th>
                                    <th>Uploaded At</th>
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>IMEI</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <!-- <th>Device Price</th> -->
                                    <th>Status</th>
                                    <th>Used By</th>
                                    <th>Sale/Use Date</th>
                                    <th>Uploaded At</th>
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($imeis as $data)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $data['imei'] }}</td>
                                    <td>{{ $data['brand'] }}</td>
                                    <td>{{ $data['model'] }}</td>
                                    <!-- <td><img src="{{ asset('assets/taka.png') }}" width="8" height="10">&nbsp;{{ $data['device_price'] }}</td> -->
                                    @if($data['status']==1)
                                    <td style="color: green"><strong>Available</strong></td>
                                    @elseif($data['status']==2)
                                    <td style="color: red;"><strong>Disable</strong></td>
                                    @else
                                    <td style="color: greenyellow;"><strong>Sold</strong></td>
                                    @endif
                                    @if($data['sale_by']=='0')
                                    <td>None</td>
                                    @else
                                    <td>{{ $data['sale_by'] }}</td>
                                    @endif
                                    @if($data['sale_date']=='None')
                                    <td>{{ $data['sale_date'] }}</td>
                                    @else
                                    <td>{{ Carbon\Carbon::parse($data['sale_date'])->format('M d Y') }}</td>
                                    @endif
                                    <td>{{ Carbon\Carbon::parse($data['created_at'])->format('M d Y') }}</td>
                                    <!-- <td>
                                        <form action="{{ route('import_imei.destroy',$data['id']) }}" method="POST">

                                            <a class="btn btn-defauld" href="{{ route('import_imei.show', $data['id']) }}"><i class="fa fa-bars" aria-hidden="true" title="view"></i></a>

                                            &nbsp;&nbsp; <a class="btn btn-primary" href="{{ route('import_imei.edit', $data['id']) }}"><i class="fa fa-pencil-square-o" aria-hidden="true" title="edit"></i></a>

                                            @csrf
                                            @method('DELETE')

                                            &nbsp;&nbsp; <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o" aria-hidden="true" title="delete"></i></button>
                                        </form>
                                    </td> -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- <form action="{{ route('txt_delete_all') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o" aria-hidden="true" title="delete"></i> Delete All Records</button>
                    </form> -->
                </div>
                @endisset
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush