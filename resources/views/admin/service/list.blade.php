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

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                        <h2>
                            {{ $title }}
                        </h2>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <a href="{{route('service.create')}}"><button type="button" class="btn bg-green waves-effect">Add
                                New</button></a>
                    </div>
                </div>
            </div>
            @if ($message = Session::get('msg'))
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {{ $message }}</em></div>
            @endif
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service Name</th>
                                <th>created time</th>
                                <th>last Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Service Name</th>
                                <th>created time</th>
                                <th>last Updated</th>
                                <th>Actions</th>


                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($services as $value)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $value->service_type }}</td>
                                <td>{{ $value->created_at }}</td>
                                <td>{{ $value->updated_at }}</td>
                                <td>
                                    <form action="{{ route('service.destroy',$value->id) }}" method="POST">


                                        @csrf
                                        @method('DELETE')

                                        &nbsp;&nbsp; <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o" aria-hidden="true" title="delete"></i></button>
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush