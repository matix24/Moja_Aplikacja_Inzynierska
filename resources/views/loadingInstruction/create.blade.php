@extends('layouts.app')

@section('content')
<div id="page-wrapper">
        <div class="container-fluid">
          <div class="row">
            <ol class="breadcrumb">
              <li><a href="{{ route('home') }}">Panel Administratora</a></li>
              <li class="active"><a href="{{ route('loadingInstruction.index') }}">Załadunek</a></li>
              <li class="active">Dodaj Załadunek</li>
            </ol>
          </div>
            <div class="row" id="main" >
            <div class="panel panel-default">
                <div class="panel-heading"><b>Utworzenie załadunku</b></div>
                <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="{{ route('loadingInstruction.store') }}">
                      {{ csrf_field() }}

                      {{-- date --}}
                      {{-- <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                          <label for="date" class="col-md-4 control-label">Data załadunku</label>

                          <div class="col-md-6">
                              <input id="date" type="text" class="form-control" name="date" value="{{ old('date') }}" required autofocus>

                              @if ($errors->has('date'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('date') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div> --}}

                      <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                          <label for="date" class="col-md-4 control-label">Data załadunku</label>

                          <div class="col-md-6">
                            <input class="form-control" id="date" name="date" value="{{ old('date') }}" placeholder="yyyy-mm-dd" type="text" required/>
                              @if ($errors->has('date'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('date') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- amount --}}
                      <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                          <label for="amount" class="col-md-4 control-label">Kwota do załadunku [zł]</label>

                          <div class="col-md-6">
                              <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" required>

                              @if ($errors->has('amount'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('amount') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- truck --}}
                      <div class="form-group{{ $errors->has('truck') ? ' has-error' : '' }}">
                          <label for="truck" class="col-md-4 control-label">Samochód</label>

                          <div class="col-md-6">
                              <select id="truck" class="form-control" name="truck" value="{{ old('truck') }}" required>
                                @foreach ($trucks as $truck)
                                  <option value="{{ $truck->id }}">{{ $truck->truck_id_number }}</option>
                                @endforeach
                              </select>

                              @if ($errors->has('truck'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('truck') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- trailer --}}
                      <div class="form-group{{ $errors->has('trailer') ? ' has-error' : '' }}">
                          <label for="trailer" class="col-md-4 control-label">Przyczepa</label>

                          <div class="col-md-6">
                              <select id="trailer" class="form-control" name="trailer" value="{{ old('trailer') }}" required>
                                @foreach ($trailers as $trailer)
                                  <option value="{{ $trailer->id }}">{{ $trailer->trailer_id_number }}</option>
                                @endforeach
                              </select>

                              @if ($errors->has('trailer'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('trailer') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- if trucker --}}
                      <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
                          <label for="user" class="col-md-4 control-label">Kierowca <br /> [Ctrl + <i class="fa fa-mouse-pointer" aria-hidden="true"></i>]</label>

                          <div class="col-md-6">
                              <select multiple id="user" class="form-control" size="10" name="user[]" value="{{ old('user[]') }}"  multiple="multiple">
                                <optgroup label="Kierownicy">
                                  @foreach ($users as $user)
                                    @if ($user->ID_roles == 1)
                                      <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                                    @endif
                                  @endforeach
                                </optgroup>
                                <optgroup label="Kierowcy">
                                  @foreach ($users as $user)
                                    @if ($user->ID_roles == 2)
                                      <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                                    @endif
                                  @endforeach
                                </optgroup>
                                <optgroup label="Pracownicy">
                                  @foreach ($users as $user)
                                    @if ($user->ID_roles == 3)
                                      <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                                    @endif
                                  @endforeach
                                </optgroup>
                              </select>
                              @if ($errors->has('user'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('user') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-success">
                                  <i class="fa fa-plus" aria-hidden="true"></i> Dalej
                              </button>
                              <a class="btn btn-warning" href="{{ route('loadingInstruction.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Powrót</a>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
