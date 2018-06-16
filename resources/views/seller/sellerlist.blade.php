@extends('layouts.app')

@section('content')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}">Panel Administratora</a></li>
      <li class="active">Sprzedawcy</li>
    </ol>
  </div>

    <div class="table-responsive">
      {{-- modal --}}
      <div class="modal fade" id="confirm">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Potwierdź usunięcie</h4>
                  </div>
                  <div class="modal-body">
                      <p>Czy aby na pewno chcesz archiwizować tego sprzedawcę?</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-sm btn-primary" id="delete-btn">Tak</button>
                      <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Nie</button>
                  </div>
              </div>
          </div>
      </div>
      {{-- endmodal --}}
    <table class="table table-hover" data-toggle="dataTable" data-form="deleteForm">
      <thead>
        <tr>
          <th>Imię</th>
          <th>Nazwisko</th>
          <th>Adres</th>
          <th>Nr Tel</th>
          @if ( Auth::user()->ID_roles == 1 )
            <th>Opcje</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach ($sellers as $seller)
          <tr>
            <td>{{ $seller->name }}</td>
            <td>{{ $seller->surname }}</td>
            <td>{{ $seller->address }}</td>
            <td>{{ $seller->phone_number }}</td>
              @if ( Auth::user()->ID_roles == 1 )
                <td>
                  <span style="float:left; margin-right:3px;">
                    {{ Form::open(['method' => 'get', 'route' => [ 'seller.edit', $seller->id ]]) }}
                    {{ Form::button('<i class="fa fa-edit"></i> Edytuj', ['type' => 'submit', 'class' => 'btn btn-info btn-xs'] )  }}
                    {{ Form::close() }}</span>

                    {!! Form::model($seller, ['method' => 'post', 'route' => ['SellerToArchive', $seller->id], 'class' =>'form-inline form-delete']) !!}
                    {!! Form::hidden('id', $seller->id) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Archiwizuj', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal']) !!}
                    {!! Form::close() !!}
                  </td>
                @endif
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="text-center">{!! $sellers->render() !!}</div>
  </div>
@endsection
