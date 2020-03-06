@extends('layouts.app')

@section('content')
	<div class="container">
		@if(session()->has('message'))
			<div class="alert alert-success">
				{{ session()->get('message') }}
			</div>
		@endif

		<div class="card User mb-3">
			<div class="card-header" id="headingOne">
				<h5 class="mb-0">
					<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						Barcode Auslesen
					</button>
				</h5>
			</div>
			<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".User">
				<div class="card-body table-responsive">
					<form method="post">
						@csrf
						<input type="number" id="barcode" name="barcode" maxlength="13" autofocus />
						<input type="submit" />
					</form>

					<div class="card-body table-responsive">
						@if($tn ?? '')
							<table id="dataTable" class="table table-hover">
								<tr>
									<th>Barcode: </th>
									<td>{{ $tn->barcode }}</td>
								</tr>
								<tr>
									<th>Pfadiname: </th>
									<td>{{ isset($tn->scout_name) ? $tn->scout_name : 'K.A.' }}</td>
								</tr>
								<tr>
									<th>Vor- & Nachname: </th>
									<td>{{ $tn->first_name . ' ' . $tn->last_name }}</td>
								</tr>
								<tr>
									<th>Gruppe: </th>
									<td>{{ $tn->group_name }}</td>
								</tr>
								<tr>
									<th>Sitzplatz: </th>
									<td>{{ $tn->seat_number }}</td>
								</tr>
								<tr>
									<th>Aktuelle Punkte: </th>
									<td>{{ $tn->current_balance }}</td>
								</tr>
							</table>
						@endif
					</div>
				</div>
			</div>
		</div>

		<div class="card User mb-3">
			<div class="card-header" id="headingTwo">
				<h5 class="mb-0">
					<button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						Tischordnung erstellen
					</button>
				</h5>
			</div>
			<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent=".User">
				<div class="card-body table-responsive">
					<form method="post">
						@csrf
						<input onclick="return confirm('Are you sure?')" type="submit" name="tableorder" id="tableorder" class="btn btn-success col-md-12" value="Tischordnung erstellen" />
					</form>
				</div>
			</div>
		</div>

		<div class="card User mb-3">
			<div class="card-header" id="headingThree">
				<h5 class="mb-0">
					<button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						Gruppen aufteilen
					</button>
				</h5>
			</div>
			<div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent=".User">
				<div class="card-body table-responsive">
					<form method="post">
						@csrf
						<input onclick="return confirm('Are you sure?')" type="submit" name="grouping" id="grouping" class="btn btn-success col-md-12" value="Gruppen aufteilen" />
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
