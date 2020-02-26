@extends('layouts.app')

@section('content')
	<div class="container">
		@if(session()->has('message'))
			<div class="alert alert-success">
				{{ session()->get('message') }}
			</div>
		@endif

		<div class="card mb-3">
			<div class="card-header">
				<div class="input-group" id="adv-search">
					<button onclick="location.href='{{ route('add-numbers') }}'" type="button" class="btn btn-primary form-control mt-2">Neue Notfallnummer</button>
				</div>
			</div>
		</div>

		<div class="card User mb-3">
			<div class="card-header" id="headingOne">
				<h5 class="mb-0">
					<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						Alle Notfallnummern
					</button>
				</h5>
			</div>
			<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".User">
				<div class="card-body table-responsive">
					<table class="table table-hover">
						<thead>
						<th>
							Nummern-Bezeichnung
						</th>
						<th>
							Telefon-Nummer
						</th>
						<th>
							Optionen
						</th>
						</thead>
						<tbody>
						@foreach($numbers as $number)
							<tr>
								<td>
									{{ $number->name }}
								</td>
								<td>
									{{ $number->number }}
								</td>
								<td>
									<button onclick="location.href='{{ route('edit-numbers',$number->id) }}'" class="btn btn-danger ml-2"><span class="fa fa-edit"></span></button>
									<button onclick="location.href='{{ route('destroy-numbers',$number->id) }}'" class="btn btn-danger ml-2"><span class="fa fa-remove"></span></button>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection