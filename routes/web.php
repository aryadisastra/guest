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

Route::get('/', function () {
    if(session('user')) return redirect('/dashboard');
    
    return view('welcome');
});
Route::post('/login','LoginController@login');
Route::get('/dashboard','DashboardController@index');
Route::get('/logout','DashboardController@logout');

Route::get('/bagian','BagianController@index');
Route::get('/bagian/create','BagianController@create');
Route::get('/bagian/edit/{id}','BagianController@edit');
Route::get('/bagian/{id}','BagianController@view');
Route::post('/bagian/create','BagianController@add');
Route::post('/bagian/edit','BagianController@update');
