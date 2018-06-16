<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Validator;
use App\User;
use App\UserRole;
use App\Http\Requests\EmployeeRequestStore;
use App\Http\Requests\EmployeeRequestUpdate;

class EmployeeController extends Controller
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
        $users = User::where('archive', '0')->paginate(10);
        if (is_null($users))
          throw new \Exception("Error Processing Request", 1);

        $customModalJS = TRUE;
        return view('employee/employeelist', ['users' => $users, 'customModalJS' => $customModalJS]);
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('EmployeeController@index');
      }
    }// end index

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if ( Auth::user()->ID_roles == 1 ){
        try{
          $employeerole = UserRole::all();
          if (is_null($employeerole))
            throw new \Exception("Error Processing Request", 1);
          return view('employee/employeecreate', ['employeerole' => $employeerole]);
        }
        catch (\Exception $e){
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('EmployeeController@index');
        }
      }else{
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji!');
        return redirect()->action('EmployeeController@index');
      }
    }// end create

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\EmployeeRequestStore  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequestStore $request)
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          User::create([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'ID_roles' => $request['employeerole'],
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'password' => bcrypt($request['password']),
            'address' => $request['address'],
            'archive' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
          ]);
          session()->flash('alert-success', 'Dodanie nowego pracownika powiodło się!');
          return redirect()->action('EmployeeController@index');
        }
        catch (\Exception $e)
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
          return redirect()->action('EmployeeController@index');
        }
      }
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji');
        return redirect()->action('EmployeeController@index');
      }
    } // end store

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return redirect()->action('EmployeeController@index');
    } // end show

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      try
      {
        if ( (Auth::user()->ID_roles == 1) || (Auth::user()->id == $id) )
        {
          $employee = User::find($id);
          if (is_null($employee))
            throw new \Exception("Error Processing Request", 1);
          $employeerole = UserRole::all();
          return view('employee/employeeedit', ['employee' => $employee, 'employeerole' => $employeerole]);
        }
        else
        {
          session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji');
          return redirect()->action('EmployeeController@index');
        }
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('EmployeeController@index');
      }
    } // end edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequestUpdate $request, $id)
    {
      try
      {
        $employee = User::find($id);
        if (is_null($employee))
          throw new \Exception("Error Processing Request", 1);

        if ( Auth::user()->ID_roles == 1 )
        {
          if ($request['password'] === null || $request['password'] === "")
          {
            $employee->update([
              'name' => $request['name'],
              'surname' => $request['surname'],
              'ID_roles' => $request['employeerole'],
              'email' => $request['email'],
              'phone_number' => $request['phone_number'],
              'address' => $request['address'],
              'updated_at' => date('Y-m-d H:i:s')
            ]);
          }
          else
          {
            $messages = [
              'password.min' => 'Hasło musi mieć od 6 do 16 znaków.',
              'password.max' => 'Hasło musi mieć od 6 do 16 znaków.'
            ];
            $rules = array(
              'password' => 'min:6|max:16'
            );
            $this->validate($request, $rules, $messages);

            $employee->update([
              'name' => $request['name'],
              'surname' => $request['surname'],
              'ID_roles' => $request['employeerole'],
              'email' => $request['email'],
              'phone_number' => $request['phone_number'],
              'password' => bcrypt($request['password']),
              'address' => $request['address'],
              'updated_at' => date('Y-m-d H:i:s')
            ]);
          }
        }
        else if (Auth::user()->id == $id)
        {
          if ($request['password'] === null || $request['password'] === "")
          {
            $employee->update([
              'name' => $request['name'],
              'surname' => $request['surname'],
              // 'ID_roles' => $request['employeerole'],
              'email' => $request['email'],
              'phone_number' => $request['phone_number'],
              'address' => $request['address'],
              'updated_at' => date('Y-m-d H:i:s')
            ]);
          }
          else
          {
            $messages = [
              'password.min' => 'Hasło musi mieć od 6 do 16 znaków.',
              'password.max' => 'Hasło musi mieć od 6 do 16 znaków.'
            ];
            $rules = array(
              'password' => 'min:6|max:16'
            );
            $this->validate($request, $rules, $messages);

            $employee->update([
              'name' => $request['name'],
              'surname' => $request['surname'],
              // 'ID_roles' => $request['employeerole'],
              'email' => $request['email'],
              'phone_number' => $request['phone_number'],
              'password' => bcrypt($request['password']),
              'address' => $request['address'],
              'updated_at' => date('Y-m-d H:i:s')
            ]);
          }
        }
        else
        {
          session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji');
          return redirect()->action('EmployeeController@index');
        }// end if auth

        session()->flash('alert-success', 'Edycja danych pracownika powiodła się!');
        return redirect()->action('EmployeeController@index');
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('EmployeeController@index');
      }
    }// end update

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
      if (Auth::user()->ID_roles == 1)
      {
        try
        {
          DB::table('users')->where('id', '=', $id)->delete();
          session()->flash('alert-success', 'Dane pracownika zostały usunięte!');
          return redirect()->action('EmployeeController@index_archive');
        }
        catch (QueryException $qe) // błąd usuwania powiązanych rekordów
        {
          session()->flash('alert-danger', 'Nie można usunąć pracownika, ponieważ jest powiązany z innymi rekordami w bazie.');
          return redirect()->action('EmployeeController@index_archive');
        }
        catch (\Exception $e) // inne typy błędów
        {
          session()->flash('alert-danger', 'Wystąpił nieznany błąd.');
          return redirect()->action('EmployeeController@index_archive');
        }
      }// end if auth
      else
      {
        session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
        return redirect()->action('EmployeeController@index');
      }
    }// end destroy

    public function index_archive()
    {
      try
      {
        $users = User::where('archive', '1')->paginate(10);
        if (is_null($users))
          throw new \Exception("Error Processing Request", 1);

        $customModalJS = TRUE;
        return view('archive/employeearchive', ['users' => $users, 'customModalJS' => $customModalJS]);
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('EmployeeController@index_archive');
      }
    }// end index_archive

    public function to_archive($id)
    {
      try
      {
        if (Auth::user()->ID_roles == 1)
        {
          $employee = User::find($id);
          if (is_null($employee))
            throw new \Exception("Error Processing Request", 1);

            $employee->update([
              'archive' => '1',
              'updated_at' => date('Y-m-d H:i:s')
            ]);

            session()->flash('alert-success', 'Archiwizacja pracownika powiodła się!');
            return redirect()->action('EmployeeController@index');
        }// end if auth
        else
        {
          session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
          return redirect()->action('EmployeeController@index');
        }
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('EmployeeController@index');
      }
    }// end to_archive

    public function from_archive($id)
    {
      try
      {
        if (Auth::user()->ID_roles == 1)
        {
          $employee = User::find($id);
          if (is_null($employee))
            throw new \Exception("Error Processing Request", 1);

            $employee->update([
              'archive' => '0',
              'updated_at' => date('Y-m-d H:i:s')
            ]);

            session()->flash('alert-success', 'Przywrócenie pracownika powiodło się!');
            return redirect()->action('EmployeeController@index_archive');
        }// end if auth
        else
        {
          session()->flash('alert-danger', 'Brak uprawnień do przeprowadzenia operacji.');
          return redirect()->action('EmployeeController@index');
        }
      }
      catch (\Exception $e)
      {
        session()->flash('alert-danger', 'Wystąpił nieznany błąd!');
        return redirect()->action('EmployeeController@index_archive');
      }
    }// end from_archive

} // end class Employee
