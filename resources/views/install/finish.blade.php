@extends('install.installLayout')

@section('content')
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                <div class="panel-heading">Instalator aplikacji</div>
                  <div class="panel-body">
                    <h3 class="text-success">Aplikacja została zainstalowana!</h3>
                      <a class="btn btn-success center-block" href="{{ route('login') }}">Logowanie</a>
                  </div>
                </div>
          </div>
      </div>

@endsection
