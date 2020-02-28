@extends('layouts.app')

@section('content')
	<div class="container">
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
                            <textarea class="form-control" rows="9" name="certificate_text" id="certificate_text">
Lieber @name <br />
<br />
Du hast den Tabouret-Kurs bestanden. <br />
Wir gratulieren dir dazu ganz herzlich und freuen uns darauf, deinen Werdegang in der Pfadi zu verfolgen. <br />
<br />
Das Leitungsteam <br />
P1, P2, P3</textarea>
						</div>
						<div class="clearfix"></div>
						<div class="form-group col-md-11">
							<button type="submit" class="btn btn-success col-md-12"><i class='fa fa-fw fa-save' aria-hidden='true'></i> Drucken</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection