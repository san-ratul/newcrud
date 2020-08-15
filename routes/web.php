<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/employee/create', 'EmployeeController@create')->name('empoloyee.create'); //loads create view
Route::post('/employee/store', 'EmployeeController@store')->name('empoloyee.store'); //store employee
Route::get('/employee/{employee}/edit', 'EmployeeController@edit')->name('empoloyee.edit'); //load edit view
Route::get('/employee/{employee}', 'EmployeeController@show')->name('empoloyee.show'); //show single employee
Route::patch('/employee/{employee}', 'EmployeeController@update')->name('empoloyee.update'); //updates employee
Route::delete('/employee/{employee}', 'EmployeeController@destroy')->name('empoloyee.destroy'); //delete employee

