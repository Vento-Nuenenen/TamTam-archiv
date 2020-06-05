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
				<h5 class="float-left">ID-Karten für alle TN erstellen</h5>

                <a href="{{  route('overwatch') }}" class="float-right">Zurück zu Overwatch</a>
            </div>
            <div class="card-body">
                <button onclick="location.href='{{ route('print-identification') }}'" class="btn btn-success col-md-12"><i class='fa fa-fw fa-save' aria-hidden='true'></i> Drucken</button>
            </div>
		</div>
	</div>
@endsection
