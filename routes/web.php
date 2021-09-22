<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


// ROUTE ADMIN
Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function() {

        // ROUTE HOME ADMIN
        Route::get('/', 'HomeController@index')->name('home');
        // ROUTE SERVIZI
        Route::resource('/services', 'ServiceController', ['except' => ['show']]);
        // ROUTE DIPENDENTI
        Route::resource('/employees', 'EmployeeController');

        // ROUTE CLIENTI
        Route::resource('/clients', 'ClientController');
        // ROUTE Appuntamenti
        Route::resource('/appointments', 'AppointmentController', ['except' => ['create']]);
        Route::get('/appointments/{client_id}/create', 'AppointmentController@create')->name('appointments.create');
        Route::get('/appointments/done/index', 'AppointmentController@doneIndex')->name('appointments.done.index');
        Route::patch('/appointments/done/{appointment}', 'AppointmentController@done')->name('appointments.done.update');
    });

    Route::get('{any?}', function () {
        abort(404);
    })->where("any", ".*");