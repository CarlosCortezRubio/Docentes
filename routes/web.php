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
    //Route::post('/Periodos/Buscar', 'periodo\PeriodoController@index')->name('periodo.post');
    Route::get('/Periodos', 'periodo\PeriodoController@index')->name('periodo');
    Route::post('/Periodos/Nuevo', 'periodo\PeriodoController@insert')->name('periodo.insert');
    Route::post('/Periodos/Actualizar', 'periodo\PeriodoController@update')->name('periodo.update');
    Route::post('/Periodos/ActualizarEstado', 'periodo\PeriodoController@updateEstado')->name('periodo.update.estado');
    Route::get('/Periodos/Mensaje', 'periodo\PeriodoController@MensajeEstado')->name('periodo.mensaje');
    Route::post('/Periodos/export', 'periodo\PeriodoController@export')->name('periodo.export');
    ///////////////////////////////////////
    ///////////////CUPOS////////////////
    Route::get('/Cupos', 'cupo\CuposController@index')->name('cupo');
    Route::post('/Cupos/Nuevo', 'cupo\CuposController@insert')->name('cupos.insert');
    Route::post('/Cupos/Actualizar', 'cupo\CuposController@update')->name('cupos.update');
    Route::post('/Cupos/Eliminar', 'cupo\CuposController@delete')->name('cupos.delete');
    ///////////////////////////////////////
    //////////////////EXAMEN///////////////
    Route::get('/Examen', 'examen\ExamenController@index')->name('examen');
    Route::post('/Examen/Nuevo', 'examen\ExamenController@insert')->name('examen.insert');
    Route::post('/Examen/Actualizar', 'examen\ExamenController@update')->name('examen.update');
    Route::post('/Examen/Eliminar', 'examen\ExamenController@delete')->name('examen.delete');
    Route::get('/Examen/Cargar', 'examen\ExamenController@cargar')->name('examen.cargar');
    Route::get('/Examen/Cargar/Eliminar', 'examen\ExamenController@EliminarSeccion')->name('examen.cargar.delete');
    Route::get('/Examen/Cargar/Actualizar', 'examen\ExamenController@EditarSeccion')->name('examen.cargar.update');
    Route::get('/Examen/Cargar/Nuevo', 'examen\ExamenController@InsertarSeccion')->name('examen.cargar.insert');
    ///////////////////////////////////////
    Route::get('/Preguntas', 'examen\PreguntaController@index')->name('pregunta');
    ///////////////////////////////////////
    Route::get('/Evaluacion', 'evaluacion\EvaluacionController@index')->name('evaluacion');
    Route::get('/Evaluacion/Evaluar', 'evaluacion\EvaluacionController@Evaluar')->name('evaluacion.evaluar');
    Route::get('/Evaluacion/Abstener', 'evaluacion\EvaluacionController@Abstener')->name('evaluacion.abstener');
    Route::get('/Evaluacion/Cargar', 'evaluacion\EvaluacionController@Cargar')->name('evaluacion.cargar');
    Route::post('/Evaluacion/generatePDF', 'evaluacion\EvaluacionController@generatePDF')->name('evaluacion.generatePDF');
    /////////////////////////////////////
    Route::get('/Programacion', 'examen\ProgramacionController@index')->name('programacion');
    Route::post('/Programacion/Nuevo', 'examen\ProgramacionController@insert')->name('programacion.insert');
    Route::post('/Programacion/NuevoTeorico', 'examen\ProgramacionController@insertExamenTeorico')->name('programacion.insertTeorico');

    Route::post('/Programacion/Actualizar', 'examen\ProgramacionController@update')->name('programacion.update');
    //Route::post('/Programacion/AgregarAlumnos', 'examen\ProgramacionController@addAlumno')->name('programacion.alumnos');
    Route::get('/Programacion/CargarAlumnos', 'examen\ProgramacionController@CargarAlumnos')->name('programacion.alumnos.cargar');
    Route::get('/Programacion/Agregar', 'examen\ProgramacionController@Agregar')->name('programacion.alumnos.agregar');
    Route::get('/Programacion/AlumnoEliminar', 'examen\ProgramacionController@Eliminar')->name('programacion.alumnos.eliminar');
    Route::post('/Programacion/Eliminar', 'examen\ProgramacionController@delete')->name('programacion.delete');
    ///////////////////////////////////////
    Route::get('/NotasGenerales', 'ReporteController@NotasGenerales')->name('NotasGenerales');
    Route::get('/CargarGenerales', 'ReporteController@CargarNotasGenerales')->name('NotasGenerales.cargar');
    Route::get('/DetalleJurado', 'ReporteController@DetalleJurado')->name('DetalleJurado');
    Route::get('/NotasJurado', 'ReporteController@CargarNotasJurado')->name('NotasJurado.cargar');
    //////////////////////////////////////////
    Route::get('/SoporteExamen', 'Soporte\ExamenController@index')->name('examensoporte');
    Route::get('/SoporteExamen/cargarJurados', 'Soporte\ExamenController@cargarExamenJurado')->name('examensoporte.cargarJurados');
    Route::get('/SoporteExamen/cargarTeoria', 'Soporte\ExamenController@cargarExamenTeorico')->name('examensoporte.cargarTeoria');
    Route::get('/SoporteExamen/cargarAudio', 'Soporte\ExamenController@cargarExamenAudio')->name('examensoporte.cargarAudio');

    Route::get('/SoporteExamen/ReiniciarNotas', 'Soporte\ExamenController@ReiniciarNotas')->name('reiniciar.notas');
    Route::get('/SoporteExamen/ReiniciarExamen', 'Soporte\ExamenController@ReiniciarExamen')->name('reiniciar.examen');
    Route::get('/SoporteExamen/ReiniciarAudio', 'Soporte\ExamenController@ReiniciarAudio')->name('reiniciar.audio');
    ///////////////////////////////////////////////
    Route::get('/asistencia', 'AsistenciaController@index')->name('asistencia');
    Route::get('/asistencia/CargarDocentes', 'AsistenciaController@CargarDocentes')->name('CargarDocentes');
    Route::get('/asistencia/CargarPostulantes', 'AsistenciaController@CargarPostulantes')->name('CargarPostulantes');
    Route::get('/asistencia/addasistencia', 'AsistenciaController@addasistencia')->name('addasistencia');
    Route::get('/asistencia/addsalida', 'AsistenciaController@addsalida')->name('addsalida');
    Route::get('/', function () { return view('home');});
});
