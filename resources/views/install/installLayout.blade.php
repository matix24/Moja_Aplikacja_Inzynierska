<!doctype html>
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
    <link href="{{ asset('css/install.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{{ asset('truck.ico') }}}">
    <!-- font_awesome -->
    <link rel="stylesheet" href="{{ asset('font_awesome/css/font-awesome.min.css') }}"/>
  </head>

  <body>
    <div class="container">
      <header class="row">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Firma transportowa') }}
                    </a>
                </div>
            </div>
        </nav>
      </header>

      @yield('content')

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript">
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
      })
    </script>
  </body>
</html>
