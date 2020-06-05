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
                <h5 class="float-left">Teilnehmer importieren</h5>

                <a href="{{  route('participations') }}" class="float-right">Zurück zu TNs</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead>
                        @foreach($participations[0] as $participation)
                            <th>{{ $participation }}</th>
                        @endforeach
                    </thead>
                    <tbody>
                        @for($i = 1; $i < count($participations); $i++)
                            <tr>
                                @foreach($participations[$i] as $participation)
                                    <td>{{ $participation }}</td>
                                @endforeach
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
