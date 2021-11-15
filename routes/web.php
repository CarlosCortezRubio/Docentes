<?php

use Illuminate\Support\Facades\Artisan;
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

Route::get('/limpiar', function () {
    echo Artisan::call('config:clear');
    echo Artisan::call('config:cache');
    echo Artisan::call('cache:clear');
    echo Artisan::call('route:clear');
 });
Auth::routes();
Route::middleware(['auth'])->group(function() {
    Route::get('/Principal', 'HomeController@index')->name('home');
    ///////////////PERIODOS////////////////
    Route::get('/Periodos', 'periodo\PeriodoController@index')->name('periodo');
    Route::post('/Periodos/Nuevo', 'periodo\PeriodoController@insert')->name('periodo.insert');
    Route::post('/Periodos/Actualizar', 'periodo\PeriodoController@update')->name('periodo.update');
    Route::post('/Periodos/ActualizarEstado', 'periodo\PeriodoController@updateEstado')->name('periodo.update.estado');
    Route::get('/Periodos/Mensaje', 'periodo\PeriodoController@MensajeEstado')->name('periodo.mensaje');
    ///////////////////////////////////////
    ///////////////CUPOS////////////////
    Route::get('/Cupos', 'cupo\CuposController@index')->name('cupo');
    Route::post('/Cupos/Nuevo', 'cupo\CuposController@insert')->name('cupos.insert');
    Route::post('/Cupos/Actualizar', 'cupo\CuposController@update')->name('cupos.update');
    Route::post('/Cupos/Eliminar', 'cupo\CuposController@delete')->name('cupos.delete');
    //Route::post('/Periodos/Actualizar', 'cupo\CuposController@mensaje')->name('cupos.mensaje');
    ///////////////////////////////////////
    //////////////////EXAMEN///////////////
    Route::get('/Examen', 'examen\ExamenController@index')->name('examen');
    Route::post('/Examen/Nuevo', 'examen\ExamenController@insert')->name('examen.insert');
    Route::post('/Examen/Actualizar', 'examen\ExamenController@update')->name('examen.update');
    Route::post('/Examen/Eliminar', 'examen\ExamenController@delete')->name('examen.delete');
    ///////////////////////////////////////
    Route::get('/Evaluacion', 'evaluacion\EvaluacionController@index')->name('evaluacion');
    Route::get('/Programacion', 'examen\ExamenController@programacion')->name('programacion');
    Route::get('/', function () { return view('home');});
});
