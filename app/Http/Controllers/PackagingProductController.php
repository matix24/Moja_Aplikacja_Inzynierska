<?php

namespace App\Http\Controllers;

use App\PackagingProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PackagingProductRequest;

class PackagingProductController extends Controller
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
        $packagings = PackagingProduct::where('archive', '0')->paginate(15);
        if (is_null($packagings))
          throw new \Exception("Error Processing Request", 1);
        $customModalJS = TRUE;
        return view('ware/packaging/packaginglist', ['packagings' => $packagings, 'customModalJS' => $customModalJS]);
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('PackagingProductController@index');
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
        try {
            return view('ware/packaging/packagingcreate');
        } catch (\Exception $e) {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('PackagingProductController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('PackagingProductController@index');
      }
    }// end create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackagingProductRequest $request)
    {
      if ( Auth::user()->ID_roles == 1 || Auth::user()->ID_roles == 2)
      {
        try
        {
          PackagingProduct::create([
            'name' => $request['name'],
            'archive' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
          ]);

          session()->flash('alert-success', 'Dodanie nowego opakowania powiodło się!');
          return redirect()->action('PackagingProductController@index');
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('PackagingProductController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('PackagingProductController@index');
      }
    }// end store

    /**
     * Display the specified resource.
     *
     * @param  \App\PackagingProduct  $packagingProduct
     * @return \Illuminate\Http\Response
     */
    public function show(PackagingProduct $packagingProduct)
    {
        return redirect()->action('PackagingProductController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PackagingProduct  $packagingProduct
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          $packaging = PackagingProduct::find($id);
          if (is_null($packaging))
            throw new \Exception("Error Processing Request", 1);
          return view('ware/packaging/packagingedit', ['packaging' => $packaging]);
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('PackagingProductController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('PackagingProductController@index');
      }
    }// end edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PackagingProduct  $packagingProduct
     * @return \Illuminate\Http\Response
     */
    public function update(PackagingProductRequest $request, $id)
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          $packaging = PackagingProduct::find($id);
          if (is_null($packaging))
            throw new \Exception("Error Processing Request", 1);
          $packaging->update([
            'name' => $request['name'],
            'updated_at' => date('Y-m-d H:i:s')
          ]);

          session()->flash('alert-success', 'Edycja opakowania powiodła się!');
          return redirect()->action('PackagingProductController@index');
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('PackagingProductController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('PackagingProductController@index');
      }
    }// end update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PackagingProduct  $packagingProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          DB::table('packaging_products')->where('id', '=', $id)->delete();
          session()->flash('alert-success', 'Dane opakowania zostały usunięte!');
          return redirect()->action('PackagingProductController@index_archive');
        }
        catch (QueryException $qe) // błąd usuwania powiązanych rekordów
        {
          session()->flash('alert-danger', 'Wystąpił błąd usuwania powiązanych rekordów!');
          return redirect()->action('PackagingProductController@index_archive');
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('PackagingProductController@index_archive');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('PackagingProductController@index');
      }
    }// end destroy

    public function index_archive()
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          $packagings = PackagingProduct::where('archive', '1')->paginate(15);
          if (is_null($packagings))
            throw new \Exception("Error Processing Request", 1);
          $customModalJS = TRUE;
          return view('archive/packagingarchive', ['packagings' => $packagings, 'customModalJS' => $customModalJS]);
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('PackagingProductController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
        return redirect()->action('PackagingProductController@index');
      }
    }// end index_archive

public function to_archive($id)
{
  try
  {
    if (Auth::user()->ID_roles == 1)
    {
      $packaging = PackagingProduct::find($id);
      if (is_null($packaging))
        throw new \Exception("Error Processing Request", 1);
      $packaging->update([
        'archive' => '1',
        'updated_at' => date('Y-m-d H:i:s')
      ]);

      session()->flash('alert-success', 'Archiwizacja opakowania powiodła się!');
      return redirect()->action('PackagingProductController@index');
    }
    else
    {
      session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
      return redirect()->action('PackagingProductController@index');
    }
  }
  catch (\Exception $e)
  {
    session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
    return redirect()->action('PackagingProductController@index');
  }
}// end to_archive

public function from_archive($id)
{
  try
  {
    if (Auth::user()->ID_roles == 1)
    {
      $packaging = PackagingProduct::find($id);
      if (is_null($packaging))
        throw new \Exception("Error Processing Request", 1);
      $packaging->update([
        'archive' => '0',
        'updated_at' => date('Y-m-d H:i:s')
      ]);

      session()->flash('alert-success', 'Przywrócenie opakowania powiodła się!');
      return redirect()->action('PackagingProductController@index_archive');
    }
    else
    {
      session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
      return redirect()->action('PackagingProductController@index');
    }
  }
  catch (\Exception $e)
  {
    session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
    return redirect()->action('PackagingProductController@index_archive');
  }
}// end from_archive

}// end class Packing
