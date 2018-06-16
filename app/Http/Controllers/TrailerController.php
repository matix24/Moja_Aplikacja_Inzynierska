<?php

namespace App\Http\Controllers;

use App\Trailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TrailerRequest;

class TrailerController extends Controller
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
        $trailers = Trailer::where('archive', '0')->paginate(15);
        if (is_null($trailers))
          throw new \Exception("Error Processing Request", 1);
        $customModalJS = TRUE;
        return view('trailer/trailerlist', ['trailers' => $trailers, 'customModalJS' => $customModalJS]);
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('TrailerController@index');
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
          return view('trailer/trailercreate');
        } catch (\Exception $e) {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('TrailerController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('TrailerController@index');
      }
    }// end create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrailerRequest $request)
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          Trailer::create([
            'trailer_id_number' => $request['trailer_id_number'],
            'capacity' => $request['capacity'],
            'capacity_palete' => $request['capacity_palete'],
            'archive' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
          ]);
          session()->flash('alert-success', 'Dodanie nowej przyczepy powiodło się!');
          return redirect()->action('TrailerController@index');
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('TrailerController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('TrailerController@index');
      }
    }// end store

    /**
     * Display the specified resource.
     *
     * @param  \App\Trailer  $trailer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return redirect()->action('TrailerController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trailer  $trailer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          $trailer = Trailer::find($id);
          if (is_null($trailer))
            throw new \Exception("Error Processing Request", 1);
          return view('trailer/traileredit', ['trailer' => $trailer]);
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('TrailerController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('TrailerController@index');
      }
    }// end edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trailer  $trailer
     * @return \Illuminate\Http\Response
     */
    public function update(TrailerRequest $request, $id)
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          $trailer = Trailer::find($id);
          if (is_null($trailer))
            throw new \Exception("Error Processing Request", 1);
          $trailer->update([
            'trailer_id_number' => $request['trailer_id_number'],
            'capacity' => $request['capacity'],
            'capacity_palete' => $request['capacity_palete'],
            'updated_at' => date('Y-m-d H:i:s')
          ]);
          session()->flash('alert-success', 'Edycja danych przyczepy powiodła się!');
          return redirect()->action('TrailerController@index');
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('TrailerController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('TrailerController@index');
      }
    }// end update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trailer  $trailer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          DB::table('trailers')->where('id', '=', $id)->delete();
          session()->flash('alert-success', 'Dane przyczepy zostały usunięte!');
          return redirect()->action('TrailerController@index_archive');
        }
        catch (QueryException $qe) // błąd usuwania powiązanych rekordów
        {
          session()->flash('alert-danger', 'Wystąpił błąd usuwania powiązanych rekordów!');
          return redirect()->action('TrailerController@index_archive');
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('TrailerController@index_archive');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('TrailerController@index');
      }
    }// end destroy

    public function index_archive()
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          $trailers = Trailer::where('archive', '1')->paginate(15);
          if (is_null($trailers))
            throw new \Exception("Error Processing Request", 1);
          $customModalJS = TRUE;
          return view('archive/trailerarchive', ['trailers' => $trailers, 'customModalJS' => $customModalJS]);
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('TrailerController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
        return redirect()->action('TrailerController@index');
      }
    }// end index_archive

    public function to_archive($id)
    {
      try
      {
        if (Auth::user()->ID_roles == 1)
        {
          $trailer = Trailer::find($id);
          if (is_null($trailer))
            throw new \Exception("Error Processing Request", 1);
          $trailer->update([
            'archive' => '1',
            'updated_at' => date('Y-m-d H:i:s')
          ]);
          session()->flash('alert-success', 'Archiwizacja przyczepy powiodła się!');
          return redirect()->action('TrailerController@index');
        }
        else
        {
          session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
          return redirect()->action('TrailerController@index');
        }
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('TrailerController@index');
      }
    }// end to_archive

    public function from_archive($id)
    {
      try
      {
        if (Auth::user()->ID_roles == 1)
        {
          $trailer = Trailer::find($id);
          if (is_null($trailer))
            throw new \Exception("Error Processing Request", 1);
          $trailer->update([
            'archive' => '0',
            'updated_at' => date('Y-m-d H:i:s')
          ]);
          session()->flash('alert-success', 'Przywrócenie przyczepy powiodło się!');
          return redirect()->action('TrailerController@index_archive');
        }
        else
        {
          session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
          return redirect()->action('TrailerController@index');
        }
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('TrailerController@index_archive');
      }
    }// end from_archive

}// end class trailer
