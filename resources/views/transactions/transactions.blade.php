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
				{!! Form::open(array('route' => 'transactions', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
					<div class="input-group" id="adv-search">
						{!! Form::text('search', NULL, array('id' => 'search', 'class' => 'form-control', 'placeholder' => 'Suche')) !!}
						<div class="input-group-append">
							<button type="submit" class="btn btn-primary form-control">
								<span class="fa fa-search"></span>
							</button>
						</div>
					</div>
				{!! Form::close() !!}
				<div class="input-group" id="adv-search">
					<button onclick="location.href='{{ route('add-transactions') }}'" type="button" class="btn btn-primary form-control mt-2">Neue Transaktion</button>
				</div>
			</div>
		</div>

		<div class="card User mb-3">
			<div class="card-header" id="headingOne">
				<h5 class="mb-0">
					<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						Transaktionen
					</button>
				</h5>
			</div>
			<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".User">
				<div class="card-body table-responsive">
					<table id="dataTable" class="table table-hover">
						<thead>
							<th>
								Name
							</th>
							<th>
								Punkte
							</th>
							<th>
								Positiv / Negativ
							</th>
							<th>
								Begründung
							</th>
							<th>
								Optionen
							</th>
						</thead>
						<tbody>
							@foreach($transactions as $transaction)
								<tr class="text-color-{{ $transaction->is_addition == 1 ? 'positiv' : 'negativ' }}">
									<td>
										@if($transaction->scout_name)
											{{ $transaction->scout_name }} / {{ $transaction->first_name }} {{ $transaction->last_name }}
										@else
											{{ $transaction->first_name }} {{ $transaction->last_name }}
										@endif
									</td>
									<td>
										{{ $transaction->points }}
									</td>
									<td>
										{{ $transaction->is_addition == 1 ? 'Positiv' : 'Negativ' }}
									</td>
									<td>
										{{ $transaction->reason }}
									</td>
									<td>
										<button onclick="location.href='{{ route('edit-transactions', $transaction->id) }}'" class="btn btn-danger ml-2"><span class="fa fa-edit"></span></button>
										<button onclick="location.href='{{ route('destroy-transactions', $transaction->id) }}'" class="btn btn-danger ml-2"><span class="fa fa-remove"></span></button>
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
