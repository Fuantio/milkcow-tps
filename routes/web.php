<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/produccion', 'ProduccionController');

Route::get('/produccionAgregar', 'ProduccionController@agregar');

Route::get('/produccionBuscar/{cadena}', 'ProduccionController@buscarProduccion');

Route::get('/vacaBuscar/{cadena}', 'ProduccionController@buscarVaca');

Route::get('/contarProduccion', 'ProduccionController@contarProduccion');

Route::view('/graficas', 'paginas.graficas');

Route::get('/buscarGraficoMonthYear/{cadena}', 'ProduccionController@buscarMonthYear');