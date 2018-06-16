<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use App\LoadingInstruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Validator;
use App\Truck;
use App\Trailer;
use App\User;
use App\WaresAlreadyLoaded;
use App\UserToLoad;
use App\Ware;
use App\Seller;
use App\PositionAtTheLoadingDisposition;
use App\RelationshipRelationWithList;
use App\BoxPallet;
use App\WaresInTheBox;

class LoadingInstructionController extends Controller
{

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      try
      {
        if (Auth::user()->ID_roles == 1)
        {
          $loadingInstructions = LoadingInstruction::where('archive', '0')->orderBy('date', 'desc')->paginate(15);
        }
        else
        {
          $loadingInstructions = LoadingInstruction::join('user_to_loads', 'loading_instructions.id', '=', 'user_to_loads.ID_wares_already_loaded')
            ->select('loading_instructions.*')
            ->where('loading_instructions.archive', '=', '0')
            ->where( 'loading_instructions.date', '>=', date('Y-m-d', strtotime(date('Y-m-d').' -1 month')) )
            ->where('user_to_loads.ID_employee', '=', Auth::user()->id)
            ->orderBy('date', 'desc')
            ->paginate(15);
        }
        if (is_null($loadingInstructions))
          throw new \Exception("Error Processing Request", 1);
        $customModalJS = TRUE;
        return view('loadingInstruction/list', ['loadingInstructions' => $loadingInstructions, 'customModalJS' => $customModalJS]);
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('LoadingInstructionController@index');
      }
    }// end index

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          $datapickerJS = TRUE;
          $trucks = Truck::where('archive', '0')->get();
          if (is_null($trucks))
            throw new \Exception("Error Processing Request", 1);
          $trailers = Trailer::where('archive', '0')->get();
          if (is_null($trailers))
            throw new \Exception("Error Processing Request", 1);
          $users = User::where('archive', '0')->get();
          if (is_null($users))
            throw new \Exception("Error Processing Request", 1);
          return view('loadingInstruction/create', ['trucks' => $trucks, 'trailers' => $trailers, 'users' => $users, 'datapickerJS' => $datapickerJS]);
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('LoadingInstructionController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('LoadingInstructionController@index');
      }
    }// end create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if (Auth::user()->ID_roles == 1)
      {

          $customModalJS = TRUE;
          $edit_mode = FALSE;

          if ( strpos($request['amount'], ',') )
            $request['amount'] = str_replace(',', '.', $request['amount']);

          $messages = array(
            'date.date_format' => 'Podana data musi być w formacie yyyy-mm-dd.',
            'date.required' => 'Data jest wymagana.',
            'truck.required' => 'Wybierz samochód.',
            'trailer.required' => 'Wybierz przyczepę.',
            'amount.required' => 'Kwota jest wymagana.',
            'amount.numeric' => 'Kwota musi być liczbą.',
            'amount.min' => 'Kwota musi być większa niż 0.',
            'amount.regex' => 'Zbyt dużo liczb po przecinku.',
            'user.required' => 'Podaj co najmniej jednego pracownika do załadunku.'
          );

          $rules = array(
            'date' => 'required|date_format:"Y-m-d"',
            'truck' => 'required',
            'trailer' => 'required',
            'amount' => 'required|numeric|min:0|regex:/^\d+(?:\.\d{1,2})?$/',
            'user' => 'required'
          );
          $this->validate($request, $rules, $messages);

          try
          {
            LoadingInstruction::create([
              'date' => $request['date'],
              'amount' => $request['amount'],
              'archive' => '0',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s')
            ]);
            $last_loadingInstruction = DB::table('loading_instructions')->orderBy('updated_at', 'desc')->first();

            WaresAlreadyLoaded::create([
              'ID_truck' => $request['truck'],
              'ID_trailer' => $request['trailer'],
              'ID_disposition' => $last_loadingInstruction->id,
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s')
            ]);

            $last_waresAlreadyLoaded = DB::table('wares_already_loadeds')->orderBy('updated_at', 'desc')->first();
            foreach ($request['user'] as $user)
            {
              UserToLoad::create([
                'ID_employee' => $user,
                'ID_wares_already_loaded' => $last_waresAlreadyLoaded->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
              ]);
            }
            return redirect()->route('LoadingEdit', ['id' => $last_loadingInstruction->id]);
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('LoadingInstructionController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('LoadingInstructionController@index');
      }
    }// end store

    public function store_stepTwo(Request $request)
    {
      if (Auth::user()->ID_roles == 1)
      {
        if ( strpos($request['amount'], ',') )
          $request['amount'] = str_replace(',', '.', $request['amount']);

        $messages = array(
          'ware.required' => 'Wybierz towar z listy.',
          'seller.required' => 'Wybierz sprzedawce z listy.',
          'wares_to_load.required' => 'Podaj ilość do załadunku.',
          'wares_to_load.integer' => 'Liczba towaru musi być całkowita.',
          'wares_to_load.numeric' => 'Liczba towaru musi być liczbą.',
          'wares_to_load.min' => 'Liczba towaru musi być większa od 0.',
          'amount.required' => 'Kwota jest wymagana.',
          'amount.numeric' => 'Kwota musi być liczbą.',
          'amount.min' => 'Kwota musi być większa niż 0.',
          'amount.regex' => 'Zbyt dużo liczb po przecinku.'
        );
        $rules = array(
          'ware' => 'required',
          'seller' => 'required',
          'wares_to_load' => 'required|integer|numeric|min:0',
          'amount' => 'required|numeric|min:0|regex:/^\d+(?:\.\d{1,2})?$/'
        );
        $this->validate($request, $rules, $messages);

        try {

          if ( is_null($request['priority']) ) {
            $priority = FALSE;
          } else {
            $priority = TRUE;
          }


          PositionAtTheLoadingDisposition::create([
            'ID_wares' => $request['ware'],
            'ID_sellers' => $request['seller'],
            'weight_per_package' => $request['wares_to_load'],
            'amount' => $request['amount'],
            'priority' => $priority,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
          ]);

          $last_loadingInstruction = LoadingInstruction::find($request['id_loading_instruction']);
          $last_positions_at_the_loading_disposition = DB::table('position_at_the_loading_dispositions')->orderBy('updated_at', 'desc')->first();

          RelationshipRelationWithList::create([
            'ID_disposition' => $last_loadingInstruction->id,
            'ID_position' => $last_positions_at_the_loading_disposition->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
          ]);

          return redirect()->route('LoadingEdit', ['id' => $request['id_loading_instruction']]);
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('LoadingInstructionController@index');
        } // end try catch
      }// end if auth
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('LoadingInstructionController@index');
      }
    }// end store_stepTwo

    public function loading_delete(Request $request)
    {
      if(Auth::user()->ID_roles == 1)
      {
        try {
          DB::table('relationship_relation_with_lists')->where('ID_position', '=', $request->id)->delete();
          PositionAtTheLoadingDisposition::find($request->id)->delete();
          return redirect()->route('LoadingEdit', ['id' => $request['id_loading_instruction']]);
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('LoadingInstructionController@index');
        }
      }// end if Auth
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('LoadingInstructionController@index');
      }
    } // end loading_delete

    public function loading_edit($id)
    {
      if(Auth::user()->ID_roles == 1)
      {
        return $this->reload($id);
      }// end if Auth
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('LoadingInstructionController@index');
      }
    } // end loading_edit

    public function reload($id_loading_instruction)
    {
      try
      {
        $customModalJS = TRUE;
        $loadingInstruction = LoadingInstruction::find($id_loading_instruction);
        $wares_already_loadeds = WaresAlreadyLoaded::where('ID_disposition', $id_loading_instruction)->get();

        $wares = Ware::where('archive', '0')->get();
        $sellers = Seller::where('archive', '0')->get();
        $have_money = $loadingInstruction->amount;
        $spend_money = 0;

        $positions = PositionAtTheLoadingDisposition::join('relationship_relation_with_lists', 'position_at_the_loading_dispositions.id', '=', 'relationship_relation_with_lists.ID_position')
          ->join('wares', 'position_at_the_loading_dispositions.ID_wares', '=', 'wares.id')
          ->join('sellers', 'position_at_the_loading_dispositions.ID_sellers', '=', 'sellers.id')
          ->select('position_at_the_loading_dispositions.id',
            'position_at_the_loading_dispositions.ID_wares',
            'wares.name AS wares_name',
            'wares.weight_of_package AS wares_weight',
            'sellers.name AS sellers_name',
            'sellers.surname',
            'position_at_the_loading_dispositions.weight_per_package',
            'position_at_the_loading_dispositions.amount',
            'position_at_the_loading_dispositions.priority',
            'relationship_relation_with_lists.ID_disposition',
            'relationship_relation_with_lists.ID_position')
          ->where('relationship_relation_with_lists.ID_disposition', '=', $loadingInstruction->id)
          ->get();

          foreach ($positions as $key => $value)
          {
            $spend_money += $value->weight_per_package * $value->amount;
          }
          $spend_money = $have_money - $spend_money;
          return view('loadingInstruction/create_disposition_ware',
          [
            'wares' => $wares,
            'sellers' => $sellers,
            'positions' => $positions,
            'have_money' => $have_money,
            'spend_money' => $spend_money,
            'customModalJS' => $customModalJS,
            'wares_already_loadeds' => $wares_already_loadeds[0],
            'id_loading_instruction' => $id_loading_instruction
          ]);
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('LoadingInstructionController@index');
      }

    }// end reload

    /**
     * Display the specified resource.
     *
     * @param  \App\LoadingInstruction  $loadingInstruction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      try
      {
        $customModalJS = TRUE;
        $customModalWaresJS = TRUE;
        $loadingInstruction = LoadingInstruction::find($id);
        $wares = Ware::where('archive', '0')->get();
        $sellers = Seller::where('archive', '0')->get();
        $employees = WaresAlreadyLoaded::join('user_to_loads', 'wares_already_loadeds.id', '=', 'user_to_loads.ID_wares_already_loaded')
          ->join('users', 'user_to_loads.ID_employee', '=', 'users.id')
          ->select('users.name', 'users.surname')
          ->where('wares_already_loadeds.ID_disposition', '=', $loadingInstruction->id)
          ->get();


         $positions = PositionAtTheLoadingDisposition::join('relationship_relation_with_lists', 'position_at_the_loading_dispositions.id', '=', 'relationship_relation_with_lists.ID_position')
           ->join('wares', 'position_at_the_loading_dispositions.ID_wares', '=', 'wares.id')
           ->join('sellers', 'position_at_the_loading_dispositions.ID_sellers', '=', 'sellers.id')
           ->select('position_at_the_loading_dispositions.id',
             'position_at_the_loading_dispositions.ID_wares',
             'wares.name AS wares_name',
             'sellers.id AS ID_seller',
             'sellers.name AS sellers_name',
             'sellers.surname',
             'position_at_the_loading_dispositions.weight_per_package',
             'position_at_the_loading_dispositions.amount',
             'position_at_the_loading_dispositions.priority',
             'relationship_relation_with_lists.ID_disposition',
             'relationship_relation_with_lists.ID_position')
           ->where('relationship_relation_with_lists.ID_disposition', '=', $loadingInstruction->id)
           ->get();

          $spend_money = 0;
          foreach ($positions as $key => $value)
          {
            $spend_money += $value->weight_per_package * $value->amount;
          }
          $spend_money = $loadingInstruction->amount - $spend_money;
          // do tego miejsca działa
          //START SKRZYNIE

          $wares_already_loaded = WaresAlreadyLoaded::where('ID_disposition', '=', $loadingInstruction->id)->get();
          $boxpallets = BoxPallet::where('ID_wares_already_loaded', $wares_already_loaded[0]->id)->get();
          $temp_array = array();
          foreach ($boxpallets as $key => $value)
          {
            $temp_array[] = $value->id;
          }
          $wares_in_boxes = WaresInTheBox::join('box_pallets', 'wares_in_the_boxes.ID_boxpallet', '=', 'box_pallets.id')
            ->select('wares_in_the_boxes.*', 'box_pallets.number_boxes')
            ->whereIn('ID_boxpallet', $temp_array)
            ->get();
          $spend_all_money = 0;
          foreach ($wares_in_boxes as $key => $value)
          {
            $spend_all_money += $value->quantity * $value->amount;
          }
          // STOP SKRZYNIE

          // JUŻ ZAŁADOWANE
          $array_already_loaded = array();
          $array_already_loaded_amount = array();
          foreach ($positions as $key_position => $value_position){
            $counter = 0;
            $amountt = 0.0;
            foreach ($wares_in_boxes as $key_wares_in_the_box => $value_wares_in_the_box){
              if ( $value_position->ID_wares == $value_wares_in_the_box->ID_ware ){
                if ( $value_position->ID_seller == $value_wares_in_the_box->ID_seller ){
                  $counter += $value_wares_in_the_box->quantity;
                  $amountt = $value_wares_in_the_box->amount;
                }
              }
            }// end foreach
            $array_already_loaded[] = $counter;
            $array_already_loaded_amount[] = $amountt;
          } // end foreach
          // JUŻ ZAŁADOWANE

        return view('loadingInstruction/details', [
          'wares' => $wares,
          'sellers' => $sellers,
          'wares_already_loaded' => $wares_already_loaded[0],
          'data_loading_instruction' => $loadingInstruction,
          'spend_money' => $spend_money,
          'spend_all_money' => $spend_all_money,
          'positions' => $positions,
          'counter_wares_already_loaded' => $array_already_loaded,
          'amount_wares_already_loaded' => $array_already_loaded_amount,
          'employees' => $employees,
          'wares_in_the_boxes' => $wares_in_boxes,
          'id_loading_instruction' => $id,
          'customModalWaresJS' => $customModalWaresJS,
          'customModalJS' => $customModalJS
        ]);
      }// end try
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('LoadingInstructionController@index');
      }
    } // end show

    public function wares_boxes_add(Request $request)
    {
      if ( strpos($request['amount'], ',') )
        $request['amount'] = str_replace(',', '.', $request['amount']);
        // dd($request->request);
      $messages = array(
        'ware.required' => 'Wybierz towar.',
        'wares_to_load.required' => 'Wprowadź ilość towaru.',
        'wares_to_load.integer' => 'Ilość towaru musi być liczbą całkowitą.',
        'wares_to_load.min' => 'Ilość towaru musi być większa niż 0.',
        'seller.required' => 'Wybierz sprzedawcę.',
        'amount.required' => 'Kwota jest wymagana.',
        'amount.numeric' => 'Kwota musi być liczbą.',
        'amount.min' => 'Kwota musi być większa niż 0.',
        'amount.regex' => 'Zbyt dużo liczb po przecinku.'
      );
      $rules = array(
        'ware' => 'required',
        'wares_to_load' => 'required|integer|min:1',
        'seller' => 'required',
        'amount' => 'required|numeric|min:0|regex:/^\d+(?:\.\d{1,2})?$/'
      );
      $validator = Validator::make($request->all(), $rules, $messages);
      if ($validator->fails())
      {
          $validator->errors()->add('error_box_number', $request['number_box_add']);
          return redirect()->back()->withErrors($validator->errors());
      }

      try {

        $find_use_boxpallet = BoxPallet::where('number_boxes', '=', $request['number_box_add'])
                              ->where('ID_wares_already_loaded', '=', $request['id_loading_instruction'])
                              ->get();

        if ( empty($find_use_boxpallet[0]) )
        {
          // nie ma takiego
          BoxPallet::create([
            'ID_wares_already_loaded' => $request['id_loading_instruction'],
            'number_boxes' => $request['number_box_add'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
          ]);
          $find_use_boxpallet = DB::table('box_pallets')->orderBy('updated_at', 'desc')->first();
        }

        if ( isset($find_use_boxpallet->id) )
        {
          $ID_boxpallet = $find_use_boxpallet->id;
          $ID_wares_already_loaded = $find_use_boxpallet->ID_wares_already_loaded;
        }
        else
        {
          $ID_boxpallet = $find_use_boxpallet[0]->id;
          $ID_wares_already_loaded = $find_use_boxpallet[0]->ID_wares_already_loaded;
        }

          if ( strpos($request['amount'], ',') )
            $request['amount'] = str_replace(',', '.', $request['amount']);

          WaresInTheBox::create([
            'ID_boxpallet' => $ID_boxpallet,
            'ID_ware' => $request['ware'],
            'ID_seller' => $request['seller'],
            'quantity' => $request['wares_to_load'],
            'amount' => $request['amount'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
          ]);

          return redirect()->action('LoadingInstructionController@show', ['id' => $request['id_loading_instruction']]);
      } // end try
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('LoadingInstructionController@index');
      }
    } // end wares_boxes_add

    public function wares_boxes_edit(Request $request)
    {
        if ( strpos($request['amount'], ',') )
          $request['amount'] = str_replace(',', '.', $request['amount']);

        $messages = array(
          'ware.required' => 'Wybierz towar.',
          'wares_to_load.required' => 'Wprowadź ilość towaru.',
          'wares_to_load.integer' => 'Ilość towaru musi być liczbą całkowitą.',
          'wares_to_load.min' => 'Ilość towaru musi być większa niż 0.',
          'seller.required' => 'Wybierz sprzedawcę.',
          'amount.required' => 'Kwota jest wymagana.',
          'amount.numeric' => 'Kwota musi być liczbą.',
          'amount.min' => 'Kwota musi być większa niż 0.',
          'amount.regex' => 'Zbyt dużo liczb po przecinku.'
        );
        $rules = array(
          'ware' => 'required',
          'wares_to_load' => 'required|integer|min:1',
          'seller' => 'required',
          'amount' => 'required|numeric|min:0|regex:/^\d+(?:\.\d{1,2})?$/'
        );
        //$this->validate($request, $rules, $messages);
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
        {
            $validator->errors()->add('edit_error_id_number', $request['id_wares_in_the_box']);
            return redirect()->back()->withErrors($validator->errors());
        }

        try {
          $wares_in_the_boxes = WaresInTheBox::find($request['id_wares_in_the_box']);
          $wares_in_the_boxes->update([
            'ID_ware' => $request['ware'],
            'ID_seller' => $request['seller'],
            'quantity' => $request['wares_to_load'],
            'amount' => $request['amount'],
            'updated_at' => date('Y-m-d H:i:s')
          ]);

          return redirect()->action(
            'LoadingInstructionController@show', ['id' => $request['id_loading_instruction']]
          );
        }// end try
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('LoadingInstructionController@index');
        }
    } // end wares_boxes_edit

    public function wares_boxes_delete($id)
    {
      try
      {
        WaresInTheBox::find($id)->delete();

        return redirect()->action(
          'LoadingInstructionController@show', ['id' => $_POST['id_loading_instruction']]
        );
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('LoadingInstructionController@index');
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LoadingInstruction  $loadingInstruction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if(Auth::user()->ID_roles == 1)
      {
        try
        {
          $datapickerJS = TRUE;
          $loadingInstruction = LoadingInstruction::find($id);
          $trucks = Truck::all();
          $trailers = Trailer::all();
          $waresAlreadyLoaded = DB::table('wares_already_loadeds')->where('ID_disposition', '=', $id)->get();
          $waresAlreadyLoaded = $waresAlreadyLoaded[0];
          $users = User::where('archive', '0')->get();
           $selected_users = WaresAlreadyLoaded::join('user_to_loads', 'wares_already_loadeds.id', '=', 'user_to_loads.ID_wares_already_loaded')
            ->join('users', 'user_to_loads.ID_employee', '=', 'users.id')
            ->select('users.id AS selected_user_id', 'users.name', 'users.surname')
            ->where('wares_already_loadeds.ID_disposition', '=', $loadingInstruction->id)
            ->get();


          return view('loadingInstruction/edit',
          [
            'loadingInstruction' => $loadingInstruction,
            'trucks' => $trucks,
            'trailers' => $trailers,
            'waresAlreadyLoaded' => $waresAlreadyLoaded,
            'users' => $users,
            'selected_users' => $selected_users,
            'datapickerJS' => $datapickerJS
          ]);
        } // end try
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('LoadingInstructionController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('LoadingInstructionController@index');
      }
    }// end edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoadingInstruction  $loadingInstruction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if(Auth::user()->ID_roles == 1)
      {
        if ( strpos($request['amount'], ',') )
          $request['amount'] = str_replace(',', '.', $request['amount']);

        $messages = array(
          'date.date_format' => 'Podana data musi być w formacie yyyy-mm-dd.',
          'date.required' => 'Data jest wymagana.',
          'truck.required' => 'Wybierz samochód.',
          'trailer.required' => 'Wybierz przyczepę.',
          'amount.required' => 'Kwota jest wymagana.',
          'amount.numeric' => 'Kwota musi być liczbą.',
          'amount.min' => 'Kwota musi być większa niż 0.',
          'amount.regex' => 'Zbyt dużo liczb po przecinku.',
          'user.required' => 'Podaj co najmniej jednego pracownika do załadunku.'
        );

        $rules = array(
          'date' => 'required|date_format:"Y-m-d"',
          'truck' => 'required',
          'trailer' => 'required',
          'amount' => 'required|numeric|min:0|regex:/^\d+(?:\.\d{1,2})?$/',
          'user' => 'required'
        );
        $this->validate($request, $rules, $messages);

        try
        {

          $loadingInstruction = LoadingInstruction::find($id);
          $loadingInstruction->update([
            'date' => $request['date'],
            'amount' => $request['amount'],
            'updated_at' => date('Y-m-d H:i:s')
          ]);

          $waresAlreadyLoaded = WaresAlreadyLoaded::where('ID_disposition', $id);
          $waresAlreadyLoaded->update([
            'ID_truck' => $request['truck'],
            'ID_trailer' => $request['trailer'],
            'updated_at' => date('Y-m-d H:i:s')
          ]);

          $waresAlreadyLoaded = WaresAlreadyLoaded::where('ID_disposition', $id)->get();
           $selected_users = WaresAlreadyLoaded::join('user_to_loads', 'wares_already_loadeds.id', '=', 'user_to_loads.ID_wares_already_loaded')
            ->join('users', 'user_to_loads.ID_employee', '=', 'users.id')
            ->select('user_to_loads.id AS user_to_load_id', 'users.id AS selected_user_id')
            ->where('wares_already_loadeds.ID_disposition', '=', $loadingInstruction->id)
            ->get();

          // sprawdzam co z formularza znajduje się w bazie
          // a jeżeli nie ma tego w bazie do dodaje
          for ($i=0; $i < sizeof($request['user']); $i++)
          {
            $not_found = TRUE;
            for ($j=0; $j < sizeof($selected_users); $j++)
            {
              if ($request['user'][$i] == $selected_users[$j]->selected_user_id)
              {
                $not_found = FALSE;
                break;
              }
            }
            if ( $not_found == TRUE )
            {
              UserToLoad::create([
                'ID_employee' => $request['user'][$i],
                'ID_wares_already_loaded' => $waresAlreadyLoaded[0]->ID_disposition,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
              ]);
            }
          } // koniec sprawdzania

          // sprawdzam co z bazy znajduje się w formularzu
          // a jeżeli nie ma tego w formularzu to usuwam z bazy
          for ($i=0; $i < sizeof($selected_users); $i++)
          {
            $not_found = TRUE;
            for ($j=0; $j < sizeof($request['user']); $j++)
            {
              if ($selected_users[$i]->selected_user_id == $request['user'][$j])
              {
                $not_found = FALSE;
                break;
              }
            }
            if ( $not_found == TRUE )
            {
              UserToLoad::find($selected_users[$i]->user_to_load_id)->delete();
            }
          } //koniec sprawdzania

          session()->flash('alert-success', 'Edycja danych dyspozycji załadunkowej powiodło się!');
          return redirect()->action('LoadingInstructionController@index');
        }// end try
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('LoadingInstructionController@index');
        }
      }// end if Auth
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('LoadingInstructionController@index');
      }
    } // end update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LoadingInstruction  $loadingInstruction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if(Auth::user()->ID_roles == 1)
      {
        try
        {
          $wares_already_loadeds = DB::table('wares_already_loadeds')->where('ID_disposition', '=', $id)->get();
          DB::table('user_to_loads')->where('ID_wares_already_loaded', '=', $wares_already_loadeds[0]->id)->delete();
          DB::table('wares_already_loadeds')->where('ID_disposition', '=', $id)->delete();

          $relations = DB::table('relationship_relation_with_lists')->where('ID_disposition', '=', $id)->get();
          DB::table('relationship_relation_with_lists')->where('ID_disposition', '=', $id)->delete();
          foreach ($relations as $key => $value)
          {
            DB::table('position_at_the_loading_dispositions')->where('id', '=', $value->ID_position)->delete();
          }
          DB::table('relationship_relation_with_lists')->where('ID_disposition', '=', $id)->delete();

          LoadingInstruction::find($id)->delete();
          session()->flash('alert-success', 'Dane dyspozycji załadunkowej zostały usunięte!');
          return redirect()->action('LoadingInstructionController@index_archive');
        }
        catch (QueryException $qe) // błąd usuwania powiązanych rekordów
        {
          session()->flash('alert-danger', 'Nie można usunąć załadunku, ponieważ jest powiązany z innymi rekordami w bazie.');
          return redirect()->action('LoadingInstructionController@index_archive');
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('LoadingInstructionController@index_archive');
        }
      }// end if Auth
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('LoadingInstructionController@index');
      }
    }// end destroy


    public function index_archive()
    {
      try
      {
        if (Auth::user()->ID_roles == 1)
        {
          $loadingInstructions = LoadingInstruction::where('archive', '1')->orderBy('date', 'desc')->paginate(15);
        }
        else
        {
          $loadingInstructions = LoadingInstruction::join('user_to_loads', 'loading_instructions.id', '=', 'user_to_loads.ID_wares_already_loaded')
            ->select('loading_instructions.*')
            ->where('loading_instructions.archive', '=', '1')
            ->where( 'loading_instructions.date', '>=', date('Y-m-d', strtotime(date('Y-m-d').' -1 month')) )
            ->where('user_to_loads.ID_employee', '=', Auth::user()->id)
            ->orderBy('date', 'desc')
            ->paginate(15);
        }
        if (is_null($loadingInstructions))
          throw new \Exception("Error Processing Request", 1);
        $customModalJS = TRUE;
        return view('archive/loadinginstructionarchive', ['loadingInstructions' => $loadingInstructions, 'customModalJS' => $customModalJS]);
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('LoadingInstructionController@index');
      }
    }// end index_archive

    public function to_archive($id)
    {
      try
      {
        if (Auth::user()->ID_roles == 1)
        {
          $loadingInstruction = LoadingInstruction::find($id);
          if (is_null($loadingInstruction))
            throw new \Exception("Error Processing Request", 1);

          $loadingInstruction->update([
            'archive' => '1',
            'updated_at' => date('Y-m-d H:i:s')
          ]);

          session()->flash('alert-success', 'Archiwizacja załadunku powiodło się!');
          return redirect()->action('LoadingInstructionController@index');
        }
        else
        {
          session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
          return redirect()->action('LoadingInstructionController@index');
        }
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('LoadingInstructionController@index');
      }
    }// end to_archive

    public function from_archive($id)
    {
      try
      {
        if (Auth::user()->ID_roles == 1)
        {
          $loadingInstruction = LoadingInstruction::find($id);
          if (is_null($loadingInstruction))
            throw new \Exception("Error Processing Request", 1);

          $loadingInstruction->update([
            'archive' => '0',
            'updated_at' => date('Y-m-d H:i:s')
          ]);

          session()->flash('alert-success', 'Przywrócenie załadunku powiodło się!');
          return redirect()->action('LoadingInstructionController@index_archive');
        }
        else
        {
          session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
          return redirect()->action('LoadingInstructionController@index');
        }
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('LoadingInstructionController@index_archive');
      }
    }// end from_archive

}// end class LoadingInstructionController
