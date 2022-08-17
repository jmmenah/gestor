<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'Api\AuthController@login');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('getUser', 'Api\AuthController@getUser');

    Route::get('proyecto', 'ProyectoController@index');
    Route::post('proyecto/crear', 'ProyectoController@crearProyecto');
    Route::post('proyecto/{id}/asignarUsuarios', 'ProyectoController@asignarUsuarios');

    Route::get('actividad', 'ActividadController@index');
    Route::get('actividad/participante/{id}', 'ActividadController@getByUserId');
    Route::post('actividad/{proyecto_id}/crear', 'ActividadController@crearActividad');
    Route::post('actividad/{id}/asignarUsuarios', 'ActividadController@asignarUsuarios');

    Route::get('incidencia', 'IncidenciaController@index');
    Route::get('incidencia/responsable/{id}', 'IncidenciaController@getByResponsableId');
    Route::post('incidencia/{actividad_id}/crear', 'IncidenciaController@crearIncidencia');
    Route::post('incidencia/{id}/asignarUsuarios', 'IncidenciaController@asignarUsuarios');

});
