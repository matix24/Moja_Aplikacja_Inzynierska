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
    <link rel="shortcut icon" href="{{{ asset('truck.ico') }}}">

    <!-- font_awesome -->
    <link rel="stylesheet" href="{{ asset('font_awesome/css/font-awesome.min.css') }}"/>
</head>
<body>
  <div class="container">
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
                        <li><a href="{{ route('register') }}">Rejestracja</a></li> --}}
                    @else
                      <ul class="nav navbar-nav">
                          {{-- &nbsp; --}}
                          <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>  Pracownicy <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu" role="menu">
                                  <li>
                                      <a href="{{ route('employee.index') }}">
                                          <i class="fa fa-user-circle" aria-hidden="true"></i> Pracownicy
                                      </a>
                                  </li>
                                  @if (Auth::user()->ID_roles == 1)
                                    <li>
                                        <a href="{{ route('employee.create') }}">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Dodaj pracownika
                                        </a>
                                    </li>
                                  @endif
                              </ul>
                          </li>
                          <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                  <i class="fa fa-users" aria-hidden="true"></i> Sprzedawcy <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu" role="menu">
                                  <li>
                                      <a href="{{ route('seller.index') }}">
                                          <i class="fa fa-users" aria-hidden="true"></i> Sprzedawcy
                                      </a>
                                  </li>
                                  @if ( (Auth::user()->ID_roles == 1) || (Auth::user()->ID_roles == 2) )
                                    <li>
                                        <a href="{{ route('seller.create') }}">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Dodaj sprzedawce
                                        </a>
                                    </li>
                                  @endif
                              </ul>
                          </li>
                          <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                  <i class="fa fa-lemon-o" aria-hidden="true"></i> Towary <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu" role="menu">
                                  <li>
                                      <a href="{{ route('ware.index') }}">
                                          <i class="fa fa-lemon-o" aria-hidden="true"></i> Towary
                                      </a>
                                  </li>
                                    @if ( (Auth::user()->ID_roles == 1) || (Auth::user()->ID_roles == 2) )
                                    <li>
                                        <a href="{{ route('ware.create') }}">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Dodaj Towar
                                        </a>
                                    </li>
                                  @endif
                                  <li role="separator" class="divider"></li>
                                  <li>
                                      <a href="{{ route('packaging.index') }}">
                                          <i class="fa fa-codepen" aria-hidden="true"></i> Opakowania
                                      </a>
                                  </li>
                                  @if ( (Auth::user()->ID_roles == 1) || (Auth::user()->ID_roles == 2) )
                                    <li>
                                        <a href="{{ route('packaging.create') }}">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Dodaj opakowanie
                                        </a>
                                    </li>
                                  @endif
                              </ul>
                          </li>
                          <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                  <i class="fa fa-truck" aria-hidden="true"></i> Flota <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu" role="menu">
                                  <li>

                                      <a href="{{ route('truck.index') }}">
                                          <i class="fa fa-truck" aria-hidden="true"></i> Samochody
                                      </a>
                                  </li>
                                  @if (Auth::user()->ID_roles == 1)
                                    <li>
                                        <a href="{{ route('truck.create') }}">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Dodaj samochód
                                        </a>
                                    </li>
                                  @endif
                                  <li role="separator" class="divider"></li>
                                  <li>
                                      <a href="{{ route('trailer.index') }}">
                                          <i class="fa fa-cubes" aria-hidden="true"></i> Przyczepy
                                      </a>
                                  </li>
                                  @if (Auth::user()->ID_roles == 1)
                                    <li>
                                        <a href="{{ route('trailer.create') }}">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Dodaj przyczepę
                                        </a>
                                    </li>
                                  @endif
                              </ul>
                          </li>
                          <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                  <i class="fa fa-bus" aria-hidden="true"></i> Załadunek <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu" role="menu">
                                  <li>
                                      <a href="{{ route('loadingInstruction.index') }}">
                                          <i class="fa fa-bus" aria-hidden="true"></i> Załadunek
                                      </a>
                                  </li>
                                  @if (Auth::user()->ID_roles == 1)
                                    <li>
                                        <a href="{{ route('loadingInstruction.create') }}">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Dodaj załadunek
                                        </a>
                                    </li>
                                  @endif
                              </ul>
                          </li>
                      </ul>
                    @endif
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            {{-- <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Rejestracja</a></li> --}}
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-archive" aria-hidden="true"></i> Archiwum <b class="caret"></b></a>

                                      <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('EmployeeArchive') }}">
                                                 <i class="fa fa-user-circle" aria-hidden="true"></i> Pracownicy
                                            </a>
                                        </li>
                                        @if ( Auth::user()->ID_roles == 1 )
                                          <li>
                                              <a href="{{ route('SellerArchive') }}">
                                                  <i class="fa fa-users" aria-hidden="true"></i> Sprzedawcy
                                              </a>
                                          </li>
                                          <li>
                                              <a href="{{ route('WareArchive') }}">
                                                  <i class="fa fa-lemon-o" aria-hidden="true"></i> Towary
                                              </a>
                                          </li>
                                          <li>
                                              <a href="{{ route('PackagingProductArchive') }}">
                                                  <i class="fa fa-codepen" aria-hidden="true"></i> Opakowania
                                              </a>
                                          </li>
                                          <li>
                                              <a href="{{ route('TruckArchive') }}">
                                                  <i class="fa fa-truck" aria-hidden="true"></i> Samochody
                                              </a>
                                          </li>
                                          <li>
                                              <a href="{{ route('TrailerArchive') }}">
                                                  <i class="fa fa-cubes" aria-hidden="true"></i> Przyczepy
                                              </a>
                                          </li>
                                          @endif
                                          <li>
                                              <a href="{{ route('LoadingInstructionArchive') }}">
                                                  <i class="fa fa-bus" aria-hidden="true"></i> Załadunek
                                              </a>
                                          </li>
                                      </ul>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i> Wyloguj
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
      </header>

        @yield('content')


    <div class="flash-message">
      @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
          <p class="alert alert-{{ $msg }}">
            <strong>
              {{ Session::get('alert-' . $msg) }}&nbsp;&nbsp;&nbsp;
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </strong>
          </p>
        @endif
      @endforeach
    </div>
    </div>
  </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- for modals bootstrap --}}
    @if ( isset($customModalJS) )
      <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('js/customModalJS.js') }}"></script>
    @endif
    @if ( isset($customModalWaresJS) )
      <script src="{{ asset('js/customModalWaresJS.js') }}"></script>
    @endif

    {{-- do edycji danych w skrzyniach --}}
    @if ( isset($wares_in_the_boxes) )
      <script type="text/javascript">
        @foreach ($wares_in_the_boxes as $key => $value)
            $('#submit-edit-{{$value->id}}').click(function(){
                $('#wares_boxes_edit-{{$value->id}}').submit();
            });
        @endforeach
      </script>
    @endif

    {{-- do kalendarza --}}
    @if (isset($datapickerJS))
      <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/customDatepicker.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.pl.js') }}"></script>
    @endif

    {{-- navbar archiwum --}}
    <script type="text/javascript" src="{{ asset('js/customNavbar.js') }}"></script>

    {{-- script to modal validation add --}}
    @if ($errors->has('error_box_number'))
      <script type="text/javascript">
        $('#add_wares_box-{{ $errors->first('error_box_number') }}').modal({ 'show' : true  });
      </script>
    @endif

    {{-- script to modal validation edit --}}
    @if ($errors->has('edit_error_id_number'))
      <script type="text/javascript">
        $('#edit_wares_box-{{ $errors->first('edit_error_id_number') }}').modal({ 'show' : true  });
      </script>
    @endif

</body>
</html>
