@extends('layouts.app')

@section('content')
<div id="page-wrapper">
        <div class="container-fluid">
          <div class="row">
            <ol class="breadcrumb">
              <li><a href="{{ route('home') }}">Panel Administratora</a></li>
              <li class="active"><a href="{{ route('seller.index') }}">Sprzedawcy</a></li>
              <li class="active">Edytuj sprzedawce</li>
            </ol>
          </div>
            <div class="row" id="main" >
            <div class="panel panel-default">
                <div class="panel-heading"><b>Edycja sprzedawcy</b></div>
                <div class="panel-body">
                  {{-- <form class="form-horizontal" role="form" method="POST" action="{{ route('employee.update') }}"> --}}
                      {{ csrf_field() }}
                      {!! Form::model($seller, ['method' => 'PATCH', 'class' => 'form-horizontal', 'action' => ['SellerController@update', $seller->id] ]) !!}

                      {{-- name --}}
                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="col-md-4 control-label">Imię</label>

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

                      {{-- surname --}}
                      <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                          <label for="surname" class="col-md-4 control-label">Nazwisko</label>

                          <div class="col-md-6">
                              {{-- <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" required autofocus> --}}
                              {!! Form::text('surname', null, ['class' => 'form-control']) !!}
                              @if ($errors->has('surname'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('surname') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- address --}}
                      <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                          <label for="address" class="col-md-4 control-label">Adres</label>

                          <div class="col-md-6">
                              {{-- <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus> --}}
                              {!! Form::text('address', null, ['class' => 'form-control']) !!}
                              @if ($errors->has('address'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('address') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- phone number --}}
                      <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                          <label for="phone_number" class="col-md-4 control-label">Numer telefonu</label>

                          <div class="col-md-6">
                              {{-- <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}"> --}}
                              {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
                              @if ($errors->has('phone_number'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('phone_number') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-success">
                                  <i class="fa fa-floppy-o" aria-hidden="true"></i> Zapisz zmiany
                              </button>
                              <a class="btn btn-warning" href="{{ route('seller.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Powrót</a>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
