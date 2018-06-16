<?php

namespace App\Http\Controllers;

use App\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SellerRequest;

class SellerController extends Controller
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
        $sellers = Seller::where('archive', '0')->paginate(15);
        if (is_null($sellers))
          throw new \Exception("Error Processing Request", 1);
        $customModalJS = TRUE;
        return view('seller/sellerlist', ['sellers' => $sellers, 'customModalJS' => $customModalJS]);
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('SellerController@index');
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
          return view('seller/sellercreate');
        } catch (\Exception $e) {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('SellerController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('SellerController@index');
      }
    } // end create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SellerRequest $request)
    {
      if ( Auth::user()->ID_roles == 1 || Auth::user()->ID_roles == 2)
      {
        try
        {
          Seller::create([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'address' => $request['address'],
            'phone_number' => $request['phone_number'],
            'archive' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
          ]);
          session()->flash('alert-success', 'Dodanie nowego sprzedawcy powiodło się!');
          return redirect()->action('SellerController@index');
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('SellerController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('SellerController@index');
      }
    } // end store

    /**
     * Display the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        return redirect()->action('SellerController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          $seller = Seller::find($id);
          if (is_null($seller))
            throw new \Exception("Error Processing Request", 1);
          return view('seller/selleredit', ['seller' => $seller]);
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('SellerController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('SellerController@index');
      }
    } // end edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(SellerRequest $request, $id)
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          $seller = Seller::find($id);
          if (is_null($seller))
            throw new \Exception("Error Processing Request", 1);
          $seller->update([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'address' => $request['address'],
            'phone_number' => $request['phone_number'],
            'updated_at' => date('Y-m-d H:i:s')
          ]);
          session()->flash('alert-success', 'Edycja danych sprzedawcy powiodło się!');
          return redirect()->action('SellerController@index');
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('SellerController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('SellerController@index');
      }
    }// end update

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          DB::table('sellers')->where('id', '=', $id)->delete();
          session()->flash('alert-success', 'Dane sprzedawcy zostały usunięte!');
          return redirect()->action('SellerController@index_archive');
        }
        catch (QueryException $qe) // błąd usuwania powiązanych rekordów
        {
          session()->flash('alert-danger', 'Wystąpił błąd usuwania powiązanych rekordów!');
          return redirect()->action('SellerController@index_archive');
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd.');
          return redirect()->action('SellerController@index_archive');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('SellerController@index');
      }
    }// end destroy

    public function index_archive()
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          $sellers = Seller::where('archive', '1')->paginate(15);
          if (is_null($sellers))
            throw new \Exception("Error Processing Request", 1);
          $customModalJS = TRUE;
          return view('archive/sellerarchive', ['sellers' => $sellers, 'customModalJS' => $customModalJS]);
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('SellerController@index_archive');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
        return redirect()->action('SellerController@index');
      }
    }// end index_archive

    public function to_archive($id)
    {
      try
      {
        if (Auth::user()->ID_roles == 1)
        {
          $seller = Seller::find($id);
          if (is_null($seller))
            throw new \Exception("Error Processing Request", 1);

            $seller->update([
              'archive' => '1',
              'updated_at' => date('Y-m-d H:i:s')
            ]);
            session()->flash('alert-success', 'Archiwizacja sprzedawcy powiodła się!');
            return redirect()->action('SellerController@index');
        }
        else
        {
          session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
          return redirect()->action('SellerController@index');
        }
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('SellerController@index');
      }
    }// end to_archive

    public function from_archive($id)
    {
      try
      {
        if (Auth::user()->ID_roles == 1)
        {
          $seller = Seller::find($id);
          if (is_null($seller))
            throw new \Exception("Error Processing Request", 1);

            $seller->update([
              'archive' => '0',
              'updated_at' => date('Y-m-d H:i:s')
            ]);
            session()->flash('alert-success', 'Przywrócenie sprzedawcy powiodło się!');
            return redirect()->action('SellerController@index_archive');
        }
        else
        {
          session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
          return redirect()->action('SellerController@index');
        }
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('SellerController@index_archive');
      }
    }// end from_archive

}// end class seller
