<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('layouts/welcome');
});

// install
Route::get('/install', 'InstallController@index')->name('Install');
Route::get('/install/user', 'InstallController@index_user')->name('IndexUser');
Route::get('/install/demo', 'InstallController@install_demo')->name('InstallDemo');
Route::get('/install/finish', 'InstallController@finish');
Route::get('/install/error', 'InstallController@error');
Route::post('/install/stepTwo', 'InstallController@install_app')->name('InstallApp');
Route::post('/install/stepThree', 'InstallController@install_user')->name('InstallUser');

Route::get('/', function () {
    return view('layouts/main');
})->name('MainPage');

Route::get('/a', function () {
    return view('layouts/mainn');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// employee
Route::post('/employee/delete/{id}', 'EmployeeController@destroy')->name('DeleteEmployee');
Route::get('employee/archive', array('uses' => 'EmployeeController@index_archive', 'as' => 'EmployeeArchive'));
Route::post('employee/archive/to/{id}', array('uses' => 'EmployeeController@to_archive', 'as' => 'EmployeeToArchive'));
Route::post('employee/archive/from/{id}', array('uses' => 'EmployeeController@from_archive', 'as' => 'EmployeeFromArchive'));
Route::resource('employee', 'EmployeeController');
//Route::get('employee/archive', array('uses' => 'EmployeeController@index_archive', 'as' => 'EmployeeArchive'));

// seller
Route::get('seller/archive', array('uses' => 'SellerController@index_archive', 'as' => 'SellerArchive'));
Route::post('seller/archive/to/{id}', array('uses' => 'SellerController@to_archive', 'as' => 'SellerToArchive'));
Route::post('seller/archive/from/{id}', array('uses' => 'SellerController@from_archive', 'as' => 'SellerFromArchive'));
Route::resource('seller', 'SellerController');

// ware
Route::get('ware/archive', array('uses' => 'WareController@index_archive', 'as' => 'WareArchive'));
Route::post('ware/archive/to/{id}', array('uses' => 'WareController@to_archive', 'as' => 'WareToArchive'));
Route::post('ware/archive/from/{id}', array('uses' => 'WareController@from_archive', 'as' => 'WareFromArchive'));
Route::resource('ware', 'WareController');

// packing produkt
Route::get('packaging/archive', array('uses' => 'PackagingProductController@index_archive', 'as' => 'PackagingProductArchive'));
Route::post('packaging/archive/to/{id}', array('uses' => 'PackagingProductController@to_archive', 'as' => 'PackagingProductToArchive'));
Route::post('packaging/archive/from/{id}', array('uses' => 'PackagingProductController@from_archive', 'as' => 'PackagingProductFromArchive'));
Route::resource('packaging', 'PackagingProductController');

// truck
Route::get('truck/archive', array('uses' => 'TruckController@index_archive', 'as' => 'TruckArchive'));
Route::post('truck/archive/to/{id}', array('uses' => 'TruckController@to_archive', 'as' => 'TruckToArchive'));
Route::post('truck/archive/from/{id}', array('uses' => 'TruckController@from_archive', 'as' => 'TruckFromArchive'));
Route::resource('truck', 'TruckController');

//trailer
Route::get('trailer/archive', array('uses' => 'TrailerController@index_archive', 'as' => 'TrailerArchive'));
Route::post('trailer/archive/to/{id}', array('uses' => 'TrailerController@to_archive', 'as' => 'TrailerToArchive'));
Route::post('trailer/archive/from/{id}', array('uses' => 'TrailerController@from_archive', 'as' => 'TrailerFromArchive'));
Route::resource('trailer', 'TrailerController');

// loading
Route::get('loadingInstruction/archive', array('uses' => 'LoadingInstructionController@index_archive', 'as' => 'LoadingInstructionArchive'));
Route::post('loadingInstruction/archive/to/{id}', array('uses' => 'LoadingInstructionController@to_archive', 'as' => 'LoadingInstructionToArchive'));
Route::post('loadingInstruction/archive/from/{id}', array('uses' => 'LoadingInstructionController@from_archive', 'as' => 'LoadingInstructionFromArchive'));
Route::resource('loadingInstruction', 'LoadingInstructionController');
Route::post('loadingInstruction/create_disposition_ware/stepTwo', 'LoadingInstructionController@store_stepTwo')->name('LoadingStepTwo');
Route::delete('loadingInstruction/create_disposition_ware/delete/{id}', array('uses' => 'LoadingInstructionController@loading_delete', 'as' => 'LoadingDelete'));
Route::get('loadingInstruction/{id}/edit_instruction', array('uses' => 'LoadingInstructionController@loading_edit', 'as' => 'LoadingEdit'));
Route::post('loadingInstruction/add_ware_box', 'LoadingInstructionController@wares_boxes_add')->name('WaresBoxesAdd');
Route::post('loadingInstruction/edit_ware_box', 'LoadingInstructionController@wares_boxes_edit')->name('WaresBoxesEdit');
Route::delete('loadingInstruction/delete_ware_box/{id}', array('uses' => 'LoadingInstructionController@wares_boxes_delete', 'as' => 'WaresBoxesDelete'));
