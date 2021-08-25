@extends('layouts.dashboard.dash')

@section('title','Role Create')

@push('css')

@endpush
@section('content')

<div class="container-fluid">
    <!-- Horizontal Layout -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ $title }}
                    </h2>
                </div>
                <div class="body">
                    <form class="form-horizontal" action="{{ route('roles.store')}}" method="POST">
                        @csrf
                        <div class="row{{ $errors->has('name') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="name">Name</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="name" id="name"
                                            value="{{ Request::old('name') ?: '' }}" class="form-control"
                                            placeholder="Enter role name">
                                    </div>
                                </div>
                                @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('display_name') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="display_name">Display Name</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="display_name" id="display_name"
                                            value="{{ Request::old('display_name') ?: '' }}" class="form-control"
                                            placeholder="Enter display name">
                                    </div>
                                </div>
                                @if ($errors->has('display_name'))
                                <span class="help-block">{{ $errors->first('display_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('description') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="description">Description</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="description" id="description" class="form-control"
                                            value="{{ Request::old('description') ?: '' }}"
                                            placeholder="Enter description">
                                    </div>
                                </div>
                                @if ($errors->has('description'))
                                <span class="help-block">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <!-- <div class="row{{ $errors->has('description') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="description">Permission</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="demo-checkbox">
                                      @foreach ($permissions as $key=>$permission)
                                      <input type="checkbox" id="{{ $key }}" class="filled-in" name="permission[]" value="{{ $permission->id }}">
                                      <label for="{{ $key }}">{{ $permission->display_name }}</label>
                                      @endforeach
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <a href="{{route('roles.index')}}"><button type="button"
                                        class="btn btn-primary m-t-15 waves-effect">
                                        << Back</button> </a> </div> <div
                                            class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">Create
                                                Role</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')

@endpush