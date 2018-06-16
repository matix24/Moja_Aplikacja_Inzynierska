@extends('layouts.app')

@section('content')
<div id="page-wrapper">
        <div class="container-fluid">
          <div class="row">
            <ol class="breadcrumb">
              <li><a href="{{ route('home') }}">Panel Administratora</a></li>
              <li class="active"><a href="{{ route('trailer.index') }}">Przyczepy</a></li>
              <li class="active">Dodaj Przyczepe</li>
            </ol>
          </div>
            <div class="row" id="main" >
            <div class="panel panel-default">
                <div class="panel-heading"><b>Utworzenie przyczepy</b></div>
                <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="{{ route('trailer.store') }}">
                      {{ csrf_field() }}

                      {{-- trailer_id_number --}}
                      <div class="form-group{{ $errors->has('trailer_id_number') ? ' has-error' : '' }}">
                          <label for="trailer_id_number" class="col-md-4 control-label">Numer Rejestracyjny</label>

                          <div class="col-md-6">
                              <input id="trailer_id_number" type="text" class="form-control" name="trailer_id_number" value="{{ old('trailer_id_number') }}" required autofocus>

                              @if ($errors->has('trailer_id_number'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('trailer_id_number') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- capacity --}}
                      <div class="form-group{{ $errors->has('capacity') ? ' has-error' : '' }}">
                          <label for="capacity" class="col-md-4 control-label">Ładowność [kg]</label>

                          <div class="col-md-6">
                              <input id="capacity" type="text" class="form-control" name="capacity" value="{{ old('capacity') }}" required autofocus>

                              @if ($errors->has('capacity'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('capacity') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- capacity_palete --}}
                      <div class="form-group{{ $errors->has('capacity_palete') ? ' has-error' : '' }}">
                          <label for="capacity_palete" class="col-md-4 control-label">Ładowność pojedynczej palety [kg]</label>

                          <div class="col-md-6">
                              <input id="capacity_palete" type="text" class="form-control" name="capacity_palete" value="{{ old('capacity_palete') }}" required autofocus>

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
                                  <i class="fa fa-plus" aria-hidden="true"></i> Dodaj przyczepe
                              </button>
                              <a class="btn btn-warning" href="{{ route('trailer.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Powrót</a>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
