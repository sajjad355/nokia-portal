@extends('layouts.dashboard.dash')
@section('title','User View')
@push('css')

@endpush
@section('content')
<div class="container-fluid">

    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
            <div class="card">
                <div class="header">
                    <h2>
                        Details
                    </h2>
                </div>
                <div class="body">
                    @foreach ($users as $user)
                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                           <strong>Name :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$user->name}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Username :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$user->username}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>E-mail :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$user->email}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Assigned Store :</strong>
                        </div>
                        @if($user->store_name == null)
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            Not a store user
                        </div>
                        @else
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$user->store_name}}
                        </div>
                        @endif
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Assigned Role :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{$user->display_name}}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Created At :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{ Carbon\Carbon::parse($user->created_at)->format('M d Y') }}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>

                    <div class="row clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                            <strong>Updated At :</strong>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            {{ Carbon\Carbon::parse($user->updated_at)->format('M d Y') }}
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 form-control-label">
                        </div>
                    </div>
                    @endforeach
                    <div class="row clearfix">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <a href="{{route('users.index')}}"><button type="button" class="btn btn-primary m-t-15 waves-effect"> << Back</button></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush