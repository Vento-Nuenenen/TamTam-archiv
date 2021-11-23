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
                {!! Form::open(array('route' => 'groups', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
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
                    <button onclick="location.href='{{ route('add-groups') }}'" type="button" class="btn btn-primary form-control mt-2">Neue Gruppe</button>
                </div>
            </div>
        </div>

        <div class="clearfix p-3"></div>

        <div class="card">
            <div class="card-header">
                <h5 class="float-left">Alle Gruppen</h5>

                <a href="{{  route('overwatch') }}" class="float-right">Zurück zu Overwatch</a>
            </div>
            <div class="card-body bootstrap-table-responsive">
                <table class="bootstrap-table bootstrap-table-hover">
                    <thead>
                        <th>
                            Gruppenname
                        </th>
                        <th>
                            Gruppen-Logo
                        </th>
                        <th>
                            Optionen
                        </th>
                    </thead>
                    <tbody>
                        @foreach($groups as $group)
                            <tr>
                                <td>
                                    {{ $group->group_name }}
                                </td>
                                <td>
                                    <img width="80px" src="{{ asset('storage/img/' . $group->logo_file_name) }}">
                                </td>
                                <td>
                                    <button onclick="location.href='{{ route('edit-groups',$group->id) }}'" class="btn btn-danger ml-2"><span class="fa fa-edit"></span></button>
                                    <button onclick="location.href='{{ route('destroy-groups',$group->id) }}'" class="btn btn-danger ml-2"><span class="fa fa-remove"></span></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
