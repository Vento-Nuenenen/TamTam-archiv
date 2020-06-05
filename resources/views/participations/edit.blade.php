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
                <h5 class="float-left">Teilnehmer bearbeiten</h5>

                <a href="{{  route('participations') }}" class="float-right">Zurück zu TNs</a>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => ['update-participations',$participations->id], 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'enctype' => "multipart/form-data")) !!}
                {!! csrf_field() !!}

                <div class="form-group has-feedback row {{ $errors->has('scout_name') ? ' has-error ' : '' }}">
                    {!! Form::label('scout_name', 'Pfadiname', array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            {!! Form::text('scout_name', old('scut_name', $participations->scout_name ?? null), array('id' => 'scout_name', 'class' => 'form-control', 'placeholder' => 'Pfadiname')) !!}
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
                            {!! Form::text('first_name', old('first_name',$participations->first_name ?? null), array('id' => 'first_name', 'class' => 'form-control', 'placeholder' => 'Vorname', 'required')) !!}
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
                            {!! Form::text('last_name', old('last_name',$participations->last_name ?? null), array('id' => 'last_name', 'class' => 'form-control', 'placeholder' => 'Nachname', 'required')) !!}
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
                            {!! Form::text('address', old('address', $participations->address ?? null), array('id' => 'address', 'class' => 'form-control', 'placeholder' => 'Adresse', 'required')) !!}
                            <div class="input-group-append">
                                <label class="input-group-text" for="last_name">
                                    <i class="fa fa-address-book" aria-hidden="true"></i>
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
                            {!! Form::text('plz', old('plz',$participations->plz ?? null), array('id' => 'plz', 'class' => 'form-control', 'placeholder' => 'Postleitzahl', 'required')) !!}
                            <div class="input-group-append">
                                <label class="input-group-text" for="last_name">
                                    <i class="fa fa-address-book" aria-hidden="true"></i>
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
                            {!! Form::text('place', old('place',$participations->place ?? null), array('id' => 'place', 'class' => 'form-control', 'placeholder' => 'Ort', 'required')) !!}
                            <div class="input-group-append">
                                <label class="input-group-text" for="last_name">
                                    <i class="fa fa-address-book" aria-hidden="true"></i>
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
                            {!! Form::date('birthday', old('birthday',$participations->birthday ?? null), array('id' => 'birthday', 'class' => 'form-control', 'placeholder' => 'Geburtsdatum', 'required')) !!}
                            <div class="input-group-append">
                                <label class="input-group-text" for="last_name">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
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

                <div class="form-group has-feedback row {{ $errors->has('barcode') ? ' has-error ' : '' }}">
                    {!! Form::label('barcode', 'EAN Code', array('class' => 'col-md-3 control-label')); !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            {!! Form::text('barcode', old('barcode',$participations->barcode ?? null), array('id' => 'barcode', 'class' => 'form-control', 'placeholder' => 'EAN Code')) !!}
                            <div class="input-group-append">
                                <label class="input-group-text" for="last_name">
                                    <i class="fa fa-barcode" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                        @if ($errors->has('barcode'))
                            <span class="help-block">
                                <strong>{{ $errors->first('barcode') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="my-1">&nbsp;</div>

                <div class="form-group has-feedback row {{ $errors->has('gender') ? ' has-error ' : '' }}">
                    {!! Form::label('gender', 'Geschlecht', array('class' => 'col-md-3 control-label', 'required')); !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            <select class="form-control selectpicker" data-style="btn-primary" name="gender" id="gender">
                                <option value="">Geschlecht wählen</option>
                                <option value="m" {{($participations->gender == 'Männlich') ? 'selected':''}}>Männlich</option>
                                <option value="w" {{($participations->gender == 'Weiblich') ? 'selected':''}}>Weiblich</option>
                                <option value="d" {{($participations->gender == 'Anderes') ? 'selected':''}}>Anderes</option>
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text" for="group">
                                    <i class="fa fa-group" aria-hidden="true"></i>
                                </label>
                            </div>
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
                    {!! Form::label('group', 'Gruppe', array('class' => 'col-md-3 control-label', 'required')); !!}
                    <div class="col-md-9">
                        <div class="input-group">
                            <select class="form-control selectpicker" data-style="btn-primary" name="group" id="group">
                                <option value="">Gruppe wählen</option>
                                @if ($groups)
                                    @foreach($groups as $group)
                                        <option value="{{ $group->id }}" {{($participations->FK_GRP == $group->id) ? 'selected':''}}>{{ $group->group_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text" for="group">
                                    <i class="fa fa-group" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                        @if ($errors->has('role'))
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

                {!! Form::button('Teilnehmer aktualisieren', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
