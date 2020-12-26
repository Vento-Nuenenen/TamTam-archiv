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
                {!! Form::open(array('route' => 'numbers', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
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
                    <button onclick="location.href='{{ route('add-numbers') }}'" type="button" class="btn btn-primary form-control mt-2">Neue Notfallnummer</button>
                </div>
            </div>
		</div>

        <div class="clearfix p-3"></div>

        <div class="card">
			<div class="card-header">
				<h5 class="float-left">Notfallnummern</h5>

                <a href="{{  route('overwatch') }}" class="float-right">Zurück zu Overwatch</a>
            </div>
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
@endsection
