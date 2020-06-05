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
                {!! Form::open(array('route' => 'participations', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
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
                    <button onclick="location.href='{{ route('add-participations') }}'" type="button" class="btn btn-primary form-control mt-2">Neuer Teilnehmer</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="float-left">Teilnehmer</h5>

                <a href="{{  route('overwatch') }}" class="float-right">Zurück zu Overwatch</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead>
                        <th>Name</th>
                        <th>Gruppe</th>
                        <th>Sitzplatz</th>
                        <th class="text-center">EAN Nummer</th>
                        <th>Bild</th>
                        <th>Optionen</th>
                    </thead>
                    <tbody>
                        @foreach($participations as $participation)
                            <tr>
                                <td>
                                    @if($participation->scout_name)
                                        {{ $participation->first_name }} {{ $participation->last_name }} / {{ $participation->scout_name }}
                                    @else
                                        {{ $participation->first_name }} {{ $participation->last_name }}
                                    @endif
                                </td>
                                <td>
                                    {{ $participation->group_name }}
                                </td>
                                <td>
                                    {{ $participation->seat_number }}
                                </td>
                                <td align="center">
                                    @if($participation->barcode != null)
                                        {!! DNS1D::getBarcodeHTML($participation->barcode, "EAN13", 2, 50) !!}
                                        {{ $participation->barcode }}
                                    @endif
                                </td>
                                <td>
                                    <img width="80px" src="{{ asset('storage/img/' . $participation->person_picture) }}">
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
@endsection
