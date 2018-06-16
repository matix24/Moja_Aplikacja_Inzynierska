{{-- start delete modal --}}
<div class="modal fade bs-{{$box_number}}" id="add_wares_box-{{$box_number}}" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Skrzynia nr {{$box_number}}</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" id="wares_boxes_add-{{$box_number}}" role="form" method="POST" action="{{ route('WaresBoxesAdd') }}">
          {{ csrf_field() }}
          {{-- wares --}}
          <div class="form-group{{ $errors->has('ware') ? ' has-error' : '' }}">
              <label for="ware" class="col-md-4 control-label">Towar</label>

              <div class="col-md-6">
                  <select id="ware" class="form-control" name="ware" value="{{ old('ware') }}" required>
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

          {{-- hidden number box --}}
          <input type="hidden" name="number_box_add" value="{{ $box_number }}"/>

          {{-- wares_to_load --}}
          <div class="form-group{{ $errors->has('wares_to_load') ? ' has-error' : '' }}">
              <label for="wares_to_load" class="col-md-4 control-label">Ilość towaru</label>

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
              <label for="amount" class="col-md-4 control-label">Cena [za opak.]</label>

              <div class="col-md-6">
                  <input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" required>

                  @if ($errors->has('amount'))
                      <span class="help-block">
                          <strong>{{ $errors->first('amount') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" id="submit-{{$box_number}}">Zatwierdź</button>
          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Anuluj</button>
      </div>
    </div>
  </div>
</div>
{{-- end delete modal --}}

<div class="list-group">
  @foreach ($wares_in_the_boxes as $key => $value)
    @if ($value->number_boxes == $box_number)

      {{-- start edit modal --}}
      <div class="modal fade bs-edit-{{$value->id}}" id="edit_wares_box-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edycja skrzyni nr {{$box_number}}</h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="wares_boxes_edit-{{$value->id}}" role="form" method="POST" action="{{ route('WaresBoxesEdit') }}">
                {{ csrf_field() }}
                {{-- wares --}}
                <div class="form-group{{ $errors->has('ware') ? ' has-error' : '' }}">
                    <label for="ware" class="col-md-4 control-label">Towar</label>

                    <div class="col-md-6">
                        <select id="ware" class="form-control" name="ware" value="{{ old('ware') }}" required>
                          @foreach ($wares as $ware)
                            @if ($ware->id === $value->ID_ware)
                              <option value="{{ $ware->id }}" selected="">{{ $ware->name }} {{ $ware->packagingproducts->name }} {{ $ware->weight_of_package }}kg</option>
                            @else
                              <option value="{{ $ware->id }}">{{ $ware->name }} {{ $ware->packagingproducts->name }} {{ $ware->weight_of_package }}kg</option>
                            @endif
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

                {{-- hidden number box --}}
                <input type="hidden" name="id_wares_in_the_box" value="{{ $value->id }}"/>

                {{-- ilość --}}
                <div class="form-group{{ $errors->has('wares_to_load') ? ' has-error' : '' }}">
                    <label for="wares_to_load" class="col-md-4 control-label">Ilość towaru</label>

                    <div class="col-md-6">
                        <input id="wares_to_load" type="text" class="form-control" name="wares_to_load" value="{{ $value->quantity }}" required>
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
                            @if ($seller->id === $value->ID_seller)
                              <option value="{{ $seller->id }}" selected>{{ $seller->name }} {{ $seller->surname }}</option>
                            @else
                              <option value="{{ $seller->id }}">{{ $seller->name }} {{ $seller->surname }}</option>
                            @endif
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
                    <label for="amount" class="col-md-4 control-label">Cena [za opak.]</label>

                    <div class="col-md-6">
                        <input id="amount" type="text" class="form-control" name="amount" value="{{ $value->amount }}" required>
                        @if ($errors->has('amount'))
                            <span class="help-block">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="submit-edit-{{$value->id}}">Zatwierdź</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Anuluj</button>
            </div>
          </div>
        </div>
      </div>
      {{-- end edit modal --}}


      @php $is_empty = FALSE; @endphp
      <div class="list-group-item clearfix">
        {{ $value->waress->name }}
        {{ $value->sellers->name }}
        {{ $value->sellers->surname }}
        {{ $value->quantity }} opak.
        @if ( ($data_loading_instruction->date >= date('Y-m-d')) || (Auth::user()->ID_roles == 1) )
          <span class="pull-right">
          {!! Form::model($value, ['method' => 'delete', 'route' => ['WaresBoxesDelete', $value->id]]) !!}
          {!! Form::hidden('id_loading_instruction', $id_loading_instruction) !!}
          {!! Form::submit("X", ['class' => 'btn btn-danger btn-xs']) !!}
          {!! Form::close() !!}</span>
          <span class="pull-right" style="margin-right:3px;">
            <button class="btn btn-primary btn-xs" type="button" data-toggle="modal" data-target=".bs-edit-{{$value->id}}">
              <em class="glyphicon glyphicon-pencil"></em>
            </button>
          </span>
        @else
          <span class="pull-right">
            <button class="btn btn-xs" type="button" data-toggle="tooltip" data-placement="bottom" title="Nie można usuwać załadunku z przeszłości">X</button>
          </span>
          <span class="pull-right" style="margin-right:3px;">
            <button class="btn btn-xs" type="button" data-toggle="tooltip" data-placement="bottom" title="Nie można edytować załadunku z przeszłości">
              <em class="glyphicon glyphicon-pencil"></em>
            </button>
          </span>
        @endif
      </div>

      @php $weight+= ($value->waress->weight_of_package * $value->quantity); @endphp
    @endif
  @endforeach
  @if ($is_empty == TRUE)
    <div class="list-group-item text-center text-danger">
      <strong>Pusta skrzynia</strong>
    </div>
  @endif

</div>
<div class="row row-custom-size">
  <div class="col-xs-6">
      @php
        $total_weight = session('total_weight');
        $total_weight += $weight;
        session()->put('total_weight', $total_weight);
        if ( session('trailer_weight') !== null )
        {
          $trailer_weight = session('trailer_weight');
          $trailer_weight += $weight;
          session()->put('trailer_weight', $trailer_weight);

          if ( $weight > $wares_already_loaded->trailers->capacity_palete)
          {
            $temp_w = $wares_already_loaded->trailers->capacity_palete - $weight;
            echo '<p class="text-danger"><strong>Waga: '.$weight.'&nbsp;kg&nbsp;&nbsp;('.$temp_w.'&nbsp;kg)</strong></p>';
          }
          else
          {
            $temp_w = $wares_already_loaded->trailers->capacity_palete - $weight;
            echo '<p class="text-success"><strong>Waga: '.$weight.'&nbsp;kg&nbsp;&nbsp;(+'.$temp_w.'&nbsp;kg)</strong></p>';
          }
        }
        else
        {
          $truck_weight = session('truck_weight');
          $truck_weight += $weight;
          session()->put('truck_weight', $truck_weight);

          if ( $weight > $wares_already_loaded->trucks->capacity_palete)
          {
            $temp_w = $wares_already_loaded->trucks->capacity_palete - $weight;
            echo '<p class="text-danger"><strong>Waga: '.$weight.'&nbsp;kg&nbsp;&nbsp;('.$temp_w.'&nbsp;kg)</strong></p>';
          }
          else
          {
            $temp_w = $wares_already_loaded->trucks->capacity_palete - $weight;
            echo '<p class="text-success"><strong>Waga: '.$weight.'&nbsp;kg&nbsp;&nbsp;(+'.$temp_w.'&nbsp;kg)</strong></p>';
          }
        }
      @endphp
  </div>
  <div class="col-xs-6">
    <div class="btn-group btn-group-custom">
      @if ( ($data_loading_instruction->date >= date('Y-m-d')) || (Auth::user()->ID_roles == 1) )
        <button class="btn btn-success btn-xs" type="button" data-toggle="modal" data-target=".bs-{{$box_number}}">
          <em class="glyphicon glyphicon-plus"></em> Dodaj
        </button>
      @else
        <button class="btn btn-xs" type="button" data-toggle="tooltip" data-placement="bottom" title="Upłynął czas dodania towaru do załadunku">
          <em class="glyphicon glyphicon-plus"></em> Dodaj
        </button>
      @endif
    </div>
  </div>
</div>
