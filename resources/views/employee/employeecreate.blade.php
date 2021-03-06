@extends('layouts.app')

@section('content')
<div id="page-wrapper">
        <div class="container-fluid">
          <div class="row">
            <ol class="breadcrumb">
              <li><a href="{{ route('home') }}">Panel Administratora</a></li>
              <li class="active"><a href="{{ route('employee.index') }}">Pracownicy</a></li>
              <li class="active">Dodaj pracownika</li>
            </ol>
          </div>
            <div class="row" id="main" >
            <div class="panel panel-default">
                <div class="panel-heading"><b>Utworzenie pracownika</b></div>
                <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="{{ route('employee.store') }}">
                      {{ csrf_field() }}

                      {{-- name --}}
                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="col-md-4 control-label">Imię</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

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
                              <input id="surname" type="text" class="form-control" name="surname" value="{{ old('surname') }}" required autofocus>

                              @if ($errors->has('surname'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('surname') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- email --}}
                      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <label for="email" class="col-md-4 control-label">E-Mail</label>

                          <div class="col-md-6">
                              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                              @if ($errors->has('email'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- phone number --}}
                      <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                          <label for="phone_number" class="col-md-4 control-label">Numer telefonu</label>

                          <div class="col-md-6">
                              <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}">

                              @if ($errors->has('phone_number'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('phone_number') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- password --}}
                      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <label for="password" class="col-md-4 control-label">Hasło</label>

                          <div class="col-md-6">
                              <input id="password" type="password" class="form-control" name="password" required>

                              @if ($errors->has('password'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- address --}}
                      <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                          <label for="address" class="col-md-4 control-label">Adres</label>

                          <div class="col-md-6">
                              <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

                              @if ($errors->has('address'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('address') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- roles --}}
                      <div class="form-group{{ $errors->has('employeerole') ? ' has-error' : '' }}">
                          <label for="employeerole" class="col-md-4 control-label">Stanowisko</label>

                          <div class="col-md-6">
                              <select id="employeerole" class="form-control" name="employeerole" value="{{ old('employeerole') }}" required>
                                @foreach ($employeerole as $role)
                                  <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                              </select>

                              @if ($errors->has('employeerole'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('employeerole') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-success">
                                <i class="fa fa-plus" aria-hidden="true"></i>  Utwórz pracownika
                              </button>
                              <a class="btn btn-warning" href="{{ route('employee.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Powrót</a>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
