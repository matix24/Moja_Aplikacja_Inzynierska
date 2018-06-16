<?php

namespace App\Http\Controllers;

use App\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TruckRequest;

class TruckController extends Controller
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
        $trucks = Truck::where('archive', '0')->paginate(15);
        if (is_null($trucks))
          throw new \Exception("Error Processing Request", 1);
        $customModalJS = TRUE;
        return view('truck/trucklist', ['trucks' => $trucks, 'customModalJS' => $customModalJS]);
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('TruckController@index');
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
        try {
          return view('truck/truckcreate');
        } catch (\Exception $e) {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('TruckController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('TruckController@index');
      }
    }// end create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TruckRequest $request)
    {
      if (Auth::user()->ID_roles == 1)
      {
          try
          {
            Truck::create([
              'truck_id_number' => $request['truck_id_number'],
              'capacity' => $request['capacity'],
              'capacity_palete' => $request['capacity_palete'],
              'archive' => '0',
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s')
            ]);
            session()->flash('alert-success', 'Dodanie nowego samochodu powiodło się!');
            return redirect()->action('TruckController@index');
          }
          catch (\Exception $e)
          {
            session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
            return redirect()->action('TruckController@index');
          }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('TruckController@index');
      }
    }// end store

    /**
     * Display the specified resource.
     *
     * @param  \App\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function show(Truck $truck)
    {
        return redirect()->action('TruckController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          $truck = Truck::find($id);
          if (is_null($truck))
            throw new \Exception("Error Processing Request", 1);
          return view('truck/truckedit', ['truck' => $truck]);
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('TruckController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('TruckController@index');
      }
    }// end edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function update(TruckRequest $request, $id)
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          $truck = Truck::find($id);
          if (is_null($truck))
            throw new \Exception("Error Processing Request", 1);

          $truck->update([
            'truck_id_number' => $request['truck_id_number'],
            'capacity' => $request['capacity'],
            'capacity_palete' => $request['capacity_palete'],
            'updated_at' => date('Y-m-d H:i:s')
          ]);
          session()->flash('alert-success', 'Edycja danych samochodu powiodło się!');
          return redirect()->action('TruckController@index');
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('TruckController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('TruckController@index');
      }
    }// end update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          DB::table('trucks')->where('id', '=', $id)->delete();
          session()->flash('alert-success', 'Dane samochodu zostały usunięte!');
          return redirect()->action('TruckController@index_archive');
        }
        catch (QueryException $qe) // błąd usuwania powiązanych rekordów
        {
          session()->flash('alert-danger', 'Wystąpił błąd usuwania powiązanych rekordów!');
          return redirect()->action('TruckController@index_archive');
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('TruckController@index_archive');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('TruckController@index');
      }
    }// end destroy

    public function index_archive()
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          $trucks = Truck::where('archive', '1')->paginate(15);
          if (is_null($trucks))
            throw new \Exception("Error Processing Request", 1);
          $customModalJS = TRUE;
          return view('archive/truckarchive', ['trucks' => $trucks, 'customModalJS' => $customModalJS]);
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('TruckController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
        return redirect()->action('TruckController@index');
      }
    }// end index_archive

    public function to_archive($id)
    {
      try
      {
        if (Auth::user()->ID_roles == 1)
        {
          $truck = Truck::find($id);
          if (is_null($truck))
            throw new \Exception("Error Processing Request", 1);

          $truck->update([
            'archive' => '1',
            'updated_at' => date('Y-m-d H:i:s')
          ]);
          session()->flash('alert-success', 'Archiwizacja samochodu powiodła się!');
          return redirect()->action('TruckController@index');
        }
        else
        {
          session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
          return redirect()->action('TruckController@index');
        }
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('TruckController@index');
      }
    }// end to_archive

    public function from_archive($id)
    {
      try
      {
        if (Auth::user()->ID_roles == 1)
        {
          $truck = Truck::find($id);
          if (is_null($truck))
            throw new \Exception("Error Processing Request", 1);

          $truck->update([
            'archive' => '0',
            'updated_at' => date('Y-m-d H:i:s')
          ]);
          session()->flash('alert-success', 'Przywrócenie samochodu powiodło się!');
          return redirect()->action('TruckController@index_archive');
        }
        else
        {
          session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
          return redirect()->action('TruckController@index');
        }
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('TruckController@index_archive');
      }
    }// end from_archive

}// end class truck
