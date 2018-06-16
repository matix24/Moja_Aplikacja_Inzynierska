@extends('layouts.app')

@section('content')
<div id="page-wrapper">
        <div class="container-fluid">
          <div class="row">
            <ol class="breadcrumb">
              <li><a href="{{ route('home') }}">Panel Administratora</a></li>
              <li class="active"><a href="{{ route('truck.index') }}">Samochody</a></li>
              <li class="active">Edytuj samochód</li>
            </ol>
          </div>
            <div class="row" id="main" >
            <div class="panel panel-default">
                <div class="panel-heading"><b>Edycja samochodu</b></div>
                <div class="panel-body">
                  {{-- <form class="form-horizontal" role="form" method="POST" action="{{ route('employee.update') }}"> --}}
                      {{ csrf_field() }}
                      {!! Form::model($truck, ['method' => 'PATCH', 'class' => 'form-horizontal', 'action' => ['TruckController@update', $truck->id] ]) !!}

                      {{-- truck_id_number --}}
                      <div class="form-group{{ $errors->has('truck_id_number') ? ' has-error' : '' }}">
                          <label for="truck_id_number" class="col-md-4 control-label">Numer rejestracyjny</label>

                          <div class="col-md-6">
                              {{-- <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus> --}}
                              {!! Form::text('truck_id_number', null, ['class' => 'form-control']) !!}
                              @if ($errors->has('truck_id_number'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('truck_id_number') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- capacity --}}
                      <div class="form-group{{ $errors->has('capacity') ? ' has-error' : '' }}">
                          <label for="capacity" class="col-md-4 control-label">Ładowność [kg]</label>

                          <div class="col-md-6">
                              {{-- <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" required autofocus> --}}
                              {!! Form::text('capacity', null, ['class' => 'form-control']) !!}
                              @if ($errors->has('capacity'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('capacity') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- capacity_palete --}}
                      <div class="form-group{{ $errors->has('capacity_palete') ? ' has-error' : '' }}">
                          <label for="capacity_palete" class="col-md-4 control-label">Ładowność pojedyńczej palety [kg]</label>

                          <div class="col-md-6">
                              {{-- <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus> --}}
                              {!! Form::text('capacity_palete', null, ['class' => 'form-control']) !!}
                              @if ($errors->has('capacity_palete'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('capacity_palete') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-success">
                                  <i class="fa fa-floppy-o" aria-hidden="true"></i> Zapisz zmiany
                              </button>
                              <a class="btn btn-warning" href="{{ route('truck.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Powrót</a>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
