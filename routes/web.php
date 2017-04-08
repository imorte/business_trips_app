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

Route::group(['middleware' => ['auth'], 'prefix' => 'panel'], function() {
    Route::get('/', 'HomeController@index')->name('panel');

    Route::get('companies', 'HomeController@company')->name('companies');
    Route::get('departments', 'HomeController@department')->name('departments');
    Route::get('trips', 'HomeController@trip')->name('trips');
    Route::get('cities', 'HomeController@city')->name('cities');
    Route::get('employees   ', 'HomeController@employee')->name('employees');
});