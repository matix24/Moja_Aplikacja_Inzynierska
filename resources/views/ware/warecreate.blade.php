@extends('layouts.app')

@section('content')
<div id="page-wrapper">
        <div class="container-fluid">
          <div class="row">
            <ol class="breadcrumb">
              <li><a href="{{ route('home') }}">Panel Administratora</a></li>
              <li class="active"><a href="{{ route('ware.index') }}">Towary</a></li>
              <li class="active">Dodaj Towar</li>
            </ol>
          </div>
            <div class="row" id="main" >
            <div class="panel panel-default">
                <div class="panel-heading"><b>Utworzenie towaru</b></div>
                <div class="panel-body">
                  <form class="form-horizontal" role="form" method="POST" action="{{ route('ware.store') }}">
                      {{ csrf_field() }}

                      {{-- name --}}
                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name" class="col-md-4 control-label">Nazwa towaru</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus="autofocus" required>

                              @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- packagingproducts --}}
                      <div class="form-group{{ $errors->has('ID_packaging') ? ' has-error' : '' }}">
                          <label for="ID_packaging" class="col-md-4 control-label">Opakowanie</label>

                          <div class="col-md-6">
                              <select id="ID_packaging" class="form-control" name="ID_packaging" value="{{ old('ID_packaging') }}" required>
                                @foreach ($packagings as $packaging)
                                  <option value="{{ $packaging->id }}">{{ $packaging->name }}</option>
                                @endforeach
                              </select>

                              @if ($errors->has('ID_packaging'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('ID_packaging') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- qualityproducts --}}
                      {{-- <div class="form-group{{ $errors->has('ID_quality') ? ' has-error' : '' }}">
                          <label for="ID_quality" class="col-md-4 control-label">Jakość</label>

                          <div class="col-md-6">
                              <select id="ID_quality" class="form-control" name="ID_quality" value="{{ old('ID_quality') }}" required>
                                @foreach ($qualites as $quality)
                                  <option value="{{ $quality->id }}">{{ $quality->name }}</option>
                                @endforeach
                              </select>

                              @if ($errors->has('ID_quality'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('ID_quality') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div> --}}

                      {{-- hardinessproducts --}}
                      {{-- <div class="form-group{{ $errors->has('ID_hardiness') ? ' has-error' : '' }}">
                          <label for="ID_hardiness" class="col-md-4 control-label">Wytrzymałość</label>

                          <div class="col-md-6">
                              <select id="ID_hardiness" class="form-control" name="ID_hardiness" value="{{ old('ID_hardiness') }}" required>
                                @foreach ($hardinesss as $hardiness)
                                  <option value="{{ $hardiness->id }}">{{ $hardiness->name }}</option>
                                @endforeach
                              </select>

                              @if ($errors->has('ID_hardiness'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('ID_hardiness') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div> --}}

                      {{-- weight_of_package --}}
                      <div class="form-group{{ $errors->has('weight_of_package') ? ' has-error' : '' }}">
                          <label for="weight_of_package" class="col-md-4 control-label">Waga Opakowania [kg]</label>

                          <div class="col-md-6">
                              <input id="weight_of_package" type="text" class="form-control" name="weight_of_package" value="{{ old('weight_of_package') }}" required>

                              @if ($errors->has('weight_of_package'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('weight_of_package') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-6 col-md-offset-4">
                              <button type="submit" class="btn btn-success">
                                  <i class="fa fa-plus" aria-hidden="true"></i> Utwórz towar
                              </button>
                              <a class="btn btn-warning" href="{{ route('ware.index') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Powrót</a>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
