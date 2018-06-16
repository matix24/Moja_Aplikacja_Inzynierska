@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <ol class="breadcrumb">
      <li class="active">Panel Administratora</li>
    </ol>
  </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Panel Administratora</div>

                <div class="panel-body">
                    Logowanie przebiegło pomyślnie! <br /><br />
                    <strong>Przejdź do > <a href="{{ route('loadingInstruction.index') }}">Moje załadunki</a></strong>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="collapse navbar-collapse navbar-ex1-collapse">>
      <ul class="nav navbar-nav side-nav">
        <li>
          <a href="#" data-toggle="collapse" data-target="#submenu-1"> test1 <i class="fa fa-fw fa-angle-down pull-right"></i></a>
          <ul id="submenu-1" class="collapse">
            <li><a href="#"><i class="fa fa-angle-double-right"></i> podtest1</a></li>
            <li><a href="#"><i class="fa fa-angle-double-right"></i> podtest2</a></li>
          </ul>
        </li>
      </ul>
    </div> --}}
</div>

@endsection
