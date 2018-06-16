@extends('install.installLayout')

@section('content')
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                <div class="panel-heading">Instalator aplikacji</div>
                  <div class="panel-body">
                      <form class="form-horizontal" role="form" method="POST" action="{{ route('InstallApp') }}">
                          {{ csrf_field() }}

                          {{-- app_url --}}
                          <h3>App Url</h3>
                          <div class="form-group{{ $errors->has('app_url') ? ' has-error' : '' }}">
                              <label for="app_url" class="col-md-4 control-label">App URL</label>
                              <i class="fa fa-question-circle fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Wprowadź domyślny adres url dla aplikacji. Dla XAMPP jest to http://localhost"></i>
                              <div class="col-md-6">
                                  <input id="app_url" type="text" class="form-control" name="app_url" value="{{ old('app_url') }}" placeholder="http://localhost" required autofocus>

                                  @if ($errors->has('app_url'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('app_url') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          {{-- db_connection --}}
                          <br />
                          <h3 >Baza Danych</h3>
                          <div class="form-group{{ $errors->has('db_connection') ? ' has-error' : '' }}">
                              <label for="db_connection" class="col-md-4 control-label">Typ bazy danych</label>
                              <i class="fa fa-question-circle fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Wybierz typ swojej bazy danych. Dla XAMPP jest to MySQL."></i>
                              <div class="col-md-6">
                                <select class="form-control" name="db_connection" id="db_connection" required>
                                  <option value="mysql">MySQL</option>
                                  <option value="pgsql">Postgres</option>
                                  <option value="sqlsrv">SQL Server</option>
                                  <option value="sqlite">SQLite</option>
                                </select>

                                  @if ($errors->has('db_connection'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('db_connection') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          {{-- db_host --}}
                          <div class="form-group{{ $errors->has('db_host') ? ' has-error' : '' }}">
                              <label for="db_host" class="col-md-4 control-label">Host</label>
                              <i class="fa fa-question-circle fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Wprowadź domyślny adres hosta dla aplikacji. Dla XAMPP jest to 127.0.0.1"></i>
                              <div class="col-md-6">
                                  <input id="db_host" type="text" class="form-control" name="db_host" value="{{ old('db_host') }}" placeholder="127.0.0.1" required>

                                  @if ($errors->has('db_host'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('db_host') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          {{-- db_port --}}
                          <div class="form-group{{ $errors->has('db_port') ? ' has-error' : '' }}">
                              <label for="db_port" class="col-md-4 control-label">Port</label>
                              <i class="fa fa-question-circle fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Wprowadź domyślny port dla bazy danych. Dla MySQL jest to 3306."></i>
                              <div class="col-md-6">
                                  <input id="db_port" type="text" class="form-control" name="db_port" value="{{ old('db_port') }}" placeholder="3306" required>

                                  @if ($errors->has('db_port'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('db_port') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          {{-- db_name --}}
                          <div class="form-group{{ $errors->has('db_name') ? ' has-error' : '' }}">
                              <label for="db_name" class="col-md-4 control-label">Nazwa bazy</label>
                              <i class="fa fa-question-circle fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Wprowadź nazwę bazy w której będą przechowywane dane aplikacji. Baza musi zostać utworzona przed wykonaniem instalacji aplikacji."></i>
                              <div class="col-md-6">
                                  <input id="db_name" type="text" class="form-control" name="db_name" value="{{ old('db_name') }}" placeholder="db_inzynier" required>

                                  @if ($errors->has('db_name'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('db_name') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          {{-- db_user --}}
                          <div class="form-group{{ $errors->has('db_user') ? ' has-error' : '' }}">
                              <label for="db_user" class="col-md-4 control-label">Użytkownik</label>
                              <i class="fa fa-question-circle fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Wprowadź dane użytkownika bazy danych."></i>
                              <div class="col-md-6">
                                  <input id="db_user" type="text" class="form-control" name="db_user" value="{{ old('db_user') }}" placeholder="root" required>

                                  @if ($errors->has('db_user'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('db_user') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          {{-- db_password --}}
                          <div class="form-group{{ $errors->has('db_password') ? ' has-error' : '' }}">
                              <label for="db_password" class="col-md-4 control-label">Hasło</label>
                              <i class="fa fa-question-circle fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Wprowadź hasło użytkownika bazy danych."></i>
                              <div class="col-md-6">
                                  <input id="db_password" type="password" class="form-control" name="db_password" value="{{ old('db_password') }}" required>

                                  @if ($errors->has('db_password'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('db_password') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <h3> Zaawansowane </h3>
                          <div class="form-group">
                              <label for="app_debug" class="col-md-4 control-label">Kontrola błędów</label>
                              <i class="fa fa-question-circle fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Zdecyduj czy chcesz widzieć szczegółowe komunikaty błędów."></i>
                              <div class="col-md-6">
                                <label class="switch" >
                                  <input id="app_debug" type="checkbox" name="app_debug">
                                  <span class="slider round"></span>
                                </label>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="app_example_data" class="col-md-4 control-label">Aplikacja DEMO</label>
                              <i class="fa fa-question-circle fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Zdecyduj czy chcesz wykonać czystą wersję instalacji aplikacji."></i>
                              <div class="col-md-6">
                                <label class="switch" >
                                  <input id="app_example_data" name="app_example_data" type="checkbox">
                                  <span class="slider round"></span>
                                </label>
                              </div>
                          </div>

                          <br />
                          <div class="form-group">
                            <button type="submit" class="btn btn-success center-block">
                                <i class="fa fa-plus" aria-hidden="true"></i> Instaluj
                            </button>
                          </div>
                      </form>
                  </div>
                </div>
          </div>
      </div>

@endsection
