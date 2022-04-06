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
                <h5 class="float-start">Nummer erstellen</h5>

                <a href="{{  route('numbers') }}" class="float-end">Zurück zu Nummern</a>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'store-numbers', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                {!! csrf_field() !!}

                <div class="row has-feedback {{ $errors->has('number_name') ? ' has-error ' : '' }}">
                    {!! Form::label('number_name', 'Nummernbezeichnung', array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        <div class="input-group mb-3">
                            {!! Form::text('number_name', NULL, array('id' => 'number_name', 'class' => 'form-control', 'placeholder' => 'Nummernbezeichnung', 'required')) !!}
                            <label class="input-group-text" for="group_name">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </label>
                        </div>
                        @if ($errors->has('number_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('number_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="row has-feedback {{ $errors->has('number') ? ' has-error ' : '' }}">
                    {!! Form::label('number', 'Telefonnummer', array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        <div class="input-group mb-3">
                            {!! Form::text('number', NULL, array('id' => 'number', 'class' => 'form-control', 'placeholder' => 'Telefonnummer', 'required')) !!}
                            <label class="input-group-text" for="group_name">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                            </label>
                        </div>
                        @if ($errors->has('number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('number') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {!! Form::button('Nummer erstellen', array('class' => 'btn btn-success col-12','type' => 'submit' )) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
