@extends('layouts.app')

@section('content')
    <div class="col-12">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="float-left">Verkauf</h5>

                <a href="{{ route('overwatch') }}" class="float-right">Zurück zu Overwatch</a>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => 'store-groups', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                {!! csrf_field() !!}

                <div class="form-group has-feedback row {{ $errors->has('participant') ? ' has-error ' : '' }}">
                    {!! Form::label('participant', 'Teilnehmer', array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            <select class="form-control selectpicker" data-style="btn-primary" data-live-search="true" name="participant" id="participant" required>
                                <option value="">Teilnehmer wählen</option>
                                @if ($participations)
                                    @foreach($participations as $participant)
                                        @if($participant->scout_name)
                                            <option value="{{ $participant->id }}">{{ $participant->first_name }} {{ $participant->last_name }} / {{ $participant->scout_name }} - {{$participant->barcode ?? '' }}</option>
                                        @else
                                            <option value="{{ $participant->id }}">{{ $participant->first_name }} {{ $participant->last_name }} / {{ $participant->scout_name }}  - {{$participant->barcode ?? '' }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text" for="participant">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                        @if ($errors->has('participant'))
                            <span class="help-block">
                                <strong>{{ $errors->first('participant') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                

                {!! Form::button('Gruppe erstellen', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
