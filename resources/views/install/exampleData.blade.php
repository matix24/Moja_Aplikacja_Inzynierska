@extends('install.installLayout')

@section('content')
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                <div class="panel-heading">Instalator aplikacji</div>
                  <div class="panel-body">
                    <h3 class="text-success">Do bazy danych zostały dodane przykładowe dane.</h3>
                    <div>
                      <ul class="list-group">
                        <li class="list-group-item"><span class="numberCircle">1</span>W tej wersji zostali również dodani już użytkownicy.</li>
                        <li class="list-group-item">
                          <span class="numberCircle">2</span>
                          Login: <strong>szumiela@example.pl</strong>  Hasło: <strong>123456</strong>
                        </li>
                      </ul>
                    </div>
                    <div class="">
                      <a class="btn btn-success center-block" href="{{ route('login') }}">Logowanie</a>
                    </div>
                  </div>
                </div>
          </div>
      </div>

@endsection
