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

Route::get('/limpiar', function () {
    echo Artisan::call('config:clear');
    echo Artisan::call('config:cache');
    echo Artisan::call('cache:clear');
    echo Artisan::call('route:clear');
 });
Auth::routes();
Route::middleware(['auth'])->group(function() {
    Route::get('/Principal', 'HomeController@index')->name('home');
    Route::get('/Periodos', 'periodo\PeriodoController@index')->name('periodo');
    Route::get('/Cupos', 'cupo\CuposController@index')->name('cupo');
    Route::get('/Examen', 'examen\ExamenController@index')->name('examen');
    Route::get('/Evaluacion', 'evaluacion\EvaluacionController@index')->name('evaluacion');
    Route::get('/Programacion', 'examen\ExamenController@programacion')->name('programacion');
    Route::get('/', function () { return view('home');});
});
