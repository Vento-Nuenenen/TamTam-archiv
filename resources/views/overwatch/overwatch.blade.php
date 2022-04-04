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
				<h5>Barcode Auslesen</h5>
			</div>
			<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".User">
				<div class="card-body table-responsive">
					<form method="post">
						@csrf
						<input class="col-6" type="number" id="barcode" name="barcode" maxlength="13" autofocus />
						<input class="col-4 offset-1 btn btn-success" value="Zeigen" type="submit" />
					</form>

					<div class="card-body table-responsive">
						@if($tn ?? '')
							<table id="dataTable" class="table table-hover">
								<tr>
									<th>Barcode: </th>
									<td>{{ $tn->barcode }}</td>
								</tr>
                                <tr>
                                    <th>Bestanden: </th>
                                    <td><span class="badge badge-{{ $tn->course_passed ? 'success' : 'danger' }}">{{ $tn->course_passed ? 'Ja' : 'Nein' }}</span></td>
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
                                    <td>
                                        @if($tn->current_balance > 0)
                                            <span class="badge badge-success">{{ $tn->current_balance }}</span>
                                        @elseif($tn->current_balance < 0)
                                            <span class="badge badge-danger">{{ $tn->current_balance }}</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $tn->current_balance }}</span>
                                        @endif
                                    </td>
								</tr>
							</table>
						@endif
					</div>
				</div>
			</div>
		</div>

        <div class="clearfix p-3"></div>

        <div class="card">
			<div class="card-header">
				<h5>Tischordnung erstellen</h5>
			</div>
            <div class="card-body">
                <form method="post">
                    @csrf
                    <input onclick="return confirm('Are you sure?')" type="submit" name="tableorder" id="tableorder" class="btn btn-success col-md-12" value="Tischordnung erstellen" />
                </form>
            </div>
		</div>

        <div class="clearfix p-3"></div>

		<div class="card">
			<div class="card-header" >
				<h5>Gruppen aufteilen</h5>
			</div>
            <div class="card-body">
                <form method="post">
                    @csrf
                    <input onclick="return confirm('Are you sure?')" type="submit" name="grouping" id="grouping" class="btn btn-success col-md-12" value="Gruppen aufteilen" {{ env('ENABLE_GROUP_BUILDER') ?: 'disabled' }} />
                </form>
            </div>
		</div>
	</div>
@endsection
