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
                {!! Form::open(array('route' => 'items', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
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
                    <button onclick="location.href='{{ route('add-items') }}'" type="button" class="btn btn-primary form-control mt-2">Neuer Artikel</button>
                </div>
            </div>
        </div>

        <div class="clearfix p-3"></div>

        <div class="card">
            <div class="card-header">
                <h5 class="float-left">Artikel</h5>

                <a href="{{  route('overwatch') }}" class="float-right">Zurück zu Overwatch</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead>
                        <th>
                            Artikelname
                        </th>
                        <th>
                            Artikelpreis
                        </th>
                        <th>
                            Barcode
                        </th>
                        <th>
                            Optionen
                        </th>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                {{ $item->item_name }}
                            </td>
                            <td>
                                {{ $item->item_price }}
                            </td>
                            <td align="center">
                                @if($item->item_barcode != null)
                                    {!! DNS1D::getBarcodeHTML($item->item_barcode, "EAN13", 2, 50) !!}
                                    {{ $item->item_barcode }}
                                @endif
                            </td>
                            <td>
                                <button onclick="location.href='{{ route('edit-items', $item->id) }}'" class="btn btn-danger ml-2"><span class="fa fa-edit"></span></button>
                                <button onclick="location.href='{{ route('destroy-items', $item->id) }}'" class="btn btn-danger ml-2"><span class="fa fa-remove"></span></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
