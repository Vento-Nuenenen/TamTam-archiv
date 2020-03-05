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
						TN Bestanden
					</button>
				</h5>
			</div>
			<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".User">
				<div class="card-body table-responsive">
					{!! Form::open(array('route' => 'do-passed', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
					{!! csrf_field() !!}
						<table class="table table-hover">
							<thead>
								<th>
									Name
								</th>
								<th>
									Hat Bestanden
								</th>
							</thead>
							<tbody>
								@foreach($participations as $participation)
									<tr>
										<td>
											@if($participation->scout_name)
												{{ $participation->scout_name }} / {{ $participation->first_name }} {{ $participation->last_name }}
											@else
												{{ $participation->first_name }} {{ $participation->last_name }}
											@endif
										</td>
										<td>
											<input type="checkbox" name="has_passed[]" value="{{ $participation->id }}" {{ isset($participation->course_passed) && $participation->course_passed == 1 ? 'checked' : '' }} />
											<input type="hidden" name="not_passed[]" value="{{ $participation->id }}" />
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>

						<button type="submit" class="btn btn-primary form-control mt-2">Einstellungen eintragen</button>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection