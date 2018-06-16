@extends('layouts.app')

@section('content')
<div id="page-wrapper">
        <div class="container-fluid">
          <div class="row">
            <ol class="breadcrumb">
              <li><a href="{{ route('home') }}">Panel Administratora</a></li>
              <li class="active"><a href="{{ route('packaging.index') }}">Opakowania</a></li>
              <li class="active">Edytuj opakowanie</li>
            </ol>
          </div>
            <div class="row" id="main" >
            <div class="panel panel-default">
                <div class="panel-heading"><b>Edycja opakowania</b></div>
                <div class="panel-body">
                  {{-- <form class="form-horizontal" role="form" method="POST" action="{{ route('employee.update') }}"> --}}
                      {{ csrf_field() }}
                      {!! Form::model($packaging, ['method' => 'PATCH', 'class' => 'form-horizontal', 'action' => ['PackagingProductController@update', $packaging->id] ]) !!}

                      {{-- name --}}
                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="col-md-4 control-label">Nazwa Opakownia</label>

                          <div class="col-md-6">
                              {{-- <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus> --}}
                              {!! Form::text('name', null, ['class' => 'form-control']) !!}
                              @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-success">
                                  <i class="fa fa-floppy-o" aria-hidden="true"></i> Zapisz zmiany
                              </button>
                              <a class="btn btn-warning" href="{{ route('packaging.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Powrót</a>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
