@extends('layouts.dashboard.dash')
@section('title','Store List')
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
                        <a href="{{route('outlet.create')}}"><button type="button" class="btn bg-green waves-effect">Add
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
                                <th>Store Code</th>
                                <th>Store Name</th>
                                <th>Address</th>
                                <th>District</th>
                                <th>Area</th>
                                <th>Contact Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Store Code</th>
                                <th>Store Name</th>
                                <th>Address</th>
                                <th>District</th>
                                <th>Area</th>
                                <th>Contact Details</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach ($outlet as $store)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $store->store_code }}</td>
                                <td>{{ $store->store_name }}</td>
                                <td>{{ $store->address }}</td>
                                <td>{{ $store->district }}</td>
                                <td>{{ $store->area }}</td>
                                <td>{{ $store->contact_details }}</td>
                                <td>
                                    <form action="{{ route('outlet.destroy',$store->id) }}" method="POST">

                                        <a class="btn btn-defauld" href="{{ route('outlet.show', $store->id) }}"><i
                                                class="fa fa-bars" aria-hidden="true" title="view"></i></a>

                                        &nbsp;&nbsp; <a class="btn btn-primary"
                                            href="{{ route('outlet.edit', $store->id) }}"><i
                                                class="fa fa-pencil-square-o" aria-hidden="true" title="edit"></i></a>

                                        @csrf
                                        @method('DELETE')

                                        &nbsp;&nbsp; <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')"><i
                                                class="fa fa-trash-o" aria-hidden="true" title="delete"></i></button>
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