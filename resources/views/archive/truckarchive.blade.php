@extends('layouts.app')

@section('content')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}">Panel Administratora</a></li>
      <li class="active">Archiwum samochodów</li>
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
                      <p>Czy aby na pewno chcesz usunąć ten samochód?</p>
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
        @foreach ($trucks as $truck)
          <tr>
            <td>{{ $truck->truck_id_number }}</td>
            <td>{{ $truck->capacity }}</td>
            <td>{{ $truck->capacity_palete }}</td>
            @if (Auth::user()->ID_roles == 1)
              <td>
                <span style="float:left; margin-right:3px;">
                  {{ Form::open(['method' => 'post', 'route' => [ 'TruckFromArchive', $truck->id ]]) }}
                  {{ Form::button('<i class="fa fa-edit"></i> Przywróć', ['type' => 'submit', 'class' => 'btn btn-info btn-xs'] )  }}
                  {{ Form::close() }}</span>

                  {!! Form::model($truck, ['method' => 'delete', 'route' => ['truck.destroy', $truck->id], 'class' =>'form-inline form-delete']) !!}
                  {!! Form::hidden('id', $truck->id) !!}
                  {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Usuń', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal']) !!}
                  {!! Form::close() !!}
              </td>
            @endif
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="text-center">{!! $trucks->render() !!}</div>
  </div>
@endsection
