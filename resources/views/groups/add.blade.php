@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="card ExerOne mb-3">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Gruppe erstellen
                    </button>
                </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".ExerOne">
                <div class="card-body table-responsive">
                    {!! Form::open(array('route' => 'store-groups', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'enctype' => "multipart/form-data")) !!}
                    {!! csrf_field() !!}

                    <div class="form-group has-feedback row {{ $errors->has('group_name') ? ' has-error ' : '' }}">
                        {!! Form::label('group_name', 'Gruppenname', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('group_name', NULL, array('id' => 'group_name', 'class' => 'form-control', 'placeholder' => 'Gruppenname', 'required')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="group_name">
                                        <i class="fa fa-group" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('group_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('group_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback row {{ $errors->has('group_logo') ? ' has-error ' : '' }}">
                        {!! Form::label('group_logo', 'Gruppenlogo', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="file" accept="image/*" id="group_logo" name="group_logo" />
                            </div>
                            @if ($errors->has('group_logo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('group_logo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {!! Form::button('Gruppe erstellen', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
