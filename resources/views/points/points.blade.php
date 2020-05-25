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
				{!! Form::open(array('route' => 'points', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
					<div class="input-group" id="adv-search">
						{!! Form::text('search', NULL, array('id' => 'search', 'class' => 'form-control', 'placeholder' => 'Suche', 'autofocus')) !!}
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
						Punkte
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
						</thead>
						<tbody>
							@foreach($participations as $participant)
								<tr>
									<td>
										@if($participant->scout_name)
											 {{ $participant->first_name }} {{ $participant->last_name }} / {{ $participant->scout_name }}
										@else
											{{ $participant->first_name }} {{ $participant->last_name }}
										@endif
									</td>
									<td>
                                        @if($participant->current_balance > 0)
										    <span class="badge badge-success">{{ $participant->current_balance }}</span>
                                        @elseif($participant->current_balance > 0)
                                            <span class="badge badge-danger">{{ $participant->current_balance }}</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $participant->current_balance }}</span>
                                        @endif
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
