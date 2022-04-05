@extends('layouts.app')

@section('content')
    <div class="container">
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
                <h5 class="float-start">Neuer Benutzer</h5>

                <a href="{{  route('users') }}" class="float-end">Zurück zu Benutzern</a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('store-users')}}" accept-charset="UTF-8" role="form" class="needs-validation form-horizontal">
                    @csrf

                    <div class="row has-feedback {{ $errors->has('scout_name') ? ' has-error ' : '' }}">
                        <label for="scout_name" class="col-md-3 form-label">Pfadiname</label>
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                                <input id="scout_name" class="form-control" placeholder="Pfadiname" name="scout_name" type="text" />

                                <label class="input-group-text" for="scout_name">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </label>
                            </div>
                            @if ($errors->has('scout_name'))
                                <span class="help-block">
                                <strong>{{ $errors->first('scout_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row has-feedback {{ $errors->has('first_name') ? ' has-error ' : '' }}">
                        <label for="first_name" class="col-md-3 form-label">Vorname</label>
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                                <input id="first_name" class="form-control" placeholder="Vorname" name="first_name" type="text" required />

                                <label class="input-group-text" for="first_name">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </label>
                            </div>
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row has-feedback {{ $errors->has('last_name') ? ' has-error ' : '' }}">
                        <label for="last_name" class="col-md-3 form-label">Nachname</label>
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                                <input id="last_name" class="form-control" placeholder="Nachname" name="last_name" type="text" required />
                                <label class="input-group-text" for="last_name">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </label>
                            </div>
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row has-feedback {{ $errors->has('email') ? ' has-error ' : '' }}">
                        {!! Form::label('email', 'E-Mail', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                                {!! Form::text('email', NULL, array('id' => 'email', 'class' => 'form-control', 'placeholder' => 'E-Mail', 'required')) !!}
                                <label class="input-group-text" for="email">
                                    <i class="fa fa-mail-forward" aria-hidden="true"></i>
                                </label>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row has-feedback {{ $errors->has('password') ? ' has-error ' : '' }}">
                        {!! Form::label('password', 'Passwort', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                                {!! Form::password('password', array('id' => 'password', 'class' => 'form-control', 'placeholder' => 'Passwort', 'required')) !!}
                                <label class="input-group-text" for="password">
                                    <i class="fa fa-key" aria-hidden="true"></i>
                                </label>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row has-feedback {{ $errors->has('password_repeat') ? ' has-error ' : '' }}">
                        {!! Form::label('password_repeat', 'Passwort wiederholen', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                                {!! Form::password('password_repeat', array('id' => 'password_repeat', 'class' => 'form-control', 'placeholder' => 'Passwort wiederholen', 'required')) !!}
                                <label class="input-group-text" for="password_repeat">
                                    <i class="fa fa-key" aria-hidden="true"></i>
                                </label>
                            </div>
                            @if ($errors->has('password_repeat'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password_repeat') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <button class="btn btn-success mt-1 col-12" type="submit">Benutzer erstellen</button>
                </form>
            </div>
        </div>
    </div>
@endsection
