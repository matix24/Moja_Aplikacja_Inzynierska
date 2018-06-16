@extends('layouts.app')

@section('content')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}">Panel Administratora</a></li>
      <li class="active">Przyczepy</li>
    </ol>
  </div>

    <div class="table-responsive">
      {{-- modal --}}
      <div class="modal fade" id="confirm">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">Potwierdź archiwizacje</h4>
                  </div>
                  <div class="modal-body">
                      <p>Czy aby na pewno chcesz archiwizować tą przyczepę?</p>
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
          <th>Nr Rejestracyjny</th>
          <th>Ładowność [kg]</th>
          <th>Ładowność pojedyńczej skrzyni [kg]</th>
          @if (Auth::user()->ID_roles == 1)
            <th>Opcje</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach ($trailers as $trailer)
          <tr>
            <td>{{ $trailer->trailer_id_number }}</td>
            <td>{{ $trailer->capacity }}</td>
            <td>{{ $trailer->capacity_palete }}</td>
            @if (Auth::user()->ID_roles == 1)
              <td>
                <span style="float:left; margin-right:3px;">
                  {{ Form::open(['method' => 'get', 'route' => [ 'trailer.edit', $trailer->id ]]) }}
                  {{ Form::button('<i class="fa fa-edit"></i> Edytuj', ['type' => 'submit', 'class' => 'btn btn-info btn-xs'] )  }}
                  {{ Form::close() }}</span>

                  {!! Form::model($trailer, ['method' => 'post', 'route' => ['TrailerToArchive', $trailer->id], 'class' =>'form-inline form-delete']) !!}
                  {!! Form::hidden('id', $trailer->id) !!}
                  {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Archiwizuj', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal']) !!}
                  {!! Form::close() !!}
              </td>
            @endif
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="text-center">{!! $trailers->render() !!}</div>
  </div>
@endsection
