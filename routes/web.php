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
*/////

Route::get('/', function () {
    return view('landing');
});
//tommy

Route::post('/crear','GenericController@crearUsuarios');
Route::post('/datosPatrocinador','GenericController@datos');
Route::post('/verificarCiclo/{ciclo}&{anterior}','GenericController@checarCiclo');
Route::get('/habilitar','GenericController@validar');
Route::get('/eliminarUsuario/{id}','GenericController@eliminarU');
Route::get('/validarUsuario/{id}/{motivo?}','GenericController@validarU');
Route::get('/crearDispersion','GenericController@crearDispersion');
Route::get('/listarPagos/{estatus}','GenericController@listarPagos');
Route::get('/listarPagos','GenericController@listarPagos1');
Route::get('/procesarPago/{id}','GenericController@registrarPago');
Route::get('/perfil','GenericController@editar');

Route::get('/editarPerfil','GenericController@edita');

//tommy
Auth::routes();
Route::get('/getMunicipios', 'genericController@getMunicipios');
Route::get('/getEstados', 'genericController@getEstados');
Route::get( 'genericController@insertaEnMatriz');
Route::post('/traeArbolCiclo','genericController@traeArbolCiclo');
Route::post('/traeArbolNodo','genericController@traeArbolNodo');
Route::post('/traeArbol','genericController@traeArbol');
Route::post('/subeArbol','genericController@subeArbol');
Route::post('/traeCiclos','genericController@traeCiclos');
Route::post('/traeDescendencia','genericController@traeDescendencia');
Route::post('/guardaAsociado','genericController@guarda');
// Rol master
Route::group(['middleware' => ['auth','master'], 'prefix'=>'master'], function(){
		Route::resource('/', 'mastercontroller');

		Route::post('crear','mastercontroller@store')->name('crear');

		Route::get('/','mastercontroller@index');
		Route::post('edita','mastercontroller@edita'); 
		Route::get('deshabilitar','mastercontroller@showDeshabilitar')->name('deshabilitar-usuario');
		Route::post('deshabilitar','mastercontroller@deshabilitar')->name('deshabilitar');
		Route::post('/store','mastercontroller@store')->name('guardaUsuario');
		Route::get('/mreporte','mastercontroller@mreporte')->name('mreporte');

		Route::post('guarda','mastercontroller@guarda')->name('guarda');
		Route::resource('/matriz','ArbolController');
		Route::post('/matriz/ver','ArbolController@ver')->name('ver');
});

// Rol asociado
Route::group(['middleware' => ['auth','asociado'], 'prefix'=>'asociado'], function(){
		Route::resource('/', 'asociadocontroller');
		Route::resource('/matriz', 'arbolasociadocontroller');
		Route::post('/matriz/verMatriz','arbolasociadocontroller@verMatriz')->name('verMatriz');
		Route::get('/reporte','asociadocontroller@reporte')->name('reporte');
});