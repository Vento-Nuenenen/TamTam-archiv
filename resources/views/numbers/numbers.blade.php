@extends('layouts.app')

@section('content')
	<div class="container">
		@if(session()->has('message'))
			<div class="alert alert-success">
				{{ session()->get('message') }}
			</div>
		@endif

		<div class="card">
			<div class="card-header">
                <div class="input-group" id="adv-search">
                    <button onclick="location.href='{{ route('add-numbers') }}'" type="button" class="btn btn-primary form-control mt-2">Neue Notfallnummer</button>
                </div>
            </div>
		</div>

        <div class="clearfix p-3"></div>

        <div class="card">
			<div class="card-header">
				<h5 class="float-start">Notfallnummern</h5>

                <a href="{{  route('overwatch') }}" class="float-end">Zurück zu Overwatch</a>
            </div>
            <div class="card-body table-responsive">
                <table id="table" class="table table-hover">
                    <thead>
                        <th></th>
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
                    <tbody id="tablecontents">
						@foreach($numbers as $number)
							<tr data-id="{{ $number->id }}">
                                <td>
                                    <span class="fa fa-arrows"></span>
                                </td>
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

@section('script')
    <script src="{{ asset('js/numberSort.js') }}" defer></script>
@endsection
