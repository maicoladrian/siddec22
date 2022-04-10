<?php

use Illuminate\Support\Facades\Route;


use Illuminate\Http\Request;

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
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Auth::routes();

// Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

// rutas para cargos
Route::group(['middleware' => 'auth'], function () {
	Route::resource('cargos', 'App\Http\Controllers\CargoController', ['except' => ['show']]);
	
});

// rutas para personales
Route::group(['middleware' => 'auth'], function () {
	Route::resource('personales', 'App\Http\Controllers\PersonaleController', ['except' => ['show']]);
	
});

// rutas para horarios
Route::group(['middleware' => 'auth'], function () {
	Route::resource('horarios', 'App\Http\Controllers\HorarioController', ['except' => ['show']]);
	
});

// rutas para asistencias
Route::group(['middleware' => 'auth'], function () {
	// ruta para pdf de asistencias por rango de fechas
	Route::post('asistencias/reporte', 'App\Http\Controllers\AsistenciaController@reporte')->name('asistencias.reporte');

	Route::resource('asistencias', 'App\Http\Controllers\AsistenciaController', ['except' => ['show']]);
	
});
// ruta para guardar asistencias con codigo de control
Route::post('asistencias/codigo', 'App\Http\Controllers\AsistenciaController@guardarAsistencia')->name('asistencias.guardarAsistencia');
// consultar asistencias del dia con codigo de control
Route::post('asistencias/consultar', 'App\Http\Controllers\AsistenciaController@consultarAsistencias')->name('asistencias.consultarAsistencias');

// ruta para la vista consultar
Route::view('consultar', 'consultar')->name('consultar');

// ruta asistencias.muestraHora
Route::get('muestraHora',function(){
	$fecha = \Carbon\Carbon::now()->format('d-m-Y');
	$hora = \Carbon\Carbon::now()->format('H:i');
	return $fecha." ".$hora;
 })->name('muestraHora');