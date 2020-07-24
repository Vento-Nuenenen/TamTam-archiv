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
				<h5 class="float-left">Gratulationen</h5>

                <a href="{{  route('overwatch') }}" class="float-right">Zurück zu Overwatch</a>
			</div>
            <div class="card-body">
                Hier können Gratulationen für alle TN als PDF exportiert werden. Diese Richten sich nach dem eingegebenen Text, welcher mit bestimmten "Pattern" versehen werden kann.
                @name wird durch den Pfadinamen des TN ersetzt. @title wird durch die definierten Anreden ersetzt (Genderabhängig).

                <br />
                <hr />
                <br />

                <form method="POST" action="{{ route('print-gratulation') }}">
                    {!! csrf_field() !!}

                    <div class="form-group has-feedback row {{ $errors->has('title') ? ' has-error ' : '' }}">
                        {!! Form::label('title', 'Anrede (@title)', array('class' => 'col-md-12 control-label')); !!}

                        <div class="col-md-12">
                            <div class="input-group">
                                {!! Form::text('title_m', old('title_m', $title_m ?? null), array('id' => 'title_m', 'class' => 'form-control', 'placeholder' => 'Anrede Männlich')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="title_m">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('title_m'))
                                <span class="help-block">
                                <strong>{{ $errors->first('title_m') }}</strong>
                            </span>
                            @endif
                        </div>

                        <span>&nbsp;</span>

                        <div class="col-md-12">
                            <div class="input-group">
                                {!! Form::text('title_f', old('title_f', $title_f ?? null), array('id' => 'title_f', 'class' => 'form-control', 'placeholder' => 'Anrede Weiblich')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="title_f">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('title_f'))
                                <span class="help-block">
                                <strong>{{ $errors->first('title_f') }}</strong>
                            </span>
                            @endif
                        </div>

                        <span>&nbsp;</span>

                        <div class="col-md-12">
                            <div class="input-group">
                                {!! Form::text('title_o', old('title_o', $title_o ?? null), array('id' => 'title_o', 'class' => 'form-control', 'placeholder' => 'Anrede Andere')) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="title_o">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('title_o'))
                                <span class="help-block">
                                <strong>{{ $errors->first('title_o') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <br />
                    <hr />
                    <br />

                    <div class="form-group col-md-12 has-feedback row {{ $errors->has('certificate_text') ? ' has-error ' : '' }}">
                        <textarea class="form-control col-12" rows="9" name="certificate_text" id="certificate_text" required>{{ $text }}</textarea>
                    </div>
                    <div class="clearfix"></div>
                    <br />
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary col-5" name="action" value="save"><i class='fa fa-fw fa-save' aria-hidden='true'></i> Speichern</button>
                        <button type="submit" class="btn btn-success col-5 offset-1" name="action" value="print"><i class='fa fa-fw fa-print' aria-hidden='true'></i> Drucken</button>
                    </div>
                </form>
            </div>
		</div>
	</div>
@endsection

@section('import')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
@endsection

@section('script')
    <script>
        CKEDITOR.replace('certificate_text', {
            language: 'de',
            width: '100%'
        });
    </script>
@endsection
