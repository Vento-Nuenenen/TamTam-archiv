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
                        TN Auslesen
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

                    @if($user ?? '')
                        {{ $user->barcode }}
                    @endif
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
                        <input type="number" id="barcode" maxlength="13" autofocus />
                        <input type="submit" />
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
                        <input type="number" id="barcode" maxlength="13" />
                        <input type="submit" />
                    </form>
                </div>
            </div>
        </div>
	</div>
@endsection
