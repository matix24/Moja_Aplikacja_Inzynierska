@extends('layouts.app')

@section('content')
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}">Panel Administratora</a></li>
      <li><a href="{{ route('loadingInstruction.index') }}">Załadunek</a></li>
      <li class="active">Szczegóły</li>
    </ol>
  </div>

  {{-- <div class="container-fluid"> --}}
  	<div class="row">
  		<div class="col-md-8">
  			<div class="row">

          <div class="col-xs-12">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#home">Samochód</a></li>
              <li><a data-toggle="tab" href="#menu1">Przyczepa</a></li>
            </ul>
            <br /> {{--  pamiętać żeby to usunąć !!!!!!!!!!!!!!!!!!!!!!! --}}
          </div>
  			</div>
  			<div class="row">
  				<div class="col-md-12">
            <div class="tab-content">
              <div id="home" class="tab-pane fade in active">

                <div class="row">
                  <div class="col-xs-6"> {{-- skrzynia nr 1 --}}
                    Skrzynia nr 1
                    @php
                      session()->put('total_weight', 0);
                      session()->put('truck_weight', 0);
                      $weight = 0;
                      $is_empty = TRUE;
                      $box_number = 1;
                      $temp_string = 'loadingInstruction.modalWaresBoxesAdd';
                    @endphp
                    @include($temp_string)
      						</div>{{-- skrzynia nr 1 --}}

      						<div class="col-xs-6"> {{-- skrzynia nr 2 --}}
                    Skrzynia nr 2
                    @php
                      $weight = 0;
                      $is_empty = TRUE;
                      $box_number = 2;
                    @endphp
                    @include($temp_string)
      						</div> {{-- skrzynia nr 2 --}}

      					</div> {{-- koniec wiersza 1 --}}

      					<div class="row">
                  <div class="col-xs-6"> {{-- skrzynia nr 3 --}}
                    Skrzynia nr 3
                    @php
                      $weight = 0;
                      $is_empty = TRUE;
                      $box_number = 3;
                    @endphp
                    @include($temp_string)
      						</div>{{-- skrzynia nr 3 --}}

      						<div class="col-xs-6"> {{-- skrzynia nr 4 --}}
                    Skrzynia nr 4
                    @php
                      $weight = 0;
                      $is_empty = TRUE;
                      $box_number = 4;
                    @endphp
                    @include($temp_string)
      						</div> {{-- skrzynia nr 4 --}}
      					</div> {{-- koniec wiersza 2 --}}

      					<div class="row">
                  <div class="col-xs-6"> {{-- skrzynia nr 5 --}}
                    Skrzynia nr 5
                    @php
                      $weight = 0;
                      $is_empty = TRUE;
                      $box_number = 5;
                    @endphp
                    @include($temp_string)
      						</div>{{-- skrzynia nr 5 --}}

      						<div class="col-xs-6"> {{-- skrzynia nr 6 --}}
                    Skrzynia nr 6
                    @php
                      $weight = 0;
                      $is_empty = TRUE;
                      $box_number = 6;
                    @endphp
                    @include($temp_string)
      						</div> {{-- skrzynia nr 6 --}}
      					</div> {{-- koniec wiersza 3 --}}

      					<div class="row">
                  <div class="col-xs-6"> {{-- skrzynia nr 7 --}}
                    Skrzynia nr 7
                    @php
                      $weight = 0;
                      $is_empty = TRUE;
                      $box_number = 7;
                    @endphp
                    @include($temp_string)
      						</div>{{-- skrzynia nr 7 --}}

      						<div class="col-xs-6"> {{-- skrzynia nr 8 --}}
                    Skrzynia nr 8
                    @php
                      $weight = 0;
                      $is_empty = TRUE;
                      $box_number = 8;
                    @endphp
                    @include($temp_string)
      						</div> {{-- skrzynia nr 8 --}}
      					</div> {{-- koniec wiersza 4 --}}

      					<div class="row">
                  <div class="col-xs-6"> {{-- skrzynia nr 9 --}}
                    Skrzynia nr 9
                    @php
                      $weight = 0;
                      $is_empty = TRUE;
                      $box_number = 9;
                    @endphp
                    @include($temp_string)
      						</div>{{-- skrzynia nr 9 --}}

      						<div class="col-xs-6"> {{-- skrzynia nr 10 --}}
                    Skrzynia nr 10
                    @php
                      $weight = 0;
                      $is_empty = TRUE;
                      $box_number = 10;
                    @endphp
                    @include($temp_string)
      						</div> {{-- skrzynia nr 10 --}}
      					</div> {{-- koniec wiersza 5 --}}

      					<div class="row">
                  <div class="col-xs-6"> {{-- skrzynia nr 11 --}}
                    Skrzynia nr 11
                    @php
                      $weight = 0;
                      $is_empty = TRUE;
                      $box_number = 11;
                    @endphp
                    @include($temp_string)
      						</div>{{-- skrzynia nr 11 --}}

      						<div class="col-xs-6"> {{-- skrzynia nr 12 --}}
                    Skrzynia nr 12
                    @php
                      $weight = 0;
                      $is_empty = TRUE;
                      $box_number = 12;
                    @endphp
                    @include($temp_string)
      						</div> {{-- skrzynia nr 12 --}}
      					</div> {{-- koniec wiersza 6 --}}

      					<div class="row">
                  <div class="col-xs-6"> {{-- skrzynia nr 13 --}}
                    Skrzynia nr 13
                    @php
                      $weight = 0;
                      $is_empty = TRUE;
                      $box_number = 13;
                    @endphp
                    @include($temp_string)
      						</div>{{-- skrzynia nr 13 --}}

      						<div class="col-xs-6"> {{-- skrzynia nr 14 --}}
                    Skrzynia nr 14
                    @php
                      $weight = 0;
                      $is_empty = TRUE;
                      $box_number = 14;
                    @endphp
                    @include($temp_string)
      						</div> {{-- skrzynia nr 14 --}}
      					</div> {{-- koniec wiersza 7 --}}

            </div> {{-- end id home truck --}}

            <div id="menu1" class="tab-pane fade">
              <div class="row"> {{-- wiersz przyczepy 1 --}}
                <div class="col-xs-6"> {{-- skrzynia przyczepy nr 1 --}}
                  Skrzynia nr 1
                  @php
                    //$total_weight = 0;
                    session()->put('trailer_weight', 0);
                    $weight = 0;
                    $is_empty = TRUE;
                    $box_number = "P1";
                  @endphp
                  @include($temp_string)
                </div>{{-- skrzynia przyczepy nr 1 --}}

                <div class="col-xs-6"> {{-- skrzynia przyczepy nr 2 --}}
                  Skrzynia nr 2
                  @php
                    $weight = 0;
                    $is_empty = TRUE;
                    $box_number = "P2";
                  @endphp
                  @include($temp_string)
                </div> {{-- skrzynia przyczepy nr 2 --}}
              </div> {{-- koniec wiersza przyczepy 1 --}}

              <div class="row">
                <div class="col-xs-6"> {{-- skrzynia przyczepy nr 3 --}}
                  Skrzynia nr 3
                  @php
                    $weight = 0;
                    $is_empty = TRUE;
                    $box_number = "P3";
                  @endphp
                  @include($temp_string)
                </div>{{-- skrzynia przyczepy nr 3 --}}

                <div class="col-xs-6"> {{-- skrzynia przyczepy nr 4 --}}
                  Skrzynia nr 4
                  @php
                    $weight = 0;
                    $is_empty = TRUE;
                    $box_number = "P4";
                  @endphp
                  @include($temp_string)
                </div> {{-- skrzynia przyczepy nr 4 --}}
              </div> {{-- koniec wiersza przyczepy 2 --}}

              <div class="row">
                <div class="col-xs-6"> {{-- skrzynia przyczepy nr 5 --}}
                  Skrzynia nr 5
                  @php
                    $weight = 0;
                    $is_empty = TRUE;
                    $box_number = "P5";
                  @endphp
                  @include($temp_string)
                </div>{{-- skrzynia przyczepy nr 5 --}}

                <div class="col-xs-6"> {{-- skrzynia przyczepy nr 6 --}}
                  Skrzynia nr 6
                  @php
                    $weight = 0;
                    $is_empty = TRUE;
                    $box_number = "P6";
                  @endphp
                  @include($temp_string)
                </div> {{-- skrzynia przyczepy nr 6 --}}
              </div> {{-- koniec wiersza przyczepy 3 --}}

              <div class="row">
                <div class="col-xs-6"> {{-- skrzynia przyczepy nr 7 --}}
                  Skrzynia nr 7
                  @php
                    $weight = 0;
                    $is_empty = TRUE;
                    $box_number = "P7";
                  @endphp
                  @include($temp_string)
                </div>{{-- skrzynia nr przyczepy 7 --}}

                <div class="col-xs-6"> {{-- skrzynia przyczepy nr 8 --}}
                  Skrzynia nr 8
                  @php
                    $weight = 0;
                    $is_empty = TRUE;
                    $box_number = "P8";
                  @endphp
                  @include($temp_string)
                </div> {{-- skrzynia przyczepy nr 8 --}}
              </div> {{-- koniec wiersza przyczepy 4 --}}

              <div class="row">
                <div class="col-xs-6"> {{-- skrzynia przyczepy nr 9 --}}
                  Skrzynia nr 9
                  @php
                    $weight = 0;
                    $is_empty = TRUE;
                    $box_number = "P9";
                  @endphp
                  @include($temp_string)
                </div>{{-- skrzynia przyczepy nr 9 --}}

                <div class="col-xs-6"> {{-- skrzynia przyczepy nr 10 --}}
                  Skrzynia nr 10
                  @php
                    $weight = 0;
                    $is_empty = TRUE;
                    $box_number = "P10";
                  @endphp
                  @include($temp_string)
                </div> {{-- skrzynia przyczepy nr 10 --}}
              </div> {{-- koniec wiersza przyczepy 5 --}}

              <div class="row">
                <div class="col-xs-6">{{-- skrzynia przyczepy nr 11 --}}
                  Skrzynia nr 11
                  @php
                    $weight = 0;
                    $is_empty = TRUE;
                    $box_number = "P11";
                  @endphp
                  @include($temp_string)
                </div>{{-- skrzynia przyczepy nr 11 --}}
                <div class="col-xs-6">
                </div>
              </div> {{-- koniec przyczepy wiersza 6 --}}

            </div> {{-- end id menu1 trailer --}}

          </div> {{-- end tab-content --}}
        </div> {{-- end div --}}
      </div> {{-- end row --}}

  			<div class="row">
  				<div class="col-xs-12">
  					<div class="row row-custom-style">
  						<div class="col-xs-4">
                  @php
                    $truck_weight = session('truck_weight');
                    if ( $truck_weight > $wares_already_loaded->trucks->capacity)
                    {
                      $temp_w = $wares_already_loaded->trucks->capacity - $truck_weight;
                      echo '<p class="text-left text-danger"><strong>Waga&nbsp;samochodu: '.$truck_weight.'&nbsp;kg ('.$temp_w.'&nbsp;kg)</strong></p>';
                    }
                    else
                    {
                      $temp_w = $wares_already_loaded->trucks->capacity - $truck_weight;
                      echo '<p class="text-left"><strong>Waga&nbsp;samochodu: '.$truck_weight.'&nbsp;kg (+'.$temp_w.'&nbsp;kg)</strong></p>';
                    }
                  @endphp
  						</div>
  						<div class="col-xs-4">
                  @php
                    $trailer_weight = session('trailer_weight');
                    if ( $trailer_weight > $wares_already_loaded->trailers->capacity)
                    {
                      $temp_w = $wares_already_loaded->trailers->capacity - $trailer_weight;
                      echo '<p class="text-center text-danger"><strong>Waga&nbsp;przyczepy: '.$trailer_weight.'&nbsp;kg ('.$temp_w.'&nbsp;kg)</strong></p>';
                    }
                    else
                    {
                      $temp_w = $wares_already_loaded->trailers->capacity - $trailer_weight;
                      echo '<p class="text-center"><strong>Waga przyczepy:&nbsp;'.$trailer_weight.'&nbsp;kg (+'.$temp_w.'&nbsp;kg)</strong></p>';
                    }
                  @endphp
  						</div>
  						<div class="col-xs-4">
                  @php
                    $total_weight = session('total_weight');
                    if ( $total_weight > ($wares_already_loaded->trucks->capacity + $wares_already_loaded->trailers->capacity))
                    {
                      $a = $wares_already_loaded->trucks->capacity + $wares_already_loaded->trailers->capacity;
                      $temp_w = $a - $total_weight;
                      echo '<p class="text-right text-danger"><strong>Waga&nbsp;składu: '.$total_weight.'&nbsp;kg </br> ('.$temp_w.'&nbsp;kg)</strong></p>';
                    }
                    else
                    {
                      $a = $wares_already_loaded->trucks->capacity + $wares_already_loaded->trailers->capacity;
                      $temp_w = $a - $total_weight;
                      echo '<p class="text-right"><strong>Waga&nbsp;składu: '.$total_weight.'&nbsp;kg </br> (+'.$temp_w.'&nbsp;kg)</strong></p>';
                    }
                    session()->forget('total_weight');
                    session()->forget('truck_weight');
                    session()->forget('trailer_weight');
                  @endphp
  						</div>
  					</div>
  				</div>
  			</div>
  		</div>
  		<div class="col-md-4">
        <div class="row"> {{-- nagłówek --}}
          <div class="col-md-12">
            <h3 class="text-center">
              Data załadunku
            </h3>
          </div>
        </div>{{-- nagłówek --}}
        <div class="row"> {{-- data załadunku --}}
          <div class="col-md-12">
            <p class="text-center">
              <strong>{{ $data_loading_instruction->date }}</strong>
            </p>
          </div>
        </div>{{-- data załadunku --}}

  			<div class="row"> {{-- nagłówek --}}
  				<div class="col-md-12">
  					<h3 class="text-center">
  						Towary do załadunku
  					</h3>
  				</div>
  			</div>{{-- nagłówek --}}
  			<div class="row"> {{-- tabela do załadunku --}}
  				<div class="col-md-12 table-responsive">
  					<table class="table table-striped ">
  						<thead>
  							<tr>
  								<th class="text-center">Towar</th>
  								<th class="text-center">Do załadunku</th>
  								<th class="text-center">Już załadowane</th>
  								<th class="text-center">Sprzedawca</th>
  								<th class="text-center">Cena</th>
  								<th class="text-center">Priorytet</th>
  							</tr>
  						</thead>
  						<tbody>
                @if ( !empty($positions) )
                  @foreach ($positions as $key => $position)
                    <tr class="text-center">
                      <td>{{ $position->wares_name }}</td>
                      <td>{{ $position->weight_per_package }}</td>
                      <td>
                        {{ $counter_wares_already_loaded[$key] }}
                        @php $difference = $position->weight_per_package - $counter_wares_already_loaded[$key]; @endphp
                        @if ( $difference > 0 )
                          <span style="color: red;"><strong>(-{{$difference}})</strong></span>
                        @elseif ($difference < 0)
                          <span style="color: green;"><strong>(+{{$difference * -1}})</strong></span>
                        @elseif ($difference == 0)
                          <span style="color: green;"><strong>(OK)</strong></span>
                        @endif
                      </td>
                      <td>{{ $position->sellers_name }} {{ $position->surname }}</td>
                      <td>
                        {{ $position->amount }} zł
                        @if ($position->amount == $amount_wares_already_loaded[$key])
                          ({{ $amount_wares_already_loaded[$key] }})
                        @else
                          <span style="color: red;">({{ $amount_wares_already_loaded[$key] }})</span>
                        @endif
                      </td>
                      <td>
                        @if ($position->priority == 1)
                          <input class="checkbox" type="checkbox" aria-label="..." disabled checked>
                        @else
                          <input class="checkbox" type="checkbox" aria-label="..." disabled>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td class="text-center" colspan="6"><strong>Brak wyników</strong></td>
                  </tr>
                @endif
  						</tbody>
  					</table>
  				</div>
  			</div> {{-- tabela do załadunku --}}
        @if (Auth::user()->ID_roles == 1)
          <div class="row">{{-- przyciski pod tabela --}}
            <div class="col-lg-12">
              <div class="row row-custom-style">
                <div class="col-xs-4 text-left">
                  {{-- <button type="button" class="btn btn-success">
                    Dodaj
                  </button> --}}
                </div>


                <div class="col-xs-4 text-center">
                  {{ Form::open(['method' => 'get', 'route' => [ 'LoadingEdit', $data_loading_instruction->id ]]) }}
                  {{ Form::button('<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edytuj', ['type' => 'submit', 'class' => 'btn btn-warning'] )  }}
                  {{ Form::close() }}
                  {{-- <button type="button" class="btn btn-warning">
                    Edytuj
                  </button> --}}
                </div>

                <div class="col-xs-4 text-right">
                  {{-- <button type="button" class="btn btn-danger">
                    Usuń
                  </button> --}}
                </div>

              </div>
            </div>
          </div> {{-- przyciski pod tabela --}}
        @endif

        <div class="row"> {{-- nagłówek --}}
          <div class="col-md-12">
            <h3 class="text-center">
              Gotówka
            </h3>
          </div>
        </div>{{-- nagłówek --}}
        <div class="row"> {{-- finanse --}}
          <div class="col-xs-12">
            <div class="row">
              <div class="col-xs-6">
                <div class="col-xs-12 custom-padding">
                  <div class="col-xs-6 custom-padding">
                    <p class="text-left">
                      Otrzymałem:
                    </p>
                    <p class="text-left">
                      Wydałem:
                    </p>
                    @if ( ($data_loading_instruction->amount - $spend_all_money) > 0)
                      <p class="text-left text-success">
                        <strong>Posiadam:</strong>
                      </p>
                    @else
                      <p class="text-left text-danger">
                        <strong>Posiadam:</strong>
                      </p>
                    @endif
                  </div>
                  <div class="col-xs-6 custom-padding">
                    <p class="text-right" >
                      {{ $data_loading_instruction->amount }}&nbsp;zł
                    </p>
                    <p class="text-right">
                      {{ $spend_all_money }} zł
                    </p>
                    @if ( ($data_loading_instruction->amount - $spend_all_money) > 0)
                      <p class="text-right text-success">
                        <strong>{{ $data_loading_instruction->amount - $spend_all_money }}&nbsp;zł</strong>
                      </p>
                    @else
                      <p class="text-left text-danger">
                        <strong>{{ $data_loading_instruction->amount - $spend_all_money }}&nbsp;zł</strong>
                      </p>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="col-xs-12 custom-padding">
                  <div class="col-xs-6 custom-padding">
                    <p class="text-right">
                      &nbsp; {{-- puste pole dla obniżenia tabeli --}}
                    </p>
                    <p class="text-right">
                      Wydam:
                    </p>
                    @if ($spend_money < 0)
                      <p class="text-right text-danger">
                        <strong>Posiadam:</strong>
                      </p>
                      @else
                        <p class="text-right text-success">
                          <strong>Posiadam:</strong>
                        </p>
                    @endif
                  </div>
                  <div class="col-xs-6 custom-padding">
                    <p class="text-right">
                      &nbsp; {{-- puste pole dla obniżenia tabeli --}}
                    </p>
                    <p class="text-right">
                      {{ $data_loading_instruction->amount - $spend_money }}&nbsp;zł
                    </p>
                    @if ($spend_money < 0)
                      <p class="text-right text-danger">
                        <strong>{{ $spend_money }}&nbsp;zł</strong>
                      </p>
                      @else
                        <p class="text-right text-success">
                          <strong>{{ $spend_money }}&nbsp;zł</strong>
                        </p>
                    @endif
                  </div>
                </div>
              </div>
            </div> {{-- end row --}}
          </div>
        </div>{{-- finanse --}}
        <div class="row"> {{-- nagłówek --}}
          <div class="col-md-12">
            <h3 class="text-center">
              Pracownicy
            </h3>
          </div>
        </div>{{-- nagłówek --}}
        <div class="row"> {{-- pracownicy --}}
          <div class="col-md-12">
            <p class="text-center">
              @foreach ($employees as $employee)
                {{ $employee->name }} {{ $employee->surname }} <br />
              @endforeach
            </p>
          </div>
        </div>{{-- pracownicy --}}

  		</div> {{-- koniec parawej kolumny --}}
  	</div> {{-- koniec całego kontenera --}}
  {{-- </div> --}}




  {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs">Small modal</button> --}}









{{-- <div id="myContener">
  <div id="mainPage">
    <div id="employee">

    </div>
    <div id="boxes">

    </div>
    <div id="weight">

    </div>
  </div>{{-- end mainPage --}}
  {{-- <div id="secondPage">
    <div id="title">

    </div>
    <div id="amount">

    </div>
    <div id="myTable">

    </div>
    <div id="myButton">

    </div>
  </div> {{-- end secondPage --}}
{{--</div>  end myContener --}}
@endsection
