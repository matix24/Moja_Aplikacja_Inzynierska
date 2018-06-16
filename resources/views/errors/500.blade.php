<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Firma transportowa') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/error.css') }}" rel="stylesheet">
    <link href="{{ asset('font_awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{{ asset('truck.ico') }}}">

</head>
<body>
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="error-template">
                  <h1>Oops! Coś poszło nie tak :(</h1>
                  <h2>500</h2>
                  <div class="error-details">
                      Serwer napotkał błąd wewnętrzny lub błędną konfigurację i nie był w stanie wykonać żądania.
                  </div>
                  <div class="error-actions">
                      <a href="{{ route('MainPage') }}" class="btn btn-primary btn-lg"><i class="fa fa-home" aria-hidden="true"></i> Strona Główna </a>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
