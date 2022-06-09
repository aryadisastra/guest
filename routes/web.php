<?php

use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
Route::get('/logout-guest','DashboardController@logoutGuest');

Route::get('/bagian','BagianController@index');
Route::get('/bagian/create','BagianController@create');
Route::get('/bagian/edit/{id}','BagianController@edit');
Route::get('/bagian/{id}','BagianController@view');
Route::post('/bagian/create','BagianController@add');
Route::post('/bagian/edit','BagianController@update');

Route::get('/pengguna','PenggunaController@index');
Route::get('/pengguna/create','PenggunaController@create');
Route::get('/pengguna/edit/{id}','PenggunaController@edit');
Route::get('/pengguna/{id}','PenggunaController@view');
Route::post('/pengguna/create','PenggunaController@add');
Route::post('/pengguna/edit','PenggunaController@update');

Route::get('/agenda','AgendaController@index');
Route::get('/agenda/create','AgendaController@create');
Route::get('/agenda/edit/{id}','AgendaController@edit');
Route::get('/agenda/{id}','AgendaController@view');
Route::post('/agenda/create','AgendaController@add');
Route::post('/agenda/edit','AgendaController@update');
Route::get('/agenda/update-status/{id}','AgendaController@updateStatus');
Route::get('/agenda/reject-status/{id}','AgendaController@rejectStatus');
Route::get('/agenda/invite-guest/{id}','AgendaController@invite');

Route::get('/tamu','TamuController@index');
Route::get('/tamu/create','TamuController@create');
Route::get('/tamu/edit/{id}','TamuController@edit');
Route::get('/tamu/{id}','TamuController@view');
Route::post('/tamu/create','TamuController@add');
Route::post('/tamu/edit','TamuController@update');

Route::get('/guest','GuestController@index');
Route::post('/login-guest','GuestController@login');
Route::get('/guest/dashboard','GuestController@dashboard');
Route::get('/get-verification','GuestController@verification');
Route::get('/guest-verification','GuestController@verificationview');
Route::post('/verification','GuestController@postOTP');