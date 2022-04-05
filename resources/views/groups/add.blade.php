@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="float-start">Gruppe erstellen</h5>

                <a href="{{ route('groups') }}" class="float-end">Zurück zu Gruppen</a>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'store-groups', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'enctype' => "multipart/form-data")) !!}
                {!! csrf_field() !!}

                <div class="row has-feedback row {{ $errors->has('group_name') ? ' has-error ' : '' }}">
                    {!! Form::label('group_name', 'Gruppenname', array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        <div class="input-group mb-3">
                            {!! Form::text('group_name', NULL, array('id' => 'group_name', 'class' => 'form-control', 'placeholder' => 'Gruppenname', 'required')) !!}
                            <label class="input-group-text" for="group_name">
                                <i class="fa fa-group" aria-hidden="true"></i>
                            </label>
                        </div>
                        @if ($errors->has('group_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('group_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row has-feedback row {{ $errors->has('group_logo') ? ' has-error ' : '' }}">
                    {!! Form::label('group_logo', 'Gruppenlogo', array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        <div class="input-group mb-3">
                            <input type="file" accept="image/*" id="group_logo" name="group_logo" />
                        </div>
                        @if ($errors->has('group_logo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('group_logo') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {!! Form::button('Gruppe erstellen', array('class' => 'btn btn-success col-12','type' => 'submit' )) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
