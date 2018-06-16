<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Firma transportowa') }}</title>

    {{-- dla kalendarza --}}
    @if (isset($datapickerJS))
      <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.css') }}"/>
    @endif

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    {{-- <link rel="shortcut icon" href="truck.ico"> --}}
    <link rel="shortcut icon" href="{{{ asset('truck.ico') }}}">

    <!-- font_awesome -->
    {{-- <link rel="stylesheet" href="{{ asset('font_awesome/css/font-awesome.min.css') }}"/> --}}
    <style>
      .carousel-caption {
        /*max-width: 550px;*/
        /*padding: 0 20px;*/
        /*margin:0 auto;*/
        /*margin-bottom: 350px;*/
        /*text-align:center;*/
      }
      .navbar
      {
        margin-bottom: 0px;
      }
      body
      {
        background-color: black;
      }
    </style>
</head>
  <body>
    <div class="container-fluid">
      <div id="app">
        <header class="row">
          <nav class="navbar navbar-default navbar-static-top">
              <div class="container">
                  <div class="navbar-header">

                      <!-- Collapsed Hamburger -->
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                          <span class="sr-only">Toggle Navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>

                      <!-- Branding Image -->
                      <a class="navbar-brand" href="{{ url('/') }}">
                          {{ config('app.name', 'Firma transportowa') }}
                      </a>
                  </div>

                  <div class="collapse navbar-collapse" id="app-navbar-collapse">
                      <!-- Left Side Of Navbar -->
                      @if (Auth::guest())
                          {{-- <li><a href="{{ route('login') }}">Login</a></li>
                          <li><a href="{{ route('register') }}">Register</a></li> --}}
                      @else

                      @endif
                      <!-- Right Side Of Navbar -->
                      <ul class="nav navbar-nav navbar-right">
                          <!-- Authentication Links -->
                          @if (Auth::guest())
                              <li><a href="{{ route('login') }}">Logowanie</a></li>
                              {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}
                          @else
                              <li><a href="{{ url('/home') }}">Panel Administratora</a></li>
                          @endif
                      </ul>
                  </div>
              </div>
          </nav>
        </header>

        <div class="row">
          <div id="MyCarousel" class="carousel slide">
            <!-- Wskaźniki w postaci kropek -->
            <ol class="carousel-indicators">
              <li data-target="#MyCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#MyCarousel" data-slide-to="1"></li>
              <li data-target="#MyCarousel" data-slide-to="2"></li>
              <li data-target="#MyCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Slajdy -->
            <div class="carousel-inner">
              <div class="item active">
                {{-- <img src="http://placehold.it/1920x1080" alt=""> --}}
                <img src="{{ asset('img/man1.jpg') }}" alt="">
                <div class="carousel-caption">
                  {{-- <h1>Gwiazda</h1> --}}
                  {{-- <h1>Firma transportowa</h1> --}}
                </div>
              </div>
              <div class="item">
                <img src="{{ asset('img/man2.jpg') }}" alt="">
                <div class="carousel-caption">
                  {{-- <h1>Gwiazda</h1> --}}
                  {{-- <h1>Firma transportowa</h1> --}}
                </div>
              </div>
              <div class="item">
                <img src="{{ asset('img/man3.jpg') }}" alt="">
                <div class="carousel-caption">
                  {{-- <h1>Gwiazda</h1> --}}
                  {{-- <h1>Firma transportowa</h1> --}}
                </div>
              </div>
              <div class="item">
                <img src="{{ asset('img/man4.jpg') }}" alt="">
                <div class="carousel-caption">
                  {{-- <h1>Gwiazda</h1> --}}
                  {{-- <h1>Firma transportowa</h1> --}}
                </div>
              </div>

            </div>

            <!-- Strzałki do przewijania -->
            <a class="left carousel-control" href="#MyCarousel" data-slide="prev">
              <span class="icon-prev"></span>
            </a>
            <a class="right carousel-control" href="#MyCarousel" data-slide="next">
              <span class="icon-next"></span>
            </a>
          </div> {{-- end slaider --}}
        </div> {{-- end row --}}


      </div>  {{-- end div app --}}
    </div> {{-- end container --}}

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>

  </body>
</html>
