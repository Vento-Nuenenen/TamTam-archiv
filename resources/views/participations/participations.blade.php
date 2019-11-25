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
                {!! Form::open(array('route' => 'participations', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                <div class="input-group" id="adv-search">
                    {!! Form::text('search', NULL, array('id' => 'search', 'class' => 'form-control', 'placeholder' => 'Suche')) !!}
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary form-control">
                            <span class="fa fa-search"></span>
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="input-group" id="adv-search">
                    <button onclick="location.href='{{ route('add-participations') }}'" type="button" class="btn btn-primary form-control mt-2">Neuer Teilnehmer</button>
                </div>
            </div>
        </div>

        <div class="card TN mb-3">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Teilnehmer
                    </button>
                </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent=".TN">
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <th>
                            Name
                        </th>
                        <th>
                            Abteilung
                        </th>
                        <th>
                            Exer
                        </th>
                        <th>
                            Optionen
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
                                    {{ $participation->group_name }}
                                </td>
                                <td>
                                    {{ $participation->exer_name }}
                                </td>
                                <td>
                                    <button onclick="location.href='{{ route('edit-participations',$participation->id) }}'" class="btn btn-danger ml-2"><span class="fa fa-edit"></span></button>
                                    <button onclick="location.href='{{ route('destroy-participations',$participation->id) }}'" class="btn btn-danger ml-2"><span class="fa fa-remove"></span></button>
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
