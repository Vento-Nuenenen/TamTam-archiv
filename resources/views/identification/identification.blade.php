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
						ID-Karten für alle TN erstellen
					</button>
				</h5>
			</div>
			<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".User">
				<div class="card-body table-responsive">
					<button onclick="location.href='{{ route('print-identification') }}'" class="btn btn-success col-md-12"><i class='fa fa-fw fa-save' aria-hidden='true'></i> Drucken</button>
				</div>
			</div>
		</div>
	</div>
@endsection