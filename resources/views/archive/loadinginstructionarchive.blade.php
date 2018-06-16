@extends('layouts.app')

@section('content')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}">Panel Administratora</a></li>
      <li class="active">Archiwum załadunków</li>
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
                      <p>Czy aby na pewno chcesz usunąć ten załadunek?</p>
                      {{-- <p><strong> Próba usunięcia </strong></p> --}}
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
          <th>Data załadunku</th>
          <th>Kwota [zł]</th>
          <th>Opcje</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($loadingInstructions as $loadingInstruction)
          @if ( $loadingInstruction->date >= date('Y-m-d') )
            <tr class="success">
          @else
            <tr>
          @endif
            <td>{{ $loadingInstruction->date }}</td>
            <td>{{ $loadingInstruction->amount }} zł</td>
            <td>
              @if (Auth::user()->ID_roles == 1)
                <span style="float:left; margin-right:3px;">
                  {{ Form::open(['method' => 'get', 'route' => [ 'loadingInstruction.show', $loadingInstruction->id ]]) }}
                  {{ Form::button('<i class="fa fa-bus" aria-hidden="true"></i> Załadunek', ['type' => 'submit', 'class' => 'btn btn-info btn-xs'] )  }}
                  {{ Form::close() }}</span>
                <span style="float:left; margin-right:3px;">
                  {{ Form::open(['method' => 'post', 'route' => [ 'LoadingInstructionFromArchive', $loadingInstruction->id ]]) }}
                  {{ Form::button('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Przywróć', ['type' => 'submit', 'class' => 'btn btn-info btn-xs'] )  }}
                  {{ Form::close() }}</span>

                  {!! Form::model($loadingInstruction, ['method' => 'delete', 'route' => ['loadingInstruction.destroy', $loadingInstruction->id], 'class' =>'form-inline form-delete']) !!}
                  {!! Form::hidden('id', $loadingInstruction->id) !!}
                  {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Usuń', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal']) !!}
                  {!! Form::close() !!}
              @else
                  <span style="float:left; margin-right:3px;">
                    {{ Form::open(['method' => 'get', 'route' => [ 'loadingInstruction.show', $loadingInstruction->id ]]) }}
                    {{ Form::button('<i class="fa fa-bus" aria-hidden="true"></i> Załadunek', ['type' => 'submit', 'class' => 'btn btn-info btn-xs'] )  }}
                    {{ Form::close() }}</span>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="text-center">{!! $loadingInstructions->render() !!}</div>
  </div>
@endsection
