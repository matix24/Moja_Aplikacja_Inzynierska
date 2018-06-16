@extends('install.installLayout')

@section('content')
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                <div class="panel-heading">Instalator aplikacji</div>
                  <div class="panel-body">
                    <h3 class="text-danger">Nie wykryto pliku .env!</h3>
                    <div>
                      <ul class="list-group">
                        <li class="list-group-item"><span class="numberCircle">1</span>Upewnij sie, że w twoim katalogu znajduje się plik <strong>.env</strong></li>
                        <li class="list-group-item"><span class="numberCircle">2</span>Jeśli nie to uruchom <i><strong>Wiersz polecenia</strong></i> i przejdź do katalogu z aplikacją.</li>
                        <li class="list-group-item"><span class="numberCircle">3</span>Wpisz <i><strong>copy .env.example .env</strong></i></li>
                        <li class="list-group-item"><span class="numberCircle">4</span>Twój plik konfiguracyjny wrócił na miejsce.</li>
                      </ul>
                    </div>
                    <div class="">
                      <a class="btn btn-warning center-block" href="{{ route('Install') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Powrót do instalatora</a>
                    </div>
                  </div>
                </div>
          </div>
      </div>

@endsection
