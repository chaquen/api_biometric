<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
header('Access-Control-Allow-Origin: *');
header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );
header( 'Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS' );
//


Route::get('/', function () {
    return view('welcome');  
   
});
Route::get('/index', function () {
    return view('index');
});
Route::resource("participantes","ParticipantesController");
Route::resource("usuarios","UsuariosController");
Route::post("login","UsuariosController@login");
Route::resource("eventos","EventosController");
Route::get("repo_eventos/{id}","ReportesController@repo_eventos");
Route::post("mis_eventos","EventosController@mis_eventos");
Route::post("sync","ParticipantesController@sincronizar");
Route::post("preparar","ParticipantesController@preparar");
Route::post("reportes_lista_general","ReportesController@reportes_lista_general");
Route::get("reportes_por_id/{id_participante}","ReportesController@reportes_por_id");
Route::post("reportes_general","ReportesController@reporte_general");
Route::post("exportar_reporte_lista","ExportarController@exportar_lista");
Route::get('/descargar' , function(){
	 $pathtoFile = substr(base_path(),0,-4).'archivos/app/BiometricApp.rar';
      return response()->download($pathtoFile);
});
