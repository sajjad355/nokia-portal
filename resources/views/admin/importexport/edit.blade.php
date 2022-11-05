@extends('layouts.dashboard.dash')

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
                    <form class="form-horizontal" action="{{ route('import.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row{{ $errors->has('sn') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="sn">SN</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="sn" id="sn"
                                            value="{{ $data->SN }}" class="form-control"
                                            placeholder="Enter serial number">
                                    </div>
                                </div>
                                @if ($errors->has('sn'))
                                <span class="help-block">{{ $errors->first('sn') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('column_1') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="column_1">Column 1</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="column_1" id="column_1"
                                            value="{{ $data->Variable_code }}" class="form-control"
                                            placeholder="Enter column 1">
                                    </div>
                                </div>
                                @if ($errors->has('column_1'))
                                <span class="help-block">{{ $errors->first('column_1') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('column_2') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="column_2">Column 2</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="column_2" id="column_2" class="form-control"
                                            value="{{ $data->Industry_aggregation_NZSIOC }}"
                                            placeholder="Enter column 2">
                                    </div>
                                </div>
                                @if ($errors->has('column_2'))
                                <span class="help-block">{{ $errors->first('column_2') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('column_3') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="column_3">Column 3</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="column_3" id="column_3" class="form-control"
                                            value="{{ $data->Industry_code_NZSIOC }}"
                                            placeholder="Enter column 3">
                                    </div>
                                </div>
                                @if ($errors->has('column_3'))
                                <span class="help-block">{{ $errors->first('column_3') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('column_4') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="column_4">Column 4</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="column_4" id="column_4" class="form-control"
                                            value="{{ $data->Industry_name_NZSIOC }}"
                                            placeholder="Enter column 4">
                                    </div>
                                </div>
                                @if ($errors->has('column_4'))
                                <span class="help-block">{{ $errors->first('column_4') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('column_5') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="column_4">Column 5</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="column_5" id="column_5" class="form-control"
                                            value="{{ $data->Units }}"
                                            placeholder="Enter column 5">
                                    </div>
                                </div>
                                @if ($errors->has('column_5'))
                                <span class="help-block">{{ $errors->first('column_5') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('column_6') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="column_6">Column 6</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="column_6" id="column_6" class="form-control"
                                            value="{{ $data->Year }}"
                                            placeholder="Enter column 6">
                                    </div>
                                </div>
                                @if ($errors->has('column_6'))
                                <span class="help-block">{{ $errors->first('column_6') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('column_7') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="column_7">Column 7</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="column_7" id="column_7" class="form-control"
                                            value="{{ $data->Variable_name }}"
                                            placeholder="Enter column 7">
                                    </div>
                                </div>
                                @if ($errors->has('column_7'))
                                <span class="help-block">{{ $errors->first('column_7') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('column_8') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="column_8">Column 8</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="column_8" id="column_8" class="form-control"
                                            value="{{ $data->Variable_category }}"
                                            placeholder="Enter column 8">
                                    </div>
                                </div>
                                @if ($errors->has('column_8'))
                                <span class="help-block">{{ $errors->first('column_8') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('column_9') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="column_9">Column 9</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="column_9" id="column_9" class="form-control"
                                            value="{{ $data->Value }}"
                                            placeholder="Enter column 9">
                                    </div>
                                </div>
                                @if ($errors->has('column_9'))
                                <span class="help-block">{{ $errors->first('column_9') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row{{ $errors->has('column_10') ? ' has-error' : '' }} clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                <label for="column_10">Column 10</label>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" name="column_10" id="column_10" class="form-control"
                                            value="{{ $data->Industry_code_ANZSIC06 }}"
                                            placeholder="Enter column 10">
                                    </div>
                                </div>
                                @if ($errors->has('column_10'))
                                <span class="help-block">{{ $errors->first('column_10') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <a href="{{route('outlet.index')}}"><button type="button" class="btn btn-primary m-t-15 waves-effect"> << Back</button></a>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
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