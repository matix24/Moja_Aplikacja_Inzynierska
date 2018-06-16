@extends('install.installLayout')

@section('content')
      <div class="row">
          <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-default">
                <div class="panel-heading">Instalator aplikacji</div>
                  <div class="panel-body">
                    <h3 class="text-success">Wykonaj restart aplikacji!</h3>
                    <ul class="list-group">
                      <li class="list-group-item"><span class="numberCircle">1</span>Przejdź do <strong>Wiersza Poleceń</strong></li>
                      <li class="list-group-item"><span class="numberCircle">2</span>Naciśnij <strong>Ctrl + C</strong></li>
                      <li class="list-group-item"><span class="numberCircle">3</span>Wpisz jeszcze raz <strong>php artisan serve</strong></li>
                      <li class="list-group-item"><span class="numberCircle">4</span>Kliknij przycisk poniżej.</li>
                    </ul>
                    @if ($demo == 'true')
                      <div class="">
                        <a class="btn btn-success center-block" href="{{ route('InstallDemo') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Aplikacja demo</a>
                      </div>
                    @else
                      <div class="">
                        <a class="btn btn-success center-block" href="{{ route('IndexUser') }}"><i class="fa fa-plus" aria-hidden="true"></i> Wprowadź użytkownika</a>
                      </div>
                    @endif
                  </div>
                  </div>
                </div>
          </div>
      </div>

@endsection
