<?php

namespace App\Http\Controllers;

use App\Ware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\HardinessProduct;
use App\PackagingProduct;
use App\QualityProduct;

class WareController extends Controller
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
        $wares = Ware::where('archive', '0')->paginate(15);
        if (is_null($wares))
          throw new \Exception("Error Processing Request", 1);
        $customModalJS = TRUE;
        return view('ware/warelist', ['wares' => $wares, 'customModalJS' => $customModalJS]);
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('WareController@index');
      }
    }// end index

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if ( Auth::user()->ID_roles == 1 || Auth::user()->ID_roles == 2)
      {
        try
        {
          // $hardinesss = HardinessProduct::all();
          // if (is_null($hardinesss))
          //   throw new \Exception("Error Processing Request", 1);
          $packagings = PackagingProduct::where('archive', '0')->get();
          if (is_null($packagings))
            throw new \Exception("Error Processing Request", 1);
          // $qualites = QualityProduct::all();
          // if (is_null($qualites))
          //   throw new \Exception("Error Processing Request", 1);
          return view('ware/warecreate', ['packagings' => $packagings]);
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('WareController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('WareController@index');
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
      if ( Auth::user()->ID_roles == 1 || Auth::user()->ID_roles == 2)
      {
          if ( strpos($request['weight_of_package'], ',') )
            $request['weight_of_package'] = str_replace(',', '.', $request['weight_of_package']);

          $messages = array(
            'name.required' => 'Imię jest wymagane.',
            'name.max' => 'Maksymalna ilość znaków to 190.',
            'weight_of_package.required' => 'Waga opakowania jest wymagana.',
            'weight_of_package.numeric' => 'Waga musi być liczbą.',
            'weight_of_package.min' => 'Waga musi być większa od 0.'
          );
          $rules = array(
            'name' => 'required|max:190',
            'weight_of_package' => 'required|min:0|numeric'
          );
          $this->validate($request, $rules, $messages);

        try
        {
          Ware::create([
            // 'ID_hardiness' => $request['ID_hardiness'],
            // 'ID_quality' => $request['ID_quality'],
            'ID_packaging' => $request['ID_packaging'],
            'name' => $request['name'],
            'weight_of_package' => $request['weight_of_package'],
            'archive' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
          ]);
          session()->flash('alert-success', 'Dodanie nowego towaru powiodło się!');
          return redirect()->action('WareController@index');
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('WareController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('WareController@index');
      }
    }// end store

    /**
     * Display the specified resource.
     *
     * @param  \App\Ware  $ware
     * @return \Illuminate\Http\Response
     */
    public function show(Ware $ware)
    {
        return redirect()->action('WareController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ware  $ware
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          $ware = Ware::find($id);
          if (is_null($ware))
            throw new \Exception("Error Processing Request", 1);
          // $hardinesss = HardinessProduct::all();
          // if (is_null($hardinesss))
          //   throw new \Exception("Error Processing Request", 1);
          $packagings = PackagingProduct::where('archive', '0')->get();
          if (is_null($packagings))
            throw new \Exception("Error Processing Request", 1);
          // $qualites = QualityProduct::all();
          // if (is_null($qualites))
          //   throw new \Exception("Error Processing Request", 1);
          return view('ware/wareedit', ['packagings' => $packagings, 'ware' => $ware]);
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('WareController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('WareController@index');
      }
    } // end edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ware  $ware
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if (Auth::user()->ID_roles == 1)
      {
          if ( strpos($request['weight_of_package'], ',') )
            $request['weight_of_package'] = str_replace(',', '.', $request['weight_of_package']);

          $messages = array(
            'name.required' => 'Imię jest wymagane.',
            'name.max' => 'Maksymalna ilość znaków to 190.',
            'weight_of_package.required' => 'Waga opakowania jest wymagana.',
            'weight_of_package.numeric' => 'Waga musi być liczbą.',
            'weight_of_package.min' => 'Waga musi być większa od 0.'
          );
          $rules = array(
            'name' => 'required|max:190',
            'weight_of_package' => 'required|min:0|numeric'
          );
          $this->validate($request, $rules, $messages);

          try
          {
            $ware = Ware::find($id);
            if (is_null($ware))
              throw new \Exception("Error Processing Request", 1);
            $ware->update([
              // 'ID_hardiness' => $request['ID_hardiness'],
              // 'ID_quality' => $request['ID_quality'],
              'ID_packaging' => $request['ID_packaging'],
              'name' => $request['name'],
              'weight_of_package' => $request['weight_of_package'],
              'updated_at' => date('Y-m-d H:i:s')
            ]);
            session()->flash('alert-success', 'Edycja towaru powiodła się!');
            return redirect()->action('WareController@index');
          }
          catch (\Exception $e)
          {
            session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
            return redirect()->action('WareController@index');
          }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('WareController@index');
      }
    }// end update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ware  $ware
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          DB::table('wares')->where('id', '=', $id)->delete();
          session()->flash('alert-success', 'Towar został usunięty!');
          return redirect()->action('WareController@index_archive');
        }
        catch (QueryException $qe) // błąd usuwania powiązanych rekordów
        {
          session()->flash('alert-danger', 'Wystąpił błąd usuwania powiązanych rekordów!');
          return redirect()->action('WareController@index_archive');
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('WareController@index_archive');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('WareController@index');
      }
    }// end destroy

    public function index_archive()
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          $wares = Ware::where('archive', '1')->paginate(15);
          if (is_null($wares))
            throw new \Exception("Error Processing Request", 1);
          $customModalJS = TRUE;
          return view('archive/warearchive', ['wares' => $wares, 'customModalJS' => $customModalJS]);
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('WareController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
        return redirect()->action('WareController@index');
      }
    }// end index_archive

    public function to_archive($id)
    {
      try
      {
        if (Auth::user()->ID_roles == 1)
        {
          $ware = Ware::find($id);
          if (is_null($ware))
            throw new \Exception("Error Processing Request", 1);
          $ware->update([
            'archive' => '1',
            'updated_at' => date('Y-m-d H:i:s')
          ]);
          session()->flash('alert-success', 'Archiwizacja towaru powiodła się!');
          return redirect()->action('WareController@index');
        }
        else
        {
          session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
          return redirect()->action('WareController@index');
        }
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('WareController@index');
      }
    }// end to_archive

    public function from_archive($id)
    {
      try
      {
        if (Auth::user()->ID_roles == 1)
        {
          $ware = Ware::find($id);
          if (is_null($ware))
            throw new \Exception("Error Processing Request", 1);
          $ware->update([
            'archive' => '0',
            'updated_at' => date('Y-m-d H:i:s')
          ]);
          session()->flash('alert-success', 'Przywrócenie towaru powiodło się!');
          return redirect()->action('WareController@index_archive');
        }
        else
        {
          session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
          return redirect()->action('WareController@index');
        }
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('WareController@index_archive');
      }
    }// end from_archive

}// end class ware
