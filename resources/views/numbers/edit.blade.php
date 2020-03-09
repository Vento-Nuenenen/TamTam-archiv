@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="card EditParticipant mb-3">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Nummer bearbeiten
                    </button>
                </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".EditParticipant">
                <div class="card-body table-responsive">
                    {!! Form::open(array('route' => ['update-numbers', $number->id], 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'required')) !!}
                    {!! csrf_field() !!}

                    <div class="form-group has-feedback row {{ $errors->has('number_name') ? ' has-error ' : '' }}">
                        {!! Form::label('number_name', 'Nummernbezeichnung', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('number_name', old('number_name', $number->name ?? null), array('id' => 'number_name', 'class' => 'form-control', 'placeholder' => 'Nummernbezeichnung')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="group_name">
                                        <i class="fa fa-group" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('number_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('number_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback row {{ $errors->has('number') ? ' has-error ' : '' }}">
                        {!! Form::label('number', 'Telefonnummer', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('number', old('number', $number->number ?? null), array('id' => 'number', 'class' => 'form-control', 'placeholder' => 'Telefonnummer', 'required')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="group_name">
                                        <i class="fa fa-group" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {!! Form::button('Gruppe aktualisieren', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
