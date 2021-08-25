@extends('layouts.dashboard.dash')

@section('title', $title)
    

@push('css')

@endpush

@section('content')

<!-- Exportable Table -->
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
                   {{-- @role('basic_user') --}}
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <a href="{{route('roles.create')}}"><button type="button" class="btn bg-green waves-effect">Add
                                New</button></a>
                    </div>
                    {{-- @endrole --}}
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
                                <th>Role Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Role Name</th>
                                <th>Display Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach ($roles as $role)

                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->display_name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>
                                    <form action="{{ route('roles.destroy',$role->id) }}" method="POST">

                                        <a class="btn btn-defauld" href="{{ route('roles.show', $role->id) }}"><i
                                                class="fa fa-bars" aria-hidden="true" title="view"></i></a>

                                        &nbsp;&nbsp; <a class="btn btn-primary"
                                            href="{{ route('roles.edit', $role->id) }}"><i class="fa fa-pencil-square-o"
                                                aria-hidden="true" title="edit"></i></a>

                                        @csrf
                                        @method('DELETE')

                                        &nbsp;&nbsp; <button class="btn btn-danger" type="submit"
                                            onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o"
                                                aria-hidden="true" title="delete"></i></button>
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
<!-- #END# Exportable Table -->
@endsection

@push('js')

@endpush