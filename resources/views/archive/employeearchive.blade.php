@extends('layouts.app')

@section('content')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}">Panel Administratora</a></li>
      <li class="active">Archiwum pracowników</li>
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
                      <p>Czy aby na pewno chcesz usunąć tego pracownika?</p>
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
          <th>Email</th>
          <th>Nr Tel</th>
          <th>Adres</th>
          <th>Stanowisko</th>
          <th>Opcje</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->surname }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone_number }}</td>
            <td>{{ $user->address }}</td>
            <td>{{ $user->userroles->name }}</td>
            <td>
              @if ( Auth::user()->ID_roles == 1 )
                  <span style="float:left; margin-right:3px;">
                    {{ Form::open(['method' => 'post', 'route' => [ 'EmployeeFromArchive', $user->id ]]) }}
                    {{ Form::button('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Przywróć', ['type' => 'submit', 'class' => 'btn btn-info btn-xs'] )  }}
                    {{ Form::close() }}</span>

                    {!! Form::model($user, ['method' => 'delete', 'route' => ['employee.destroy', $user->id], 'class' =>'form-inline form-delete']) !!}
                    {!! Form::hidden('id', $user->id) !!}
                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Usuń', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal']) !!}
                    {!! Form::close() !!}
              @else
                Brak uprawnień
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="text-center">{!! $users->render() !!}</div>
  </div>


@endsection
