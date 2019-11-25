@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="card EditParticipant mb-3">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Teilnehmer importieren
                    </button>
                </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".EditParticipant">
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                        @foreach($participations[0] as $participation)
                            <th>
                                {{ $participation }}
                            </th>
                        @endforeach
                        </thead>
                        <tbody>
                        @for($i = 1; $i < count($participations); $i++)
                            <tr>
                                @foreach($participations[$i] as $participation)
                                    <td>
                                        {{ $participation }}
                                    </td>
                                @endforeach
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
