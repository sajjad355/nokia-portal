@extends('layouts.dashboard.dash')
@section('title','User List')
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
            <a href="{{route('users.create')}}"><button type="button" class="btn bg-green waves-effect">Add
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
                <th>Name</th>
                <th>Username</th>
                <th>E-mail</th>
                <th>Assigned Store</th>
                <th>Assigned Role</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Username</th>
                <th>E-mail</th>
                <th>Assigned Store</th>
                <th>Assigned Role</th>
                <th>Actions</th>
              </tr>
            </tfoot>
            <tbody>
              <?php $i = 1; ?>
              @foreach ($users as $user)

              <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                @if($user->store_name == null)
                <td>Not a store user</td>
                @else
                <td>{{ $user->store_name }}</td>
                @endif
                <td>{{ $user->display_name }}</td>
                <td>
                  <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="row">
                      <div class="col-sm-4">
                        <a class="btn btn-defauld" href="{{ route('users.show', $user->id) }}"><i class="fa fa-bars" aria-hidden="true" title="view"></i></a>
                      </div>
                      <div class="col-sm-4">
                        <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}"><i class="fa fa-pencil-square-o" aria-hidden="true" title="edit"></i></a>
                      </div>
                      <div class="col-sm-4">
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o" aria-hidden="true" title="delete"></i></button>
                      </div>
                    </div>
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