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

//    Route::get('companies', 'CompanyController@index')->name('companies');
    Route::resource('companies', 'CompanyController');
    Route::resource('cities', 'CityController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('employees', 'EmployeeController');


    Route::get('trips', 'HomeController@trip')->name('trips');
});