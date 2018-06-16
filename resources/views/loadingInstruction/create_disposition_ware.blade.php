@extends('layouts.app')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
          <ol class="breadcrumb">
            <li><a href="{{ route('home') }}">Panel Administratora</a></li>
            <li class="active"><a href="{{ route('loadingInstruction.index') }}">Załadunek</a></li>
            {{-- @if ( $edit_mode == TRUE) --}}
              {{-- <li class="active">Edytuj Załadunek</li> --}}
            {{-- @else --}}
              <li class="active">Dodaj Załadunek</li>
            {{-- @endif --}}
          </ol>
        </div>

        <div class="row" id="main" >
          <div class="panel panel-default">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-6 custom-responsive-first">
                    <b>Lista towarów do załadunku</b>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6 custom-responsive-second">
                    <strong><a href="{{ route('loadingInstruction.show', ['id' => $id_loading_instruction]) }}">Przejdź do załadunku</a></strong>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <div class="row">
              		<div class="col-md-8 table-responsive">
                    {{-- modal --}}
                    <div class="modal fade" id="confirm">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Potwierdź usunięcie</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Czy aby na pewno chcesz usunąć tą pozycję?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-primary" id="delete-btn">Tak</button>
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Nie</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- endmodal --}}
              			<table id="example" class="display table table-striped text-center" cellspacing="0" width="100%">
              				<thead>
              					<tr>
              						<th class="text-center">Towar</th>
              						<th class="text-center">Do załadunku [Opak.]</th>
                          <th class="text-center">Sprzedawca</th>
                          <th class="text-center">Cena [Za Opak.]</th>
                          <th class="text-center">Priorytet</th>
                          <th class="text-center">Opcje</th>
              					</tr>
              				</thead>
              				<tbody>
                        @php $total_weight = 0; @endphp
                        @if ( !empty($positions))
                            @foreach ($positions as $position)
                              @php $total_weight += $position->weight_per_package * $position->wares_weight @endphp
                    					<tr>
                    						<td>{{ $position->wares_name }}</td>
                    						<td>{{ $position->weight_per_package }}</td>
                                <td>{{ $position->sellers_name }} {{ $position->surname }}</td>
                                <td>{{ $position->amount }} zł</td>
                                <td>
                                  @if ($position->priority == 1)
                                    <input class="checkbox" type="checkbox" aria-label="..." disabled checked>
                                  @else
                                    <input class="checkbox" type="checkbox" aria-label="..." disabled>
                                  @endif
                                </td>
                                <td>
                                  {{-- {!! Form::model($position, ['method' => 'post', 'route' => ['LoadingDelete', $position->id], 'class' =>'form-inline form-delete']) !!}
                                  {!! Form::hidden('id', $position->id) !!}
                                  {!! Form::submit("Usuń", ['class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal']) !!}
                                  {!! Form::close() !!} --}}

                                  {{ Form::open(['method' => 'delete', 'route' => ['LoadingDelete', $position->id], 'class' =>'form-inline form-delete']) }}
                                    {{-- {{ Form::hidden('id', $position->id) }} --}}
                                    {{ Form::hidden('id_loading_instruction', $id_loading_instruction) }}
                                    {{ Form::submit('Usuń', ['class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal']) }}
                                  {{ Form::close() }}

                                  {{-- <button class="btn btn-xs btn-danger"  data-toggle="tooltip" data-placement="bottom" title="Opcja nie została jeszcze zaimplementowana"  stop tooltip >
                          					Usuń
                          				</button> --}}
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
              		<div class="col-md-4">
              			<form class="form-horizontal" role="form" method="POST" action="{{ route('LoadingStepTwo') }}">
                      {{ csrf_field() }}
                      {{-- wares --}}
                      <div class="form-group{{ $errors->has('ware') ? ' has-error' : '' }}">
                          <label for="ware" class="col-md-4 control-label">Towar</label>

                          <div class="col-md-6">
                              <select id="ware" class="form-control" name="ware" value="{{ old('ware') }}" required>
                                {{-- {{ dd($wares) }} --}}
                                @foreach ($wares as $ware)
                                  <option value="{{ $ware->id }}">{{ $ware->name }} {{ $ware->packagingproducts->name }} {{ $ware->weight_of_package }}kg</option>
                                @endforeach
                              </select>

                              @if ($errors->has('ware'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('ware') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      {{-- hidden loadind instruction id --}}
                      <input type="hidden" name="id_loading_instruction" value="{{ $id_loading_instruction }}"/>

                      {{-- date --}}
                      <div class="form-group{{ $errors->has('wares_to_load') ? ' has-error' : '' }}">
                          <label for="wares_to_load" class="col-md-4 control-label">Do załadunku</label>

                          <div class="col-md-6">
                              <input id="wares_to_load" type="text" class="form-control" name="wares_to_load" value="{{ old('wares_to_load') }}" required>

                              @if ($errors->has('wares_to_load'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('wares_to_load') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- seller --}}
                      <div class="form-group{{ $errors->has('seller') ? ' has-error' : '' }}">
                          <label for="seller" class="col-md-4 control-label">Sprzedawca</label>

                          <div class="col-md-6">
                              <select id="seller" class="form-control" name="seller" value="{{ old('seller') }}" required>
                                @foreach ($sellers as $seller)
                                  <option value="{{ $seller->id }}">{{ $seller->name }} {{ $seller->surname }}</option>
                                @endforeach
                              </select>

                              @if ($errors->has('seller'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('seller') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      {{-- amount --}}
                      <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                          <label for="amount" class="col-md-4 control-label">Cena</label>

                          <div class="col-md-6">
                              <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" required>

                              @if ($errors->has('amount'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('amount') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

              				<div class="form-group">
                        <label for="priority" class="col-md-4 control-label">Priorytet</label>
                        <div class="col-md-6">
              				      <input id="priority" type="checkbox" name="priority">
                        </div>
              				</div>
                      <div class="form-group text-center">
                				<button type="submit" class="btn btn-primary">
                					<i class="fa fa-plus" aria-hidden="true"></i> Dodaj rekord
                				</button>
                      </div>
              			</form>
              		</div>
              	</div>
              </div>
              <div class="panel-footer">
                <div class="row">
                  <div class="col-sm-4 col-md-4 col-lg-4 custom-responsive-first">
                    <p>Kwota do załadunku: <strong>{{ $have_money }} zł</strong></p>
                  </div>
                  <div class="col-sm-4 col-md-4 col-lg-4 custom-responsive-center">
                    @if ($wares_already_loadeds->trucks->capacity > $total_weight)
                      <p>
                        Waga: <strong>{{$total_weight}} kg (Solówka)</strong><br />
                        (+{{ $wares_already_loadeds->trucks->capacity - $total_weight }} kg)
                      </p>
                    @elseif ( ($wares_already_loadeds->trailers->capacity + $wares_already_loadeds->trucks->capacity) > $total_weight )
                      <p>
                        Waga: <strong>{{$total_weight}} kg (Skład)</strong><br />
                        (+{{ ($wares_already_loadeds->trailers->capacity + $wares_already_loadeds->trucks->capacity) - $total_weight}} kg)
                      </p>
                    @else
                      <p style="color: red;">
                        Waga: <strong>{{$total_weight}} kg (Przeładowano)</strong><br />
                        ({{ ($wares_already_loadeds->trailers->capacity + $wares_already_loadeds->trucks->capacity) - $total_weight}} kg)
                      </p>
                    @endif
                  </div>
                  <div class="col-sm-4 col-md-4 col-lg-4 custom-responsive-second">
                    @if ( $spend_money <= 0)
                      <p style="color: red;">
                        Pozostała kwota: <strong>{{ $spend_money }} zł</strong><br />
                        Wydano: {{ $have_money - $spend_money }}
                      </p>
                    @else
                      <p>
                        Pozostała kwota: <strong>{{ $spend_money }} zł</strong><br />
                        Wydano: <strong>{{ $have_money - $spend_money }} zł </strong>
                      </p>
                    @endif
                  </div>
                </div>
              </div>
          </div>
        </div>

    </div>
</div>
@endsection
