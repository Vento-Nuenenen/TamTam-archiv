@extends('layouts.app')

@section('content')
	<div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

		<div class="card ExerOne mb-3">
			<div class="card-header" id="headingOne">
				<h5 class="mb-0">
					<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						Gratulationen
					</button>
				</h5>
			</div>
			<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".ExerOne">
				<div class="card-body table-responsive">
					Hier können Gratulationen für alle TN als PDF exportiert werden. Diese Richten sich nach dem eingegebenen Text, welcher mit bestimmten "Pattern" versehen werden kann.
					@pfadiname wird durch den Pfadinamen des TN ersetzt.

					<br />
					<hr />
					<br />

					<form method="POST" action="{{ route('print-gratulation') }}">
						{!! csrf_field() !!}

						<div class="form-group col-md-11 col-sm-offset-1 has-feedback row {{ $errors->has('certificate_text') ? ' has-error ' : '' }}">
                            <textarea class="form-control" rows="9" name="certificate_text" id="certificate_text" required>{{ $text }}</textarea>
						</div>
						<div class="clearfix"></div>
						<div class="form-group col-md-12">
							<button type="submit" class="btn btn-primary col-5" name="action" value="save"><i class='fa fa-fw fa-save' aria-hidden='true'></i> Speichern</button>
							<button type="submit" class="btn btn-success col-5 offset-1" name="action" value="print"><i class='fa fa-fw fa-print' aria-hidden='true'></i> Drucken</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
