@extends('layouts.app')

@section('content')
    <div class="col-12">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Transaktion bearbeiten</h5>

                <a href="{{  route('transactions') }}" class="float-right">Zurück zu Transaktionen</a>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => ['update-transactions', $point->id], 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
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
                                            <option value="{{ $participant->id }}" {{ ($point->FK_PRT == $participant->id) ? 'selected':'' }} > {{ $participant->first_name }} {{ $participant->last_name }} / {{ $participant->scout_name }} - {{$participant->barcode ?? '' }} </option>
                                        @else
                                            <option value="{{ $participant->id }}" {{ ($point->FK_PRT == $participant->id) ? 'selected':'' }} > {{ $participant->first_name }} {{ $participant->last_name }} - {{$participant->barcode ?? '' }} </option>
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

                <div class="form-group has-feedback row {{ $errors->has('points') ? ' has-error ' : '' }}">
                    {!! Form::label('points', 'Punkte', array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            {!! Form::text('points', old('points', $point->points ?? null), array('id' => 'points', 'class' => 'form-control', 'placeholder' => 'Punkte', 'required')) !!}
                            <div class="input-group-append">
                                <label class="input-group-text" for="points">
                                    <i class="fa fa-money" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                        @if ($errors->has('points'))
                            <span class="help-block">
                                <strong>{{ $errors->first('points') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group has-feedback row {{ $errors->has('reason') ? ' has-error ' : '' }}">
                    {!! Form::label('reason', 'Begründung', array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            {!! Form::text('reason', old('reason', $point->reason ?? null), array('id' => 'reason', 'class' => 'form-control', 'placeholder' => 'Begründung')) !!}
                            <div class="input-group-append">
                                <label class="input-group-text" for="reason">
                                    <i class="fa fa-file-text" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                        @if ($errors->has('reason'))
                            <span class="help-block">
                                <strong>{{ $errors->first('reason') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group has-feedback row {{ $errors->has('is_addition') ? ' has-error ' : '' }}">
                    {!! Form::label('is_addition', 'Transaktionstyp', array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group">
                                <input id="is_addition" name="is_addition" type="checkbox" data-toggle="toggle" data-on="Punkte hinzufügen" data-off="Punkte entfernen" data-onstyle="success" data-offstyle="danger" {{ ($point->is_addition == 1) ? 'checked' : '' }}>
                            </div>
                        </div>
                        @if ($errors->has('is_addition'))
                            <span class="help-block">
                                <strong>{{ $errors->first('is_addition') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {!! Form::button('Benutzer aktualisieren', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
