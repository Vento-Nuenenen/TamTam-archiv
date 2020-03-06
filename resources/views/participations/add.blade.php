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

        <div class="card CreateParticipant mb-3">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Teilnehmer erstellen
                    </button>
                </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".CreateParticipant">
                <div class="card-body">
                    {!! Form::open(array('route' => 'store-participations', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'enctype' => "multipart/form-data")) !!}
                    {!! csrf_field() !!}

                    <div class="form-group has-feedback row {{ $errors->has('scout_name') ? ' has-error ' : '' }}">
                        {!! Form::label('scout_name', 'Pfadiname', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('scout_name', NULL, array('id' => 'scout_name', 'class' => 'form-control', 'placeholder' => 'Pfadiname')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="scout_name">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('scout_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('scout_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback row {{ $errors->has('first_name') ? ' has-error ' : '' }}">
                        {!! Form::label('first_name', 'Vorname', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('first_name', NULL, array('id' => 'first_name', 'class' => 'form-control', 'placeholder' => 'Vorname','required')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="first_name">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback row {{ $errors->has('last_name') ? ' has-error ' : '' }}">
                        {!! Form::label('last_name', 'Nachname', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('last_name', NULL, array('id' => 'last_name', 'class' => 'form-control', 'placeholder' => 'Nachname', 'required')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="last_name">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('last_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="my-1">&nbsp;</div>

                    <div class="form-group has-feedback row {{ $errors->has('address') ? ' has-error ' : '' }}">
                        {!! Form::label('address', 'Adresse', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('address', NULL, array('id' => 'address', 'class' => 'form-control', 'placeholder' => 'Adresse (Strasse & Nr.)', 'required')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="last_name">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback row {{ $errors->has('plz') ? ' has-error ' : '' }}">
                        {!! Form::label('plz', 'Postleitzahl', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('plz', NULL, array('id' => 'plz', 'class' => 'form-control', 'placeholder' => 'Postleitzahl (3661)', 'required')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="last_name">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('plz'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('plz') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback row {{ $errors->has('place') ? ' has-error ' : '' }}">
                        {!! Form::label('place', 'Ort', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('place', NULL, array('id' => 'place', 'class' => 'form-control', 'placeholder' => 'Ort', 'required')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="last_name">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('place'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('place') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="my-1">&nbsp;</div>

                    <div class="form-group has-feedback row {{ $errors->has('birthday') ? ' has-error ' : '' }}">
                        {!! Form::label('birthday', 'Geburtsdatum', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::date('birthday', NULL, array('id' => 'birthday', 'class' => 'form-control', 'required')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="last_name">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('birthday'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('birthday') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="my-1">&nbsp;</div>

                    <div class="form-group has-feedback row {{ $errors->has('gender') ? ' has-error ' : '' }}">
                        {!! Form::label('gender', 'Geschlecht', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                <select class="custom-select form-control selectpicker" data-style="btn-secondary" name="gender" id="gender">
                                    <option value="">Geschlecht wählen</option>
                                    <option value="m">Männlich</option>
                                    <option value="w">Weiblich</option>
                                    <option value="d">Anderes</option>
                                </select>
                            </div>
                            @if ($errors->has('gender'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="my-1">&nbsp;</div>

                    <div class="form-group has-feedback row {{ $errors->has('group') ? ' has-error ' : '' }}">
                        {!! Form::label('group', 'Gruppe', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                <select class="custom-select form-control selectpicker" data-style="btn-secondary" name="group" id="group">
                                    <option value="">Gruppe wählen</option>
                                    @if ($groups)
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @if ($errors->has('group'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('group') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback row {{ $errors->has('tn_img') ? ' has-error ' : '' }}">
                        {!! Form::label('tn_img', 'Foto', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="file" accept="image/*" id="tn_img" name="tn_img" />
                            </div>
                            @if ($errors->has('tn_img'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('tn_img') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {!! Form::button('Teilnehmer erstellen', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                    {!! Form::close() !!}
                </div>
                <br />
            </div>
        </div>

        <div class="card ImportParticipant">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Teilnehmer importieren
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent=".ImportParticipant">
                <div class="card-body table-responsive">
                    <p>
                        Um Teilnehmer zu importieren, muss eine CSV-Datei vorbereitet werden. Diese muss mit semikolon (;) separtierte Werte haben. <br />
                        <br />
                        Am einfachsten gehst du in die MiData und öffnest die Gruppe, deren Mitglieder importiert werden sollen. <br />
                        Gehe dann auf den Button "Export" --> "CSV" --> "Adressliste". <br />
                        Entferne in der heruntergeladenen Datei alle Personen und Spalten, bis die Datei aussieht, wie die Tabelle unten. <br />
                        Andernfalls kann es zu Fehlern kommen und du must noch mal von vorn beginnen. <br />
                    </p>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>
                                    Vorname
                                </th>
                                <th>
                                    Nachname
                                </th>
                                <th>
                                    Pfadiname
                                </th>
                                <th>
                                    Adresse (Str. & Nr.)
                                </th>
                                <th>
                                    PLZ
                                </th>
                                <th>
                                    Ort
                                </th>
                                <th>
                                    Geschlecht (m*, w*, u*)
                                </th>
                                <th>
                                    Geburtsdatum
                                </th>
                                <th>
                                    Gruppe (Kann leer gelassen werden)
                                </th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Caspar
                                    </td>
                                    <td>
                                        Brenneisen
                                    </td>
                                    <td>
                                        Vento
                                    </td>
                                    <td>
                                        Hubelmattweg 5
                                    </td>
                                    <td>
                                        3634
                                    </td>
                                    <td>
                                        Thierachern
                                    </td>
                                    <td>
                                        männlich
                                    </td>
                                    <td>
                                        23.02.1999
                                    </td>
                                    <td>
                                        Migros, Coop
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    <hr />
                    {!! Form::open(array('route' => 'import-participations', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'enctype' => "multipart/form-data")) !!}
                    {!! csrf_field() !!}
                    <input type="file" accept="text/csv" id="participations_list" name="participations_list" >
                    {!! Form::button('Teilnehmer importieren', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
