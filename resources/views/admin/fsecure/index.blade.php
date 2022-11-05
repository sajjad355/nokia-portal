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
                            <a href="{{ route('download_sample_fsecure') }}"><button type="button" class="btn bg-green waves-effect">Download Sample</button></a>
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
                    <form class="form-horizontal" action="{{ route('fsecure.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row{{ $errors->has('upload_code') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label"></div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="margin-bottom: auto;">
                                <div class="form-group">
                                    <div class="control-group input-group panel panel-default">
                                        <input type="file" class="form-control" name="upload_code">
                                    </div>
                                </div>
                                @if ($errors->has('upload_code'))
                                <span class="help-block">{{ $errors->first('upload_code') }}</span>
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
                @isset($fSecureCodes)
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                                <tr>
                                    <th>#</th>
                                    <th>F-Secure Code</th>
                                    <th>Service Type</th>
                                    <th>IMEI</th>
                                    <th>Mobile Number</th>
                                    <th>Status</th>
                                    <th>Use Date</th>
                                    <th>Uploaded At</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>#</th>
                                    <th>F-Secure Code</th>
                                    <th>Service Type</th>
                                    <th>IMEI</th>
                                    <th>Mobile Number</th>
                                    <th>Status</th>
                                    <th>Use Date</th>
                                    <th>Uploaded At</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($fSecureCodes as $data)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $data['fsecure_code'] }}</td>
                                    <td>{{ $data['service_type'] }}</td>
                                    @if($data['imei']==null)
                                    <td>None</td>
                                    @else
                                    <td>{{ $data['imei'] }}</td>
                                    @endif
                                    <td>{{ $data['mobile'] }}</td>
                                    @if($data['status']==1)
                                    <td style="color: greenyellow"><strong>Used</strong></td>
                                    @else
                                    <td style="color: green;"><strong>Unused</strong></td>
                                    @endif
                                    @if($data['used_at']==null)
                                    <td>None</td>
                                    @else
                                    <td>{{ Carbon\Carbon::parse($data['used_at'])->format('d M Y') }}</td>
                                    @endif
                                    <td>{{ Carbon\Carbon::parse($data['created_at'])->format('d M Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <form action="{{ route('delete_unused_codes') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o" aria-hidden="true" title="delete"></i> Delete All Unused F-Secure Codes</button>
                    </form>
                </div>
                @endisset
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush