@extends('layouts.dashboard.dash')
@section('title','Import List')

@push('css')

@endpush

@section('content')

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
                        <a href="{{route('import.create')}}"><button type="button" class="btn bg-green waves-effect">Add
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
                                <th>Column 1</th>
                                <th>Column 2</th>
                                <th>Column 3</th>
                                <th>Column 4</th>
                                <th>Column 5</th>
                                <th>Column 6</th>
                                <th>Column 7</th>
                                <th>Column 8</th>
                                <th>Column 9</th>
                                <th>Column 10</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>#</th>
                                <th>Column 1</th>
                                <th>Column 2</th>
                                <th>Column 3</th>
                                <th>Column 4</th>
                                <th>Column 5</th>
                                <th>Column 6</th>
                                <th>Column 7</th>
                                <th>Column 8</th>
                                <th>Column 9</th>
                                <th>Column 10</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach ($import_export as $data)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $data->Variable_code }}</td>
                                <td>{{ $data->Industry_aggregation_NZSIOC }}</td>
                                <td>{{ $data->Industry_code_NZSIOC }}</td>
                                <td>{{ $data->Industry_name_NZSIOC }}</td>
                                <td>{{ $data->Units }}</td>
                                <td>{{ $data->Year }}</td>
                                <td>{{ $data->Variable_name }}</td>
                                <td>{{ $data->Variable_category }}</td>
                                <td>{{ $data->Value }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($data->Industry_code_ANZSIC06, 10, $end='...') }}</td>
                                <td>
                                    <form action="{{ route('import.destroy',$data->id) }}" method="POST">

                                        <a class="btn btn-defauld" href="{{ route('import.show', $data->id) }}"><i
                                                class="fa fa-bars" aria-hidden="true" title="view"></i></a>

                                        &nbsp;&nbsp; <a class="btn btn-primary"
                                            href="{{ route('import.edit', $data->id) }}"><i
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
                <form action="{{ route('delete_all') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')"><i
                        class="fa fa-trash-o" aria-hidden="true" title="delete"></i> Delete All Records</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')

@endpush