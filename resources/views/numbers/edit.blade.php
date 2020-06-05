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
                <h5 class="float-left">Nummer bearbeiten</h5>

                <a href="{{  route('numbers') }}" class="float-right">Zurück zu Nummern</a>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => ['update-numbers', $number->id], 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'required')) !!}
                {!! csrf_field() !!}

                <div class="form-group has-feedback row {{ $errors->has('number_name') ? ' has-error ' : '' }}">
                    {!! Form::label('number_name', 'Nummernbezeichnung', array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            {!! Form::text('number_name', old('number_name', $number->name ?? null), array('id' => 'number_name', 'class' => 'form-control', 'placeholder' => 'Nummernbezeichnung')) !!}
                            <div class="input-group-append">
                                <label class="input-group-text" for="group_name">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
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
                                    <i class="fa fa-phone" aria-hidden="true"></i>
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
@endsection
