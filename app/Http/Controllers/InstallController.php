<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;
use App\Http\Requests\EmployeeRequestStore;
use App\User;

class InstallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('install/install');
    }// end index

    /**
     * Summary a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function install_app(Request $request)
    {
      try {
            if ( !isset($request['app_debug']) ) {
              $request['app_debug'] = 'false';
            }else{
              $request['app_debug'] = 'true';
            }

            if ( !isset($request['app_example_data']) )  {
              $request['app_example_data'] = 'false';
            }else{
              $request['app_example_data'] = 'true';
            }

              $messages = array(
                'app_url.required' => 'Podaj domyślny adres swojej aplkacji.',
                'db_connection.required' => 'Podaj typ bazy danych.',
                'db_host.required' => 'Podaj adres bazy danych.',
                'db_port.required' => 'Podaj port dla bazy danych.',
                'db_port.numeric' => 'Numer portu musi być liczbą.',
                'db_port.min' => 'Numer portu musi zaczynać się od 0.',
                'db_name.required' => 'Podaj nazwę bazy danych.',
                'db_user.required' => 'Podaj użytkownika bazy danych.',
                'db_password.required' => 'Podaj hasło dla użytkownika bazy danych.'
              );

              $rules = array(
                'app_url' => 'required',
                'db_connection' => 'required',
                'db_host' => 'required',
                'db_port' => 'required|numeric|min:0',
                'db_name' => 'required',
                'db_user' => 'required',
                'db_password' => 'required'
              );
              $this->validate($request, $rules, $messages);


              $path = base_path('.env');
              if (file_exists($path))
              {
                $preg_array = array(
                  'app_debug' => 'APP_DEBUG=',
                  'app_url' => 'APP_URL=',
                  'db_connection' => 'DB_CONNECTION=',
                  'db_host' => 'DB_HOST=',
                  'db_port' => 'DB_PORT=',
                  'db_name' => 'DB_DATABASE=',
                  'db_user' => 'DB_USERNAME=',
                  'db_password' => 'DB_PASSWORD=',
                );

                // zabawa z plikiem env
                $file_env = file_get_contents($path);
                $array_file_env = preg_split("/\\n/", $file_env);
                $change_array_file_env = array();
                foreach ($array_file_env as $key_env => $value_env){
                  $flaga = 0;
                  foreach ($preg_array as $key_preg => $value_preg) {
                    if ( preg_match('/^'.$value_preg.'*/', $value_env) ){
                      $change_array_file_env[] = $value_preg.$request[$key_preg];
                      $flaga = 1;
                    }
                  }
                  if ($flaga == 0){
                    $change_array_file_env[] = $value_env;
                  }
                }
                $finally_env = implode("\n", $change_array_file_env);
                file_put_contents($path, $finally_env);
                // koniec zabawy z plikiem env

                if ($request['app_example_data'] == 'true'){
                    return view('install/restart', ['demo' => 'true']);
                }else {
                  return view('install/restart', ['demo' => 'false']);
                }

              } else {
                return view('install/envNotFound');
              }

          } catch (QueryException $e){
            //dd($e);
            return redirect()->action('InstallController@error');
          }
          catch (\Exception $ex){
            //dd($ex);
            return redirect()->action('InstallController@error');
          }
      } // end install_app

      public function install_demo()
      {
        try {
            \Artisan::call('migrate');
            \Artisan::call('db:seed');
            return view('install/exampleData');
        } catch (QueryException $e){
          return redirect()->action('InstallController@error');
        } catch (\Exception $e) {
          return redirect()->action('InstallController@error');
        }
      }// end install_demo


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_user()
    {
      try {
          \Artisan::call('migrate');
          return view('install/installUser');
        } catch (QueryException $e){
          return redirect()->action('InstallController@error');
        }catch (\Exception $e) {
          return redirect()->action('InstallController@error');
        }
    }// end index_user


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function install_user(EmployeeRequestStore $request)
    {
      try {

          \Artisan::call('db:seed', ['--class' => 'UserRolesTableSeeder']);
          User::create([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'ID_roles' => '1',
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'password' => bcrypt($request['password']),
            'address' => $request['address'],
            'archive' => '0',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
          ]);
          return view('install/finish');
      } catch (QueryException $e){
        return redirect()->action('InstallController@error');
      }
      catch (\Exception $ex){
        return redirect()->action('InstallController@error');
      }
    }// end install_user

    public function error()
    {
      return view('install/installError');
    }

}// end class
