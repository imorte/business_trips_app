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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'panel'], function() {
    Route::get('/', 'HomeController@index')->name('panel');

    Route::resource('companies', 'CompanyController');
    Route::resource('cities', 'CityController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('employees', 'EmployeeController');
    Route::resource('trips', 'TripController');
});